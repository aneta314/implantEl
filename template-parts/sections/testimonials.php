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
      <a href="<?php echo $testimonilas_group['google']; ?>" target="_blank" class="btn"><?php pi_e('Dodaj opinię Google', 'pi'); ?> </a>
      <a href="<?php echo $testimonilas_group['facebook']; ?>" target="_blank" class="btn"><?php pi_e('Dodaj opinię Facebook', 'pi'); ?> </a>
    </div>

  </div>
</div>