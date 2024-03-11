<?php

/**
 * Dynamic single offer flex section
 * 
 * Displays a single offer, with a text field a nd graphic taken from specific offer fields
 * If there's a relationship cookie set, this template will grab the first offer post that matches the cookie
 * If there's no post selected from the cookie, it'll try to display a default fallback post.
 * Flex sections are called when flex-content field is rendered.
 *
 * @link https://www.advancedcustomfields.com/resources/flexible-content/
 *
 * @package TemplateParts\FlexSections
 * @since 1.1
 * @author MichalB
 */

//flex section data
$group = get_sub_field('group');
//deafult offer to display if no cookie/no offer
$default_offer_id = $group['default_offer'];
$post_to_display = null; //ref

$cookie = $_COOKIE['piRelation'] ?? null;
//first conditional - if there's a cookie, let's fetch all posts to display, with some filtering
if ($cookie) {
  $cookie = explode(",", htmlspecialchars(strip_tags($cookie))); //cookie is an array of taxonomy term ids
  $args = array(
    'type' => 'post',
    'post_type' => offer_post_types(), //only fetch offers
    'posts_per_page' => -1,
    'no_found_rows' => true, //perfo
    'tax_query' => array( //only fetch posts that are in relationships defined in the cookie 
      array(
        'taxonomy' => 'offer-relationship',
        'field' => 'term_id',
        'terms' => $cookie
      )
    ),
    'meta_key'      => 'is_enabled_in_dynamic_flex_section', //also, only fetch posts that are allowed to be displayed in this dynamic section
    'meta_value'    => true
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) $post_to_display = $query->posts[0];
  wp_reset_postdata();
}
//second condtional - no post to display from the previous query, but a default display post is set
if (!$post_to_display && $default_offer_id) {
  $args = array(
    'type' => 'post',
    'post_type' => offer_post_types(), //only fetch offers
    'p' => $default_offer_id, //get the post by specific id
    'posts_per_page' => 1,
    'no_found_rows' => true, //perfo
  );
  $query = new WP_Query($args);
  if ($query->have_posts()) $post_to_display = $query->posts[0];
  wp_reset_postdata();
}
if (!$post_to_display || !get_field('is_enabled_in_dynamic_flex_section', $post_to_display->ID)) return;
//determining the header type
$markup = get_field('dynamic_flex_section_title_markup', $post_to_display->ID) ?: 'p';
$title = get_field('dynamic_flex_section_header', $post_to_display->ID);
$intro = get_field('dynamic_flex_section_intro', $post_to_display->ID);
?>
<div class="dynamic-single-offer-section section-margin-bottom">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-xl-6 left-side">
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
        //display the content. text column will stretch to full width if there's no image column
        ?>

        <?php the_field('dynamic_flex_section_text', $post_to_display->ID); ?>
        <a class="btn" show-popup="#booking-popup"><?php pi_e('Umów wizytę', 'pi'); ?></a>
        <a class="btn btn--secondary" href="<?php the_permalink($post_to_display->ID); ?>"><?php pi_e('Dowiedz się więcej', 'pi'); ?></a>
      </div>

      <?php $image_id = get_field('dynamic_flex_section_image', $post_to_display->ID); //image id to display in the dynamic section
      //get the image by the supplied id - if it's not set, fallback to the post thumbnail
      $image = $image_id ? wp_get_attachment_image($image_id, 'hd', false) : get_the_post_thumbnail($post_to_display->ID, 'full', array('title' => get_the_title($post_to_display->ID)));
      if ($image) : ?>
        <?php echo $image;
        ?>
      <?php endif; ?>
    </div>
  </div>
</div>