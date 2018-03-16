<form name="draws-form" id="draws-form" class="com6_form" method="post" action="<?php echo plugins_url(); ?>/comuna6/inc/public/assets/users.Class.php">

	<div class="com6_row">
		<label for="code">C&oacute;digo de la boleta:</label>
		<input type="text" name="code" id="code" required="" autocomplete="off" placeholder="C&oacute;digo de la boleta...">
		<p id="code-response"></p>
	</div>

	<div class="com6_row">
		<label for="code">Comercio donde adquiri&oacute; el c&oacute;digo:</label>
		<input type="text" name="commerce" id="commerce" required="" placeholder="Comercio donde adquiri&oacute; el c&oacute;digo...">
	</div>

	<div class="com6_row">
		<label for="name">Nombres:</label>
		<input type="text" name="name" id="name" required="" placeholder="Nombre...">
	</div>

	<div class="com6_row">
		<label for="lastname">Apellidos:</label>
		<input type="text" name="lastname" id="lastname" required="" placeholder="Apellidos...">
	</div>

	<div class="com6_row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" autocomplete="off" maxlength="10" placeholder="N&uacute;mero de documento de identidad...">
		<p id="document-error"></p>
	</div>

	<div class="com6_row">
		<label for="email">Correo electrónico:</label>
		<input type="text" name="email" id="email" required="" placeholder="Correo electr&oacute;nico...">
	</div>

	<div class="com6_row">
		<label for="phone">Teléfono/Celular:</label>
		<input type="phone" name="phone" id="phone" required="" placeholder="Tel&eacute;fono/Celular...">
	</div>

	<div class="com6_row terms-conditions-row">
		<input type="checkbox" name="terms-conditions" id="terms-conditions" value="acepted"> <label id="label-check" for="terms-conditions">Acepto los términos y condiciones</label>
	</div>

	<div class="com6_row">
		<p id="global-error"></p>
	</div>

	<div class="com6_row">
		<input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
		<input type="hidden" id="action" name="action" value="registro-rifa">
		<input type="button" id="btn-register" class="button" value="Registrar c&oacute;digo">
	</div>

	<!--Popup - Formulario de modificar usuario-->
	<div id="com6-global-alert" class="com6-alert">
		<div class="alert-bg"></div>
		<div class="content-alert">
			<div class="important-note">
				<p><span class="required">NOTA IMPORTANTE:</span></p>
				<p>Asegurese de que los datos que est&aacute; ingresando sean reales, ya que en caso de algún concurso, rifa o premio, se entregar&aacute; el premio &uacute;nicamente a la persona con qui&eacute;n concuerden estos datos.</p>
			</div>
			<p id="text-alert"></p>
			<p><a id="btn-alert" class="button com6_btn-close"></a> <input type="submit" id="save" name="save" class="button" value="Registrar"> <input type="button" id="btn-send-email" class="button" value="Enviar al correo"></p>
		</div>
	</div>

</form>

<!--Popup - Enviar al correo-->
<div id="com6-email-alert" class="com6-alert">
	<div class="alert-bg"></div>
	<div class="content-alert">
		<form method="post" id="mail-reg-draw" name="mail-reg-draw">
		    <label>Escribe tu correo electr&oacute;nico</label>
		    <input type="email" name="email" id="email" required="required" autocomplete="off" placeholder="Ejemplo: tucorreo@gmail.com">
		    <input type="hidden" id="code" name="code">
		    <input type="hidden" id="document" name="document">
		    <input type="hidden" id="action" name="action" value="reg-draws">
		    <p><input type="submit" class="button" id="send" value="Enviar información"></p>
		</form>
		<div class="response">
		    <p id="text-response"></p>
		    <a id="btn-alert" class="button com6_btn-close">Cerrar</a>
		</div>
	</div>
</div>