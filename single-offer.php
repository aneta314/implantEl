<?php
/**
 * The template for displaying all single offer posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */
 get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

      <?php
			// PAGE HEADER
			get_template_part('template-parts/sections/page-hero');


      // SIDEBAR LAYOUT
			get_template_part('template-parts/layouts/sidebar-layout');
      ?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
