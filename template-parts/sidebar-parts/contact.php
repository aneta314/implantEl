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
$contact_group = get_field('contact_group', 'options'); ?>
<div class="sidebar__item sidebar__item--sticky d-none d-lg-block">
    <div class="contact">
        <h5 class="headline headline--xs"><?php pi_e('Skontaktuj się z nami', 'pi'); ?> </h5>
        <div class="standard-format">
        </div>
    </div>