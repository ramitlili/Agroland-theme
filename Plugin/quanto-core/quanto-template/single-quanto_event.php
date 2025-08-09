<?php 

    // Prevent direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    // header
    get_header();
	
	echo '<div class="project-details">';
		while( have_posts( ) ) :
			the_post();
			the_content();

		endwhile;
		wp_reset_postdata();
	echo '</div>';
	
	get_footer();