<?php

/**
 * Post terms module
 * 
 * Lists terms associated with the specified post id and taxonomy
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//post id to extract the terms of
$post_id = $args['post_id'];
//taxonomy type
$taxonomy = $args['taxonomy'];

$terms = wp_get_post_terms($post_id, $taxonomy);
?>

<div class="post-terms align-items-center">
  <p>
    <?php echo 'Kategoria:'; ?>
  </p>
  <?php
  foreach ($terms as $term) :  ?>

    <a href="<?php echo get_term_link($term->term_id, $taxonomy); ?>" class="post-terms__item">
      <?php echo $term->name; ?>
    </a>
  <?php
  endforeach; ?>
</div>