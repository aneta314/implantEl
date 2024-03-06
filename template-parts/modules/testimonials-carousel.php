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
$testimonials = $args['testimonials']; ?>

<?php if($testimonials):?>
  <div class="owl-testimonials owl-carousel owl-carousel--aside-nav owl-theme">
    <?php foreach($testimonials as $testimonial): ?>

      <div class="item">
        <div class="testimonial standard-format">
          <p class="testimonial__content">
            <?php echo $testimonial['testimonial']; ?>
          </p>
          <p class="testimonial__author">
            <?php echo $testimonial['author']; ?>
          </p>
        </div>
      </div>

    <?php endforeach; ?>
  </div>
<?php endif; ?>
