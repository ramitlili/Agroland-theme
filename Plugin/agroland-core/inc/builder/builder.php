<?php
    /**
     * Class For Builder
     */
    class QuantoBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'quanto_add_elementor_page_settings_controls' ],10,2 );

			// For Archive
			add_filter( 'template_include', [ $this, 'template_redirect_archive' ] );
			add_action( 'admin_init', [ $this, 'quanto_save_archive_settings' ] );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'quanto-core',QUANTO_PLUGDIRURI.'assets/js/quanto-core.js',array( 'jquery' ),'1.0',true );
		}


        public function quanto_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'quanto_header_option',
                [
                    'label'     => __( 'Header Option', 'quanto' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'quanto_header_style',
                [
                    'label'     => __( 'Header Option', 'quanto' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'quanto' ),
    					'header_builder'       => __( 'Header Builder', 'quanto' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'quanto_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'quanto' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->quanto_header_choose_option(),
                    'condition' => [ 'quanto_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'quanto_footer_option',
                [
                    'label'     => __( 'Footer Option', 'quanto' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'quanto_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'quanto' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'quanto' ),
    				'label_off'     => __( 'No', 'quanto' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'quanto_footer_style',
                [
                    'label'     => __( 'Footer Style', 'quanto' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'quanto' ),
    					'footer_builder'       => __( 'Footer Builder', 'quanto' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'quanto_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'quanto_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'quanto' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->quanto_footer_choose_option(),
                    'condition' => [ 'quanto_footer_style' => 'footer_builder','quanto_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );
			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Quanto Builder', 'quanto' ),
            	esc_html__( 'Quanto Builder', 'quanto' ),
				'manage_options',
				'quanto',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('quanto', esc_html__('Footer Builder', 'quanto'), esc_html__('Footer Builder', 'quanto'), 'manage_options', 'edit.php?post_type=quanto_footer');
			add_submenu_page('quanto', esc_html__('Header Builder', 'quanto'), esc_html__('Header Builder', 'quanto'), 'manage_options', 'edit.php?post_type=quanto_header');
			add_submenu_page('quanto', esc_html__('Tab Builder', 'quanto'), esc_html__('Tab Builder', 'quanto'), 'manage_options', 'edit.php?post_type=quanto_tab_build');
			add_submenu_page('quanto', esc_html__('OFF Canvas Builder', 'quanto'), esc_html__('OFF Canvas Builder', 'quanto'), 'manage_options', 'edit.php?post_type=quanto_off_build');

			// For Archive
			add_submenu_page('quanto', esc_html__('Archive Builder', 'quanto'), esc_html__('Archive Builder', 'quanto'), 'manage_options', 'edit.php?post_type=quanto_archive');
			add_submenu_page('quanto', esc_html__('Archive Settings', 'quanto'), esc_html__('Archive Settings', 'quanto'), 'manage_options', 'quanto-archive-settings', [$this, 'quanto_archive_settings_page_html']);
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','quanto' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'quanto' ),
				'singular_name'      => __( 'Footer', 'quanto' ),
				'menu_name'          => __( 'Quanto Footer Builder', 'quanto' ),
				'name_admin_bar'     => __( 'Footer', 'quanto' ),
				'add_new'            => __( 'Add New', 'quanto' ),
				'add_new_item'       => __( 'Add New Footer', 'quanto' ),
				'new_item'           => __( 'New Footer', 'quanto' ),
				'edit_item'          => __( 'Edit Footer', 'quanto' ),
				'view_item'          => __( 'View Footer', 'quanto' ),
				'all_items'          => __( 'All Footer', 'quanto' ),
				'search_items'       => __( 'Search Footer', 'quanto' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'quanto' ),
				'not_found'          => __( 'No Footer found.', 'quanto' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'quanto' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'quanto_footer', $args );

			$labels = array(
				'name'               => __( 'Header', 'quanto' ),
				'singular_name'      => __( 'Header', 'quanto' ),
				'menu_name'          => __( 'Quanto Header Builder', 'quanto' ),
				'name_admin_bar'     => __( 'Header', 'quanto' ),
				'add_new'            => __( 'Add New', 'quanto' ),
				'add_new_item'       => __( 'Add New Header', 'quanto' ),
				'new_item'           => __( 'New Header', 'quanto' ),
				'edit_item'          => __( 'Edit Header', 'quanto' ),
				'view_item'          => __( 'View Header', 'quanto' ),
				'all_items'          => __( 'All Header', 'quanto' ),
				'search_items'       => __( 'Search Header', 'quanto' ),
				'parent_item_colon'  => __( 'Parent Header:', 'quanto' ),
				'not_found'          => __( 'No Header found.', 'quanto' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'quanto' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'quanto_header', $args );

			// For Archive
			$labels = array(
				'name'               => __( 'Archive', 'quanto' ),
				'singular_name'      => __( 'Archive', 'quanto' ),
				'menu_name'          => __( 'Quanto Archive Builder', 'quanto' ),
				'name_admin_bar'     => __( 'Archive', 'quanto' ),
				'add_new'            => __( 'Add New', 'quanto' ),
				'add_new_item'       => __( 'Add New Archive', 'quanto' ),
				'new_item'           => __( 'New Archive', 'quanto' ),
				'edit_item'          => __( 'Edit Archive', 'quanto' ),
				'view_item'          => __( 'View Archive', 'quanto' ),
				'all_items'          => __( 'All Archives', 'quanto' ),
				'search_items'       => __( 'Search Archives', 'quanto' ),
				'parent_item_colon'  => __( 'Parent Archives:', 'quanto' ),
				'not_found'          => __( 'No Archive found.', 'quanto' ),
				'not_found_in_trash' => __( 'No Archive found in Trash.', 'quanto' ),
			);
			$args   = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);
			register_post_type( 'quanto_archive', $args );

            $labels = array(
				'name'               => __( 'Tab Builder', 'quanto' ),
				'singular_name'      => __( 'Tab Builder', 'quanto' ),
				'menu_name'          => __( 'Quanto Tab Builder', 'quanto' ),
				'name_admin_bar'     => __( 'Tab Builder', 'quanto' ),
				'add_new'            => __( 'Add New', 'quanto' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'quanto' ),
				'new_item'           => __( 'New Tab Builder', 'quanto' ),
				'edit_item'          => __( 'Edit Tab Builder', 'quanto' ),
				'view_item'          => __( 'View Tab Builder', 'quanto' ),
				'all_items'          => __( 'All Tab Builder', 'quanto' ),
				'search_items'       => __( 'Search Tab Builder', 'quanto' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'quanto' ),
				'not_found'          => __( 'No Tab Builder found.', 'quanto' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'quanto' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);
			register_post_type( 'quanto_tab_build', $args );

			//Off Canvas builder
            $labels = array(
				'name'               => __( 'Off Canvas Builder', 'quanto' ),
				'singular_name'      => __( 'Off Canvas Builder', 'quanto' ),
				'menu_name'          => __( 'Quanto Off Canvas Builder', 'quanto' ),
				'name_admin_bar'     => __( 'Off Canvas Builder', 'quanto' ),
				'add_new'            => __( 'Add New', 'quanto' ),
				'add_new_item'       => __( 'Add New Off Canvas Builder', 'quanto' ),
				'new_item'           => __( 'New Off Canvas Builder', 'quanto' ),
				'edit_item'          => __( 'Edit Off Canvas Builder', 'quanto' ),
				'view_item'          => __( 'View Off Canvas Builder', 'quanto' ),
				'all_items'          => __( 'All Off Canvas Builder', 'quanto' ),
				'search_items'       => __( 'Search Off Canvas Builder', 'quanto' ),
				'parent_item_colon'  => __( 'Parent Off Canvas Builder:', 'quanto' ),
				'not_found'          => __( 'No Off Canvas Builder found.', 'quanto' ),
				'not_found_in_trash' => __( 'No Off Canvas Builder found in Trash.', 'quanto' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);
			register_post_type( 'quanto_off_build', $args );

		}

		function load_canvas_template( $single_template ) {

			global $post;

			$builder_types = [ 'quanto_footer', 'quanto_header', 'quanto_tab_build', 'quanto_off_build', 'quanto_archive' ];
			if ( in_array( $post->post_type, $builder_types ) ) {
			// if ( 'quanto_footer' == $post->post_type || 'quanto_header' == $post->post_type || 'quanto_tab_build' == $post->post_type || 'quanto_off_build' == $post->post_type  ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function quanto_footer_choose_option(){

			$quanto_post_query = new WP_Query( array(
				'post_type'			=> 'quanto_footer',
				'posts_per_page'	    => 20,
			) );

			$quanto_builder_post_title = array();
			$quanto_builder_post_title[''] = __('Select a Footer','Quanto');

			while( $quanto_post_query->have_posts() ) {
				$quanto_post_query->the_post();
				$quanto_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $quanto_builder_post_title;

		}

		public function quanto_header_choose_option(){

			$quanto_post_query = new WP_Query( array(
				'post_type'			=> 'quanto_header',
				'posts_per_page'	    => 20,
			) );

			$quanto_builder_post_title = array();
			$quanto_builder_post_title[''] = __('Select a Header','Quanto');

			while( $quanto_post_query->have_posts() ) {
				$quanto_post_query->the_post();
				$quanto_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $quanto_builder_post_title;

        }


		// For Archive
		// Add these new functions inside the QuantoBuilder class

		/**
		 * Redirects archive pages to use the custom Elementor template if one is assigned.
		 */
		function template_redirect_archive( $template ) {
			
			$template_id = false;
			
			if ( is_home() ) { // For the main blog posts page
				$template_id = get_option('quanto_blog_archive_template');
			} elseif ( is_category() ) {
				$template_id = get_option('quanto_category_archive_template');
			} elseif ( is_tag() ) {
				$template_id = get_option('quanto_tag_archive_template');
			} elseif ( is_author() ) {
				$template_id = get_option('quanto_author_archive_template');
			} elseif ( is_date() ) {
				$template_id = get_option('quanto_date_archive_template');
			}

			if ( $template_id && is_numeric($template_id) ) {
				// Check if the template is built with Elementor
				if ( \Elementor\Plugin::instance()->db->is_built_with_elementor( $template_id ) ) {
					// Locate our custom template file within the plugin
					$new_template = plugin_dir_path( __FILE__ ) . 'templates/archive-template.php';
					if ( file_exists( $new_template ) ) {
						return $new_template;
					}
				}
			}

			return $template;
		}

		/**
		 * Gets a list of all created archive templates for use in a dropdown.
		 */
		public function quanto_archive_choose_option() {
			$quanto_post_query         = new WP_Query( array(
				'post_type'      => 'quanto_archive',
				'posts_per_page' => -1,
			) );
			$quanto_builder_post_title    = array();
			$quanto_builder_post_title[''] = __( 'Select an Archive Template', 'quanto' );
			while ( $quanto_post_query->have_posts() ) {
				$quanto_post_query->the_post();
				$quanto_builder_post_title[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();

			return $quanto_builder_post_title;
		}

		/**
		 * Handles saving the data from the Archive Settings page.
		 */
		public function quanto_save_archive_settings() {
			if ( ! isset( $_POST['quanto_archive_settings_nonce'] ) || ! wp_verify_nonce( $_POST['quanto_archive_settings_nonce'], 'quanto_archive_settings_action' ) ) {
				return;
			}
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			$options_to_save = [
				'quanto_blog_archive_template',
				'quanto_category_archive_template',
				'quanto_tag_archive_template',
				'quanto_author_archive_template',
				'quanto_date_archive_template'
			];
			foreach($options_to_save as $option_name) {
				if ( isset( $_POST[$option_name] ) ) {
					update_option( $option_name, sanitize_text_field( $_POST[$option_name] ) );
				}
			}
		}

		/**
		 * Renders the HTML for the Archive Settings page.
		 */
		public function quanto_archive_settings_page_html() {
			?>
			<div class="wrap">
				<h1><?php echo esc_html__( 'Archive Template Settings', 'quanto' ); ?></h1>
				<p><?php echo esc_html__( 'Assign your custom-built archive templates to the corresponding archive pages.', 'quanto' ); ?></p>
				
				<form method="post" action="">
					<?php wp_nonce_field( 'quanto_archive_settings_action', 'quanto_archive_settings_nonce' ); ?>
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row">
									<label for="quanto_blog_archive_template"><?php esc_html_e( 'Blog / Posts Page Archive', 'quanto' ); ?></label>
								</th>
								<td>
									<select name="quanto_blog_archive_template" id="quanto_blog_archive_template">
										<?php
										$options = $this->quanto_archive_choose_option();
										$selected_option = get_option('quanto_blog_archive_template');
										foreach ( $options as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '" ' . selected( $selected_option, $value, false ) . '>' . esc_html( $label ) . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="quanto_category_archive_template"><?php esc_html_e( 'Category Archive', 'quanto' ); ?></label>
								</th>
								<td>
									<select name="quanto_category_archive_template" id="quanto_category_archive_template">
										<?php
										$options = $this->quanto_archive_choose_option();
										$selected_option = get_option('quanto_category_archive_template');
										foreach ( $options as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '" ' . selected( $selected_option, $value, false ) . '>' . esc_html( $label ) . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="quanto_tag_archive_template"><?php esc_html_e( 'Tag Archive', 'quanto' ); ?></label>
								</th>
								<td>
									<select name="quanto_tag_archive_template" id="quanto_tag_archive_template">
										<?php
										$options = $this->quanto_archive_choose_option();
										$selected_option = get_option('quanto_tag_archive_template');
										foreach ( $options as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '" ' . selected( $selected_option, $value, false ) . '>' . esc_html( $label ) . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="quanto_author_archive_template"><?php esc_html_e( 'Author Archive', 'quanto' ); ?></label>
								</th>
								<td>
									<select name="quanto_author_archive_template" id="quanto_author_archive_template">
										<?php
										$options = $this->quanto_archive_choose_option();
										$selected_option = get_option('quanto_author_archive_template');
										foreach ( $options as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '" ' . selected( $selected_option, $value, false ) . '>' . esc_html( $label ) . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="row">
									<label for="quanto_date_archive_template"><?php esc_html_e( 'Date Archive', 'quanto' ); ?></label>
								</th>
								<td>
									<select name="quanto_date_archive_template" id="quanto_date_archive_template">
										<?php
										$options = $this->quanto_archive_choose_option();
										$selected_option = get_option('quanto_date_archive_template');
										foreach ( $options as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '" ' . selected( $selected_option, $value, false ) . '>' . esc_html( $label ) . '</option>';
										}
										?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<?php submit_button( esc_html__('Save Settings', 'quanto') ); ?>
				</form>
			</div>
			<?php
		}

    }

    $builder_execute = new QuantoBuilder();