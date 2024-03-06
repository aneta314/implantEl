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
 */?>
	</div> <!-- #content -->
	<?php //not for landing pages
	if(!is_singular('lp')): ?>

		<?php //TESTIMONIALS 
		if(!is_page_template('templates/contact.php')):
			get_template_part('template-parts/sections/testimonials');
		endif; ?>

		<?php //CONTACT SECTION
		get_template_part('template-parts/sections/contact-section'); ?>

		<?php //MAP
		if(is_page_template('templates/contact.php')):
			get_template_part('template-parts/sections/map');
		endif; ?>

	<?php endif; ?>

	<footer class="footer section-padding-sm">
		<div class="container">

			<p>&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?>. <?php pi_e('Wszystkie prawa zastrzeżone.', 'pi'); ?></p>
			<?php //this does not need to be translated - leave it as-is ?>
			<p> Created with passion by <a href="https://stomatologia.314.pl/" target="_blank"> stomatologia.314.pl </a> </p>
		</div>
	</footer><!-- #colophon -->

	<?php //SCROLL UP
	get_template_part( 'template-parts/modules/scroll-up' ); ?>

	<?php //POPUP
	get_template_part( 'template-parts/modules/popup' ); ?>

	<?php //CALL US BUTTON
	get_template_part( 'template-parts/modules/call-to-us' ); ?>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
