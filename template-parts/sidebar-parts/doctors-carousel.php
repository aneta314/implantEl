<?php
/**
 * Doctors carousel sidebar element
 * 
 * Sidebar part that renders a rotating carousel of 'team' CPT posts
 * These posts are taken from a relationship field mainly used in offer CPT's
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

//theoretically we're in a single offer post, so fetch the relation taxonomy for this post
global $post;
$relation_terms = get_the_terms($post, 'offer-relationship');
if($relation_terms):
  //get_the_terms returns an array of "objects", let's reduce it to a 1d array of IDs
  $relation_terms = array_column($relation_terms, 'term_id');
  //if there's any relationship terms, fetch any team member that also belongs to these terms
  $args = array(
    'post_type' => 'team',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'pi_skip_rearrange' => true, //custom flag, prevents the rearrangement action for running. removing this won't break the query, but it's a tiny bit of a performance hit.
    'tax_query' => array(
      array(
        'taxonomy' => 'offer-relationship',
        'terms' => $relation_terms
      )
    ),
  );
  //this will return an array of ids, unlike wp_query which will return whole objects
  $doctors = get_posts($args);

  if($doctors): ?>
    <div class="sidebar__item">
      <div class="doctors-carousel">
        <h5 class="headline headline--xs center"><?php pi_e('Zabieg wykonuje', 'pi'); ?></h5>

        <div class="owl-doctors owl-carousel owl-theme">

          <?php foreach($doctors as $post_id): ?>

              <div class="item">
                <?php get_template_part( 'template-parts/modules/preview-person', null, array('post_id' => $post_id) ); ?>
              </div>

          <?php endforeach; ?>
        </div>

      </div>
    </div>
  <?php
  endif; 
endif;?>
