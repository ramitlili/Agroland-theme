<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Mobilemenu Widget .
 *
 */
class Agroland_Menu extends Widget_Base {

	public function get_name() {
		return 'quantomenu';
	}

	public function get_title() {
		return __( 'Header Menu', 'quanto' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'agroland_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'mobile_menu_section',
			[
				'label' 	=> __( 'Header Menu', 'quanto' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'logo_type',
			[
				'label' => __( 'Logo Type', 'quanto' ),
				'type'  => Controls_Manager::SELECT,
				'default' => 'dark',
				'options' => [
					'dark'   => __( 'Dark', 'quanto' ),
					'white'  => __( 'White', 'quanto' ),
					'custom' => __( 'Custom', 'quanto' ),
				],
			]
        );
		$this->add_control(
            'image',
            [
                'label' => __('Choose logo', 'quanto'),
                'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'logo_size', 
                'include' => [],
                'default' => 'large',
                'condition' => [
                    'logo_type' => 'custom',
                ]
            ]
        );
		$this->add_control(
			'menu_bg_color',
			[
				'label' 		=> __( 'Menu Background Color', 'quanto' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .vs-menu-toggle' => 'background-color: {{VALUE}}',
                ],
			]
        );
		$this->add_control(
			'mibile_menu_align',
			[
				'label' 	=> __( 'Menu Alignment', 'quanto' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'left' 		=> [
						'title' 	=> __( 'Left', 'quanto' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', 'quanto' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', 'quanto' ),
						'icon' 		=> 'fa fa-align-right',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .vs-menu-toggle-wraper' => 'text-align: {{VALUE}} !important;',
				],
				'toggle' 		=> true,
			]
		);

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

		
		if( has_nav_menu( 'primary-menu' ) ){
            ?>
				<nav class="main-menu menu-style1">
					<?php
						wp_nav_menu( array(
							"theme_location"    => 'primary-menu',
							"container"         => '',
							"menu_class"        => ''
						) );
					?>
				</nav>
			<?php 
		}

		?>
			<div class="mobile-logo">
				<a href="<?php echo home_url(); ?>">
					<?php
					if ( 'custom' == $settings['logo_type'] && $settings['image']['url']) {
						echo Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');
					} else {
						echo $this->agroland_get_site_logo( $settings['logo_type'] );
					}
					?>
				</a>
			</div>
		<?php
		
	}

	/**
     * 
     *  quanto get logo  
     * 
     */
    public function agroland_get_site_logo( $logo_type = 'dark'  ) {
        $logo = '';
        $quanto = get_option('agroland_opt');
        $logo_url = '';
        if ( 'dark' ==  $logo_type && isset( $quanto['dark_logo']['url'] ) ) {
            $logo_url = esc_url($quanto['dark_logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';

        } else if ( 'white' ==  $logo_type && isset($quanto['white_logo']['url'])) {
            $logo_url = esc_url($quanto['white_logo']['url']);
            $logo = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';
        } else {
            if ( has_custom_logo() ) {
                $core_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_src($core_logo_id, 'full');
                $logo = '<img src="' . esc_url($logo_url[0]) . '" alt="' . esc_attr(get_bloginfo('title')) . '">';
            } else {
                $logo = '<h3>' . get_bloginfo('name') . '</h3>';
            }
        }
        return $logo;
    }
}
$widgets_manager->register( new \Agroland_Menu() );