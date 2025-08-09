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
 * Counter Widget .
 *
 */
class Quanto_Counter extends Widget_Base {

	public function get_name() {
		return 'quanto_counter';
	}
     
	public function get_title() {
		return __( 'Counter', 'quanto' );
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
        $repeater = new Repeater();

        $repeater->add_control(
			'counter_number',
			[
				'label' 		=> __( 'Number', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '17', 'quanto' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
			'counter_suffix',
			[
				'label' 		=> __( 'Suffix', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '+', 'quanto' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
			'counter_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Years of farming experience', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'counter_item',
			[
				'label' => __( 'Text Slider', 'quanto' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
			]
		);
        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__( 'Row Gap', 'quanto' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-funfacts__wrapper' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => esc_html__( 'Column Gap', 'quanto' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-funfacts__wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_responsive_control(
            'grid_columns',
            [
                'label'     => esc_html__( 'Columns', 'quanto' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '4',
                'options'   => [
                    '1' => esc_html__( '1 Column', 'quanto' ),
                    '2' => esc_html__( '2 Columns', 'quanto' ),
                    '3' => esc_html__( '3 Columns', 'quanto' ),
                    '4' => esc_html__( '4 Columns', 'quanto' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-funfacts__wrapper' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
                ],
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
                    '{{WRAPPER}} .quanto-funfacts__wrapper .quanto-funfact-box h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .quanto-funfacts__wrapper .quanto-funfact-box h2',
            ]
        );
		$this->end_controls_section();

        // Suffix Style
        $this->start_controls_section(
            'suffix_style',
            [
                'label' => __( 'Suffix', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'suffix_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-funfact-box em' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'suffix_typography',
                'selector' => '{{WRAPPER}} .quanto-funfact-box em',
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
                    '{{WRAPPER}} .quanto-funfact-box .funfact-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .quanto-funfact-box .funfact-info',
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
            'box_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-funfacts__wrapper .quanto-funfact-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .quanto-funfacts__wrapper .quanto-funfact-box',
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="row">
                <div class="col-12">
                    <div class="quanto-funfacts__wrapper">
                        <?php foreach ($settings['counter_item'] as $list_item) : ?>
                            <div class="quanto-funfact-box fade-anim" data-delay="0.30" data-direction="right">
                                <h2 class="counter-item d-inline-flex align-items-center">
                                    <span class="odometer d-inline-block" data-odometer-final="<?php echo esc_html( $list_item['counter_number'] ) ?>">.</span>
                                    <em><?php echo esc_html( $list_item['counter_suffix'] ) ?></em>
                                </h2>
                                <span class="funfact-info">
                                    <?php echo esc_html( $list_item['counter_text'] ) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Counter() );