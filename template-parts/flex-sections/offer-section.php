<?php

/**
 * Offer section
 * 
 * Renders a offer flex section. This section has two layouts modes,
 * a bootstrap-tiled list and a carousel.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 * @todo merge with team section and make a generic post display section?
 */
//flex section data
$group = get_sub_field('group');
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
$text = $group['text'];
$layout = $group['layout'];
$post_type = $group['post_type'];

//layout also determines which offers might get fetched according to diplay taxonomy
if ($layout == 'carousel') {
  $class = 'offer-section--carousel';
  $taxName = 'show-in-carousel';
} else {
  $class = 'offer-section--list';
  $taxName = 'show-in-list';
}
//fetching the offers
//in theory this section could be used to display any arbitrary CPT, as long as it conforms to the template
$args = array(
  'type' => 'post',
  //'post_type' => $post_type,
  'post_type' => 'offer',
  'posts_per_page' => -1,
  'no_found_rows' => true,
  'tax_query'  => array(
    array(
      'taxonomy' => 'offer-display',
      'field' => 'slug',
      'terms' => $taxName
    )
  )
);
$loop = new WP_Query($args);
?>
<div class="offer-section <?php echo $class; ?> section-margin-bottom">
  <div class="container">
    <div class="row">
      <?php
      // CAROUSEL LAYOUT
      if ($layout == 'carousel') :
        if ($loop->have_posts()) : ?>
          <div class="col-lg-7">
            <div class="owl-offer owl-carousel owl-carousel--aside-nav owl-theme">
              <?php
              while ($loop->have_posts()) : $loop->the_post(); ?>
                <div class="item">
                  <?php get_template_part('template-parts/modules/preview-offer', null, array('post_id' => get_the_ID())); ?>
                </div>
              <?php
              endwhile; ?>
            </div>
          </div>
        <?php
        endif;
      // LIST LAYOUT 
      else :
        if ($loop->have_posts()) : ?>
          <!-- <div class="row"> -->
          <?php
          while ($loop->have_posts()) : $loop->the_post(); ?>
            <div class="col-lg-3 col-md-6">
              <?php get_template_part('template-parts/modules/preview-offer', null, array('post_id' => get_the_ID())); ?>
            </div>
          <?php
          endwhile; ?>
          <!-- </div> -->
      <?php
        endif;
      endif;
      wp_reset_postdata(); ?>

    </div>
  </div>
</div>