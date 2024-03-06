<?php

/**
 * Social media module
 * 
 * Renders a collection of social media links (usually in a icon button format)
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//repeater array of social media links
$social_media = get_field('social_media', 'options');


if ($social_media) : ?>
  <div class="social-media">
    <?php
    foreach ($social_media as $medium) : ?>
      <a href="<?php echo $medium['url']; ?>" class="social-media__item" target="_blank">
        <?php get_social_media_icon($medium['social_media']); ?>
      </a>
    <?php
    endforeach; ?>
    <p class="intro-line"><?php pi_e('social media', 'pi'); ?></p>
  </div> <?php
        endif;
