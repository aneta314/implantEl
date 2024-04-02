<?php

/**
 * Team member preview module
 * 
 * Shows a team member preview tile. Used in team sections, doctor carousels, etc.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

$post_id = $args['post_id']; // ids 
?>

<div href="<?php echo get_the_permalink($post_id); ?>" class="preview-person">
  <div class="preview-person__photo">

    <?php echo get_the_post_thumbnail($post_id, 'medium_large', array('title' => get_the_title($post_id), 'class' => 'absolute-img')); ?>

  </div>
  <div class="preview-person__right-side">
    <h3 class="preview-person__title"><?php echo get_the_title($post_id); ?></h3>
    <p class="preview-person__position"><?php the_field('position', $post_id); ?></p>
    <p class="preview-person__excerpt"><?php the_excerpt($post_id); ?></p>

    <?php if (get_the_content(null, false, $post_id) != '') :  ?>
      <div class="d-flex mt24">
        <a href="<?php echo get_the_permalink($post_id); ?>" class="btn"><?php pi_e('Dowiedz się więcej', 'pi'); ?></a>
      </div>
    <?php endif; ?>
  </div>
</div>