<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Pages
 * @since 1.0
 * @author Amelia
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-hero">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Szukana fraza: %s', 'pi' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-hero -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();



			endwhile;

			the_posts_navigation();

		else :


		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
