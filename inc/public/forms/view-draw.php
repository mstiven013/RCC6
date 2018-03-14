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
<div class="com6-alert">
	<div class="alert-bg"></div>
	<div class="content-alert">
		<p id="text-alert"></p>
		<ul id="numbers"></ul>
		<p><a id="btn-alert" class="button com6_btn-close"></a></p>
	</div>
</div>