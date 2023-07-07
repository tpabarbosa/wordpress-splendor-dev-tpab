<?php
require_once __DIR__ . './vendor/autoload.php';

use SplendorDevTpab\Main;

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://tpabarbosa.github.io
 * @since             1.0.0
 * @package           Splendor_Dev_Tpab
 *
 * @wordpress-plugin
 * Plugin Name:       splendor-dev-tpab
 * Plugin URI:
 * Description:       Plugin para WordPress com as seguintes funcionalidades:
* 1. Shortcode [splendor_fullstack];
* 2. Filters/Hooks [splendor_test];
* 3. Controlador POST wp-json/v2/code
 * Version:           1.0.0
 * Author:            Tatiana Barbosa
 * Author URI:        https://tpabarbosa.github.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       splendor-dev-tpab
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
define('SPLENDOR_DEV_TPAB_VERSION', '1.0.0');

/**
 * The personal code for use in plugin.
 *
 * @since    1.0.0
 */
define('SPLENDOR_DEV_TPAB_CODIGO_PESSOAL', '0082');


/**
 * The core plugin class that is used to define hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/main.php';

/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function run_splendor_dev_tpab()
{
    $plugin = Main::init();
    $plugin->run();
}


run_splendor_dev_tpab();
