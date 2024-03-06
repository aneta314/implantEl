<?php
/**
 * Metamorphosis page template content
 * 
 * Actual content of a metamorphosis page template. This is paginated.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<div class="template-metamorphosis-content section-margin-bottom">
  <div class="container">

    <?php //pagination stuff
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

    $args = array(
      'type' => 'post',
      'post_type' => 'metamorphosis',
      'order' => 'ASC',
      'posts_per_page' => 6, //paginate by X
      'paged' => $paged,
    );

    $loop = new WP_Query( $args );

    if( $loop->have_posts() ): ?>
      <div class="row">
        <?php
        while( $loop->have_posts() ): $loop->the_post(); ?>
          <div class="col-lg-6">

            <?php
            // METAMORPHOSIS PREVIEW
            get_template_part('template-parts/modules/preview-metamorphosis', null, array('post_id' => get_the_ID())); ?>

          </div>
        <?php
        endwhile; ?>
      </div>

      <?php //PAGINATION ?>
      <div class="pagination">
        <?php custom_pagination($loop, '', ''); ?>
      </div>
    <?php
    endif;
    wp_reset_postdata(); ?>
  </div>
</div>
