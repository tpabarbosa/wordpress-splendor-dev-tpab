<?php

use PHPUnit\Framework\TestCase;
use SplendorDevTpab\Loader;
use SplendorDevTpab\Main;

/**
 * Class MainTest
 *
 * @package Splendor_Dev_Tpab
 */

/**
 * Main test case.
 */
class MainTest extends TestCase
{

    protected $loader;

    protected function setUp(): void
    {
        $this->loader = $this->createMock(Loader::class);
    }

    function test_can_return_plugin_name_and_version()
    {
        $main = Main::init();
        $this->assertEquals($main->get_plugin_name(), 'splendor-dev-tpab');
        $this->assertEquals($main->get_version(), '1.0.0');
    }

    function test_loader_is_defined()
    {
        $main = Main::init();
        $this->assertInstanceOf(Loader::class, $main->get_loader());
    }

    function test_can_call_loader_run()
    {

        $this->loader->expects($this->once())
            ->method('run');

        $main = new Main($this->loader);

        $main->run();
    }
    function test_adds_shortcode_splendor_fullstack()
    {

        $this->loader->expects($this->once())
            ->method('add_shortcode')
            ->with('splendor_fullstack');

        $main = new Main($this->loader);

        $main->run();
    }

    function test_adds_filter_splendor_test()
    {

        $this->loader->expects($this->once())
            ->method('add_filter')
            ->with('splendor_test');

        $main = new Main($this->loader);

        $main->run();
    }
}
