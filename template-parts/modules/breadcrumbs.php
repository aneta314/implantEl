<?php 
/**
 * Breadcrumbs module
 * 
 * Displays the breadcrumbs. Used in page hero.
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

if ( ! is_front_page() ): ?>
  <div class="breadcrumbs">
      <?php global $post; ?>

      <span>
        <a href="<?php echo site_url(); ?>"> <?php echo get_bloginfo('name'); ?></a>

        <?php
        //this section checks for a singular type (i.e. what kind of posts are we looking at)
        //and creates a breadcrumb link to appropriate 'parent'.
        if( is_singular('offer')):
          echo '&#187; <a href="'.get_the_permalink(77).'"> '.get_the_title(77).' </a>';
        endif;

        if( is_singular('medicine')):
          echo '&#187; <a href="'.get_the_permalink(830).'"> '.get_the_title(830).' </a>';
        endif;

        if( is_singular('team')):
          echo '&#187; <a href="'.get_the_permalink(79).'"> '.get_the_title(79). ' </a>';
        endif;

        if( is_singular('post') || is_category() || is_tax( 'offer-relationship' )):
          echo '&#187; <a href="'.get_the_permalink(365).'">' .get_the_title(365).' </a>';
        endif;

        //404 page
        if( is_404()):
          echo '&#187; 404';

        //archive page - taxonomies etc
        elseif(is_archive()):
          echo '&#187; '. get_the_archive_title();

        else:
          //ran if this post has a parent in wordpress hierarchy
          if( $post->post_parent ): echo '&#187; <a href="'.get_permalink($post->post_parent).'"> '.get_the_title($post->post_parent).' </a>'; endif;
          
          //finally, display the current post title
          echo '&#187; '.get_the_title();

        endif;?>
      </span>
  </div>
<?php endif; ?>
