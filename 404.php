<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">


			<?php
			// PAGE HEADER
			get_template_part('template-parts/sections/page-hero'); ?>


			<div class="container section-margin-bottom">
				<div class="standard-format center">
					<h2 class="headline"> <?php pi_e('Strona jest niedostępna', 'pi'); ?></h2>
					<p><?php pi_e('Link może być uszkodzony lub strona mogła zostać usunięta.', 'pi'); ?>  </p>
					<a href="<?php echo site_url(); ?>" class="btn"> <?php pi_e('Strona główna', 'pi'); ?></a>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
