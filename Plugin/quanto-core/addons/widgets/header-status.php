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
 * Header Status Widget .
 *
 */
class Agroland_Header_Status extends Widget_Base {

	public function get_name() {
		return 'agroland_header_status';
	}
     
	public function get_title() {
		return __( 'Header Status', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'header_status_section',
			[
				'label' 	=> __( 'Header Status', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'status_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Available for new opportunity', 'quanto' ),
				'label_block'   => true,
			]
		);
		$this->end_controls_section();

        // Status Style
        $this->start_controls_section(
            'status_style',
            [
                'label' => __( 'Status', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-status .status' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .header-status .status',
            ]
        );
        $this->add_control(
            'dot_color',
            [
                'label' => __( 'Dot Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-status .status .status-dot' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="header-status">
                <div class="status">
                    <div class="status-dot"></div>
                    <?php echo esc_html( $settings['status_text'] ) ?>
                </div>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Agroland_Header_Status() );