<?php

// Removed the use Elementor statement
use Elementor\Controls_Stack;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main class plugin
 */
class Sticky_Header {

	/**
	 * @var Plugin
	 */
	private static $_instance;

	/**
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Plugin constructor.
	 */
	private function __construct() {
		$this->add_actions();
	}


	private function add_actions()
	{

		// add She on sections
		add_action('elementor/element/section/section_effects/after_section_end', [$this, 'register_controls']);

		// add She on containers
		add_action('elementor/element/container/section_effects/after_section_end', [$this, 'register_controls']);
//  		add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_styles']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		
	}


	// register all control here
	public function register_controls( Controls_Stack $element ) {
		$element->start_controls_section(
			'mas_sticky_header_effect',
			[
				'label' => __( 'Quanto Sticky Header', 'mas-addons' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$element->add_control(
			'enable_transparent',
			[
				'label' => __( 'Enable', 'mas-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'mas-addons' ),
				'label_off' => __( 'Off', 'bew-header' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'prefix_class'  => 'mas-sticky-'
			]
		);

		$element->add_control(
			'sticky_width',
			[
				'label' => esc_html__( 'Sticky Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => ''
				],
				
			]
		);
		
		$element->add_responsive_control(
			'sticky_gap_top',
			[
				'label' => esc_html__( 'Sticky Top Gap', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => ''
				],
				
			]
		);
		
		$element->add_control(
			'mas_transparent_on',
			[
				'label' => __( 'Enable On', 'mas-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'label_block' => 'true',
				'default' => [ 'desktop', 'tablet', 'mobile' ],
				'options' => [
					'desktop' => __( 'Desktop', 'mas-addons' ),
					'tablet' => __( 'Tablet', 'mas-addons' ),
					'mobile' => __( 'Mobile', 'mas-addons' ),
				],
				'condition' => [
					'enable_transparent!' => ''
				],
				'render_type' => 'none',
				'description' => __( 'This will completely enable/disable settings below.<br>
				*MAY NOT AFFECT SOME SETTINGS WITH RESPONSIVE CONTROLS', 'mas-addons' ),
				'frontend_available' => true,
			]
		);


		$element->add_responsive_control(
			'mas_scroll_distance',
			[
				'label' => __( 'Scroll Distance (px)', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 60,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'size_units' => [ 'px'],
				'description' => __( 'Choose the scroll distance to enable Sticky Header Effects', 'mas-addons' ),
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => '',
				],
			]
		);

		$element->add_control(
			'mas_background_show',
			[
				'label' => __( 'Background Color', 'mas-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on' => __( 'On', 'mas-addons' ),
				'label_off' => __( 'Off', 'bew-header' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => '',
				],
				'description' => __( 'Choose what color to change the background to after scrolling', 'mas-addons' ),
			]
		);
		
		$element->add_control(
			'mas_background_type',
			[
				'label' => __('Background Type', 'mas-addons'),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
				],
				'label_block' => false,
				'render_type' => 'ui',
				'options' => [
					'classic' => [
						'title' => __('Classic', 'mas-addons'),
						'icon' => 'eicon-paint-brush',
					],
					'gradient' => [
						'title' => __('Gradient', 'mas-addons'),
						'icon' => 'eicon-barcode',
					],
				],
				'default' => 'classic'
			]
		);

		$element->add_control(
			'mas_background',
			[
				'label' => __( 'Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
				    'mas_background_show' => 'yes',
					'enable_transparent!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		
		$element->add_control(
			'mas_gradient_transition_notice',
			[
				'raw' => __( 'Please note that gradients will not be transitioned', 'mas-addons' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
				],
			 ]
		);
		
		$element->add_control(
			'mas_color_stop',
			[
				'label' => __('Location', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);

		$element->add_control(
			'mas_color_b',
			[
				'label' => __('Second Color', 'mas-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f2295b',
				'render_type' => 'ui',
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);

		$element->add_control(
			'mas_color_b_stop',
			[
				'label' => __('Location', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);

		$element->add_control(
			'mas_gradient_type',
			[
				'label' => __('Type', 'mas-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'linear' => __('Linear', 'mas-addons'),
					'radial' => __('Radial', 'mas-addons'),
				],
				'default' => 'linear',
				'render_type' => 'ui',
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
				],
				'of_type' => 'gradient',
			]
		);

		$element->add_control(
			'mas_gradient_angle',
			[
				'label' => __('Angle', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.mas' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{background.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
				],
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
					'mas_gradient_type' => 'linear',
				],
				'of_type' => 'gradient',
			]
		);

		$element->add_control(
			'mas_gradient_position',
			[
				'label' => __('Position', 'mas-addons'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'center center' => __('Center Center', 'mas-addons'),
					'center left' => __('Center Left', 'mas-addons'),
					'center right' => __('Center Right', 'mas-addons'),
					'top center' => __('Top Center', 'mas-addons'),
					'top left' => __('Top Left', 'mas-addons'),
					'top right' => __('Top Right', 'mas-addons'),
					'bottom center' => __('Bottom Center', 'mas-addons'),
					'bottom left' => __('Bottom Left', 'mas-addons'),
					'bottom right' => __('Bottom Right', 'mas-addons'),
				],
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}}.mas' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{background.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
				],
				'condition' => [
					'mas_background_show' => 'yes',
					'enable_transparent!' => '',
					'mas_background_type' => ['gradient'],
					'mas_gradient_type' => 'linear',
				],
				'of_type' => 'gradient',
			]
		);
	
		$element->add_control(
			'mas_bottom_border',
			[
				'label' => __( 'Bottom Border', 'mas-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on' => __( 'On', 'mas-addons' ),
				'label_off' => __( 'Off', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => '',
				],
				'description' => __( 'Choose bottom border size and color', 'mas-addons' ),
			]
		);


		$element->add_control(
			'mas_custom_bottom_border_color',
			[
				'label' => __( 'Color', 'mas-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
				    'mas_bottom_border' => 'yes',
					'enable_transparent!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_responsive_control(
			'mas_custom_bottom_border_width',
			[
				'label' => __( 'Bottom Border Thickness (px)', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px'],
				'description' => __( 'Note: A border size(even 0px) must be set on the header for the transition to work both ways', 'mas-addons' ),
				'condition' => [
				    'mas_bottom_border' => 'yes',
					'enable_transparent!' => '',
				],
				'frontend_available' => true,
			]
		);
		
		$element->add_control(
			'mas_bottom_shadow',
			[
				'label' => __('Bottom Shadow', 'mas-addons'),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on' => __('On', 'mas-addons'),
				'label_off' => __('Off', 'mas-addons'),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'condition' => [
					'enable_transparent!' => '',
				],
				'description' => __('Choose bottom shadow options after scrolling', 'mas-addons'),
				'selectors' => [
					'body:not(.elementor-editor-active) .mas-sticky-header' => 'box-shadow: 0 {{mas_bottom_shadow_vertical.SIZE}}{{mas_bottom_shadow_vertical.UNIT}} {{mas_bottom_shadow_blur.SIZE}}{{mas_bottom_shadow_blur.UNIT}} {{mas_bottom_shadow_spread.SIZE}}{{mas_bottom_shadow_spread.UNIT}} {{mas_bottom_shadow_color.VALUE}}; clip-path: inset(0 0 -100vh 0);',
				],
			]
		);
		

		$element->add_control(
			'mas_bottom_shadow_color',
			[
				'label' => __('Color', 'mas-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.15)',
				'condition' => [
					'mas_bottom_shadow' => 'yes',
					'enable_transparent!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas_bottom_shadow_vertical',
			[
				'label' => __('Vertical', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px'],
				'condition' => [
					'mas_bottom_shadow' => 'yes',
					'enable_transparent!' => '',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas_bottom_shadow_blur',
			[
				'label' => __('Blur', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px'],
				'condition' => [
					'mas_bottom_shadow' => 'yes',
					'enable_transparent!' => '',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas_bottom_shadow_spread',
			[
				'label' => __('Spread', 'mas-addons'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => ['px'],
				'condition' => [
					'mas_bottom_shadow' => 'yes',
					'enable_transparent!' => '',
				],
				'frontend_available' => true,
			]
		);

		$element->add_control(
			'mas_shrink_header',
			[
				'label' => __( 'Shrink Header', 'mas-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on' => __( 'On', 'mas-addons' ),
				'label_off' => __( 'Off', 'mas-addons' ),
				'return_value' => 'yes',
				'default' => '',
				'frontend_available' => true,
				'description' => __( 'Choose header height after scrolling', 'mas-addons' ),
				'condition' => [
					'enable_transparent!' => '',
				],
			]
		);

		$element->add_responsive_control(
			'mas_custom_height_header',
			[
				'label' => __( 'Header Height (px)', 'mas-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'size_units' => [ 'px'],
				'description' => __( 'Remember: The header cannot shrink smaller than the elements inside of it', 'mas-addons' ),
				'condition' => [
				   'mas_shrink_header' => 'yes',
					'enable_transparent!' => '',
				],
				'frontend_available' => true,
			]
		);


		$element->end_controls_section();
	}

	// enqueue_scripts
	public function enqueue_scripts() {

		wp_enqueue_script(
			'mas-sticky-header',
			AGROLAND_PLUGDIRURI . 'assets/js/sticky-header.js',
			[
				'jquery',
			],
			false,
			true
		);
	}

	public function enqueue_styles() {
		
		wp_enqueue_style(
			'mas-sticky-header-style',
			AGROLAND_PLUGDIRURI  . 'assets/css/sticky-header.css',
			[],
			'1.0.0',
			'all'
		);

	}


}

Sticky_Header::instance();
