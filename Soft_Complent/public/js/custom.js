function CargarDatos(tabla){
    $(document).ready(function(){
      $(tabla).DataTable({
        dom: 'Bfrltip',
        buttons: [
          {
            extend: 'excel',
            text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
            className: 'btn btn-outline-success',
            exportOptions: {
              modifier: {
                page: 'current'
              }
            }
          },
          {
            extend: 'copy',
            text: '<i class="fa fa-file-text-o" aria-hidden="true"></i> Copiar',
            className: 'btn btn-outline-info',
            exportOptions: {
              modifier: {
                page: 'current'
              }
            }
          }
        ],
        "pageLength": 5,
        "bFilter": true,
        "bPaginate": true,
        "bSort": true,
        "searching": true,
        "ordering": true,
        responsive: {
            breakpoints: [
            ]
        },
        "oLanguage": {
          "oAria": {
            "sSortAscending": " - click/para ordenar ascendentemente.",
            "sSortDescending": " - click/para ordenar en descenso."
          },
          "oPaginate": {
            "sFirst": "Primera página",
            "sLast": "Última página",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "sSearch": "Buscar:",
          "sInfoFiltered": "(Filtrado a partir de _MAX_ registros)",
          "sEmptyTable": "No hay datos disponibles.",
          "sInfo": "Viendo del _START_ hasta el _END_ en los registos con un total de _TOTAL_.",
          "sInfoEmpty": "No hay entradas disponibles.",
          "sInfoThousands": ".",
          "sLoadingRecords": "Espere por favor se está cargando.",
          "sProcessing": "Información no disponible.",
          "sLengthMenu": 'Mostrando <select>' +
          '<option value="5">5</option>' +
          '<option value="10">10</option>' +
          '<option value="20">20</option>' +
          '<option value="30">30</option>' +
          '<option value="40">40</option>' +
          '<option value="50">50</option>' +
          '<option value="-1">Todos </option>' +
          '</select> Registros',
          "sZeroRecords": "No hay información disponible."
        }
      });
    });
  }


  function LlenarSelectGlobal(IdSelect, arreglo, id_buscado, nombre_buscado){
    document.getElementById(IdSelect).length=0;
    let cantidad = parseInt(Object.keys(arreglo).length);
      document.getElementById(IdSelect).options[document.getElementById(IdSelect).options.length]=new Option ('Seleccione una opción','0');
      for(let x=0; x<cantidad; x++){
        document.getElementById(IdSelect).options[document.getElementById(IdSelect).options.length]=new Option (arreglo[x][nombre_buscado],arreglo[x][id_buscado]);
      }
  }

  