<?php

/**
 * Metamorphosis preview module
 * 
 * Shows a metamorphosis CPT preview tile. Uses Img comparison slider to create a comparison
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 * @todo untranslated before/after alt strings
 */

$post_id = $args['post_id']; // ids
$metamorphosis_post = get_post($post_id);
$group = get_field('group', $post_id); ?>
<div class="preview-metamorphosis">
    <div class="preview-metamorphosis__content">
        <h4 class="headline headline--xxs"><?php echo get_the_title($post_id); ?></h4>
        <div class="standard-format">
            <p><?php echo $metamorphosis_post->post_content;
                ?></p>
        </div>
    </div>
    <div class="preview-metamorphosis__images">
        <img class="before" src="<?php echo wp_get_attachment_image_url($group['before'], 'hd'); ?>" alt="<?php echo get_the_title($post_id); ?> - przed">
        <a class="preview-metamorphosis__btn" href="#"><?php pi_e('Kliknij by odkryć ', 'pi'); ?></a>
        <p class="before-text">Przed zabiegiem</p>
        <i class="arrow-metamorphosis"></i>
        <img class="after" src="<?php echo wp_get_attachment_image_url($group['after'], 'hd'); ?>" alt="<?php echo get_the_title($post_id); ?> - po">
        <p class="after-text">Po zabiegu</p>
    </div>
</div>