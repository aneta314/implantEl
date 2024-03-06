<?php
/**
 * Text section
 * 
 * Renders a text section. This section is flexible with optional image in a side-by-side layout,
 * with an option to position the image before or after the text.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */
//flex section data
$group = get_sub_field('group');
$layout = $group['layout'];
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
$class = $group['class'];
$col_class = 'col';

//layout, width, positioning etc determines the classes that will be used on the wrappers
if($layout == 'photo-left') {
  $col_class = 'col-lg-6';
} elseif($layout == 'photo-right') {
  $col_class = 'col-lg-6 order-lg-2';
} ?>

<div class="text-section <?php echo $class; ?> section-margin-bottom">
  <div class="container">
    <div class="row">
      <?php
      // COL PHOTO
      if($layout != 'simple') : ?>
        <div class="<?php echo $col_class; ?>">
          <?php
          if($group['photo']):
            echo wp_get_attachment_image($group['photo'], 'medium_large', false, array('class' => 'text-section__photo', 'loading' => 'lazy'));
          endif; ?>
        </div>
      <?php 
      endif; 

      // COL CONTENT
      ?>
      <div class="col">
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
        
        // TEXT EDITOR
        ?>
        <div class="standard-format standard-format--post"><?php echo $group['content']; ?></div>
        <?php 
        // BTNS
        if($group['btns'] == 'true'): ?>
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
  </div>
</div>
