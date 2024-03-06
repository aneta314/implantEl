<?php 
/**
 * Popup module
 * 
 * Generic popup module that usually shows a contact/booking form.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<!-- BOOKING POP UP -->
<div id="booking-popup" class="popup">

  <!-- BACKGROUND -->
  <div class="popup__bg"></div>

  <!-- BOX -->
  <div class="popup__box">

    <!-- CLOSE -->
    <div class="popup__close"> <i class="icon-close"></i> </div>

    <!-- BOOKING POPUP CONTENT -->
    <?php get_template_part('template-parts/contents/popup-booking-content'); ?>

  </div>
</div>
