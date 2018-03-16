<form name="view-draws-form" id="view-draws-form" class="com6_form" method="post">

	<div class="com6_row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" autocomplete="off" maxlength="10" placeholder="N&uacute;mero de documento de identidad...">
		<p id="document-error"></p>
	</div>

	<div class="com6_row terms-conditions-row">
		<input type="checkbox" name="terms-conditions" id="terms-conditions" value="acepted"> <label id="label-check" for="terms-conditions">Acepto los términos y condiciones</label>
	</div>

	<div class="com6_row">
		<input type="hidden" id="action" name="action" value="ver-numeros">
		<input type="submit" id="save" class="button" value="Ver numeros registrados">
	</div>

</form>

<!--Popup - Formulario de modificar usuario-->
<div id="com6-global-alert" class="com6-alert">
	<div class="alert-bg"></div>
	<div class="content-alert">
		<p id="text-alert"></p>
		<ul id="numbers"></ul>
		<p><a id="btn-alert" class="button com6_btn-close"></a> <input type="button" id="btn-send-email" class="button" value="Enviar al correo"></p>
	</div>
</div>

<!--Popup - Enviar al correo-->
<div id="com6-email-alert" class="com6-alert">
	<div class="alert-bg"></div>
	<div class="content-alert">
		<form method="post" id="mail-view-draw" name="mail-view-draw">
		    <label>Escribe tu correo electr&oacute;nico</label>
		    <input type="email" name="email" id="email" required="required" autocomplete="off" placeholder="Ejemplo: tucorreo@gmail.com">
		    <input type="hidden" id="document" name="document">
		    <input type="hidden" id="action" name="action" value="view-draws">
		    <p><input type="submit" class="button" id="send" value="Enviar información"></p>
		</form>
		<div class="response">
		    <p id="text-response"></p>
		    <a id="btn-alert" class="button com6_btn-close">Cerrar</a>
		</div>
	</div>
</div>