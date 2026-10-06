<?php
/**
 * Plugin Development Shortcodes
 *
 * @package PluginDevelopment
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcodes Handler Class
 */
class Plugin_Dev_Shortcodes {
    /**
     * Register shortcodes
     */
    public static function register() {
        add_shortcode('plugin_dev_info', array(__CLASS__, 'render_info'));
        add_shortcode('plugin_dev_features', array(__CLASS__, 'render_features'));
    }

    /**
     * Render plugin info shortcode
     */
    public static function render_info($atts) {
        ob_start();
        ?>
        <div class="plugin-dev-widget" data-type="info">
            <h3><?php esc_html_e('Plugin Development Info', 'plugin-development'); ?></h3>
            <p><?php esc_html_e('Learn how to build WordPress plugins with best practices and clean code.', 'plugin-development'); ?></p>
            <span class="plugin-dev-badge"><?php esc_html_e('v1.0.0', 'plugin-development'); ?></span>
        </div>
        <?php
        return ob_get_clean();
    }

    /**
     * Render features shortcode
     */
    public static function render_features($atts) {
        ob_start();
        ?>
        <div class="plugin-dev-widget" data-type="features">
            <h3><?php esc_html_e('Features', 'plugin-development'); ?></h3>
            <ul class="plugin-dev-list">
                <li><?php esc_html_e('Clean plugin architecture', 'plugin-development'); ?></li>
                <li><?php esc_html_e('WordPress hooks and filters', 'plugin-development'); ?></li>
                <li><?php esc_html_e('Admin menu integration', 'plugin-development'); ?></li>
                <li><?php esc_html_e('Asset loading and enqueuing', 'plugin-development'); ?></li>
                <li><?php esc_html_e('Security best practices', 'plugin-development'); ?></li>
            </ul>
        </div>
        <?php
        return ob_get_clean();
    }
}
