<?php


use SplendorDevTpab\Hooks;

/**
 * Class HooksTest
 *
 * @package Splendor_Dev_Tpab
 */

 /**
 * Hooks test case.
 */
class HooksTest extends WP_UnitTestCase
{
    protected $hooks;
    protected $user_id;

    protected function setUp(): void
    {
        $this->hooks = new Hooks();
        $this->hooks->set_datetime(new \DateTimeImmutable('2021-05-12 12:33:00'));
        $this->user_id = wp_insert_user(array('user_login'=>'test_user', 'user_pass'=> '123456'));
    }

    protected function tearDown(): void
    {
        wp_delete_user($this->user_id);
        $this->user_id = 0;
    }

    function test_shortcode_splendor_fullstack_not_logged_in_user()
    {

        $shortcode=$this->hooks->splendor_fullstack();

        $this->assertEquals($shortcode, 'Usuário não autenticado - 12/05/2021 12:33');
    }

    function test_shortcode_splendor_fullstack_logged_in_user()
    {

        wp_set_current_user($this->user_id);

        $shortcode=$this->hooks->splendor_fullstack();

        $this->assertEquals($shortcode, 'test_user - 12/05/2021 12:33');
    }

    function test_filter_splendor_test_can_add_personal_code()
    {
        $codigo_pessoas = array('1', '2', '3');

        $filter = $this->hooks->splendor_test($codigo_pessoas);

        $this->assertContains($this->hooks->get_personal_code(), $filter);
    }

    function test_filter_splendor_test_dont_add_code_if_it_exists()
    {
        $codigo_pessoas = array('1', '2', '3', '0082');

        $filter = $this->hooks->splendor_test($codigo_pessoas);

        $this->assertEquals($codigo_pessoas, $filter);
    }
}