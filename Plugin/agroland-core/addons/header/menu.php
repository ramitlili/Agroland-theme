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
 * Menu Widget .
 *
 */
class Quanto_Menu extends Widget_Base {

	public function get_name() {
		return 'quanto_menu';
	}
     
	public function get_title() {
		return __( 'Menu', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	private function get_available_menus() {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ( $menus as $menu ) {

            $options[$menu->slug] = $menu->name;

        }

        return $options;

    }

	protected function register_controls() {

		$this->start_controls_section(
			'menu_section',
			[
				'label' 	=> __( 'Menu', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
            'use_main_menu',
            [
                'label'        => __( 'Use Main Menu', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $menus = $this->get_available_menus();

        if ( !empty( $menus ) ) {
            $this->add_control(
                'primary_menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                    'condition'    => [
                        'use_main_menu!' => 'yes',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
		$this->end_controls_section();

		// Mobile Menu
		$this->start_controls_section(
            'mobile_menu',
            [
                'label' => __('Mobile Menu', 'quanto'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
        'logo_type',
			[
			'label' => esc_html__( 'Logo Type', 'quanto' ),
			'type' => \Elementor\Controls_Manager::SELECT,
			'default' => 'dark',
			'options' => [
				'dark' => esc_html__( 'Dark Logo', 'quanto' ),
				'white' => esc_html__( 'White Logo', 'quanto' ),
				'custom'  => esc_html__( 'Custom Logo', 'quanto' ),
			],
			]
		);
        $this->add_control(
			'logo_image',
			[
				'label' 		=> __( 'Logo Image', 'quanto' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'logo_type' => 'custom',
				],
			]
		);
		$this->add_control(
			'address_text',
			[
				'label' 		=> __( 'Address', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( '27 Division St, New York,NY 10002, USA', 'quanto' ),
				'label_block'   => true,
			]
		);

		$linked_items = new Repeater();

		$linked_items->add_control(
			'item_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '+1 800 123 654 987 ', 'quanto' ),
				'label_block'   => true,
			]
		);
		$linked_items->add_control(
			'item_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
		$this->add_control(
			'linked_item_list',
			[
				'label' => __( 'Linked Items', 'quanto' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $linked_items->get_controls(),
			]
		);
		$icon_repeater = new Repeater();

        $icon_repeater->add_control(
            'social_icon_select',
            [
                'label' => __('Icon select', 'quanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => quanto_icon_list_options(),
                'default' => 'linkedin-fill',
                'label_block' => true,

            ]
        );
        $icon_repeater->add_control(
            'icon_url',
            [
                'label' => esc_html__( 'Icon Url', 'quanto' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'label_block' => true,
            ]
        ); 
        $this->add_control(
			'mobile_menu_social_list',
			[
				'label' => __( 'Social Icon', 'quanto' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $icon_repeater->get_controls(),
			]
		);
        $this->end_controls_section();

		// Menu style
        $this->start_controls_section(
            'menu_style',
            [
                'label' => __( 'Menu', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'menu_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu a' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'menu_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .main-menu a',
            ]
        );
        $this->end_controls_section();

		// SubMenu style
        $this->start_controls_section(
            'submenu_style',
            [
                'label' => __( 'Sub Menu', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'submenu_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu ul.sub-menu li a' => 'color: {{VALUE}} !important;',
				],
			]
		);		
		$this->add_control(
            'submenu_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-menu ul.sub-menu li a:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .main-menu ul.sub-menu li a::before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typography',
                'selector' => '{{WRAPPER}} .main-menu ul.sub-menu li a',
            ]
        );
		$this->add_responsive_control(
            'submenu_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .main-menu ul.sub-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'submenu_bg_color',
			[
				'label' => __( 'Background Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .main-menu ul.sub-menu' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 		=> 'submenu_shadow',
				'label' 	=> __( 'Submenu Shadow', 'quanto' ),
				'selector' 	=> '{{WRAPPER}} .main-menu ul.sub-menu',
			]
		);
        $this->end_controls_section();

		// Hamburger style
        $this->start_controls_section(
            'hamburger_style',
            [
                'label' => __( 'Hamburger', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'hamburger_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menuBar-toggle svg' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'hamburger_size',
			[
				'label' => esc_html__( 'Size', 'quanto' ),
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
					'{{WRAPPER}} .menuBar-toggle svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hamburger_width',
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
					'{{WRAPPER}} .menuBar-toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'hamburger_height',
			[
				'label' => esc_html__( 'Height', 'quanto' ),
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
					'{{WRAPPER}} .menuBar-toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'hamburger_border',
                'selector' => '{{WRAPPER}} .menuBar-toggle',
            ]
        );
		$this->add_responsive_control(
			'hamburger_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .menuBar-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

		// Mobile style
        $this->start_controls_section(
            'mobile_style',
            [
                'label' => __( 'Mobile', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'mobile_bg_color',
			[
				'label' => __( 'Background Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-area, .quanto-menu-wrapper .mobile-logo, .quanto-mobile-menu ul .quanto-item-has-children > a .quanto-mean-expand' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'mobile_logo_width',
			[
				'label' => esc_html__( 'Logo Width', 'quanto' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper .mobile-logo' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		// Close Icon Style
		$this->add_responsive_control(
			'close_icon_size',
			[
				'label' => esc_html__( 'Close Icon Size', 'quanto' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'close_icon_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'close_icon_bg_color',
			[
				'label' => __( 'Background Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'close_icon_width',
			[
				'label' => esc_html__( 'Close Icon Width', 'quanto' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'close_icon_height',
			[
				'label' => esc_html__( 'Close Icon Height', 'quanto' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'close_icon_border',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle',
            ]
        );
		$this->add_responsive_control(
			'close_icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .quanto-menu-wrapper .quanto-menu-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

		// Mobile Menu style
        $this->start_controls_section(
            'mobile_menu_style',
            [
                'label' => __( 'mobile Menu', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'mobile_menu_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu ul li a' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .quanto-mobile-menu ul .quanto-item-has-children > a .quanto-mean-expand' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'mobile_menu_active_color',
			[
				'label' => __( 'Active Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu ul li.quanto-active > a' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_menu_typography',
                'selector' => '{{WRAPPER}} .quanto-mobile-menu ul li a',
            ]
        );
		$this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-mobile-menu ul li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		// Mobile Address style
        $this->start_controls_section(
            'mobile_address_style',
            [
                'label' => __( 'Mobile Address', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'mobile_address_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap h6' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'mobile_address_typography',
                'selector' => '{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap h6',
            ]
        );
		$this->add_responsive_control(
            'mobile_address_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		// Linked Text style
        $this->start_controls_section(
            'linked_text_style',
            [
                'label' => __( 'Linked Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'linked_text_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap h6' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'linked_text_typography',
                'selector' => '{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap h6',
            ]
        );
		$this->add_responsive_control(
            'linked_text_gap',
            [
                'label' => __( 'Gap', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap h6' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'linked_text_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-mobile-menu-btn .sidebar-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

		// Mobile Social Icon style
        $this->start_controls_section(
            'mobile_social_icon_style',
            [
                'label' => __( 'Mobile Social Icon', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'social_icon_color',
			[
				'label' => __( 'Color', 'quanto' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu-btn .social-btn.style3 a' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_responsive_control(
			'social_icon_spacing',
			[
				'label'     => esc_html__( 'Gap', 'mas-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-mobile-menu-btn .social-btn.style3' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		$darklogo = null !== quanto_opt('dark_logo') ? quanto_opt('dark_logo') : '';
		$whitelogo =  null !== quanto_opt('white_logo') ? quanto_opt('white_logo') : '';

		if ( 'yes' == $settings['use_main_menu'] ) {
            $args = [
                'theme_location'  => 'primary-menu',
                'container'      => false, 
                'menu_id'        => false, 
                'menu_class'     => false, 
            ];
        } else {
            $args = [
                // 'theme_location'        => 'main-menu',
                'menu'            => $settings['primary_menu'],
                'container'      => false, 
                'menu_id'        => false, 
                'menu_class'     => false, 
            ];
        }
		
		?>
			<!-- Mobile Menu -->
			<div class="quanto-menu-wrapper">
				<div class="quanto-menu-area text-center">
					<div class="quanto-menu-mobile-top">
						<div class="mobile-logo">
							<?php 
								if ( $settings['logo_type'] == 'dark' ) {
									$url = $darklogo['url'];
									
								} elseif ($settings['logo_type'] == 'white') {
									$url = $whitelogo['url'];
								} else{
									$url = $settings['logo_image']['url'];
								}
								echo '<a href="'.esc_url( home_url() ).'">';
								echo '<img src="'.esc_url( $url ).'" alt="logo" />';
								echo '</a>';
							?>
						</div>
						<button class="quanto-menu-toggle mobile">
							<i class="ri-close-line"></i>
						</button>
					</div>
					<div class="quanto-mobile-menu">
						<?php wp_nav_menu( $args );?>
					</div>
					<div class="quanto-mobile-menu-btn">
						<div class="sidebar-wrap">
							<h6><?php echo quanto_kses( $settings['address_text'] ) ?></h6>
						</div>
						<div class="sidebar-wrap">
							<?php foreach( $settings['linked_item_list'] as $item ) : ?>
								<?php if ( !empty( $item['item_text'] ) ) : ?>
									<h6>
										<a href="<?php echo esc_url( $item['item_url']['url'] ) ?>">
											<?php echo esc_html( $item['item_text'] ) ?>
										</a>
									</h6>
								<?php endif; ?>
                			<?php endforeach; ?>
						</div>
						<div class="social-btn style3">
							<?php foreach( $settings['mobile_menu_social_list'] as $social_icon ) : ?>
								<?php if ( !empty( $social_icon['social_icon_select'] ) ) : ?>
									<a href="<?php echo esc_url( $social_icon[ 'icon_url' ]['url'] ); ?>">
										<span class="link-effect">
											<span class="effect-1"><i class="fab fa-<?php echo esc_html( $social_icon[ 'social_icon_select' ] ); ?>"></i></span>
											<span class="effect-1"><i class="fab fa-<?php echo esc_html( $social_icon[ 'social_icon_select' ] ); ?>"></i></span>
										</span>
									</a>
								<?php endif; ?>
                			<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
			<!-- End mobile menu -->

			
			<nav class="main-menu menu-style1 d-none d-lg-block">
				<?php wp_nav_menu( $args );?>
			</nav>
			<button class="menuBar-toggle quanto-menu-toggle d-inline-block d-lg-none">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
					<path d="M24.4444 26V28H0V26H24.4444ZM40 19V21H0V19H40ZM40 12V14H15.5556V12H40Z" fill="currentColor"/>
				</svg>
			</button>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Menu() );