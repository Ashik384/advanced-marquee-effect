<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_Marquee_Image_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-marquee-image';
    }

    public function get_title()
    {
        return __('AME Marquee Image', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-slider-album';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'animation', 'marquee text', 'running', 'image', 'marquee image'];
    }

    public function get_style_depends()
    {
        return ['ame-marquee-image', 'ame-swiper'];
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ame_marquee_image',
            [
                'label' => esc_html__('Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'ame_marquee_link',
            [
                'label' => esc_html__('Image Link', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'advanced-marquee-effect'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_images',
            [
                'label' => esc_html__('Marquee Images', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ame_marquee_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                            'alt' => 'Image'
                        ],
                    ],
                    [
                        'ame_marquee_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                            'alt' => 'Image'
                        ],
                    ],
                    [
                        'ame_marquee_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                            'alt' => 'Image'
                        ],
                    ],
                ],
                'title_field' => '{{{ ame_marquee_image.alt || "Image" }}}',
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
            'ame_marquee_show_caption_description',
            [
                'label' => esc_html__('Caption & Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'advanced-marquee-effect'),
                'label_off' => esc_html__('Hide', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => '',
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

        // marquee reverse 
        $this->add_control(
            'ame_marquee_image_reverse',
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
                'default' => '',
            ]
        );


        $this->add_control(
            'ame_marquee_image_vertical',
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
                'devices' => ['desktop', 'tablet', 'mobile'],
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
                    'ame_marquee_image_vertical' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        // style tab 
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'ame_marquee_image_style',
            [
                'label' => esc_html__('Marquee Card', 'advanced-marquee-effect'),
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

        // Border Radius
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
            'ame_caption_heading',
            [
                'label' => esc_html__('Caption', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_caption_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__caption',
            ]
        );

        $this->add_control(
            'ame_caption_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__caption' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_description_heading',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_description_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__description',
            ]
        );

        $this->add_control(
            'ame_description_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
{
    $settings = $this->get_settings_for_display();

    // Extract and sanitize settings
    $image_items          = $settings['ame_marquee_images'] ?? [];
    $scroll_direction     = $settings['ame_marquee_image_vertical'] === 'yes' ? 'vertical' : 'horizontal';
    $vertical_alignment   = $settings['ame_marquee_vertical_align'] ?? 'center';
    $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
    $content_alignment    = $settings['ame_marquee_content_alignment'] ?? 'center';
    $enable_lazy_load     = !empty($settings['ame_marquee_lazy_load']) && $settings['ame_marquee_lazy_load'] === 'yes';
    $show_text_details    = $settings['ame_marquee_show_caption_description'] === 'yes';
    $scroll_speed         = $settings['ame_marquee_speed'] ?? '30';
    $is_reversed          = $settings['ame_marquee_image_reverse'] === 'yes' ? 'true' : 'false';
    $item_spacing         = $settings['ame_marquee_item_spacing'] ?? '10';
    $pause_on_hover       = $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false';

    if (empty($image_items)) {
        return;
    }
    ?>

    <div class="ame-marquee__wrapper"
        aria-label="<?php echo esc_attr__('Image marquee carousel', 'advanced-marquee-effect'); ?>"
        data-marquee-speed="<?php echo esc_attr($scroll_speed); ?>"
        data-marquee-direction="<?php echo esc_attr($scroll_direction); ?>"
        data-marquee-reverse="<?php echo esc_attr($is_reversed); ?>"
        data-marquee-image-space="<?php echo esc_attr($item_spacing); ?>"
        data-marquee-pause-on-hover="<?php echo esc_attr($pause_on_hover); ?>">

        <div class="swiper-wrapper ame-marquee__items <?php echo esc_attr("{$scroll_direction} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}"); ?>">
            <?php foreach ($image_items as $item) :
                $image_data     = $item['ame_marquee_image'] ?? [];
                $image_url      = $image_data['url'] ?? '';
                $image_alt      = $image_data['alt'] ?? '';
                $image_id       = $image_data['id'] ?? null;
                $image_caption  = $image_id ? wp_get_attachment_caption($image_id) : '';
                $image_content  = $image_id ? get_post_field('post_content', $image_id) : '';

                $link_data      = $item['ame_marquee_link'] ?? [];
                $has_link       = !empty($link_data['url']);
                $link_url       = $has_link ? esc_url($link_data['url']) : '';
                $link_target    = !empty($link_data['is_external']) ? ' target="_blank"' : '';
                $link_rel       = !empty($link_data['nofollow']) ? ' rel="nofollow"' : '';
                ?>

                <div class="swiper-slide ame-marquee__item" role="listitem">
                    <div class="ame-marquee__item_inner ame-align-<?php echo esc_attr($content_alignment); ?>">
                        <div class="ame-marquee__image">
                            <?php if ($has_link) : ?>
                                <a href="<?php echo $link_url; ?>" <?php echo $link_target . $link_rel; ?>>
                            <?php endif; ?>

                            <img src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($image_alt); ?>"
                                <?php echo $enable_lazy_load ? 'loading="lazy"' : ''; ?> />

                            <?php if ($has_link) : ?></a><?php endif; ?>
                        </div>

                        <?php if ($show_text_details && (!empty($image_caption) || !empty($image_content))) : ?>
                            <?php if ($has_link) : ?><a href="<?php echo $link_url; ?>" <?php echo $link_target . $link_rel; ?>><?php endif; ?>
                                <div class="ame-marquee__details">
                                    <?php if (!empty($image_caption)) : ?>
                                        <p class="ame-marquee__caption" aria-label="<?php echo esc_attr__('Image Caption', 'advanced-marquee-effect'); ?>">
                                            <?php echo wp_kses_post($image_caption); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($image_content)) : ?>
                                        <p class="ame-marquee__description" aria-label="<?php echo esc_attr__('Image Description', 'advanced-marquee-effect'); ?>">
                                            <?php echo wp_kses_post($image_content); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            <?php if ($has_link) : ?></a><?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
}
} ?>