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
$gallery = $args['gallery']; ?>

  <div class="gallery" data-featherlight data-featherlight-filter="a">
    <div class="row">

      <?php foreach($gallery as $photo_id): ?>

        <div class="col-md-3 col-sm-6">
          <a class="gallery__photo" href="<?php echo wp_get_attachment_image_src($photo_id, 'hd')[0]; ?>" >

            <?php echo wp_get_attachment_image($photo_id, 'medium_large', false, array('class' => 'absolute-img')); ?>

          </a>
        </div>

      <?php endforeach; ?>

    </div>
  </div>
