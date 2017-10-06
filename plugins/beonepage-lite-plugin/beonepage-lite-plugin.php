<?php
/*
Plugin Name: BeOnePage Lite Plugin
Description: This plugin is required for BeOnePage Lite theme.
Author:      BeTheme
Version:     1.0.0
Author URI:  http://betheme.me/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: beonepage
*/

class beOnePageLitePlugin {
    public static function init() {
        $class = __CLASS__;
		$plugin_file = basename( __FILE__ );
		$plugin_folder = basename( dirname( __FILE__ ) );
		$plugin_hook = "after_plugin_row_{$plugin_folder}/{$plugin_file}";

        new $class;
		add_action( $plugin_hook, array( 'beOnePageLitePlugin', 'beonepage_get_premium' ) );
    }

    public function __construct() {
		// Add Custom Menu plugin.
		require_once plugin_dir_path( __FILE__ ) . 'inc/custom-menu/array-column.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/custom-menu/menu-item-custom-field.php';

		// Add Custom Post Type plugin.
		require_once plugin_dir_path( __FILE__ ) . 'inc/cpt/CPT.php';
		require_once plugin_dir_path( __FILE__ ) . 'inc/cpt/portfolio-post-type.php';

		// Add Custom Meta Box 2 plugin.
		require_once plugin_dir_path( __FILE__ ) . 'inc/cmb2/CMB.php';
    }

	/**
	 * Add upgrade information to plugin page.
	 */
	public static function beonepage_get_premium() {
		echo '</tr><tr class="plugin-update-tr"><td colspan="5" class="plugin-update"><div class="update-message">' . beonepage_premium_info() . '</div></td></tr>';
	}
}
add_action( 'plugins_loaded', array( 'beOnePageLitePlugin', 'init' ) );

?>