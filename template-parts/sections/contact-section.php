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
$contact_group = get_field('contact_group', 'options');?>
<div id="contact-section" class="contact-section section-margin-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h6 class="headline headline--sm headline--mb-xl"><?php pi_e('Dane kontaktowe', 'pi'); ?></h6>
        <div class="standard-format">
          
          <!-- PHONE -->
          <p>
            <i class="icon-phone"></i>
            <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
          </p>

          <!-- MAIL -->
          <p>
            <i class="icon-mail-alt"></i>
            <a href="mailto:<?php echo $contact_group['mail']; ?>"><?php echo $contact_group['mail']; ?></a>
          </p>

          <!-- ADDRESS -->
          <p>
            <i class="icon-location"></i>
            <a href="<?php the_field('google_map_link', 'options')?>" target="_blank">
              <?php echo $contact_group['street']; ?>, <?php echo $contact_group['city_code']; ?> <?php echo $contact_group['city']; ?>
            </a>
          </p>

          <div class="pt-4">
            <p>
            <?php pi_e('Godziny otwarcia:', 'pi'); ?>  <br>
            <!-- HOURS -->
            <?php echo $contact_group['hours']; ?>
            </p>
          </div>
        </div>

      </div>
      <div class="col-md-8">
        <p class="headline headline--sm"><?php pi_e('Zostaw swój numer', 'pi'); ?> </p>
        <div class="standard-format mb-4">
          <p><?php pi_e('Oddzwonimy do Ciebie w celu ustalenia terminu wizyty!', 'pi'); ?> </p>
        </div>

        <div class="float-labels-container">
          <?php echo do_shortcode( '[contact-form-7 id="48" title="Rejestracja online"]' ); ?>
        </div>

      </div>
    </div>
  </div>
</div>
