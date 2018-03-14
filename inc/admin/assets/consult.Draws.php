<?php 

	require_once("../../../../../../wp-load.php");

	global $wpdb;

	$table = $wpdb->prefix . 'com6_draws';
	$tableU = $wpdb->prefix . 'com6_users';

	$sql = "SELECT $table.number_draw,$table.code_number,$table.document,$table.commerce,$tableU.firstname,$tableU.lastname,$tableU.phone FROM $table INNER JOIN $tableU ON $table.document=$tableU.document";

	$query = $wpdb->get_results($sql);

	$data = array(
				'data' => $query
			);

	echo json_encode($data);

 ?>