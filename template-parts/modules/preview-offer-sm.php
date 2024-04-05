<?php

/**
 * Small offer preview module
 * 
 * Shows a small offer preview tile. Mainly used in 'related offers' sections
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//id of the related offer
$post_id = $args['post_id']; ?>
<?php /* if (is_singular('offer')) : ?>

  <div class="preview-offer-sm">

    <div class="preview-offer-sm__photo">
      <?php echo get_the_post_thumbnail($post_id, 'thumbnail', array('title' => get_the_title($post_id), 'class' => 'absolute-img'));
      ?>
    </div>
    <h5 class="preview-offer-sm__title"><?php echo get_the_title($post_id, array('class' => 'title'));
                                        ?></h5>
  </div>



<?php else :  */ ?>
<div class="preview-offer-sm">

  <div class="preview-offer-sm__photo">
    <?php echo get_the_post_thumbnail($post_id, 'thumbnail', array('title' => get_the_title($post_id), 'class' => 'absolute-img')); ?>
  </div>

  <div class="preview-offer-sm__column">
    <h5 class="preview-offer-sm__title"><?php echo get_the_title($post_id, array('class' => 'title')); ?></h5>
    <a href="<?php echo get_the_permalink($post_id); ?>" class="btn--secondary preview-offer-sm__link"><?php echo 'Zobacz usługę'; ?></a>
  </div>
</div>
<?php // endif; 
?>