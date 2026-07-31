<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_Marquee_Image_Box_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-marquee-image-box';
    }

    public function get_title()
    {
        return __('AME Image Box Marquee', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-image-box';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'image box', 'card', 'carousel', 'slider', 'animation'];
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
        /* ==================== CONTENT TAB ==================== */
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Image Box Content', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ame_image',
            [
                'label' => esc_html__('Choose Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'ame_title',
            [
                'label' => esc_html__('Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('This is the heading', 'advanced-marquee-effect'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'ame_description',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'advanced-marquee-effect'),
                'rows' => 4,
            ]
        );

        $repeater->add_control(
            'ame_link',
            [
                'label' => esc_html__('Link', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('Type or paste your URL', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $repeater->add_control(
            'ame_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'ame_image_boxes',
            [
                'label' => esc_html__('Image Boxes', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ame_title' => esc_html__('First Feature', 'advanced-marquee-effect'),
                        'ame_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'advanced-marquee-effect'),
                    ],
                    [
                        'ame_title' => esc_html__('Second Feature', 'advanced-marquee-effect'),
                        'ame_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'advanced-marquee-effect'),
                    ],
                    [
                        'ame_title' => esc_html__('Third Feature', 'advanced-marquee-effect'),
                        'ame_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'advanced-marquee-effect'),
                    ],
                ],
                'title_field' => '{{{ ame_title }}}',
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
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_marquee_vertical' => 'yes',
                ]
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

        $this->add_responsive_control(
            'ame_marquee_space_between',
            [
                'label' => esc_html__('Space Between Items', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();

        /* ==================== STYLE TAB ==================== */

        /* --- BOX STYLE SECTION --- */
        $this->start_controls_section(
            'section_style_box',
            [
                'label' => esc_html__('Box', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                        'max' => 1000,
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
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__item' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ame-image-box__item' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_image_position',
            [
                'label' => esc_html__('Image Position', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'top' => [
                        'title' => esc_html__('Top', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'top',
                'prefix_class' => 'ame-image-position-',
            ]
        );

        $this->add_responsive_control(
            'ame_alignment',
            [
                'label' => esc_html__('Alignment', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Start', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__('End', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'center',
                'prefix_class' => 'ame-align%s-',
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .ame-image-box__content' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'ame_image_position' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_box_align_items',
            [
                'label' => esc_html__('Align Items', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'advanced-marquee-effect'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'align-items: {{VALUE}};',
                ],
                'condition' => [
                    'ame_image_position!' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_box_justify_content',
            [
                'label' => esc_html__('Justify Content', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__('Space Between', 'advanced-marquee-effect'),
                        'icon' => 'eicon-h-align-space-between',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'ame_image_position!' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_content_text_align',
            [
                'label' => esc_html__('Text Alignment', 'advanced-marquee-effect'),
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
                    'justify' => [
                        'title' => esc_html__('Justified', 'advanced-marquee-effect'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__content' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .ame-image-box__title' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .ame-image-box__description' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'ame_image_position!' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_image_spacing',
            [
                'label' => esc_html__('Image Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}.ame-image-position-top .ame-image-box__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.ame-image-position-left .ame-image-box__image' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.ame-image-position-right .ame-image-box__image' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_content_spacing',
            [
                'label' => esc_html__('Content Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_box_style');

        $this->start_controls_tab(
            'tab_box_normal',
            [
                'label' => esc_html__('Normal', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_box_bg_color',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FAFAFA',
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ame_box_shadow',
                'selector' => '{{WRAPPER}} .ame-image-box__item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_box_hover',
            [
                'label' => esc_html__('Hover', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_box_bg_color_hover',
            [
                'label' => esc_html__('Background Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ame_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ame-image-box__item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'ame_box_padding',
            [
                'label' => esc_html__('Padding', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_box_border',
                'selector' => '{{WRAPPER}} .ame-image-box__item',
            ]
        );

        $this->add_responsive_control(
            'ame_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /* --- IMAGE STYLE SECTION --- */
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'ame_image_width',
            [
                'label' => esc_html__('Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__image img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .ame-image-box__image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_image_height',
            [
                'label' => esc_html__('Height', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_image_border',
                'selector' => '{{WRAPPER}} .ame-image-box__image img',
            ]
        );

        $this->add_responsive_control(
            'ame_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_image_style');

        $this->start_controls_tab(
            'tab_image_normal',
            [
                'label' => esc_html__('Normal', 'advanced-marquee-effect'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ame_image_box_shadow',
                'selector' => '{{WRAPPER}} .ame-image-box__image img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'ame_image_css_filters',
                'selector' => '{{WRAPPER}} .ame-image-box__image img',
            ]
        );

        $this->add_control(
            'ame_image_opacity',
            [
                'label' => esc_html__('Opacity', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover',
            [
                'label' => esc_html__('Hover', 'advanced-marquee-effect'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ame_image_box_shadow_hover',
                'selector' => '{{WRAPPER}} .ame-image-box__item:hover .ame-image-box__image img',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'ame_image_css_filters_hover',
                'selector' => '{{WRAPPER}} .ame-image-box__item:hover .ame-image-box__image img',
            ]
        );

        $this->add_control(
            'ame_image_opacity_hover',
            [
                'label' => esc_html__('Opacity', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item:hover .ame-image-box__image img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* --- TITLE STYLE SECTION --- */
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_title_typography',
                'selector' => '{{WRAPPER}} .ame-image-box__title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'ame_title_text_stroke',
                'selector' => '{{WRAPPER}} .ame-image-box__title',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ame_title_text_shadow',
                'selector' => '{{WRAPPER}} .ame-image-box__title',
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_title_color',
            [
                'label' => esc_html__('Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__title, {{WRAPPER}} .ame-image-box__title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_title_color_hover',
            [
                'label' => esc_html__('Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__item:hover .ame-image-box__title, {{WRAPPER}} .ame-image-box__item:hover .ame-image-box__title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* --- DESCRIPTION STYLE SECTION --- */
        $this->start_controls_section(
            'section_style_description',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_description_typography',
                'selector' => '{{WRAPPER}} .ame-image-box__description',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ame_description_text_shadow',
                'selector' => '{{WRAPPER}} .ame-image-box__description',
            ]
        );

        $this->add_control(
            'ame_description_color',
            [
                'label' => esc_html__('Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-image-box__description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = $settings['ame_image_boxes'];

        if (empty($items)) {
            return;
        }

        $speed = !empty($settings['ame_marquee_speed']) ? esc_attr($settings['ame_marquee_speed']) : 3000;
        $stop_on_hover = ('yes' === $settings['ame_marquee_stop_on_hover']) ? 'true' : 'false';
        $reverse = ('yes' === $settings['ame_marquee_reverse']) ? 'true' : 'false';
        $vertical = ('yes' === $settings['ame_marquee_vertical']) ? 'vertical' : 'horizontal';
        $vertical_alignment = $settings['ame_marquee_vertical_align'] ?? 'center';
        $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
        $space_between = isset($settings['ame_marquee_space_between']['size']) ? $settings['ame_marquee_space_between']['size'] : 20;

        $this->add_render_attribute('marquee_wrapper', [
            'class' => ['ame-marquee__wrapper', 'ame-image-box-marquee', 'swiper', 'swiper-container'],
            'data-marquee-speed' => $speed,
            'data-marquee-pause-on-hover' => $stop_on_hover,
            'data-marquee-reverse' => $reverse,
            'data-marquee-direction' => $vertical,
            'data-marquee-image-space' => $space_between,
        ]);

        ?>
        <div <?php echo $this->get_render_attribute_string('marquee_wrapper'); ?>>
            <div class="ame-marquee__items swiper-wrapper <?php echo esc_attr("{$vertical} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}"); ?>">
                <?php foreach ($items as $index => $item) :
                    $item_key = 'image_box_' . $index;
                    $has_link = !empty($item['ame_link']['url']);
                    $link_attributes = '';

                    if ($has_link) {
                        $this->add_link_attributes($item_key, $item['ame_link']);
                        $link_attributes = $this->get_render_attribute_string($item_key);
                    }

                    $title_tag = \Elementor\Utils::validate_html_tag($item['ame_title_tag']);
                    $lazy_load = ('yes' === $settings['ame_marquee_lazy_load']);
                    ?>
                    <div class="ame-marquee__item ame-image-box__item swiper-slide">
                        <?php if (!empty($item['ame_image']['url'])) : ?>
                            <div class="ame-image-box__image">
                                <?php if ($has_link) : ?><a <?php echo $link_attributes; ?>><?php endif; ?>
                                <img src="<?php echo esc_url($item['ame_image']['url']); ?>"
                                     alt="<?php echo esc_attr($item['ame_title']); ?>"
                                     <?php if ($lazy_load) echo 'loading="lazy"'; ?>>
                                <?php if ($has_link) : ?></a><?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php 
                        $has_title = !empty($item['ame_title']);
                        $has_description = !empty($item['ame_description']);
                        if ($has_title || $has_description) : 
                        ?>
                            <div class="ame-image-box__content">
                                <?php if ($has_title) : ?>
                                    <<?php echo $title_tag; ?> class="ame-image-box__title">
                                        <?php if ($has_link) : ?><a <?php echo $link_attributes; ?>><?php endif; ?>
                                        <?php echo esc_html($item['ame_title']); ?>
                                        <?php if ($has_link) : ?></a><?php endif; ?>
                                    </<?php echo $title_tag; ?>>
                                <?php endif; ?>

                                <?php if ($has_description) : ?>
                                    <div class="ame-image-box__description">
                                        <?php echo wp_kses_post($item['ame_description']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}
