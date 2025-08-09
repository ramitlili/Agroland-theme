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
 * Counter Two Widget .
 *
 */
class Agroland_Counter_Two extends Widget_Base {

	public function get_name() {
		return 'agroland_counter_two';
	}
     
	public function get_title() {
		return __( 'Counter Two', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'counter_section',
			[
				'label' 	=> __( 'Counter', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'counter_prefix',
			[
				'label' 		=> __( 'Prefix', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '$', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'counter_number',
			[
				'label' 		=> __( 'Number', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '21', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'counter_suffix',
			[
				'label' 		=> __( 'Suffix', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'M', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'counter_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'We assisted companies is securing over $21M in funding successfully.', 'quanto' ),
				'label_block'   => true,
			]
		);
		$this->end_controls_section();

        // Box Style
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .price-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Suffix-Prefix Style
        $this->start_controls_section(
            'suffix_prefix_style',
            [
                'label' => __( 'Prefix', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'suffix_prefix_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-info h2 em' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'suffix_prefix_typography',
                'selector' => '{{WRAPPER}} .price-info h2 em',
            ]
        );
		$this->end_controls_section();

        // Number Style
        $this->start_controls_section(
            'number_style',
            [
                'label' => __( 'Number', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'number_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-info h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .price-info h2',
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
                    '{{WRAPPER}} .price-info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .price-info p',
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="price-info">
                <h2 class="counter-item d-inline-flex align-items-center">
                    <em class="fst-normal"><?php echo esc_html( $settings['counter_prefix'] ) ?></em>
                    <span class="d-inline-block odometer" data-odometer-final="<?php echo esc_html( $settings['counter_number'] ) ?>">
                        0
                    </span>
                    <em class="fst-normal"><?php echo esc_html( $settings['counter_suffix'] ) ?></em>
                </h2>
                <p>
                    <?php echo esc_html( $settings['counter_text'] ) ?>
                </p>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Agroland_Counter_Two() );