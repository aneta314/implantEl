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
get_header();
// $group = get_sub_field('group');
// $title = $group['title'];
// $intro = $group['intro'];
// $text = $group['text'];
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		// PAGE HEADER
		get_template_part('template-parts/sections/page-hero');

		/*if (is_page(77)) : ?>
			<div class="offer-text container">
				<div class="standard-format">
					<?php if ($intro) : ?>
						<div class="intro"><?php echo $intro; ?></div>
					<?php endif; ?>
					<?php if ($title) : ?>
						<h2 class="headline title"><?php echo $title; ?></h2>
					<?php endif; ?>
					<?php if ($text) : ?>
						<p><?php echo $text;
							?></p>
					<?php endif; ?>
				</div>
			<?php endif; */ ?>

		<?php // FLEX CONTENT
		get_template_part('template-parts/contents/flex-content'); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
