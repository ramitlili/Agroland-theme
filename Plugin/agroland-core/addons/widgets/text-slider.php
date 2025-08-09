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
 * Text Slider Widget .
 *
 */
class Quanto_Text_Slider extends Widget_Base {

	public function get_name() {
		return 'quanto_text_slider';
	}
     
	public function get_title() {
		return __( 'Text Slider', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'text_slider_section',
			[
				'label' 	=> __( 'Text Slider', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$repeater = new Repeater();

        $repeater->add_control(
			'slider_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Let’s work together', 'quanto' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
			'slider_icons',
			[
				'label'       => __( 'Icon', 'quanto' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'icon_url',
			[
				'label' 		=> __( 'Icon Url', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
        $this->add_control(
			'slider_list',
			[
				'label' => __( 'Text Slider', 'quanto' ),
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
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
                    '{{WRAPPER}} .marquee-item h1' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .marquee-item h1',
            ]
        );
		$this->add_responsive_control(
            'text_gap',
            [
                'label' => __( 'Gap', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee-container .marquee .marquee-item-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
		$this->end_controls_section();

        // Icon Style
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __( 'Icon', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .marquee-item i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .marquee-item svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .marquee-item svg' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .marquee-item i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);		
        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .marquee-item svg, .marquee-item i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="marquee-container fade-anim">
                <div class="marquee">
                    <?php foreach ($settings['slider_list'] as $list_item) : ?>
                        <a class="marquee-item-container" href="<?php echo esc_url($list_item['icon_url']['url']); ?>">
                            <div class="marquee-item">
                                <h1><?php echo esc_html($list_item['slider_text']); ?></h1>
                                <?php if (!empty($list_item['slider_icons'])) : ?>
                                    <?php \Elementor\Icons_Manager::render_icon($list_item['slider_icons'], ['aria-hidden' => 'true']); ?>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Text_Slider() );