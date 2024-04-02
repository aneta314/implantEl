<?php

/**
 * Blog posts archive page content
 * 
 * Fetches and displays blog posts. This is paginated and filtered by taxonomy.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
$posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 6;
$col_classes = isset($args['cols']) ? $args['cols'] : '';
$should_page = isset($args['paged']) ? $args['paged'] : true;
$skip_rearrange = isset($args['pi_skip_rearrange']) ? $args['pi_skip_rearrange'] : false;
?>

<div class="template-blog-content section-margin-bottom <?php echo $col_classes == '' ? '' : 'row'; ?>">

  <?php //pagination stuff
  $queried_object = get_queried_object();
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $args = array(
    'type' => 'post',
    'post_type' => 'post',
    'order' => 'DESC',
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
  );
  if ($skip_rearrange) $args['pi_skip_rearrange'] = $skip_rearrange;

  // IF IS TAXONOMY ARCHIVE PAGE
  if ($queried_object->taxonomy) {
    $taxonomy_args = array(
      'tax_query' =>
      array(
        'relation' => 'AND',
        array(
          'taxonomy' => $queried_object->taxonomy,
          'field' => 'slug',
          'terms' => array($queried_object->slug),
          'include_children' => true,
          'operator' => 'IN'
        )
      )
    );

    //array merging is an easy way to create conditionally generated query args
    $args = array_merge($args, $taxonomy_args);
  }

  $loop = new WP_Query($args);

  if ($loop->have_posts()) : ?>
    <div class="row">
      <?php while ($loop->have_posts()) : $loop->the_post();

        // POST PREVIEW
        get_template_part('template-parts/modules/preview-post', null,  array('class' => $col_classes));

      endwhile; ?>
      <?php if ($should_page) :
        //PAGINATION 
      ?>
        <div class="pagination">
          <?php custom_pagination($loop, '', ''); ?>
        </div>
      <?php endif; ?>
    <?php
  endif;
  wp_reset_postdata(); ?>
    </div>
</div>