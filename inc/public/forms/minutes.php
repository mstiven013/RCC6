<form name="minutes-form" id="minutes-form" class="com6_form" method="post" action="<?php echo plugins_url(); ?>/comuna6/inc/public/assets/users.Class.php">
	
	<div class="com6_row">
		<div class="column-2">
			<label for="name">Nombres:</label>
			<input type="text" name="name" id="name" required="" placeholder="Nombre...">
		</div>
		<div class="column-2">
			<label for="lastname">Apellidos:</label>
			<input type="text" name="lastname" id="lastname" required="" placeholder="Apellidos...">
		</div>
	</div>

	<div class="com6_row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" autocomplete="off" maxlength="10" placeholder="N&uacute;mero de documento de identidad...">
		<p id="document-error"></p>
	</div>

	<div class="com6_row">
		<div class="column-2">
			<label for="email">Correo electrónico:</label>
			<input type="text" name="email" id="email" required="" placeholder="Correo electr&oacute;nico...">
		</div>
		<div class="column-2">
			<label for="phone">Teléfono/Celular:</label>
			<input type="text" name="phone" id="phone" required="" placeholder="Tel&eacute;fono/Celular...">
		</div>
	</div>

	<div class="com6_row terms-conditions-row">
		<input type="checkbox" name="terms-conditions" id="terms-conditions" value="acepted"> <label id="label-check" for="terms-conditions">Acepto los términos y condiciones</label>
	</div>

	<div class="com6_row">
		<p id="global-error"></p>
	</div>

	<div class="com6_row">
		<input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
		<input type="hidden" id="action" name="action" value="registro-minutos">
		<input type="button" id="btn-register" class="button" value="Registrarme">
	</div>

	<!--Popup - Formulario de modificar usuario-->
	<div class="com6-alert">
		<div class="alert-bg"></div>
		<div class="content-alert">
			<div class="important-note">
				<p><span class="required">NOTA IMPORTANTE:</span></p>
				<p>Asegurese de que los datos que est&aacute; ingresando sean reales, ya que en caso de algún concurso, rifa o premio, se entregar&aacute; el premio &uacute;nicamente a la persona con qui&eacute;n concuerden estos datos.</p>
			</div>
			<p id="text-alert"></p>
			<p><a id="btn-alert" class="button com6_btn-close"></a> <input type="submit" id="save" name="save" class="button" value="Registrar"></p>
		</div>
	</div>

</form>