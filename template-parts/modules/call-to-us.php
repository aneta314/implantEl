<?php 
/**
 * 'Call us' module
 * 
 * Displayed on mobile devices, a button-like element that enables a phone call
 *
 * @package TemplateParts\Modules
 * @since 1.0
 * @author Amelia
 * 
 */

 //array of contact info
$contact_group = get_field('contact_group', 'options'); ?>
<div class="call-to-us">
  <a href="tel:<?php echo str_replace(' ', '', $contact_group['phone']); ?>"></a>
  <i class="icon-phone call-to-us__icon"></i>
</div>
