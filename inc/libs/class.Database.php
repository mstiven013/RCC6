<?php 

	class Database {

		public function __construct() {

			add_action('init', array($this, 'createTables'));

		}

		public function createTables() {

			global $wpdb;

			//Table names
			$users = $wpdb->prefix . 'com6_users';
			$draws = $wpdb->prefix . 'com6_draws';

			$usersSql = "CREATE TABLE IF NOT EXISTS $users (
							id INT(255) AUTO_INCREMENT PRIMARY KEY,
							firstname VARCHAR(30) NOT NULL,
							lastname VARCHAR(30) NOT NULL,
							document VARCHAR(50) NOT NULL,
							email VARCHAR(50) NOT NULL,
							phone VARCHAR(50) NOT NULL,
							minutes_state VARCHAR(30) NOT NULL
						) CHARACTER SET utf8;";

			$drawsSql = "CREATE TABLE IF NOT EXISTS $draws (
							id INT(255) AUTO_INCREMENT PRIMARY KEY,
							number_draw VARCHAR(255) NOT NULL,
							code_number VARCHAR(255) NOT NULL,
							document VARCHAR(50) NOT NULL
						) CHARACTER SET utf8;";

			$wpdb->query($usersSql);
			$wpdb->query($drawsSql);

		}

	}

 ?>