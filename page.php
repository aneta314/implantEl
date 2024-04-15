<?php

/**
 * The template for displaying all single posts
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

		if (is_page(77)) : ?>
			<div class="offer-text container">
				<p class="intro">Czym się zajmujemy?</p>
				<div class="standard-format">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis malesuada rhoncus. Curabitur elementum et sapien in pretium. Quisque placerat pulvinar enim nec scelerisque. In ac lectus non dui egestas bibendum. Cras tempus nulla id est pulvinar ornare. </p>
				</div>
			</div>
		<?php endif; ?>

		<?php // FLEX CONTENT
		get_template_part('template-parts/contents/flex-content'); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
