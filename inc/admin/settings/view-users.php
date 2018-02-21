<div class="wrap com6_users">
	
	<h1><?php _e('Usuarios RCC6', COM6_NS); ?></h1>

	<input type="button" id="add_new" class="button" value="Agregar usuario">

	<!--Estructura de la tabla-->
	<table id="com6_users_table" class="datatable">
		<thead>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>No. de documento</th>
			<th>Correo electr&oacute;nico</th>
			<th>Estado en plan minutos</th>
			<th>Modificar</th>
		</thead>
		<tfoot>
			<th>Nombres</th>
			<th>Apellidos</th>
			<th>No. de documento</th>
			<th>Correo electr&oacute;nico</th>
			<th>Estado en plan minutos</th>
			<th>Modificar</th>
		</tfoot>
	</table>
	
	<!--Popup - Formulario de modificar usuario-->
	<div class="com6-modal">
		<div class="modal-bg"></div>
		<div class="container-modal">
			<div class="header-modal">
				<a class="com6_btn-close">x</a>
				<p>Modificar usuario:</p>
			</div>
			<form action="<?php echo COM6_DIR; ?>inc/libs/set.Users.php" id="form-user" name="form-modificar">
				<div class="content-modal">
					<div class="row">
						<div class="column col-2">
							<p><label for="name">Nombres:</label></p>
							<input type="text" name="name" id="name" required value="">
						</div>
						<div class="column col-2">
							<p><label for="lastname">Apellidos:</label></p>
							<input type="text" name="lastname" id="lastname" required value="">
						</div>
					</div>

					<div class="row">
						<div class="column col-2">
							<p><label for="email">Correo electr&oacute;nico:</label></p>
							<input type="text" name="email" id="email" required value="">
						</div>
						<div class="column col-2">
							<p><label for="phone">Teléfono/Celular:</label></p>
							<input type="text" name="phone" id="phone" required value="">
						</div>
					</div>

					<div class="row">
						<div class="column col-2">
							<p><label for="document">Documento de identidad:</label></p>
							<input type="text" name="document" id="document" required value="">
						</div>
						<div class="column col-2">
							<p><label for="minutes">Estado en el plan de minutos:</label></p>
							<select name="minutes" id="minutes" required>
								<option value="activo">Activo</option>
								<option value="inactivo">Inactivo</option>
								<option value="sin registrar">Sin registrar</option>
							</select>
						</div>
					</div>

					<div class="row">
						<input type="hidden" id="action" name="action">
						<input type="submit" class="button" value="Modificar usuario">
					</div>

				</div>
			</form>
		</div>
	</div>

</div>