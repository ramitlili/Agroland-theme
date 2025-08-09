<?php
/**
 * Test Effects extension class.
 */

namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class MAS_Cursor_Hover_Effects {

	public static function init() {
		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_cursor_hover_effect_controls'
		] );
	}

	public static function enqueue_scripts() {

	}

	public static function register_cursor_hover_effect_controls( $element ) {
		$tab  = Controls_Manager::TAB_CONTENT;

		if ( 'container' === $element->get_name() ) {
			$tab = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'_section_mas_cursor_hover_area',
			[
				'label' => __( 'Cursor hover effect', 'mas-addons' ),
				'tab'   => $tab,
			]
		);

		$element->add_control(
			'mas_enable_cursor_hover_effect',
			[
				'label'              => esc_html__( 'Enable', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'mas_enable_cursor_hover_effect_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_control(
			'mas_enable_cursor_hover_effect_text',
			[
				'label'              => esc_html__( 'Text', 'mas-addons' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'separator'          => 'after',
				'default'            => esc_html__( 'View', 'mas-addons' ),
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mas_cursor_hover_cursor_typography',
				'selector' => '.mas-hover-cursor-effect.active-{{ID}}',
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_control(
			'mas_cursor_hover_cursor_color',
			[
				'label'     => esc_html__( 'Text Color', 'mas-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.mas-hover-cursor-effect.active-{{ID}}' => 'color: {{VALUE}}',
				],
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'mas_cursor_hover_cursor_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '.mas-hover-cursor-effect.active-{{ID}}',
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_cursor_hover_cursor_width',
			[
				'label'      => esc_html__( 'Width', 'mas-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.mas-hover-cursor-effect.active-{{ID}}' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_cursor_hover_cursor_height',
			[
				'label'      => esc_html__( 'Height', 'mas-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'separator'  => 'after',
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'.mas-hover-cursor-effect.active-{{ID}}' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'mas_cursor_hover_cursor_border',
				'selector' => '.mas-hover-cursor-effect.active-{{ID}}',
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->add_control(
			'mas_cursor_hover_cursor_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'mas-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'.mas-hover-cursor-effect.active-{{ID}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [ 'mas_enable_cursor_hover_effect!' => '' ]
			]
		);

		$element->end_controls_section();
	}
}

MAS_Cursor_Hover_Effects::init();
