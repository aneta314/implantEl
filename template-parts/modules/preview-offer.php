<?php

/**
 * Offer preview module
 * 
 * Shows a offer preview tile. User wherever an offer tile is needed.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
$post_id = $args['post_id']; // ids 
?>

<a href="<?php echo get_the_permalink($post_id); ?>" class="preview-offer">
  <div class="preview-offer__photo">
    <?php echo get_the_post_thumbnail($post_id, 'medium_large', array('title' => get_the_title($post_id), 'class' => 'absolute-img')); ?>
  </div>
  <h3 class="preview-offer__title"><?php echo get_the_title($post_id); ?></h3>
</a>