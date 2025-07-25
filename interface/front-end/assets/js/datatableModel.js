
      $(document).ready(function() {
        // Configuraciones de idioma en español para DataTables
        var spanishLanguage = {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        };

        // Inicialización de DataTables con las configuraciones de idioma
        var dataTable = $('#myTable').DataTable({
          "searching": true,
          "lengthMenu": [10, 25, 50, 75, 100],
          "pageLength": 10,
          "language": spanishLanguage // Aplicar configuraciones de idioma
        });

        // Modificar el texto del campo de búsqueda

      });
   

   
      $(document).ready(function() {
        $('#myTable').DataTable();
      });