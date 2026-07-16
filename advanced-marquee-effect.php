<?php
/**
 * Plugin Name: Advanced Marquee Effect
 * Description: Easily create smooth scrolling marquees with the Advanced Marquee Effect for Elementor. Customize speed, Style and content with text, or icons
 * Author: Ashikul Islam
 * Version: 1.1.0
 * Tested up to: 7.0
 * Text Domain: advanced-marquee-effect
 * Domain Path: /lang/
 * Author URI: https://profiles.wordpress.org/mdashikul/
 * Elementor tested up to: 4.1
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Exit if accessed directly
if ( !function_exists( 'amefe_fs' ) ) {
    // Create a helper function for easy SDK access.
    function amefe_fs() {
        global $amefe_fs;
        if ( !isset( $amefe_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
            $amefe_fs = fs_dynamic_init( array(
                'id'               => '34732',
                'slug'             => 'advanced-marquee-effect',
                'premium_slug'     => 'advanced-marquee-effect-pro',
                'type'             => 'plugin',
                'public_key'       => 'pk_2544ff7cbd3046a5033d3bd6bb5d8',
                'is_premium'       => false,
                'premium_suffix'   => 'Pro',
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => true,
                'menu'             => array(
                    'slug'    => 'ame-settings',
                    'support' => false,
                ),
                'is_live'          => true,
            ) );
        }
        return $amefe_fs;
    }

    // Init Freemius.
    amefe_fs();
    // Signal that SDK was initiated.
    do_action( 'amefe_fs_loaded' );
}

final class Advanced_Marquee_Effect {

    /**
     * Plugin Version
     */
    const VERSION = '1.1.0';

    /**
     * Singleton Instance
     */
    private static $instance = null;

    /**
     * Get Plugin Instance
     */
    public static function get_instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor - Hooks into WordPress
     */
    private function __construct() {
        // Load Text Domain
        add_action( 'plugins_loaded', [ $this, 'ame_load_textdomain' ] );

        // Register Elementor Widget
        add_action( 'elementor/widgets/register', [ $this, 'ame_register_widget' ] );

        // Enqueue Styles
        add_action( 'wp_enqueue_scripts', [ $this, 'ame_enqueue_scripts' ] );

        // Enqueue Editor Styles for Elementor
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'ame_enqueue_editor_styles' ] );

        // Add Elementor Category
        add_action('elementor/elements/categories_registered', array($this, 'ame_widget_category'));

        // Load Settings and widget toggles manager
        require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';

        // Load Promo and extra features in Admin Context
        if ( is_admin() ) {
            require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
        }
    }

    /**
     * Load Plugin Text Domain
     */
    public function ame_load_textdomain() {
        load_plugin_textdomain( 'advanced-marquee-effect', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    }

    /**
     * Register Custom Marquee Widget
     */
    public function ame_register_widget( $widgets_manager ) {
        if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
            return; // Stop if Elementor is not loaded
        }

        // Register Marquee Text
        if ( ame_is_widget_enabled( 'ame-marquee-text' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-text-widget.php' );
            $widgets_manager->register( new \AME_Marquee_Text_Widget() );
        }

        // Register Marquee Image
        if ( ame_is_widget_enabled( 'ame-marquee-image' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-image-widget.php' );
            $widgets_manager->register( new \AME_Marquee_Image_Widget() );
        }

        // Register Marquee Post
        if ( ame_is_widget_enabled( 'ame-marquee-post' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-post-widget.php' );
            $widgets_manager->register( new \AME_Marquee_Post_Widget() );
        }

        // Register Testimonial Marquee
        if ( ame_is_widget_enabled( 'ame-marquee-testimonial' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-testimonial-widget.php' );
            $widgets_manager->register( new \AME_Testimonial_Marquee_Widget() );
        }

        // Register Team Marquee
        if ( ame_is_widget_enabled( 'ame-marquee-team' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-team-widget.php' );
            $widgets_manager->register( new \AME_Marquee_Team_Widget() );
        }

        // Register CTA Cards Marquee
        if ( ame_is_widget_enabled( 'ame-marquee-cta-cards' ) ) {
            require_once( __DIR__ . '/widgets/ame-marquee-cta-cards-widget.php' );
            $widgets_manager->register( new \AME_CTA_Cards_Marquee_Widget() );
        }

        // Register WooCommerce Product Marquee and Recent Orders if Pro is NOT active
        if ( ! class_exists( 'AME_Marquee_Pro' ) ) {
            // Register WooCommerce Product Marquee (Locked/Promo)
            if ( ame_is_widget_enabled( 'ame-marquee-woocommerce' ) ) {
                require_once( __DIR__ . '/widgets/ame-marquee-woocommerce-widget.php' );
                $widgets_manager->register( new \AME_Marquee_WooCommerce_Widget() );
            }

            // Register WooCommerce Recent Orders Marquee (Locked/Promo)
            if ( ame_is_widget_enabled( 'ame-marquee-woo-recent-orders' ) ) {
                require_once( __DIR__ . '/widgets/ame-marquee-woo-recent-orders-widget.php' );
                $widgets_manager->register( new \AME_Marquee_Woo_Recent_Orders_Widget() );
            }
        }
    }

    /**
     *  Category for Theme Widgets.
     */
    function ame_widget_category( $elements_manager ) {
        $elements_manager->add_category(
            'ame_marquee_effect',
            [
                'title' => __( 'AME Marquee Effect', 'advanced-marquee-effect' ),
                'icon'  => 'fa fa-plug',
            ]
        );
    }
    /**
     * Enqueue Styles
     */
    public function ame_enqueue_scripts() {
        wp_register_style( 'ame-swiper', plugin_dir_url( __FILE__ ) . 'assets/css/swiper-bundle.min.css', [], self::VERSION );
        wp_register_style( 'ame-marquee-style', plugin_dir_url( __FILE__ ) . 'assets/css/ame-marquee.css', ['ame-swiper'], self::VERSION );

        wp_register_script( 'ame-swiper', plugin_dir_url( __FILE__ ) . 'assets/js/swiper-bundle.min.js', [], self::VERSION, true );
        wp_register_script('ame-marquee-script', plugin_dir_url( __FILE__ ) . 'assets/js/marquee-script.js', ['ame-swiper', 'jquery'], self::VERSION, true );
    }

    /**
     * Enqueue Elementor Editor Styles
     */
    public function ame_enqueue_editor_styles() {
        wp_enqueue_style( 'ame-elementor-editor-css', plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', [], self::VERSION );
    }
}

// Initialize Plugin
Advanced_Marquee_Effect::get_instance();
