<form name="draws-form" id="draws-form" method="post" action="<?php echo plugins_url(); ?>/comuna6/inc/public/assets/users.Class.php">

	<div class="row">
		<label for="code">C&oacute;digo de la boleta:</label>
		<input type="text" name="code" id="code" required="" autocomplete="off" placeholder="C&oacute;digo de la boleta...">
	</div>

	<div class="row">
		<label for="name">Nombres:</label>
		<input type="text" name="name" id="name" required="" placeholder="Nombre...">
	</div>

	<div class="row">
		<label for="lastname">Apellidos:</label>
		<input type="text" name="lastname" id="lastname" required="" placeholder="Apellidos...">
	</div>

	<div class="row">
		<label for="document">Documento de identidad:</label>
		<input type="text" name="document" id="document" required="" placeholder="N&uacute;mero de documento de identidad...">
	</div>

	<div class="row">
		<label for="email">Correo electrónico:</label>
		<input type="text" name="email" id="email" required="" placeholder="Correo electr&oacute;nico...">
	</div>

	<div class="row">
		<label for="phone">Teléfono/Celular:</label>
		<input type="text" name="phone" id="phone" required="" placeholder="Tel&eacute;fono/Celular...">
	</div>

	<div class="row">
		<input type="hidden" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
		<input type="hidden" id="action" name="action" value="registro-rifa">
		<input type="submit" id="save" class="button" value="Añadir usuario">
	</div>

</form>