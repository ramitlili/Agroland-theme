<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Icons_Manager;
/**
 *
 * Pricing Widget .
 *
 */
class Quanto_Pricing extends Widget_Base {

	public function get_name() {
		return 'quanto_pricing';
	}

	public function get_title() {
		return __( 'Quanto Pricing', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'pricing_section',
			[
				'label' 	=> __( 'Pricing', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			] 
        );

        $this->add_control(
			'title_text',
			[
				'label'   => esc_html__( 'Title', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Standard', 'quanto' ),
                'label_block' => true,
			]
		);

        $this->add_control(
			'subtitle_text',
			[
				'label'   => esc_html__( 'SubTitle', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Ideal for small businesses or startups.', 'quanto' ),
                'label_block' => true,
			]
		);
        $this->add_control(
			'price',
			[
				'label'   => esc_html__( 'Price', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '$990', 'quanto' ),
                'label_block' => true,
			]
		);

        // button

        $this->add_control(
            'button_icon',
            [
                'label'        => __( 'Button Icon?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Button Text', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( ' Go with this plan', 'quanto' ),
                'label_block' => true,
			]
		);
        $this->add_control(
            'btn_link',
            [
                'label' => __( 'URL', 'quanto' ),
                'type' => Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        // Feature List
		$repeater = new Repeater();
        $repeater->add_control(
			'icons',
			[
				'label'       => __( 'Svg Icon', 'adina' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'feature_list',
			[
				'label'   => esc_html__( 'Feature List', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Access to all basic features', 'quanto' ),
                'label_block' => true,
			]
		);
        $this->add_control(
			'pricing_list',
			[
				'label' 		=> __( 'Item', 'adina' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
			]
		);
		$this->end_controls_section();

        // Title style
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
                    '{{WRAPPER}} .pricing-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .pricing-title',
			]
		);
		$this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // SubTitle style
        $this->start_controls_section(
            'subtitle_style',
            [
                'label' => __( 'Sub Title', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .pricing-info' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}}  .pricing-info',
			]
		);
		$this->add_responsive_control(
            'subtitle_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .pricing-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // feature style
        $this->start_controls_section(
            'feature_style',
            [
                'label' => __( 'Feature', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'feature_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .pricing-list ul li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_typography',
				'selector' => '{{WRAPPER}} .quanto-pricing-box .pricing-list ul li',
			]
		);
        $this->add_control(
            'feature_icon_color',
            [
                'label' => __( 'Icon Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .pricing-list ul li svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'feature_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-pricing-box .pricing-list ul li svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .quanto-pricing-box .pricing-list ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'feature_icon_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'quanto' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-pricing-box .pricing-list ul li' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
            'feature_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .pricing-list ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ], 
            ]
        );
		$this->end_controls_section(); 

        // Pricing Rate style
        $this->start_controls_section(
            'pricing_rate_style',
            [
                'label' => __( 'Pricing Rate', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'rate_fill_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pricing' => 'color: {{VALUE}}',
                ],
            ]
        );
		
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pricing_rate_typography',
				'selector' => '{{WRAPPER}} .pricing',
			]
		);
		$this->add_responsive_control(
            'pricing_rate_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Button style
        $this->start_controls_section(
            'btn_style',
            [
                'label' => __( 'Button', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill, .quanto-pricing-box .quanto-link-btn.btn-pill span .arry1' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill:hover, .quanto-pricing-box .quanto-link-btn.btn-pill span .arry2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => __( 'Hover Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill',
			]
		);
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill',
			]
		);
        $this->add_responsive_control(
			'btn_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => __( 'Button Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_margin',
            [
                'label' => __( 'Button Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .quanto-link-btn.btn-pill' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( ' Box', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'overly_active',
            [
                'label'        => __( 'Overly Hover?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box' => 'background-color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'box_bg_color_hover',
            [
                'label' => __( 'Hover Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box .hover-overlay' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'box_color_hover',
            [
                'label' => __( 'Box Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .quanto-pricing-box:hover .pricing-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .quanto-pricing-box:hover .pricing' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .quanto-pricing-box:hover .pricing-list ul li svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __( 'Border Radius', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-pricing-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $pricing_list = $settings[ 'pricing_list' ];

        if( 'yes' == $settings['overly_active'] ){
            $overly = 'active-overly';
        }else{
            $overly = '';
        }

		?>

        
        
        <div class="quanto-pricing-box <?php echo esc_attr( $overly ); ?>  bg-white" data-direction="right">

            <?php if ( ! empty( $settings['title_text'] ) ) : ?>
                <h5 class="pricing-title">
                    <?php echo esc_html( $settings['title_text'] ); ?>
                </h5>
            <?php endif; ?>

            <?php if ( ! empty( $settings['subtitle_text'] ) ) : ?>
                <p class="pricing-info">
                    <?php echo esc_html( $settings['subtitle_text'] ); ?>
                </p>
            <?php endif; ?>

            <?php if ( ! empty( $settings['price'] ) ) : ?>
                <h3 class="pricing">
                    <?php echo esc_html( $settings['price'] ); ?>
                </h3>
            <?php endif; ?>

            <?php if ( ! empty( $pricing_list ) ) : ?>
                <div class="pricing-list">
                    <ul class="custom-ul">
                        <?php foreach ( $pricing_list as $pricing_item ) : ?>
                            <?php if ( ! empty( $pricing_item['feature_list'] ) ) : ?>
                                <li>
                                    <?php if ( ! empty( $pricing_item['icons'] ) ) : ?>
                                        <?php \Elementor\Icons_Manager::render_icon( $pricing_item['icons'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <?php endif; ?>
                                    <?php echo esc_html( $pricing_item['feature_list'] ); ?>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ( ! empty( $settings['btn_text'] ) && ! empty( $settings['btn_link']['url'] ) ) : ?>
                <a href="<?php echo esc_url( $settings['btn_link']['url'] ); ?>" class="quanto-link-btn btn-pill"
                    <?php echo $settings['btn_link']['is_external'] ? 'target="_blank"' : ''; ?>
                    <?php echo $settings['btn_link']['nofollow'] ? 'rel="nofollow"' : 'rel="noopener noreferrer"'; ?>>
                    <?php echo esc_html( $settings['btn_text'] ); ?>

                    <?php if( 'yes' == $settings['button_icon'] ): ?>
                        <span>
                            <i class="fa-solid fa-arrow-right arry1"></i>
                            <i class="fa-solid fa-arrow-right arry2"></i>
                        </span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div>


		<?php
	}
}
$widgets_manager->register( new \Quanto_Pricing() );