<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirror
 * @Author URI : https://www.vecurosoft.com/
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

/**
 * Single Template
 */
add_filter( 'single_template', 'agroland_core_template_redirect' );

if( ! function_exists( 'agroland_core_template_redirect' ) ){
    function agroland_core_template_redirect( $single_template ){

        global $post;

        // teacher Single Page
        if( $post ){
            if( $post->post_type == 'agroland_teacher' ){
                $single_template = AGROLAND_CORE_PLUGIN_TEMP . 'single-agroland_teacher.php';
            }
        }

        if( $post ){
            if( $post->post_type == 'agroland_class' ){
                $single_template = AGROLAND_CORE_PLUGIN_TEMP . 'single-agroland_class.php';
            }
        }

        if( $post ){
            if( $post->post_type == 'agroland_event' ){
                $single_template = AGROLAND_CORE_PLUGIN_TEMP . 'single-agroland_event.php';
            }
        }

        return $single_template;
    }
}


/**
 * Archive Template
 */
add_filter( 'archive_template', 'agroland_core_template_archive' );

if( ! function_exists( 'agroland_core_template_archive' ) ){
    function agroland_core_template_archive( $archive_template ){

        global $post;

        // Service Archive Template
        if( $post ){
            if( $post->post_type == 'agroland_class' ){
                $archive_template = AGROLAND_CORE_PLUGIN_TEMP . 'archive-agroland_class.php';
            }
        }

        return $archive_template;
    }
}


/**
 * Meta Output
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'agroland_get_meta' ) ) {
  function agroland_get_meta( $data ) {
      global $wp_embed;
      $agroland_content = $wp_embed->autoembed( $data );
      $agroland_content = $wp_embed->run_shortcode( $agroland_content );
      $agroland_content = do_shortcode( $agroland_content );
      $agroland_content = wpautop( $agroland_content );
      return $agroland_content;
  }
}


/**
 * Admin Custom Login Logo
 */
function agroland_custom_login_logo() {
  $logo = ! empty( agroland_opt( 'agroland_admin_login_logo', 'url' ) ) ? agroland_opt( 'agroland_admin_login_logo', 'url' ) : '' ;
  if( isset( $logo ) && !empty( $logo ) )
      echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
}
add_action( 'login_enqueue_scripts', 'agroland_custom_login_logo' );

/**
* Admin Custom css
*/
add_action( 'admin_enqueue_scripts', 'agroland_admin_styles' );

function agroland_admin_styles() {
  // $agroland_admin_custom_css = ! empty( agroland_opt( 'agroland_theme_admin_custom_css' ) ) ? agroland_opt( 'agroland_theme_admin_custom_css' ) : '';
  if ( ! empty( $agroland_admin_custom_css ) ) {
      $agroland_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $agroland_admin_custom_css);
      echo '<style rel="stylesheet" id="agroland-admin-custom-css" >';
              echo esc_html( $agroland_admin_custom_css );
      echo '</style>';
  }
}


// Social Icons
if ( ! function_exists( 'agroland_icon_list_options' ) ) {
    function agroland_icon_list_options() {
        $socialIcons = array(
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'linkedin' => 'LinkedIn',
            'pinterest-p' => 'Pinterest',
            'youtube' => 'Youtube',
            'github' => 'GitHub',
            'google' => 'Google',
            'dribbble' => 'Dribbble',
            // Add more social icons as needed
        );
        return $socialIcons;
    }
}



 // share button code
 function agroland_social_sharing_buttons( ) {

  // Get page URL
  $URL = get_permalink();
  $Sitetitle = get_bloginfo('name');

  // Get page title
  $Title = str_replace( ' ', '%20', get_the_title());


  // Construct sharing URL without using any script

  $twitterURL = 'https://twitter.com/share?text='.esc_html( $Title ).'&url='.esc_url( $URL );
  $instagramURL = 'https://www.instagram.com/'; 
  $linkedinURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
  $dribbbleURL  = 'https://dribbble.com/'; 
  $behanceURL   = 'https://www.behance.net/'; 



  // Add sharing button at the end of page/page content
$content = '';

  $content .= '<li><a href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fab fa-x-twitter"></i></a></li>';
  $content .= '<li><a href="'.esc_url( $instagramURL ).'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
  $content .= '<li><a href="'.esc_url( $linkedinURL ).'" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>';
  $content .= '<li><a href="'.esc_url( $dribbbleURL ).'" target="_blank"><i class="fab fa-dribbble"></i></a></li>';
  $content .= '<li><a href="'.esc_url( $behanceURL ).'" target="_blank"><i class="fab fa-behance"></i></a></li>';

  return $content;
};

//add SVG to allowed file uploads
function agroland_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svgz+xml';
  $mimes['exe'] = 'program/exe';
  $mimes['dwg'] = 'image/vnd.dwg';
  return $mimes;
}
add_filter('upload_mimes', 'agroland_mime_types');

function agroland_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];

    return compact( 'ext', 'type', 'proper_filename' );
}
add_filter('wp_check_filetype_and_ext','agroland_wp_check_filetype_and_ext',10,4);

if( ! function_exists('agroland_get_user_role_name') ){
    function agroland_get_user_role_name( $user_ID ){
        global $wp_roles;

        $user_data      = get_userdata( $user_ID );
        $user_role_slug = $user_data->roles[0];
        return translate_user_role( $wp_roles->roles[$user_role_slug]['name'] );
    }
}


add_filter('wpcf7_autop_or_not', '__return_false');
// add_image_size( 'blog-sidebar-size',100,100,true );
// add_image_size( 'home-slider-blog-image',387,320,true );
// add_image_size( 'home-slider-blog-image-one',290,260,true );
// add_image_size( 'home-slider-blog-image-three',387,250,true );
// add_image_size( 'home-slider-blog-image-four',314,228,true );
// add_image_size( 'home-slider-blog-image-five',370,424,true );
// add_image_size( 'agroland-related-post-size',270,314,true );
// add_image_size( 'agroland-class-post',360,306,true );
// add_image_size( 'agroland-class-post-two',230,230,true );



/**
* Enqueue block editor JavaScript and CSS
*/
function agroland_widget_editor_scripts() {

  // Make paths variables so we don't write em twice 
  // $blockPath = '../assets/js/blocks.js';

  
  // Enqueue the bundled block JS file
  wp_enqueue_script(
      'agroland-blocks-js', AGROLAND_PLUGDIRURI . 'assets/js/blocks.js',
      [  'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n' ],
      '1.00',
      true
  );
}
// Hook scripts function into block editor hook
add_action( 'enqueue_block_editor_assets', 'agroland_widget_editor_scripts' );




/**
 * Post Category
 */
if( ! function_exists( 'agroland_events_category' ) ){
  function agroland_events_category(){
      $cat_array = array();
      $cat_array[] = esc_html__( 'Select a category','quanto' );
      $terms = get_terms( array(
          'taxonomy'      => 'event_category',
          'hide_empty'    => true
      ) );
      if( is_array( $terms ) && $terms ){
          foreach( $terms as $term ){
              $cat_array[$term->slug] = $term->name;
          }
      }
      return $cat_array;
  }
}

/**
 * Post orderby list
 */
function agroland_get_post_orderby_options()
{
    $orderby = array(
        'ID' => 'Post ID',
        'author' => 'Post Author',
        'title' => 'Title',
        'date' => 'Date',
        'modified' => 'Last Modified Date',
        'parent' => 'Parent Id',
        'rand' => 'Random',
        'comment_count' => 'Comment Count',
        'menu_order' => 'Menu Order',
    );
    $orderby = apply_filters('agroland_post_orderby', $orderby);
    return $orderby;
}

/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'agroland_get_all_posts' ) ) {
    function agroland_get_all_posts($posttype)
    {
        $args = array( 
            'post_type' => $posttype,
            'post_status' => 'publish',
            'posts_per_page' => -1
        );

        $post_list = array();
        if( $data = get_posts($args)){
            foreach($data as $key){
                $post_list[$key->ID] = $key->post_title;
            }
        }
        return  $post_list;
    }
}

// if( ! function_exists('hello_pagination') ) {
//     function hello_pagination( ) {
//         if( ! empty( agroland_pagination() ) ) {
//             echo '<div class="row">';
//                 echo '<div class="col-12">';
//                     echo '<div class="vs-pagination pt-20 pb-30">';
//                         echo '<ul>';
//                         $prev 	= '<i class="fas fa-chevron-left"></i>';
//                         $next 	= '<i class="fas fa-chevron-right"></i>';
//                             // previous
//                             if( get_previous_posts_link() ){
//                                 echo '<li>';
//                                 previous_posts_link( $prev );
//                                 echo '</li>';
//                             }
//                             echo agroland_pagination();
//                             // next
//                             if( get_next_posts_link() ){
//                                 echo '<li>';
//                                 next_posts_link( $next );
//                                 echo '</li>';
//                             }
//                         echo '</ul>';
//                     echo '</div>';
//                 echo '</div>';
//             echo '</div>';
//         }
//     }
// }



/**
 * Responsive Column Order
 *
 */
function agroland_add_responsive_column_order( $element, $args ) {
	$element->add_responsive_control(
		'responsive_column_order',
		[
			'label' => __( 'Responsive Column Order', 'quanto' ),
			'type' => \Elementor\Controls_Manager::NUMBER,
			'separator' => 'before',
			'selectors' => [
				'{{WRAPPER}}' => '-webkit-order: {{VALUE}}; -ms-flex-order: {{VALUE}}; order: {{VALUE}};',
			],
		]
	);
}
add_action( 'elementor/element/column/layout/before_section_end', 'agroland_add_responsive_column_order', 10, 2 );
