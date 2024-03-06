<?php
/**
 * Gallery flex section
 * 
 * Renders a gallery section using a gallery module.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

//flex section content
$group = get_sub_field('group');
$gallery = $group['gallery'];
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro']; 
?>
<div class="gallery-section section-margin-bottom-sm">
  <div class="container">
    <?php
    // INTRO
    if($intro): ?>
      <p class="intro"><?php echo $intro; ?></p>
    <?php 
    endif;

    // TITLE
    if($title): 
      echo '<'.$markup.' class="headline">'.$title.'</'.$markup.'>';
    endif;

    // GALLERY
    if($gallery):
      get_template_part('template-parts/modules/gallery', null, array('gallery' => $gallery));
    endif; ?>
  </div>
</div>
