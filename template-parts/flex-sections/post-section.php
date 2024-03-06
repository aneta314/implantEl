<?php
/**
 * Blog flex section
 * 
 * Displays a list of blog posts in a flex-content loop
 * Flex sections are called when flex-content field is rendered.
 *
 * @link https://www.advancedcustomfields.com/resources/flexible-content/
 *
 * @package TemplateParts\FlexSections
 * @since 1.1
 * @author MichalB
 */

 //flex section data
$group = get_sub_field('group'); 
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
?>
<div class="blog-section section-margin-bottom">
  <div class="container">
    <?php 
    // INTRO
    if($intro): ?>
      <p class="intro"><?php echo $intro; ?></p>
    <?php endif; 
    // TITLE
    if($title): 
      echo '<'.$markup.' class="headline">'.$title.'</'.$markup.'>';
    endif;

    //template args are passed to a blog-content template to render post previews
    $template_args = array(
        'posts_per_page' => 3, 
        'cols' => 'col-lg-4',
        'paged' => false,
    );
    //render a blog content template
    get_template_part('template-parts/contents/template-blog-content', null, $template_args);
    
    // BTNS
    if($group['btns'] == 'yes'): ?>
     <div class="btns-wrapper">
       <?php
       // BTN 1 (SECONDARY)
       $link = $group['link'];
       if($link):
         $class = (substr($link['url'], 0, 1) == '#')? 'smooth-scroll' : '';
         $link_target = $link['target'] ? $link['target'] : '_self'; ?>
         <a href="<?php echo $link['url']; ?>" class="btn btn--secondary <?php echo $class; ?>" target="<?php echo esc_attr( $link_target ); ?>" ><?php echo $link['title']; ?></a>
       <?php 
       endif;

       // BTN 2 (PRIMARY)
       $link = $group['link_2'];
       if($link):
         $class = (substr($link['url'], 0, 1) == '#')? 'smooth-scroll' : '';
         $link_target = $link['target'] ? $link['target'] : '_self'; ?>
         <a href="<?php echo $link['url']; ?>" class="btn <?php echo $class; ?>" target="<?php echo esc_attr( $link_target ); ?>" ><?php echo $link['title']; ?></a>
       <?php 
       endif; ?>
     </div>
    <?php 
    endif; ?>
  </div>
</div>
