<?php 

	class addScripts {

		public function __construct() {

			add_action( 'admin_enqueue_scripts', array($this, 'dataTables') );
			add_action( 'admin_enqueue_scripts', array($this, 'adminScripts') );

		}

		public function dataTables() {
			wp_register_style('datatables.min.css', COM6_DIR . 'inc/admin/assets/dataTables/css/datatables.min.css', array(), false, 'all');
			wp_enqueue_style('datatables.min.css');
			wp_register_script( 'datatables.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/datatables.min.js' );
			wp_enqueue_script( 'datatables.min.js' );
			wp_register_script( 'dataTables.buttons.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/dataTables.buttons.min.js' );
			wp_enqueue_script( 'dataTables.buttons.min.js');
			wp_register_script( 'buttons.flash.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/buttons.flash.min.js' );
			wp_enqueue_script( 'buttons.flash.min.js');
			wp_register_script( 'buttons.html5.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/buttons.html5.min.js' );
			wp_enqueue_script( 'buttons.html5.min.js');
			wp_register_script( 'buttons.print.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/buttons.print.min.js' );
			wp_enqueue_script( 'buttons.print.min.js');
			wp_register_script( 'jszip.min.js', COM6_DIR . 'inc/admin/assets/dataTables/js/jszip.min.js' );
			wp_enqueue_script( 'jszip.min.js' );
		}

		public function adminScripts() {
			wp_register_script( 'view-users.js', COM6_DIR . 'inc/admin/assets/js/view-users.js' );
			wp_enqueue_script( 'view-users.js' );
			wp_localize_script('view-users.js', 'com6Scripts', array(
			    'pluginsUrl' => plugins_url(),
			));
			wp_register_style( 'com6_admin_styles.css', COM6_DIR . 'inc/admin/assets/css/com6_admin_styles.css' );
			wp_enqueue_style( 'com6_admin_styles.css' );
		}

	}

 ?>