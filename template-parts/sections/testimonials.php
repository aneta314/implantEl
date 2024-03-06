<?php 
/**
 * Testimonials section
 * 
 * Displays a rotating carousel of testimonials (client opinions)
 * Mainly used in the footer
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

//array of testimonal data
$testimonilas_group = get_field('testimonials_group', 'options');  ?>
<div class="testimonials section-padding section-margin-bottom">
  <div class="container">
    <h6 class="headline center"><?php echo $testimonilas_group['title']; ?></h6>

    <!-- TESTIMONIALS CAROUSEL -->
    <?php  //'testimonials' key is a repeater
    get_template_part('template-parts/modules/testimonials-carousel', null, array('testimonials' => $testimonilas_group['testimonials'])); ?>

    <div class="testimonials__share">
      <p><?php pi_e('Dodaj opinię:', 'pi'); ?>  </p>

      <div class="d-flex justify-content-center">
        <a href="<?php echo $testimonilas_group['google']; ?>" target="_blank" class="testimonials__share__item"><i class="icon-google"></i></a>
        <br>
        <a href="<?php echo $testimonilas_group['facebook']; ?>" target="_blank" class="testimonials__share__item"><i class="icon-facebook"></i></a>
      </div>
    </div>

  </div>
</div>
