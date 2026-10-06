<?php
/**
 * Plugin Development Unit Tests
 *
 * @package PluginDevelopment
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Test Cases for Plugin Development
 */
class Test_Plugin_Dev extends WP_UnitTestCase {
    /**
     * Test plugin activation
     */
    public function test_plugin_activation() {
        $this->assertTrue(function_exists('init_plugin_development'));
    }

    /**
     * Test admin menu registration
     */
    public function test_admin_menu_exists() {
        global $menu;
        $menu_found = false;

        if (!empty($menu)) {
            foreach ($menu as $item) {
                if ('plugin-development' === $item[5]) {
                    $menu_found = true;
                    break;
                }
            }
        }

        $this->assertTrue($menu_found);
    }

    /**
     * Test shortcode registration
     */
    public function test_shortcode_registered() {
        global $shortcode_tags;
        $this->assertArrayHasKey('plugin_dev_info', $shortcode_tags);
        $this->assertArrayHasKey('plugin_dev_features', $shortcode_tags);
    }

    /**
     * Test info shortcode output
     */
    public function test_info_shortcode_output() {
        $output = do_shortcode('[plugin_dev_info]');
        $this->assertStringContainsString('plugin-dev-widget', $output);
        $this->assertStringContainsString('Plugin Development Info', $output);
    }

    /**
     * Test features shortcode output
     */
    public function test_features_shortcode_output() {
        $output = do_shortcode('[plugin_dev_features]');
        $this->assertStringContainsString('plugin-dev-widget', $output);
        $this->assertStringContainsString('Clean plugin architecture', $output);
    }
}
