<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Settings and Toggles Manager Class
 */
class AME_Marquee_Settings {

    private static $instance = null;

    public static function get_instance() {
        if ( self::$instance === null ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'admin_menu', [ $this, 'register_settings_menu' ] );
        add_action( 'admin_init', [ $this, 'save_widget_settings' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_settings_assets' ] );
    }

    /**
     * Enqueue styling for settings page
     */
    public function enqueue_settings_assets( $hook ) {
        if ( 'toplevel_page_ame-settings' !== $hook ) {
            return;
        }
        wp_enqueue_style(
            'ame-admin-style',
            plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/admin.css',
            [],
            '1.0.0'
        );
    }

    /**
     * Add settings page to main menu
     */
    public function register_settings_menu() {
        add_menu_page(
            esc_html__( 'AME Marquee Effect Settings', 'advanced-marquee-effect' ),
            esc_html__( 'AME Marquee', 'advanced-marquee-effect' ),
            'manage_options',
            'ame-settings',
            [ $this, 'render_settings_page' ],
            'dashicons-leftright',
            80
        );
    }

    /**
     * Get list of all widgets
     */
    public static function get_all_widgets() {
        return [
            'ame-marquee-text' => [
                'name' => esc_html__( 'Marquee Text', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Create scrolls of customizable styled heading/paragraph text strings.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-image' => [
                'name' => esc_html__( 'Marquee Image', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Display customizable inline logo/image carousel streams with link attachments.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-post' => [
                'name' => esc_html__( 'Post Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Showcase standard WordPress posts with layouts containing images, titles, and excerpt overlays.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-testimonial' => [
                'name' => esc_html__( 'Testimonial Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Display premium reviews with author avatars, star ratings, and custom styling presets.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-team' => [
                'name' => esc_html__( 'Team Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Introduce members with avatar frames, designation titles, and custom social link ribbons.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-cta-cards' => [
                'name' => esc_html__( 'CTA Cards Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Increase engagement using horizontal scrolls of content highlight cards.', 'advanced-marquee-effect' ),
                'is_pro' => false,
            ],
            'ame-marquee-woocommerce' => [
                'name' => esc_html__( 'WooCommerce Product Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Feature dynamic query loops of store products with prices, ratings, and instant purchase triggers.', 'advanced-marquee-effect' ),
                'is_pro' => true,
            ],
            'ame-marquee-woo-recent-orders' => [
                'name' => esc_html__( 'WooCommerce Recent Orders Marquee', 'advanced-marquee-effect' ),
                'desc' => esc_html__( 'Present real-time customer sales proof notifications in a smooth sliding banner.', 'advanced-marquee-effect' ),
                'is_pro' => true,
            ],
        ];
    }

    /**
     * Get array of enabled widget states
     */
    public static function get_enabled_widgets() {
        $defaults = array_fill_keys( array_keys( self::get_all_widgets() ), '1' );
        $options = get_option( 'ame_enabled_widgets', $defaults );
        return wp_parse_args( $options, $defaults );
    }

    /**
     * Helper to verify if a widget is enabled
     */
    public static function is_widget_enabled( $widget_slug ) {
        $enabled = self::get_enabled_widgets();
        return isset( $enabled[ $widget_slug ] ) && '1' === (string) $enabled[ $widget_slug ];
    }

    /**
     * Save settings form
     */
    public function save_widget_settings() {
        if ( ! isset( $_POST['ame_save_settings_nonce'] ) || ! wp_verify_nonce( $_POST['ame_save_settings_nonce'], 'ame_save_settings_action' ) ) {
            return;
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $all_widgets = self::get_all_widgets();
        $submitted_widgets = isset( $_POST['widgets'] ) ? (array) $_POST['widgets'] : [];
        $new_settings = [];
        $is_pro_active = class_exists( 'AME_Marquee_Pro' );

        foreach ( array_keys( $all_widgets ) as $slug ) {
            $is_pro = $all_widgets[ $slug ]['is_pro'] ?? false;
            if ( $is_pro && ! $is_pro_active ) {
                // Force disable Pro widgets if Pro plugin is missing/deactivated
                $new_settings[ $slug ] = '0';
            } else {
                // Save state: 1 if checked, 0 if unchecked
                $new_settings[ $slug ] = isset( $submitted_widgets[ $slug ] ) ? '1' : '0';
            }
        }

        update_option( 'ame_enabled_widgets', $new_settings );

        add_settings_error(
            'ame_settings_messages',
            'ame_settings_updated',
            esc_html__( 'Widget settings successfully saved.', 'advanced-marquee-effect' ),
            'success'
        );
    }

    /**
     * Render Settings Page HTML
     */
    public function render_settings_page() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $all_widgets = self::get_all_widgets();
        $enabled_widgets = self::get_enabled_widgets();
        $is_pro_active = class_exists( 'AME_Marquee_Pro' );

        settings_errors( 'ame_settings_messages' );
        ?>
        <div class="wrap ame-settings-wrap">
            <div class="ame-settings-header">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <p class="description"><?php esc_html_e( 'Toggle individual marquee widgets on/off to declutter your Elementor editor panel and optimize loader resources.', 'advanced-marquee-effect' ); ?></p>
            </div>

            <div class="ame-settings-main-container">
                <form method="post" action="">
                    <?php wp_nonce_field( 'ame_save_settings_action', 'ame_save_settings_nonce' ); ?>
                    
                    <div class="ame-settings-card">
                        <div class="ame-settings-card-header">
                            <h2><?php esc_html_e( 'Elementor Widget Enabler / Disabler', 'advanced-marquee-effect' ); ?></h2>
                        </div>
                        <div class="ame-settings-card-body">
                            <div class="ame-widgets-grid">
                                <?php foreach ( $all_widgets as $slug => $data ) : 
                                    $widget_badge = $data['is_pro'] ? 'pro' : 'free';
                                    $is_disabled = $data['is_pro'] && ! $is_pro_active;
                                    $is_checked = isset( $enabled_widgets[ $slug ] ) && '1' === (string) $enabled_widgets[ $slug ];
                                    if ( $is_disabled ) {
                                        $is_checked = false;
                                    }
                                    ?>
                                    <div class="ame-widget-item <?php echo esc_attr( $widget_badge ); ?>-widget <?php echo $is_disabled ? 'ame-widget-disabled' : ''; ?>">
                                        <div class="ame-widget-meta">
                                            <h3 class="ame-widget-name">
                                                <?php echo esc_html( $data['name'] ); ?>
                                                <span class="ame-badge ame-badge-<?php echo esc_attr( $widget_badge ); ?>">
                                                    <?php echo esc_html( strtoupper( $widget_badge ) ); ?>
                                                </span>
                                            </h3>
                                            <p class="ame-widget-desc"><?php echo esc_html( $data['desc'] ); ?></p>
                                        </div>
                                        <div class="ame-widget-toggle-wrapper">
                                            <label class="ame-switch">
                                                <input type="checkbox" name="widgets[<?php echo esc_attr( $slug ); ?>]" value="1" <?php checked( $is_checked ); ?> <?php disabled( $is_disabled ); ?>>
                                                <span class="ame-slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="ame-settings-card-footer">
                            <input type="submit" class="button button-primary ame-save-btn" value="<?php esc_attr_e( 'Save Widget Settings', 'advanced-marquee-effect' ); ?>">
                        </div>
                    </div>
                </form>

                <?php if ( ! $is_pro_active ) : ?>
                    <div class="ame-settings-sidebar-promo">
                        <div class="ame-promo-sidebar-card">
                            <div class="ame-promo-icon">🎁</div>
                            <h3><?php esc_html_e( 'Unlock Premium WooCommerce Marquees', 'advanced-marquee-effect' ); ?></h3>
                            <p><?php esc_html_e( 'Get the full version of Advanced Marquee Effect Pro to unlock premium conversion trackers and products query templates.', 'advanced-marquee-effect' ); ?></p>
                            <a href="<?php echo esc_url( admin_url( 'admin.php?page=ame-settings-pricing' ) ); ?>" class="button ame-sidebar-promo-cta"><?php esc_html_e( 'Upgrade to Pro', 'advanced-marquee-effect' ); ?></a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}

// Helper utility function to check widgets
function ame_is_widget_enabled( $widget_slug ) {
    return AME_Marquee_Settings::is_widget_enabled( $widget_slug );
}

// Bootstrap settings
function run_ame_marquee_settings() {
    return AME_Marquee_Settings::get_instance();
}
add_action( 'plugins_loaded', 'run_ame_marquee_settings' );
