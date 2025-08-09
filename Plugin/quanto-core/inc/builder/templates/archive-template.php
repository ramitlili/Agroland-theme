<?php
/**
 * Quanto Archive Template
 * This template is used to display the Elementor-built archive page.
 */

// Determine the correct template ID based on the archive type
$template_id = false;
if ( is_home() ) {
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

get_header(); ?>

<div class="quanto-archive-content">
    <?php
    if ( $template_id ) {
        // Render the Elementor content
        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template_id );
    } else {
        // Fallback content if no template is assigned
        echo '<h1>' . esc_html__( 'Archive', 'quanto' ) . '</h1>';
        echo '<p>' . esc_html__( 'No archive template has been assigned.', 'quanto' ) . '</p>';
    }
    ?>
</div>

<?php get_footer(); ?>