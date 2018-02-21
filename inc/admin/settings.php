<?php 

	class SettingsCom6 {

		public function __construct() {

			add_action('admin_menu', array($this, 'registerAllSettings'));

		}

		public function registerAllSettings() {

			add_menu_page(
				__('Todos los usuarios RCC6', COM6_NS),
				__('Usuarios RCC6', COM6_NS),
				'administrator',
				'all_users',
				array($this, 'getAllUsers')
			);

		}

		public function getAllUsers() {

			require_once('settings/view-users.php');

		}

	}

 ?>