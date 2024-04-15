<?php
if (!function_exists('pi_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 * @author Unknown
	 * @since 1.0
	 */
	function pi_setup()
	{
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain('pi', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => 'Primary',
			'footer-1' => 'Footer 1',
			'footer-2' => 'Footer 2',
		));

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('pi_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));

		add_image_size('mobile', 400);
		add_image_size('hd', 1920);
	}
endif;
add_action('after_setup_theme', 'pi_setup');

/**
 * Remove default image sizes
 * @author unknown
 * @since 1.0
 */
function pi_remove_default_image_sizes($sizes)
{
	unset($sizes['thumbnail']); // 150x150
	//unset( $sizes['medium_large']); // 768x0
	unset($sizes['medium']); //300x300
	unset($sizes['large']); // 1024x1024
	unset($sizes['1536x1536']);
	unset($sizes['2048x2048']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'pi_remove_default_image_sizes');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 * @author Unknown
 * @since 1.0
 *
 * @global int $content_width
 */
function pi_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('pi_content_width', 640);
}
add_action('after_setup_theme', 'pi_content_width', 0);

/**
 * Register widget area.
 * @author Unknown
 * @since 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pi_widgets_init()
{
	register_sidebar(array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Dodaj widgety tutaj.',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'pi_widgets_init');

/**
 * Enqueue scripts and styles.
 * @author Unknown
 * @since 1.0
 */
function pi_scripts()
{
	// wp_enqueue_style('pi-google-fonts', '//fonts.googleapis.com/css2?family=Jost:wght@400;700&display=swap&subset=latin-ext', array(), null);
	wp_enqueue_style('pi-google-fonts', '//fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap', array(), null);
	wp_enqueue_style('pi-style', get_template_directory_uri() . '/css/style.css');

	wp_enqueue_script('pi-injector-svg', get_template_directory_uri() . '/js/svg-injector.min.js', array(), NULL, true);
	wp_enqueue_script('pi-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), NULL, true);
	wp_enqueue_script('pi-images-compare', get_template_directory_uri() . '/js/img-comparison-slider.min.js', array('jquery'), NULL, true);
	wp_enqueue_script('pi-justified-gallery', get_template_directory_uri() . '/js/justifiedgallery.min.js', array(), array('jquery'), true);
	wp_enqueue_script('pi-script', get_template_directory_uri() . '/js/script.js', array('jquery'), NULL, true);

	wp_localize_script('pi-script', 'piData', array(
		'site_url' => get_site_url(),
		'theme_folder_name' => wp_get_theme()->template,
		'template_directory_uri' => get_template_directory_uri()
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'pi_scripts');
