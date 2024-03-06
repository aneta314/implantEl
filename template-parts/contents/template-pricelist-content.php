<?php
/**
 * Pricelist page template content
 * 
 * Actual content of a pricelist page template.
 * Each pricetable is generated using a pricetable module.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="template-pricelist-content section-margin-bottom">

    <?php //pricetable repeater
    $pricetables = get_field('pricetables');
    foreach($pricetables as $pricetable): 
      $offer = null; //reset?>

      <div id="<?php echo sanitize_title($pricetable['title']); ?>" class="template-pricelist-content__item" data-related-offer-id="<?php if($pricetable['related_offer']) echo $pricetable['related_offer'][0]; ?>">

        <?php //determining if an offer anchor is needed
        if($pricetable['related_offer']): 
          $offer = get_posts(array( //get the offer post
            'posts_per_page' => 1, //we only need the first one
            'post_type' => offer_post_types(), //defined in pi-dynamics.php
            'status' => 'publish',
            'tax_query' => array(
              array(
                  'taxonomy' => 'offer-relationship',
                  'field' => 'term_id',
                  'terms' => $pricetable['related_offer']
              )
            )
          ));
        endif;
        if(isset($offer) && is_array($offer) && count($offer) > 0):?>
          <h5 class="headline headline--sm template-pricelist-content__title">
            <a href="<?php echo get_permalink($offer[0]); ?>">
              <?php echo $pricetable['title']; ?>
            </a>
          </h5>
        <?php else: ?>
          <h5 class="headline headline--sm"><?php echo $pricetable['title']; ?></h5>
        <?php endif; ?>

        <?php //PRICETABLE
         get_template_part('template-parts/modules/pricetable', null, array('pricetable' => $pricetable['pricetable'])); ?>

        <?php //CONTACT MODULE
        get_template_part( 'template-parts/modules/contact-module', null, array('hide' => 'pricetable')); ?>
      </div>

    <?php
    endforeach; ?>
  </div>
</article>