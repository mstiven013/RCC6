<?php 

	class com6_Forms {

		public function __construct() {
			add_shortcode('registro_minutos', array($this, 'minutes'));
			add_shortcode('registro_rifa', array($this, 'draws'));
			add_shortcode('reactivar_usuario', array($this, 'reactivate'));
			add_shortcode('ver_numeros_rifa', array($this, 'viewDraw'));
		}

		public function minutes() {
			require_once 'forms/minutes.php';
		}

		public function draws() {
			require_once 'forms/draws.php';
		}

		public function reactivate() {
			require_once 'forms/reactivate.php';
		}

		public function viewDraw() {
			require_once 'forms/view-draw.php';
		}

	}

 ?>