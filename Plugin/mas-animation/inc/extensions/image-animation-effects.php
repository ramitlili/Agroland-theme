<?php
namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Plugin;

defined( 'ABSPATH' ) || die();

class MAS_Image_Animation_Effects {

	public static function init() {

		$image_elements = [
			[
				'name'    => 'image',
				'section' => 'section_image',
			],
			
		];
		foreach ( $image_elements as $element ) {
			add_action( 'elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
				__CLASS__,
				'register_image_animation_controls',
			], 10, 2 );
		}

		
	}


	public static function register_image_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_image_animation',
			[
				'label' => __('Image Animation', 'mas-addons'),
			]
		);

		$element->add_control(
			'mas-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'    => esc_html__( 'none', 'mas-addons' ),
					'reveal'  => esc_html__( 'Reveal', 'mas-addons' ),
					'scale'   => esc_html__( 'Scale', 'mas-addons' ),
					'stretch' => esc_html__( 'Stretch', 'mas-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas-scale-start',
			[
				'label'     => esc_html__( 'Start Scale', 'mas-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0.7,
				'condition' => [ 'mas-image-animation' => 'scale' ],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas-scale-end',
			[
				'label'     => esc_html__( 'End Scale', 'mas-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'condition' => [ 'mas-image-animation' => 'scale' ],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas-animation-start',
			[
				'label'              => esc_html__( 'Animation Start', 'mas-addons' ),
				'description'        => esc_html__( 'First value is element position, Second value is display position', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'top top',
				'frontend_available' => true,
				'render_type'        => 'template',
				'options'            => [
					'top top'       => esc_html__( 'Top Top', 'mas-addons' ),
					'top center'    => esc_html__( 'Top Center', 'mas-addons' ),
					'top bottom'    => esc_html__( 'Top Bottom', 'mas-addons' ),
					'center top'    => esc_html__( 'Center Top', 'mas-addons' ),
					'center center' => esc_html__( 'Center Center', 'mas-addons' ),
					'center bottom' => esc_html__( 'Center Bottom', 'mas-addons' ),
					'bottom top'    => esc_html__( 'Bottom Top', 'mas-addons' ),
					'bottom center' => esc_html__( 'Bottom Center', 'mas-addons' ),
					'bottom bottom' => esc_html__( 'Bottom Bottom', 'mas-addons' ),
					'custom'        => esc_html__( 'Custom', 'mas-addons' ),
				],
				'condition'          => [ 'mas-image-animation' => 'scale' ],
			]
		);

		$element->add_control(
			'mas_animation_custom_start',
			[
				'label'       => esc_html__( 'Custom', 'mas-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'top 90%', 'mas-addons' ),
				'placeholder' => esc_html__( 'top 90%', 'mas-addons' ),
				'render_type'        => 'template',
				'condition'   => [
					'mas-image-animation' => 'scale',
					'mas-animation-start' => 'custom'
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'mas-addons' ),
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
				'condition'          => [ 'mas-image-animation' => 'reveal' ],
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

	public static function register_image_reveal_animation_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_image_animation',
			[
				'label' =>  sprintf('%s <i class="mas-logo"></i>', __('Image Animation', 'mas-addons')),
			]
		);

		$element->add_control(
			'mas-image-animation',
			[
				'label'              => esc_html__( 'Animation', 'mas-addons' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'none',
				'separator'          => 'before',
				'options'            => [
					'none'   => esc_html__( 'none', 'mas-addons' ),
					'reveal' => esc_html__( 'Reveal', 'mas-addons' ),
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'image-ease',
			[
				'label'              => esc_html__( 'Data ease', 'mas-addons' ),
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
				'condition'          => [ 'mas-image-animation' => 'reveal' ],
				'frontend_available' => true,
			]
		);

		$element->end_controls_section();
	}

}

MAS_Image_Animation_Effects::init();
