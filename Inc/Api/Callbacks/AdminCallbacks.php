<?php
	/**
	 * @package  NBSPAutomat
	 */

	namespace Inc\Api\Callbacks;

	use Inc\Base\BaseController;

	class AdminCallbacks extends BaseController {
		public function adminDashboard() {
			return require_once( "$this->plugin_path/templates/nbsp-automat-dashboard.php" );
		}

		public function adminSettings() {
			return require_once( "$this->plugin_path/templates/nbsp-automat-settings.php" );
		}

		public function mmApiKey() {
			$value = esc_attr( get_option( 'mm_api_key' ) );
			echo '<input type="text" class="regular-text" name="mm_api_key" value="' . $value . '" placeholder="Enter your API KEY here">';
		}

		public function alecadddOptionsGroup( $input ) {
			return $input;
		}

		public function alecadddAdminSection() {
			echo 'We use Custom Search API partly in some queries of specific miners. They can help us.';
		}


	}
