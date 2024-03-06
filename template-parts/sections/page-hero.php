<?php
/**
 * Page hero section
 * 
 * Page hero is displayed on every page except for the front page and landing pages.
 * It contains a small hero banner with breadcrumbs, page name and social media buttons
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */
?>

<div class="page-hero section-padding section-margin-bottom">
  <!-- SOCIAL MEDIA -->
  <?php get_template_part( 'template-parts/modules/social-media' ); ?>

  <div class="container">

    <?php if(is_archive()): ?>
      <h1 class="headline headline--mb-lg"><?php the_archive_title(); ?></h1>
    <?php elseif(is_404()): ?>
      <h1 class="headline headline--mb-lg"><?php pi_e('Błąd 404', 'pi'); ?> </h1>
    <?php else: ?>
      <h1 class="headline headline--mb-lg"><?php the_title(); ?></h1>
    <?php endif; ?>

    <?php get_template_part( 'template-parts/modules/breadcrumbs' ); ?>
  </div>
</div>
