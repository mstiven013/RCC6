//Modals
jQuery(function($){

	var modals = $('.com6-modal');
	var close = $('.com6_btn-close, .modal-bg');

	close.on('click', function() {
		modals.removeClass('show');
	});

	$(document).keyup(function(e){
		if(e.keyCode == 27) {
			modals.removeClass('show');
		}
	});

});

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

jQuery(function($){
	var table = $('.datatable').DataTable({
					"language": langDataTables,
					"dom": "Bfrtip",
					"ajax": {
						"method": "POST",
						"url": com6Scripts.pluginsUrl + "/comuna6/inc/libs/consult.Users.php"
					},
					"columns": [
						{"data": "firstname"},
						{"data": "lastname"},
						{"data": "document"},
						{"data": "email"},
						{"data": "minutes_state"},
						{"defaultContent": "<input type='button' class='button modificar' value='Modificar'>"}
					]
				});

	modifyUser('.datatable tbody', table);

	function modifyUser(tbody,table) {

		$(tbody).on('click', 'input.modificar', function() {
			var data = table.row($(this).parents("tr")).data();
			var nombres = $('#form-user #name').val(data.firstname); //Generando valor de Nombres			
			var apellidos = $('#form-user #lastname').val(data.lastname); //Generando valor de Apellidos
			var correo = $('#form-user #email').val(data.email); //Generando valor del Correo electronico
			var telefono = $('#form-user #phone').val(data.phone); //Generando valor del Numero de telefono
			var documento = $('#form-user #document').val(data.document); //Generando valor del Numero de documento
			var action = $('#form-user #action').val('modificar');

			//Generando el valor de la lista desplegable de Estado en plan de minutos
			var selected = new Option(data.minutes_state, data.minutes_state, false, true);
			var oExists = ($("#form-user #minutes option[value='" + data.minutes_state + "']").length > 0);

			if(oExists) {
				$("#form-user #minutes option").each(function(){
					if($(this).val() == data.minutes_state) {
						$(this).attr('selected', 'selected');
					}
				});

				if(data.minutes_state != 'sin registrar') {
					$('#form-user #minutes option[value="sin registrar"]').attr('disabled','disabled');
					$('#form-user #minutes option[value="inactivo"]').removeAttr('disabled');
				} else {
					$('#form-user #minutes option[value="inactivo"]').attr('disabled','disabled');
					$('#form-user #minutes option[value="sin registrar"]').removeAttr('disabled');
				}
			}

			$('.com6-modal').addClass('show');

			$('#form-user').on('submit', function(e){
				e.preventDefault();
				modify();
			});
		});
	}

	function modify(){
		var form = $('#form-user').serialize();
		console.log(form);
		/*
		$.ajax({
			method: "POST",
			url: com6Scripts.pluginsUrl + "/comuna6/inc/libs/set.Users.php",
			data: form
		}).done(function(info){
			console.log(info);
		});
		*/
	};

});