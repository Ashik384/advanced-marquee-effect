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

        $this->add_control(
            'ame_marquee_gallery',
            [
                'label' => esc_html__('Add Images', 'advanced-marquee-effect'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->add_control(
            'ame_marquee_image_speed',
            [
                'label' => __( 'Speed (in ms)', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 90000,
                'step' => 1,
                'default' => 10,
            ]
        );
        // show vertical
        $this->add_control(
            'ame_marquee_image_vertical',
            [
                'label' => __( 'Vertical', 'advanced-marquee-effect' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'advanced-marquee-effect' ),
                'label_off' => __( 'No', 'advanced-marquee-effect' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        




        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $ame_marquee_gallery = $settings['ame_marquee_gallery'];
 
        if (empty($ame_marquee_gallery)) {
            return;
        }
?>

<div class="ame-marquee" aria-label="Image marquee carousel" 

    data-marquee-speed="<?php echo esc_attr($settings['ame_marquee_image_speed']) ?>"
    data-marquee-direction="<?php echo esc_attr($settings['ame_marquee_image_vertical']) === 'yes' ? 'vertical' : 'horizontal'

?>">
  <div class="swiper-wrapper">
    <?php foreach ($ame_marquee_gallery as $index => $image) :
        $attachment_id = $image['id'];
        $caption = wp_get_attachment_caption($attachment_id);
        $description = get_post_field('post_content', $attachment_id);
    ?>
      <div class="swiper-slide ame-marquee__item">
        <div class="ame-marquee__image">
          <img src="<?php echo esc_url($image['url']); ?>"
               alt="<?php echo esc_attr($image['alt'] ?? 'Marquee image ' . ($index + 1)); ?>"
               class="ame-marquee__image"
               loading="lazy">
        </div>

        <?php if (!empty($caption) || !empty($description)) : ?>
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
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php
    }
}