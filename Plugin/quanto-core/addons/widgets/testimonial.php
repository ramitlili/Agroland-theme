<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;

/**
 *
 * Testimonial Slider Widget .
 *
 */
class Agroland_Testimonial extends Widget_Base{

	public function get_name() {
		return 'agroland_testimonial';
	}

	public function get_title() {
		return __( 'Quanto Testimonial', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_slider_section',
			[
				'label' 	=> __( 'Testimonial Slider', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'testimonial_style',
			[
				'label' 		=> __( 'Testimonial Style', 'quanto' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  			=> __( 'Style One', 'quanto' ),
					'2' 			=> __( 'Style Two', 'quanto' ),
					'3' 			=> __( 'Style Three', 'quanto' ),
				],
			]
		);
		
		$this->add_control(
			'slider_title', [
				'label' 		=> __( 'Slider Title', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Client testimonials' , 'quanto' ),
				'label_block' 	=> true,
				'condition' => [
					'testimonial_style' => '1',
				]
			]
		);

		
		$repeater = new Repeater();

		
		$repeater->add_control(
			'client_image',
			[
				'label' 		=> __( 'Client Image', 'quanto' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
        );
		
		$repeater->add_control(
			'rating',
			[
				'label' 		=> __( 'Rating?', 'quanto' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'quanto' ),
				'label_off' 	=> __( 'No', 'quanto' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'description' => __( 'Rating will be used only Style Two.', 'quanto' ),
			]
		);
		$repeater->add_control(
			'rating_icon',
			[
				'label' => __( 'Ratting Icon', 'quanto' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'remixicon ri-star-fill',
					'library' => 'remixicon',
				]
			]
		);
		$repeater->add_control(
			'client_text', [
				'label' 		=> __( 'Client Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( '“ Working with several word press themes and templates the last years, I only can say this is best in every level. I use it for my company and the reviews that I have already are all excellent. Not only the design but the code quality ”' , 'quanto' ),
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'client_name', [
				'label' 		=> __( 'Client Name', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Alexander Cameron' , 'quanto' ),
				'label_block' 	=> true,
			]
        );
		$repeater->add_control(
			'client_designation', [
				'label' 		=> __( 'Client Designation', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Lead Developer' , 'quanto' ),
				'label_block' 	=> true,
			]
        );
		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Slides', 'quanto' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' => [
                    [
                        'client_name' => esc_html__( 'Jenny Bennett', 'quanto' ),
                        'client_designation'  => esc_html__( 'Senior Marketing Manager at Caya', 'quanto' ),
                    ],
					[
                        'client_name' => esc_html__( 'Nathan Hallmark', 'quanto' ),
                        'client_designation'  => esc_html__( 'Designer Team Head at Qxygen', 'quanto' ),
                    ],
					[
                        'client_name' => esc_html__( 'Danny Aronson', 'quanto' ),
                        'client_designation'  => esc_html__( 'Senior Brand Design at Goodnotes', 'quanto' ),
                    ],
                ],
                'title_field' => '{{{ client_name }}}',
			]
		);
		$this->end_controls_section();
		// Slider Setting
		$this->start_controls_section(
			'slider_settings',
			[
			'label' => __('Slider Settings', 'quanto'),
			'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			'condition'   => [ 
				'show_slider_settings' => 'yes',
			]
			]
		);
		$this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __( 'Slider Items', 'quanto' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default'            => 2,
                'tablet_default'     => 1,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
				'condition' => [
					'testimonial_style' => ['1', '3'],
					
				],
                'frontend_available' => true,
            ]
        );
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Arrows?', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'quanto' ),
				'label_off' => __( 'Hide', 'quanto' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'testimonial_style' => '2',
				],
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots?', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'quanto' ),
				'label_off' => __( 'Hide', 'quanto' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'testimonial_style' => ['1', '3'],
				],
				
			]
		);
		$this->add_control(
			'drag',
			[
				'label' => __( 'Drag?', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'quanto' ),
				'label_off' => __( 'Hide', 'quanto' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Auto Play?', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'quanto' ),
				'label_off' => __( 'Hide', 'quanto' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplaytimeout',
			[
				'label' => __( 'Autoplay Timeout', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'default' => '5000',
				'options' => [
					'1000'  => __( '1 Second', 'quanto' ),
					'2000'  => __( '2 Second', 'quanto' ),
					'3000'  => __( '3 Second', 'quanto' ),
					'4000'  => __( '4 Second', 'quanto' ),
					'5000'  => __( '5 Second', 'quanto' ),
					'6000'  => __( '6 Second', 'quanto' ),
					'7000'  => __( '7 Second', 'quanto' ),
					'8000'  => __( '8 Second', 'quanto' ),
					'9000'  => __( '9 Second', 'quanto' ),
					'10000' => __( '10 Second', 'quanto' ),
					'11000' => __( '11 Second', 'quanto' ),
					'12000' => __( '12 Second', 'quanto' ),
					'13000' => __( '13 Second', 'quanto' ),
					'14000' => __( '14 Second', 'quanto' ),
					'15000' => __( '15 Second', 'quanto' ),
				],
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		// End Slider settings
		// Style section start  
		
		// Slider Title Style For style 1
	
		$this->start_controls_section(
			'slider_title_style',
			[
				'label' 	=> __( 'Slider Title', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
            	'testimonial_style' => '1',
        		],
			]
        );
		$this->add_control(
			'slider_title_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-testimonial-section .agroland__header .title' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'slider_title_typography',
				'label' 	=> __( 'Typography', 'quanto' ),
				'selector' 	=> '{{WRAPPER}} .agroland-testimonial-section .agroland__header .title',
			]
        );
		$this->add_responsive_control(
			'slider_title_margin',
			[
				'label'        => __( 'Margin', 'quanto' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'selectors'    => [
					'{{WRAPPER}} .agroland-testimonial-section .agroland__header .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'slider_title_padding',
			[
				'label'        => __( 'Margin', 'quanto' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'selectors'    => [
					'{{WRAPPER}} .agroland-testimonial-section .agroland__header .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

		// Text Style 
		$this->start_controls_section(
			'client_image_style',
			[
				'label' 	=> __( 'Image', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'client_image_width',
			[
				'label' => __( 'Width', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-testimonial__thumb-slider .testimonial-img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-author .author-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Box Style 
		$this->start_controls_section(
			'box_style',
			[
				'label' 	=> __( 'Box', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
            	'testimonial_style' => '2',
        		],
			]
        );
		$this->add_control(
			'box_bg_color',
			[
				'label' 		=> __( 'Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-testimonial2__box' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_responsive_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'quanto' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-testimonial2__box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'box_border',
				'label' 	=> __( 'Border', 'quanto' ),
                'selector' 	=> '{{WRAPPER}} .agroland-testimonial2__box',
			]
		);
		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'quanto' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-testimonial2__box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->end_controls_section();

		// Text Style 
		$this->start_controls_section(
			'text_style',
			[
				'label' 	=> __( 'Text', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'text_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial3-content p' => 'color: {{VALUE}}',
					'{{WRAPPER}} .agroland-testimonial2__box .testimonial-content .revew' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'text_typography',
				'label' 	=> __( 'Typography', 'quanto' ),
				'selector' 	=> '{{WRAPPER}} .testimonial-content p, {{WRAPPER}} .testimonial3-content p, {{WRAPPER}} .agroland-testimonial2__box .testimonial-content .revew',
			]
        );
		$this->add_responsive_control(
			'text_margin',
			[
				'label'        => __( 'Margin', 'quanto' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'selectors'    => [
					'{{WRAPPER}} .testimonial-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial3-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .agroland-testimonial2__box .testimonial-content .revew' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		// Rating Style 
		$this->start_controls_section(
			'rating_style',
			[
				'label' 	=> __( 'Rating', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
            	'testimonial_style' => '2',
        		],
			]
        );
		$this->add_control(
			'rating_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-content .stars ul li i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-content .stars ul li svg path' => 'fill: {{VALUE}}',
                ],
			]
        );
		$this->add_responsive_control(
			'rating_size',
			[
				'label' => __( 'Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial-content .stars ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-content .stars ul li svg ' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-content .stars ul li img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		// Name Style 
		$this->start_controls_section(
			'name_style',
			[
				'label' 	=> __( 'Name', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'name_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-content .author .author-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial3-content .client-info .client-name' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial-author .author-info .author-name' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'name_typography',
				'label' 	=> __( 'Typography', 'quanto' ),
                'selector' 	=> '{{WRAPPER}} .testimonial-content .author .author-title, {{WRAPPER}} .testimonial3-content .client-info .client-name, {{WRAPPER}} .testimonial-author .author-info .author-name',
			]
        );
		$this->add_responsive_control(
			'name_margin',
			[
				'label'        => __( 'Margin', 'quanto' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'selectors'    => [
					'{{WRAPPER}} .testimonial-content .author .author-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial3-content .client-info .client-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-author .author-info .author-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();

		// Designation Style 
		$this->start_controls_section(
			'designation_style',
			[
				'label' 	=> __( 'Designation', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'designation_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-content .author-designation' => 'color: {{VALUE}}',
					'{{WRAPPER}} .testimonial3-content .client-designation' => 'color: {{VALUE}}',
					'{{WRAPPER}} .agroland-testimonial2__box .testimonial-author .author-info .info' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'designation_typography',
				'label' 	=> __( 'Typography', 'quanto' ),
                'selector' 	=> '{{WRAPPER}} .agroland-t-author span, {{WRAPPER}} .agroland-t-data2 span',
			]
        );
		$this->end_controls_section();

		// Arrow Style 
		$this->start_controls_section(
			'arrow_style',
			[
				'label' 	=> __( 'Arrow', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'testimonial_style' => '3',
				]
			]
        );
		$this->add_responsive_control(
			'arrow-icon_size',
			[
				'label' => __( 'Icon Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial3-navigation .next-btn, .testimonial3-navigation .prev-btn' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'arrow_size',
			[
				'label' => __( 'Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .testimonial3-navigation .next-btn, .testimonial3-navigation .prev-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial3-navigation .next-btn, .testimonial3-navigation .prev-btn' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'arrow_bg_color',
			[
				'label' 		=> __( 'Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial3-navigation .next-btn, .testimonial3-navigation .prev-btn' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->end_controls_section();


	}
	protected function render() {

		$settings = $this->get_settings_for_display();

		$testimonial_style = $settings[ 'testimonial_style' ];

		//this code course slider option
		$slider_extraSetting = array(
			'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
			'drag' => (!empty($settings['drag']) && 'yes' === $settings['drag']) ? true : false,
			'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
			'arrows' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
			'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',

			//this a responsive layout
			'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 1,
			'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 1,
			'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
		);
	   
		$jasondecode = wp_json_encode($slider_extraSetting);

		
		?>
			<?php 	
				if ($testimonial_style) {
					include('testimonial/'.$testimonial_style.'.php');
				}
			?>
		<?php 
	}
}
$widgets_manager->register( new \Agroland_Testimonial() );