<?php

namespace Mas\inc;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

class MAS_Popup {

	public static function init() {
		//popup controls
		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_popup_controls'
		] );
	}

	public static function register_popup_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_popup_area',
			[
				'label' => __( 'Mas Popup', 'mas-addons' ),
				'tab'   => Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'mas_enable_popup',
			[
				'label'              => esc_html__( 'Enable Popup', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'mas_enable_popup_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [ 'mas_enable_popup!' => '' ]
			]
		);

		$element->add_control(
			'popup_content_type',
			[
				'label'     => esc_html__( 'Content Type', 'mas-addons' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'content'  => esc_html__( 'Content', 'mas-addons' ),
					'template' => esc_html__( 'Saved Templates', 'mas-addons' ),
				],
				'default'   => 'content',
				'condition' => [ 'mas_enable_popup!' => '' ]
			]
		);

		$element->add_control(
			'popup_elementor_templates',
			[
				'label'       => esc_html__( 'Save Template', 'mas-addons' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => false,
				'multiple'    => false,
				'options'     => mas_animation_cpt_slug_and_id('elementor_library'),
				'condition'   => [
					'popup_content_type' => 'template',
					'mas_enable_popup!'  => '',
				],
			]
		);

		$element->add_control(
			'popup_content',
			[
				'label'     => esc_html__( 'Content', 'mas-addons' ),
				'default'   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'mas-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'condition' => [
					'popup_content_type' => 'content',
					'mas_enable_popup!'  => '',
				],
			]
		);

		$element->add_control(
			'popup_trigger_cursor',
			[
				'label'     => esc_html__( 'Cursor', 'mas-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default'  => esc_html__( 'Default', 'mas-addons' ),
					'none'     => esc_html__( 'None', 'mas-addons' ),
					'pointer'  => esc_html__( 'Pointer', 'mas-addons' ),
					'grabbing' => esc_html__( 'Grabbing', 'mas-addons' ),
					'move'     => esc_html__( 'Move', 'mas-addons' ),
					'text'     => esc_html__( 'Text', 'mas-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}}' => 'cursor: {{VALUE}};',
				],
				'condition' => [ 'mas_enable_popup!' => '' ],
			]
		);

		$element->add_control(
			'popup_animation',
			[
				'label'              => esc_html__( 'Animation', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'frontend_available' => true,
				'default'            => 'default',
				'options'            => [
					'default'             => esc_html__( 'Default', 'mas-addons' ),
					'mfp-zoom-in'         => esc_html__( 'Zoom', 'mas-addons' ),
					'mfp-zoom-out'        => esc_html__( 'Zoom-out', 'mas-addons' ),
					'mfp-newspaper'       => esc_html__( 'Newspaper', 'mas-addons' ),
					'mfp-move-horizontal' => esc_html__( 'Horizontal move', 'mas-addons' ),
					'mfp-move-from-top'   => esc_html__( 'Move from top', 'mas-addons' ),
					'mfp-3d-unfold'       => esc_html__( '3d unfold', 'mas-addons' ),
				],
				'condition'          => [ 'mas_enable_popup!' => '' ],
			]
		);

		$element->add_control(
			'popup_animation_delay',
			[
				'label'              => esc_html__( 'Removal Delay', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'frontend_available' => true,
				'default'            => 500,
				'condition'          => [ 'mas_enable_popup!' => '' ],
			]
		);

		$element->end_controls_section();
	}
}

MAS_Popup::init();
