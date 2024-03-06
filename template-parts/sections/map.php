<?php 
/**
 * Map section
 * 
 * Displays a OpenStreetMap leaflet map, with predetermined markers.
 * These markes can be set in the theme options, map tab.
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 * 
 * @todo untranslated string
 */
?>
<div class="map">
  <?php echo do_shortcode('[pimap]'); ?>
  <a href="<?php the_field('google_map_link_2', 'options'); ?>" target="_blank" class="map__btn btn"> wyznacz trasę</a>
</div>
