<?php
/**
 * Landing page offer section
 * 
 * Renders a landing-page-style offer section.
 * This section is vastly different from a regular offer section. Most importantly, it's used to
 * display info about a single offer only, with a large text area and a LP CTA.
 * Next to it a pricelist carousel is displayed - used to show most important procedures or important discounts.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */
//flex section data
$group = get_sub_field('group');
$contact_group = get_field('contact_group', 'options');
$intro = $group['intro'];
$title = $group['title'];
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';

//you can grab a pricelist related to the offer or make your own
$pricetable_source = get_field('pricetable_source');
if($pricetable_source == 'own') {
  $pricetable = get_field('pricetable');
} else {
  $service_id = get_field('related_service');
  if($service_id[0]) {
    $pricetables = detect_pricetables($service_id[0]);
    $pricetable = $pricetables[0];
  }
}

if($pricetable): ?>
  <div class="lp-pricetable section-margin-bottom">
    <div class="container">
      <?php 
      // INTRO
      if($intro): ?>
        <p class="intro center"><?php echo $intro; ?></p>
      <?php 
      endif; 

      // TITLE
      if($title): 
        echo '<'.$markup.' class="headline center">'.$title.'</'.$markup.'>';
      endif;

      // PRICETABLE
      get_template_part('template-parts/modules/pricetable', null, array('pricetable' => $pricetable)); ?>

      <div class="lp-pricetable__cta">
        <?php 
        // LP CTA
        get_template_part( 'template-parts/modules/lp-cta' ); ?>

        <!-- PHONE -->
        <div class="phone-number">
          <i class="icon-phone"></i>
          <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
        </div>
      </div>
    </div>
  </div>
<?php 
endif; ?>
