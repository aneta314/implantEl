<?php

/**
 * Mobile header section
 * 
 * Header section displayed on tablet/mobile devices(based on screen width).
 * Displays the logo, menu etc. Does not display contact group elements
 *
 * @package TemplateParts\Sections
 * @since 1.0
 * @author Amelia
 */

//array of logo data
$logo = get_field('logo', 'options'); ?>
<header class="header-mobile">
  <div class="header-mobile__sticky">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">

        <!-- LOGO -->
        <div class="header-mobile__logo-anchore">
          <a href="<?php echo site_url(); ?>">
            <img src="<?php echo $logo['url']; ?>" alt="<?php if ($logo['alt'] != '') : echo $logo['alt'];
                                                        else : bloginfo('title');
                                                        endif; ?>">
          </a>
        </div>


        <div class="d-flex align-items-center">

          <!-- BUTTON -->
          <a href="#" class="header-mobile__btn btn" show-popup="#booking-popup">
            <?php pi_e('Umów wizytę', 'pi'); ?>
          </a>

          <!-- HAMBURGER -->
          <div class="header-mobile__hamburger hamburger hamburger--spring">
            <div class="hamburger-box">
              <div class="hamburger-inner"></div>
            </div>
          </div>

        </div>
      </div>
    </div>


    <!-- MOBILE NAV -->
    <nav class="nav-mobile">
      <div class="container">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'menu-1',
        ));
        ?>

        <?php get_template_part('template-parts/modules/social-media'); ?>
      </div>
    </nav>

  </div>

</header>