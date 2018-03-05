<form name="reactivate-form" id="reactivate-form" method="post" action="<?php echo plugins_url(); ?>/comuna6/inc/public/assets/users.Class.php">

	<div class="row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" placeholder="N&uacute;mero de documento de identidad...">
	</div>

	<div class="row">
		<input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
		<input type="hidden" id="action" name="action" value="reactivar-usuario">
		<input type="submit" id="save" class="button" value="Añadir usuario">
	</div>

</form>

<!--Popup - Formulario de modificar usuario-->
<div class="com6-alert">
	<div class="alert-bg"></div>
	<div class="content-alert">
		<p id="text-alert"></p>
		<div id="numbers"></div>
		<p><a id="btn-alert" class="button com6_btn-close">Cerrar</a></p>
	</div>
</div>