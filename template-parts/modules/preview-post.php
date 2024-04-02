<?php

/**
 * Post preview module
 * 
 * Shows a post preview tile. Used in post listings etc.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
$class = isset($args['class']) ? $args['class'] : ''; ?>

<div class="preview-post col-lg-6 <?php echo $class; ?>">

  <!-- <div class="row"> -->

  <div class="preview-post__image">
    <!-- IMAGE -->
    <a href="<?php echo get_the_permalink(); ?>">
      <?php echo get_the_post_thumbnail(get_the_ID(), 'large',  array('title' => get_the_title(get_the_ID()), 'class' => 'preview-post__img')); ?>
    </a>
  </div>

  <div class="">
    <!-- DATE -->
    <p class="preview-post__date"><?php echo get_the_date('j F Y'); ?></p>

    <!-- TITLE -->
    <h4 class="headline headline--sm preview-post__title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>

    <!-- POST TERMS -->
    <?php //get_template_part('template-parts/modules/post-terms', null, array('post_id' => get_the_ID(), 'taxonomy' => 'offer-relationship')); 
    ?>


    <div class="standard-format">
      <!-- EXCERPT -->
      <div class="preview-post__excerpt">
        <?php the_excerpt(); ?>
      </div>
    </div>

    <!-- BTN -->
    <a href="<?php echo get_the_permalink(); ?>" class="btn"><?php pi_e('Zobacz wpis', 'pi'); ?></a>

    <!-- </div> -->
  </div>
</div>

<!-- </div> -->