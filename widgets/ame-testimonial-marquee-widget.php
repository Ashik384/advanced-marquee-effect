<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_Testimonials_Marquee_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-testimonials-marquee';
    }

    public function get_title()
    {
        return __('AME Testimonials Marquee', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'testimonials', 'reviews', 'carousel', 'slider'];
    }

    public function get_style_depends()
    {
        return ['ame-testimonials-marquee', 'ame-swiper'];
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
                'label' => __('Testimonials Content', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ame_testimonial_content',
            [
                'label' => esc_html__('Testimonial Text', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('This is an amazing product! Highly recommend it.', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_testimonial_author',
            [
                'label' => esc_html__('Author Name', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_testimonial_author_title',
            [
                'label' => esc_html__('Author Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Customer', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_testimonial_image',
            [
                'label' => esc_html__('Author Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'ame_testimonials',
            [
                'label' => esc_html__('Testimonials', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ame_testimonial_content' => esc_html__('This is an amazing product! Highly recommend it.', 'advanced-marquee-effect'),
                        'ame_testimonial_author' => esc_html__('John Doe', 'advanced-marquee-effect'),
                        'ame_testimonial_author_title' => esc_html__('Customer', 'advanced-marquee-effect'),
                        'ame_testimonial_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'ame_testimonial_content' => esc_html__('Fantastic service and quality!', 'advanced-marquee-effect'),
                        'ame_testimonial_author' => esc_html__('Jane Smith', 'advanced-marquee-effect'),
                        'ame_testimonial_author_title' => esc_html__('Client', 'advanced-marquee-effect'),
                        'ame_testimonial_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ ame_testimonial_author }}}',
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
            'ame_marquee_reverse',
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
            'ame_marquee_lazy_load',
            [
                'label' => esc_html__('Lazy Load Images', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ame_marquee_vertical',
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
                    'ame_marquee_vertical' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ame_marquee_card_style',
            [
                'label' => esc_html__('Testimonial Card', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
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
                'default' => 'center',
                'toggle' => false,
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
                ],
                'default' => 'center',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'ame_marquee_equal_height',
            [
                'label' => esc_html__('Equal Height Slides', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'ame_marquee_vertical!' => 'yes', // Only show for horizontal marquee
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_item_spacing',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Testimonial Spacing (in px)', 'advanced-marquee-effect'),
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
                    'top' => 20,
                    'right' => 20,
                    'bottom' => 20,
                    'left' => 20,
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
                        'max' => 400,
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
                    'size' => 350,
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
            'ame_testimonial_text_style',
            [
                'label' => esc_html__('Testimonial Text', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_testimonial_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__testimonial-text',
            ]
        );

        $this->add_control(
            'ame_testimonial_text_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__testimonial-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_author_image_style',
            [
                'label' => esc_html__('Author Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_author_image_width',
            [
                'label' => esc_html__('Image Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__author-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_author_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__author-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_author_name_style',
            [
                'label' => esc_html__('Author Name', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_author_name_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__author-name',
            ]
        );

        $this->add_control(
            'ame_author_name_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__author-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_author_title_style',
            [
                'label' => esc_html__('Author Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_author_title_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__author-title',
            ]
        );

        $this->add_control(
            'ame_author_title_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__author-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Extract and sanitize settings
        $testimonials         = $settings['ame_testimonials'] ?? [];
        $scroll_direction     = $settings['ame_marquee_vertical'] === 'yes' ? 'vertical' : 'horizontal';
        $vertical_alignment   = $settings['ame_marquee_vertical_align'] ?? 'center';
        $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
        $content_alignment    = $settings['ame_marquee_content_alignment'] ?? 'center';
        $enable_lazy_load     = !empty($settings['ame_marquee_lazy_load']) && $settings['ame_marquee_lazy_load'] === 'yes';
        $scroll_speed         = $settings['ame_marquee_speed'] ?? '30';
        $is_reversed          = $settings['ame_marquee_reverse'] === 'yes' ? 'true' : 'false';
        $item_spacing         = $settings['ame_marquee_item_spacing'] ?? '10';
        $pause_on_hover       = $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false';

        if (empty($testimonials)) {
            return;
        }
        ?>

        <div class="ame-marquee__wrapper"
            aria-label="<?php echo esc_attr__('Testimonials marquee carousel', 'advanced-marquee-effect'); ?>"
            data-marquee-speed="<?php echo esc_attr($scroll_speed); ?>"
            data-marquee-direction="<?php echo esc_attr($scroll_direction); ?>"
            data-marquee-reverse="<?php echo esc_attr($is_reversed); ?>"
            data-marquee-image-space="<?php echo esc_attr($item_spacing); ?>"
            data-marquee-pause-on-hover="<?php echo esc_attr($pause_on_hover); ?>">

            <div class="swiper-wrapper ame-marquee__items <?php echo esc_attr("{$scroll_direction} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}" . ($settings['ame_marquee_equal_height'] === 'yes' && $scroll_direction === 'horizontal' ? ' ame-equal-height' : '')); ?>">
                <?php foreach ($testimonials as $testimonial) :
                    $content      = $testimonial['ame_testimonial_content'] ?? '';
                    $author       = $testimonial['ame_testimonial_author'] ?? '';
                    $author_title = $testimonial['ame_testimonial_author_title'] ?? '';
                    $image_data   = $testimonial['ame_testimonial_image'] ?? [];
                    $image_url    = $image_data['url'] ?? '';
                    $image_alt    = $image_data['alt'] ?? $author;
                    ?>

                    <div class="swiper-slide ame-marquee__item" role="listitem">
                        <div class="ame-marquee__item_inner ame-align-<?php echo esc_attr($content_alignment); ?>">
                            <?php if (!empty($image_url)) : ?>
                                <div class="ame-marquee__author-image">
                                    <img src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($image_alt); ?>"
                                        <?php echo $enable_lazy_load ? 'loading="lazy"' : ''; ?> />
                                </div>
                            <?php endif; ?>

                            <div class="ame-marquee__testimonial-content">
                                <?php if (!empty($content)) : ?>
                                    <p class="ame-marquee__testimonial-text" aria-label="<?php echo esc_attr__('Testimonial', 'advanced-marquee-effect'); ?>">
                                        <?php echo wp_kses_post($content); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($author) || !empty($author_title)) : ?>
                                    <div class="ame-marquee__author-details">
                                        <?php if (!empty($author)) : ?>
                                            <h4 class="ame-marquee__author-name">
                                                <?php echo esc_html($author); ?>
                                            </h4>
                                        <?php endif; ?>
                                        <?php if (!empty($author_title)) : ?>
                                            <p class="ame-marquee__author-title">
                                                <?php echo esc_html($author_title); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}
?>