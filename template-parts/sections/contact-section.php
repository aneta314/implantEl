<?php

/**
 * Contact section
 * 
 * Renders a collection of contact elements, like phone numbers, emails, clinic address, and a contact form
 * Usually displayed in the footer, except for the contact page
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

//array of contact info
$contact_group = get_field('contact_group', 'options'); ?>
<div id="contact-section" class="contact-section section-margin-bottom">
  <div class="container container--contact">
    <div class="row">

      <div class="col-lg-4 contact-section__left-photo">
        <?php $img = $contact_group['img'];
        if ($img) : ?>
          <img src="<?php echo wp_get_attachment_image_url($img, 'hd'); ?>" class="contact__image" alt="contact photo">
        <?php endif; ?>
      </div>

      <div class="col-lg-3">
        <div class="intro"><?php pi_e('Zapraszamy', 'pi'); ?></div>
        <h6 class="headline headline--sm headline--mb-xl"><?php pi_e('Kontakt', 'pi'); ?></h6>
        <div class="standard-format">
          <!-- DESCRIPTION -->
          <?php $description = $contact_group['description'];
          if ($description) : ?>
            <p class="contact-section--description">
              <?php echo $description; ?>
            </p>
          <?php endif; ?>

          <!-- ADDRESS -->
          <p>
            <i class="icon-location"></i>
            <a href="<?php the_field('google_map_link', 'options') ?>" target="_blank">
              <?php echo $contact_group['street']; ?>, <?php echo $contact_group['city_code']; ?> <?php echo $contact_group['city']; ?>
            </a>
          </p>

          <!-- HOURS -->
          <p>
            <i class="icon-clock"></i>
            <?php echo $contact_group['hours']; ?>
          </p>

          <!-- PHONE -->
          <p>
            <i class="icon-phone"></i>
            <?php echo do_shortcode('[hidden-number phone="' . $contact_group['phone'] . '"]'); ?>
          </p>

          <!-- MAIL -->
          <p>
            <i class="icon-mail-alt"></i>
            <a href="mailto:<?php echo $contact_group['mail']; ?>"><?php echo $contact_group['mail']; ?></a>
          </p>

        </div>
      </div>
      <div class="col-lg-5">
        <div class="intro"><?php pi_e('Umów wizytę', 'pi'); ?></div>
        <p class="headline headline--sm"><?php pi_e('Napisz do nas', 'pi'); ?> </p>
        <div class="standard-format mb-4">
          <p><?php pi_e('Wypełnij formularz, aby w szybki i prosty sposób umówić się na wizytę lub otrzymać odpowiedź na nurtujące Cię pytania dotyczące naszej praktyki.', 'pi'); ?> </p>
        </div>

        <div class="float-labels-container">
          <?php echo do_shortcode('[contact-form-7 id="48" title="Rejestracja online"]'); ?>
        </div>
      </div>
    </div>
  </div>
</div>