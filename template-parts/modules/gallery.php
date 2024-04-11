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