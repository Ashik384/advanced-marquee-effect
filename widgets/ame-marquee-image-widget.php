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
        return __('Marquee Image', 'advanced-marquee-effect');
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
        return ['ame', 'marquee', 'animation', 'marquee text', 'running'];
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
            'ame_marquee_link_settings',
            [
                'label' => esc_html__('Link Settings', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_marquee_show_caption_description',
            [
                'label' => esc_html__( 'Show Caption & Description', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'advanced-marquee-effect' ),
                'label_off' => esc_html__( 'Hide', 'advanced-marquee-effect' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        

        $this->add_control(
            'ame_marquee_link_is_external',
            [
                'label' => esc_html__('Open Links in New Tab', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
        $this->add_control(
            'ame_marquee_link_nofollow',
            [
                'label' => esc_html__('Add nofollow to Links', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'max' => 90000,
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
                'label' => esc_html__('Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_vertical_align',
            [
                'label' => esc_html__( 'Vertical Alignment', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'ame_marquee_horizontal_align',
            [
                'label' => esc_html__( 'Horizontal Alignment', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Top', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_image_height',
            [
                'label' => esc_html__( 'Image Height', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 320,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 320,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item_inner img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_container_width',
            [
                'label' => esc_html__( 'Container Width', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em', 'vw' ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 100,
                        'max' => 320,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 10,
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
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_marquee_container_border',
                'label' => esc_html__( 'Container Border', 'advanced-marquee-effect' ),
                'selector' => '{{WRAPPER}} .ame-marquee__item',
            ]
        );        
        
        

        $this->add_control(
            'ame_marquee_item_spacing',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Image Spacing (in px)', 'advanced-marquee-effect'),
                'placeholder' => '0',
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 8,
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

        $this->add_responsive_control(
            'ame_marquee_item_padding',
            [
                'label' => esc_html__( 'Container Padding', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ '%', 'px', 'em', 'vw' ],
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
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_content_alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'advanced-marquee-effect' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
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

        $is_external = $settings['ame_marquee_link_is_external'] === 'yes';
        $nofollow = $settings['ame_marquee_link_nofollow'] === 'yes';

        $target = $is_external ? ' target="_blank"' : '';
        $rel = $nofollow ? ' rel="nofollow"' : '';

        if (empty($ame_marquee_images)) {
            return;
        }
?>

        <div class="ame-marquee__wrapper" aria-label="Image marquee carousel"
            data-marquee-speed="<?php echo esc_attr($settings['ame_marquee_speed']) ?>"
            data-marquee-direction="<?php echo esc_attr($ame_marquee_direction) ?>"
            data-marquee-reverse="<?php echo esc_attr($settings['ame_marquee_image_reverse']) === 'yes' ? 'true' : 'false' ?>"
            data-marquee-image-space="<?php echo esc_attr($settings['ame_marquee_item_spacing']) ?>"
            data-marquee-pause-on-hover="<?php echo $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false'; ?>">


            <div class="swiper-wrapper ame-marquee__items 
            <?php echo $ame_marquee_direction; ?>
            ame-align-v-<?php echo $ame_alignment_vertical; ?>
            ame-align-h-<?php echo $ame_alignment_horizontal; ?> ">

                <?php foreach ($ame_marquee_images as $index => $image_item) :
                    $image = $image_item['ame_marquee_image'];
                    $attachment_id = isset($image['id']) ? $image['id'] : null;
                    $image_url = isset($image['url']) ? $image['url'] : '';
                    $image_alt = isset($image['alt']) ? $image['alt'] : '';
                    $marquee_url = $image_item['ame_marquee_link'];

                    // Get caption/description only if ID is valid
                    $caption = $attachment_id ? wp_get_attachment_caption($attachment_id) : '';
                    $description = $attachment_id ? get_post_field('post_content', $attachment_id) : '';
                ?>
                    <div class="swiper-slide ame-marquee__item">
                        <div class="ame-marquee__item_inner ame-align-<?php echo $ame_content_alignment; ?>">
                            <div class="ame-marquee__image">

                                <?php if (!empty($marquee_url['url'])) : ?>
                                    <a href="<?php echo esc_url($marquee_url['url']);?>" <?php echo $target . $rel; ?>> <?php endif; ?>
                                    <img src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($image_alt); ?>"
                                        loading="lazy">
                                    <?php if (!empty($marquee_url['url'])) : ?> </a> <?php endif; ?>
                            </div>
                            <?php if ( 'yes' === $settings['ame_marquee_show_caption_description'] ) : ?>
                            <?php if (!empty($caption) || !empty($description)) : ?>
                                <?php if (!empty($marquee_url['url'])) : ?>
                                    <a href="<?php echo esc_url($marquee_url['url']); ?>">
                                    <?php endif; ?>
                                    <div class="ame-marquee__details">
                                        <?php if (!empty($caption)) : ?>
                                            <p class="ame-marquee__caption" aria-label="Image Caption">
                                                <?php echo wp_kses_post($caption); ?>
                                            </p>
                                        <?php endif; ?>

                                        <?php if (!empty($description)) : ?>
                                            <p class="ame-marquee__description" aria-label="Image Description">
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