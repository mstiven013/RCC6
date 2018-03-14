jQuery(function($){

	//Data table of users
	var langDataTables = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		};

	var urlClass = com6Scripts.pluginsUrl + "/comuna6/inc/admin/assets/consult.Draws.php";

	var table = $('#com6_table_draws').DataTable({
		"language": langDataTables,
		"ajax": {
			"method": "POST",
			"url": urlClass
		},
		"columns": [
			{"data": "number_draw"},
			{"data": "code_number"},
			{"data": "commerce"},
			{"data": "document"},
			{"data": "firstname"},
			{"data": "lastname"},
			{"data": "phone"}
		],
		"dom": "Blfrtip",
		"buttons": [
			{
				"extend": 'excel',
				"text": 'Exportar a Excel',
				"className": "button",
				"filename": "Codigos registrados Rifa RCC6",
				"exportOptions": {
					"modifier": {
						"order":  'current',
						"page":   'all',
						"search": 'none',
					}
				}
			}
		]

	});

});