<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Header Widget .
 *
 */
class Agroland_Search extends Widget_Base {

	public function get_name() {
		return 'quantosearch';
	}

	public function get_title() {
		return __( 'Search Form', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'agroland_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'header_search',
			[
				'label' 	=> __( 'Header Search And Login', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'placeholder_text',
			[
				'label' 		=> __( 'What are you looking for', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Search Here...', 'quanto' ),
				'label_block'   => true,
			]
		);
        $this->end_controls_section();

        // Search Style
		$this->start_controls_section(
			'search_style',
			[
				'label' 	=> __( 'Style', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'search_color',
			[
				'label' 		=> __( 'Search Icon Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agroland-header-search i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'search_color_hover',
			[
				'label' 		=> __( 'Search Icon Hover Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .agroland-header-search:hover i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-header-search i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		?>
			<div class="agroland-header-search">
				<i class="ri-search-line"></i>
			</div>

			<!-- popup -->
			<div class="agroland-header-search-section">
				<div class="container">
					<div class="agroland-header-search-box">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							<input type="search" name="s" placeholder="<?php echo esc_attr__( 'Search Here...', 'construz' ); ?>">
							<button id="header-search" type="button"><i class="ri-search-line"></i></button>
							<p><?php echo esc_html__( 'Type above and press Enter to search. Press Close to cancel.', 'construz' ); ?></p>
						</form>
					</div>
				</div>
				<div class="agroland-header-search-close">
					<i class="ri-close-line"></i>
				</div>
			</div>
            <!-- overlay -->
            <div class="search-overlay"></div>
        <?php

	}
}
$widgets_manager->register( new \Agroland_Search() );
