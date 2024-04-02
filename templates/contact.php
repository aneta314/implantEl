<?php
/* Template Name: Kontakt */

/**
 * Contact page template
 * 
 * Renders the contact page template. This page doesn't actually determine the rendering
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


		// CONTACT CONTENT
		// get_template_part('template-parts/contents/template-contact-content');
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
