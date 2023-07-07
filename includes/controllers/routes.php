<?php
namespace SplendorDevTpab\Controllers;

use Exception;
use SplendorDevTpab\Traits\ParseDateTimeTrait;
use SplendorDevTpab\Traits\PersonalCodeTrait;
use WP_Error;
use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Server;

class Routes extends WP_REST_Controller
{
    use PersonalCodeTrait, ParseDateTimeTrait;

    public function __construct()
    {
        $this->set_personal_code();
    }

    /**
    * Register the plugin REST API endpoints.
    *
    * @since    1.0.0
    * @throws Exception If the constant SPLENDOR_DEV_TPAB_CODIGO_PESSOAL is not defined.
    * @return
    */
    public function register_routes()
    {

        //wp-json/v2/personal-code
        $version = '2';
        $namespace = 'v' . $version;
        $base = 'personal-code';

        //POST
        register_rest_route($namespace, '/' . $base, array(
            'methods' => WP_REST_Server::CREATABLE,
            'callback' => array($this,'verify_personal_code'),
            'permission_callback' => '__return_true',
            'args' => array(
                'codigo' => array(
                    'type' => array('string', 'number'),
                    'required' => true,
                    'description' => 'Código pessoal a ser verificado', 'splendor-dev-tpab',
                ),
            ),
        ));
    }

    /**
     * The POST API controller for the endpoint wp-json/v2/code to verify the personal code.
     *
     * @param WP_REST_Request $request The request object.
     * @return WP_REST_Response|WP_Error
     * @since    1.0.0
     */
    public function verify_personal_code(WP_REST_Request $request)
    {
        $param = $request->get_param('codigo');
        if ($param == $this->personal_code) {
            $data = array(
            "status" => true,
            "data" => $this->parse_date('d/m/Y H:i'),
            "codigo" => $this->personal_code
            );

            return rest_ensure_response($data);
        } else {
            return new WP_Error('rest_forbidden', 'Erro 403: não autorizado');
        };
    }
}
