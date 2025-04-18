<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_Marquee_Post_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-marquee-post';
    }

    public function get_title()
    {
        return __('AME Marquee Post', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'animation', 'post', 'blog', 'carousel'];
    }

    public function get_style_depends()
    {
        return ['ame-marquee', 'ame-swiper'];
    }

    public function get_script_depends()
    {
        return ['ame-marquee-script', 'ame-swiper'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Marquee Content', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Post Type', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_post_types(),
                'default' => 'post',
                'multiple' => false,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 20,
            ]
        );
        $this->add_control(
            'ame_marquee_title_length',
            [
                'label' => esc_html__('Title Length (Words)', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 200,
                'step' => 1,
                'default' => 50,
            ]
        );

        $this->add_control(
            'ame_marquee_show_excerpt',
            [
                'label' => esc_html__('Show Excerpt', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'advanced-marquee-effect'),
                'label_off' => esc_html__('Hide', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ame_marquee_excerpt_length',
            [
                'label' => esc_html__('Excerpt Length (Words)', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 500,
                'step' => 1,
                'default' => 20,
                'condition' => [
                    'ame_marquee_show_excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_lazy_load',
            [
                'label' => esc_html__('Lazy Load Images', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes', // Enabled by default to maintain current behavior
            ]
        );

        $this->add_control(
            'ame_marquee_settings',
            [
                'label' => esc_html__('Marquee Settings', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_marquee_speed',
            [
                'label' => __('Speed (in ms)', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 900000,
                'step' => 1,
                'default' => 3000,
            ]
        );

        $this->add_control(
            'ame_marquee_stop_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'ame_marquee_post_reverse',
            [
                'label' => __('Reverse', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'advanced-marquee-effect'),
                'label_off' => __('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'ame_marquee_post_vertical',
            [
                'label' => __('Vertical Scroll', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'advanced-marquee-effect'),
                'label_off' => __('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_height',
            [
                'label' => esc_html__('Vertical Marquee Height', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'size' => 600,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 400,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_post_vertical' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ame_marquee_post_style',
            [
                'label' => esc_html__('Marquee Card', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_item_background',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_horizontal_align',
            [
                'label' => esc_html__('Horizontal Alignment', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'stretch' => [
                        'title' => esc_html__('Stretch', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-stretch',
                    ],
                ],
                'condition' => [
                    'ame_marquee_post_vertical!' => 'yes',
                ],
                'default' => 'stretch',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_vertical_align',
            [
                'label' => esc_html__('Vertical Alignment', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'condition' => [
                    'ame_marquee_post_vertical' => 'yes',
                ],
                'default' => 'center',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_alignment',
            [
                'label' => esc_html__('Alignment Item', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__('Top', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'condition' => [
                    'ame_marquee_post_vertical!' => 'yes',
                ],
                'default' => 'top',
                'toggle' => false,
            ]
        );

        // $this->add_control(
        //     'ame_marquee_equal_height',
        //     [
        //         'label' => esc_html__('Equal Height Slides', 'advanced-marquee-effect'),
        //         'type' => \Elementor\Controls_Manager::SWITCHER,
        //         'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
        //         'label_off' => esc_html__('No', 'advanced-marquee-effect'),
        //         'return_value' => 'yes',
        //         'default' => 'no',
        //         'condition' => [
        //             'ame_marquee_post_vertical!' => 'yes', // Only show for horizontal marquee
        //         ],
        //     ]
        // );

        $this->add_responsive_control(
            'ame_marquee_details_gap',
            [
                'label' => esc_html__('Gap Between Title and Excerpt', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_excerpt' => 'yes', // Only show if excerpt is enabled
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_item_spacing',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Marquee Spacing (in px)', 'advanced-marquee-effect'),
                'placeholder' => '0',
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 16,
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_item_padding',
            [
                'label' => esc_html__('Container Padding', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_container_width',
            [
                'label' => esc_html__('Container Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 280,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 280,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_marquee_container_border',
                'label' => esc_html__('Container Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__item',
            ]
        );

        $this->add_control(
            'ame_marquee_content_alignment',
            [
                'label' => esc_html__('Content Alignment', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'ame_image_style',
            [
                'label' => esc_html__('Image Style', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_marquee_image_width',
            [
                'label' => esc_html__('Image Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 280,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 280,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item_inner img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_image_height',
            [
                'label' => esc_html__('Image Height', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'em', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 320,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item_inner img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_title_heading',
            [
                'label' => esc_html__('Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_title_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__title',
            ]
        );

        $this->add_control(
            'ame_title_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_excerpt_heading',
            [
                'label' => esc_html__('Excerpt', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_excerpt_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__excerpt',
            ]
        );

        $this->add_control(
            'ame_excerpt_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_post_types()
    {
        $post_types = get_post_types(['public' => true], 'objects');
        $options = [];
        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->labels->singular_name;
        }
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Extract and sanitize settings
        $post_type = $settings['post_type'] ?? 'post';
        $posts_per_page = $settings['posts_per_page'] ?? 6;
        $scroll_direction = $settings['ame_marquee_post_vertical'] === 'yes' ? 'vertical' : 'horizontal';
        $vertical_alignment = $settings['ame_marquee_vertical_align'] ?? 'center';
        $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
        $content_alignment = $settings['ame_marquee_content_alignment'] ?? 'center';
        $title_length = isset($settings['ame_marquee_title_length']) ? (int)$settings['ame_marquee_title_length'] : 50;
        $show_excerpt = $settings['ame_marquee_show_excerpt'] === 'yes';
        $excerpt_length = isset($settings['ame_marquee_excerpt_length']) ? (int)$settings['ame_marquee_excerpt_length'] : 20;
        $scroll_speed = $settings['ame_marquee_speed'] ?? '30';
        $is_reversed = $settings['ame_marquee_post_reverse'] === 'yes' ? 'true' : 'false';
        $item_spacing = $settings['ame_marquee_item_spacing'] ?? '10';
        $pause_on_hover = $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false';
        $lazy_load = $settings['ame_marquee_lazy_load'] === 'yes';
        $aliment_item        = $settings['ame_marquee_alignment'] ?? 'top';

        // Query posts
        $args = [
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'post_status' => 'publish',
        ];

        $query = new \WP_Query($args);

        if (!$query->have_posts()) {
            return;
        }
        ?>

        <div class="ame-marquee__wrapper ame-post-marquee"
            aria-label="<?php echo esc_attr__('Post marquee carousel', 'advanced-marquee-effect'); ?>"
            data-marquee-speed="<?php echo esc_attr($scroll_speed); ?>"
            data-marquee-direction="<?php echo esc_attr($scroll_direction); ?>"
            data-marquee-reverse="<?php echo esc_attr($is_reversed); ?>"
            data-marquee-image-space="<?php echo esc_attr($item_spacing); ?>"
            data-marquee-pause-on-hover="<?php echo esc_attr($pause_on_hover); ?>">

            <div class="swiper-wrapper ame-marquee__items <?php echo esc_attr("{$scroll_direction} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}"); ?>">    
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="swiper-slide ame-marquee__item <?php echo esc_attr("ame-aliment-{$aliment_item}"); ?>" role="listitem">
                        <div class="ame-marquee__item_inner ame-align-<?php echo esc_attr($content_alignment); ?>">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="ame-marquee__link">
                                <div class="ame-marquee__image">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium', [
                                            'class' => 'ame-marquee__thumbnail',
                                            'loading' => $lazy_load ? 'lazy' : 'eager',
                                            'alt' => get_the_title(),
                                        ]); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(\Elementor\Utils::get_placeholder_image_src()); ?>"
                                            alt="<?php echo esc_attr(get_the_title()); ?>"
                                            loading="<?php echo $lazy_load ? 'lazy' : 'eager'; ?>" />
                                    <?php endif; ?>
                                </div>

                                <div class="ame-marquee__details">
                                    <h3 class="ame-marquee__title">
                                        <?php echo wp_kses_post(wp_trim_words(get_the_title(), $title_length)); ?>
                                    </h3>
                                    <?php if ($show_excerpt && get_the_excerpt()) : ?>
                                        <p class="ame-marquee__excerpt" aria-label="<?php echo esc_attr__('Post Excerpt', 'advanced-marquee-effect'); ?>">
                                            <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), $excerpt_length)); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

        <?php
    }
}
?>