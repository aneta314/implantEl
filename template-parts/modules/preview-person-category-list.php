<?php

/**
 * List of team CPT posts by category
 * 
 * Lists team members CPT posts divided by a specified taxonomy. This module is an option of the team section.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
$taxonomy = $args['taxonomy']; // $args taxonomy name
$terms = get_terms(['taxonomy' => $taxonomy]);

if (!$terms) return;

//fetches team members for every term, then displays them accordingly
foreach ($terms as $term) :
  $posts = get_posts(array(
    'post_type' => 'team',
    'numberposts' => -1,
    //'orderby' => 'meta_value',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => array(
      array(
        'taxonomy' => $taxonomy,
        'field' => 'term_id',
        'terms' => $term->term_id,
      ),
    ),
  )); ?>
  <div class="category__row col-12 mb-3">
    <div class="category__name mb-3">
      <p class="intro justify-content-center"><?php pi_e('Poznaj implantEl', 'pi'); ?></p>
      <h2 class="headline headline--sm center mb-4 mb-lg-4"><?php echo $term->name; ?></h2>
    </div>
    <div class="category__posts row">
      <?php
      foreach ($posts as $person) :
      ?>
        <div class="col-sm-6">
          <?php get_template_part('template-parts/modules/preview-person', null, array('post_id' => $person->ID)); ?>
        </div>
      <?php
      endforeach; ?>
    </div>
  </div>
<?php endforeach; ?>