<?php
/* Template Name: Metamorfozy */
/**
 * Metamorphosis page template
 * 
 * Renders the metamorphosis list. Metamorphoses are a repeater field. This page doesn't actually determine the rendering
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


			// METAMORPHOSIS CONTENT
			get_template_part('template-parts/contents/template-metamorphosis-content'); ?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
