<?php
/**
 * Plugin Name: Advanced Marquee Effect
 * Description: Easily create smooth scrolling marquees with the Advanced Marquee Effect for Elementor. Customize speed, Style and content with text, or icons
 * Author: Ashikul Islam
 * Version: 1.0.8
 * Tested up to: 6.8
 * Text Domain: advanced-marquee-effect
 * Domain Path: /lang/
 * Author URI: https://profiles.wordpress.org/mdashikul/
 * Elementor tested up to: 3.28.0
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Advanced_Marquee_Effect {

    /**
     * Plugin Version
     */
    const VERSION = '1.0.8';

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

        // Add Elementor Category
        add_action('elementor/elements/categories_registered', array($this, 'ame_widget_category'));
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
        require_once( __DIR__ . '/widgets/ame-marquee-text-widget.php' );
        $widgets_manager->register( new \AME_Marquee_Text_Widget() );

        // Register Marquee Image
        require_once( __DIR__ . '/widgets/ame-marquee-image-widget.php' );
        $widgets_manager->register( new \AME_Marquee_Image_Widget() );

        // Register Marquee Post
        require_once( __DIR__ . '/widgets/ame-marquee-post-widget.php' );
        $widgets_manager->register( new \AME_Marquee_Post_Widget() );

        // Register Testimonial Marquee
        require_once( __DIR__ . '/widgets/ame-marquee-testimonial-widget.php' );
        $widgets_manager->register( new \AME_Testimonial_Marquee_Widget() );

        // Register Team Marquee
        require_once( __DIR__ . '/widgets/ame-marquee-team-widget.php' );
        $widgets_manager->register( new \AME_Marquee_Team_Widget() );

        // Register CTA Cards Marquee
        require_once( __DIR__ . '/widgets/ame-marquee-cta-cards-widget.php' );
        $widgets_manager->register( new \AME_CTA_Cards_Marquee_Widget() );
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
}

// Initialize Plugin
Advanced_Marquee_Effect::get_instance();
