<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Repeater;

class Quanto_Process extends Widget_Base {

    public function get_name() {
        return 'quanto_process';
    }

    public function get_title() {
        return __( 'Quanto Process', 'quanto' );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'quanto' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'process_section',
            [
                'label' => __( 'Content', 'quanto' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'number',
            [
                'label'   => esc_html__( 'Number', 'quanto' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( '.01', 'quanto' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'   => esc_html__( 'Title', 'quanto' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Send Email', 'quanto' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'   => esc_html__( 'Description', 'quanto' ),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Listen stories of user understand points and give a estimate about cost and time-frame.', 'quanto' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'process_list',
            [
                'label'   => __( 'Process List', 'quanto' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'number'      => esc_html__( '.01', 'quanto' ),
                        'title'       => esc_html__( 'Send Email', 'quanto' ),
                        'description' => esc_html__( 'Listen stories of user understand points and give a estimate about cost and time-frame.', 'quanto' ),
                    ],
                    [
                        'number'      => esc_html__( '.02', 'quanto' ),
                        'title'       => esc_html__( 'Meet Online', 'quanto' ),
                        'description' => esc_html__( 'Listen stories of user understand points and give a estimate about cost and time-frame.', 'quanto' ),
                    ],
                    [
                        'number'      => esc_html__( '.03', 'quanto' ),
                        'title'       => esc_html__( 'Price Estimation', 'quanto' ),
                        'description' => esc_html__( 'Listen stories of user understand points and give a estimate about cost and time-frame.', 'quanto' ),
                    ],
                    [
                        'number'      => esc_html__( '.04', 'quanto' ),
                        'title'       => esc_html__( 'Work Together', 'quanto' ),
                        'description' => esc_html__( 'Listen stories of user understand points and give a estimate about cost and time-frame.', 'quanto' ),
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Number Style
        $this->start_controls_section(
            'number_style',
            [
                'label' => __( 'Number', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .process-number',
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
                    '{{WRAPPER}} .process-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .process-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( 'Margin', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .process-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'description_style',
            [
                'label' => __( 'Description', 'quanto' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .process-description',
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
        $this->start_controls_tabs('box_style_tabs');
        // Normal Tab
        $this->start_controls_tab(
            'box_style_normal',
            [
                'label' => __( 'Normal', 'quanto' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_background',
                'selector' => '{{WRAPPER}} .process-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .process-box',
            ]
        );
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __( 'Border Radius', 'quanto' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .process-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .process-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // Hover Tab
        $this->start_controls_tab(
            'box_style_hover',
            [
                'label' => __( 'Hover', 'quanto' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'box_background_hover',
                'selector' => '{{WRAPPER}} .process-box:hover .hover-overlay',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border_hover',
                'selector' => '{{WRAPPER}} .process-box:hover',
            ]
        );
        $this->add_control(
            'box_hover_text_color',
            [
                'label' => __( 'Hover Text Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .process-box:hover .process-title, 
                    {{WRAPPER}} .process-box:hover .process-number, 
                    {{WRAPPER}} .process-box:hover p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['process_list'])) {
            return;
        }
        ?>
        
        <div class="process-box-wrapper horizontal-scroll">
            <?php foreach ($settings['process_list'] as $process) : ?>
                <div class="process-box scroll-item">
                    <?php if (!empty($process['number'])) : ?>
                        <span class="process-number text-color-white">
                            <?php echo esc_html($process['number']); ?>
                        </span>
                    <?php endif; ?>
        
                    <div class="process-info">
                        <?php if (!empty($process['title'])) : ?>
                            <h5 class="process-title text-color-white"><?php echo esc_html($process['title']); ?></h5>
                        <?php endif; ?>
        
                        <?php if (!empty($process['description'])) : ?>
                            <p class="process-description text-color-white"><?php echo esc_html($process['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        

        <?php
    }
}

$widgets_manager->register( new \Quanto_Process() );
