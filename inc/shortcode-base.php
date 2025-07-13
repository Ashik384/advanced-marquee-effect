<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register the AME Marquee top-level menu and sub-menus
 */
function ame_register_marquee_menu() {
    add_menu_page(
        'AME Marquee',
        'AME Marquee',
        'manage_options',
        'ame_marquee',
        null,
        'dashicons-slides',
        80
    );

    add_submenu_page(
        'ame_marquee',
        'Shortcode Generator',
        'Shortcode Generator',
        'manage_options',
        'ame-shortcode-generator',
        'ame_shortcode_generator_page'
    );
}
add_action('admin_menu', 'ame_register_marquee_menu');

/**
 * Shortcode Generator Page (Placeholder)
 */
function ame_shortcode_generator_page() {
    ?>
    <div class="wrap">
        <h1>Shortcode Generator</h1>
        <p>Configure your marquee settings and generate a shortcode here. (To be implemented in the next step.)</p>
    </div>
    <?php
}

/**
 * Register Custom Post Type for Marquees
 */
function ame_register_marquee_cpt() {
    $labels = array(
        'name'               => 'Marquees',
        'singular_name'      => 'Marquee',
        'menu_name'          => 'All Marquees',
        'add_new'            => 'Add Marquee',
        'add_new_item'       => 'Add New Marquee',
        'edit_item'          => 'Edit Marquee',
        'new_item'           => 'New Marquee',
        'view_item'          => 'View Marquee',
        'all_items'          => 'All Marquees',
        'search_items'       => 'Search Marquees',
        'not_found'          => 'No marquees found',
        'not_found_in_trash' => 'No marquees found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => 'ame_marquee',
        'supports'           => array('title'),
        'capability_type'    => 'post',
        'menu_position'      => 80,
    );

    register_post_type('ame_marquee', $args);
}
add_action('init', 'ame_register_marquee_cpt');

/**
 * Add Meta Box for Marquee Settings
 */
function ame_add_marquee_meta_box() {
    add_meta_box(
        'ame_marquee_settings',
        'Marquee Settings',
        'ame_marquee_meta_box_callback',
        'ame_marquee',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ame_add_marquee_meta_box');

/**
 * Meta Box Callback
 */
function ame_marquee_meta_box_callback($post) {
    wp_nonce_field('ame_marquee_save', 'ame_marquee_nonce');
    $marquee_type = get_post_meta($post->ID, 'marquee_type', true);
    $marquee_content = get_post_meta($post->ID, 'marquee_content', true);
    $marquee_member_name = get_post_meta($post->ID, 'marquee_member_name', true);
    ?>
    <p>
        <label for="marquee_type"><strong>Marquee Type:</strong></label><br>
        <select name="marquee_type" id="marquee_type">
            <option value="text" <?php selected($marquee_type, 'text'); ?>>Text</option>
            <option value="team" <?php selected($marquee_type, 'team'); ?>>Team</option>
        </select>
    </p>
    <p class="marquee-field marquee-field-text" <?php echo $marquee_type === 'team' ? 'style="display:none;"' : ''; ?>>
        <label for="marquee_content"><strong>Content:</strong></label><br>
        <textarea name="marquee_content" id="marquee_content" rows="5" style="width:100%;"><?php echo esc_textarea($marquee_content); ?></textarea>
    </p>
    <p class="marquee-field marquee-field-team" <?php echo $marquee_type !== 'team' ? 'style="display:none;"' : ''; ?>>
        <label for="marquee_member_name"><strong>Member Name:</strong></label><br>
        <input type="text" name="marquee_member_name" id="marquee_member_name" value="<?php echo esc_attr($marquee_member_name); ?>" style="width:100%;" />
    </p>
    <script>
        jQuery(document).ready(function($) {
            $('#marquee_type').change(function() {
                $('.marquee-field').hide();
                $('.marquee-field-' + $(this).val()).show();
            });
        });
    </script>
    <?php
}

/**
 * Save Meta Box Data
 */
function ame_save_marquee_meta($post_id) {
    if (!isset($_POST['ame_marquee_nonce']) || !wp_verify_nonce($_POST['ame_marquee_nonce'], 'ame_marquee_save')) {
        return;
    }
    if (isset($_POST['marquee_type'])) {
        update_post_meta($post_id, 'marquee_type', sanitize_text_field($_POST['marquee_type']));
    }
    if (isset($_POST['marquee_content'])) {
        update_post_meta($post_id, 'marquee_content', sanitize_textarea_field($_POST['marquee_content']));
    }
    if (isset($_POST['marquee_member_name'])) {
        update_post_meta($post_id, 'marquee_member_name', sanitize_text_field($_POST['marquee_member_name']));
    }
}
add_action('save_post', 'ame_save_marquee_meta');
?>