

$(() => {
    const URL = 'https://js.devexpress.com/Demos/Mvc/api/DataGridWebApi';

    const ordersStore = new DevExpress.data.CustomStore({

        load() {

            return sendRequest(`{{ route('list') }}`);
        },
        dateSerializationFormat: "yyyy/MM/dd HH:mm:ss",
        insert: function (values) {
            return $.post("{{ route('user.store') }}", values);

        },
        update(key, values) {
            return sendRequest(`${URL}/UpdateOrder`, 'PUT', {
                key,
                values: JSON.stringify(values),
            });
        },
        remove: function (key) {
            return $.post(key.url_destroy, {
                key: key,
                _method: "DELETE"
            });
        }

    });

    const dataGrid = $('#grid').dxDataGrid({
        dataSource: ordersStore,
        repaintChangesOnly: true,
        showBorders: true,
        editing: {
            refreshMode: 'reshape',
            mode: 'cell',
            allowAdding: true,
            allowUpdating: true,
            allowDeleting: true,
        },
        scrolling: {
            mode: 'virtual',
        },
        columns: [,

            {
                dataField: 'nome',
                dataType: 'nome',
            },
            {
                dataField: 'cognome',
                dataType: 'cognome',
            },
            {
                dataField: 'stipendio',
                dataType: 'number',
            },

            {
                dataField: 'data_percepito',
                dataType: 'date',
                format: 'dd/MM/yyyy',

            }
        ],
        summary: {
            totalItems: [{
                column: 'CustomerID',
                summaryType: 'count',
            }, {
                column: 'Freight',
                valueFormat: '#0.00',
                summaryType: 'sum',
            }],
        },
    }).dxDataGrid('instance');

    $('#refresh-mode').dxSelectBox({
        items: ['full', 'reshape', 'repaint'],
        value: 'reshape',
        onValueChanged(e) {
            dataGrid.option('editing.refreshMode', e.value);
        },
    });

    $('#clear').dxButton({
        text: 'Clear',
        onClick() {
            $('#requests ul').empty();
        },
    });

    function sendRequest(url, method = 'GET', data) {
        const d = $.Deferred();

        logRequest(method, url, data);

        $.ajax(url, {
            method,
            data,
            cache: false,
            xhrFields: { withCredentials: true },
        }).done((result) => {
            d.resolve(method === 'GET' ? result.data : result);
        }).fail((xhr) => {
            d.reject(xhr.responseJSON ? xhr.responseJSON.Message : xhr.statusText);
        });

        return d.promise();
    }

    function logRequest(method, url, data) {
        const args = Object.keys(data || {}).map((key) => `${key}=${data[key]}`).join(' ');

        const logList = $('#requests ul');
        const time = DevExpress.localization.formatDate(new Date(), 'HH:mm:ss');
        const newItem = $('<li>').text([time, method, url.slice(URL.length), args].join(' '));

        logList.prepend(newItem);
    }
});