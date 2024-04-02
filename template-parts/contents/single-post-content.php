<?php

/**
 * Single post content template
 * 
 * Actual content of a single blog post, with all the related elements.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */

// READING PROGRESS BAR
get_template_part('template-parts/modules/reading-progress-bar'); ?>


<article id="post-<?php the_ID(); ?>" <?php post_class('reading-content'); ?>>
  <div class="single-post-content">



    <?php //THUMBNAIL 
    ?>
    <?php echo get_the_post_thumbnail(get_the_ID(), 'hd', array('class' => 'single-post-content__thumbnail')); ?>

    <?php //TITLE 
    ?>
    <!-- <h2 class="headline"><?php the_title(); ?></h2> -->

    <div class="d-flex justify-content-between">
      <?php //DATE 
      ?>
      <p class="single-post-content__date"><?php echo get_the_date('j F Y'); ?></p>

      <?php //POST TERMS 
      ?>
      <?php get_template_part('template-parts/modules/post-terms', null, array('post_id' => get_the_ID(), 'taxonomy' => 'offer-relationship')); ?>

    </div>


    <?php //CONTENT 
    ?>
    <div class="single-post-content__content">
      <div class="standard-format standard-format--post">
        <?php the_content(); ?>
      </div>
    </div>

  </div>
</article>

<?php //POST NAV 
?>
<div class="single-post-content__nav section-margin-bottom">
  <?php previous_post_link($format = '%link', $link = '<span class="btn--prev">' . pi__('Poprzedni wpis', 'pi') . ' </span> '); ?>

  <?php next_post_link($format = '%link', $link = '<span class="btn">' . pi__('Następny wpis', 'pi') . '</span>'); ?>
</div>


<?php //POPUP
$terms = get_the_terms($post, 'offer-relationship');
if ($terms && count($terms) > 0) {
  get_template_part('template-parts/modules/popup-single-post', null, array('relationship_tax' => $terms[0]));
}
?>