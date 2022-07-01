<!DOCTYPE html>
<html lang="en">

@include('file_comuni.header')
@include('file_comuni.menu') // MENU
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Stipendi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- inizio_fine-->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                 
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- small box -->
                <div class="-box bg">

                    <div class="demo-container">
                        <div id="grid">


                        </div>
                        <div class="options">
                        </div>
                        <ul>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
</section>
</div>




@include('file_comuni.footer')

</body>
<script>
    $(() => {
    const URL = 'https://js.devexpress.com/Demos/Mvc/api/DataGridWebApi';
  
    const ordersStore = new DevExpress.data.CustomStore({
          
      load() {
  
        return sendRequest(`{{ route('dashboard.list') }}`);
        
    },
        insert: function(values) {
          return $.post("{{ route('user.store') }}",values);
      
      },
      update(key, values) {
   
        return $.post(key.url_update, {
                              values: values,
                              _method: "PUT"
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
    dateSerializationFormat: "yyyy/MM/dd HH:mm:ss",
      editing: {
        refreshMode: 'full',
        mode: 'row',
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


</html>