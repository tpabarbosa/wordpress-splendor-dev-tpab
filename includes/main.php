<?php

namespace SplendorDevTpab;

use SplendorDevTpab\Controllers\Routes;
use SplendorDevTpab\Hooks;
use SplendorDevTpab\Loader;

/**
 * The file that defines the core plugin class
 *
 * @link       https://tpabarbosa.github.io
 * @since      1.0.0
 *
 * @package    Splendor_Dev_Tpab
 * @subpackage Splendor_Dev_Tpab/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Splendor_Dev_Tpab
 * @subpackage Splendor_Dev_Tpab/includes
 * @author     Tatiana Barbosa <tpabarbosa@gmail.com>
 */
class Main
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      SplendorDevTpab\Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies and set the hooks for the site.
     *
     * @since    1.0.0
     */
    public function __construct($loader)
    {
        if (defined('SPLENDOR_DEV_TPAB_VERSION')) {
            $this->version = SPLENDOR_DEV_TPAB_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'splendor-dev-tpab';

        $this->loader = $loader;
        $this->define_hooks();
        $this->define_routes();
    }

    /**
     * Register all of the hooks of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_hooks()
    {

        $plugin_hooks = new Hooks();

        $this->loader->add_shortcode('splendor_fullstack', $plugin_hooks, 'splendor_fullstack');

        $this->loader->add_filter('splendor_test', $plugin_hooks, 'splendor_test');
    }

    /**
     * Register all routes of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_routes()
    {

        $routes = new Routes();

        $this->loader->add_action('rest_api_init', $routes, 'register_routes');
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    SplendorDevTpab\Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Factory method to create a new instance of the class.
     *
     * @return void
     */
    public static function init()
    {
        return new self(new Loader());
    }
}
