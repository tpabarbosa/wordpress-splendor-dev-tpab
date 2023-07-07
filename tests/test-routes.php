<?php


use SplendorDevTpab\Controllers\Routes;

/**
 * Class RoutesTest
 *
 * @package Splendor_Dev_Tpab
 */

/**
 * Routes test case.
 */
class RoutesTest extends WP_UnitTestCase
{
    protected $routes;
    protected $server;
    protected $namespaced_route = '/v2/personal-code';

    protected function setUp(): void
    {
        global $wp_rest_server;
        $this->routes = new Routes();
        $this->routes->set_datetime(new \DateTimeImmutable('2021-05-12 12:33:00'));

        $this->server = $wp_rest_server = new \WP_REST_Server;
        remove_all_actions('rest_api_init');
        add_action('rest_api_init', [$this->routes, 'register_routes']);
        do_action('rest_api_init');
    }


    public function test_personal_code_route_without_body()
    {
        $request = new WP_REST_Request('POST', $this->namespaced_route);
        $response = $this->server->dispatch($request);
        $this->assertEquals(400, $response->get_status());
    }

    public function test_personal_code_route_with_correct_code()
    {
        $request = new WP_REST_Request('POST', $this->namespaced_route);
        $request->set_param('codigo', SPLENDOR_DEV_TPAB_CODIGO_PESSOAL);
        $response = $this->server->dispatch($request);
        $data = $response->get_data();

        $this->assertEquals(200, $response->get_status());
        $this->assertEquals(true, $data['status']);
        $this->assertEquals(SPLENDOR_DEV_TPAB_CODIGO_PESSOAL, $data['codigo']);
        $this->assertEquals('12/05/2021 12:33', $data['data']);
    }

    public function test_personal_code_route_with_wrong_code()
    {
        $request = new WP_REST_Request('POST', $this->namespaced_route);
        $request->set_param('codigo', 'wrong_code');
        $response = $this->server->dispatch($request);
        $data = $response->get_data();
        $this->assertEquals(500, $response->get_status());
        $this->assertEquals('rest_forbidden', $data['code']);
        $this->assertEquals('Erro 403: não autorizado', $data['message']);
    }

    public function test_personal_code_route_with_wrong_code_type()
    {
        $request = new WP_REST_Request('POST', $this->namespaced_route);
        $request->set_param('codigo', true);
        $response = $this->server->dispatch($request);
        $data = $response->get_data();
        $this->assertEquals(400, $response->get_status());
        $this->assertEquals('rest_invalid_param', $data['code']);
        $this->assertEquals('Invalid parameter(s): codigo', $data['message']);
    }
}