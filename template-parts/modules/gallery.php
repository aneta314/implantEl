<?php

/**
 * Gallery module
 * 
 * displays a tiled layout of gallery photos. Uses featherlight lightbox.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

//array of attachment ids (returned from the gallery ACF field) 
/* $gallery = $args['gallery'];  ?>

<div class="gallery" data-featherlight data-featherlight-filter="a">
  <div class="row">

    <?php if ($gallery) : ?>
      <?php
      $counter = 1;
      foreach ($gallery as $photo_id) :
        $counter++;
      ?>

        <div class="col-md-3 col-sm-6">
          <a class="gallery__photo" href="<?php echo wp_get_attachment_image_src($photo_id, 'hd')[0]; ?>">
            <?php echo wp_get_attachment_image($photo_id, 'medium_large', false, array('class' => 'absolute-img')); ?>
          </a>
        </div>

        <?php if ($counter > 8) : ?>
          <div class="btn show-next-row"><?php pi_e('Rozwiń galerię', 'pi'); ?></div>
        <?php
        else : '';
        endif; ?>

      <?php endforeach; ?>
    <?php endif; ?>


  </div>
</div>

<?php 
if ($gallery) :
  $items_in_row = 8;
  $posts_number = count($gallery);
  $rows_number = $posts_number / $items_in_row;
?>
  <div class="gallery" data-featherlight data-featherlight-filter="a">
    <div class="show-more-rows">
      <?php
      $i = 1;
      $j = 1;
      foreach ($gallery as $photo_id) :
        if ($i == 1) : echo '<div class="row row--more row--more--' . $j . '" id="row--more--' . $j . '">';
        endif; ?>
        <div class="gallery__item">
          <a class="img-holder gallery__photo scale" href="<?php echo wp_get_attachment_image_src($photo_id, 'hd')[0]; ?>">
            <?php echo wp_get_attachment_image($photo_id, 'medium_large'); ?>
          </a>
        </div>
      <?php
        $i++;
        if ($i == 6) :
          echo '</div>                ';
          $rows_number--;
          $i = 1;
          $j++;
          if ($rows_number > 0) :
            echo '<div class="btn-holder btn-holder--' . $j . '" nr ="' . $j . '"><a class="link show-next-row" href="#row--more--' . $j . '">Więcej zdjęć</a></div>';
          endif;
        endif;
      endforeach; ?>
    </div>
  </div>
  </div>
<?php
endif; */


$gallery = $args['gallery']; ?>
<div class="gallery row" data-featherlight data-featherlight-filter="a">
  <?php
  foreach ($gallery as $photo_id) : ?>
    <div class="gallery__item col-lg-3">
      <a class="img-holder gallery__photo scale" href="<?php echo wp_get_attachment_image_src($photo_id, 'hd')[0]; ?>">
        <?php echo wp_get_attachment_image($photo_id, 'medium_large'); ?>
      </a>
    </div>
  <?php
  endforeach; ?>
</div>