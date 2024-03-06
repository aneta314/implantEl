<?php

/**
 * Desktop header section
 * 
 * Header section displayed on desktops(based on screen width).
 * Displays the logo, contact info, menu etc.
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

//array of logo data
$logo = get_field('logo', 'options');
//array of contact data
$contact_group = get_field('contact_group', 'options'); ?>

<header class="header-desktop">
  <div class="container">
    <div class="row">

      <div class="col-lg-2 d-flex align-items-center">
        <a class="header-desktop__logo-anchore" href="<?php echo site_url(); ?>">
          <img class="header-desktop__logo" src="<?php echo $logo['url']; ?>" alt="<?php if ($logo['alt'] != '') : echo $logo['alt'];
                                                                                    else : bloginfo('title');
                                                                                    endif; ?>">
        </a>
      </div>

      <div class="col-lg-10">
        <address class="d-flex flex-wrap align-items-center justify-content-end">

          <!-- ADDRESS -->
          <div class="mr-4">
            <i class="icon-location"></i>
            <a href="<?php the_field('google_map_link', 'options') ?>" target="_blank">
              <span class="icon-pin"></span>
              <?php echo $contact_group['street']; ?>, <?php echo $contact_group['city_code']; ?> <?php echo $contact_group['city']; ?>
            </a>
          </div>

          <!-- PHONE -->
          <div>
            <i class="icon-phone"></i>
            <?php echo do_shortcode('[hidden-number phone="' . $contact_group['phone'] . '"]'); ?>
          </div>

          <!-- POP UP BTN -->
          <div class="ml-4">

            <a href="#" class="btn" show-popup="#booking-popup"> <?php pi_e('Umów wizytę', 'pi'); ?> </a>
          </div>

        </address>

        <!-- DESKTOP NAV -->
        <nav class="nav-desktop">
          <?php
          wp_nav_menu(array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
          ));
          ?>
        </nav>

      </div>
    </div>
  </div>

</header>