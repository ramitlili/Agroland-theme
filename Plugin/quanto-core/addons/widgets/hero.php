<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
/**
 *
 * Hero Widget .
 *
 */
class Quanto_Hero extends Widget_Base {

	public function get_name() {
		return 'quanto_hero';
	}
     
	public function get_title() {
		return __( 'Hero', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'hero_section',
			[
				'label' 	=> __( 'Hero', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'hero_style',
			[
				'label' 		=> __( 'Hero Style', 'quanto' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout-1',
				'options' 		=> [
					'layout-1'  => __( 'Style One', 'quanto' ),
					'layout-2' 	=> __( 'Style Two', 'quanto' ),
					'layout-3' 	=> __( 'Style Three', 'quanto' ),
					'layout-4' 	=> __( 'Style Four', 'quanto' ),
					'layout-5' 	=> __( 'Style Five', 'quanto' ),
					'layout-6' 	=> __( 'Style Six', 'quanto' ),
				],
			]
		);
        $this->add_control(
            'hero_five_bg_img',
            [
                'label' => esc_html__('Background Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'hero_style' => 'layout-5', 
				]
            ]
        );
        $this->add_control(
			'hero_title',
			[
				'label' 		=> __( 'Title', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( 'Crafting your fantasies with a twist of', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-2', 'layout-4', 'layout-5', 'layout-6'],
				]
			]
		);
        $this->add_control(
            'hero_animated_img',
            [
                'label' => esc_html__('Animated Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'hero_style!' => 'layout-6',
				]
            ]
        );
        $this->add_control(
			'image_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
                'condition' => [
					'hero_style' => ['layout-2', 'layout-3'],
				]
			]
		);
        $this->add_control(
			'hero_short_title',
			[
				'label' 		=> __( 'Title Two', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'creativity', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-5'],
				]
			]
		);
        $this->add_control(
			'hero_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( 'As long as your dreams revolve around something like; being the proud owner spectacular website.', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
            'hero_add_img',
            [
                'label' => esc_html__('Add Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-6'],
				]
            ]
        );
        $this->add_control(
            'hero_client_img_one',
            [
                'label' => esc_html__('Client Image One', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4'],
				]
            ]
        );
        $this->add_control(
            'hero_client_img_two',
            [
                'label' => esc_html__('Image Two', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-2'],
				]
            ]
        );
        $this->add_control(
			'hero_counter_number',
			[
				'label' 		=> __( 'Number', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '2', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4'],
				]
			]
		);
        $this->add_control(
			'hero_counter_text',
			[
				'label' 		=> __( 'Counter Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'k+ Clients', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4'],
				]
			]
		);
        $this->add_control(
			'hero_client_title',
			[
				'label' 		=> __( 'Client Title', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Award-winning farm', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => 'layout-1',
				]
			]
		);
        $this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Get in touch', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'hero_style' => 'layout-5',
				]
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
                'condition' => [
					'hero_style' => 'layout-5',
				]
			]
		);
		$this->end_controls_section();

        // Hero Slider Content
        $this->start_controls_section(
			'hero_slider_section',
			[
				'label' 	=> __( 'Hero Slider', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
                'condition' => [
					'hero_style' => 'layout-3',
				]
			]
        );
		$repeater = new Repeater();

        $repeater->add_control(
			'hero_slider_text',
			[
				'label' 		=> __( 'Title', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Award-winning farm', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'slider_item',
			[
				'label' 		=> __( 'Slider Item', 'quanto' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
			]
		);
		$this->end_controls_section();

        // Box Style
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => ['layout-2', 'layout-3', 'layout-4', 'layout-5'],
				]
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'selector' => '{{WRAPPER}} .quanto-hero2-section, {{WRAPPER}} .quanto-hero3-section, {{WRAPPER}} .quanto-hero4-section, {{WRAPPER}} .quanto-hero5-section',
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero2-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .quanto-hero3__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .quanto-hero4-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .quanto-hero5-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero__content h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero2-content h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero3__content .marquee-item h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero4__content h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero5__content h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero6__content h1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .quanto-hero__content h1, {{WRAPPER}} .hero2-content h1, {{WRAPPER}} .quanto-hero3__content .marquee-item h1, {{WRAPPER}} .quanto-hero4__content h1, {{WRAPPER}} .quanto-hero5__content h1, {{WRAPPER}} .quanto-hero6__content h1',
            ]
        );
		$this->end_controls_section();

        // Title Shape Style
        $this->start_controls_section(
            'title_shape_style',
            [
                'label' => __( 'Title Shape', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => 'layout-2',
				]
            ]
        );
        $this->add_control(
            'title_shape_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero2-content h1 span' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'title_shape_width',
			[
				'label' => esc_html__( 'Width', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hero2-content h1 span' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'title_shape_height',
			[
				'label' => esc_html__( 'height', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hero2-content h1 span' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        // Short Title Style
        $this->start_controls_section(
            'short_title_style',
            [
                'label' => __( 'Short Title', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-5'],
				]
            ]
        );
        $this->add_control(
            'short_title_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero__content h1 span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero__content h1 .text-indent' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_title_typography',
                'selector' => '{{WRAPPER}} .quanto-hero__content h1 span, {{WRAPPER}} .quanto-hero__content h1 .text-indent',
            ]
        );
		$this->end_controls_section();

        // Animated Image Size Style
        $this->start_controls_section(
            'animated_image_style',
            [
                'label' => __( 'Animated Image Size', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4', 'layout-5'],
				]
            ]
        );
        $this->add_responsive_control(
			'animated_icon_size',
			[
				'label' => esc_html__( 'Animated Image Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-hero__content .title span img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					'hero_style' => 'layout-1',
				]
			]
		);
        $this->add_responsive_control(
			'animated_icon_width',
			[
				'label' => esc_html__( 'Animated Image Width', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-hero4__content h1 span img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .quanto-hero5__content h1 img' => 'width: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					'hero_style' => ['layout-4', 'layout-5'],
				]
			]
		);
        $this->add_responsive_control(
			'animated_icon_height',
			[
				'label' => esc_html__( 'Animated Image Height', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-hero4__content h1 span img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .quanto-hero5__content h1 img' => 'height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					'hero_style' => ['layout-4', 'layout-5'],
				]
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
                    '{{WRAPPER}} .quanto-hero__info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero2-content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero3__content .content-info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero4__content p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero5__info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero6__content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .quanto-hero__info p, {{WRAPPER}} .hero2-content p, {{WRAPPER}} .quanto-hero3__content .content-info p, {{WRAPPER}} .quanto-hero4__content p, {{WRAPPER}} .quanto-hero5__info p, {{WRAPPER}} .quanto-hero6__content p',
            ]
        );
        $this->add_responsive_control(
            'text_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .hero2-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .quanto-hero4__content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
					'hero_style' => ['layout-2', 'layout-4'],
				]
            ]
        );
		$this->end_controls_section();

        // Client Part Style
        $this->start_controls_section(
            'client_part_style',
            [
                'label' => __( 'Client Part', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => 'layout-1',
				]
            ]
        );
        $this->add_responsive_control(
            'client_part_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero__info .client-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'client_part_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero__info .client-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'client_part_border',
                'selector' => '{{WRAPPER}} .quanto-hero__info .client-info',
            ]
        );
        $this->add_responsive_control(
			'client_image_size',
			[
				'label' => esc_html__( 'Client Image Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-hero__info .client-images img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        // Client Title Style
        $this->start_controls_section(
            'client_title_style',
            [
                'label' => __( 'Number Title', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4'],
				]
            ]
        );
        $this->add_control(
            'client_title_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .client-data h6' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero4__info h4' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_title_typography',
                'selector' => '{{WRAPPER}} .client-data h6, {{WRAPPER}} .quanto-hero4__info h4',
            ]
        );
		$this->end_controls_section();

        // Client Text Style
        $this->start_controls_section(
            'client_text_style',
            [
                'label' => __( 'Client Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => ['layout-1', 'layout-4'],
				]
            ]
        );
        $this->add_control(
            'client_text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero__info .client-data > span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quanto-hero4__info p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'client_text_typography',
                'selector' => '{{WRAPPER}} .quanto-hero__info .client-data > span, {{WRAPPER}} .quanto-hero4__info p',
            ]
        );
		$this->end_controls_section();

        // ButtonText Style
        $this->start_controls_section(
            'btn_text_style',
            [
                'label' => __( 'Button', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => 'layout-5', 
				]
            ]
        );
		$this->add_control(
            'btn_text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero5__info .quanto-link-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'btn_text_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'btn_text_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero5__info .quanto-link-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'btn_text_hover_bg_color',
            [
                'label' => __( 'Hover Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typography',
                'selector' => '{{WRAPPER}} .quanto-link-btn',
            ]
        );
        $this->add_responsive_control(
            'btn_text_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-hero5__info .quanto-link-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'btn_text_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_text_border',
                'selector' => '{{WRAPPER}} .quanto-hero5__info .quanto-link-btn',
            ]
        );
		$this->add_responsive_control(
			'btn_text_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .quanto-link-btn.btn-pill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_section();

		// Button Icon Style
        $this->start_controls_section(
            'btn_icon_style',
            [
                'label' => __( 'Button Icon', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'hero_style' => 'layout-5', 
				]
            ]
        );
		$this->add_responsive_control(
			'btn_icon_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'mas-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-link-btn' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
            'btn_icon_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill span .arry1' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'btn_icon_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill span .arry2' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		$hero_style = $settings[ 'hero_style' ];
		
		?>
            <?php 	
				if ($hero_style) {
					include('hero/'.$hero_style.'.php');
				}
			?>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Hero() );