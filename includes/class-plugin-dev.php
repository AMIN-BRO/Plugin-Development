<?php
/**
 * Main Plugin Development Class
 *
 * @package PluginDevelopment
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Plugin Class
 */
class Plugin_Dev {
    /**
     * Plugin instance
     */
    private static $instance = null;

    /**
     * Get plugin instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize plugin hooks
     */
    private function init_hooks() {
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        add_action('admin_menu', array($this, 'register_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
    }

    /**
     * Load plugin textdomain
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'plugin-development',
            false,
            dirname(PDC_BASENAME) . '/languages'
        );
    }

    /**
     * Register admin menu
     */
    public function register_admin_menu() {
        add_menu_page(
            __('Plugin Development', 'plugin-development'),
            __('Plugin Dev', 'plugin-development'),
            'manage_options',
            'plugin-development',
            array($this, 'render_admin_page'),
            'dashicons-code',
            99
        );
    }

    /**
     * Render admin page
     */
    public function render_admin_page() {
        ?>
        <div class="plugin-dev-container">
            <div class="plugin-dev-header">
                <h1><?php esc_html_e('Plugin Development Dashboard', 'plugin-development'); ?></h1>
            </div>
            <div class="plugin-dev-card">
                <h2><?php esc_html_e('Welcome', 'plugin-development'); ?></h2>
                <p><?php esc_html_e('This is your plugin development learning center. Explore the code and build amazing WordPress plugins!', 'plugin-development'); ?></p>
                <button class="plugin-dev-button" data-action="test"><?php esc_html_e('Test Button', 'plugin-development'); ?></button>
            </div>
        </div>
        <?php
    }

    /**
     * Enqueue admin assets
     */
    public function enqueue_admin_assets() {
        wp_enqueue_style('plugin-dev-admin', PDC_URL . '/assets/css/admin.css', array(), PDC_VERSION);
        wp_enqueue_script('plugin-dev-admin', PDC_URL . '/assets/js/admin.js', array('jquery'), PDC_VERSION, true);
    }

    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        wp_enqueue_style('plugin-dev-frontend', PDC_URL . '/assets/css/frontend.css', array(), PDC_VERSION);
        wp_enqueue_script('plugin-dev-frontend', PDC_URL . '/assets/js/frontend.js', array('jquery'), PDC_VERSION, true);
    }
}
