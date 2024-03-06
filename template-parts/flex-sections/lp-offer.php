<?php
/**
 * Landing page offer section
 * 
 * Renders a landing-page-style offer section.
 * This section is vastly different from a regular offer section. Most importantly, it's used to
 * display info about a single offer only, with a large text area and a LP CTA.
 * Next to it a pricelist carousel is displayed - used to show most important procedures or important discounts.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */
  //flex section data
  $group = get_sub_field('group');
  //contact info data
  $contact_group = get_field('contact_group', 'options');
  $display_sidebar = $group['display_pricelist'];
  //main wrapper class, changes if there's a sidebar to display
  $class = 'col-12';
  $intro = $group['intro'];
  $title = $group['title'];
  //determining the header type
  $markup = array_key_exists('title_markup', $group) && $group['title_markup'] ? $group['title_markup'] : 'p';
  $content = $group['content'];

  //if there's a sidebar we need to get a pricetable and change some classes
  if($display_sidebar) {
    $class = 'col-lg-8';
    
    $pricetable_source = get_field('pricetable_source');
    //fetch a pricetable according to the source field
    if($pricetable_source == 'own') {
      $pricetable = get_field('pricetable');
    } else {
      $service_id = get_field('related_service');

      if($service_id[0]) {
        $pricetables = detect_pricetables($service_id[0]);
        $pricetable = $pricetables[0];
      }
    }
  }
?>

<div class="lp-offer section-margin-bottom">
  <div class="container">
    <div class="row">
      <div class="<?php echo $class; ?>">
        <?php 
        // INTRO
        if($intro): ?>
          <p class="intro"><?php echo $intro; ?></p>
        <?php 
        endif; 
        
        // TITLE
        if($title): 
          echo '<'.$markup.' class="headline">'.$title.'</'.$markup.'>';
        endif;

        // CONTENT
        if($content): ?>
        <div class="standard-format standard-format--post">
          <?php echo $content; ?>
        </div>
        <?php 
        endif;

        // LP CTA
        get_template_part( 'template-parts/modules/lp-cta' ); 
        ?>

        <!-- PHONE -->
        <div class="phone-number">
          <i class="icon-phone"></i>
          <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
        </div>
      </div>

      <div class="col-lg-4">

        <div class="lp-offer__sticky">
          <?php
          // PRICE LIST CAROUSEL
          if($display_sidebar && $pricetable):
            //used for css coloring, capped at 4
            $count = 0; ?>

            <p class="intro center"><?php pi_e('Cennik', 'pi'); ?></p>

            <div class="owl-lp-pricelist owl-carousel owl-theme">
              <?php foreach($pricetable as $item):
                $count++;
                $count = ($count > 4)? 1 : $count;
                if($item['carousel']): ?>

                  <div class="item">
                    <div class="price-box price-box--<?php echo $count; ?>">
                      <?php
                      $old_price = $item['price_old'];
                      if($old_price): ?>
                        <p class="price-box__price-old"><?php echo $old_price; ?></p>
                      <?php endif; ?>
                      <p class="price-box__price"><?php echo $item['price']; ?></p>
                      <p class="price-box__service"><?php echo $item['service']; ?></p>
                      <p class="price-box__service_desc"><?php echo $item['service_desc']; ?></p>
                    </div>
                  </div>

                  <?php
                endif;
              endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
