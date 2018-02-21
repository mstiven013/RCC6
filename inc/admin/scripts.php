<?php 

	class addScripts {

		public function __construct() {

			add_action( 'admin_enqueue_scripts', array($this, 'dataTables') );
			add_action( 'admin_enqueue_scripts', array($this, 'adminScripts') );

		}

		public function dataTables() {
			wp_register_style('datatables.min.css', COM6_DIR . 'inc/libs/dataTables/css/datatables.min.css', array(), false, 'all');
			wp_enqueue_style('datatables.min.css');
			wp_register_script( 'datatables.min.js', COM6_DIR . 'inc/libs/dataTables/js/datatables.min.js' );
			wp_enqueue_script( 'datatables.min.js' );
			
		}

		public function adminScripts() {
			wp_register_script( 'view-users.js', COM6_DIR . 'inc/assets/js/view-users.js' );
			wp_enqueue_script( 'view-users.js' );
			wp_localize_script('view-users.js', 'com6Scripts', array(
			    'pluginsUrl' => plugins_url(),
			));
			wp_register_style( 'com6_admin_styles.css', COM6_DIR . 'inc/assets/css/com6_admin_styles.css' );
			wp_enqueue_style( 'com6_admin_styles.css' );
		}

		public function publicScripts() {
			
		}

	}

 ?>