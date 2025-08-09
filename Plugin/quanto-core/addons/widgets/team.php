<?php

if (!defined('ABSPATH')) {
    exit;
}

class Quanto_Team_Member extends \Elementor\Widget_Base {

	public function get_name() {
		return 'quanto_team_member';
	}

	public function get_title() {
		return esc_html__( 'Quanto Team', 'optech' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'quanto' ];
	}

	public function get_keywords() {
		return [ 'team', 'normal', ' slider' ];
	}

    protected function register_controls() {

        $this->start_controls_section(
            'team_settings',
            [
                'label' => __('Team Settings', 'optech'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_responsive_control(
            'per_line',
             [
            'label'              => __('Columns per row', 'optech'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '3',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true
        ]);
        $this->end_controls_section();



        // Start team Section
        $this->start_controls_section(
			'team_section',
			[
				'label' => esc_html__( 'Team Section', 'optech' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'options' => $this->get_all_members(),
            ]
        );
        $repeater->add_control(
			'designation_text',
			[
				'label' => esc_html__( 'Designation', 'optech' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
				'default' => esc_html__( 'CEO & Founder', 'optech' ),
			]
		);
        $repeater->start_controls_tabs(
            'social_icons_tabs'
        );
        $repeater->start_controls_tab(
            'social_icons_tab',
            [
                'label' => __('Icons', 'optech'),
            ]
        );
        $repeater->add_control(
			'social_icon_one',
			[
				'label'       => __( 'Icon 01', 'optech' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'social_icon_two',
			[
				'label'       => __( 'Icon 02', 'optech' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'social_icon_three',
			[
				'label'       => __( 'Icon 03', 'optech' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->add_control(
			'social_icon_four',
			[
				'label'       => __( 'Icon 04', 'optech' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'label_block' => true,
			]
		);
        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'social_linkss_tab',
            [
                'label' => __('URLs', 'optech'),
            ]
        );
        $repeater->add_control(
			'icon_url_one',
			[
				'label' => __('URL 01', 'optech'),
				'type' =>  \Elementor\Controls_Manager::URL,
			]
		);
        $repeater->add_control(
			'icon_url_two',
			[
				'label' => __('URL 02', 'optech'),
				'type' =>  \Elementor\Controls_Manager::URL,
			]
		);
        $repeater->add_control(
			'icon_url_three',
			[
				'label' => __('URL 03', 'optech'),
				'type' =>  \Elementor\Controls_Manager::URL,
			]
		);
        $repeater->add_control(
			'icon_url_four',
			[
				'label' => __('URL 04', 'optech'),
				'type' =>  \Elementor\Controls_Manager::URL,
			]
		);
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();


        // Add control for data-delay
        $repeater->add_control(
            'item_delay',
            [
                'label' => __('Item Delay', 'optech'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0.30', // Set default delay value
                'description' => __('Set the delay time in seconds', 'optech'),
            ]
        );
        // Add control for data-direction
        $repeater->add_control(
            'item_direction',
            [
                'label' => __('Item Direction', 'optech'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'right' => __('Right', 'optech'),
                    'left' => __('Left', 'optech'),
                    'up' => __('Up', 'optech'),
                    'down' => __('Down', 'optech'),
                ],
                'default' => 'right', // Set default direction
                'description' => __('Select the direction for the animation', 'optech'),
            ]
        );
        $this->add_control(
            'team_lists',
            [
                'label' => __('Team Lists', 'optech'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                

            ]
        );
		$this->end_controls_section();

        

        // start Title style
        $this->start_controls_section(
            'team_title_style',
            [
                    'label' => __('Title', 'optech'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
                'title_style_normal_tab',
                [
                        'label' => __('Normal', 'optech'),
                ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .quanto-team-box .team-content  h6.team-member-name',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'optech' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content  h6.team-member-name' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content  h6.team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content  h6.team-member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                    'label' => __('Hover', 'optech'),
            ]
        );
        $this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Color', 'optech' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content  h6.team-member-name:hover a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();

        // start Image style
        $this->start_controls_section(
            'team_image_style',
            [
                    'label' => __('Image', 'optech'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'image_size',
			[
				'label' => esc_html__( 'Size', 'optech' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-thumb img:first-child' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .quanto-team-box .team-thumb img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_tab();
        $this->end_controls_section();
        // start Text style
        $this->start_controls_section(
            'team_designation_style',
            [
                    'label' => __('Designation', 'optech'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'selector' => '{{WRAPPER}} .quanto-team-box .team-content .team-member-position',
			]
		);
		$this->add_control(
			'designation_color',
			[
				'label' => esc_html__( 'Color', 'optech' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content .team-member-position' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_responsive_control(
			'designation_margin',
			[
				'label' => esc_html__( 'Margin', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content .team-member-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

        // start content box style
        $this->start_controls_section(
            'team_content_box_style',
            [
                    'label' => __('Content Box', 'optech'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
			'content_box_bg_color',
			[
					'label'     => __('Background Color', 'optech'),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
							'{{WRAPPER}} .quanto-team-box' => 'background-color: {{VALUE}}',
					],
			]
		);
        $this->add_responsive_control(
			'content_box_padding',
			[
				'label' => esc_html__( 'Padding', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();

        // start box style
        $this->start_controls_section(
            'team_box_style',
            [
                    'label' => __('Box', 'optech'),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'box_bg_color',
			[
					'label'     => __('Background Color', 'optech'),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
							'{{WRAPPER}} .quanto-team-box .team-content' => 'background-color: {{VALUE}}',
					],
			]
		);
        $this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__( 'Margin', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'label' => esc_html__( 'Box Shadow', 'optech' ),
				'selector' => '{{WRAPPER}} .quanto-team-box .team-content',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' 		=> 'team_box_border',
				'label' 	=> __( 'Border', 'optech' ),
                'selector' 	=> '{{WRAPPER}} .quanto-team-box .team-content',
			]
		);
        $this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Border Radius', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();

        // icon Style
        $this->start_controls_section(
			'icon_style_section',
			[
				'label' 	=> __( 'Icon', 'optech' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Icon Color', 'optech' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'icon_color_hover',
			[
				'label' 		=> __( 'Icon Color Hover', 'optech' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a:hover' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'icon_bg_color',
			[
				'label' 		=> __( 'Background Color', 'optech' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a' => 'background-color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'icon_bg_color_hover',
			[
				'label' 		=> __( 'Background Hover Color', 'optech' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a:hover' => 'background-color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'optech' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'icon_box_size',
			[
				'label' => esc_html__( 'Box Size', 'optech' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 30,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'iconbox_radius',
			[
				'label' => esc_html__( 'Border Radius', 'optech' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .quanto-team-box .team-thumb ul li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
		$this->end_controls_section();
        


	}

    // Get All teams
    public function get_all_members() {

        $wp_query = get_posts([
            'post_type' => 'quanto_team',
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
        

            $this->add_render_attribute('team_version', 'class', ['row g-4 g-sm-3 g-md-4']);
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('team_gride_classes', 'class', [$grid_classes]);
            
            //$anim = "onview: -100; targets: > *; translateY: [48, 0]; opacity: [0, 1]; easing: spring(1, 80, 10, 0); duration: 450; delay: anime.stagger(100, {start: 200});";


        $team_lists = $settings['team_lists'];?>  

        <div <?php echo $this->get_render_attribute_string('team_version'); ?>>
            <?php  foreach( $team_lists as $item ):
                $args = new \WP_Query(array(
                    'post_type' => 'quanto_team',
                    'post_status' => 'publish',
                    'post__in' => [
                        $item['select_post']
                    ]
                ));
            ?>
            <?php while ($args->have_posts()) : $args->the_post(); ?>
            <div <?php echo $this->get_render_attribute_string('team_gride_classes'); ?>>
                <div class="quanto-team-box fade-anim" data-delay="<?php echo esc_html( $item['item_delay'] ); ?>" data-direction="<?php echo esc_html( $item['item_direction'] ); ?>" >
                    <?php if( has_post_thumbnail() ): ?>
                    <figure class="team-thumb">  
                        <?php the_post_thumbnail('full');?>
                        <?php the_post_thumbnail('full');?>
                        <ul class="custom-ul">
                            <?php if ( ! empty( $item['social_icon_one']['value'] ) && ! empty( $item['icon_url_one']['url'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $item['icon_url_one']['url'] ); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon( $item['social_icon_one'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ( ! empty( $item['social_icon_two']['value'] ) && ! empty( $item['icon_url_two']['url'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $item['icon_url_two']['url'] ); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon( $item['social_icon_two'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ( ! empty( $item['social_icon_three']['value'] ) && ! empty( $item['icon_url_three']['url'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $item['icon_url_three']['url'] ); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon( $item['social_icon_three'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ( ! empty( $item['social_icon_four']['value'] ) && ! empty( $item['icon_url_four']['url'] ) ) : ?>
                                <li>
                                    <a href="<?php echo esc_url( $item['icon_url_four']['url'] ); ?>">
                                        <?php \Elementor\Icons_Manager::render_icon( $item['social_icon_four'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </figure>
                    <?php endif; ?>
                    <div class="team-content">
                        <h6 class="team-member-name">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h6>
                        <?php if ( ! empty( $item['designation_text'] )) : ?>
                        <span class="team-member-position"><?php echo esc_html($item['designation_text']); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            <?php endforeach; ?>
        </div>
        <?php
    }

}

$widgets_manager->register( new \Quanto_Team_Member() );