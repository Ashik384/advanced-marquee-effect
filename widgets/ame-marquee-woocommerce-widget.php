<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor WooCommerce Product Marquee Promo Widget
 */
class AME_Marquee_WooCommerce_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ame-marquee-woocommerce';
    }

    public function get_title() {
        return esc_html__( 'WooCommerce Product Marquee 🔒', 'advanced-marquee-effect' );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return [ 'ame_marquee_effect' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'promo_section',
            [
                'label' => esc_html__( 'Pro Feature', 'advanced-marquee-effect' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $pricing_url = esc_url( admin_url( 'admin.php?page=ame-settings-pricing' ) );

        $this->add_control(
            'promo_notice',
            [
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => '<div style="background-color: #f8fafc; border-left: 4px solid #7209b7; padding: 12px; border-radius: 4px;">
                    <p style="font-weight: bold; color: #0f172a; margin: 0 0 6px 0;">WooCommerce Product Marquee is a Pro Feature</p>
                    <p style="font-size: 12px; color: #475569; margin: 0 0 10px 0;">Upgrade to Advanced Marquee Effect Pro to unlock dynamic product query loops, low-stock threshold alerts, custom element toggles, and advanced typography controls.</p>
                    <a href="' . $pricing_url . '" style="display: inline-block; background-color: #7209b7; color: #fff; text-decoration: none; font-size: 11px; font-weight: bold; padding: 6px 12px; border-radius: 3px;">Upgrade to Pro</a>
                </div>',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $pricing_url = esc_url( admin_url( 'admin.php?page=ame-settings-pricing' ) );
        ?>
        <div class="ame-marquee-promo-wrapper" style="border: 2px dashed #e2e8f0; border-radius: 12px; padding: 30px; text-align: center; background: #fff; max-width: 450px; margin: 20px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
            <div style="font-size: 32px; margin-bottom: 12px;">🔒</div>
            <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 8px 0;"><?php esc_html_e( 'WooCommerce Product Marquee', 'advanced-marquee-effect' ); ?></h3>
            <p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;"><?php esc_html_e( 'This widget is locked. Please install and activate Advanced Marquee Effect Pro to showcase scrolling product query loops on your store.', 'advanced-marquee-effect' ); ?></p>
            <a href="<?php echo $pricing_url; ?>" style="display: inline-block; background-color: #7209b7; color: #fff; text-decoration: none; font-size: 12px; font-weight: 700; padding: 8px 18px; border-radius: 6px; transition: background-color 0.2s;"><?php esc_html_e( 'Unlock This Widget', 'advanced-marquee-effect' ); ?></a>
        </div>
        <?php
    }
}
