<?php 
/**
 * 'Book the appointment' sidebar element
 * 
 * Sidebar part that renders a CTA element for booking an appointment (displaying the form)
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

/** @var array $contact_group array of contact information (phone numbers, address, opening hours etc) */
$contact_group = get_field('contact_group', 'options'); ?>
<div class="sidebar__item sidebar__item--sticky d-none d-lg-block">
  <div class="book-appt">
    <h5 class="headline headline--xs center"><?php pi_e('Umów wizytę', 'pi'); ?> </h5>

    <div class="standard-format">
      <p class="center"> <?php pi_e('Zadzwoń lub skorzystaj z naszego formularza rejestracji', 'pi'); ?> </p>

      <!-- PHONE -->
      <p class="center">
        <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
      </p>
    </div>

    <div class="d-flex justify-content-center mb-3">
      <a href="#" class="btn" show-popup="#booking-popup"> <?php pi_e('Skontaktuj się', 'pi'); ?>  </a>
    </div>

  </div>
</div>
