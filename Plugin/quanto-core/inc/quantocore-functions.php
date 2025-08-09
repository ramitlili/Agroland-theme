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
add_filter( 'single_template', 'quanto_core_template_redirect' );

if( ! function_exists( 'quanto_core_template_redirect' ) ){
    function quanto_core_template_redirect( $single_template ){

        global $post;

        // teacher Single Page
        if( $post ){
            if( $post->post_type == 'quanto_teacher' ){
                $single_template = QUANTO_CORE_PLUGIN_TEMP . 'single-quanto_teacher.php';
            }
        }

        if( $post ){
            if( $post->post_type == 'quanto_class' ){
                $single_template = QUANTO_CORE_PLUGIN_TEMP . 'single-quanto_class.php';
            }
        }

        if( $post ){
            if( $post->post_type == 'quanto_event' ){
                $single_template = QUANTO_CORE_PLUGIN_TEMP . 'single-quanto_event.php';
            }
        }

        return $single_template;
    }
}


/**
 * Archive Template
 */
add_filter( 'archive_template', 'quanto_core_template_archive' );

if( ! function_exists( 'quanto_core_template_archive' ) ){
    function quanto_core_template_archive( $archive_template ){

        global $post;

        // Service Archive Template
        if( $post ){
            if( $post->post_type == 'quanto_class' ){
                $archive_template = QUANTO_CORE_PLUGIN_TEMP . 'archive-quanto_class.php';
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
if ( ! function_exists( 'quanto_get_meta' ) ) {
  function quanto_get_meta( $data ) {
      global $wp_embed;
      $quanto_content = $wp_embed->autoembed( $data );
      $quanto_content = $wp_embed->run_shortcode( $quanto_content );
      $quanto_content = do_shortcode( $quanto_content );
      $quanto_content = wpautop( $quanto_content );
      return $quanto_content;
  }
}


/**
 * Admin Custom Login Logo
 */
function quanto_custom_login_logo() {
  $logo = ! empty( quanto_opt( 'quanto_admin_login_logo', 'url' ) ) ? quanto_opt( 'quanto_admin_login_logo', 'url' ) : '' ;
  if( isset( $logo ) && !empty( $logo ) )
      echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
}
add_action( 'login_enqueue_scripts', 'quanto_custom_login_logo' );

/**
* Admin Custom css
*/
add_action( 'admin_enqueue_scripts', 'quanto_admin_styles' );

function quanto_admin_styles() {
  // $quanto_admin_custom_css = ! empty( quanto_opt( 'quanto_theme_admin_custom_css' ) ) ? quanto_opt( 'quanto_theme_admin_custom_css' ) : '';
  if ( ! empty( $quanto_admin_custom_css ) ) {
      $quanto_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $quanto_admin_custom_css);
      echo '<style rel="stylesheet" id="quanto-admin-custom-css" >';
              echo esc_html( $quanto_admin_custom_css );
      echo '</style>';
  }
}


// Social Icons
if ( ! function_exists( 'quanto_icon_list_options' ) ) {
    function quanto_icon_list_options() {
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
 function quanto_social_sharing_buttons( ) {

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
function quanto_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svgz+xml';
  $mimes['exe'] = 'program/exe';
  $mimes['dwg'] = 'image/vnd.dwg';
  return $mimes;
}
add_filter('upload_mimes', 'quanto_mime_types');

function quanto_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];

    return compact( 'ext', 'type', 'proper_filename' );
}
add_filter('wp_check_filetype_and_ext','quanto_wp_check_filetype_and_ext',10,4);

if( ! function_exists('quanto_get_user_role_name') ){
    function quanto_get_user_role_name( $user_ID ){
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
// add_image_size( 'quanto-related-post-size',270,314,true );
// add_image_size( 'quanto-class-post',360,306,true );
// add_image_size( 'quanto-class-post-two',230,230,true );



/**
* Enqueue block editor JavaScript and CSS
*/
function quanto_widget_editor_scripts() {

  // Make paths variables so we don't write em twice 
  // $blockPath = '../assets/js/blocks.js';

  
  // Enqueue the bundled block JS file
  wp_enqueue_script(
      'quanto-blocks-js', QUANTO_PLUGDIRURI . 'assets/js/blocks.js',
      [  'wp-blocks', 'wp-element', 'wp-components', 'wp-i18n' ],
      '1.00',
      true
  );
}
// Hook scripts function into block editor hook
add_action( 'enqueue_block_editor_assets', 'quanto_widget_editor_scripts' );




/**
 * Post Category
 */
if( ! function_exists( 'quanto_events_category' ) ){
  function quanto_events_category(){
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
function quanto_get_post_orderby_options()
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
    $orderby = apply_filters('quanto_post_orderby', $orderby);
    return $orderby;
}

/**
 * Get Posts
 *
 * @since 1.0
 *
 * @return array
 */
if ( ! function_exists( 'quanto_get_all_posts' ) ) {
    function quanto_get_all_posts($posttype)
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
//         if( ! empty( quanto_pagination() ) ) {
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
//                             echo quanto_pagination();
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
function quanto_add_responsive_column_order( $element, $args ) {
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
add_action( 'elementor/element/column/layout/before_section_end', 'quanto_add_responsive_column_order', 10, 2 );
