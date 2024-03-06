<?php
/**
 * Landing page doctor section
 * 
 * Renders a landing-page-style team section.
 * LP team section differs significantly from a regular team section. Most importantly,
 * it contains testimonial links for ZL for each doctor, and has a vastly different layout.
 * This section renders ONLY as a carousel.
 * Flex sections are called when flex-content field is rendered.
 *
 * @package TemplateParts\FlexSections
 * @since 1.0
 * @author Amelia
 * 
 */

//flex section data
$group = get_sub_field('group');
//doctors array - this is a multidimensional associative array
$doctors = $group['doctors'];
?>
<div class="lp-doctor section-margin-bottom">
  <div class="container">
    <?php if($doctors): ?>
      <div class="owl-lp-doctors owl-carousel owl-theme">
        <?php
        foreach($doctors as $dr):
          $intro = $dr['intro'];
          $title = $dr['title'];
          //determining the header type
          $markup = array_key_exists('title_markup', $dr) && $dr['title_markup'] ? $dr['title_markup'] : 'p';
          $content = $dr['content'];
          $link = $dr['link'];
          $image = $dr['image'];
          $display_zl = $dr['zl'];
          ?>
          <div class="item">
            <div class="lp-doctor__row">
              <?php if($display_zl): ?>
                <div class="lp-doctor__col-zl">
                  <!-- HARD CODED - ZNANY LEKARZ -->
                  <div class="zl">
                    <img class="zl__logo" src="<?php echo get_template_directory_uri(); ?>/img/znany-lekarz.svg" alt="Znany lekarz">
                    <p class="zl__count">100%</p>
                    <p class="zl__desc"> <?php pi_e('Zadowolonych pacjentów z usług lekarza', 'pi'); ?></p>
                    <a href="#testimonials" class="smooth-scroll zl__btn"><?php pi_e('Zobacz opinie', 'pi'); ?> </a>
                  </div>
                </div>
              <?php endif; ?>
              <div class="lp-doctor__col-content">
                <!-- HEADER -->
                <div class="lp-doctor__header">

                  <?php if($image): ?>
                    <div>
                      <!-- PHOTO -->
                      <div class="lp-doctor__photo">
                        <?php
                        if($image):
                          echo wp_get_attachment_image($image, 'thumbnail', false, array('class' => 'absolute-img'));
                        endif; ?>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div>
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
                    ?>
                  </div>
                </div>

                <!-- CONTENT -->
                <div class="standard-format">
                  <?php echo $dr['content']; ?>
                </div>

                <?php
                // BTN
                if($link):
                  $link_target = $link['target'] ? $link['target'] : '_self'; ?>
                  <a href="<?php echo $link['url']; ?>" class="btn btn--secondary smooth-scroll" target="<?php echo esc_attr( $link_target ); ?>" ><?php echo $link['title']; ?></a>
                <?php
                endif; ?>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
