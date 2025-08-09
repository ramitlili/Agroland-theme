<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
/**
 *
 * Button Widget .
 *
 */
class Agroland_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'agroland_blog_post';
	}

	public function get_title() {
		return __( 'Blog Post', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto' ];
	}


	protected function register_controls() {

		$this->start_controls_section(
			'blog_settings',
			[
				'label' 	=> __( 'Blog Settings', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'blog_layout',
			[
				'label' => __( 'Layout', 'quanto' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one' => __( 'Style 1', 'quanto' ),
					'style-two' => __( 'Style 2', 'quanto' ),
				],
			]
		);
		$this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'quanto'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '3',
            'tablet_default'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);
		$this->add_control(
            'blog_per_page',
            [
                'label'       => __('Numbar Of Post', 'quanto'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'use empty value show all posts',
            ]
        );
		$this->add_control(
            'post_by',
            [
                'label' => __('Post By:', 'quanto'),
                'type' => Controls_Manager::SELECT,
                'default' => 'latest',
                'label_block' => true,
                'options' => array(
                    'latest'   =>   __('Latest Post', 'quanto'),
                    'selected' =>   __('Selected posts', 'quanto'),
                ),
            ]
        );
        $this->add_control(
            'post__in',
            [
                'label' => __('Post In', 'quanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => agroland_get_all_posts('post'),
                'multiple' => true,
                'label_block' => true,
                'condition'   => [
					'post_by' => 'selected',
				]
            ]
        );
        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'quanto'),
                'type' => Controls_Manager::SELECT,
                'options' => agroland_get_post_orderby_options(),
                'default' => 'date',
                'label_block' => true,

            ]
        );
        $this->add_control(
            'order',
            [
                'label' => __('Order', 'quanto'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',
                'label_block' => true,

            ]
        );
        $this->end_controls_section();

		// Blog Content
		$this->start_controls_section(
			'blog_content',
			[
				'label' 	=> __( 'Blog Content', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		$this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', '' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Read More', 'quanto' ),
				'condition'   => [
					'blog_layout' => 'style-two',
				]
			]
        );
		$this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'quanto' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'quanto' ),
                'label_off' => __( 'Hide', 'quanto' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();

		// Image Style
        $this->start_controls_section(
			'img_style',
			[
				'label' 	=> __( 'Image', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'img_height',
			[
				'label' 		=> __( 'Height', 'quanto' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' 		=> [
					'px' 			=> [
						'min' 			=> 0,
						'max' 			=> 1000,
						'step'			=> 1,
					],
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
						'step'			=> 1,
					],
				],
				'selectors'     => [
					'{{WRAPPER}} .agroland-blog-box .agroland-blog-thumb img' => 'height: {{SIZE}}{{UNIT}};',
                ],

			]
		);
        $this->end_controls_section();

		// Box Style
        $this->start_controls_section(
			'box_style',
			[
				'label' 	=> __( 'Box', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'box_bg_color',
			[
				'label' 		=> __( 'Box bg Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_responsive_control(
			'box_padding',
			[
				'label' 		=> __( 'Padding', 'quanto' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label'       => __( 'Margin', 'quanto' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px', '%', 'em' ],
				'selectors'   => [
					'{{WRAPPER}} .agroland-blog-box'   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .agroland-blog2__row' => 'margin: calc(-1 * {{TOP}}{{UNIT}}) calc(-1 * {{RIGHT}}{{UNIT}}) calc(-1 * {{BOTTOM}}{{UNIT}}) calc(-1 * {{LEFT}}{{UNIT}}) !important;',
					'{{WRAPPER}} .blog-style-one-row' => 'margin: calc(-1 * {{TOP}}{{UNIT}}) calc(-1 * {{RIGHT}}{{UNIT}}) calc(-1 * {{BOTTOM}}{{UNIT}}) calc(-1 * {{LEFT}}{{UNIT}}) !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'box_border',
				'label' 	=> __( 'Border', 'quanto' ),
                'selector' 	=> '{{WRAPPER}} .agroland-blog-box',
			]
		);
		$this->add_responsive_control(
			'box_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'quanto' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
        $this->end_controls_section();

		// Meta Style
        $this->start_controls_section(
			'meta_style',
			[
				'label' 	=> __( 'Meta', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'meta_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-content a.blog-meta' => 'color: {{VALUE}}',
                ]
			]
        );
		$this->add_control(
			'meta_hover_color',
			[
				'label' 		=> __( 'Hover Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-content a.blog-meta:hover' => 'color: {{VALUE}}',
                ]
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __('Typography', 'quanto'),
				'selector' => '{{WRAPPER}} .agroland-blog-content a.blog-meta',
			]
		);
        $this->end_controls_section();

		// Title Style
        $this->start_controls_section(
			'title_style',
			[
				'label' 	=> __( 'Title', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box .agroland-blog-content h5' => 'color: {{VALUE}}',
                ]
			]
        );
		$this->add_control(
			'title_hover_color',
			[
				'label' 		=> __( 'Hover Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box .agroland-blog-content h5:hover' => 'color: {{VALUE}}',
                ]
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'quanto'),
				'selector' => '{{WRAPPER}} .agroland-blog-box .agroland-blog-content h5',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'quanto' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}}  .agroland-blog-box .agroland-blog-content h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
        $this->end_controls_section();

		// Button Style
        $this->start_controls_section(
			'btn_style',
			[
				'label' 	=> __( 'Button', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition' => [
                    'blog_layout' => 'style-two',
                    ],
			]
        );
		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box.style-2 .agroland-blog-content .agroland-link-btn' => 'color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .agroland-blog-box.style-2 .agroland-blog-content .agroland-link-btn span i' => 'color: {{VALUE}}',
                ]
			]
        );
        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .agroland-blog-box.style-2 .agroland-blog-content .agroland-link-btn:hover' => 'color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .agroland-blog-box.style-2 .agroland-blog-content .agroland-link-btn:hover span i' => 'color: {{VALUE}}',
                ]
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Typography', 'quanto' ),
                'selector' 	=> '{{WRAPPER}} .agroland-blog-box.style-2 .agroland-blog-content .agroland-link-btn',
			]
        );
        $this->end_controls_section();

		// Pagination Style
        $this->start_controls_section(
            'pagination_style',
            [
                'label' => __( 'Pagination', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'pagination_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'pagination_hover_color',
            [
                'label' => __( 'Hover & Active Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:hover, .blog-pagination .pagination .page-item .page-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'pagination_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:not(.next):not(.prev)' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'pagination_bg_hover_color',
            [
                'label' => __( 'Background Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:hover:not(.next):not(.prev), .blog-pagination .pagination .page-item .page-link.active:not(.next):not(.prev)' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'selector' => '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link',
            ]
        );
        $this->add_responsive_control(
			'pagination_width',
			[
				'label' => __( 'Size', 'quanto' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:not(.next):not(.prev)' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'selector' => '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:not(.next):not(.prev)',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_hover_border',
                'selector' => '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:hover:not(.next):not(.prev), .blog-pagination .pagination .page-item .page-link.active:not(.next):not(.prev)',
            ]
        );
        $this->add_control(
            'pagination_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .pagination .page-item .page-link:not(.next):not(.prev)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		$grid_classes = [];
		$grid_classes[] = 'col-xl-' . $settings['per_line'];
		$grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
		$grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
		$grid_classes = implode(' ', $grid_classes);
		$this->add_render_attribute('blog_gride_classes', 'class', [$grid_classes]);


        ?>

		<?php
		// Query
		$numabr_of_post = !empty($settings['blog_per_page']) ? $settings['blog_per_page'] : -1;

		$paged = get_query_var('paged') ? get_query_var('paged') : 1;

		$query_args = [
			'post_type'           => 'post',
			'orderby' => $settings['orderby'],
			'order'   => $settings['order'],
			'posts_per_page'      => $numabr_of_post,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'paged' => $paged,
		];

		// get_type
		if ( 'selected' === $settings['post_by'] ) {
			$query_args['post__in'] = (array)$settings['post__in'];
		}

		$the_query = new \WP_Query($query_args);

        $blog_style = $settings['blog_layout'];

		?>
			<?php
                if ($blog_style) {
                    include('blog/'.$blog_style.'.php');
                }
            ?>

		<?php

	}

}
$widgets_manager->register( new \Agroland_Blog_Post() );