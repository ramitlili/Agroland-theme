<?php
/**
 * Animation Effects extension class.
 */

 namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class MAS_Animation_Effects {

	public static function init() {

		//animation controls
		add_action( 'elementor/element/common/_section_style/after_section_end', [
			__CLASS__,
			'register_animation_controls',
		] );

		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_animation_controls'
		] );

		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'mas_attributes' ] );
		add_action( 'elementor/frontend/container/before_render', [ __CLASS__, 'mas_attributes' ] );

		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ] );
	}

	public static function enqueue_scripts() {

	}

	/**
	 * Set attributes based extension settings
	 *
	 * @param Element_Base $section
	 *
	 * @return void
	 */
	public static function mas_attributes( $element ) {
		if ( ! empty( $element->get_settings( 'mas_enable_scroll_smoother' ) ) ) {
			$attributes = [];

			if ( ! empty( $element->get_settings( 'data-speed' ) ) ) {
				$attributes['data-speed'] = $element->get_settings( 'data-speed' );
			}
			if ( ! empty( $element->get_settings( 'data-lag' ) ) ) {
				$attributes['data-lag'] = $element->get_settings( 'data-lag' );
			}

			$attributes['id'] = 'mas_smooth_scroller';

			$element->add_render_attribute( '_wrapper', $attributes );
		}
	}

	public static function register_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_animation',
			[
				'label' => __('Animation', 'mas-addons'),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'mas-animation',
			[
				'label'              => esc_html__( 'Animation', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none' => esc_html__( 'none', 'mas-addons' ),
					'fade' => esc_html__( 'fade animation', 'mas-addons' ),
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas_enable_animation_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'mas-addons' ),
				'description'        => esc_html__( 'For better performance in editor mode, keep the setting turned off.', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition'          => [
					'mas-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'delay',
			[
				'label'              => esc_html__( 'Delay', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'min'                => 0,
				'max'                => 10,
				'step'               => 0.1,
				'default'            => .15,
				'condition'          => [
					'mas-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'on-scroll',
			[
				'label'              => esc_html__( 'Animation on scroll', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'label_on'           => esc_html__( 'Yes', 'mas-addons' ),
				'label_off'          => esc_html__( 'No', 'mas-addons' ),
				'return_value'       => 1,
				'default'            => 1,
				'frontend_available' => true,
				'condition'          => [
					'mas-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade-from',
			[
				'label'              => esc_html__( 'Fade from', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top',
				'options'            => [
					'top'    => esc_html__( 'Top', 'mas-addons' ),
					'bottom' => esc_html__( 'Bottom', 'mas-addons' ),
					'left'   => esc_html__( 'Left', 'mas-addons' ),
					'right'  => esc_html__( 'Right', 'mas-addons' ),
					'in'     => esc_html__( 'In', 'mas-addons' ),
				],
				'frontend_available' => true,
				'condition'          => [
					'mas-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'data-duration',
			[
				'label'              => esc_html__( 'Duration', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1.5,
				'condition'          => [
					'mas-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'ease',
			[
				'label'              => esc_html__( 'Ease', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'power2.out',
				'options'            => [
					'power2.out' => esc_html__( 'Power2.out', 'mas-addons' ),
					'bounce'     => esc_html__( 'Bounce', 'mas-addons' ),
					'back'       => esc_html__( 'Back', 'mas-addons' ),
					'elastic'    => esc_html__( 'Elastic', 'mas-addons' ),
					'slowmo'     => esc_html__( 'Slowmo', 'mas-addons' ),
					'stepped'    => esc_html__( 'Stepped', 'mas-addons' ),
					'sine'       => esc_html__( 'Sine', 'mas-addons' ),
					'expo'       => esc_html__( 'Expo', 'mas-addons' ),
				],
				'condition'          => [
					'mas-animation!' => 'none',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'fade-offset',
			[
				'label'              => esc_html__( 'Fade offset', 'mas-addons' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'condition'          => [
					'mas-animation!' => 'none',
				],
				'frontend_available' => true,
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
			'fade_animation_breakpoint',
			[
				'label'              => esc_html__( 'Breakpoint', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'description'        => esc_html__( 'Note: Choose at which breakpoint animation will work.', 'mas-addons' ),
				'options'            => $dropdown_options,
				'frontend_available' => true,
				'default'            => '',
				'condition'          => [
					'mas-animation!' => 'none',
				],
			]
		);

		$element->add_control(
			'fade_breakpoint_min_max',
			[
				'label'     => esc_html__( 'Breakpoint Min/Max', 'mas-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'min',
				'options'   => [
					'min' => esc_html__( 'Min(>)', 'mas-addons' ),
					'max' => esc_html__( 'Max(<)', 'mas-addons' ),
				],
				'frontend_available' => true,
				'condition' => [
					'mas-animation!'        => 'none',
					'fade_animation_breakpoint!' => '',
				],
			]
		);

		//smooth scroll animation
		$element->add_control(
			'mas_enable_scroll_smoother',
			[
				'label'        => esc_html__( 'Enable Scroll Smoother', 'mas-addons' ),
				'description'  => esc_html__( 'If you want to use scroll smooth, please enable global settings first', 'mas-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'mas-addons' ),
				'label_off'    => esc_html__( 'No', 'mas-addons' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			]
		);

		$element->add_control(
			'data-speed',
			[
				'label'     => esc_html__( 'Speed', 'mas-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0.9,
				'condition' => [ 'mas_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->add_control(
			'data-lag',
			[
				'label'     => esc_html__( 'Lag', 'mas-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'condition' => [ 'mas_enable_scroll_smoother' => 'yes' ],
			]
		);

		$element->end_controls_section();
	}

}

MAS_Animation_Effects::init();
