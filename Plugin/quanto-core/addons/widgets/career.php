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
 * Career Widget .
 *
 */
class Quanto_Career extends Widget_Base {

	public function get_name() {
		return 'quanto_career';
	}
     
	public function get_title() {
		return __( 'Career', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'career_section',
			[
				'label' 	=> __( 'Career', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'select_post',
            [
                'label' => __('Must be Select a Post', 'optech'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'default' => 'none',
                'options' => $this->get_all_jobs(),
            ]
        );
        $repeater->add_control(
			'address_text',
			[
				'label' => esc_html__( 'Address', 'optech' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'California , United State', 'optech' ),
			]
		);
        $repeater->add_control(
			'roles_text',
			[
				'label' => esc_html__( 'Roles Text', 'optech' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'Open Roles:', 'optech' ),
			]
		);
        $repeater->add_control(
			'employee_need',
			[
				'label' => esc_html__( 'Employee Need', 'optech' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( '04', 'optech' ),
			]
		);
        $repeater->add_control(
			'button_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Get in touch', 'quanto' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
            'button_icon',
            [
                'label'        => __( 'Need Icon?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'job_list',
            [
                'label' => __('Team Lists', 'optech'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                

            ]
        );
		$this->end_controls_section();

        // Box Style
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'box_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .career-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box_border_color',
            [
                'label' => __( 'Border Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box' => 'border-color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box .career-left .job-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .career-box .career-left .job-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .career-box .career-left .job-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Address Style
        $this->start_controls_section(
            'address_style',
            [
                'label' => __( 'Address', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'address_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'address_typography',
                'selector' => '{{WRAPPER}} .career-box p',
            ]
        );
		$this->end_controls_section();

        // Date Style
        $this->start_controls_section(
            'date_style',
            [
                'label' => __( 'Date', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'date_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box .career-center .apply-dateline' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .career-box .career-center .apply-dateline',
            ]
        );
        $this->add_responsive_control(
            'date_margin',
            [
                'label' => __( 'margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .career-box .career-center .apply-dateline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Roles Text Style
        $this->start_controls_section(
            'roles_text_style',
            [
                'label' => __( 'Roles Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'roles_text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'roles_text_typography',
                'selector' => '{{WRAPPER}} .career-box p',
            ]
        );
		$this->end_controls_section();

        // Roles Number Style
        $this->start_controls_section(
            'roles_number_style',
            [
                'label' => __( 'Roles Number', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'roles_number_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .career-box .career-center .job-role span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'roles_number_typography',
                'selector' => '{{WRAPPER}} .career-box .career-center .job-role span',
            ]
        );
		$this->end_controls_section();

        // Button Text Style
        $this->start_controls_section(
            'button_text_style',
            [
                'label' => __( 'Button Text', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'button_text_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_text_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_text_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'button_text_hover_bg_color',
            [
                'label' => __( 'Hover Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_text_typography',
                'selector' => '{{WRAPPER}} .quanto-link-btn',
            ]
        );
		$this->add_responsive_control(
            'button_text_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_text_border',
                'selector' => '{{WRAPPER}} .quanto-link-btn.btn-pill',
            ]
        );
		$this->add_responsive_control(
			'button_text_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .quanto-link-btn.btn-pill' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'quanto' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-link-btn' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill span .arry1' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'icon_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quanto-link-btn.btn-pill span .arry2' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();

	}

    // Get All teams
    public function get_all_jobs() {

        $wp_query = get_posts([
            'post_type' => 'quanto_job',
            'orderby' => 'date',
            'posts_per_page' => -1,
        ]);

        $options = ['none' => 'None'];
        foreach ($wp_query as $teams) {
            $options[$teams->ID] = $teams->post_title;
        }

        return $options;
        
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        $job_list = $settings['job_list'];
		
		?>
            <?php  foreach( $job_list as $item ):
                $args = new \WP_Query(array(
                    'post_type' => 'quanto_job',
                    'post_status' => 'publish',
                    'post__in' => [
                        $item['select_post']
                    ]
                ));
            ?>
                <?php while ($args->have_posts()) : $args->the_post(); ?>
                    <div class="career-box fade-anim">
                        <div class="career-left">
                            <h5 class="job-title"><?php the_title(); ?></h5>
                            <p class="job-location"><?php echo esc_html($item['address_text']); ?></p>
                        </div>
                        <div class="career-center">
                            <h5 class="apply-dateline">
                                <?php echo get_the_time('j F, Y'); ?>
                            </h5>
                            <p class="job-role">
                                <?php echo esc_html($item['roles_text']); ?>
                                <span>
                                    <?php echo esc_html($item['employee_need']); ?>
                                </span>
                            </p>
                        </div>
                        <div class="career-right">
                            <a class="quanto-link-btn btn-pill" href="<?php the_permalink(); ?>">
                                <?php echo esc_html( $item['button_text'] ) ?>
                                <?php if ( 'yes' == $item['button_icon'] ): ?>
                                    <span>
                                        <i class="fa-solid fa-arrow-right arry1"></i>
                                        <i class="fa-solid fa-arrow-right arry2"></i>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endforeach; ?>
		<?php
	}
}
$widgets_manager->register( new \Quanto_Career() );