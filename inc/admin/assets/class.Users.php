<?php 

	require_once("../../../../../../wp-load.php");

	$action = $_POST['action'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$state = $_POST['state'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$document = $_POST['document'];
	$minutes = $_POST['minutes'];
	$date = $_POST['date'];
	$info = [];

	switch ($action) {
		case 'modificar':
			
			$users = new com6_Users();
			$users->modify($name,$lastname,$document,$state,$email,$phone,$date,$minutes);

			break;
		
		case 'agregar':
			
			$users = new com6_Users();
			$users->add($name,$lastname,$document,$state,$email,$phone,$date,$minutes);

			break;
	}

	class com6_Users {

		public function modify($name,$lastname,$document,$state,$email,$phone,$date,$minutes) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "UPDATE $table SET firstname='$name',lastname='$lastname',document='$document',state='$state',email='$email',phone='$phone',date_register='$date',minutes_state='$minutes' WHERE document='$document'";

			$query = $wpdb->query($sql);

			$info['response'] = 'modify';
			
			echo json_encode($info);

			$wpdb->close();

		}

		public function add($name,$lastname,$document,$state,$email,$phone,$date,$minutes) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "SELECT id FROM $table WHERE document='$document'";
			$query = $wpdb->get_results($sql);

			if($query) {

				$info['response'] = 'exists';

			} else {

				$sql = "INSERT INTO $table (firstname,lastname,document,state,email,phone,date_register,minutes_state) VALUES ('$name','$lastname','$document','$state','$email','$phone','$date','$minutes')";
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

		public function inactive() {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$today = date('Y-m-d');
			$inactive = strtotime ( '-30 day' , strtotime ( $today ) ) ;
			$inactive = date ( 'Y-m-d' , $inactive );

			$sql = "SELECT state FROM $table WHERE date_register <= '$inactive'";
			$query = $wpdb->get_results($sql);

			if($query) {
				$sql = "UPDATE $table SET state='inactivo' WHERE date_register <= '$inactive'";
				echo 'si existe';
			} else {
				echo 'no existe';
			}

		}

	}

 ?>