<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}
class QuantoCustomPosts{

    function __construct()
	{   
        /*----------  Service ----------*/
        add_action('init', array($this, 'agroland_service'));


        /*----------  Team ----------*/
        add_action('init', array($this, 'agroland_team'));

        /*----------  Project ----------*/
        add_action('init', array($this, 'agroland_project'));
        add_action('init', array($this, 'agroland_project_category'));

        /*----------  Job ----------*/
        add_action('init', array($this, 'agroland_job'));
    }

    /*----------  Service ----------*/   
    public function agroland_service() 
    {
        $labels = array(
            'name'               => esc_html__( 'Services', 'Service general name', 'quanto' ),
            'singular_name'      => esc_html__( 'Service', 'Service singular name', 'quanto' ),
            'menu_name'          => esc_html__( 'Services', 'admin menu', 'quanto' ),
            'name_admin_bar'     => esc_html__( 'Service', 'add new on admin bar', 'quanto' ),
            'add_new'            => esc_html__( 'Add New', 'Service', 'quanto' ),
            'add_new_item'       => esc_html__( 'Add New Service', 'quanto' ),
            'new_item'           => esc_html__( 'New Service', 'quanto' ),
            'edit_item'          => esc_html__( 'Edit Service', 'quanto' ),
            'view_item'          => esc_html__( 'View Service', 'quanto' ),
            'all_items'          => esc_html__( 'All Service', 'quanto' ),
            'search_items'       => esc_html__( 'Search Service', 'quanto' ),
            'parent_item_colon'  => esc_html__( 'Parent Service:', 'quanto' ),
            'not_found'          => esc_html__( 'No Service found.', 'quanto' ),
            'not_found_in_trash' => esc_html__( 'No Service found in Trash.', 'quanto' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__( 'Description.', 'quanto' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-edit-page',
            'supports'           => array( 'title','thumbnail','editor','excerpt','elementor' ),
            'rewrite'            => array( 'slug' => 'services' ),
        );
        register_post_type( 'agroland_service', $args );
    }


    /*----------  Team ----------*/   
    public function agroland_team() 
    {
        $labels = array(
            'name'               => esc_html__( 'Teams', 'Team general name', 'quanto' ),
            'singular_name'      => esc_html__( 'Team', 'Team singular name', 'quanto' ),
            'menu_name'          => esc_html__( 'Teams', 'admin menu', 'quanto' ),
            'name_admin_bar'     => esc_html__( 'Team', 'add new on admin bar', 'quanto' ),
            'add_new'            => esc_html__( 'Add New', 'Team', 'quanto' ),
            'add_new_item'       => esc_html__( 'Add New Team', 'quanto' ),
            'new_item'           => esc_html__( 'New Team', 'quanto' ),
            'edit_item'          => esc_html__( 'Edit Team', 'quanto' ),
            'view_item'          => esc_html__( 'View Team', 'quanto' ),
            'all_items'          => esc_html__( 'All Team', 'quanto' ),
            'search_items'       => esc_html__( 'Search Team', 'quanto' ),
            'parent_item_colon'  => esc_html__( 'Parent Team:', 'quanto' ),
            'not_found'          => esc_html__( 'No Team found.', 'quanto' ),
            'not_found_in_trash' => esc_html__( 'No Team found in Trash.', 'quanto' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__( 'Description.', 'quanto' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-id',
            'supports'           => array( 'title','thumbnail','editor','elementor' ),
            'rewrite'            => array( 'slug' => 'teams' ),
        );
        register_post_type( 'agroland_team', $args );
    }


    /*----------  Project ----------*/   
    public function agroland_project() 
    {
        $labels = array(
            'name'               => esc_html__( 'Projects', 'Project general name', 'quanto' ),
            'singular_name'      => esc_html__( 'Project', 'Project singular name', 'quanto' ),
            'menu_name'          => esc_html__( 'Projects', 'admin menu', 'quanto' ),
            'name_admin_bar'     => esc_html__( 'Project', 'add new on admin bar', 'quanto' ),
            'add_new'            => esc_html__( 'Add New', 'Project', 'quanto' ),
            'add_new_item'       => esc_html__( 'Add New Project', 'quanto' ),
            'new_item'           => esc_html__( 'New Project', 'quanto' ),
            'edit_item'          => esc_html__( 'Edit Project', 'quanto' ),
            'view_item'          => esc_html__( 'View Project', 'quanto' ),
            'all_items'          => esc_html__( 'All Projects', 'quanto' ),
            'search_items'       => esc_html__( 'Search Projects', 'quanto' ),
            'parent_item_colon'  => esc_html__( 'Parent Projects:', 'quanto' ),
            'not_found'          => esc_html__( 'No Projects found.', 'quanto' ),
            'not_found_in_trash' => esc_html__( 'No Projects found in Trash.', 'quanto' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__( 'Description.', 'quanto' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array( 'title','thumbnail','editor','excerpt','elementor' ),
            'rewrite'            => array( 'slug' => 'projects' ),
        );
        register_post_type( 'agroland_project', $args );
    }

    // Project Category
    public function agroland_project_category() {

        $labels = array(
            'name'                       => esc_html__( 'Categories', 'taxonomy general name', 'quanto' ),
            'singular_name'              => esc_html__( 'Category', 'taxonomy singular name', 'quanto' ),
            'search_items'               => esc_html__( 'Search Categorys', 'quanto' ),
            'popular_items'              => esc_html__( 'Popular Categorys', 'quanto' ),
            'all_items'                  => esc_html__( 'All Categorys', 'quanto' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__( 'Edit Category', 'quanto' ),
            'update_item'                => esc_html__( 'Update Category', 'quanto' ),
            'add_new_item'               => esc_html__( 'Add New Category', 'quanto' ),
            'new_item_name'              => esc_html__( 'New Category Name', 'quanto' ),
            'separate_items_with_commas' => esc_html__( 'Separate Categorys with commas', 'quanto' ),
            'add_or_remove_items'        => esc_html__( 'Add or remove Categorys', 'quanto' ),
            'choose_from_most_used'      => esc_html__( 'Choose from the most used Categorys', 'quanto' ),
            'not_found'                  => esc_html__( 'No Categorys found.', 'quanto' ),
            'menu_name'                  => esc_html__( 'Categories', 'quanto' ),
        );
    
        $args = array(
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array( 'slug' => 'project-cat' ),
        );
        register_taxonomy( 'project_category', 'agroland_project', $args );
    }


    /*----------  Job ----------*/   
    public function agroland_job() {
        $labels = array(
            'name'               => esc_html__( 'Job', 'Job general name', 'quanto' ),
            'singular_name'      => esc_html__( 'Job', 'Job singular name', 'quanto' ),
            'menu_name'          => esc_html__( 'Job', 'admin menu', 'quanto' ),
            'name_admin_bar'     => esc_html__( 'Job', 'add new on admin bar', 'quanto' ),
            'add_new'            => esc_html__( 'Add New', 'Job', 'quanto' ),
            'add_new_item'       => esc_html__( 'Add New Job', 'quanto' ),
            'new_item'           => esc_html__( 'New Job', 'quanto' ),
            'edit_item'          => esc_html__( 'Edit Job', 'quanto' ),
            'view_item'          => esc_html__( 'View Job', 'quanto' ),
            'all_items'          => esc_html__( 'All Job', 'quanto' ),
            'search_items'       => esc_html__( 'Search Job', 'quanto' ),
            'parent_item_colon'  => esc_html__( 'Parent Job:', 'quanto' ),
            'not_found'          => esc_html__( 'No Job found.', 'quanto' ),
            'not_found_in_trash' => esc_html__( 'No Job found in Trash.', 'quanto' ),
        );
    
        $args = array(
            'labels'             => $labels,
            'description'        => esc_html__( 'Description.', 'quanto' ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'has_archive'        => false,
            'hierarchical'       => true,
            'menu_position'      => null,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-lightbulb',
            'supports'           => array( 'title','thumbnail','editor','excerpt','elementor' ),
            'rewrite'            => array( 'slug' => 'job' ),
        );
        register_post_type( 'agroland_job', $args );
    }
    
}
$Agroland_StydyInstance = new QuantoCustomPosts;

