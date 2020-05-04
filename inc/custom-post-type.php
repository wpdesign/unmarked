<?php
/**
* Al Custom Post Type
*/

// Flush rewrite rules for custom post
add_action( 'after_switch_theme', 'unmarked_flush_rewrite_rules' );

// Flush your rewrite rules
function unmarked_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// Let's create the function for the coupon post type
function coupons_post_type() { 
	register_post_type( 'coupons',
		// let's now add all the options for this post
		array( 'labels' => 
			array(
				'name' => __( 'Coupons', 'unmarked' ),
				'singular_name' => __( 'Coupons Post', 'unmarked' ),
				'all_items' => __( 'All Coupons', 'unmarked' ),
				'add_new' => __( 'Add New', 'unmarked' ),
				'add_new_item' => __( 'Add New Coupon', 'unmarked' ),
				'edit' => __( 'Edit', 'unmarked' ),
				'edit_item' => __( 'Edit Coupon', 'unmarked' ),
				'new_item' => __( 'New Coupon', 'unmarked' ),
				'view_item' => __( 'View Coupon', 'unmarked' ),
				'search_items' => __( 'Search Coupon', 'unmarked' ),
				'not_found' =>  __( 'Nothing found in the Database.', 'unmarked' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'unmarked' ),
				'parent_item_colon' => ''
			), /* end of arrays */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon' => 'dashicons-products',
			'rewrite'	=> array( 'slug' => 'coupon', 'with_front' => false ),
			'has_archive' => 'coupons',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt')
		) /* end of options */
	); /* end of register post */
}
add_action( 'init', 'coupons_post_type');  /* adding the function to the Wordpress init */
	
// now let's add coupons categories
register_taxonomy( 'coupon_cat', 
	array('coupons'), /* register_post_type */
	array('hierarchical' => true,
		'labels' => array(
			'name' => __( 'Categories', 'unmarked' ),
			'singular_name' => __( 'Category', 'unmarked' ),
			'search_items' =>  __( 'Search Categories', 'unmarked' ),
			'all_items' => __( 'All Coupon Categories', 'unmarked' ),
			'parent_item' => __( 'Parent Coupon Category', 'unmarked' ),
			'parent_item_colon' => __( 'Parent Coupons Category:', 'unmarked' ),
			'edit_item' => __( 'Edit Coupon Category', 'unmarked' ),
			'update_item' => __( 'Update Coupon Category', 'unmarked' ),
			'add_new_item' => __( 'Add New Coupon Category', 'unmarked' ),
			'new_item_name' => __( 'New Coupon Category', 'unmarked' )
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'coupons' ),
	)
);
	
// let's create the function for the Services Post
function services_post_type() { 
	register_post_type( 'services',
		// let's now add all the options for this post
			array( 'labels' => 	
				array(
					'name' => __( 'Services', 'unmarked' ),
					'singular_name' => __( 'Services', 'unmarked' ),
					'all_items' => __( 'All Services', 'unmarked' ),
					'add_new' => __( 'Add New', 'unmarked' ),
					'add_new_item' => __( 'Add New Service', 'unmarked' ),
					'edit' => __( 'Edit', 'unmarked' ),
					'edit_item' => __( 'Edit Service', 'unmarked' ),
					'new_item' => __( 'New Service', 'unmarked' ),
					'view_item' => __( 'View Service', 'unmarked' ),
					'search_items' => __( 'Search Service', 'unmarked' ),
					'not_found' =>  __( 'Nothing found in the Database.', 'unmarked' ),
					'not_found_in_trash' => __( 'Nothing found in Trash', 'unmarked' ),
					'parent_item_colon' => '',
				), /* end of arrays */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 9,
			'menu_icon' => 'dashicons-layout',
			'rewrite'	=> array( 'slug' => 'service', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => false,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail')
		) /* end of options */
	); /* end of register post */
}
add_action( 'init', 'services_post_type'); /* adding the function to the WordPress init */
	
	
// now let's add custom categories (these act like categories)
register_taxonomy( 'services_cat', 
	array('services'), /* name of register_post_type */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'Categories', 'unmarked' ),
			'singular_name' => __( 'Category', 'unmarked' ),
			'search_items' =>  __( 'Search Categories', 'unmarked' ),
			'all_items' => __( 'All Service Categories', 'unmarked' ),
			'parent_item' => __( 'Parent Service Category', 'unmarked' ),
			'parent_item_colon' => __( 'Parent Service Category:', 'unmarked' ),
			'edit_item' => __( 'Edit Service Category', 'unmarked' ),
			'update_item' => __( 'Update Service Category', 'unmarked' ),
			'add_new_item' => __( 'Add New Service Category', 'unmarked' ),
			'new_item_name' => __( 'New Service Category', 'unmarked' )
		),
		'show_admin_column' => true, 
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'services' ),
	)
);

/*
 * Replace Taxonomy slug with Post Type slug in url
 * Version: 1.1
 */
function taxonomy_slug_rewrite($wp_rewrite) {
    $rules = array();
    // get all custom taxonomies
    $taxonomies = get_taxonomies(array('services_cat' => false), 'objects');
    // get all custom post types
    $post_types = get_post_types(array('public' => true, 'services' => false), 'objects');
    
    foreach ($post_types as $post_type) {
        foreach ($taxonomies as $taxonomy) {
	    
            // go through all post types which this taxonomy is assigned to
            foreach ($taxonomy->object_type as $object_type) {
                
                // check if taxonomy is registered for this custom type
                if ($object_type == $post_type->rewrite['slug']) {
		    
                    // get category objects
                    $terms = get_categories(array('type' => $object_type, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0));
		    
                    // make rules
                    foreach ($terms as $term) {
                        $rules[$object_type . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
                    }
                }
            }
        }
    }
    // merge with global rules
    $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}
add_filter('generate_rewrite_rules', 'taxonomy_slug_rewrite');

?>
