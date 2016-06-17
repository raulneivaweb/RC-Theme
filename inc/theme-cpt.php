<?php
/**
 * Custom Post Types
 *
 * @package Rhuan Carlos
 * @version 1.0
 */

/**
 * CPT Portfolio
 */
function nexo_portfolio() {

	$labels = array(
		'name'                  => __( 'Portfolio', 'nexothemes' ),
		'singular_name'         => __( 'Portfolio', 'nexothemes' ),
		'menu_name'             => __( 'Portfolio', 'nexothemes' ),
		'name_admin_bar'        => __( 'Portfolio', 'nexothemes' ),
		'archives'              => __( 'Portfolio Archives', 'nexothemes' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'nexothemes' ),
		'all_items'             => __( 'All Portfolio', 'nexothemes' ),
		'add_new_item'          => __( 'Add New Portfolio', 'nexothemes' ),
		'add_new'               => __( 'Add New', 'nexothemes' ),
		'new_item'              => __( 'New Portfolio', 'nexothemes' ),
		'edit_item'             => __( 'Edit Portfolio', 'nexothemes' ),
		'update_item'           => __( 'Update Portfolio', 'nexothemes' ),
		'view_item'             => __( 'View Portfolio', 'nexothemes' ),
		'search_items'          => __( 'Search Portfolio', 'nexothemes' ),
		'not_found'             => __( 'Not found', 'nexothemes' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'nexothemes' ),
		'featured_image'        => __( 'Featured Image', 'nexothemes' ),
		'set_featured_image'    => __( 'Set featured image', 'nexothemes' ),
		'remove_featured_image' => __( 'Remove featured image', 'nexothemes' ),
		'use_featured_image'    => __( 'Use as featured image', 'nexothemes' ),
		'insert_into_item'      => __( 'Insert into portfolio', 'nexothemes' ),
		'uploaded_to_this_item' => __( 'Uploaded to this portfolio', 'nexothemes' ),
		'items_list'            => __( 'Portfolio list', 'nexothemes' ),
		'items_list_navigation' => __( 'Portfolio list navigation', 'nexothemes' ),
		'filter_items_list'     => __( 'Filter portfolio list', 'nexothemes' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'nexothemes' ),
		'description'           => __( 'Itens Portfolio', 'nexothemes' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', ),
		'taxonomies'            => array( 'cat_portfolio', ' partners' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'nexo_portfolio', 0 );




/**
 * Custom Taxonomies to Portfolio
 *
 * - Categories Portfolio
 * - Partners
 */
// Categories Portfolio
function nexo_cat_portfolio() {

	$labels = array(
		'name'                       => __( 'Categories Portfolio', 'nexothemes' ),
		'singular_name'              => __( 'Category Portfolio', 'nexothemes' ),
		'menu_name'                  => __( 'Category Portfolio', 'nexothemes' ),
		'all_items'                  => __( 'All Categories', 'nexothemes' ),
		'parent_item'                => __( 'Parent Category', 'nexothemes' ),
		'parent_item_colon'          => __( 'Parent Category:', 'nexothemes' ),
		'new_item_name'              => __( 'New Category', 'nexothemes' ),
		'add_new_item'               => __( 'Add New Category', 'nexothemes' ),
		'edit_item'                  => __( 'Edit Category', 'nexothemes' ),
		'update_item'                => __( 'Update Category', 'nexothemes' ),
		'view_item'                  => __( 'View Category', 'nexothemes' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'nexothemes' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'nexothemes' ),
		'popular_items'              => __( 'Popular Categories', 'nexothemes' ),
		'search_items'               => __( 'Search Categories', 'nexothemes' ),
		'not_found'                  => __( 'Not Found', 'nexothemes' ),
		'no_terms'                   => __( 'No category', 'nexothemes' ),
		'items_list'                 => __( 'Categories list', 'nexothemes' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'nexothemes' ),
	);
	$rewrite = array(
		'slug'                       => 'cat-portfolio',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'cat_portfolio', array( 'portfolio' ), $args );

}
add_action( 'init', 'nexo_cat_portfolio', 0 );

// Partners
function nexo_partners() {

	$labels = array(
		'name'                       => __( 'Partners', 'nexothemes' ),
		'singular_name'              => __( 'Partner', 'nexothemes' ),
		'menu_name'                  => __( 'Partners', 'nexothemes' ),
		'all_items'                  => __( 'All Partners', 'nexothemes' ),
		'parent_item'                => __( 'Parent Partner', 'nexothemes' ),
		'parent_item_colon'          => __( 'Parent Partner:', 'nexothemes' ),
		'new_item_name'              => __( 'New Partner', 'nexothemes' ),
		'add_new_item'               => __( 'Add New Partner', 'nexothemes' ),
		'edit_item'                  => __( 'Edit Partner', 'nexothemes' ),
		'update_item'                => __( 'Update Partner', 'nexothemes' ),
		'view_item'                  => __( 'View Partner', 'nexothemes' ),
		'add_or_remove_items'        => __( 'Add or remove partners', 'nexothemes' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'nexothemes' ),
		'popular_items'              => __( 'Popular Partners', 'nexothemes' ),
		'search_items'               => __( 'Search Partners', 'nexothemes' ),
		'not_found'                  => __( 'Not Found', 'nexothemes' ),
		'no_terms'                   => __( 'No partner', 'nexothemes' ),
		'items_list'                 => __( 'Partners list', 'nexothemes' ),
		'items_list_navigation'      => __( 'Partners list navigation', 'nexothemes' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'partners', array( 'portfolio' ), $args );

}
add_action( 'init', 'nexo_partners', 0 );
?>
