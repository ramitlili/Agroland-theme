<?php
namespace Mas\inc;

use Elementor\Element_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class MAS_Hover_Effect_Image {

	public static function init() {
		add_action( 'elementor/element/container/section_layout/after_section_end', [
			__CLASS__,
			'register_hover_image_controls'
		] );
	}

	public static function enqueue_scripts() {

	}

	public static function register_hover_image_controls( $element ) {
		$element->start_controls_section(
			'_section_mas_hover_image_area',
			[
				'label' => __('Hover effect image', 'mas-addons'),
				'tab' => Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'mas_enable_hover_image',
			[
				'label'              => esc_html__( 'Enable', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
			]
		);

		$element->add_control(
			'mas_enable_hover_image_editor',
			[
				'label'              => esc_html__( 'Enable On Editor', 'mas-addons' ),
				'type'               => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'return_value'       => 'yes',
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_control(
			'mas_hover_image',
			[
				'label' => esc_html__( 'Choose Image', 'mas-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'selectors'  => [
					'{{WRAPPER}} .mas-image-hover' => 'background-image: url( {{URL}} );',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_hover_image_width',
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
					'{{WRAPPER}} .mas-image-hover' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_hover_image_height',
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
					'{{WRAPPER}} .mas-image-hover' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_hover_image_position_top',
			[
				'label'      => esc_html__( 'Position Top', 'mas-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%'  => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .mas-image-hover' => 'top: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_responsive_control(
			'mas_hover_image_position_left',
			[
				'label'      => esc_html__( 'Position Left', 'mas-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => - 1000,
						'max' => 1000,
					],
					'%'  => [
						'min' => - 100,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .mas-image-hover' => 'left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->add_control(
			'mas_hover_image_zindex',
			[
				'label' => esc_html__( 'Z-index', 'mas-addons' ),
				'type'  => Controls_Manager::NUMBER,
				'min'   => - 9999,
				'max'   => 9999,
				'selectors'  => [
					'{{WRAPPER}} .mas-image-hover' => 'z-index: {{VALUE}};',
				],
				'condition' => [ 'mas_enable_hover_image!' => '' ]
			]
		);

		$element->end_controls_section();
	}
}

MAS_Hover_Effect_Image::init();
