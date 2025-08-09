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
 * Button Widget .
 *
 */
class Agroland_Button extends Widget_Base {

	public function get_name() {
		return 'agroland_button';
	}
     
	public function get_title() {
		return __( 'Button', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'button_section',
			[
				'label' 	=> __( 'Button', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'button_layout',
			[
				'label' => __( 'Style', 'quanto' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Style 1', 'quanto' ),
					'layout-2' => __( 'Style 2', 'quanto' ),
					'layout-3' => __( 'Style 3', 'quanto' ),
					'layout-4' => __( 'Style 4', 'quanto' ),
					'layout-5' => __( 'Style 5', 'quanto' ),
				],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Get in touch', 'quanto' ),
				'label_block'   => true,
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
		$this->add_control(
            'button_icon',
            [
                'label'        => __( 'Need Icon?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
            'button_icon_left',
            [
                'label'        => __( 'Icon Left?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
				'condition' => [
					'button_icon' => 'yes', 
                    'button_layout' => 'layout-3', 
				]
            ]
        );
        $this->add_control(
			'select_icon',
			[
				'label'       => __( 'Icon', 'adina' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
                'condition' => [
					'button_icon' => 'yes', 
                    'button_layout' => 'layout-3', 
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
                    '{{WRAPPER}} .agroland-link-btn.btn-pill' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'text_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect:hover h1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-six:hover a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'text_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'text_hover_bg_color',
            [
                'label' => __( 'Hover Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .footer-six:hover a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .agroland-link-btn, {{WRAPPER}} .footer-let-connect h1, {{WRAPPER}} .footer-six a',
            ]
        );
		$this->add_responsive_control(
            'text_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .footer-let-connect' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .footer-six a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .agroland-link-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'text_border',
                'selector' => '{{WRAPPER}} .agroland-link-btn.btn-pill, {{WRAPPER}} .footer-let-connect, {{WRAPPER}} .footer-six a, {{WRAPPER}} .agroland-link-btn',
            ]
        );
		$this->add_responsive_control(
			'text_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .agroland-link-btn.btn-pill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .footer-let-connect' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .footer-six a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .agroland-link-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_section();

		// Icon Style
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'quanto' ),
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
					'{{WRAPPER}} .footer-let-connect span svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .footer-six a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .footer-six a i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
					'button_layout' => ['layout-2', 'layout-3']
				]
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
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
					'{{WRAPPER}} .agroland-link-btn' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .footer-let-connect' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .footer-six a' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill span .arry1' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect span svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn span .arry1' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'icon_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-link-btn.btn-pill span .arry2' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-let-connect:hover span svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .footer-six a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .agroland-link-btn span .arry2' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		$target = $settings['button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_url']['nofollow'] ? ' rel="nofollow"' : '';
		$button = $settings[ 'button_layout' ];
		
		?>
			<?php 	
				if ($button) {
					include('button/'.$button.'.php');
				}
			?>
		<?php
	}
}
$widgets_manager->register( new \Agroland_Button() );