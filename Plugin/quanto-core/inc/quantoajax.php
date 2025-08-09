<?php
/**
 * @Packge     : Quanto
 * @Version    : 1.0
 * @Author     : Mirror
 * @Author URI : https://www.vecurosoft.com/
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function quanto_core_essential_scripts( ) {
    wp_enqueue_script('quanto-ajax',QUANTO_PLUGDIRURI.'assets/js/quanto.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'quanto-ajax',
    'quantoajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'quanto-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','quanto_core_essential_scripts');


// quanto Section subscribe ajax callback function
add_action( 'wp_ajax_quanto_subscribe_ajax', 'quanto_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_quanto_subscribe_ajax', 'quanto_subscribe_ajax' );

function quanto_subscribe_ajax( ){
  $apiKey = quanto_opt('quanto_subscribe_apikey');
  $listid = quanto_opt('quanto_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'quanto-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'quanto').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);

           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'quanto').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'quanto').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'quanto').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'quanto').'</div>';
        }
   }

   wp_die();

}