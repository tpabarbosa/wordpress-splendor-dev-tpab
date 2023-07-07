<?php

use PHPUnit\Framework\TestCase;
use SplendorDevTpab\Loader;

require __DIR__ . './StubClass.php';
/**
 * Class LoaderTest
 *
 * @package Splendor_Dev_Tpab
 */

/**
 * Loader test case.
 */
class LoaderTest extends TestCase
{
    protected $loader;

    protected $test_component;

    protected function setUp(): void
    {
        $this->loader = new Loader();

        $this->test_component = new StubClass();
    }

    function test_can_add_shortcode()
    {

        $this->loader->add_shortcode('test_shortcode', $this->test_component, 'test_method');

        $this->loader->run();

        $this->assertTrue(shortcode_exists('test_shortcode'));

        $this->assertEquals(do_shortcode('[test_shortcode]'), 'Hi ');
    }

    function test_can_add_filter()
    {

        $this->loader->add_filter('test_filter', $this->test_component, 'test_method', 5, 1);

        $this->loader->run();

        $this->assertTrue(has_filter('test_filter'));
        $this->assertEquals(has_filter('test_filter', [$this->test_component, 'test_method']), 5);

        $this->assertEquals(apply_filters('test_filter', 'Hello'), 'Hi Hello');
    }

    function test_can_add_action()
    {

        $this->loader->add_action('test_action', $this->test_component, 'test_method', 5, 1);

        $this->loader->run();

        $this->assertTrue(has_action('test_action'));
        $this->assertEquals(has_action('test_action', [$this->test_component, 'test_method']), 5);

        $this->assertEquals(do_action('test_action', 'Hello'), null);
    }
}
