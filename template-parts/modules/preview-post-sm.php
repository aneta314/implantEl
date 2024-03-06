<?php
/**
 * Small post preview module
 * 
 * Shows a smaller version of a post preview tile, eg. used in 'latest posts' section
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

$post_id = $args['post_id']; // ids ?>

<a href="<?php echo get_permalink($post_id); ?>" class="preview-post-sm">

  <div class="preview-post-sm__col">
    <!-- THUMBNAIL -->
    <?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array('class' => 'preview-post-sm__img') ); ?>
  </div>

  <div class="preview-post-sm__col">
    <!-- DATE -->
    <p class="preview-post-sm__date"><?php echo get_the_date('j F Y', $post_id); ?></p>

    <!-- TITLE -->
    <h4 class="preview-post-sm__title"><?php echo get_the_title($post_id); ?></h4>

  </div>

</a>
