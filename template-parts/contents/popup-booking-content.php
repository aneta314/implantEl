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

<div class="popup-booking__wrapper">
  <div class="popup-booking__img">
    <img src="<?php echo get_template_directory_uri(); ?>/img/img-popup.png" alt="ImplantEl Kontakt">
  </div>
  <div class="popup-booking-content">
    <p class="uppercase mb-1 intro"><?php pi_e('Umów wizytę', 'pi'); ?></p>
    <p class="headline headline--sm headline--mb-lg"><?php pi_e('Napisz do nas', 'pi'); ?></p>
    <div class="standard-format popup-booking-content__desc">
      <p><?php pi_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam risus turpis, feugiat pretium tincidunt sit amet, tincidunt non justo.', 'pi'); ?> </p>
    </div>
    <div class="float-labels-container">
      <?php echo do_shortcode('[contact-form-7 id="48" title="Rejestracja online"]'); ?>
    </div>
  </div>
</div>