<?php

/**
 * 'About' sidebar element
 * 
 * Sidebar part that renders info about the website, with a visit registration CTA and a phone number
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

/** @var array $contact_group array of contact information (phone numbers, address, opening hours etc) */
$contact_group = get_field('contact_group', 'options'); ?>

<div class="sidebar__item sidebar__item--sticky">
  <h5 class="headline headline--xs"><?php echo get_bloginfo('name'); ?></h5>
  <div class="standard-format">
    <p class="center"> <?php the_field('blog_about', 'options'); ?></p>
    <div class="d-flex justify-content-center mb-4">
      <a href="#" class="btn" show-popup="#booking-popup"> <?php pi_e('Umów wizytę', 'pi'); ?> </a>
    </div>

    <div class="d-flex justify-content-center mb-2">
      <i class="icon-phone"></i>
      <?php echo do_shortcode('[hidden-number phone="' . $contact_group['phone'] . '"]'); ?>
    </div>

  </div>
</div>