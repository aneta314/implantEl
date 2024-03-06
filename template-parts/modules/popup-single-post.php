<?php 
/**
 * Single post popup module
 * 
 * Single post popup, used in single posts that have a related offer.
 * This will automatically show after a specified percentage of the page has been scrolled
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

$relationship_tax = $args['relationship_tax'];
if($relationship_tax):
  $args = array(
    'posts_per_page' => 1,
    'post_type' => array('offer', 'medicine'),
    'post_status' => 'publish',
    'tax_query' => array(
      array(
        'taxonomy' => 'offer-relationship',
        'field' => 'term_id',
        'terms' => $relationship_tax->term_id
      )
    ),
  );
  $related_posts = new WP_Query($args);
  if( $related_posts->have_posts() ):
    $related_post = array_shift($related_posts->posts);?>
    <!-- SINGLE POST POP UP -->
    <div class="popup" show-after-scroll-procent="40">

      <!-- BACKGROUND -->
      <div class="popup__bg"></div>

      <!-- BOX -->
      <div class="popup__box">

        <!-- CLOSE -->
        <div class="popup__close"> <i class="icon-close"></i> </div>

        <!-- SINGLE POST CONTENT -->
        <?php get_template_part('template-parts/contents/popup-single-post', null, array('related_offer' => $related_post)); ?>

      </div>
    </div>
  <?php endif;
  wp_reset_postdata();
endif;?>