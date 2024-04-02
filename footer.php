<?php

/**
 * Footer template part
 * 
 * Technically not a template part. This renders the footer on every page.
 * Some pages render different things in their footers, eg. contact page rendering a map
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */ ?>
</div> <!-- #content -->
<?php //not for landing pages
if (!is_singular('lp')) : ?>

	<?php //TESTIMONIALS 
	if (!is_page_template('templates/contact.php')) :
		get_template_part('template-parts/sections/testimonials');
	endif; ?>

	<?php //CONTACT SECTION
	get_template_part('template-parts/sections/contact-section'); ?>

	<?php //MAP
	if (is_page_template('templates/contact.php')) :
		get_template_part('template-parts/sections/map');
	endif; ?>

<?php endif; ?>


<div class="sub-footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-4 col-lg-4">
				<?php
				//array of logo data
				$logo = get_field('logo', 'options'); ?>
				<a class="sub-footer__logo-anchore" href="<?php echo site_url(); ?>">
					<img class="sub-footer__logo" src="<?php echo $logo['url']; ?>" alt="<?php if ($logo['alt'] != '') : echo $logo['alt'];
																							else : bloginfo('title');
																							endif; ?>">
				</a>

				<p class="sub-footer__text"><?php pi_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque euismod facilisis augue, sed efficitur nulla varius vitae. Vestibulum vitae consectetur libero..', 'pi'); ?> </p>

				<!-- SOCIAL MEDIA -->
				<?php /*
				$social_media = get_field('social_media', 'options');
				if ($social_media) : ?>
					<div class="social-media">
						<?php
						foreach ($social_media as $medium) : ?>
							<a href="<?php echo $medium['url']; ?>" class="social-media__item" target="_blank">
								<?php get_social_media_icon($medium['social_media']); ?>
							</a>
					<?php
						endforeach;
					endif; */ ?>

				<!-- </div> -->
			</div>

			<div class="col-lg-8">
				<div class="row">
					<div class="col-xs-3 col-lg-3">
						<h4 class="sub-footer__headline"> <?php pi_e('Menu', 'pi'); ?></h4>
						<nav class="sub-footer1">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'footer-1',
								'menu_id'        => 'footer-1',
							));
							?>
						</nav>
					</div>
					<div class="col-xs-5 col-lg-5">
						<h4 class="sub-footer__headline"> <?php pi_e('Oferta', 'pi'); ?></h4>
						<nav class="sub-footer2">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'footer-2',
								'menu_id'        => 'footer-2',
							));
							?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<footer class="footer section-padding-sm">
	<div class="container">
		<div class="row footer-flex">
			<p> <?php echo get_bloginfo('name'); ?> &copy; <?php echo date('Y'); ?>. <?php pi_e('Wszystkie prawa zastrzeżone.', 'pi'); ?></p>
			<?php //this does not need to be translated - leave it as-is 
			?>
			<p> Zaprojektowano i wykonano przez<a href="https://stomatologia.314.pl/" target="_blank"> stomatologia.314.pl </a> </p>
		</div>
	</div>
</footer><!-- #colophon -->

<?php //SCROLL UP
get_template_part('template-parts/modules/scroll-up'); ?>

<?php //POPUP
get_template_part('template-parts/modules/popup'); ?>

<?php //CALL US BUTTON
get_template_part('template-parts/modules/call-to-us'); ?>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>