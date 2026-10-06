<?php
/**
 * Plugin Name: Plugin Development Framework
 * Plugin URI: https://github.com/AMIN-BRO/Plugin-Development
 * Description: A comprehensive WordPress plugin development framework and educational series.
 * Version: 1.0.0
 * Author: AMIN-BRO
 * Author URI: https://github.com/AMIN-BRO
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: plugin-development
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('PDC_VERSION', '1.0.0');
define('PDC_FILE', __FILE__);
define('PDC_DIR', dirname(PDC_FILE));
define('PDC_URL', plugins_url('', PDC_FILE));
define('PDC_BASENAME', plugin_basename(PDC_FILE));

/**
 * Main Plugin Class
 */
class PluginDevelopment {
    /**
     * Instance of the class
     */
    private static $instance = null;

    /**
     * Get instance of the class
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
        $this->init();
    }

    /**
     * Initialize plugin hooks and features
     */
    public function init() {
        // Load textdomain for translations
        add_action('plugins_loaded', array($this, 'load_textdomain'));

        // Initialize admin features
        if (is_admin()) {
            $this->init_admin();
        }

        // Initialize frontend features
        $this->init_frontend();

        // Register activation and deactivation hooks
        register_activation_hook(PDC_FILE, array($this, 'activate'));
        register_deactivation_hook(PDC_FILE, array($this, 'deactivate'));
    }

    /**
     * Load plugin textdomain for translations
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'plugin-development',
            false,
            dirname(PDC_BASENAME) . '/languages'
        );
    }

    /**
     * Initialize admin functionality
     */
    public function init_admin() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Initialize frontend functionality
     */
    public function init_frontend() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_scripts'));
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu() {
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
        <div class="wrap">
            <h1><?php echo esc_html(__('Plugin Development Framework', 'plugin-development')); ?></h1>
            <p><?php echo esc_html(__('Welcome to the Plugin Development Series!', 'plugin-development')); ?></p>
            <div class="card">
                <h2><?php echo esc_html(__('Getting Started', 'plugin-development')); ?></h2>
                <p><?php echo wp_kses_post(__('This is the main plugin file for the Plugin Development educational series. Use this framework as a foundation for learning WordPress plugin development.', 'plugin-development')); ?></p>
            </div>
        </div>
        <?php
    }

    /**
     * Enqueue admin scripts
     */
    public function enqueue_admin_scripts() {
        wp_enqueue_style('plugin-development-admin', PDC_URL . '/assets/css/admin.css', array(), PDC_VERSION);
        wp_enqueue_script('plugin-development-admin', PDC_URL . '/assets/js/admin.js', array('jquery'), PDC_VERSION, true);
    }

    /**
     * Enqueue frontend scripts
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_style('plugin-development-frontend', PDC_URL . '/assets/css/frontend.css', array(), PDC_VERSION);
        wp_enqueue_script('plugin-development-frontend', PDC_URL . '/assets/js/frontend.js', array('jquery'), PDC_VERSION, true);
    }

    /**
     * Plugin activation hook
     */
    public function activate() {
        // Perform actions on plugin activation
        do_action('plugin_development_activated');
    }

    /**
     * Plugin deactivation hook
     */
    public function deactivate() {
        // Perform actions on plugin deactivation
        do_action('plugin_development_deactivated');
    }
}

// Initialize the plugin
function init_plugin_development() {
    return PluginDevelopment::get_instance();
}

// Start the plugin
init_plugin_development();
