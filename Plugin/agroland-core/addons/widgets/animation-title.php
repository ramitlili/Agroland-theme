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
 * Animation Title Widget .
 *
 */
class Quanto_Animation_Title extends Widget_Base {

	public function get_name() {
		return 'quanto_animation_title';
	}
     
	public function get_title() {
		return __( 'Animation Title', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'animation_title_section',
			[
				'label' 	=> __( 'Animation Title', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'animation_title_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( 'Get in touch', 'quanto' ),
				'label_block'   => true,
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
                    '{{WRAPPER}} .quanto-about-one h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .quanto-about-one h4',
            ]
        );
		$this->end_controls_section();


	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="quanto-about-one">
                <h4 class="move-anim text_invert">
                    <?php echo esc_html($settings['animation_title_text']); ?>
                </h4>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Animation_Title() );