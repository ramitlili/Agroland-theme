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
 * List Icon Widget .
 *
 */
class Quanto_List_Icon extends Widget_Base {

	public function get_name() {
		return 'quanto_list_icon';
	}
     
	public function get_title() {
		return __( 'List Icon', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';    
    }

	public function get_categories() {
		return [ 'quanto' ];
	}

	protected function register_controls() {

		
		$this->start_controls_section(
			'list_text_section',
			[
				'label' 	=> __( 'Text', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_responsive_control(
            'enable_flex',
            [
                'label' => __( 'Enable Flex', 'quanto' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'On', 'quanto' ),
                'label_off' => __( 'Off', 'quanto' ),
                'return_value' => 'yes',
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .footer-widgets .widget-links ul' => 'display: flex;',
                ],
            ]
        );       
		$repeater = new Repeater();

        $repeater->add_control(
			'list_text',
			[
				'label' 		=> __( 'Text', 'quanto' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Let’s work together', 'quanto' ),
				'label_block'   => true,
			]
		);
        $repeater->add_control(
			'text_url',
			[
				'label' 		=> __( 'Url', 'quanto' ),
				'type' 			=> Controls_Manager::URL,
			]
		);
        $this->add_control(
			'text_list',
			[
				'label' => __( 'Icons', 'quanto' ),
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
                    '{{WRAPPER}} .widget-links ul li a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => __( 'Hover Color', 'quanto' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .widget-links ul li a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .footer-widgets .widget-links ul li a:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .widget-links ul li a',
            ]
        );
        $this->add_responsive_control(
            'text_gap',
            [
                'label' => __( 'Gap', 'quanto' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .footer-widgets .widget-links ul li:not(:first-of-type)' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_flex' => '', // Show this control when the switcher is OFF
                ],
            ]
        );        
        $this->add_responsive_control(
            'text_gap_lr',
            [
                'label' => __( 'Gap', 'quanto' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [ 'min' => 0, 'max' => 100 ],
                    'em' => [ 'min' => 0, 'max' => 10 ],
                    '%' => [ 'min' => 0, 'max' => 100 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .footer-widgets .widget-links ul li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_flex' => 'yes', // Show this control when the switcher is OFF
                ],
            ]
        );        
		$this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();
		
		?>
            <div class="footer-widgets">
                <div class="widget-links">
                    <ul class="custom-ul">
                        <?php foreach ($settings['text_list'] as $list_item) : ?>
                            <li>
                                <a href="<?php echo esc_url($list_item['text_url']['url']); ?>">
                                    <?php echo esc_html($list_item['list_text']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
		<?php
	}
}
$widgets_manager->register( new \Quanto_List_Icon() );