<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
/**
 *
 * Award Widget .
 *
 */
class Agroland_Award extends Widget_Base {

	public function get_name() {
		return 'agroland_award';
	}

	public function get_title() {
		return __( 'Quanto Award', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'award_section',
			[
				'label' 	=> __( 'Content', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			] 
        );

        $repeater = new Repeater();
        
        $repeater->add_control(
            'award_title',
            [
                'label'   => esc_html__( 'Award Title', 'quanto' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Winner - Best eCommerce Websites', 'quanto' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'award_year',
            [
                'label'   => esc_html__( 'Awards', 'quanto' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Awwwards ─ 2023', 'quanto' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'award_list',
            [
                'label'   => __( 'Award List', 'quanto' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'award_title' => esc_html__( 'Winner - Best eCommerce Websites', 'quanto' ),
                        'award_year'  => esc_html__( 'Awwwards ─ 2023', 'quanto' ),
                    ],
                    [
                        'award_title' => esc_html__( 'Awarded - Top Creative Agency in United State', 'quanto' ),
                        'award_year'  => esc_html__( 'Envato Elements ─ 2022', 'quanto' ),
                    ],
                    [
                        'award_title' => esc_html__( 'Mentioned - Honorable Mentioned', 'quanto' ),
                        'award_year'  => esc_html__( 'Design Community ─ 2022', 'quanto' ),
                    ],
                    [
                        'award_title' => esc_html__( 'Winner - Behance Portfolio Review', 'quanto' ),
                        'award_year'  => esc_html__( 'Behance ─ 2021', 'quanto' ),
                    ],
                    [
                        'award_title' => esc_html__( 'Winner - Featured App Design of the Week', 'quanto' ),
                        'award_year'  => esc_html__( 'UI/UX Global Award ─ 2019', 'quanto' ),
                    ],
                ],
                'title_field' => '{{{ award_year }}}',
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
                    '{{WRAPPER}} .awards-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .awards-title',
            ]
        );
        $this->end_controls_section();

        // Year Style
        $this->start_controls_section(
            'year_style',
            [
                'label' => __( 'Year', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'year_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .awards-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'year_typography',
                'selector' => '{{WRAPPER}} .awards-info',
            ]
        );
        $this->add_responsive_control(
            'year_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .awards-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .agroland-awards-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'box_bg_hover_color',
            [
                'label' => __( 'HoverBackground Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-awards-box::before' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .agroland-awards-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .agroland-awards-box',
            ]
        );
        $this->add_control(
            'box_hover_border_color',
            [
                'label' => __( 'Hover Border Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .agroland-awards-box:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();



	}

	protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <?php foreach( $settings['award_list'] as $award_list ) : ?>
            <div class="agroland-awards-box fade-anim">
                <?php if ( !empty($award_list['award_title']) ) : ?>
                    <h6 class="awards-title"><?php echo esc_html( $award_list['award_title'] ); ?></h6>
                <?php endif; ?>

                <?php if ( !empty($award_list['award_year']) ) : ?>
                    <span class="awards-info"><?php echo esc_html( $award_list['award_year'] ); ?></span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

		<?php
	}
}
$widgets_manager->register( new \Agroland_Award() );