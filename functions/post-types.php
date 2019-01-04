<?php
//Pricings
add_action( 'init', 'mosrokomari_pricings_init' );
function mosrokomari_pricings_init() {
	$labels = array(
		'name'               => _x( 'Pricings', 'post type general name', 'excavator-template' ),
		'singular_name'      => _x( 'Pricing', 'post type singular name', 'excavator-template' ),
		'menu_name'          => _x( 'Pricings', 'admin menu', 'excavator-template' ),
		'name_admin_bar'     => _x( 'Pricing', 'add new on admin bar', 'excavator-template' ),
		'add_new'            => _x( 'Add New', 'pricing', 'excavator-template' ),
		'add_new_item'       => __( 'Add New Pricing', 'excavator-template' ),
		'new_item'           => __( 'New Pricing', 'excavator-template' ),
		'edit_item'          => __( 'Edit Pricing', 'excavator-template' ),
		'view_item'          => __( 'View Pricing', 'excavator-template' ),
		'all_items'          => __( 'All Pricings', 'excavator-template' ),
		'search_items'       => __( 'Search Pricings', 'excavator-template' ),
		'parent_item_colon'  => __( 'Parent Pricings:', 'excavator-template' ),
		'not_found'          => __( 'No Pricings found.', 'excavator-template' ),
		'not_found_in_trash' => __( 'No Pricings found in Trash.', 'excavator-template' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Description.', 'excavator-template' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'pricing' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon' => 'dashicons-list-view',
		'supports'           => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
	);

	register_post_type( 'pricing', $args );
}
add_action( 'after_switch_theme', 'flush_rewrite_rules' );
