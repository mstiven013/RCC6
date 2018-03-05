<?php 

	require_once("../../../wp-load.php");

	$table = $wpdb->prefix . 'com6_users';

	$sql = "SELECT id FROM $table WHERE document='103522878'";
	$query = $wpdb->get_results($sql);

	if($query) {
		$info['resp'] = 'si existe';
	} else {
		$sql = false;

		if($sql) {

			$info['resp'] = 'verdadero';

		} else {
			$info['resp'] = 'falso';
		}
	}

	echo json_encode($info);

 ?>