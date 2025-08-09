<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Mobilemenu Widget .
 *
 */
class Quanto_Menu extends Widget_Base {

	public function get_name() {
		return 'quantomenu';
	}

	public function get_title() {
		return __( 'Header Menu', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'mobile_menu_section',
			[
				'label' 	=> __( 'Header Menu', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'logo',
			[
				'label'     => esc_html__( 'Mobile Logo', 'quanto' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url'          => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'menu_bg_color',
			[
				'label' 		=> __( 'Menu Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .vs-menu-toggle' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'mibile_menu_align',
			[
				'label' 	=> __( 'Menu Alignment', 'quanto' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' 	=> __( 'Left', 'quanto' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', 'quanto' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', 'quanto' ),
						'icon' 		=> 'fa fa-align-right',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .vs-menu-toggle-wraper' => 'text-align: {{VALUE}} !important;',
				],
				'toggle' 		=> true,
			]
		);

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();
		if( has_nav_menu( 'primary-menu' ) ){
		?>
			<div class="quanto-menu-wrapper">
				<div class="quanto-menu-area text-center">
					<div class="quanto-menu-mobile-top">
						<div class="mobile-logo">
							<!-- <a href="blog.html">
								<img src="assets/images/logo/logo-dark.svg" alt="logo">
							</a> -->
						</div>
						<button class="quanto-menu-toggle mobile">
							<i class="ri-close-line"></i>
						</button>
					</div>

					<div class="quanto-mobile-menu">
						<?php
							wp_nav_menu( array(
								"theme_location"    => 'primary-menu',
								"container"         => '',
								"menu_class"        => ''
							) );
						?>
					</div>
					<div class="quanto-mobile-menu-btn">
						<a class="quanto-default-btn" href="">contact us</a>
						<a class="quanto-default-btn" href="">contact us</a>
					</div>
				</div>
			</div>
			
            <nav class="main-menu menu-style1">
                <?php
                    wp_nav_menu( array(
                        "theme_location"    => 'primary-menu',
                        "container"         => '',
                        "menu_class"        => ''
                    ) );
                ?>
            </nav>
			<!-- mobile menu trigger -->
			<button class="quanto-menu-toggle">
          <i class="ri-menu-line"></i>
			</button>
			<!--/.Mobile Menu Hamburger Ends-->
          <?php 
		}
	}
}
$widgets_manager->register( new \Quanto_Menu() );