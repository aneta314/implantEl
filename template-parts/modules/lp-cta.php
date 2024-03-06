<?php
/**
 * Contact module
 * 
 * A CTA module with a link button and text.
 * Usually used in various places of a landing page to open a form popup
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//array of link inf (ACF link field)
$cta_link = get_field('cta_link');
//text field
$cta_info = get_field('cta_info');
?>


<!-- CTA BTN -->
<div class="lp-cta">
  <?php
  if($cta_link):
    //this will either open a specified link, or, if the url entered is a pound sign '#', will open a specific popup.
    $cta_link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
    $popup = $cta_link['url']=='#' ? 'show-popup="#send-numer"' : ''; ?>
    <a href="<?php echo $cta_link['url']; ?>" class="btn btn--lg lp-cta__btn" target="<?php echo esc_attr( $cta_link_target ); ?>" <?php echo $popup; ?>>
      <?php echo $cta_link['title']; ?>
    </a>
  <?php
  endif; ?>


  <!-- CTA INFO  -->
  <?php if($cta_info): ?>
    <p class="lp-cta__info"><?php echo $cta_info; ?></p>
  <?php endif; ?>

</div>
