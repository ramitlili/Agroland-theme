<?php

namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class MAS_Text_Animation_Effects {

	public static function init() {
		$text_elements = [
			[
				'name'    => 'heading',
				'section' => 'section_title',
			],
			[
				'name'    => 'text-editor',
				'section' => 'section_editor',
			],
			[
				'name'    => 'mas-addons-heading',
				'section' => 'section_title',
			],
			[
				'name'    => 'mas-addon-fancy-text',
				'section' => 'mas_fancy_additional_settings',
			],
			
		];
		foreach ( $text_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_text_animation_controls',
			], 10, 2 );
		}
	}

	public static function register_text_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_text_animation',
			[
				'label' => __( 'Text Animation', 'mas-addons' ),
			]
		);

		$animation = [
			'none'        => esc_html__( 'none', 'mas-addons' ),
			'char'        => esc_html__( 'Character', 'mas-addons' ),
			'word'        => esc_html__( 'Word', 'mas-addons' ),
			'text_move'   => esc_html__( 'Text Move', 'mas-addons' ),
			'text_reveal' => esc_html__( 'Text Reveal', 'mas-addons' ),
		];

		if ( in_array( $element->get_name(), [ 'heading' ] ) ) {
			$animation['text_invert'] = esc_html__( 'Text Invert', 'mas-addons' );
		}

		$element->add_control(
			'mas_text_animation',
			[
				'label'              => esc_html__( 'Animation', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => $animation,
				'render_type'        => 'template',
				'prefix_class'       => 'mas-t-animation-',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_delay',
			[
				'label'              => esc_html__( 'Delay', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => 0.15,
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word', 'text_reveal', 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_duration',
			[
				'label'              => esc_html__( 'Duration', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => 1,
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word', 'text_reveal', 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_stagger',
			[
				'label'              => esc_html__( 'Stagger', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.01,
				'default'            => 0.02,
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word', 'text_reveal', 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_on_scroll',
			[
				'label'              => esc_html__( 'Animation on scroll', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'mas-addons' ),
				'label_off'          => esc_html__( 'No', 'mas-addons' ),
				'return_value'       => 'yes',
				'default'            => 'yes',
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word', 'text_reveal', 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_translate_x',
			[
				'label'              => esc_html__( 'Transform-X', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 20,
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_translate_y',
			[
				'label'              => esc_html__( 'Transform-Y', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0,
				'condition'          => [
					'mas_text_animation' => [ 'char', 'word' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_rotation_di',
			[
				'label'              => esc_html__( 'Rotation Direction', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'x',
				'separator'          => 'before',
				'options'            => [
					'x' => esc_html__( 'X', 'mas-addons' ),
					'y' => esc_html__( 'Y', 'mas-addons' ),
				],
				'condition'          => [
					'mas_text_animation' => [ 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_rotation',
			[
				'label'              => esc_html__( 'Rotation Value', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => '-80',
				'condition'          => [
					'mas_text_animation' => [ 'text_move' ],
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'text_transform_origin',
			[
				'label'              => esc_html__( 'transformOrigin', 'mas-addons' ),
				'type'               => Controls_Manager::TEXT,
				'frontend_available' => true,
				'default'            => esc_html__( 'top center -50', 'mas-addons' ),
				'placeholder'        => esc_html__( 'top center', 'mas-addons' ),
				'condition'          => [
					'mas_text_animation' => [ 'text_move' ],
				],
			]
		);

		$dropdown_options = [
			'' => esc_html__( 'All', 'mas-addons' ),
		];

		foreach ( Plugin::$instance->breakpoints->get_active_breakpoints() as $breakpoint_key => $breakpoint_instance ) {

			$dropdown_options[ $breakpoint_key ] = sprintf(
			/* translators: 1: Breakpoint label, 2: `>` character, 3: Breakpoint value. */
				esc_html__( '%1$s (%2$dpx)', 'mas-addons' ),
				$breakpoint_instance->get_label(),
				$breakpoint_instance->get_value()
			);
		}

		$element->add_control(
			'text_animation_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Note: Choose at which breakpoint animation will work.', 'mas-addons' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'default'            => '',
				'condition'          => [
					'mas_text_animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'text_breakpoint_min_max',
			[
				'label'              => esc_html__( 'Breakpoint Min/Max', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'min',
				'options'            => [
					'min' => esc_html__( 'Min(>)', 'mas-addons' ),
					'max' => esc_html__( 'Max(<)', 'mas-addons' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'mas_text_animation!'        => 'none',
					'text_animation_breakpoint!' => '',
				],
			]
		);

		$element->end_controls_section();
	}

}

MAS_Text_Animation_Effects::init();
