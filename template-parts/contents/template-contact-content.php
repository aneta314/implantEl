<?php
/**
 * Contact page template content
 * 
 * Actual content of a contact page template
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<div class="template-contact-content section-margin-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php echo get_the_post_thumbnail( get_the_ID(), 'medium_large', array('class' => '') ); ?>
      </div>
      <div class="col-md-6">
        <div class="standard-format">
          <?php $contact_group = get_field('contact_group', 'options'); ?>

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

          <div class="pt-4 pb-4">
            <p>
            <?php pi_e('Godziny otwarcia:', 'pi'); ?> <br>
            <!-- HOURS -->
            <?php echo $contact_group['hours']; ?>
            </p>
          </div>

          <!-- SOCIAL MEDIA -->
    			<?php get_template_part( 'template-parts/modules/social-media' ); ?>
        </div>
      </div>
    </div>
  </div>
</div>
