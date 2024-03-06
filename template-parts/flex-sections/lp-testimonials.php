<?php
/**
 * Landing page testimonials section
 * 
 * Renders a landing-page-style testimonials section.
 * This is mainly to have two differing versions, one for regular pages
 * and one for landing pages. The source of the testimonials can be either the options page,
 * or own source, which makes this section able to have different testimonials than the main ones.
 * This is useful for displaying testimonials about a specific procedure or offer.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */
  //flex section data
  $group = get_sub_field('group');
  $source = $group['source'];
  $source_2 = $group['source_2'];
  $intro = $group['intro'];
  $title = $group['title'];
  //determining the header type
  $markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';

  //this determines which testimonials will be loaded - global ones from the options or specific ones from this page
  if($source == 'own') {
    $testminonials = $group['testimonials'];
  } else {
    $testimonilas_group = get_field('testimonials_group', 'options');
    $testminonials = $testimonilas_group['testimonials'];
  }
?>

<div id="testimonials" class="lp-testimonials section-margin-bottom">
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

    // TESTIMONIALS CAROUSEL
    get_template_part('template-parts/modules/testimonials-carousel', null, array('testimonials' => $testminonials)); ?>

    <?php if($source_2): ?>
      <div class="lp-testimonials__source"><?php pi_e('Zródło opinii:', 'pi'); ?> <span><?php echo $source_2; ?></span> </div>
    <?php endif; ?>
  </div>
</div>
