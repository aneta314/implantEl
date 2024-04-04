<?php

/**
 * Single offer post content template
 * 
 * Actual content of a single offer page. This file determines which elements of the offer
 * need to be rendered, such as a pricelist or faq, and includes them accordingly.
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */

// READING PROGRESS BAR
get_template_part('template-parts/modules/reading-progress-bar'); ?>



<article id="post-<?php the_ID(); ?>" <?php post_class('reading-content'); ?>>
  <div class="single-offer-content section-margin-bottom">

    <?php //RELATED OFFER POSTS
    //this is a relationship field - used to display additional, related offer thumbnails on the offer page
    $related_posts = get_field('related_posts');
    if ($related_posts) : ?>
      <div class="related-offer-carousel">
        <h5 class="headline headline--xs"><?php pi_e('Podobne usługi', 'pi'); ?></h5>
        <div id="owl-demo" class="owl-related-offer owl-carousel owl-carousel--nav-on-left owl-theme">
          <?php
          foreach ($related_posts as $post_id) : ?>
            <div class="item">
              <?php
              // PREVIEW OFFER SM
              get_template_part('template-parts/modules/preview-offer-sm', null, array('post_id' => $post_id)); ?>
            </div>
          <?php
          endforeach; ?>
        </div>
      </div>
    <?php
    endif; ?>

    <?php //EXCERPT
    if (has_excerpt()) : ?>
      <div class="single-offer-content__excerpt">
        <?php the_excerpt(); ?>
      </div>

      <?php //CONTACT MODULE
      get_template_part('template-parts/modules/contact-module', null, array('hide' => 'phone')); ?>
    <?php endif; ?>

    <?php //THUMBNAIL
    echo get_the_post_thumbnail(get_the_ID(), 'hd', array('class' => 'single-offer-content__thumbnail')); ?>


    <div class="single-offer-content__content standard-format standard-format--post section-margin-bottom">

      <?php //TABLE OF CONTENTS - this is generated in a the_content hook
      echo do_shortcode('[pi_toc]'); ?>

      <?php //CONTENT
      the_content(); ?>

      <?php //CONTACT MODULE
      get_template_part('template-parts/modules/contact-module', null, array('hide' => 'phone')); ?>
    </div>

    <?php //FAQ - conditionally displayed
    $faq = get_field('faq');
    if ($faq) : ?>
      <div class="single-offer-content__faq section-margin-bottom">
        <span id="faq"></span>
        <div class="standard-format--post">
          <h2><?php pi_e('Najczęściej zadawane pytania', 'pi'); ?> </h2>
        </div>

        <?php foreach ($faq as $item) : ?>
          <div class="single-offer-content__faq__item standard-format">
            <h3><?php echo $item['question']; ?></h3>
            <p><?php echo $item['answer']; ?></p>
          </div>
        <?php endforeach; ?>

        <?php //CONTACT MODULE
        get_template_part('template-parts/modules/contact-module', null, array('hide' => 'phone')); ?>

      </div>
    <?php
    endif; ?>


    <?php //METAMORPHOSIS - conditionally displayed
    $related_metamorphosis = get_related_metamorph(get_the_ID());
    if ($related_metamorphosis) : ?>
      <div class="single-offer-content__metamorphosis section-margin-bottom-sm">
        <span id="metamorphosis"></span>
        <div class="standard-format--post">
          <h2> <?php pi_e('Metamorfozy', 'pi'); ?> </h2>
        </div>

        <?php foreach ($related_metamorphosis as $metamorphosis_id) : ?>
          <?php
          // METAMORPHOSIS PREVIEW
          get_template_part('template-parts/modules/preview-metamorphosis-sm', null, array('post_id' => $metamorphosis_id)); ?>
        <?php endforeach; ?>

      </div> <?php
            endif; ?>

    <?php //PRICETABLE - conditionally displayed
    $pricetables = detect_pricetables(get_the_ID());
    if ($pricetables) :  ?>

      <div class="single-offer-content__pricetables">
        <span id="cennik"></span>
        <h5 class="headline headline--sm"> <?php pi_e('Cennik zabiegów', 'pi'); ?></h5>

        <?php foreach ($pricetables as $pricetable) : ?>
          <!-- PRICETABLE -->
          <?php get_template_part('template-parts/modules/pricetable', null, array('pricetable' => $pricetable)); ?>
        <?php endforeach; ?>

        <!-- CONTACT MODULE -->
        <?php get_template_part('template-parts/modules/contact-module', null, array('hide' => 'pricetable')); ?>

      </div> <?php
            endif; ?>

  </div>
</article>