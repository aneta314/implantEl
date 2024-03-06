<?php
/**
 * Landing page contact section
 * 
 * Renders a landing-page-style contact section.
 * This section is used to hae an easy method of rendering two different contact sections
 * for both regular pages and landing pages.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

//contact info data
$contact_group = get_field('contact_group', 'options');
//flex section content
$group = get_sub_field('group');
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
?>
<div id="contact-section" class="lp-contact section-margin-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <?php echo '<'.$markup.' class="headline headline--sm headline--mb-xl">'.pi__('Dane kontaktowe', 'pi').'</'.$markup.'>'; ?>
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
        <p class="headline headline--sm"><?php the_field('form_title'); ?></p>
        <div class="standard-format mb-4">
          <p><?php the_field('form_content'); ?></p>
        </div>

        <div class="float-labels-container">
          <?php echo do_shortcode( get_field('form_shortcode') ); ?>
        </div>

      </div>
    </div>
  </div>
</div>
