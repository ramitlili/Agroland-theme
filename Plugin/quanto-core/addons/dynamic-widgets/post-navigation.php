<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Post_Navigation extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'agroland-post-navigation';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Post Navigation', 'quanto');
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-code';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['quanto'];
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        /**
         * Content tab
         */
        $this->start_controls_section(
            'post_navigation',
            [
                'label' => __('Post Navigation', 'quanto'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'prev_text',
            [
                'label' => __('Prev Text', 'quanto'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Previous Project', 'quanto'),
            ]
        );
        $this->add_control(
            'next_text',
            [
                'label' => __('Next Text', 'quanto'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Next Project', 'quanto'),
            ]
        );
        $this->add_control(
			'prev_icon',
			[
				'label' => __( 'Prev Icon', 'quanto' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'solid',
				],
			]
        );
        $this->add_control(
			'next_icon',
			[
				'label' => __( 'Next Icon', 'quanto' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
			]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __('Style', 'quanto'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typo',
                'label' => __('Prev Next Text Typography', 'quanto'),
                'selector' => '{{WRAPPER}} .agroland-post-data p',
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label' => __('Prev Next Text Color', 'quanto'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-post-data p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => __( ' Margin', 'quanto' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .agroland-post-data p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_control(
            'nav_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-post-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'quanto'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-post-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_background_color',
            [
                'label' => __('Icon Background Color', 'quanto'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-post-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __('Border', 'quanto'),
                'selector' => '{{WRAPPER}} .agroland-post-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'quanto'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                   
                    '{{WRAPPER}} .agroland-post-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'icon_gap',
			[
				'label' => __( 'Icon gap', 'quanto' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .agroland-post-navigation2 .p-nav-previous' => 'gap: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .agroland-post-navigation2 .p-nav-next' => 'gap: {{SIZE}}{{UNIT}}',
					
				],
			]
		);
        $this->add_control(
            'nav_style_divider2',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'project_title_typo',
                'label' => __('Project Titlet Typography', 'quanto'),
                'selector' => '{{WRAPPER}} .agroland-post-data h5',
            ]
        );
        $this->add_control(
            'project_title_color',
            [
                'label' => __('Project Title Color', 'quanto'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-post-data h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'project_title_margin',
            [
                'label'      => __( 'Title Margin', 'quanto' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .agroland-post-data h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        

        $settings = $this->get_settings_for_display();
        ob_start();
        \Elementor\Icons_Manager::render_icon($settings['prev_icon'], ['aria-hidden' => 'true']);
        $prev_icon = ob_get_clean();
        
        ob_start();
        \Elementor\Icons_Manager::render_icon($settings['next_icon'], ['aria-hidden' => 'true']);
        $next_icon = ob_get_clean();
        
        the_post_navigation(array(
            'prev_text' => '<a class="p-nav-previous" href="' . get_permalink(get_previous_post()) . '">
                <div class="agroland-post-icon">' . $prev_icon . '</div>
                <div class="agroland-post-data">
                    <p>' . esc_html($settings['prev_text']) . '</p>
                    <h5>%title</h5>
                </div>
            </a>',
            'next_text' => '<a class="p-nav-next" href="' . get_permalink(get_next_post()) . '">
                    <div class="agroland-post-data">
                        <p>' . esc_html($settings['next_text']) . '</p>
                        <h5>%title</h5>
                    </div>
                    <div class="agroland-post-icon">' . $next_icon . '</div>
                </a>',
            'in_same_term' => false,
            'class' => 'agroland-post-navigation2'
        ));
    }
}


$widgets_manager->register( new \Post_Navigation() );