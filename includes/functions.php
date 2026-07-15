<?php
/**
 * Extra functions and features for Advanced Marquee Effect
 *
 * Contains helpers, promotional notices, and AJAX handlers.
 *
 * @package Advanced_Marquee_Effect
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Check if the GatePass promotional notice should be displayed.
 *
 * @return bool True if all conditions are met and notice should show.
 */
function ame_should_display_gatepass_notice() {
    // 1. Check user capability
    if ( ! current_user_can( 'manage_options' ) ) {
        return false;
    }

    // 2. Check if this is an AJAX request
    if ( wp_doing_ajax() ) {
        return false;
    }

    // 3. Check if inside Network Admin
    if ( is_network_admin() ) {
        return false;
    }

    // 4. Check if inside iframe request
    if ( defined( 'IFRAME_REQUEST' ) && IFRAME_REQUEST ) {
        return false;
    }

    // 5. Check for activation or upgrade request queries to avoid display during processes
    $request_action = isset( $_REQUEST['action'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['action'] ) ) : '';
    $actions_to_skip = [ 'activate', 'activate-multi', 'deactivate', 'deactivate-multi', 'upgrade-plugin', 'update-selected' ];
    if ( in_array( $request_action, $actions_to_skip, true ) ) {
        return false;
    }

    // 6. Check if screen ID is dashboard or plugins
    if ( ! function_exists( 'get_current_screen' ) ) {
        return false;
    }
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->id, [ 'dashboard', 'plugins' ], true ) ) {
        return false;
    }

    // 7. Check if GatePass plugin is installed or active
    if ( ! function_exists( 'get_plugins' ) ) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $all_plugins = get_plugins();
    if ( isset( $all_plugins['gatepass-password-protection/gatepass-password-protection.php'] ) ) {
        return false;
    }
    if ( is_plugin_active( 'gatepass-password-protection/gatepass-password-protection.php' ) ) {
        return false;
    }

    // 8. Check if user permanently dismissed the notice
    $user_id = get_current_user_id();
    $permanently_dismissed = get_user_meta( $user_id, 'ame_gatepass_notice_permanently_dismissed', true );
    if ( 'true' === $permanently_dismissed ) {
        return false;
    }

    // 9. Check if first dismissal timestamp is within the 21-day cool-down period
    $first_dismiss = get_user_meta( $user_id, 'ame_gatepass_notice_first_dismiss', true );
    if ( $first_dismiss ) {
        $days_elapsed = ( time() - intval( $first_dismiss ) ) / DAY_IN_SECONDS;
        if ( $days_elapsed < 21 ) {
            return false;
        }
    }

    return true;
}

/**
 * Enqueue CSS and JS assets only if the GatePass promotional notice is visible.
 *
 * @param string $hook_suffix The current admin page hook.
 */
function ame_enqueue_gatepass_promo_assets( $hook_suffix ) {
    if ( ! ame_should_display_gatepass_notice() ) {
        return;
    }

    // Enqueue general admin styles
    wp_enqueue_style(
        'ame-admin-style',
        plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/admin.css',
        [],
        '1.0.0'
    );

    // Enqueue general admin script
    wp_enqueue_script(
        'ame-admin-script',
        plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/admin.js',
        [ 'jquery' ],
        '1.0.0',
        true
    );

    // Localize AJAX parameters for security and execution
    wp_localize_script(
        'ame-admin-script',
        'ameGatePassPromo',
        [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'ame_gatepass_promo_nonce' ),
            'action'   => 'ame_dismiss_gatepass_notice',
        ]
    );
}
add_action( 'admin_enqueue_scripts', 'ame_enqueue_gatepass_promo_assets' );

/**
 * Render the promotional notice HTML markup.
 */
function ame_render_gatepass_promo_notice() {
    if ( ! ame_should_display_gatepass_notice() ) {
        return;
    }
    ?>
    <div class="notice notice-info is-dismissible ame-gatepass-promo-notice" id="ame-gatepass-promo-notice">
        <div class="ame-gatepass-promo-container">
            <div class="ame-gatepass-promo-header">
                <span class="dashicons dashicons-lock"></span>
                <h2><?php esc_html_e( 'Protect Your Website with GatePass Password Protection', 'advanced-marquee-effect' ); ?></h2>
            </div>
            <div class="ame-gatepass-promo-content">
                <p><strong><?php esc_html_e( 'Need an easy way to protect your website from unwanted visitors?', 'advanced-marquee-effect' ); ?></strong></p>
                <p><?php esc_html_e( 'GatePass Password Protection lets you protect:', 'advanced-marquee-effect' ); ?></p>
                <ul class="ame-gatepass-promo-features">
                    <li><?php esc_html_e( 'Entire website', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Pages', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Posts', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'WooCommerce products', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Categories', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Custom post types', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Partial content', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Password generator', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Magic links', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Session control', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'User role restrictions', 'advanced-marquee-effect' ); ?></li>
                    <li><?php esc_html_e( 'Much more', 'advanced-marquee-effect' ); ?></li>
                </ul>
                <p><?php esc_html_e( 'Start protecting your content in just a few clicks.', 'advanced-marquee-effect' ); ?></p>
            </div>
            <div class="ame-gatepass-promo-actions">
                <a href="<?php echo esc_url( self_admin_url( 'plugin-install.php?s=gatepass-password-protection&tab=search&type=term' ) ); ?>" class="button button-primary ame-gatepass-promo-cta">
                    <?php esc_html_e( 'Protect Now', 'advanced-marquee-effect' ); ?>
                </a>
                <a href="https://wordpress.org/plugins/gatepass-password-protection/" class="ame-gatepass-promo-link" target="_blank" rel="noopener noreferrer">
                    <?php esc_html_e( 'Learn More', 'advanced-marquee-effect' ); ?>
                    <span class="dashicons dashicons-external"></span>
                </a>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'admin_notices', 'ame_render_gatepass_promo_notice' );

/**
 * AJAX handler to safely record notice dismissal.
 */
function ame_dismiss_gatepass_notice_handler() {
    // Validate request security and parameters
    check_ajax_referer( 'ame_gatepass_promo_nonce', 'nonce' );

    // Ensure user has necessary permission
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => esc_html__( 'Permission denied.', 'advanced-marquee-effect' ) ] );
    }

    $user_id = get_current_user_id();

    // Check if first dismiss has already been recorded
    $first_dismiss = get_user_meta( $user_id, 'ame_gatepass_notice_first_dismiss', true );

    if ( ! $first_dismiss ) {
        // First dismiss: Save the dismissal timestamp
        $updated = update_user_meta( $user_id, 'ame_gatepass_notice_first_dismiss', time() );
        if ( $updated ) {
            wp_send_json_success( [ 'dismiss_type' => 'first' ] );
        } else {
            wp_send_json_error( [ 'message' => esc_html__( 'Failed to update user meta.', 'advanced-marquee-effect' ) ] );
        }
    } else {
        // Second dismiss: Set permanent dismissal flag
        $updated = update_user_meta( $user_id, 'ame_gatepass_notice_permanently_dismissed', 'true' );
        if ( $updated ) {
            wp_send_json_success( [ 'dismiss_type' => 'permanent' ] );
        } else {
            wp_send_json_error( [ 'message' => esc_html__( 'Failed to update user meta.', 'advanced-marquee-effect' ) ] );
        }
    }
}
add_action( 'wp_ajax_ame_dismiss_gatepass_notice', 'ame_dismiss_gatepass_notice_handler' );

