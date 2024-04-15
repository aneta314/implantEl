<?php

/**
 * Icons flex section
 * 
 * Renders an icons section, which is a collection of infographics,
 * most commonly about the clinic.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

//flex section content
$group = get_sub_field('group');
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
?>
<div class="icons-section">
  <div class="container">
    <?php
    // INTRO
    if ($intro) : ?>
      <p class="intro"><?php echo $intro; ?></p>
    <?php
    endif;
    // TITLE
    if ($title) :
      echo '<' . $markup . ' class="headline">' . $title . '</' . $markup . '>';
    endif;

    // DESC
    ?>
    <div class="icons-section__intro standard-format">
      <p><?php echo $group['desc']; ?></p>
    </div>
    <?php
    // REPEATER
    if ($group['icons']) : ?>
      <div class="row">
        <?php
        foreach ($group['icons'] as $infographic) : ?>
          <div class="col-md-3 col-xl-2">
            <div class="infographic">
              <?php $photo_id = $infographic['icon'];
              if ($photo_id) : ?>
                <div class="infographic__icon-wrapper">
                  <?php echo wp_get_attachment_image($photo_id, '', true, array('class' => ' inject-me')); ?>
                </div>
              <?php
              endif; ?>
              <h6 class="infographic__title headline headline--xs center"><?php echo $infographic['title']; ?></h6>
              <?php if ($infographic['desc']) : ?>
                <div class="infographic__desc standard-format">
                  <p class="center"><?php echo $infographic['desc']; ?></p>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php
        endforeach; ?>
      </div>
    <?php
    endif;

    // BTNS
    if ($group['btns'] == 'yes') : ?>
      <div class="btns-wrapper">
        <?php
        // BTN 1 (SECONDARY)
        $link = $group['link'];
        if ($link) :
          $class = (substr($link['url'], 0, 1) == '#') ? 'smooth-scroll' : '';
          $link_target = $link['target'] ? $link['target'] : '_self'; ?>
          <a href="<?php echo $link['url']; ?>" class="btn btn--secondary <?php echo $class; ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo $link['title']; ?></a>
        <?php
        endif;

        // BTN 2 (PRIMARY)
        $link = $group['link_2'];
        if ($link) :
          $class = (substr($link['url'], 0, 1) == '#') ? 'smooth-scroll' : '';
          $link_target = $link['target'] ? $link['target'] : '_self'; ?>
          <a href="<?php echo $link['url']; ?>" class="btn <?php echo $class; ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo $link['title']; ?></a>
        <?php
        endif; ?>
      </div>
    <?php
    endif; ?>
  </div>
</div>