<?php 
/**
 * Landing page popup module
 * 
 * Used in landing pages as a contact form popup in conjunction with CTA modules in various places of the page
 * Usually contains a different contact form than the regular pages/footer
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<!-- SINGLE POST POP UP -->
<div class="popup" id="send-numer">

  <!-- BACKGROUND -->
  <div class="popup__bg"></div>

  <!-- BOX -->
  <div class="popup__box">

    <!-- CLOSE -->
    <div class="popup__close"> <i class="icon-close"></i> </div>

    <p class="headline headline--sm"><?php the_field('form_title'); ?></p>
    <div class="standard-format mb-4">
      <p><?php the_field('form_content'); ?></p>
    </div>

    <div class="float-labels-container">
      <?php echo do_shortcode( get_field('form_shortcode') ); ?>
    </div>

  </div>
</div>
