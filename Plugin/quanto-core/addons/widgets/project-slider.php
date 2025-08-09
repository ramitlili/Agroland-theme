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
 * Project Slider Widget .
 *
 */
class Agroland_Project_Slider extends Widget_Base {

	public function get_name() {
		return 'agroland_project_slider';
	}
     
	public function get_title() {
		return __( 'Project Slider', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'project_slider_section',
			[
				'label' 	=> __( 'Project Slider', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'project_layout',
			[
				'label' => __( 'Style', 'quanto' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Style 1', 'quanto' ),
					'layout-2' => __( 'Style 2', 'quanto' ),
				],
			]
		);
        $this->add_control(
            'post_per_page',
            [
                'label'       => __('Numbar Of Posts', 'quanto'),
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
        $options = $this->get_all_projects();
        unset($options['none']); // Remove 'None' from selectable options
        $this->add_control(
            'post__in',
            [
                'label' => __('Post In', 'quanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => $options,
                'multiple' => true,
                'label_block' => true,
                'condition'   => [
                    'post_by' => 'selected',
                ]
            ]
        );
        $this->add_control(
            'project_category',
            [
                'label' => __('Filter by Category', 'quanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_project_categories(),
                'multiple' => true,
                'label_block' => true,
                'description' => __('Select a category to filter projects.', 'quanto'),
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
        $this->add_control(
            'show_date',
            [
                'label'        => __( 'Show Date?', 'quanto' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'quanto' ),
                'label_off'    => __( 'No', 'quanto' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->end_controls_section();

        // Box Style
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'project_layout' => 'layout-1',
				]
            ]
        );
        $this->add_responsive_control(
			'item_gap',
			[
				'label'     => esc_html__( 'Item Gap', 'quanto' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .project-horizontal-scrolling' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', 'quanto' ),
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
						'max' => 250,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-project-thumb img' => 'width: {{SIZE}}{{UNIT}} !important;',
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
						'max' => 250,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-project-thumb img' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Content', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .agroland-project-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-project-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .agroland-project-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .agroland-project-content h5' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .agroland-project-content h5',
            ]
        );
		$this->end_controls_section();

        // meta Style
        $this->start_controls_section(
            'meta_style',
            [
                'label' => __( 'Date & Category', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-project-content .agroland-project-date' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .agroland-project-content .agroland-project-date',
            ]
        );
        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .agroland-project-content .agroland-project-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();

        // Arrow Style
        $this->start_controls_section(
            'arrow_style',
            [
                'label' => __( 'Arrow', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
					'project_layout' => 'layout-2',
				]
            ]
        );
        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __( 'Background Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'arrow_size',
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
					'{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'arrow_width',
			[
				'label' => esc_html__( 'Width', 'quanto' ),
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
					'{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'arrow_height',
			[
				'label' => esc_html__( 'Height', 'quanto' ),
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
					'{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'arrow_padding',
            [
                'label' => __( 'Padding', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn',
            ]
        );
		$this->add_responsive_control(
			'arrow_border_radius',
			[
				'label'         => __( 'Border Radius', 'quanto' ),
				'type'          => Controls_Manager::DIMENSIONS,
				'size_units'    => [ 'px', '%', 'em' ],
				'selectors'     => [
					'{{WRAPPER}} .agroland-project__slider-navigation .next-btn, .agroland-project__slider-navigation .prev-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );
		$this->end_controls_section();

	}

    // Get All Projects
    public function get_all_projects()
    {

        $wp_query = get_posts([
            'post_type' => 'agroland_project',
            'orderby' => 'date',
            'posts_per_page' => -1,
        ]);

        $options = ['none' => 'None'];
        foreach ($wp_query as $projects) {
            $options[$projects->ID] = $projects->post_name;
        }

        return $options;
    }

    // Get Project Category
    private function get_project_categories() {
        $categories = get_terms([
            'taxonomy'   => 'project_category',
            'hide_empty' => true,
        ]);
    
        $options = ['' => __('All Categories', 'quanto')];
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->slug] = $category->name;
            }
        }
        return $options;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
		$project = $settings[ 'project_layout' ];
		
		?>
            <?php 	
				if ($project) {
					include('project-slider/'.$project.'.php');
				}
			?>
		<?php
	}
}
$widgets_manager->register( new \Agroland_Project_Slider() );