<?php 
/**
 * Booking popup content
 * 
 * Content template of booking popups.
 * This template renders the hardcoded contact form, which is edited in the admin panel.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */

//contact info data
$contact_group = get_field('contact_group', 'options'); ?>

<div class="popup-booking-content">
  <p class="uppercase mb-1"><?php pi_e('Zostaw swój numer', 'pi'); ?></p>
  <p class="headline headline--sm headline--mb-lg"><?php pi_e('Oddzwonimy do Ciebie', 'pi'); ?></p>
  <div class="standard-format popup-booking-content__desc">
    <p><?php pi_e('Skontaktujemy się z Tobą w niedługim czasie i zaproponujemy termin wizyty', 'pi'); ?> </p>
  </div>
  <div class="float-labels-container">
    <?php echo do_shortcode( '[contact-form-7 id="48" title="Rejestracja online"]' ); ?>
  </div>
  <hr>
  <div class="row popup-booking-content__row">
    <div class="col-md-6">
      <p><i class="icon-phone"></i><?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?></p>
    </div>
    <div class="col-md-6">
      <p><i class="icon-mail-alt"></i><a href="mailto:<?php echo $contact_group['mail']; ?>"><?php echo $contact_group['mail']; ?></a></p>
    </div>
  </div>
</div>
