<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Video Box Widget .
 *
 */
class Quanto_Video_Box extends Widget_Base {

	public function get_name() {
		return 'video_box';
	}

	public function get_title() {
		return __( 'Video Box', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' 	=> __( 'Content', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			] 
        );
        $this->add_control(
            'video_layout',
            [
                'label' => esc_html__('Select Layout', 'quanto'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'quanto'),
                    'layout-2' => esc_html__('Layout 2', 'quanto'),
                ],
                'default' => 'layout-1',
            ]
        );
        $this->add_control(
			'video_url',
			[
				'label' => __( 'M4 Video URL', 'quanto' ),
				'type' => Controls_Manager::TEXT,
                'default' => 'https://res.cloudinary.com/ducryslbe/video/upload/v1740329511/Quanto/video.sakebul.com.mp4',
                'label_block' => true,
			]
		);
        $this->add_control(
			'btn_text',
			[
				'label'   => esc_html__( 'Button Text', 'quanto' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Play', 'quanto' ),
                'label_block' => true,
				'condition' => [
                    'video_layout' => 'layout-2',
                ]
			]
		);
		$this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .play-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
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
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .play-btn',
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .play-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
                'selector' => '{{WRAPPER}} .play-btn:hover',
            ]
        );
        $this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__( 'Button Size', 'adina' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .play-btn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();


	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $layout = $settings['video_layout'];

		?>

        <?php if ('layout-1' == $layout): ?>
            <?php if (!empty($settings['video_url'])): ?>
                <div class="quanto-hero__thumb section-margin-top">
                    <div class="video-wrapper">
                        <video loop muted autoplay playsinline>
                            <source src="<?php echo esc_url($settings['video_url']); ?>" type="video/mp4" />
                        </video>
                    </div>
                </div>
            <?php endif; ?>
        <?php elseif ('layout-2' == $layout): ?>
            <?php if (!empty($settings['video_url'])): ?>
                <div class="quanto-video-area style-2 overflow-hidden">
                    <video
                        muted
                        autoplay
                        loop
                        src="<?php echo esc_url($settings['video_url']); ?>"
                        class="quanto-video"
                        id="quanto-video-2"
                    ></video>
                    <?php if (!empty($settings['btn_text'])): ?>
                        <button class="play-btn">
                            <?php echo esc_html($settings['btn_text']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

            
		<?php
	}
}
$widgets_manager->register( new \Quanto_Video_Box() );