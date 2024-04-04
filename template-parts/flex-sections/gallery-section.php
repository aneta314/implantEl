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
/* $group = get_sub_field('group');
$gallery = $group['gallery'];
//determining the header type
$markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
$title = $group['title'];
$intro = $group['intro'];
$text = $group['text'];
?>
<div class="gallery-section section-margin-bottom-sm">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 left-section">
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

        // TEXT
        if ($text) : ?>
          <p class="gallery-text"><?php echo $text; ?></p>
        <?php endif; ?>
      </div>

      <div class="col-lg-9 right-section">
        <?php
        // GALLERY
        if ($gallery) :
          get_template_part('template-parts/modules/gallery', null, array('gallery' => $gallery));
        endif; */ ?>
<!-- </div>
    </div>
  </div>
</div> -->





<?php
$group = get_sub_field('group');
$gallery = $group['gallery'];
$intro = $group['intro'];
$headline = $group['title'];
$text = $group['text'];
$if_more = $group['if_more'];
$class = $group['class'];
$id = $group['id']; ?>
<div class="gallery-section section-margin-bottom-sm <?php echo $class; ?>" <?php echo $id ? 'id="' . $id . '"' : ''; ?> data-aos="fade-up">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <?php
        // INTRO
        if ($intro) : ?>
          <p class="intro"><?php echo $intro; ?></p>
        <?php
        endif; ?>
        <?php
        if ($headline) : ?>
          <h6 class="headline"><?php echo $headline; ?></h6>
        <?php
        endif;
        if ($text) : ?>
          <div class="standard-format"><?php echo $text; ?></div>
        <?php endif; ?>
      </div>
      <div class="col-lg-9">
        <?php
        if ($gallery) :
          if (str_contains($class, 'gallery-section--v2')) :
        ?>
            <div class="gallery" data-featherlight data-featherlight-filter="a">
              <?php
              $i = 1;
              $j = 1;
              foreach ($gallery as $photo_id) :
                if ($i == 1) :
                  echo '<div class="row row--gallery">';
                endif;
                if ($i == 6) :
                  if ($j == 1) :
                    echo '<div class="show-more-rows">';
                    $items_in_row = 4;
                    $posts_number = count($gallery) - 5;
                    $rows_number = ($posts_number / $items_in_row);
                  endif;
                  echo '<div class="row row--more row--more--' . $j . '" id="row--more--' . $j . '">';
                endif;
              ?>
                <div class="gallery__item gallery__item--<?php echo $i; ?>">
                  <a class="img-holder gallery__photo scale" href="<?php echo wp_get_attachment_image_src($photo_id, 'hd')[0]; ?>">
                    <?php echo wp_get_attachment_image($photo_id, 'hd'); ?>
                  </a>
                </div>
              <?php
                if ($i == 5) :
                  echo '</div>';
                endif;
                if ($i == 8) :
                  echo '</div>';
                  $rows_number--;
                  $i = 8;
                  $j++;
                  if ($rows_number > 0) :
                    echo '<div class="btn-holder btn-holder--' . $j . '" nr ="' . $j . '"><a class="link show-next-row" href="#row--more--' . $j . '">Rozwiń więcej</a></div>';
                  endif;
                endif;
                $i++;
                if ($i == 10) :
                  $i = 6;
                endif;
              endforeach;
              if ($i > 8) :
                echo '</div>';
              endif;
              ?>
            </div>
      </div>
    <?php
          elseif ($if_more) :
            $items_in_row = 4;
            $posts_number = count($gallery);
            $rows_number = $posts_number / $items_in_row;
    ?>
      <div class="show-more-rows row">
        <?php
            $i = 1;
            $j = 1;
            foreach ($gallery as $id) :
              if ($i == 1) : echo '<div class="row row--more row--more--' . $j . '" id="row--more--' . $j . '">';
              endif; ?>
          <div class="gallery__item col-lg-3">
            <a class="img-holder gallery__photo scale" href="<?php echo wp_get_attachment_image_src($id, 'hd')[0]; ?>">
              <?php echo wp_get_attachment_image($id, 'medium_large'); ?>
            </a>
            <?php
              if (wp_get_attachment_caption($id)) : ?>
              <p class="gallery__item__title"><?php echo wp_get_attachment_caption($id); ?></p>
            <?php
              endif; ?>
          </div>
        <?php
              $i++;
              if ($i == 9) :
                echo '</div>';
                $rows_number--;
                $i = 1;
                $j++;
                if ($rows_number > 0) :
                  echo '<div class="btn-holder btn-holder--' . $j . '" nr ="' . $j . '"><a class="link show-next-row btn" href="#row--more--' . $j . '">Rozwiń galerię</a></div>';
                endif;
              endif;
            endforeach; ?>
      </div>
    </div>
<?php
          else :
            get_template_part('template-parts/modules/gallery', null, array('gallery' => $gallery));
          endif;
        endif; ?>
<!-- BTN -->
<?php
$link = $group['link'];
if ($link) : ?>
  <div class="btn-holder center">
    <?php
    $class = (substr($link['url'], 0, 1) == '#') ? 'smooth-scroll' : '';
    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
    <a href="<?php echo $link['url']; ?>" class="btn <?php echo $class; ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo $link['title']; ?></a>
  </div>
<?php
endif; ?>
  </div>
</div>