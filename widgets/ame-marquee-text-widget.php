<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AME_Marquee_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ame-marquee-text';
    }

    public function get_title() {
        return __( 'AME Marquee Text', 'advanced-marquee-effect' );
    }

    public function get_icon() {
        return 'eicon-animation-text';
    }

    public function get_categories() {
        return [ 'ame_marquee_effect' ];
    }

    public function get_keywords() {
        return ['ame', 'marquee', 'animation', 'marquee text', 'running'];
    }
    public function get_style_depends() {
        return ['ame-marquee-style'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Marquee Content', 'advanced-marquee-effect' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'ame_marquee_text_url',
			[
				'label' => esc_html__( 'URL', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'advanced-marquee-effect' ),
				'placeholder' => esc_html__( 'Enter your URL', 'advanced-marquee-effect' ),
			]
		);

        $repeater->add_control(
            'ame_marquee_text_html',
            [
                'label' => __( 'Marquee Content', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', 'advanced-marquee-effect' ),
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'ame_marquee_text_list',
            [
                'label' => __( 'Marquee Items', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ ame_marquee_text_html }}}',
                'default' => [
                    [
                        'ame_marquee_text_url' => __( '#', 'advanced-marquee-effect' ),
                    ],      
                    [
                        'ame_marquee_text_html' => __( '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>', 'advanced-marquee-effect' ),
                    ],
                ]
                
            ]
        );

        $this->add_control(
            'ame_marquee_text_direction',
            [
                'label' => __( 'Marquee Direction', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'left_to_right' => __( 'Left to Right', 'advanced-marquee-effect' ),
                    'right_to_left' => __( 'Right to Left', 'advanced-marquee-effect' ),
                ],
                'default' => 'right_to_left',
            ]
        );

        $this->add_control(
            'ame_marquee_text_stop_on_hover',
            [
                'label' => esc_html__('Stop Scrolling on Hover', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('Pause the marquee scrolling when hovering over it.', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_marquee_text_speed',
            [
                'label' => __( 'Speed (Seconds)', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 10,
            ]
        );

        $this->add_control(
			'ame_marquee_text_separator_icon',
			[
				'label' => esc_html__( 'Separator Icon', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				]
			]
		);

        $this->add_control(
            'ame_ticker_label_heading',
            [
                'label' => esc_html__('Ticker Label', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'ame_ticker_label_enable',
            [
                'label' => esc_html__('Enable Ticker Label', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'advanced-marquee-effect'),
                'label_off' => esc_html__('No', 'advanced-marquee-effect'),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => esc_html__('Show or hide the ticker label.', 'advanced-marquee-effect'),
            ]
        );

        $this->add_control(
            'ame_ticker_label_icon',
            [
                'label' => esc_html__('Label Icon', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bullhorn',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'ame_ticker_label_text',
            [
                'label' => esc_html__('Label Text', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__(' Breaking News', 'advanced-marquee-effect'),
                'placeholder' => esc_html__('Enter label text', 'advanced-marquee-effect'),
                'label_block' => true,
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Style', 'advanced-marquee-effect' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Typography control for marquee items
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ame_marquee_text_typography',
                'label' => esc_html__( 'Typography', 'advanced-marquee-effect' ),
				'selector' => '{{WRAPPER}} .ame-marquee-text_item',
			]
		);

        $this->add_control(
			'ame_marquee_text_color',
			[
				'label' => esc_html__( 'Text Color', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ame-marquee-text_item *' => 'color: {{VALUE}}',
				],
			]
		);

         // Background Color control for marquee items
         $this->add_control(
            'ame_marquee_text_bg_color',
            [
                'label' => __( 'Background Color', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F1F0FF',
                'selectors' => [
					'{{WRAPPER}} .ame-marquee-text_section' => 'background: {{VALUE}}',
				],
            ]
        );

        // Padding control for marquee items
        $this->add_responsive_control(
            'ame_marquee_text_padding',
            [
                'label' => __( 'Padding', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 10,
                    'right' => 20,
                    'bottom' => 10,
                    'left' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee-text_section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_icon_label_heading',
            [
                'label' => esc_html__('Separator Style', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'ame_marquee_text_separator_icon_size',
			[
				'label' => esc_html__( 'Separator Icon Size', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 1000,
				'step' => 1,
				'default' => 16,
			]
		);

        $this->add_control(
			'ame_marquee_text_separator_color',
			[
				'label' => esc_html__( 'Separator color', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ame_marquee_text_separator__icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'ame_marquee_text_separator_icon_gap',
			[
				'label' => esc_html__( 'Icon Gap', 'advanced-marquee-effect' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 36,
			]
		);

        $this->add_control(
            'ame_ticker_label_section',
            [
                'label' => esc_html__('Ticker Style', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'ame_marquee_ticker_padding',
            [
                'label' => __( 'Padding', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default' => [
                    'top' => 8,
                    'right' => 16,
                    'bottom' => 8,
                    'left' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-ticker-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'ame_marquee_ticker_bg_color',
            [
                'label' => __( 'Background Color', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
					'{{WRAPPER}} .ame-ticker-label' => 'background: {{VALUE}}',
				],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ame_ticker_label_icon_color',
            [
                'label' => esc_html__('Icon Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ame-ticker-label__icon svg path, {{WRAPPER}} .ame-ticker-label__icon i' => 'fill: {{VALUE}}; color: {{VALUE}}',
                ],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ame_ticker_label_icon_size',
            [
                'label' => esc_html__('Icon Size', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .ame-ticker-label__icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'ame_ticker_label_text_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .ame-ticker-label__text' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'ame_ticker_label_text_typography',
                'label' => esc_html__('Text Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-ticker-label__text',
                'default' => [
                    'font_size' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                ],
                'condition' => [
                    'ame_ticker_label_enable' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $marquee_direction = $settings['ame_marquee_text_direction'] == 'right_to_left' ? 'marquee-text-right-to-left' : 'marquee-text-left-to-right';
        $ame_marquee_text_speed = $settings['ame_marquee_text_speed'];
        $ame_pushed_on_hover = isset($settings['ame_marquee_text_stop_on_hover']) && $settings['ame_marquee_text_stop_on_hover'] === 'yes' ? 'ame-push-on-hover' : '';
        
        ?>

        <div class="ame-marquee-text_section">
            <?php if ($settings['ame_ticker_label_enable'] == 'yes'): ?>
            <div class="ame-ticker-label">
                <div class="ame-ticker-inner">
                    <div class="ame-ticker-label__icon">
                        <?php \Elementor\Icons_Manager::render_icon($settings['ame_ticker_label_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                    <p class="ame-ticker-label__text"><?php echo wp_kses_post($settings['ame_ticker_label_text']); ?></p>
                </div>
            </div>
            <?php endif; ?>
            <div class="ame-marquee-text_wrap">
                <?php if (!empty($settings['ame_marquee_text_list'])) : ?>
                    
                    <!-- Marquee content -->
                    <div class="ame-marquee-text_content <?php echo esc_attr( $marquee_direction . ' ' .  $ame_pushed_on_hover ); ?>" style="animation-duration: <?php echo esc_attr($ame_marquee_text_speed); ?>s">
                        <?php foreach ($settings['ame_marquee_text_list'] as $item): ?>

                            <div class="ame-marquee-text_item" style="<?php echo esc_attr('gap: ' . $settings['ame_marquee_text_separator_icon_gap'] . 'px;'); ?>">
                                <div class="ame_marquee_text_separator__icon" style="<?php echo esc_attr('width: ' . $settings['ame_marquee_text_separator_icon_size'] . 'px; height: ' . $settings['ame_marquee_text_separator_icon_size'] . 'px;'); ?>">
                                    <?php  \Elementor\Icons_Manager::render_icon( $settings['ame_marquee_text_separator_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>
                                <?php if (!empty($item['ame_marquee_text_url'])) :  ?>
                                    <a href="<?php echo esc_url($item['ame_marquee_text_url']); ?>"><?php echo wp_kses_post($item['ame_marquee_text_html']); ?></a>
                                <?php else: ?>
                                    <?php echo wp_kses_post($item['ame_marquee_text_html']); ?>
                                <?php endif; ?>
                            </div>
                            
                        <?php endforeach; ?>
                    </div>

                    <!-- Duplicate content for smooth scrolling -->
                    <div class="ame-marquee-text_content <?php echo esc_attr( $marquee_direction . ' ' .  $ame_pushed_on_hover ); ?>" style="animation-duration: <?php echo esc_attr($ame_marquee_text_speed); ?>s">
                        <?php foreach ($settings['ame_marquee_text_list'] as $item): ?>
                            <div class="ame-marquee-text_item" style="<?php echo esc_attr('gap: ' . $settings['ame_marquee_text_separator_icon_gap'] . 'px;'); ?>">
                                <div class="ame_marquee_text_separator__icon" style="<?php echo esc_attr('width: ' . $settings['ame_marquee_text_separator_icon_size'] . 'px; height: ' . $settings['ame_marquee_text_separator_icon_size'] . 'px;'); ?>">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['ame_marquee_text_separator_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </div>

                                <?php if (!empty($item['ame_marquee_text_url'])) :  ?>
                                    <a href="<?php echo esc_url($item['ame_marquee_text_url']); ?>"><?php echo wp_kses_post($item['ame_marquee_text_html']); ?></a>
                                <?php else: ?>
                                    <?php echo wp_kses_post($item['ame_marquee_text_html']); ?>
                                <?php endif; ?>

                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <?php
    }
}
