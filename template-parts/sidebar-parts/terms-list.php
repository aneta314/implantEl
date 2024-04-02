<?php

/**
 * List of terms sidebar element
 * 
 * Sidebar part that lists terms belonging to a specific taxonomy.
 * Mainly used in blog pages
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

//gets a 'currently queried object', which is used to highlight an active term
$curr_term_id = get_queried_object()->term_id; ?>

<div class="sidebar__item">
  <h5 class="headline headline--xs"> <?php pi_e('Kategorie wpisów', 'pi'); ?> </h5>
  <ul class="terms-list">
    <?php
    //sadly, have to query all the posts first, otherwise "get_terms" will fetch terms
    //that are non-empty across ALL post types, not just non-empty in 'posts'.
    $postIds = get_posts(array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'fields' => 'ids',
    ));
    $terms = get_terms('offer-relationship', array(
      'hide_empty' => true,
      'object_ids' => $postIds,
    ));

    foreach ($terms as $term) :
      $class = ($curr_term_id == $term->term_id) ? 'active' : ''; ?>

      <li class="<?php echo $class; ?>"> <a href="<?php echo get_term_link($term->term_id, 'offer-relationship'); ?>"><?php echo $term->name; ?></a></li>

    <?php endforeach; ?>
  </ul>

  <?php if (!is_page_template('templates/blog.php')) : ?>
    <div class="d-flex justify-content-center mb-3">
      <a href="<?php echo get_the_permalink(365); ?>" class="btn"> <?php pi_e('Wszystkie wpisy', 'pi'); ?> </a>
    </div>
  <?php endif; ?>
</div>