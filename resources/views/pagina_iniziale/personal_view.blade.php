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
      <div id="data-grid-demo">
        <div id="gridContainer"></div>
        <div class="options">
          <div class="caption">Options</div>
          <div class="option">
            <div id="selectTextOnEditStart"></div>
          </div>
          <div class="option">
            <span>Start Edit Action</span>
            <div id="startEditAction"></div>
          </div>
        </div>
      </div>
    </div>
</html>


<script>
 
  var dataGrid;
  $(() => {
    dataGrid = $('#gridContainer').dxDataGrid({
    dataSource: {
      store: {
        type: 'odata',
        url: "{{route('list')}}",
        key: 'Id',
        beforeSend(request) {
          request.params.startDate = '2020-05-10';
          request.params.endDate = '2020-05-15';
        },
        
      },
      editing: {
      mode: 'form',
      allowUpdating: true,
      allowAdding: true,
      allowDeleting: true,
      selectTextOnEditStart: true,
      startEditAction: 'click',
    },

    },
    paging: {
      pageSize: 10,
    },
    pager: {
      showPageSizeSelector: true,
      allowedPageSizes: [10, 25, 50, 100],
    },
    remoteOperations: false,
    searchPanel: {
      visible: true,
      highlightCaseSensitive: true,
    },
    groupPanel: { visible: true },
    grouping: {
      autoExpandAll: false,
    },
    allowColumnReordering: true,
    rowAlternationEnabled: true,
    showBorders: true,
    columns: [
      {
        dataField: 'nome',
        dataType: 'varchar',
      },
      {
        dataField: 'cognome',
        dataType: 'varchar',
      },
      {
        dataField: 'stipendio',
        dataType: 'number',
      },
      {
        dataField: 'eta',
        dataType: 'number',
      },
      {
        dataField: 'data_percepito',
        dataType: 'date',
      }
      
      
    ],
    }).dxDataGrid('instance');


    $('#selectTextOnEditStart').dxCheckBox({
    value: true,
    text: 'Select Text on Edit Start',
    onValueChanged(data) {
        console.log(data.value);
      dataGrid.option('editing.selectTextOnEditStart', data.value);
    },
  });

  $('#startEditAction').dxSelectBox({
    value: 'click',
    items: ['click', 'dblClick'],
    onValueChanged(data) {
        console.log(data.value);
      dataGrid.option('editing.startEditAction', data.value);
    },
  });
});
   
  </script>


<style>
  .dx-datagrid .dx-data-row > td.bullet {
  padding-top: 0;
  padding-bottom: 0;
}

  </style>