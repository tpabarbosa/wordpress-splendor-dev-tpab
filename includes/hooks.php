<?php
namespace SplendorDevTpab;

use SplendorDevTpab\Traits\ParseDateTimeTrait;
use SplendorDevTpab\Traits\PersonalCodeTrait;

/**
 * The functionality of the plugin.
 *
 * @link       https://tpabarbosa.github.io
 * @since      1.0.0
 *
 * @package    Splendor_Dev_Tpab
 * @subpackage Splendor_Dev_Tpab/public
 */

/**
 * The functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Splendor_Dev_Tpab
 * @subpackage Splendor_Dev_Tpab/public
 * @author     Tatiana Barbosa <tpabarbosa@gmail.com>
 */
class Hooks
{
    use PersonalCodeTrait, ParseDateTimeTrait;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct()
    {
        $this->set_personal_code();
    }

    /**
     * Register the 'splendor_fullstack' shortcode to the site. It returns the name of the logged in user and the current date.
     *
     * @since    1.0.0
     * @return string
     */
    public function splendor_fullstack()
    {
        $user = 'Usuário não autenticado';
        if (is_user_logged_in()) {
            $user = wp_get_current_user()->display_name;
        }

        $date = $this->parse_date('d/m/Y H:i');

        return "$user - $date";
    }

    /**
     * Register the 'splendor_test' filter to the site. It adds the personal code to the list of personal codes.
     *
     * @param array $codigo_pessoas The array containing a list of personal codes.
     * @return array
     * @since    1.0.0
     */
    public function splendor_test(array $codigo_pessoas)
    {
        if (!in_array($this->personal_code, $codigo_pessoas)) {
            $codigo_pessoas[] = $this->personal_code;
        }
        return $codigo_pessoas;
    }
}
