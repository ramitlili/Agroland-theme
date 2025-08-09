<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Scroll Down Widget .
 *
 */
class Quanto_Scroll_Down extends Widget_Base {

	public function get_name() {
		return 'quanto_scroll_down';
	}
     
	public function get_title() {
		return __( 'Scroll Down', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {
		
		$this->start_controls_section(
			'scroll_down_section',
			[
				'label' 	=> __( 'Scroll Down', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'scroll_layout',
			[
				'label' => __( 'Style', 'quanto' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Style 1', 'quanto' ),
					'layout-2' => __( 'Style 2', 'quanto' ),
					'layout-3' => __( 'Style 3', 'quanto' ),
				],
			]
		);
        $this->add_control(
            'animated_image',
            [
                'label' => esc_html__('Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
					'scroll_layout' => 'layout-1',
				]
            ]
        );
        $this->add_control(
			'map_url',
			[
				'label' 		=> __( 'Map Url', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( '', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'scroll_layout' => 'layout-2',
				]
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' 		=> __( 'Video Url', 'quanto' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default'		=> __( '', 'quanto' ),
				'label_block'   => true,
                'condition' => [
					'scroll_layout' => 'layout-3',
				]
			]
		);
        $this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Scroll down', 'quanto' ),
				'label_block'   => true,
			]
		);
		$this->add_control(
			'play_text',
			[
				'label' 		=> __( 'Play Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Play', 'quanto' ),
				'label_block'   => true,
				'condition' => [
					'scroll_layout' => 'layout-3',
				]
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
        $this->add_control(
            'scroll_icon',
            [
                'label' => esc_html__('Background Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
		$this->end_controls_section();

        // Text Style
        $this->start_controls_section(
            'text_style',
            [
                'label' => __( 'Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .scroll-down' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .scroll-down',
            ]
        );
        $this->add_responsive_control(
			'btn_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'mas-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .scroll-down' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		// Play Button Style
        $this->start_controls_section(
            'play_btn_style',
            [
                'label' => __( 'Play Button', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroll_layout' => 'layout-3',
				]
            ]
        );
		$this->add_control(
            'play_btn_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-video-area.style-2 .play-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'play_btn_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'play_btn_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-video-area.style-2 .play-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'play_btn_bg_hover_color',
            [
                'label' => __( 'Background Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'play_btn_typography',
                'selector' => '{{WRAPPER}} .quanto-video-area.style-2 .play-btn',
            ]
        );
		$this->add_responsive_control(
			'play_btn_size',
			[
				'label' => esc_html__( 'Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-video-area.style-2 .play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		$layout = $settings[ 'scroll_layout' ];
		
		?>
            <?php 	
				if ($layout) {
					include('scroll-down/'.$layout.'.php');
				}
			?>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Scroll_Down() );