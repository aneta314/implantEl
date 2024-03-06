<?php 
/**
 * Sidebar layout template.
 * 
 * This template part determines which content parts will be rendered on the page.
 * The general setup remains the same, but the content is determined by single post type,
 * archive page type or template used.
 * All content is then rendered by content template parts, which are specific to the requested content type.
 *
 * @package TemplateParts\Layouts
 * @since 1.0
 * @author Amelia
 * 
 */
?>
<div class="container">
  <div class="row">
    <div class="col-lg-9 pr-lg-5">

      <?php

      // SINGLE BLOG POST
      if(is_singular('post')):
        get_template_part('template-parts/contents/single-post-content');
      endif;


      // SINGLE OFFER
      if(is_singular('offer')):
        get_template_part('template-parts/contents/single-offer-content');
      endif;


      // BLOG TEMPLATE OR CATEGORY ARCHIVE
      if(is_page_template('templates/blog.php') || is_category() || is_tax('offer-relationship')):
        get_template_part('template-parts/contents/template-blog-content', null, array('pi_skip_rearrange' => true));
      endif;


      // PRICELIST TEMPLATE
      if(is_page_template('templates/pricelist.php')):
        get_template_part('template-parts/contents/template-pricelist-content');
      endif; ?>

    </div>
    <div class="col-lg-3">
      <!-- SIDEBAR -->
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
