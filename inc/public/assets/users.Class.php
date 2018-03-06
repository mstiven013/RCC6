<?php 

	require_once("../../../../../../wp-load.php");

	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$code = (isset($_POST['code'])) ? $_POST['code'] : '';
	$name = (isset($_POST['name'])) ? $_POST['name'] : '';
	$lastname = (isset($_POST['lastname'])) ? $_POST['lastname'] : '';
	$email = (isset($_POST['email'])) ? $_POST['email'] : '';
	$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
	$document = (isset($_POST['document'])) ? $_POST['document'] : '';
	$date = (isset($_POST['date'])) ? $_POST['date'] : '';
	$info = [];

	switch ($action) {
		case 'registro-minutos':
			
			$user = new com6_publicUsers();
			$user->regMinutes($name,$lastname,$document,$email,$phone,$date);

			break;
		
		case 'reactivar-usuario':
			
			$user = new com6_publicUsers();
			$user->reactivate($document,$date);

			break;

		case 'registro-rifa':

			$user = new com6_publicUsers();
			$user->regDraw($code,$name,$lastname,$document,$email,$phone,$date);

			break;

		case 'ver-numeros':

			$user = new com6_publicUsers();
			$user->viewDraw($document);

			break;
	}

	class com6_publicUsers {

		public function regMinutes($name,$lastname,$document,$email,$phone,$date) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "SELECT id FROM $table WHERE document='$document'";
			$query = $wpdb->get_results($sql);

			if($query) {

				$sql = "UPDATE $table SET state='activo',minutes_state='activo' WHERE document='$document'";
				$query = $wpdb->query($sql);

				if($sql) {
					$info['response'] = 'activated';
				} else {
					$info['response'] = 'error-minutes';
				}

			} else {
				
				$sql = "INSERT INTO $table (firstname,lastname,document,state,email,phone,date_register,minutes_state) VALUES ('$name','$lastname','$document','activo','$email','$phone','$date','activo')";
				$query = $wpdb->query($sql);

				if($query) {
					$info['response'] = 'activated';
				} else {
					$info['response'] = 'error-minutes';
				}

			}

			echo json_encode($info);

			$wpdb->close();

		}

		public function reactivate($document,$date) {
			
			global $wpdb;
			$table = $wpdb->prefix . 'com6_users';

			$sql = "SELECT id FROM $table WHERE document='$document'";
			$query = $wpdb->get_results($sql);

			if($query) {
				$sql = "UPDATE $table SET state='activo',date_register='$date' WHERE document='$document'";
				$query = $wpdb->query($sql);
				
				if($query) {
					$info['response'] = 'reactivated';
				} else {
					$info['response'] = 'reactivated';
				}
			} else {
				$info['response'] = 'error-activated';
			}

			echo json_encode($info);

			$wpdb->close();

		}

		public function regDraw($code,$name,$lastname,$document,$email,$phone,$date) {

			global $wpdb;
			$tableDraw = $wpdb->prefix . 'com6_draws';
			$tableUsers = $wpdb->prefix . 'com6_users';

			$sql = "SELECT number_draw,document FROM $tableDraw WHERE code_number='$code'";
			$query = $wpdb->get_results($sql, 'ARRAY_A');

			if($query) {

				foreach ($query as $queryCode) {

					if($queryCode['document'] == '') {
						$availability = 'valid';
						$info['number'] = $queryCode['number_draw'];
					} else {
						$availability = 'invalid';
					}
				}

				if($availability == 'invalid') {

					$info['response'] = 'code-invalid';

				} else {
					$sql = "SELECT state FROM $tableUsers WHERE document='$document'";
					$query = $wpdb->get_results($sql, 'ARRAY_A');

					if($query) {

						foreach ($query as $state) {
							if($state['state'] == 'inactivo') {
								$info['response'] = 'user-inactive';
							} else {
								$sql = "UPDATE $tableDraw SET document='$document' WHERE code_number='$code'";
								$query = $wpdb->query($sql);

								if($query) {
									$info['response'] = 'document-added';
								} else {
									$info['response'] = 'error-added';
								}
							}
						}

					} else {
						
						$sql = "INSERT INTO $tableUsers (firstname,lastname,document,state,email,phone,date_register,minutes_state) VALUES ('$name','$lastname','$document','activo','$email','$phone','$date','sin registrar')";
						$query = $wpdb->query($sql);

						if($query) {
							$sql = "UPDATE $tableDraw SET document='$document' WHERE code_number='$code'";
							$query = $wpdb->query($sql);

							if($query) {
								$info['response'] = 'document-added';
							} else {
								$info['response'] = 'error-added';
							}
						}

					}
				}

			} else {

				$info['response'] = 'no-code';

			}

			echo json_encode($info);

			$wpdb->close();

		}

		public function viewDraw($document) {

			global $wpdb;
			$tableDraw = $wpdb->prefix . 'com6_draws';
			$tableUsers = $wpdb->prefix . 'com6_users';

			$sql = "SELECT firstname,lastname FROM $tableUsers WHERE document='$document'";
			$query = $wpdb->get_results($sql, 'ARRAY_A');

			if($query) {
				foreach ($query as $user) {
					$info['name'] = $user['firstname'];
				}

				$sql = "SELECT number_draw FROM $tableDraw WHERE document='$document'";
				$query = $wpdb->get_results($sql, 'ARRAY_A');

				if($query) {
					$info['numbers'] = [];

					foreach ($query as $draw) {
						$numero = $draw['number_draw'];
						array_push($info['numbers'], $numero);			
					}

					$info['response'] = 'view-draws';
				} else {
					$info['response'] = 'noregistered-code';
				}

			} else {

				$info['response'] = 'user-noexist';

			}

			echo json_encode($info);

			$wpdb->close();

		}

	}

 ?>