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
            'ame_marquee_settings',
            [
                'label' => esc_html__('Marquee Settings', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'ame_marquee_image_speed',
            [
                'label' => __('Speed (in ms)', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 90000,
                'step' => 1,
                'default' => 3000,
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
                'label' => esc_html__('Marquee Height', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem', 'custom' ],
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
                    '{{WRAPPER}} .ame-marquee' => 'height: {{SIZE}}{{UNIT}};',
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

        $this->add_control(
			'ame_marquee_image_spacing',
			[
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label' => esc_html__( 'Image Spacing (in px)', 'advanced-marquee-effect' ),
				'placeholder' => '0',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 16,
			]
		);

        // Border Radius
        $this->add_responsive_control(
            'image_border_radius',
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
            'ame_marquee_image_content_style',
            [
                'label' => esc_html__('Content Details', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );  

        $this->add_control(
            'caption_heading',
            [
                'label' => esc_html__('Caption', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'caption_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__caption',
            ]
        );
        
        $this->add_control(
            'caption_color',
            [
                'label' => esc_html__('Text Color', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ame-marquee__caption' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_heading',
            [
                'label' => esc_html__('Description', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Typography', 'advanced-marquee-effect'),
                'selector' => '{{WRAPPER}} .ame-marquee__description',
            ]
        );
        
        $this->add_control(
            'description_color',
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
 

        if (empty($ame_marquee_images)) {
            return;
        }
?>

        <div class="ame-marquee" aria-label="Image marquee carousel"
            data-marquee-speed="<?php echo esc_attr($settings['ame_marquee_image_speed']) ?>"
            data-marquee-direction="<?php echo esc_attr($settings['ame_marquee_image_vertical']) === 'yes' ? 'vertical' : 'horizontal' ?>"
            data-marquee-reverse="<?php echo esc_attr($settings['ame_marquee_image_reverse']) === 'yes' ? 'true' : 'false' ?>"
            data-marquee-image-space="<?php echo esc_attr($settings['ame_marquee_image_spacing'])?>" >
            
            <div class="swiper-wrapper">

            
                <?php foreach ($ame_marquee_images as $index => $image_item) :
                    $image = $image_item['ame_marquee_image'];
                    $attachment_id = isset($image['id']) ? $image['id'] : null;
                    $image_url = isset($image['url']) ? $image['url'] : '';
                    $alt = isset($image['alt']) ? $image['alt'] : 'Marquee image ' . ($index + 1);

                    $marquee_url = $image_item['ame_marquee_link'];



                    // Get caption/description only if ID is valid
                    $caption = $attachment_id ? wp_get_attachment_caption($attachment_id) : '';
                    $description = $attachment_id ? get_post_field('post_content', $attachment_id) : '';
                ?>
                    <div class="swiper-slide ame-marquee__item">
                        <div class="ame-marquee__item_inner">
                            <div class="ame-marquee__image">
                                <?php if (!empty($marquee_url['url'])) : ?>
                                    <a href="<?php echo esc_url($marquee_url['url']); ?>"  data-elementor-open-lightbox="yes" src="<?php echo esc_url($image_url); ?>"> <?php endif; ?>
                                    <img src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($image_item['ame_marquee_image']['alt'] ?? 'Marquee image ' . ($index + 1)); ?>"
                                        loading="lazy">
                                    <?php if (!empty($marquee_url['url'])) : ?> </a> <?php endif; ?>
                            </div>

                            <?php if (!empty($caption) || !empty($description)) : ?>
                                <?php if (!empty($marquee_url['url'])) : ?>
                                    <a href="<?php echo esc_url($marquee_url['url']); ?>">
                                    <?php endif; ?>
                                    <div class="ame-marquee__caption-wrapper">
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
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}
?>