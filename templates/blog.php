<?php
/* Template Name: Blog */
/**
 * blog page template
 * 
 * Renders the blog page, i.e. a list of posts. This page doesn't actually determine the rendering
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Templates
 * @since 1.0
 * @author Amelia
 */
get_header();
?>

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

<?php
get_footer();
