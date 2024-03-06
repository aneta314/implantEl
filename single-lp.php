<?php
/**
 * The template for displaying landing pages
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
			// FLEX CONTENT
			get_template_part('template-parts/contents/flex-content');

			// STICKY CTA
			get_template_part('template-parts/modules/lp-cta-sticky');

			// POP UP - FORM
			get_template_part('template-parts/modules/popup-single-lp');
			?>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
