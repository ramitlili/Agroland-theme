<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Offcanvas Widget .
 *
 */
class Quanto_Offcanvas extends Widget_Base {

	public function get_name() {
		return 'quanto_offcanvas';
	}

	public function get_title() {
		return __( 'Offcanvas', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'offcanvas_section',
			[
				'label' 	=> __( 'Offcanvas', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'quanto_Offcanvas_builder',
			[
				'label'     => __( 'Select Offcanvas', 'quanto' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->quanto_offcanvas_one(),
				'default'	=> ''
			]
		);
        $this->end_controls_section();

		// Offcanvas Style
        $this->start_controls_section(
            'offcanvas_style',
            [
                'label' => __( 'Offcanvas', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-large-toggle svg path' => 'fill: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'icon_hover_color',
			[
				'label' 		=> __( 'Hover Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-menu-large-toggle:hover svg path' => 'fill: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'offcanvas_bg_color',
			[
				'label' 		=> __( 'Offcanvas Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .desktop-sidemenu' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_responsive_control(
			'close_font_icon_size',
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
					'{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'close_icon_color',
			[
				'label' 		=> __( 'Close Icon Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close svg path' => 'fill: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'close_icon_bg_color',
			[
				'label' 		=> __( 'Close Icon Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'close_icon_border',
                'selector' => '{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close',
            ]
        );
		$this->add_responsive_control(
			'close_icon_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .desktop-sidemenu .sidemenu-header .btn-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

    }


	public function quanto_offcanvas_one(){

		$quanto_post_query = new WP_Query( array(
			'post_type'				=> 'quanto_off_build',
			'posts_per_page'	    => -1,
		) );

		$quanto_tab_builder_title_title = array();
		$quanto_tab_builder_title_title[''] = __( 'Select a Title','quanto');

		while( $quanto_post_query->have_posts() ) {
			$quanto_post_query->the_post();
			$quanto_tab_builder_title_title[ get_the_ID() ] =  get_the_title();
		}
		wp_reset_postdata();
		return $quanto_tab_builder_title_title;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
			<!-- Widget Markup -->
			<button class="quanto-menu-large-toggle" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
					<path d="M24.4444 26V28H0V26H24.4444ZM40 19V21H0V19H40ZM40 12V14H15.5556V12H40Z" fill="white"/>
				</svg>
			</button>


			<!-- Template Markup -->
			<div class="offcanvas offcanvas-end desktop-sidemenu" tabindex="-1" id="offcanvasRight" 			  aria-labelledby="offcanvasRightLabel">
				<div class="offcanvas-header sidemenu-header">
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
							<path d="M8.58981 10.0001L0.796875 2.20718L2.21109 0.792969L10.004 8.58582L17.7969 0.792969L19.2111 2.20718L11.4182 10.0001L19.2111 17.7929L17.7969 19.2072L10.004 11.4143L2.21109 19.2072L0.796875 17.7929L8.58981 10.0001Z" fill="currentColor"/>
						</svg>
					</button>
				</div>
				<?php  $elementor = \Elementor\Plugin::instance();
					echo $elementor->frontend->get_builder_content_for_display($settings['quanto_Offcanvas_builder']); 
				?>
			</div>

		<?php

	}
}
$widgets_manager->register( new \Quanto_Offcanvas() );

