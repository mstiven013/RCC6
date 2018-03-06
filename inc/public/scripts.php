<?php 

	class com6_publicScripts {

		public function __construct() {
			add_action('wp_enqueue_scripts',array($this, 'addScripts'));
		}

		public function addScripts() {

			wp_register_script( 'com6_public_scripts.js', COM6_DIR . 'inc/public/assets/js/com6_public_scripts.js', array(), false, true );
			wp_enqueue_script( 'com6_public_scripts.js' );
			wp_localize_script('com6_public_scripts.js', 'com6Scripts', array('pluginsUrl' => plugins_url(), 'siteUrl' => get_site_url()));

			//Bootstrap styles
		    wp_register_style('com6_public_styles.css',  COM6_DIR . 'inc/public/assets/css/com6_public_styles.css', array(), false, 'all');
		    wp_enqueue_style('com6_public_styles.css');

		}

	}

 ?>