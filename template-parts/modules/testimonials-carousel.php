<?php

/**
 * Testimonials carousel module
 * 
 * Renders the carousel with testimonials. This is the carousel module ONLY, without any headers etc.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */
$testimonials = $args['testimonials'];
?>

<?php if ($testimonials) : ?>
  <div class="owl-testimonials owl-carousel owl-carousel--aside-nav owl-theme">
    <?php foreach ($testimonials as $testimonial) :
    ?>

      <div class="item">
        <div class="testimonial standard-format">
          <?php if ($testimonial['shortened']) : ?>
            <p class="testimonial__shortened">
              <strong>"<?php echo $testimonial['shortened']; ?>"</strong>
            </p>
          <?php endif; ?>
          <p class="testimonial__content">
            <?php echo $testimonial['testimonial']; ?>
          </p>
          <p class="testimonial__author">
            <?php echo $testimonial['author']; ?>
          </p>
        </div>
        <div class="testimonial__related-offer">
          <?php
          $taxonomies = $testimonial['related_offer'];
          $terms = $testimonial["related_offer"];
          if ($terms) :
            foreach ($terms as $term) :
          ?>
              <h5 class="taxonomy__name">
                <?php echo $term->name;
                ?>
              </h5>
              <?php
              //$group = get_sub_field('group');
              // $post_id = $args['post_id']; // ids 
              // $post_type = 'Stomatologia';
              // $args = array(
              //   'type' => 'post',
              //   'post_type' => '$post_type',
              // );
              //$loop = new WP_Query($args);
              /* $args = array(
                'type' => 'post',
                'post_type' => 'Stomatologia',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'DESC',
              );
              $loop = new WP_Query($args);

              ?>
              <?php if ($loop->have_posts()) : ?>
                <?php
                while ($loop->have_posts()) : $loop->the_post(); */ ?>
              <?php
              //$post_id = get_post_by_title($term->name, 'object', 'offer');
              ?>
              <!-- <a href="<?php echo get_the_permalink($post_id); ?>" class="preview-offer">
                <div class="preview-offer__photo">
                  <?php echo get_the_post_thumbnail($post_id, 'medium_large', array('title' => get_the_title($post_id), 'class' => 'absolute-img')); ?>
                </div>
              </a> -->
              <?php //endwhile;
              // endif; 
              ?>
            <?php endforeach;
            ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>