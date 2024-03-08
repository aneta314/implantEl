<?php

/**
 * Testimonials carousel module
 * 
 * Renders the carousel with testimonials. This is the carousel module ONLY, without any headers etc.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
$testimonials = $args['testimonials'];
?>

<?php if ($testimonials) : ?>
  <div class="owl-testimonials owl-carousel owl-carousel--aside-nav owl-theme section-margin-bottom">
    <?php foreach ($testimonials as $testimonial) :
    ?>

      <div class="item">
        <div class="testimonial standard-format">
          <?php if ($testimonial['shortened']) : ?>
            <p class="testimonial__shortened">
              <strong>"<?php echo $testimonial['shortened']; ?>"</strong>
            </p>
          <?php endif; ?>
          <p class="testimonial__content">
            <?php echo $testimonial['testimonial']; ?>
          </p>
          <p class="testimonial__author">
            <?php echo $testimonial['author']; ?>
          </p>
        </div>


        <?php
        $relation = $testimonial['relation'];
        if ($relation) :
        ?>
          <div class="testimonial__related-offer">
            <?php foreach ($relation as $post_id) :
            ?>
              <?php get_template_part('template-parts/modules/preview-offer-sm', null, array('post_id' => $post_id)); ?>
            <?php
            endforeach; ?>
          </div>
        <?php endif; ?>


      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>