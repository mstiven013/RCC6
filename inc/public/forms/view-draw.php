<form name="view-draws-form" id="view-draws-form" method="post">

	<div class="row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" placeholder="N&uacute;mero de documento de identidad...">
	</div>

	<div class="row">
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