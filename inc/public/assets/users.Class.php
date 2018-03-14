<?php 

	require_once("../../../../../../wp-load.php");

	$action = (isset($_POST['action'])) ? $_POST['action'] : '';
	$code = (isset($_POST['code'])) ? $_POST['code'] : '';
	$commerce = (isset($_POST['commerce'])) ? $_POST['commerce'] : '';
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
			$user->regDraw($code,$commerce,$name,$lastname,$document,$email,$phone,$date);

			break;

		case 'validate-code':
			
			$user = new com6_publicUsers();
			$user->validateCode($_POST['code']);

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

			$sql_select_user = "SELECT id FROM $table WHERE document='$document'";
			$query_select_user = $wpdb->get_results($sql_select_user);

			if($query_select_user) {

				$sql_update_user = "UPDATE $table SET firstname='$name',lastname='$lastname',state='activo',email='$email',phone='$phone',date_register='$date',minutes_state='activo' WHERE document='$document'";
				$query_update_user = $wpdb->query($sql_update_user);

				if($query_update_user) {
					$info['response'] = 'activated';
				} else {
					$info['response'] = 'activated';
				}

			} else {
				
				$sql_create_user = "INSERT INTO $table (firstname,lastname,document,state,email,phone,date_register,minutes_state) VALUES ('$name','$lastname','$document','activo','$email','$phone','$date','activo')";
				$query_create_user = $wpdb->query($sql_create_user);

				if($query_create_user) {
					$info['response'] = 'registered';
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

		public function validateCode($code) {

			global $wpdb;
			$table = $wpdb->prefix . 'com6_draws';

			$sql = "SELECT code_number,document FROM $table WHERE code_number='$code'";
			$query = $wpdb->get_results($sql, 'ARRAY_A');

			if($query) {
				foreach ($query as $code) {
					if($code['document'] == '') {
						$info['response'] = 'code-valid';
					} else {
						$info['response'] = 'code-registered';
					}
				}
			} else {
				$info['response'] = 'code-no-exist';
			}

			echo json_encode($info);

			$wpdb->close();

		}

		public function regDraw($code,$commerce,$name,$lastname,$document,$email,$phone,$date) {

			global $wpdb;
			$tableDraw = $wpdb->prefix . 'com6_draws';
			$tableUsers = $wpdb->prefix . 'com6_users';

			//Select state of user
			$sql_state_user = "SELECT state FROM $tableUsers WHERE document='$document'";
			$query_state_user = $wpdb->get_results($sql_state_user, 'ARRAY_A');

			//If exists this user
			if($query_state_user) {
				foreach ($query_state_user as $user_state) {
					$state = $user_state['state'];
				}

				if($state == 'activo') {
					//Select register of this code
					$sql_select_code = "SELECT number_draw,code_number,commerce,document FROM $tableDraw WHERE code_number='$code'";
					$query_select_code = $wpdb->get_results($sql_select_code, 'ARRAY_A');

					//If code exists
					if($query_select_code) {

						//Get number of this code
						foreach ($query_select_code as $codes) {
							$info['number'] = $codes['number_draw'];

							$documentCode = $codes['document'];
							$commerceCode = $codes['commerce'];
						}

						if($documentCode == '' && $commerceCode == '') {
							//Add document and commerce in $code register of database
							$sql_register_code = "UPDATE $tableDraw SET commerce='$commerce',document='$document' WHERE code_number='$code'";
							$query_register_code = $wpdb->query($sql_register_code);

							if($query_register_code) {
								$sql_update_user = "UPDATE $tableUsers SET firstname='$name',lastname='$lastname',state='activo',email='$email',phone='$phone',date_register='$date',minutes_state='activo' WHERE document='$document'";
								$query_update_user = $wpdb->query($sql_update_user);

								if($query_update_user) {
									$info['response'] = 'document-added';
								} else {
									$info['response'] = 'document-added';
								}
							} else {
								$info['response'] = 'error-added';
							}
						} else {
							$info['response'] = 'code-registered';
						}
					}

				} else {
					$info['response'] = 'user-inactive';
				}
			//If not exists this user
			} else {

				//Select register of this code
				$sql_select_code = "SELECT number_draw,code_number,commerce,document FROM $tableDraw WHERE code_number='$code'";
				$query_select_code = $wpdb->get_results($sql_select_code, 'ARRAY_A');

				//If code exists
				if($query_select_code) {

					//Get number of this code
					foreach ($query_select_code as $codes) {
						$info['number'] = $codes['number_draw'];

						$documentCode = $codes['document'];
						$commerceCode = $codes['commerce'];
					}

					if($documentCode == '' && $commerceCode == '') {
						//Add document and commerce in $code register of database
						$sql_register_code = "UPDATE $tableDraw SET commerce='$commerce',document='$document' WHERE code_number='$code'";
						$query_register_code = $wpdb->query($sql_register_code);

						if($query_register_code) {
							$sql_create_user = "INSERT INTO $tableUsers (firstname,lastname,document,state,email,phone,date_register,minutes_state) VALUES ('$name','$lastname','$document','activo','$email','$phone','$date','activo')";
							$query_create_user = $wpdb->query($sql_create_user);

							if($query_create_user) {
								$info['response'] = 'document-added';
							} else {
								$info['response'] = 'error-added';
							}
						} else {
							$info['response'] = 'error-added';
						}
					} else {
						$info['response'] = 'code-registered';
					}

				} else {
					$info['response'] = 'error-added';
				}
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