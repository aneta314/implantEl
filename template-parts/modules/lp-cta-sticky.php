<?php 
/**
 * Landing page CTA module
 * 
 * Sticky CTA for opening a contact form popup, shown in landing pages
 * 
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<a href="#" class="btn lp-cta-sticky" show-popup="#send-numer">
  <span class="lp-cta-sticky__animation">
    <?php the_field('cta_sticky'); ?>
  </span>
</a>
