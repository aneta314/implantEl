<?php
/**
 * Landing page hero section
 * 
 * Renders a landing-page-style hero section.
 * This section is different from a regular front-page hero section in its appearance.
 * Most notably, it is a single entity and not a carousel.
 * This section contains a landing page CTA module.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

  //contact info array
  $contact_group = get_field('contact_group', 'options');
  //flex section data
  $group = get_sub_field('group');
  $intro = $group['intro'];
  $title = $group['title'];
  //determining the header type
  $markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
  $image = $group['image'];
?>

<div class="lp-hero section-margin-bottom">

  <?php
  // PHOTO
  if($image):
    echo wp_get_attachment_image($image, 'hd', false, array('class' => 'absolute-img lp-hero__img'));
  endif; ?>

  <div class="container lp-hero__content">
    <?php 
    // INTRO
    if($intro): ?>
      <p class="intro"><?php echo $intro; ?></p>
    <?php 
    endif; 

    // TITLE
    if($title): 
      echo '<'.$markup.' class="lp-hero__headline">'.$title.'</'.$markup.'>';
    endif;
   
    // LP CTA
    get_template_part( 'template-parts/modules/lp-cta' ); ?>
  </div>

  <!-- SCROLL DOWN -->
  <a href="#top" class="lp-hero__scroll-down smooth-scroll">
    <i class="icon-arrow-down"></i>
  </a>

</div>

<!-- SCROLL POINT -->
<div id="top"></div>
