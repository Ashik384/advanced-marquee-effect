<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly

class AME_Marquee_Team_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'ame-team-marquee';
    }

    public function get_title()
    {
        return __('AME Team Marquee', 'advanced-marquee-effect');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['ame_marquee_effect'];
    }

    public function get_keywords()
    {
        return ['ame', 'marquee', 'team', 'member', 'slider'];
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
                'label' => __('Team Content', 'advanced-marquee-effect'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'ame_team_member_name',
            [
                'label' => esc_html__('Member Name', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_team_member_designation',
            [
                'label' => esc_html__('Designation', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Manager', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_team_member_description',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('Lorem ipsum dolor sit amet.', 'advanced-marquee-effect'),
            ]
        );

        $repeater->add_control(
            'ame_team_member_image',
            [
                'label' => esc_html__('Profile Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );  

        $repeater->add_control(
            'ame_team_member_show_past_exp',
            [
                'label' => esc_html__('Show Past Experience', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $repeater->add_control(
            'ame_team_member_past_exp_title',
            [
                'label' => esc_html__('Past Experience Title', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Past Experience', 'advanced-marquee-effect'),
                'condition' => [
                    'ame_team_member_show_past_exp' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_past_exp_details',
            [
                'label' => esc_html__('Experience Details', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('5+ Years of Experience', 'advanced-marquee-effect'),
                'condition' => [
                    'ame_team_member_show_past_exp' => 'yes',
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_social_icons',
            [
                'label' => esc_html__('Social Icons', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'ame_team_member_linkedin',
            [
                'label' => esc_html__('LinkedIn', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://linkedin.com', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_linkedin_icon',
            [
                'label' => esc_html__('LinkedIn Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-linkedin',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'linkedin',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_twitter',
            [
                'label' => esc_html__('Twitter', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://twitter.com', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_twitter_icon',
            [
                'label' => esc_html__('Twitter Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-twitter',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'twitter',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_facebook',
            [
                'label' => esc_html__('Facebook', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://facebook.com', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_facebook_icon',
            [
                'label' => esc_html__('Facebook Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-facebook',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'facebook',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_instagram',
            [
                'label' => esc_html__('Instagram', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://instagram.com', 'advanced-marquee-effect'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $repeater->add_control(
            'ame_team_member_instagram_icon',
            [
                'label' => esc_html__('Instagram Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-instagram',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'instagram',
                    ],
                ],
            ]
        );

        $this->add_control(
            'ame_team_members',
            [
                'label' => esc_html__('Team Members', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'ame_team_member_name' => esc_html__('John Doe', 'advanced-marquee-effect'),
                        'ame_team_member_designation' => esc_html__('Software Engineering', 'advanced-marquee-effect'),
                        'ame_team_member_description' => esc_html__('Lorem ipsum dolor sit amet.', 'advanced-marquee-effect'),
                        'ame_team_member_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'ame_team_member_name' => esc_html__('David Chen', 'advanced-marquee-effect'),
                        'ame_team_member_designation' => esc_html__('Product Designer', 'advanced-marquee-effect'),
                        'ame_team_member_description' => esc_html__('Consectetur adipiscing elit.', 'advanced-marquee-effect'),
                        'ame_team_member_image' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                ],
                'title_field' => '{{{ ame_team_member_name }}}',
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
                'default' => 'yes',
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
                'label' => esc_html__('Team Member Card', 'advanced-marquee-effect'),
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
                'label' => esc_html__('Team Member Spacing (in px)', 'advanced-marquee-effect'),
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
            'ame_member_image_style',
            [
                'label' => esc_html__('Member Image', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_member_image_width',
            [
                'label' => esc_html__('Image Width', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 120,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__member-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_image_spacing',
            [
                'label' => esc_html__('Image Spacing', 'advanced-marquee-effect'),
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
                    '{{WRAPPER}} .ame-marquee__member-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ame_member_image_border_radius',
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
                    '{{WRAPPER}} .ame-marquee__member-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'ame_member_image_border',
                'label' => esc_html__('Image Border', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__member-image img',
            ]
        );

        $this->add_control(
            'ame_member_name_style',
            [
                'label' => esc_html__('Member Name', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_member_name_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__member-name',
            ]
        );

        $this->add_control(
            'ame_member_name_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_name_space',
            [
                'label' => esc_html__('Spacing', 'advanced-marquee-effect'),
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
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'ame_member_designation_style',
            [
                'label' => esc_html__('Designation', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_member_designation_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__member-designation',
            ]
        );

        $this->add_control(
            'ame_member_designation_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__member-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_description_style',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_member_description_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__member-description',
            ]
        );

        $this->add_control(
            'ame_member_description_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__member-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_past-exp_style',
            [
                'label' => esc_html__('Past Experience', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_member_past-exp_title_typography',
                'label' => esc_html__('Title Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__past-exp h5',
            ]
        );

        $this->add_control(
            'ame_member__past-exp_title_color',
            [
                'label' => esc_html__('Title Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__past-exp h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_member_past-exp_description_typography',
                'label' => esc_html__('Description Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__past-exp p',
            ]
        );

        $this->add_control(
            'ame_member_past-exp_description_color',
            [
                'label' => esc_html__('Description Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__past-exp p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_social_style',
            [
                'label' => esc_html__('Social Icons', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_member_social_icon_spacing',
            [
                'label' => esc_html__('Spacing', 'advanced-marquee-effect'),
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
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-icons' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_social_icon_bg_color',
            [
                'label' => esc_html__('Background', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons .social-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_social_icon_color',
            [
                'label' => esc_html__('Icon Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .social-icons .social-icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_social_icon_size',
            [
                'label' => esc_html__('Icon Size', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 32,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-icons .social-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_member_social_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .social-icons' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Extract and sanitize settings
        $team_members         = $settings['ame_team_members'] ?? [];
        $scroll_direction     = $settings['ame_marquee_vertical'] === 'yes' ? 'vertical' : 'horizontal';
        $vertical_alignment   = $settings['ame_marquee_vertical_align'] ?? 'center';
        $horizontal_alignment = $settings['ame_marquee_horizontal_align'] ?? 'center';
        $content_alignment    = $settings['ame_marquee_content_alignment'] ?? 'center';
        $enable_lazy_load     = !empty($settings['ame_marquee_lazy_load']) && $settings['ame_marquee_lazy_load'] === 'yes';
        $scroll_speed         = $settings['ame_marquee_speed'] ?? '3000';
        $is_reversed          = $settings['ame_marquee_reverse'] === 'yes' ? 'true' : 'false';
        $item_spacing         = $settings['ame_marquee_item_spacing'] ?? '16';
        $pause_on_hover       = $settings['ame_marquee_stop_on_hover'] === 'yes' ? 'true' : 'false';
        $aliment_item         = $settings['ame_marquee_alignment'] ?? 'center';

        if (empty($team_members)) {
            return;
        }
        ?>

        <div class="ame-marquee__wrapper ame-team-marquee"
            aria-label="<?php echo esc_attr__('Team members marquee carousel', 'advanced-marquee-effect'); ?>"
            data-marquee-speed="<?php echo esc_attr($scroll_speed); ?>"
            data-marquee-direction="<?php echo esc_attr($scroll_direction); ?>"
            data-marquee-reverse="<?php echo esc_attr($is_reversed); ?>"
            data-marquee-image-space="<?php echo esc_attr($item_spacing); ?>"
            data-marquee-pause-on-hover="<?php echo esc_attr($pause_on_hover); ?>">

            <div class="swiper-wrapper ame-marquee__items <?php echo esc_attr("{$scroll_direction} ame-align-v-{$vertical_alignment} ame-align-h-{$horizontal_alignment}"); ?>">
                <?php foreach ($team_members as $member) :
                    $name         = $member['ame_team_member_name'] ?? '';
                    $designation  = $member['ame_team_member_designation'] ?? '';
                    $description  = $member['ame_team_member_description'] ?? '';
                    $image_data   = $member['ame_team_member_image'] ?? [];
                    $image_url    = $image_data['url'] ?? '';
                    $image_alt    = $image_data['alt'] ?? $name;
                    $show_past_exp = $member['ame_team_member_show_past_exp'] === 'yes';
                    $past_exp_title = $member['ame_team_member_past_exp_title'] ?? '';
                    $past_exp_details = $member['ame_team_member_past_exp_details'] ?? '';

                    $platforms = ['linkedin', 'twitter', 'facebook', 'instagram'];
                    $social_links = [];

                    foreach ( $platforms as $platform ) {
                        $social_links[$platform] = [
                            'platform' => $platform,
                            'url'      => $member["ame_team_member_{$platform}"]['url'] ?? '',
                            'is_external' => $member["ame_team_member_{$platform}"]['is_external'] ?? false,
                            'nofollow' => $member["ame_team_member_{$platform}"]['nofollow'] ?? false,
                            'icon'     => $member["ame_team_member_{$platform}_icon"] ?? [],
                        ];
                    }

                    // get target and dofflow 
                    $target = $nofollow = '';
                    foreach ($social_links as $social_link) {
                        if ($social_link['is_external']) {
                            $target = 'target="_blank" ';
                        }
                        if ($social_link['nofollow']) {
                            $nofollow = 'rel="nofollow" ';
                        }
                    }
                     
                    ?>

                    <div class="swiper-slide ame-marquee__item <?php echo esc_attr("ame-aliment-{$aliment_item}"); ?>" role="listitem">
                        <div class="ame-marquee__item_inner ame-align-<?php echo esc_attr($content_alignment); ?>">
                            <?php if (!empty($image_url)) : ?>
                                <div class="ame-marquee__member-image">
                                    <img src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($image_alt); ?>"
                                        <?php echo $enable_lazy_load ? 'loading="lazy"' : ''; ?> />
                                </div>
                            <?php endif; ?>

                            <div class="ame-marquee__member-content">
                                <?php if (!empty($name)) : ?>
                                    <h2 class="ame-marquee__member-name"><?php echo esc_html($name); ?></h2>
                                <?php endif; ?>

                                <?php if (!empty($designation)) : ?>
                                    <h5 class="ame-marquee__member-designation"><?php echo esc_html($designation); ?></h5>
                                <?php endif; ?>

                                <?php if (!empty($description)) : ?>
                                    <div class="ame-marquee__member-description">
                                        <p><?php echo wp_kses_post($description); ?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ($show_past_exp && (!empty($past_exp_title) || !empty($past_exp_details))) : ?>
                                    <div class="ame-marquee__past-exp">
                                        <?php if (!empty($past_exp_title)) : ?>
                                            <h5><?php echo esc_html($past_exp_title); ?></h5>
                                        <?php endif; ?>
                                        <?php if (!empty($past_exp_details)) : ?>
                                            <p><?php echo esc_html($past_exp_details); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="social-icons">
                                    <?php foreach ( $social_links as $social ) : ?>
                                        <?php if ( ! empty( $social['url'] ) && ! empty( $social['icon'] ) ) : ?> 
                                            <a href="<?php echo esc_url( $social['url'] ); ?>" class="social-icon" <?php echo $target . $nofollow; ?>>
                                                <?php \Elementor\Icons_Manager::render_icon( $social['icon'], [ 'aria-hidden' => 'true' ], false ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
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