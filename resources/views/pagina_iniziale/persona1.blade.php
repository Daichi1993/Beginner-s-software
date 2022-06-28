<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>

    <title>DevExtreme Demo</title>
      

    <script type="text/javascript" src="  https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    {{-- <script type="text/javascript" src="{{URL::asset('js/utenti.js')}}"></script> --}}


    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/event.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/supplemental.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/unresolved.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.2.7/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/21.2.7/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/21.2.7/js/dx.all.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="styles.css" />
    <script src="index.js"></script> --}} {{-- non le trova --}}
  </head>

  <body class="dx-viewport">
    <div class="demo-container">
      <div id="grid"></div>
      <div class="options">
    
      
    
       
          </div>
          <ul></ul>
        </div>
      </div>
    </div>
  </body>
</html>


<script>
 $(() => {
  const URL = 'https://js.devexpress.com/Demos/Mvc/api/DataGridWebApi';

  const ordersStore = new DevExpress.data.CustomStore({
    
    load() {

      return sendRequest(`{{ route('list') }}`);
    },
    dateSerializationFormat: "yyyy/MM/dd HH:mm:ss",
    insert: function(values) {
        return $.post("{{ route('user.store') }}",values);
    
    },
    update(key, values) {
      return sendRequest(`${URL}/UpdateOrder`, 'PUT', {
        key,
        values: JSON.stringify(values),
      });
    },
    remove: function(key) {
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

    </script>