<?php
/**
 * Single team post content template
 * 
 * Actual content of a single team page post.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<div class="single-team-content section-margin-bottom">
  <div class="container">
    <div class="section-margin-bottom">
      <div class="row">
        <div class="col-md-6 mb-4 mb-md-0">
          <?php echo get_the_post_thumbnail( get_the_ID(), 'medium_large', array('class' => '') ); ?>
        </div>
        <div class="col-md-6">
          <h2 class="headline mb-2"><?php the_title(); ?></h2>
          <p class="mb-4 uppercase"><?php the_field('position'); ?></p>

          <div class="standard-format">
            <?php //CONTENT
            the_content(); ?>
          </div>

          <?php //hardcoded team page href ?>
          <a href="<?php echo get_the_permalink(79); ?>" class="btn"> <?php pi_e('Zobacz zespół', 'pi'); ?> </a>
        </div>
      </div>
    </div>


    <?php //GALLERY - mainly used for certs
    $gallery = get_field('gallery');
    if($gallery): ?>
      <div class="single-team-content__certificates">
        <h2 class="headline"> <?php pi_e('Certyfikaty', 'pi'); ?> </h2>

        <div class="single-team-content__certificates__wrapper">
          <div class="gallery justified-gallery" data-featherlight-gallery data-featherlight-filter="a">
            <?php
            foreach( $gallery as $image_id ): ?>

              <a href="<?php echo wp_get_attachment_image_src($image_id, 'hd')[0]; ?>" class="gallery__photo">
                <?php echo wp_get_attachment_image($image_id, 'mobile', false, array('class' => 'absolute-img')); ?>
              </a>

            <?php
            endforeach; ?>

          </div>
        </div>
      </div>

    <?php endif; ?>

  </div>
</div>
