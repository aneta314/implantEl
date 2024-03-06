<?php
/**
 * CPT functions file
 * 
 * This file is attached to functions.php and used to generate all CPT-related
 * elements like post types, custom taxonomies and so on.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Functions
 * @since 1.0
 * @author Amelia
 */

 /**
  * Generates custom post types
  *
  * All custom post types are generated here. 
  * This function is a callback to the 'init' action
  *
  * @author Amelia
  * @since 1.0
  * @link https://developer.wordpress.org/reference/functions/register_post_type/
  */
function pi_post_types() {

	// DENTAL OFFER
	register_post_type('offer', array(
	  'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'revisions'),
	  'rewrite' => array('slug' => 'stomatologia'),
	  'has_archive' => false,
	  'public' => true,
	  'publicly_queryable' => true,
	  'hierarchical' => true,
		'menu_position' => 20,
	  'labels' => array(
			'name' => 'Stomatologia',
			'add_new_item' => 'Dodaj usługę',
			'edit_item' => 'Edytuj usługę',
			'all_items' => 'Wszystkie usługi',
			'singular_name' => 'Usługa',
			'add_new' => 'Dodaj usługę'
	  ),
	  'menu_icon' => 'dashicons-star-filled'
	));

	// AESTHETIC MEDICINE OFFER
	register_post_type('medicine', array(
	  'supports' => array('title', 'excerpt', 'editor', 'thumbnail', 'revisions'),
	  'rewrite' => array('slug' => 'medycyna-estetyczna'),
	  'has_archive' => false,
	  'public' => true,
	  'publicly_queryable' => true,
	  'hierarchical' => true,
		'menu_position' => 21,
	  'labels' => array(
			'name' => 'Med. estetyczna',
			'add_new_item' => 'Dodaj usługę',
			'edit_item' => 'Edytuj usługę',
			'all_items' => 'Wszystkie usługi',
			'singular_name' => 'Usługa',
			'add_new' => 'Dodaj usługę'
	  ),
	  'menu_icon' => 'dashicons-star-filled'
	));

	// LADING PAGES
	register_post_type('lp', array(
	   'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
	   'rewrite' => array('slug' => 'oferta-specjalna'),
	   'has_archive' => false,
	   'public' => true,
	   'publicly_queryable' => true,
	   'hierarchical' => false,
			'menu_position' => 22,
	   'labels' => array(
				'name' => 'Landing Pages',
				'add_new_item' => 'Dodaj landing',
				'edit_item' => 'Edytuj landing',
				'all_items' => 'Wszystkie landingi',
				'singular_name' => 'Landing Page',
				 'add_new' => 'Dodaj nowy'
	   ),
	   'menu_icon' => 'dashicons-star-empty'
	));

	// TEAM
	register_post_type('team', array(
	   'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
	   'rewrite' => array('slug' => 'zespol'),
	   'has_archive' => false,
	   'public' => true,
	   'publicly_queryable' => true,
	   'hierarchical' => false,
			'menu_position' => 23,
	   'labels' => array(
				'name' => 'Zespół',
				'add_new_item' => 'Dodaj osobę',
				'edit_item' => 'Edytuj osobę',
				'all_items' => 'Wszystkie osoby',
				'singular_name' => 'Członek zespołu',
				 'add_new' => 'Dodaj nową'
	   ),
	   'menu_icon' => 'dashicons-groups'
	));

	// METAMORPHOSIS
	register_post_type('metamorphosis', array(
	   'supports' => array('title', 'editor', 'revisions'),
	   'rewrite' => array('slug' => 'metamorfoza'),
	   'has_archive' => false,
	   'public' => true,
	   'publicly_queryable' => false,
	   'hierarchical' => false,
			'menu_position' => 24,
	   'labels' => array(
				'name' => 'Metamorfozy',
				'add_new_item' => 'Dodaj metamorfozę',
				'edit_item' => 'Edytuj metamorfozę',
				'all_items' => 'Wszystkie metamorfozy',
				'singular_name' => 'Metamorfoza',
				 'add_new' => 'Dodaj nową'
	   ),
	   'menu_icon' => 'dashicons-smiley'
	));

}
add_action('init', 'pi_post_types');

/**
 * Registers custom theme taxonomies
 * 
 * All custom taxonomies are registered here. Some of these taxonomies are read-only
 * and serve as more of an identifier than a taxonomical element.
 * This function is a callback to the 'init' action
 * 
 * @author Amelia
 * @since 1.0
 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
 * @see pi_add_offer_display_taxonomy() adds terms to the offer-display readonly taxonomy
 */
function pi_taxonomies() {
  register_taxonomy('team-category', array('team'), array(
	  'hierarchical' => true,
	  'show_ui' => true,
	  'show_admin_column' => true,
	  'query_var' => true,
	  'publicly_queryable' => false,
		'labels' => array(
	    'name' => 'Kategoria personelu',
	    'singular_name' => 'Kategoria',
	    'search_items' => 'Przeszukaj kategorie',
	    'all_items' => 'Wszystkie kategorie',
	    'edit_item' => 'Edycja kategorii',
	    'add_new_item' => 'Dodaj nową',
	    'menu_name' => 'Kategorie personelu',
	  )
   ));
   //display readonly taxonomy. add terms in function below
   register_taxonomy('offer-display', array('offer', 'medicine', 'team'), array(
		'label' => 'Wyświetlanie postów',
		'hierarchical' => true,
		'show_admin_column' => true, //offer list column
		'public' => false, //disable for public, but keep admin ui
		'show_ui' => true,
		'capabilities' => array( //can assign, can't edit, add, delete etc, i.e. it's a read-only taxonomy
			'assign_terms' => 'edit_posts',
			'manage_terms' => null,
			'edit_terms' => null,
			'delete_terms' => null,
		),
 	));
	//display a readonly offer relationship taxonomy. add terms in function below
	//functionality relating to this taxonomy is contained in the pi-dynamics.php file
	//dynamically_sorted_post_types field contains post types that WILL be rearranged according to relationship logic
	//post_types_with_offer_relationship contains post types that WILL NOT be rearranged. It's attached to a post type to act specifically as a taxonomy.
	if(!class_exists('ACF')) return; //acf is disabled, skip
	$dynamicallySorted = get_field('dynamically_sorted_post_types', 'options') ?? []; //null coalesce for array_merge if field wasn't initialized
	$withOfferRel = get_field('post_types_with_offer_relationship', 'options') ?? [];

	$cptToAttach =  array_merge($dynamicallySorted, $withOfferRel);
	register_taxonomy('offer-relationship', $cptToAttach, array(
		'labels' => array(
			'name' => 'Kategorie ofert',
			'singular_name' => 'Kategoria',
		),
		'rewrite' => array(
			'slug' => 'offer-category',
			'with_front' => false
		),
		'hierarchical' => true,
		'show_admin_column' => true, //offer list column
		'public' => true, //this is displayed in front
		'show_ui' => true,
		'show_in_menu' => false, //we're adding a custom menu somehwere elese
		'capabilities' => array( //can assign, can't edit, add, delete etc, i.e. it's a read-only taxonomy. manage_terms is active to display the taxonomy page
			'assign_terms' => 'edit_posts',
			'manage_terms' => 'manage_categories',
			'edit_terms' => null,
			'delete_terms' => 'manage_categories',
		),
 	));
}
add_action('init', 'pi_taxonomies');

/**
 * Remove default categories widget in posts
 * 
 * @author MichalB
 * @since 1.1
 */
function unregister_categories_for_posts(){
	unregister_widget( 'WP_Widget_Categories' ); //remove the cat widget
}
add_action('init', 'unregister_categories_for_posts');

/**
 * Remove default categories submenu in the posts menu
 * 
 * @author MichalB
 * @since 1.1
 */
function remove_menus(){
	remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // Post tags
}
add_action( 'admin_menu', 'remove_menus' );

/**
 * Return a 404 response on accessing a category page (essentially removes categories)
 * 
 * @author MichalB
 * @since 1.1
 */
function my_page_template_redirect(){
    if ( is_category(  ) ) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 ); exit();
    }
}
add_action( 'template_redirect', 'my_page_template_redirect' );

/*
=====================================
	RENAME DEFAULT POSTS
=====================================
*/
// function cp_change_post_object() {
//     $get_post_type = get_post_type_object('post');
//     $labels = $get_post_type->labels;
//         $labels->name = 'Aktualności';
//         $labels->singular_name = 'Aktualność';
//         $labels->add_new = 'Dodaj nową';
//         $labels->add_new_item = 'Dodaj nową';
//         $labels->edit_item = 'Edytuj wpis';
//         $labels->new_item = 'Aktualność';
//         $labels->view_item = 'Zobacz wpis';
//         $labels->search_items = 'Przeszukaj aktualności';
//         $labels->not_found = 'Nie znaleziono';
//         $labels->not_found_in_trash = 'Nie znaleziono wpisów w koszu';
//         $labels->all_items = 'Wszystkie aktualności';
//         $labels->menu_name = 'Aktualności';
//         $labels->name_admin_bar = 'Aktualności';
// }
//
// add_action( 'init', 'cp_change_post_object' );