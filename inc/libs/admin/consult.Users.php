<?php 

	require_once("../../../../../../wp-load.php");

	global $wpdb;

	$table = $wpdb->prefix . 'com6_users';

	$sql = "SELECT * FROM $table";

	$data = array(
				'data' => $wpdb->get_results($sql, ARRAY_A)
			);

	echo json_encode($data);

 ?>