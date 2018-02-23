<?php 

	require_once("../../../../../../wp-load.php");

	$action = $_POST['action'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$document = $_POST['document'];
	$minutes = $_POST['minutes'];
	$info = [];

	switch ($action) {
		case 'modificar':
			
			$users = new com6_Users();
			$users->modify($name,$lastname,$document,$email,$phone,$minutes);

			break;
		
		case 'agregar':
			
			$users = new com6_Users();
			$users->add($name,$lastname,$document,$email,$phone,$minutes);

			break;
	}

	class com6_Users {

		public function modify($name,$lastname,$document,$email,$phone,$minutes) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "UPDATE $table SET firstname='$name',lastname='$lastname',document='$document',email='$email',phone='$phone',minutes_state='$minutes' WHERE document='$document'";

			$query = $wpdb->query($sql);

			$info['response'] = 'modify';
			
			echo json_encode($info);

			$wpdb->close();

		}

		public function add($name,$lastname,$document,$email,$phone,$minutes) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "SELECT id FROM $table WHERE document='$document'";
			$query = $wpdb->get_results($sql);

			if($query) {

				$info['response'] = 'exists';

			} else {

				$sql = "INSERT INTO $table (firstname,lastname,document,email,phone,minutes_state) VALUES ('$name','$lastname','$document','$email','$phone','$minutes')";
				$query = $wpdb->query($sql);

				if(!$query) {
					$info['response'] = 'error';
				} else {
					$info['response'] = 'create';
				}

			}

			echo json_encode($info);

			$wpdb->close();

		}

	}

 ?>