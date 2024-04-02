<?php

/**
 * 'Book the appointment' sidebar element
 * 
 * Sidebar part that renders a CTA element for booking an appointment (displaying the form)
 *
 * @package TemplateParts\SidebarParts
 * @since 1.0
 * @author Amelia
 */

/** @var array $contact_group array of contact information (phone numbers, address, opening hours etc) */
$contact_group = get_field('contact_group', 'options');
$permalink = get_the_permalink(73);
?>
<div class="sidebar__item sidebar__item--sticky d-none d-lg-block">
    <div class="contact">
        <h5 class="headline headline--xs"><?php pi_e('Skontaktuj się z nami', 'pi'); ?> </h5>
        <div class="standard-format">
            <!-- ADDRESS -->
            <p>
                <i class="icon-location"></i>
                <!-- <a href="<?php the_field('google_map_link', 'options') ?>" target="_blank"> -->
                <?php echo $contact_group['street']; ?>, <?php echo $contact_group['city_code']; ?> <?php echo $contact_group['city']; ?>
                <!-- </a> -->
            </p>

            <!-- HOURS -->
            <p>
                <i class="icon-clock"></i>
                <?php echo $contact_group['hours']; ?>
            </p>

            <!-- PHONE -->
            <p class="sidebar__contact--phone">
                <i class="icon-phone"></i>
                <?php echo do_shortcode('[hidden-number phone="' . $contact_group['phone'] . '"]'); ?>
            </p>

            <!-- MAIL -->
            <p>
                <i class="icon-mail-alt"></i>
                <a href="mailto:<?php echo $contact_group['mail']; ?>"><?php echo $contact_group['mail']; ?></a>
            </p>

            <div class="d-flex mb-3">
                <a href="<?php echo $permalink; ?>" class="btn smooth-scroll"> <?php pi_e('Przejdź do kontaktu', 'pi'); ?> </a>
            </div>
        </div>
    </div>
</div>