<?php
/**
 * Landing page header section
 * 
 * Header section displayed on landing pages
 * Main difference is the lack of main menu and some contact elements/CTAs
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

 //array of logo data
$logo = get_field('logo', 'options');
//array of contact data
$contact_group = get_field('contact_group', 'options'); ?>

<header class="header-lp">
  <div class="container">

		<div class="row">
			<div class="col-sm-4">
          <img class="header-lp__logo" src="<?php echo $logo['url']; ?>" alt="<?php if($logo['alt'] != ''): echo $logo['alt']; else: bloginfo('title'); endif; ?>">
			</div>
			<div class="col-sm-8 d-none d-sm-block">
				<address class="header-lp__address">

					<!-- PHONE -->
          <div class="header-lp__address__item">
            <i class="icon-phone"></i>
            <?php echo do_shortcode('[hidden-number phone="'.$contact_group['phone'].'"]'); ?>
          </div>

          <!-- ADDRESS -->
          <div class="header-lp__address__item">
            <i class="icon-location"></i>
            <a href="<?php the_field('google_map_link', 'options')?>" target="_blank">
              <span class="icon-pin"></span>
              <?php echo $contact_group['street']; ?>, <?php echo $contact_group['city']; ?>
            </a>
          </div>
        </address>
			</div>
		</div>
  </div>
</header>
