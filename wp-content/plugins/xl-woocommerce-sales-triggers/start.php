<?php
defined( 'ABSPATH' ) || exit;

/**
 * This file is to initiate XL core and to run some common methods and decide which XL core should run
 */

$this_current_version = '5.0';

if ( ! class_exists( 'XL_Common' ) ) {

	class XL_Common {

		public static $is_xl_loaded = false;
		public static $current_version = '5.0';

		public static function include_xl_core() {


			global $xl_ultimate_latest_core_all, $xl_ultimate_latest_core;

			/**
			 * Reset Loading of Core
			 */
			if ( ! is_null( $xl_ultimate_latest_core_all ) ) {

			}

			if ( isset( $xl_ultimate_latest_core_all['latest']['plugin_path'] ) && self::$is_xl_loaded === false ) {
				$get_global_path = $xl_ultimate_latest_core_all['latest']['plugin_path'] . '/xl/';

				/**
				 * Loading Core XL Files
				 */
				require_once $get_global_path . 'includes/class-xl-api.php';
				require_once $get_global_path . 'includes/class-xl-admin-notifications.php';
				require_once $get_global_path . 'includes/class-xl-opt-in-manager.php';
				require_once $get_global_path . 'includes/class-xl-addons.php';
				require_once $get_global_path . 'includes/class-xl-plugin-states.php';
				require_once $get_global_path . 'includes/class-xl-addon.php';
				require_once $get_global_path . 'includes/class-xl-licenses.php';
				require_once $get_global_path . 'includes/class-xl-support.php';
				require_once $get_global_path . 'includes/class-xl-process.php';
				require_once $get_global_path . 'includes/class-xl-deactivation.php';
				require_once $get_global_path . 'includes/class-xl-dashboard-loader.php';
				require_once $get_global_path . 'includes/class-xl-cache.php';
				require_once $get_global_path . 'includes/class-xl-transients.php';
				require_once $get_global_path . 'includes/class-xl-file-api.php';

				$xl_ultimate_latest_core = $xl_ultimate_latest_core_all['latest'];

				do_action( 'xl_loaded', $get_global_path );
				self::$is_xl_loaded = true;
			}
		}

		/**
		 * Deleting option key where add-ons are set up
		 * @deprecated
		 */
		public static function reset_latest_installed() {

		}

		/**
		 * Deleting option key where add-ons are set up
		 */
		public static function load_text_domain( $get_global_path ) {
			global $xl_ultimate_latest_core_all;
			if ( ! is_admin() ) {
				return;
			}
			load_plugin_textdomain( 'xlplugins', false, $get_global_path . 'languages/' );

			wp_localize_script( 'wp-util', 'xlplgins', array( 'core' => $get_global_path, 'version' => $xl_ultimate_latest_core_all['latest']['version'] ) );
		}
	}

}

//add_action( 'xl_loaded', array( 'XL_Common', 'load_text_domain' ), 10, 1 );

global $xl_ultimate_latest_core_all;

register_deactivation_hook( WCST_PLUGIN_BASENAME, array( 'XL_Common', 'reset_latest_installed' ) );


if ( ! $xl_ultimate_latest_core_all || count( $xl_ultimate_latest_core_all ) <= 0 ) {
	$xl_ultimate_latest_core_all                                                   = array();
	$xl_ultimate_latest_core_all['plugins']                                        = array();
	$xl_ultimate_latest_core_all['plugins'][ plugin_basename( WCST_PLUGIN_FILE ) ] = array(
		'version'     => $this_current_version,
		'plugin_path' => dirname( WCST_PLUGIN_FILE )
	);
} else {
	//if not registered yet
	if ( ! isset( $xl_ultimate_latest_core_all['plugins'][ plugin_basename( WCST_PLUGIN_FILE ) ] ) ) {
		$xl_ultimate_latest_core_all['plugins'][ plugin_basename( WCST_PLUGIN_FILE ) ] = array(
			'version'     => $this_current_version,
			'plugin_path' => dirname( WCST_PLUGIN_FILE )
		);
	}
}

//if not registered yet
if ( ! isset( $xl_ultimate_latest_core_all['latest'] ) ) {
	$xl_ultimate_latest_core_all['latest'] = array(
		'basename'    => plugin_basename( WCST_PLUGIN_FILE ),
		'version'     => $this_current_version,
		'plugin_path' => dirname( WCST_PLUGIN_FILE )
	);
} else {
	//if latest framework exists and have for the same plugin
	//if current version is same as the saved one
	if ( version_compare( $this_current_version, $xl_ultimate_latest_core_all['latest']['version'], '<' ) ) {
		//do nothing
	} else {


		$xl_ultimate_latest_core_all['latest'] = array(
			'basename'    => plugin_basename( WCST_PLUGIN_FILE ),
			'version'     => $this_current_version,
			'plugin_path' => dirname( WCST_PLUGIN_FILE )
		);
	}
}























