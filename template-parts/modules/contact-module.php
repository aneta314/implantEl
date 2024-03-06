<?php
/**
 * Contact module
 * 
 * A CTA module with a popup button, pricelist anchor button and an optional phone display.
 * Used mainly in single offers and a pricelist, in between elements.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//template part param - hides or shows the phone number/pricetable
$hide = $args['hide'];
//checks if there's a pricetable present on the page and displays an anchor accordingly
$pricetables = detect_pricetables(get_the_ID());
?>

<div class="contact-module d-lg-none">

  <!-- BOOKING POPUP TRIGGER -->
  <a href="#" class="btn contact-module__btn" show-popup="#booking-popup">  <?php pi_e('Umów wizytę', 'pi'); ?> </a>

  <!-- PRICETABLE LINK -->
  <?php if($hide != 'pricetable' && $pricetables): ?>
    <a href="#cennik" class="btn btn--secondary contact-module__btn smooth-scroll">  <?php pi_e('Cennik', 'pi'); ?> </a>
  <?php endif; ?>

  <!-- PHONE -->
  <?php if($hide != 'phone'):
    $contact_group = get_field('contact_group', 'options'); ?>
    <p class="contact-module__phone">
      <i class="icon-phone"></i>
      <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
    </p>
  <?php endif; ?>

</div>
