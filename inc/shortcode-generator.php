<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Shortcode to Render Marquee
 */
function ame_marquee_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'shortcode_id' => 0, // ame_shortcode post ID
        ),
        $atts,
        'advanced_marquee'
    );

    // Validate shortcode ID
    if (!$atts['shortcode_id']) {
        return '<p>Error: No shortcode ID provided.</p>';
    }

    $shortcode_post = get_post($atts['shortcode_id']);
    if (!$shortcode_post || $shortcode_post->post_type !== 'ame_shortcode') {
        return '<p>Error: Invalid shortcode ID.</p>';
    }

    // Get shortcode meta
    $marquee_type = get_post_meta($shortcode_post->ID, 'shortcode_marquee_type', true);
    $marquee_post_ids = get_post_meta($shortcode_post->ID, 'shortcode_marquee_post_ids', true);
    $marquee_post_ids = is_array($marquee_post_ids) ? $marquee_post_ids : array();
    $allow_multiple = get_post_meta($shortcode_post->ID, 'shortcode_allow_multiple', true) === 'yes';

    // Initialize query args
    $query_args = array(
        'post_type' => 'ame_marquee',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );

    // Handle specific IDs or type-based query
    if ($allow_multiple && !empty($marquee_post_ids)) {
        $query_args['post__in'] = $marquee_post_ids;
    } elseif ($marquee_type && in_array($marquee_type, array('text', 'team', 'all'))) {
        if ($marquee_type !== 'all') {
            $query_args['meta_query'] = array(
                array(
                    'key' => 'marquee_type',
                    'value' => $marquee_type,
                    'compare' => '=',
                ),
            );
        }
    } else {
        return '<p>Error: No valid marquee type or IDs provided.</p>';
    }

    // Fetch marquee posts
    $marquees = get_posts($query_args);
    if (empty($marquees)) {
        return '<p>Error: No valid marquees found.</p>';
    }

    // Enqueue styles
    wp_add_inline_style('ame-marquee-style', '
        .ame-marquee {
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
            position: relative;
        }
        .ame-marquee-content {
            display: inline-flex;
            white-space: nowrap;
            animation: marquee-scroll 10s linear infinite;
        }
        .ame-marquee-content span {
            display: inline-block;
            margin-right: 20px;
        }
        @keyframes marquee-scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
        @media (prefers-reduced-motion: reduce) {
            .ame-marquee-content {
                animation: none;
            }
        }
    ');

    // Enqueue scripts
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            $(".ame-marquee").each(function() {
                var $content = $(this).find(".ame-marquee-content");
                $content.append($content.children().clone());
            });
        });
    ');

    // Generate unique ID for the marquee
    $marquee_id = uniqid('marquee_');

    // Build output
    $output = '<div class="ame-marquee" id="' . esc_attr($marquee_id) . '">';
    $output .= '<div class="ame-marquee-content">';

    foreach ($marquees as $marquee) {
        $marquee_type = get_post_meta($marquee->ID, 'marquee_type', true);
        $marquee_content = get_post_meta($marquee->ID, 'marquee_content', true);
        $marquee_member_name = get_post_meta($marquee->ID, 'marquee_member_name', true);

        if ($marquee_type === 'text' && $marquee_content) {
            $output .= '<span>' . esc_html($marquee_content) . '</span>';
        } elseif ($marquee_type === 'team' && $marquee_member_name) {
            $output .= '<span>' . esc_html($marquee_member_name) . '</span>';
        }
    }

    $output .= '</div></div>';

    return $output;
}
add_shortcode('advanced_marquee', 'ame_marquee_shortcode');

/**
 * Enqueue jQuery
 */
function ame_enqueue_scripts() {
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'ame_enqueue_scripts');
?>