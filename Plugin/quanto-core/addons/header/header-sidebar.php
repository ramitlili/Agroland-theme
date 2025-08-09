<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Header Sidebar Widget .
 *
 */
class Quanto_Header_Sidebar extends Widget_Base {

	public function get_name() {
		return 'quanto_header_sidebar';
	}

	public function get_title() {
		return __( 'Header Sidebar', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto_header_elements' ];
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
			'header_sidebar_section',
			[
				'label' 	=> __( 'Header Sidebar', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'toggle_icon',
			[
				'label'       => __( 'Icon', 'adina' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $this->end_controls_section();

        // Left Sidebar
        $this->start_controls_section(
			'header_left_side_section',
			[
				'label' 	=> __( 'Left Side', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'logo_type',
			[
				'label' => __( 'Logo Type', 'quanto' ),
				'type'  => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark'   => __( 'Dark', 'quanto' ),
					'white'  => __( 'White', 'quanto' ),
					'custom' => __( 'Custom', 'quanto' ),
				],
			]
        );
        $this->add_control(
            'image',
            [
                'label' => __('Choose logo', 'quanto'),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );
        $this->add_control(
			'rating_point',
			[
				'label' 		=> __( 'Rating Point', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '4.8', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
            'rating_icon',
            [
                'label' => esc_html__('Rating Icon', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $this->add_control(
			'rating_text',
			[
				'label' 		=> __( 'Rating Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( '2500+ reviews based on client feedback', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->end_controls_section();

        // Sidebar Menu
        $this->start_controls_section(
			'header_sidebar_menu_section',
			[
				'label' 	=> __( 'Sidebar Menu', 'quanto' ),
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

        // Right Sidebar
        $this->start_controls_section(
			'header_right_side_section',
			[
				'label' 	=> __( 'Right Side', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'right_side_title',
			[
				'label' 		=> __( 'Title', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Contact', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'right_side_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( '740 New South Head Rd, Triple Bay Swfw 3108, New York', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'right_side_mail',
			[
				'label' 		=> __( 'Mail', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'hello@agroland.farm', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'mail_url',
			[
				'label' 		=> __( 'Mail URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
				'description' => __( 'link like this(mailto:) underline comes.', 'quanto' ),
			]
		);
        $this->add_control(
			'right_side_tel',
			[
				'label' 		=> __( 'tel:', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( '+1 888 456 7890', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->add_control(
			'tel_url',
			[
				'label' 		=> __( 'tel: URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
        $this->end_controls_section();

        // Toggle Style
        $this->start_controls_section(
            'toggle_style',
            [
                'label' => __( 'Toggle', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'toggle_icon_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-toggle svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .quanto-menu-toggle i' => 'color: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'toggle_icon_hover_color',
			[
				'label' 		=> __( 'Hover Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-toggle:hover svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .quanto-menu-toggle:hover i' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_responsive_control(
			'toggle_icon_font_size',
			[
				'label' => esc_html__( 'Toggle Icon Size', 'alvido' ),
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
					'{{WRAPPER}} .quanto-menu-toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'toggle_icon_font_width',
			[
				'label' => esc_html__( 'Toggle Icon Width', 'alvido' ),
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
					'{{WRAPPER}} .quanto-menu-toggle svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'toggle_icon_font_height',
			[
				'label' => esc_html__( 'Toggle Icon Height', 'alvido' ),
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
					'{{WRAPPER}} .quanto-menu-toggle svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        // Left Side Style
        $this->start_controls_section(
            'left_side_style',
            [
                'label' => __( 'Left Side', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'left_side_border',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left',
            ]
        );
		$this->add_control(
			'left_side_bg_color',
			[
				'label' 		=> __( 'Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left' => 'background-color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'rating_point_color',
			[
				'label' 		=> __( 'Rating Point Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left .mobile-menu-info .rating-point' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rating_point_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left .mobile-menu-info .rating-point',
            ]
        );
        $this->add_control(
			'rating_text_color',
			[
				'label' 		=> __( 'Text Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left .mobile-menu-info p' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rating_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-left .mobile-menu-info p',
            ]
        );
        $this->end_controls_section();

        // Menu Style
        $this->start_controls_section(
            'menu_style',
            [
                'label' => __( 'Menu', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'menu_bg_color',
			[
				'label' 		=> __( 'Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-center' => 'background-color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'menu_color',
			[
				'label' 		=> __( 'Menu Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-center .quanto-mobile-menu > ul > li > a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-center .quanto-mobile-menu > ul > li > a',
            ]
        );
        $this->add_control(
			'submenu_color',
			[
				'label' 		=> __( 'SubMenu Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-center .quanto-mobile-menu .sub-menu li a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submenu_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-center .quanto-mobile-menu .sub-menu li a',
            ]
        );
        $this->end_controls_section();

        // Right Side Style
        $this->start_controls_section(
            'right_side_style',
            [
                'label' => __( 'Right Side', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'right_side_bg_color',
			[
				'label' 		=> __( 'Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'close_icon_color',
			[
				'label' 		=> __( 'Close Icon Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .quanto-menu-toggle i' => 'fill: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'close_icon_bg_color',
			[
				'label' 		=> __( 'Close Icon Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .quanto-menu-toggle' => 'background-color: {{VALUE}}',
                ],
			]
        );
        $this->add_responsive_control(
			'close_icon_font_size',
			[
				'label' => esc_html__( 'Close Icon Font Size', 'alvido' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .quanto-menu-toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'close_icon_size',
			[
				'label' => esc_html__( 'Close Icon Size', 'alvido' ),
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
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .quanto-menu-toggle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'right_side_title_color',
			[
				'label' 		=> __( 'Title Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .title' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'right_side_title_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .title',
            ]
        );
        $this->add_control(
			'right_side_text_color',
			[
				'label' 		=> __( 'Text Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .address' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'right_side_text_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .address',
            ]
        );
        $this->add_control(
			'linked_text_color',
			[
				'label' 		=> __( 'Linked Text Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .contact a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'linked_text_typography',
                'selector' => '{{WRAPPER}} .quanto-menu-wrapper.v2 .quanto-menu-area .quanto-mobile-menu-right .contact-info .contact a',
            ]
        );
        $this->end_controls_section();

    }

    /**
     * 
     *  quanto get logo  
     * 
     */
    public function quanto_get_site_logo( $logo_type = 'dark'  )
    {
        $logo = '';
        $quanto = get_option('quanto_opt');
        $logo_url = '';
        if ( 'dark' ==  $logo_type && isset( $quanto['dark_logo']['url'] ) ) {
            $logo_url = esc_url($quanto['dark_logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';

        } else if ( 'white' ==  $logo_type && isset($quanto['white_logo']['url'])) {
            $logo_url = esc_url($quanto['white_logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';
        } else {
            if ( has_custom_logo() ) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($core_logo_id, 'full');
                $logo = '<img src="' . esc_url($logo_url[0]) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';
            } else {
                $logo = '<h3>' . get_bloginfo('name') . '</h3>';
            }
        }
        return $logo;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();

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
            <div class="header-six-sidebar">
                <!-- Button -->
                <button class="quanto-menu-toggle large">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['toggle_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </button>
            </div>

            <!-- Sidebar -->
            <div class="quanto-menu-wrapper v2 d-none d-lg-block">
                <div class="quanto-menu-area text-center">
                    <div class="quanto-mobile-menu-left">
                        <div class="mobile-logo">
                            <a href="<?php echo home_url(); ?>">
                                <?php
                                if ( 'custom' == $settings['logo_type'] && $settings['image']['url']) {
                                    echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
                                } else {
                                    echo $this->quanto_get_site_logo( $settings['logo_type'] );
                                }
                                ?>
                            </a>
                        </div>
                    <div class="mobile-menu-info fade-anim" data-delay="0.60">
                        <h4 class="rating-point">
                            <?php echo esc_html( $settings['rating_point'] ) ?>
                        </h4>
                        <div class="stars">
                            <img src="<?php echo esc_url($settings['rating_icon']['url']); ?>" alt="star">
                        </div>
                        <p><?php echo esc_html( $settings['rating_text'] ) ?></p>
                    </div>
                </div>
                    <div class="quanto-mobile-menu-center">
                        <div class="quanto-mobile-menu">
                            <?php wp_nav_menu( $args );?>
                        </div>
                        <div class="quanto-mobile-menu-btn">
                        </div>
                    </div>
                    <div class="quanto-mobile-menu-right">
                        <button class="quanto-menu-toggle mobile">
                            <i class="ri-close-line"></i>
                        </button>
                        <div class="contact-info">
                            <h6 class="title">
                                <?php echo esc_html( $settings['right_side_title'] ) ?>
                            </h6>
                            <p class="address">
                                <?php echo esc_html( $settings['right_side_text'] ) ?>
                            </p>
                            <div class="contact">
                                <a href="<?php echo esc_url($settings['mail_url']['url']); ?>">
                                    <?php echo esc_html( $settings['right_side_mail'] ) ?>
                                </a>
                                <a href="<?php echo esc_url($settings['tel_url']['url']); ?>">
                                    <?php echo esc_html( $settings['right_side_tel'] ) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php

	}
}
$widgets_manager->register( new \Quanto_Header_Sidebar() );

