<?php
/**
 * Dynamic post sorting functions file
 * 
 * This file is attached to functions.php.
 * It contains all functions that determine post ordering based on order cookies
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Functions
 * @since 1.1
 * @author MichalB
 */


/**
 * Add a submenu to acf "314 options" page with a redirect to custom tax edit page
 */
function add_acf_options_taxonomy_submenu(){
	add_submenu_page( 'acf-options-314-theme', 'Kategorie ofert', 'Kategorie ofert', 'manage_options', admin_url('edit-tags.php').'?taxonomy=offer-relationship', null);
}
add_action( 'admin_menu', 'add_acf_options_taxonomy_submenu', 110); //needs a high enough priority to work correctly, otherwise menus get corrupted


/**
 * Highlight the offer relationship submenu (doesn't highlight on it's own when active)
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param string $parent_file parent menu item slug
 * @return string
 */
function menu_highlight( $parent_file ){
	global $current_screen; //WP_Screen instance (class used to implement an admin screen api)
	global $submenu_file; //string 
	$taxonomy = $current_screen->taxonomy; 
	if ( $taxonomy == 'offer-relationship' ) {
		$parent_file = 'acf-options-314-theme';//both of these facilitate the highlight
		$submenu_file =  admin_url('edit-tags.php').'?taxonomy=offer-relationship';
	}
	return $parent_file;
}
add_action( 'parent_file', 'menu_highlight' );


/**
 * Creates a button in offer relationship taxonomy screen that runs the regeneration function
 * 
 * @param string $taxonomy
 * @author MichalB
 * @since 1.1
 * 
 * @return void|false
 */
function add_offer_relationship_regenerate_button($taxonomy) {
	global $current_user;
	if ($current_user->user_login !== '314-dev' && !is_admin()) return false;
	$regenerateUrl = admin_url( 'admin-post.php' ); //preventdefault this in js if you want an actual ajax call
    echo "<form action='".$regenerateUrl."' method='post' style='display: inline-block; margin-right: 16px'>";
	echo '<input type="hidden" name="action" value="pi_reset_relationship_taxonomy"/>';
    echo "<input type='hidden' name='taxonomy' value='".$taxonomy."'>";
    echo "<input class='button button-link-delete' type='submit' value='ZRESETUJ TAKSONOMIĘ' onclick='return confirm(&quot;Ta akcja skasuje wszystkie elementy tej taksonomii i następnie stworzy nowe na podstawie danych ofertowych. &bsol;n&bsol;n WSZYSTKIE ISTNIEJĄCE RELACJE ZOSTANĄ USUNIĘTE. TEJ AKCJI NIE MOŻNA COFNĄĆ. CZY JESTEŚ PEWIEN?&quot;)'></form>";

	$regenerateUrl2 = admin_url('admin-post.php'); //preventdefault this in js if you want an actual ajax call
	echo "<form action='".$regenerateUrl2."' method='post' style='display: inline-block'>";
	echo '<input type="hidden" name="action" value="pi_sync_relationship_taxonomy"/>';
    echo "<input type='hidden' name='taxonomy' value='".$taxonomy."'>";
    echo "<input class='button button-link-delete' type='submit' value='SYNCHRONIZUJ TAKSONOMIĘ' onclick='return confirm(&quot;Ta akcja zsynchronizuje taksonomie relacyjną ofert (doda nieistniejące elementy). &bsol;n&bsol;n TEJ AKCJI NIE MOŻNA COFNĄĆ. CZY JESTEŚ PEWIEN?&quot;)'></form>";
}
add_action('after-offer-relationship-table','add_offer_relationship_regenerate_button');


/**
 * Offer relationship taxonomy regeneration callback
 * 
 * @param bool $delete - set true to delete every term in taonomy first. if false, will only add missing terms
 * @author MichalB
 * @since 1.1
 */
function pi_regenerate_relationship_taxonomy(bool $delete = false){
	global $current_user;
	if ($current_user->user_login !== '314-dev' && !is_admin()) return false;
	if($delete){
		//clear the whole taxonomy
		$terms = get_terms( array(
			'taxonomy' => 'offer-relationship',
			'hide_empty' => false
		));
		foreach ( $terms as $term ) {
			wp_delete_term($term->term_id, 'offer-relationship'); 
		}
	}

	//get all offers
	$offers = get_posts(array(
		'posts_per_page' => -1,
		'post_type' => offer_post_types(),
		'status' => 'any', //don't want to unsync trashed. if draft, can sync before publishing, etc
	));
	$newTerms = [];
	//create terms based on offers, basically a slug/name 1:1
	foreach ($offers as $offer) {
		if (empty(term_exists($offer->post_name, 'offer-relationship'))) {
			$newTerms[] = $term = wp_insert_term($offer->post_title, 'offer-relationship', [
				'slug' => $offer->post_name,
			]);
			//add the term to the offer it was based on
			wp_set_post_terms($offer->ID, array($term['term_id']), 'offer-relationship', true);
		}
	}
	//success
	//doing ajax? 
	if(wp_doing_ajax()) wp_send_json_success(array('terms' => $newTerms), 201);
	//otherwise redirect with success parameter (gets grabbed in admin_notices)
	wp_safe_redirect( admin_url('edit-tags.php').'?taxonomy=offer-relationship&taxonomy-regenerated=true' );
}

/**
 * Taxonomy sync/reset callbacks
 */
add_action('wp_ajax_pi_reset_relationship_taxonomy','pi_reset_relationship_taxonomy');
add_action('admin_post_pi_reset_relationship_taxonomy','pi_reset_relationship_taxonomy');
function pi_reset_relationship_taxonomy() {return pi_regenerate_relationship_taxonomy(true);}
add_action('wp_ajax_pi_sync_relationship_taxonomy','pi_sync_relationship_taxonomy');
add_action('admin_post_pi_sync_relationship_taxonomy','pi_sync_relationship_taxonomy');
function pi_sync_relationship_taxonomy() {return pi_regenerate_relationship_taxonomy(false);}


/**
 * Show success notice on offer relationship taxonomy regeneration
 * @author MichalB
 * @since 1.1
 */
function relationship_regenerate_notice__success(){
	global $pagenow; //current page string
    // catch the regeneration success page argument
    if ('edit-tags.php' === $pagenow && ! empty($_GET['taxonomy-regenerated'])) //parameter set in regeneration function
    {?>
        <div class="notice notice-success is-dismissible">
			<p><?php _e( 'Pomyślnie zregenerowano taksonomię', 'sample-text-domain' ); ?></p>
		</div>
    <?php }
}
add_action( 'admin_notices', 'relationship_regenerate_notice__success' );


/**
 * Save a cookie with relation offer data
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param WP_Post[] $posts Array of post objects
 * @param WP_Query $query WP_Query instance (passed by reference)
 * @return WP_Post[] $posts
 */
function save_offer_relation_cookie($posts, $query){
	
    //guard if it's a main query, viewed post is single of specific type and there's user consent (accepted cookies)
	if(empty($posts) || !AreOptionalCookiesAccepted() || !$query->is_main_query() || !$query->is_singular( ) || !isset($query->query['post_type']) || !in_array($query->query['post_type'], offer_post_types())) return $posts;
	$firstPost = $posts[0];
	$relationshipTerms = get_the_terms( $firstPost, 'offer-relationship' ); //grab the relationship data
	if(!$relationshipTerms) return $posts;
	$relationshipTerms = array_column($relationshipTerms, 'term_id'); //this returns an array of term ids
	$oldCookie = $_COOKIE['piRelation'] ?? ''; //get the old cookie in case values need to be merged
	$oldCookie = explode(',', $oldCookie);
	$cookieData = array_unique(array_merge($relationshipTerms,$oldCookie)); //merge cookie data and new term data
	setcookie('piRelation', implode(",", $cookieData), time()+604800, '/'); //set the cookie - array of term ids, store for a week, main path (so the cookie is visible on the entire site)
	return $posts;

}
add_action('the_posts', 'save_offer_relation_cookie', 10, 2);


/**
 * Check if optional cookies are accepted.
 * 
 * Implement appropriate callback based on plugin used and call this function ONLY
 * 
 * @author MichalB
 * @since 1.1
 * @return bool acceptance status
 */
function AreOptionalCookiesAccepted(){
	if ( function_exists( 'gdpr_cookie_is_accepted' ) ) {
		return gdpr_cookie_is_accepted( 'advanced' ) ? true : false;
	}
	return false;
}


/**
 * Rearrange posts in a query if there's a relationship cookie set
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param WP_Post[] $posts array of post objects
 * @param WP_Query $query WP_Query instance (passed by reference)
 * @return WP_Post[] $posts
 */
function rearrange_posts_by_offer_relation($query){
	if(is_admin() || $query->get('pi_skip_rearrange', false) == true || $query->get('name') != ''  || $query->get('posts_per_page') == 1 || $query->get('fields') == 'ids') return $query; //main quard
	$acceptedPostTypesToFilter = get_field('dynamically_sorted_post_types', 'options'); //list of post types to rearrange (set in options)
	//guards - need to be accepted post type and with an existing cookie
	if(!isset($query->query['post_type'])) return $query; //type quard, we're manipulating post types below
	$postType = is_array($query->query['post_type']) ? $query->query['post_type'] : [$query->query['post_type']];		
	if(!$acceptedPostTypesToFilter  || empty(array_intersect($postType, $acceptedPostTypesToFilter))) return $query; 
	if(!$cookie = $_COOKIE['piRelation'] ?? null) return $query; //no cookie = no sorting
	$cookie =  array_filter(explode(",", htmlspecialchars(strip_tags($cookie)))); //cookie is an array of taxonomy term ids

	//get a complete array of offer relationship terms
	$terms = get_terms( array(
		'taxonomy' => 'offer-relationship',
		'hide_empty' => false
	));
	//create a tax query - this is a bit counterintuitive, since it looks like it fetches posts that both are and aren't in a taxonomy
	//but the main purpose of this argument is that it creates an sql join with the term_relationship table (which we will use in a posts_fields hook)
	$taxQuery = array(
		'relation' => 'OR',
		array(
			'taxonomy'  => 'offer-relationship',
			'field'     => 'term_id',
			'terms'     => array_column($terms, 'term_id'), 
		),
		array(
			'taxonomy'  => 'offer-relationship',
			'field'     => 'term_id',
			'terms'     => array_column($terms, 'term_id'),
			'operator'  => 'NOT IN'
		)
	);
	$query->set('pi_skip_rearrange', true ); //set a flag to skip rearranging this query(in case it got filtered again, and also for the side query)

	//clone the main query and execute it with additional arguments to fetch all posts of the required type
	$sideQuery = $query->query_vars;
	$sideQuery['tax_query'] = $taxQuery; //add the above tax query
	$sideQuery['posts_per_page'] = -1; //remove post limit
	$sideQuery['suppress_filters'] = false; //remove filter supporession
	$sideQuery['add_taxonomy_ids'] = true; //trip the filter to add concatenated term ids in a query
	$allPosts = get_posts($sideQuery);

	foreach($allPosts as $allPost) $allPost->termids = explode(',', $allPost->termids); //prepare term id arrays for comparison
	$temporaryPostArray = []; 
	//sort all posts according to the cookie term id order
	foreach($cookie as $termid){
		foreach($allPosts as $key => $curpost){
			if(in_array($termid, $curpost->termids)) { //cut a post out of the main array if it's in a currently looked-up term and store it in a temporary array
				$temporaryPostArray[] = $curpost; 
				unset($allPosts[$key]);
			}
		}
	}
	$finalPosts = array_merge($temporaryPostArray, $allPosts); //merge back in after sorting
	$finalPostIds = array_column($finalPosts, 'ID');

	//now use the sorted posts to modify the main query orderby argument
	//first, set the post__in arg, which will fetch only posts with provided ids (all posts in our case)
	//then, use the post__in as orderby argument, which will order posts according to the post__in array (which is our sort order)
	$query->set('post__in', $finalPostIds);
	$originalOrderby = $query->get('orderby', []);
	if(is_array($originalOrderby)) {
		$originalOrderby['post__in'] = 'ASC';
	}
	if(is_string($originalOrderby)) $originalOrderby = "post__in ".$originalOrderby;
	$query->set('orderby', $originalOrderby);
	return $query;
}
add_filter('pre_get_posts', 'rearrange_posts_by_offer_relation', 10, 2);


/**
 * Add a group_concat field to a select in a query that returns a list of tax ids
 * 
 * This will only fire if a custom query arg 'add_taxonomy_ids' is set. Only set it
 * If there's a joined term_relationship table in the query string already, either 
 * through a tax query or manually.
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param string $fields select string of the query
 * @param WP_Query $query WP_Query instance (passed by reference)
 */
function pi_query_add_taxonomy_ids($fields, $query) : string{
	if(is_admin() || !$query->get('add_taxonomy_ids', false)) return $fields;
	$fields .= ", group_concat(kjsiv_term_relationships.term_taxonomy_id) as termids";
	return $fields;
}
add_filter('posts_fields', 'pi_query_add_taxonomy_ids', 10, 2);


/**
 * Add a semi-dynamic list of options to a sorting-enabling acf field
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param array $field array of field options
 * @return array
 */
function pi_set_offer_relationship_post_types( $field ){
    // Reset choices
    $field['choices'] = array();
	//get public types (excludes trash like 'revision' and other super internal stuff) and exclude attachments, don't need those at all
	$post_types = array_diff(get_post_types(array('public' => true), 'names', 'and'), ['attachment']);
	//iterate and add choices to the field based on post types
    if( is_array($post_types) ) {
        foreach( $post_types as $type ) {
            $field['choices'][ $type ] = $type;
        }
    }
    return $field;
}
add_filter('acf/prepare_field/name=dynamically_sorted_post_types', 'pi_set_offer_relationship_post_types');
add_filter('acf/prepare_field/name=post_types_with_offer_relationship', 'pi_set_offer_relationship_post_types');


/**
 * Callback that reorders a repeater field based on a relation cookie value.
 * 
 * Each repeater element MUST contain a subfield with taxonomy ids, named 'related_offer'
 * To include a repeater in this callback add a filter to it below
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param mixed $value - field value (should be an array)
 * @param int|string $post_id id of the post where the value is saved
 * @param array $field array of field settings
 * @return mixed $value
 */
function reorder_repeater_if_offer_cookie_set($value, $post_id, $field ){
	if(is_admin() || !is_array($value) || count($value) == 1) return $value; //return in admin, non array, on single length
	//in single offer posts, sort by this offer term (this is because in single offers the cookie has been saved, but not read yet)
	if(is_singular(offer_post_types())) {
		global $post;
		$relationshipTerms = get_the_terms( $post->ID, 'offer-relationship' ); //grab the relationship data
		if(!$relationshipTerms) return $value;
		$cookie = array_column($relationshipTerms, 'term_id'); //this returns an array of term ids
	}else {
		if(!$cookie = $_COOKIE['piRelation'] ?? null) return $value;
		$cookie = explode(",", htmlspecialchars(strip_tags($cookie))); //cookie is an array of taxonomy term ids
	}
	$temp_first = []; //temporary repeater value holder
	foreach($cookie as $termId) { //iterate through every term id, then through every repeater element
		foreach($value as $key => $post) { 
			if(in_array_assoc_r($termId, $post, 'related_offer')) { //check if any repeater value is a relation identifier (this is recursive)
				$temp_first[] = $value[$key]; //add the value to temporary array
				unset($value[$key]); //and remove it from the main value array
			}
		}
	}
	$value = array_merge($temp_first, $value); //finally, merge the arrays, putting the filtered values at the front
	return $value;
}
add_filter('acf/format_value/name=pricetables', 'reorder_repeater_if_offer_cookie_set', 10, 3);
add_filter('acf/format_value/name=hero', 'reorder_repeater_if_offer_cookie_set', 10, 3);
add_filter('acf/format_value/name=testimonials', 'reorder_repeater_if_offer_cookie_set', 10, 3);


/**
 * Checks if an int value exists in a multidimensional array and is under as given key. This function is recursive.
 * 
 * @author MichalB
 * @since 1.1
 * @todo remove strict comparison
 * 
 * @param string|int $needle value to search for
 * @param array $haystack array to traverse
 * @param string $searchKey array key to compare agains
 * @return bool true if match found, false otherwise
 */
function in_array_assoc_r($needle, $haystack, $searchKey){
	foreach ($haystack as $key => $item) {
		if (($key == $searchKey && $item == $needle) || (is_array($item) && (in_array(intval($needle), $item, true) || in_array_assoc_r($needle, $item, $searchKey)))) {
			return true;
		}
	}
	return false;
}


/**
 * Adds a notice to the blog_posts flex subfield if blog posts are dynamically sorted
 * 
 * Note that prepare_field loads later in the lifecycle, when the field is about to be rendered
 * If you run this through load_field, the modified value will be saved into the field's config permanently
 * 
 * @author MichalB
 * @since 1.1
 * 
 * @param array $field array of field options
 * @return array
 */
function pi_add_notice_to_dynamic_post_flex_field( $field ){
	$acceptedPostTypesToFilter = get_field('dynamically_sorted_post_types', 'options');
	if(in_array('post', $acceptedPostTypesToFilter)) $field['instructions'] .= ' UWAGA. Opcja sortowania dynamicznego postów blogowych jest aktywna.';
    
	return $field;
}
add_filter('acf/prepare_field/key=field_6596bb4a4d185', 'pi_add_notice_to_dynamic_post_flex_field');
