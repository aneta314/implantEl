<?php
/**
 * Single post related offer popup
 * 
 * Renders the popup for a related offer in single blog posts.
 * This will attach to a page template if there's a related offer attached
 * to this blog post.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
$related_offer = $args['related_offer'];
$offer_id = $related_offer->ID;
?>

<div class="popup-single-post">
  <p class="headline headline--sm headline--mb-lg"><?php pi_e('Interesuje Cię', 'pi'); ?>  <strong><?php echo get_the_title($offer_id); ?></strong>?</p>
  <div class="standard-format mb-5">
    <p><?php pi_e('Sprawdź ceny usług, lekarzy wykonujących zabieg oraz szczegółowy opis oferty!', 'pi'); ?> </p>
  </div>
  <div class="d-block">
    <a href="<?php echo get_permalink($offer_id); ?>" class="btn"> <?php pi_e('Sprawdź ofertę', 'pi'); ?> </a> 
  </div>

</div>
