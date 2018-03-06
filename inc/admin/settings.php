<?php 

	class SettingsCom6 {

		public function __construct() {

			add_action('admin_menu', array($this, 'registerAllSettings'));
			add_action('admin_menu', array($this, 'registerCodesDraws'));

		}

		public function registerAllSettings() {

			add_menu_page(
				__('Usuarios RCC6', COM6_NS),
				__('Usuarios RCC6', COM6_NS),
				'administrator',
				'all_users',
				array($this, 'getAllUsers')
			);

		}

		public function getAllUsers() {

			require_once('settings/view-users.php');

		}

		public function registerCodesDraws() {

			add_submenu_page(
				'all_users',
				__('C&oacute;digos de rifa', COM6_NS),
				__('C&oacute;digos de rifa', COM6_NS),
				'administrator',
				'all_codes_draw',
				array($this, 'getAllCodes')
			);

		}

		public function getAllCodes() {

			require_once('settings/view-draws.php');

		}

	}

 ?>