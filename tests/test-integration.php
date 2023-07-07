<?php
/**
 * Class IntegrationTest
 *
 * @package Splendor_Dev_Tpab
 */

/**
 * Integration test case.
 */
class IntegrationTest extends WP_UnitTestCase
{

    function test_wordpress_and_plugin_are_loaded()
    {

        $this->assertTrue(function_exists('do_action'));
        $this->assertTrue(function_exists('run_splendor_dev_tpab'));
        $this->assertTrue(class_exists('SplendorDevTpab\\Main'));
    }

    function test_codigo_pessoal_is_defined_with_correct_value()
    {
        $this->assertTrue(defined('SPLENDOR_DEV_TPAB_CODIGO_PESSOAL'));
        $this->assertEquals(SPLENDOR_DEV_TPAB_CODIGO_PESSOAL, '0082');
    }
}
