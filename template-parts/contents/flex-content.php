<?php

/**
 * Flex content renderer
 * 
 * This file parses the flex content fields in pages and displays suitable template parts. 
 *
 * @package TemplateParts\Contents
 * @since 1.0
 * @author Amelia
 * 
 */
if (have_rows('flex_content')) :
  while (have_rows('flex_content')) : the_row();


    // TEXT SECTION
    if (get_row_layout() == 'text_section') :
      get_template_part('template-parts/flex-sections/text-section');

    // ICONS SECTION
    elseif (get_row_layout() == 'icons_section') :
      get_template_part('template-parts/flex-sections/icons-section');

    // GALLERY SECTION
    elseif (get_row_layout() == 'gallery_section') :
      get_template_part('template-parts/flex-sections/gallery-section');

    // OFFER SECTION
    elseif (get_row_layout() == 'offer_section') :
      get_template_part('template-parts/flex-sections/offer-section');

    // TEAM SECTION
    elseif (get_row_layout() == 'team_section') :
      get_template_part('template-parts/flex-sections/team-section');

    // BLOG SECTION
    elseif (get_row_layout() == 'blog_section') :
      get_template_part('template-parts/flex-sections/post-section');

    // DYNAMIC SINGLE OFFER SECTION
    elseif (get_row_layout() == 'dynamic_single_offer_section') :
      get_template_part('template-parts/flex-sections/dynamic-single-offer-section');

    // TEXT SECTION CTA
    elseif (get_row_layout() == 'text_section_cta') :
      get_template_part('template-parts/flex-sections/text-section-cta');

    // LANDIG PAGE SECTIONS
    // LP: HERO
    elseif (get_row_layout() == 'lp_hero') :
      get_template_part('template-parts/flex-sections/lp-hero');

    // LP: DOCTOR
    elseif (get_row_layout() == 'lp_doctor') :
      get_template_part('template-parts/flex-sections/lp-doctor');

    // LP: OFFER
    elseif (get_row_layout() == 'lp_offer') :
      get_template_part('template-parts/flex-sections/lp-offer');

    // LP: PRICETABLE
    elseif (get_row_layout() == 'lp_pricetable') :
      get_template_part('template-parts/flex-sections/lp-pricetable');

    // LP: TESTIMONIALS
    elseif (get_row_layout() == 'lp_testimonials') :
      get_template_part('template-parts/flex-sections/lp-testimonials');

    // LP: CONTACT
    elseif (get_row_layout() == 'lp_contact') :
      get_template_part('template-parts/flex-sections/lp-contact');



    endif;

  endwhile;
endif;
