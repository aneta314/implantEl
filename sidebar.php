<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */

?>

<aside class="sidebar">

  <?php

  // single offer
  if(is_singular('offer')):

    // DOCTORS
    get_template_part('template-parts/sidebar-parts/doctors-carousel');

  endif;



  // single blog post or blog tempalte or blog category
  if(is_singular('post') || is_page_template('templates/blog.php') || is_category() || is_tax('offer-relationship')):


    // CATEGORIES LIST
    get_template_part('template-parts/sidebar-parts/terms-list');

  endif;



  // single blog post
  if(is_singular('post')):

    // LATEST POSTS
    get_template_part('template-parts/sidebar-parts/latest-posts');

  endif;


	// single blog post or blog tempalte or blog category
	if(is_singular('post') || is_page_template('templates/blog.php') || is_category() || is_tax('offer-relationship')):

		// ABOUT
    get_template_part('template-parts/sidebar-parts/about-author');

	endif;




  // single offer or pricelist template
  if(is_singular('offer') || is_page_template('templates/pricelist.php')):

    // PAYMENTS
    get_template_part('template-parts/sidebar-parts/payments');

  endif;




  // pricelist template
  if(is_page_template('templates/pricelist.php')):

    // PRICES RULE
    get_template_part('template-parts/sidebar-parts/prices-rule');

  endif;




  // single offer or pricelist template
  if( is_singular('offer') || is_page_template('templates/pricelist.php')):

    // CTA - BOOK AN APPOINTMENT
    get_template_part('template-parts/sidebar-parts/book-appt');

  endif; ?>


</aside>
