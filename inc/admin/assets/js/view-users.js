//Modals
jQuery(function($){

	var modals = $('.com6-modal, .com6-alert');
	var close = $('.com6_btn-close, .modal-bg, .alert-bg');

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

	var modal = $('.com6-modal');
	var alert = $('.com6-alert');

	$(document).on('ready', function() {
		listar();
		//addUser();
		sendForm();
	});
	
	var listar = function() {
		var table = $('#com6_users_table').DataTable({
					"language": langDataTables,
					"destroy": true,
					"ajax": {
						"method": "POST",
						"url": com6Scripts.pluginsUrl + "/comuna6/inc/admin/assets/consult.Users.php"
					},
					"columns": [
						{"data": "firstname"},
						{"data": "lastname"},
						{"data": "document"},
						{"data": "state"},
						{"data": "email"},
						{"data": "minutes_state"},
						{"defaultContent": "<input type='button' class='button modificar' value='Modificar'>"}
					],
					"dom": "Bfrtip",
					"buttons": [
						{
							"text": 'Agregar usuario',
							"className": "button",
							"action": function ( e, dt, node, config ) {
								addUser();
							}
						},
						{
							"extend": 'excel',
				            "text": 'Exportar a Excel',
				            "className": "button",
				            "filename": "Usuarios RCC6",
				            "exportOptions": {
				                "modifier": {
				                    "page": 'current'
				                }
				            }
			            }
					]
				});

		modifyUser('.datatable tbody', table);
	}

	var modifyUser = function(tbody,table) {

		$(tbody).on('click', 'input.modificar', function() {

			document.getElementById('title-modal').innerHTML = "Modificar usuario:";

			var data = table.row($(this).parents("tr")).data();
			var nombres = $('#form-user #name').val(data.firstname); //Generando valor de Nombres			
			var apellidos = $('#form-user #lastname').val(data.lastname); //Generando valor de Apellidos
			var documento = $('#form-user #document').val(data.document); //Generando valor del Numero de documento
			var state = $('#form-user #state').val(data.state); //Generando valor del Numero de documento
			var correo = $('#form-user #email').val(data.email); //Generando valor del Correo electronico
			var telefono = $('#form-user #phone').val(data.phone); //Generando valor del Numero de telefono
			var save = $('#form-user #save').val('Modificar usuario'); //Generando valor del Botón de guardar
			var action = $('#form-user #action').val('modificar');

			//Generando valor de la lista desplegable del estado de usuario
			var statedSelected = ($("#form-user #state option[value='" + data.state + "']").length > 0);

			if(statedSelected) {
				$("#form-user #state option").each(function() {
					if($(this).val() == data.state) {
						$(this).attr('selected', 'selected');
					}
				});
			}

			//Generando el valor de la lista desplegable de Estado en plan de minutos
			//var selected = new Option(data.minutes_state, data.minutes_state, false, true);
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

			modal.addClass('show');

		});
	}

	var addUser = function() {
		//$('#add_user').on('click', function(){

			document.getElementById('title-modal').innerHTML = "Añadir usuario:";

			if($('#form-user #name').val() != '' || $('#form-user #name').val() != ' ') {
				$('#form-user #name').val('');
			}
			if($('#form-user #lastname').val() != '' || $('#form-user #lastname').val() != ' ') {
				$('#form-user #lastname').val('');
			}
			if($('#form-user #email').val() != '' || $('#form-user #email').val() != ' ') {
				$('#form-user #email').val('');
			}
			if($('#form-user #document').val() != '' || $('#form-user #document').val() != ' ') {
				$('#form-user #document').val('');
			}
			if($('#form-user #phone').val() != '' || $('#form-user #phone').val() != ' ') {
				$('#form-user #phone').val('');
			}

			$('#form-user #state option[value="activo"]').attr('selected', 'selected');

			$('#form-user #minutes option[value="activo"]').removeAttr('disabled');
			$('#form-user #minutes option[value="activo"]').attr('selected','selected');
			$('#form-user #minutes option[value="inactivo"]').removeAttr('disabled');
			$('#form-user #minutes option[value="sin registrar"]').attr('disabled','disabled');

			var save = $('#form-user #save').val('Añadir usuario'); //Generando valor del Botón de guardar
			var action = $('#form-user #action').val('agregar');

			modal.addClass('show');

		//});
	}

	var sendForm = function() {
		$('#form-user').on('submit', function(e){
			e.preventDefault();
			
			var form = $(this).serialize();

			$.ajax({
				method: "POST",
				url: com6Scripts.pluginsUrl + "/comuna6/inc/admin/assets/class.Users.php",
				data: form
			}).done(function(info){
				var json_info = JSON.parse( info );

				modal.removeClass('show');
				$('.datatable').DataTable().ajax.reload();
				confirm(json_info);
			});
		});
	}



	var confirm = function(info) {

		switch(info.response) {
			case "exists":
				document.getElementById('text-alert').innerHTML = "El usuario con número de documento <b>" + $('#form-user #document').val() + "</b> ya existe." ;
				document.getElementById('btn-alert').innerHTML = "Regresar e intentar de nuevo";

				$('#btn-alert').on('click', function() {
					alert.removeClass('show');
					modal.addClass('show');
				});
			break;

			case "error":
				document.getElementById('text-alert').innerHTML = "Ha ocurrido un error al intentar registrar al usuario <b>" + $('#form-user #name').val() + " " + $('#form-user #lastname').val() + "</b>." ;
				document.getElementById('btn-alert').innerHTML = "Cerrar e intentar de nuevo";
				$('#btn-alert').on('click', function() {
					alert.removeClass('show');
					modal.removeClass('show');
				});
				listar();
			break;

			case "create":
				document.getElementById('text-alert').innerHTML = "El usuario <b>" + $('#form-user #name').val() + "</b> con número de documento " + $('#form-user #document').val() + ", se ha creado correctamente." ;
				document.getElementById('btn-alert').innerHTML = "Cerrar y actualizar listado";
				$('#btn-alert').on('click', function() {
					alert.removeClass('show');
					modal.removeClass('show');
				});
				listar();
			break;

			case "modify":
				document.getElementById('text-alert').innerHTML = "El usuario <b>" + $('#form-user #name').val() + " " + $('#form-user #lastname').val() + "</b> ha sido modificado éxitosamente." ;
				document.getElementById('btn-alert').innerHTML = "Cerrar y actualizar listado";
				$('#btn-alert').on('click', function() {
					alert.removeClass('show');
					modal.removeClass('show');
				});
				listar();
			break;
		}

		alert.addClass('show');

	}

});