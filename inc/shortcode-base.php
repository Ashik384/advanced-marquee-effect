<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register the AME Marquee top-level menu
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
}
add_action('admin_menu', 'ame_register_marquee_menu');

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
 * Marquee Meta Box Callback
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
 * Save Marquee Meta Box Data
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

/**
 * Register Custom Post Type for Shortcodes
 */
function ame_register_shortcode_cpt() {
    $labels = array(
        'name'               => 'Shortcodes',
        'singular_name'      => 'Shortcode',
        'menu_name'          => 'All Shortcodes',
        'add_new'            => 'Add Shortcode',
        'add_new_item'       => 'Add New Shortcode',
        'edit_item'          => 'Edit Shortcode',
        'new_item'           => 'New Shortcode',
        'view_item'          => 'View Shortcode',
        'all_items'          => 'All Shortcodes',
        'search_items'       => 'Search Shortcodes',
        'not_found'          => 'No shortcodes found',
        'not_found_in_trash' => 'No shortcodes found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => 'ame_marquee',
        'supports'           => array('title'),
        'capability_type'    => 'post',
        'menu_position'      => 81,
    );

    register_post_type('ame_shortcode', $args);
}
add_action('init', 'ame_register_shortcode_cpt');

/**
 * Add Meta Box for Shortcode Settings
 */
function ame_add_shortcode_meta_box() {
    add_meta_box(
        'ame_shortcode_settings',
        'Shortcode Settings',
        'ame_shortcode_meta_box_callback',
        'ame_shortcode',
        'normal',
        'high'
    );
    add_meta_box(
        'ame_shortcode_output',
        'Generated Shortcode',
        'ame_shortcode_output_meta_box_callback',
        'ame_shortcode',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'ame_add_shortcode_meta_box');

/**
 * Shortcode Meta Box Callback
 */
function ame_shortcode_meta_box_callback($post) {
    wp_nonce_field('ame_shortcode_save', 'ame_shortcode_nonce');
    $marquee_type = get_post_meta($post->ID, 'shortcode_marquee_type', true);
    $marquee_post_ids = get_post_meta($post->ID, 'shortcode_marquee_post_ids', true);
    $marquee_post_ids = is_array($marquee_post_ids) ? $marquee_post_ids : array();
    $allow_multiple = get_post_meta($post->ID, 'shortcode_allow_multiple', true) === 'yes';
    ?>
    <p>
        <label for="shortcode_marquee_type"><strong>Marquee Type:</strong></label><br>
        <select name="shortcode_marquee_type" id="shortcode_marquee_type">
            <option value="all" <?php selected($marquee_type, 'all'); ?>>All Types</option>
            <option value="text" <?php selected($marquee_type, 'text'); ?>>Text</option>
            <option value="team" <?php selected($marquee_type, 'team'); ?>>Team</option>
        </select>
    </p>
    <p>
        <label for="shortcode_allow_multiple"><strong>Allow Multiple Selection:</strong></label><br>
        <input type="checkbox" name="shortcode_allow_multiple" id="shortcode_allow_multiple" value="yes" <?php checked($allow_multiple, true); ?> />
        <span>Enable to select multiple marquees</span>
    </p>
    <p class="marquee-post-select" <?php echo !$allow_multiple ? 'style="display:none;"' : ''; ?>>
        <label for="shortcode_marquee_post_ids"><strong>Select Marquee:</strong></label><br>
        <select name="shortcode_marquee_post_ids[]" id="shortcode_marquee_post_ids" multiple style="width:100%; height:150px;">
            <option value="">Select marquee(s)...</option>
            <?php
            $args = array(
                'post_type' => 'ame_marquee',
                'posts_per_page' => -1,
                'post_status' => 'publish',
            );
            $marquees = get_posts($args);
            foreach ($marquees as $marquee) {
                $type = get_post_meta($marquee->ID, 'marquee_type', true);
                $selected = in_array($marquee->ID, $marquee_post_ids) ? 'selected' : '';
                echo '<option value="' . esc_attr($marquee->ID) . '" data-type="' . esc_attr($type) . '" ' . $selected . '>' . esc_html($marquee->post_title) . ' (' . esc_html(ucfirst($type)) . ')</option>';
            }
            ?>
        </select>
        <p class="description">Hold Ctrl/Cmd to select multiple marquees. If none selected, all marquees of the chosen type will be included.</p>
    </p>
    <script>
        jQuery(document).ready(function($) {
            // Toggle marquee post select visibility
            $('#shortcode_allow_multiple').change(function() {
                if ($(this).is(':checked')) {
                    $('.marquee-post-select').show();
                } else {
                    $('.marquee-post-select').hide();
                    $('#shortcode_marquee_post_ids').val(''); // Clear selection
                }
            });

            // Filter marquee posts based on type
            $('#shortcode_marquee_type').change(function() {
                var selectedType = $(this).val();
                $('#shortcode_marquee_post_ids option').each(function() {
                    var postType = $(this).data('type');
                    if (selectedType === 'all' || !postType || postType === selectedType) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
                $('#shortcode_marquee_post_ids').val(''); // Reset selection
            });
        });
    </script>
    <?php
}

/**
 * Shortcode Output Meta Box Callback
 */
function ame_shortcode_output_meta_box_callback($post) {
    $shortcode = '[advanced_marquee shortcode_id="' . esc_attr($post->ID) . '"]';
    ?>
    <p><strong>Shortcode:</strong></p>
    <input type="text" value="<?php echo esc_attr($shortcode); ?>" readonly style="width:100%;" />
    <p>Copy and paste this shortcode into your posts, pages, or theme templates.</p>
    <?php
}

/**
 * Save Shortcode Meta Box Data
 */
function ame_save_shortcode_meta($post_id) {
    if (!isset($_POST['ame_shortcode_nonce']) || !wp_verify_nonce($_POST['ame_shortcode_nonce'], 'ame_shortcode_save')) {
        return;
    }
    if (isset($_POST['shortcode_marquee_type'])) {
        update_post_meta($post_id, 'shortcode_marquee_type', sanitize_text_field($_POST['shortcode_marquee_type']));
    }
    if (isset($_POST['shortcode_marquee_post_ids']) && is_array($_POST['shortcode_marquee_post_ids'])) {
        $post_ids = array_map('intval', $_POST['shortcode_marquee_post_ids']);
        update_post_meta($post_id, 'shortcode_marquee_post_ids', $post_ids);
    } else {
        delete_post_meta($post_id, 'shortcode_marquee_post_ids');
    }
    if (isset($_POST['shortcode_allow_multiple'])) {
        update_post_meta($post_id, 'shortcode_allow_multiple', 'yes');
    } else {
        delete_post_meta($post_id, 'shortcode_allow_multiple');
    }
}
add_action('save_post', 'ame_save_shortcode_meta');
?>