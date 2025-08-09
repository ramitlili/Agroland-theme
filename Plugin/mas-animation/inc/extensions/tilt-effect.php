<?php

namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class MAS_Tilt {

	public static function init() {
		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_tilt_controls'
		] );
	}

	public static function enqueue_scripts() {

	}

	public static function register_tilt_controls( $element ) {

		$element->start_controls_section(
			'_section_mas_tilt_area',
			[
				'label' =>  __( 'Tilt', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'mas_enable_tilt',
			[
				'label'              => esc_html__( 'Enable', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'render_type'  => 'template',
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'mas_max_tilt',
			[
				'label'              => esc_html__( 'maxTilt', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 5,
				'max'                => 50,
				'default'            => 20,
				'frontend_available' => true,
				'condition'          => [ 'mas_enable_tilt!' => '' ]
			]
		);

		$element->add_control(
			'mas_tilt_perspective',
			[
				'label'              => esc_html__( 'Perspective', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1000,
				'frontend_available' => true,
				'condition'          => [ 'mas_enable_tilt!' => '' ]
			]
		);

		$element->add_control(
			'mas_tilt_scale',
			[
				'label'              => esc_html__( 'Scale', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 1,
				'max'                => 10,
				'default'            => 1,
				'frontend_available' => true,
				'condition'          => [ 'mas_enable_tilt!' => '' ]
			]
		);

		$element->add_control(
			'mas_tilt_speed',
			[
				'label'              => esc_html__( 'Speed', 'animation-addons-for-elementor' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 3000,
				'frontend_available' => true,
				'condition'          => [ 'mas_enable_tilt!' => '' ]
			]
		);

		$element->end_controls_section();
	}
}

MAS_Tilt::init();
