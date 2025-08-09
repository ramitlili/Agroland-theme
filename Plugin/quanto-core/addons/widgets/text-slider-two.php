<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Text Slider Two Widget .
 *
 */
class Agroland_Text_Slider_Two extends Widget_Base {

	public function get_name() {
		return 'agroland_text_slider_two';
	}
     
	public function get_title() {
		return __( 'Text Slider Two', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'text_slider_section',
			[
				'label' 	=> __( 'Text Slider', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $repeater = new Repeater();

        $repeater->add_control(
			'slider_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Let’s work together', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'slider_list',
			[
				'label' => __( 'Text Slider', 'quanto' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
			]
		);
		$this->end_controls_section();

        // Text Style
        $this->start_controls_section(
            'text_style',
            [
                'label' => __( 'Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .marquee-section.extend h1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .marquee-section.extend h1',
            ]
        );
		$this->add_responsive_control(
            'text_gap',
            [
                'label' => __( 'Gap', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee-container .marquee .marquee-item-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <section class="marquee-section extend">
                <div class="marquee-container fade-anim">
                    <div class="marquee">
                        <?php foreach ($settings['slider_list'] as $list_item) : ?>
                            <div class="marquee-item-container">
                                <div class="marquee-item">
                                    <h1><?php echo esc_html($list_item['slider_text']); ?></h1>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
		<?php
	}
}
$widgets_manager->register( new \Agroland_Text_Slider_Two() );