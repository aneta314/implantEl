<?php

/**
 * Hero section
 * 
 * Hero is a main carousel displayed on the front page. It displays large banners rotating in sequence.
 * Also displays social media info.
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

//array of hero data
$hero_group = get_field('hero_group');
//this element is a repeater containing slider fields
if ($hero_group['hero']) : ?>
  <div class="hero section-margin-bottom">
    <!-- SOCIAL MEDIA -->
    <?php get_template_part('template-parts/modules/social-media'); ?>
    <div class="owl-hero owl-carousel">
      <?php
      foreach ($hero_group['hero'] as $slide) :
        //each title can have individually selected header type
        $markup = array_key_exists('title_markup', $slide) && $slide['title_markup'] ? $slide['title_markup'] : 'p';
        $title  = $slide['title'];
        $desc   = $slide['desc'];
        $image  = $slide['image'];
        $link   = $slide['link'];
      ?>
        <div class="hero__slide item">
          <?php
          if ($image) :
            echo wp_get_attachment_image($image['id'], 'hd', false, array('class' => 'absolute-img hero__img'));
          endif; ?>
          <div class="container hero__content">
            <?php
            if ($title) :
              echo '<' . $markup . ' class="headline headline--lg">' . $title . '</' . $markup . '>';
            endif; ?>
            <div class="standard-format">
              <p><?php echo $desc; ?></p>
            </div>
            <?php
            if ($link) :
              $link_target = $link['target'] ? $link['target'] : '_self'; ?>
              <a href="<?php echo $link['url']; ?>" class="btn--secondary" target="<?php echo esc_attr($link_target); ?>"><?php echo $link['title']; ?></a>
            <?php endif; ?>
          </div>
        </div>
      <?php
      endforeach; ?>
    </div>
  </div>
<?php
endif; ?>