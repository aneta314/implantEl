<?php

/**
 * Latest posts sidebar element
 * 
 * Sidebar part that renders a few post thumbnails. Mainly used in single posts.
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

// grabs the terms for the current post and pushes them onto a term array for use in a query
//this way the query will only get "related" posts
$terms = get_the_terms(get_the_ID(), 'category');
$terms_ids = array();
$permalink = get_the_permalink(365);
foreach ($terms as $term) {
  array_push($terms_ids, $term->term_id);
}

//query args
$args = array(
  'type' => 'post',
  'post_type' => 'post',
  'posts_per_page' => 3,
  'post__not_in' => array(get_the_ID()),
  'category__in' => $terms_ids,
);

$loop = new WP_Query($args);

if ($loop->have_posts()) : ?>
  <div class="sidebar__item">
    <h5 class="headline headline--xs"><?php pi_e('Ostatnie wpisy', 'pi'); ?></h5>

    <?php while ($loop->have_posts()) : $loop->the_post(); ?>

      <?php get_template_part('template-parts/modules/preview-post-sm', null, array('post_id' => get_the_ID()));  ?>

    <?php endwhile; ?>
    <div class="standard-format">

      <div class="d-flex mb-3 mt-3">
        <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Wszystkie wpisy', 'pi'); ?> </a>
      </div>
    </div>
  </div>


<?php endif;
wp_reset_postdata(); ?>