<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_CTA_Cards_Marquee_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-cta-marquee';
    }

    public function get_title()
    {
        return __('AME CTA Marquee', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-ehp-cta';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'CTA', 'cards', 'carousel', 'slider'];
    }

    public function get_style_depends()
    {
        return ['ame-marquee-style', 'ame-swiper'];
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
                'label' => __('CTA Cards Content', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ame_cta_icon_type',
            [
                'label' => esc_html__('Icon Type', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'icon' => esc_html__('Icon', 'advanced-marquee-effect'),
                    'image' => esc_html__('Image', 'advanced-marquee-effect'),
                ],
                'default' => 'icon',
            ]
        );

        $repeater->add_control(
            'ame_cta_icon',
            [
                'label' => esc_html__('Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'ame_cta_icon_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'ame_cta_image',
            [
                'label' => esc_html__('Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ame_cta_icon_type' => 'image',
                ],
            ]
        );

        $repeater->add_control(
            'ame_cta_title',
            [
                'label' => esc_html__('Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CTA Title', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_cta_description',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('This is a compelling call to action description.', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_cta_button_text',
            [
                'label' => esc_html__('Button Text', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('View More', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_cta_button_link',
            [
                'label' => esc_html__('Button Link', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        $repeater->add_control(
            'ame_cta_enable_card_image',
            [
                'label' => esc_html__('Background Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'ame_cta_card_bg_image',
            [
                'label' => esc_html__('Card Background Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'ame_cta_enable_card_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_cards',
            [
                'label' => esc_html__('CTA Cards', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ame_cta_icon_type' => 'icon',
                        'ame_cta_icon' => [
                            'value' => 'fas fa-star',
                            'library' => 'fa-solid',
                        ],
                        'ame_cta_title' => esc_html__('First CTA', 'advanced-marquee-effect'),
                        'ame_cta_description' => esc_html__('This is a compelling call to action description.', 'advanced-marquee-effect'),
                        'ame_cta_button_text' => esc_html__('View More', 'advanced-marquee-effect'),
                        'ame_cta_button_link' => ['url' => '#'],
                        'ame_cta_enable_card_image' => 'no',
                    ],
                    [
                        'ame_cta_icon_type' => 'icon',
                        'ame_cta_icon' => [
                            'value' => 'fas fa-heart',
                            'library' => 'fa-solid',
                        ],
                        'ame_cta_title' => esc_html__('Second CTA', 'advanced-marquee-effect'),
                        'ame_cta_description' => esc_html__('Another engaging call to action description.', 'advanced-marquee-effect'),
                        'ame_cta_button_text' => esc_html__('View More', 'advanced-marquee-effect'),
                        'ame_cta_button_link' => ['url' => '#'],
                        'ame_cta_enable_card_image' => 'no',
                    ],
                ],
                'title_field' => '{{{ ame_cta_title }}}',
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
            'ame_marquee_show_button',
            [
                'label' => esc_html__('Show Button', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'ame_marquee_show_icon_image',
            [
                'label' => esc_html__('Show Icon/Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ] 
        );


        $this->add_control(
            'ame_marquee_show_card_image',
            [
                'label' => esc_html__('Show Card Background Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
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
                'label' => esc_html__('CTA Card', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
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


        $this->add_control(
            'ame_marquee_background_color',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'background-color: {{VALUE}};',
                ],
                'default' => '#fafafa',
                'condition' => [
                    'ame_marquee_show_card_image!' => 'yes',
                ],
            ]
        );

        $this->add_control(
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
                    'ame_marquee_vertical!' => 'yes',
                ],
                'default' => 'center',
                'toggle' => false,
            ]
        );

        $this->add_control(
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
                    'ame_marquee_vertical' => 'yes',
                ],
                'default' => 'center',
                'toggle' => false,
            ]
        );

        $this->add_control(
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
                    'ame_marquee_vertical!' => 'yes',
                ],
                'default' => 'center',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'ame_marquee_item_spacing',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Card Spacing (in px)', 'advanced-marquee-effect'),
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
            'ame_cta_card_image_style',
            [
                'label' => esc_html__('Card Background Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ame_marquee_show_card_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_background_color_before',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-cta-marquee .ame-marquee__item:before' => 'background-color: {{VALUE}};',
                ],
                'default' => '#0000001F',
                'condition' => [
                    'ame_marquee_show_card_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_card_image_position',
            [
                'label' => esc_html__('Background Position', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__('Center Center', 'advanced-marquee-effect'),
                    'center top' => esc_html__('Center Top', 'advanced-marquee-effect'),
                    'center bottom' => esc_html__('Center Bottom', 'advanced-marquee-effect'),
                    'left top' => esc_html__('Left Top', 'advanced-marquee-effect'),
                    'left center' => esc_html__('Left Center', 'advanced-marquee-effect'),
                    'left bottom' => esc_html__('Left Bottom', 'advanced-marquee-effect'),
                    'right top' => esc_html__('Right Top', 'advanced-marquee-effect'),
                    'right center' => esc_html__('Right Center', 'advanced-marquee-effect'),
                    'right bottom' => esc_html__('Right Bottom', 'advanced-marquee-effect'),
                ],
                'default' => 'center center',
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'background-position: {{VALUE}};',
                ],
                'condition' => [
                    'ame_marquee_show_card_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_card_image_size',
            [
                'label' => esc_html__('Background Size', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'cover' => esc_html__('Cover', 'advanced-marquee-effect'),
                    'contain' => esc_html__('Contain', 'advanced-marquee-effect'),
                    'auto' => esc_html__('Auto', 'advanced-marquee-effect'),
                ],
                'default' => 'cover',
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'background-size: {{VALUE}};',
                ],
                'condition' => [
                    'ame_marquee_show_card_image' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs(
            'ame_icon_image_style_tabs',
        );

        $this->start_controls_tab(
            'ame_cta_icon_style_tab',
            [
                'label' => esc_html__( 'Icon Style', 'advanced-marquee-effect' ),
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_icon_style',
            [
                'label' => esc_html__('Card Icon Style', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_icon_size',
            [
                'label' => esc_html__('Icon Size', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 48,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_icon_color',
            [
                'label' => esc_html__('Icon Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_icon_background',
            [
                'label' => esc_html__('Icon Background', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-icon svg' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_icon_padding',
            [
                'label' => esc_html__('Icon Padding', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-icon svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_icon_border_radius',
            [
                'label' => esc_html__('Icon Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_cta_icon_border',
                'label' => esc_html__('Image Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-icon svg',
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'ame_cta_image_style_tab',
            [
                'label' => esc_html__( 'Image Style', 'advanced-marquee-effect' ),
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_image_style',
            [
                'label' => esc_html__('Card Image Style', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_image_width',
            [
                'label' => esc_html__('Image Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_image_height',
            [
                'label' => esc_html__('Image Height', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-icon img' => 'height: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_cta_image_border',
                'label' => esc_html__('Image Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-icon img',
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_cta_image_border',
                'label' => esc_html__('Image Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-icon img',
                'condition' => [
                    'ame_marquee_show_icon_image' => 'yes',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ame_cta_image_icon_spacing',
            [
                'label' => esc_html__('Icon/Image Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_title_style',
            [
                'label' => esc_html__('Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_cta_title_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-title',
            ]
        );

        $this->add_control(
            'ame_cta_title_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_description_style',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ame_cta_description_spacing',
            [
                'label' => esc_html__('Description Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-description' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_cta_description_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-description',
            ]
        );

        $this->add_control(
            'ame_cta_description_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_button_style',
            [
                'label' => esc_html__('Button', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'ame_button_spacing',
            [
                'label' => esc_html__('Button Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_cta_button_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-button',
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        $this->start_controls_tab(
            'ame_cta_button_normal',
            [
                'label' => esc_html__( 'Normal', 'advanced-marquee-effect' ),
            ]
        );

        $this->add_control(
            'ame_cta_button_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_button_bg_color',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'ame_cta_button_hover',
            [
                'label' => esc_html__( 'Hover', 'advanced-marquee-effect' ),
            ]
        );

        $this->add_control(
            'ame_cta_button_color_hover',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_cta_button_bg_colo_hover',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ame_cta_button_padding',
            [
                'label' => esc_html__('Padding', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_cta_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__cta-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_cta_button_border',
                'label' => esc_html__('Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__cta-button',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Extract and sanitize settings
        $cta_cards            = $settings['ame_cta_cards'] ?? [];
        $scroll_direction     = $settings['ame_marquee_vertical'] === 'yes' ? 'vertical' : 'horizontal';
        $vertical_alignment   = $settings['ame_marquee_vertical_align'] ?? 'center';
        $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
        $content_alignment    = $settings['ame_marquee_content_alignment'] ?? 'center';
        $enable_lazy_load     = !empty($settings['ame_marquee_lazy_load']) && $settings['ame_marquee_lazy_load'] === 'yes';
        $scroll_speed         = $settings['ame_marquee_speed'] ?? '30';
        $is_reversed          = $settings['ame_marquee_reverse'] === 'yes' ? 'true' : 'false';
        $item_spacing         = $settings['ame_marquee_item_spacing'] ?? '10';
        $pause_on_hover       = $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false';
        $aliment_item         = $settings['ame_marquee_alignment'] ?? 'top';
        $show_button          = $settings['ame_marquee_show_button'] === 'yes' ? 'true' : 'false';
        $show_icon_image      = $settings['ame_marquee_show_icon_image'] === 'yes' ? 'true' : 'false';
        $show_card_image      = $settings['ame_marquee_show_card_image'] === 'yes' ? 'true' : 'false';

        if (empty($cta_cards)) {
            return;
        }
        ?>

        <div class="ame-marquee__wrapper ame-cta-marquee"
            aria-label="<?php echo esc_attr__('CTA cards marquee carousel', 'advanced-marquee-effect'); ?>"
            data-marquee-speed="<?php echo esc_attr($scroll_speed); ?>"
            data-marquee-direction="<?php echo esc_attr($scroll_direction); ?>"
            data-marquee-reverse="<?php echo esc_attr($is_reversed); ?>"
            data-marquee-image-space="<?php echo esc_attr($item_spacing); ?>"
            data-marquee-pause-on-hover="<?php echo esc_attr($pause_on_hover); ?>">

            <div class="swiper-wrapper ame-marquee__items <?php echo esc_attr("{$scroll_direction} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}"); ?>">
                <?php foreach ($cta_cards as $cta) :
                    $enable_card_image = $cta['ame_cta_enable_card_image'] === 'yes';
                    $card_bg_image    = $cta['ame_cta_card_bg_image'] ?? [];
                    $card_bg_image_url   = $card_bg_image['url'] ?? '';

                    $icon_type        = $cta['ame_cta_icon_type'] ?? 'icon';
                    $icon             = $cta['ame_cta_icon'] ?? [];
                    $image            = $cta['ame_cta_image'] ?? [];

                    $title            = $cta['ame_cta_title'] ?? '';
                    $description      = $cta['ame_cta_description'] ?? '';
                    $button_text      = $cta['ame_cta_button_text'] ?? '';
                    $button_link      = $cta['ame_cta_button_link']['url'] ?? '#';
                    $button_link_target = $cta['ame_cta_button_link']['is_external'] ? 'target="_blank"' : '';
                    $button_link_nofollow = $cta['ame_cta_button_link']['nofollow'] ? 'rel="nofollow"' : '';
                    
                    $image_url        = $image['url'] ?? '';
                    $image_alt        = $image['alt'] ?? $title;
                    ?>

                    <div class="swiper-slide ame-marquee__item <?php echo esc_attr("ame-aliment-{$aliment_item}"); ?>"
                        style="<?php echo ($show_card_image === 'true' && $enable_card_image && $card_bg_image_url) ? 'background-image: url(' . esc_url($card_bg_image_url) . ');' : ''; ?>"
                        role="listitem">
                        <div class="ame-marquee__item_inner ame-align-<?php echo esc_attr($content_alignment); ?>">
                            <?php if ($show_icon_image === 'true') : ?>
                                <?php if ($icon_type === 'icon' && !empty($icon['value'])) : ?>
                                    <div class="ame-marquee__cta-icon ame-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php elseif ($icon_type === 'image' && !empty($image_url)) : ?>
                                    <div class="ame-marquee__cta-icon">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($image_alt); ?>"
                                            <?php echo $enable_lazy_load ? 'loading="lazy"' : ''; ?> />
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <div class="ame-marquee__cta-content">
                                <?php if (!empty($title)) : ?>
                                    <h4 class="ame-marquee__cta-title">
                                        <?php echo esc_html($title); ?>
                                    </h4>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="ame-marquee__cta-description" aria-label="<?php echo esc_attr__('CTA description', 'advanced-marquee-effect'); ?>">
                                        <?php echo wp_kses_post($description); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($show_button === 'true') : ?>
                                    <?php if (!empty($button_text)) : ?>
                                        <a 
                                            href="<?php echo esc_url($button_link); ?>" 
                                            <?php echo $button_link_target; ?> 
                                            <?php echo $button_link_nofollow; ?> 
                                            class="ame-marquee__cta-button">
                                            <?php echo esc_html($button_text); ?>
                                        </a>
                                    <?php endif; ?>
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