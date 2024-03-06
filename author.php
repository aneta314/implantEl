<?php 
/**
 * Catches any author page request and sets a 404 response.
 * 
 * This template denies all requests for author archive pages. There's no need
 * for these pages in the theme, so we're just returning a 404 response.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#author-display
 *
 * @package Pages
 * @since 1.0
 * @author MichalB
 */

global $wp_query;
$wp_query->set_404();
status_header( 404 );
get_template_part( 404 ); exit();