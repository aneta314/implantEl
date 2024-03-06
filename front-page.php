<?php 
/**
 *  front page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#front-page-display
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php //HERO
			get_template_part('template-parts/sections/hero'); ?>

			<?php //FLEX CONTENT
			get_template_part('template-parts/contents/flex-content'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer();
