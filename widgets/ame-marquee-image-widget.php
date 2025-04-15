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
        return ['ame-marquee-image'];
    }

    public function get_script_depends()
    {
        return ['ame-marquee-script'];
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
                'default' => 'yes',
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
                'label' => __('Vertical', 'advanced-marquee-effect'),
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
                        'max' => 1000,
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
                'toggle' => true,
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
                'toggle' => true,
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
                'default' => 8,
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
                    'unit' => 'px',
                    'size' => 320,
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
                    'unit' => 'px',
                    'size' => 280,
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
        $ame_marquee_images = $settings['ame_marquee_images'];
        $ame_marquee_direction = $settings['ame_marquee_image_vertical'] === 'yes' ? 'vertical' : 'horizontal';
        $ame_alignment_vertical = $settings['ame_marquee_vertical_align'];
        $ame_alignment_horizontal = $settings['ame_marquee_horizontal_align'];
        $ame_content_alignment = $settings['ame_marquee_content_alignment'];
        $lazy_load_enabled = ! empty($settings['ame_marquee_lazy_load']) && $settings['ame_marquee_lazy_load'] === 'yes';

        if (empty($ame_marquee_images)) {
            return;
        }
?>

        <div class="ame-marquee__wrapper" aria-label="<?php esc_attr_e( 'Image marquee carousel', 'advanced-marquee-effect' ); ?>"
            data-marquee-speed="<?php echo esc_attr($settings['ame_marquee_speed']) ?>"
            data-marquee-direction="<?php echo esc_attr($ame_marquee_direction) ?>"
            data-marquee-reverse="<?php echo esc_attr($settings['ame_marquee_image_reverse']) === 'yes' ? 'true' : 'false' ?>"
            data-marquee-image-space="<?php echo esc_attr($settings['ame_marquee_item_spacing']) ?>"
            data-marquee-pause-on-hover="<?php echo $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false' ?>">

            <div class="swiper-wrapper ame-marquee__items 
                <?php echo $ame_marquee_direction; ?>
                ame-align-v-<?php echo $ame_alignment_vertical; ?>
                ame-align-h-<?php echo $ame_alignment_horizontal; ?> ">

                <?php foreach ($ame_marquee_images as $image_item) :
                    $image = $image_item['ame_marquee_image'];

                    if (is_array($image) && isset($image['url'])) {
                        $image_url = !empty($image['url']) ? $image['url'] : '';
                        $image_alt = !empty($image['alt']) ? $image['alt'] : '';
                    }
                    // Get link
                    $marquee_url = $image_item['ame_marquee_link'];
                    $is_external = !empty($marquee_url['is_external']);
                    $nofollow = !empty($marquee_url['nofollow']);
                    $target = $is_external ? ' target="_blank"' : '';
                    $rel = $nofollow ? ' rel="nofollow"' : '';

                    // Get caption/description only if ID is valid
                    $attachment_id = isset($image['id']) ? $image['id'] : null;
                    $caption = !empty($attachment_id) ? wp_get_attachment_caption($attachment_id) : '';
                    $description = !empty($attachment_id) ? get_post_field('post_content', $attachment_id) : ''; 
                ?>
                    <div class="swiper-slide ame-marquee__item" role="group">
                        <div class="ame-marquee__item_inner ame-align-<?php echo $ame_content_alignment; ?>">
                        <div class="ame-marquee__image">
                            <?php if (!empty($marquee_url['url'])) : ?>
                                <a href="<?php echo esc_url($marquee_url['url']); ?>" <?php echo $target; ?><?php echo $rel; ?>>
                            <?php endif; ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>"
                                    <?php if ($lazy_load_enabled) : ?> loading="lazy" <?php endif; ?>>
                            <?php if (!empty($marquee_url['url'])) : ?>
                                </a>
                            <?php endif; ?>
                        </div>
                            <?php if ('yes' === $settings['ame_marquee_show_caption_description']) : ?>
                                <?php if (!empty($caption) || !empty($description)) : ?>
                                    <?php if (!empty($marquee_url['url'])) : ?>
                                        <a href="<?php echo esc_url($marquee_url['url']); ?>" <?php echo $target; ?><?php echo $rel; ?>>
                                        <?php endif; ?>
                                        <div class="ame-marquee__details">
                                            <?php if (!empty($caption)) : ?>
                                                <p class="ame-marquee__caption" aria-label="<?php esc_attr_e( 'Image Caption', 'advanced-marquee-effect' ); ?>">
                                                    <?php echo wp_kses_post($caption); ?>
                                                </p>
                                            <?php endif; ?>

                                            <?php if (!empty($description)) : ?>
                                                <p class="ame-marquee__description" aria-label="<?php esc_attr_e( 'Image Description', 'advanced-marquee-effect' ); ?>">
                                                    <?php echo wp_kses_post($description); ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if (!empty($marquee_url['url'])) : ?>
                                        </a> <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

<?php
    }
}
?>