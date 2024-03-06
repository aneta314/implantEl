<?php
/**
 * Header template part
 * 
 * Technically not a template part. This renders the header on every page.
 * Actual header content depends on page/landing page type and device resolution (mobile/desktop)
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-id="<?php echo get_the_ID(); ?>">

	<?php //LOADER - disabled
	/*<div id="loading-cover" class="loading-cover">
		<img src="<?php echo get_template_directory_uri();?>/img/svg/logo.svg" alt="<?php echo bloginfo('title'); ?>">
	</div>*/
	?>
	<div id="page" class="site">

		<?php if(!is_singular('lp')): ?>

			<?php //MOBILE HEADER ?>
			<div class="d-xl-none">
				<?php get_template_part( 'template-parts/sections/header-mobile' ); ?>
			</div>

			<?php //DESKTOP HEADER ?>
			<div class="d-none d-xl-block">
				<?php get_template_part( 'template-parts/sections/header-desktop' ); ?>
			</div>

		<?php else: ?>

			<?php //LANDING PAGE HEADER ?>
			<?php get_template_part( 'template-parts/sections/header-landing' ); ?>

		<?php endif; ?>
		<div id="content" class="site-content">
