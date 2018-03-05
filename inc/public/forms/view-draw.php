<form name="view-draws-form" id="view-draws-form" method="post" action="<?php echo plugins_url(); ?>/comuna6/inc/public/assets/users.Class.php">

	<div class="row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" placeholder="N&uacute;mero de documento de identidad...">
	</div>

	<div class="row">
		<input type="hidden" id="action" name="action" value="ver-numeros">
		<input type="submit" id="save" class="button" value="Añadir usuario">
	</div>

</form>