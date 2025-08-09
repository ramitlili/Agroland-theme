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
 * Animation Image Widget .
 *
 */
class Quanto_Animation_Image extends Widget_Base {

	public function get_name() {
		return 'quanto_animation_image';
	}
     
	public function get_title() {
		return __( 'Animation Image', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'animation_image_section',
			[
				'label' 	=> __( 'Animation Image', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
            'animation_img',
            [
                'label' => esc_html__('Image', 'quanto'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
		$this->add_control(
            'need_link',
            [
                'label'        => __( 'Need Link?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
			'img_url',
			[
				'label' 		=> __( 'URL', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
				'condition' => [
					'need_link' => 'yes', 
				]
			]
		);
		$this->end_controls_section();


        // Animation Image Style
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Animation Image', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .quanto-project-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
					'{{WRAPPER}} .quanto-project-thumb img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);			
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
			<?php if ( 'yes' == $settings['need_link'] ): ?>
				<a href="<?php echo esc_url($settings['img_url']['url']); ?>">
					<div class="quanto-project-thumb overflow-hidden">
						<img
							src="<?php echo esc_url($settings['animation_img']['url']); ?>"
							alt="project-thumb"
							class="img_reveal"
						/>
					</div>
				</a>
			<?php else: ?>
				<div class="quanto-project-thumb overflow-hidden">
					<img
						src="<?php echo esc_url($settings['animation_img']['url']); ?>"
						alt="project-thumb"
						class="img_reveal"
					/>
				</div>
			<?php endif; ?>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Animation_Image() );