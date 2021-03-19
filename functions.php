<?php
/*
 *  Author: Fabrizio Giannone
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here


$cooltech_includes = array(
		'/class-element.php','/class-wp-bootstrap-navwalker.php', '/blocks.php'   // Load custom WordPress nav walker.
);

foreach ( $cooltech_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}



add_post_type_support( 'page', 'excerpt' );

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
		// 16:9
		add_image_size('wide',800,500,true);
		// 3:2
    add_image_size('medium', 600, 400, true);

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/


		add_filter('acf/settings/remove_wp_meta_box', '__return_false');

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('cooltech', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// cooltech Blank navigation
function cooltech_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
    'container_class' => 'collapse navbar-collapse',
    'container_id'    => 'navbarNavDropdown',
    'menu_class'      => 'navbar-nav ml-auto',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => new WP_Bootstrap_Navwalker()
		)
	);
}

// Load cooltech Blank scripts (header.php)
function cooltech_header_scripts()
{
				wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', array(), '4.3.0'); // Conditionizr
				wp_enqueue_script('jquery');

    	  wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('cooltechscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), time()); // Custom scripts
				wp_localize_script('cooltechscripts','ajax_url', admin_url( 'admin-ajax.php' ));

        wp_enqueue_script('cooltechscripts'); // Enqueue it!

				wp_register_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '4.3.0'); // Conditionizr
				wp_enqueue_script('bootstrapjs');

				wp_register_script('waypoints', get_template_directory_uri()  . '/js/jquery.waypoints.min.js', array( 'jquery' ));
				wp_enqueue_script('waypoints');

				wp_register_script('infinite', get_template_directory_uri()  . '/js/infinite.js', array( 'jquery' ));
				wp_enqueue_script('infinite');

				wp_register_script('sidr', get_template_directory_uri()  . '/js/jquery.sidr.min.js', array( 'jquery' ));
				wp_enqueue_script('sidr');



}

// Load cooltech Blank conditional scripts
function cooltech_conditional_scripts()
{
    if (is_page('site-map')) {
      //  wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
    //    wp_enqueue_script('scriptname'); // Enqueue it!

				wp_register_style('slickmap', get_template_directory_uri() . '/css/slickmap.css', array(), '1.0', 'all');
				wp_enqueue_style('slickmap'); // Enqueue it!
    }
}

// Load cooltech Blank styles
function cooltech_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('cooltech', get_template_directory_uri() . '/style.css', array(), time(), 'all');
    wp_enqueue_style('cooltech'); // Enqueue it!

		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap-ct.css', array(), time(), 'all');
		wp_enqueue_style('bootstrap'); // Enqueue it!

		wp_register_style('theme-css', get_template_directory_uri() . '/css/theme.min.css');
		wp_enqueue_style('theme-css');

		wp_register_style('sidr-css', get_template_directory_uri() . '/css/sidr.dark.min.css');
		wp_enqueue_style('sidr-css');

}

// Register cooltech Blank Navigation
function register_cooltech_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'cooltech'), // Main Navigation
        'top-menu' => __('Top Menu', 'cooltech'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'cooltech'), // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
  return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'cooltech'),
        'description' => __('Description for this widget-area...', 'cooltech'),
        'id' => 'primary',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Sidebar Case Study', 'cooltech'),
        'description' => __('Description for this widget-area...', 'cooltech'),
        'id' => 'case-study',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

function add_http($url) {
	$parsed = parse_url($url);
	if (empty($parsed['scheme'])) {
    $url = 'http://'.ltrim($url, '/');
	}
  return $url;
}

function createLink($text) {
	$preg_match = '@(http)?(s)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
	$text = preg_replace($preg_match, '<a href="http$2://$4" target="_blank" title="$0">$0</a>', $text);
	return $text;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function cooltechwp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function cooltechwp_index($length) // Create 20 Word Callback for Index page Excerpts, call using cooltechwp_excerpt('cooltechwp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using cooltechwp_excerpt('cooltechwp_custom_post');
function cooltechwp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function cooltechwp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function cooltech_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'cooltech') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function cooltech_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}



// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}


/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'cooltech_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'cooltech_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'cooltech_styles'); // Add Theme Stylesheet
add_action('init', 'register_cooltech_menu'); // Add cooltech Blank Menu
add_action('init', 'create_post_type_cooltech'); // Add our cooltech Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'cooltechwp_pagination'); // Add our cooltech Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'cooltech_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts

add_filter('style_loader_tag', 'cooltech_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('cooltech_cat', 'cooltech_shortcode_cat'); // You can place [cooltech_shortcode_demo] in Pages, Posts now.
add_shortcode('case_study','show_last_case_study');
add_shortcode('net_to_zero','show_net_to_zero');

add_shortcode('g','find_glossary');
add_shortcode('fn','add_footnote');

add_shortcode('filter_bar','add_filter_bar');
add_shortcode('search_panel','add_search_panel');

add_shortcode('cooltech_shortcode_demo_2', 'cooltech_shortcode_demo_2'); // Place [cooltech_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [cooltech_shortcode_demo] [cooltech_shortcode_demo_2] Here's the page title! [/cooltech_shortcode_demo_2] [/cooltech_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called cooltech-Blank
function create_post_type_cooltech()
{
  	register_post_type('equipment', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Equipments', 'cooltech'), // Rename these to suit
            'singular_name' => __('Equipment', 'cooltech'),
            'add_new' => __('Add New', 'cooltech'),
            'add_new_item' => __('Add New Equipment', 'cooltech'),
            'edit' => __('Edit', 'cooltech'),
            'edit_item' => __('Edit Equipment', 'cooltech'),
            'new_item' => __('New Equipment', 'cooltech'),
            'view' => __('View Equipment', 'cooltech'),
            'view_item' => __('View Equipment', 'cooltech'),
            'search_items' => __('Search Equipment', 'cooltech'),
            'not_found' => __('No Equipment found', 'cooltech'),
            'not_found_in_trash' => __('No Equipment found in Trash', 'cooltech')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
						'technology-type'
        ), // Go to Dashboard Custom cooltech Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'country','type','manufacturer','refrigerant','application','technology-type','post_tag', 'category'
        ) // Add Category and Post Tags support
    ));
		register_post_type('case-study', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Case Studies', 'cooltech'), // Rename these to suit
            'singular_name' => __('Case Study', 'cooltech'),
            'add_new' => __('Add New', 'cooltech'),
            'add_new_item' => __('Add New Case Study', 'cooltech'),
            'edit' => __('Edit', 'cooltech'),
            'edit_item' => __('Edit Case Study', 'cooltech'),
            'new_item' => __('New Case Study', 'cooltech'),
            'view' => __('View Case Study', 'cooltech'),
            'view_item' => __('View Case Study', 'cooltech'),
            'search_items' => __('Search Case Study', 'cooltech'),
            'not_found' => __('No Case Study found', 'cooltech'),
            'not_found_in_trash' => __('No Case Study found in Trash', 'cooltech')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
				'rewrite'           => array( 'slug' => 'case-studies' ),
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
						'custom-fields',
						'technology-type'
        ), // Go to Dashboard Custom cooltech Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'country',
						'type',
						'manufacturer',
						'refrigerant',
						'application',
						'technology-type',
						'post_tag'
        ) // Add Category and Post Tags support
    ));

		register_post_type('glossary', // Register Custom Post Type
		    array(
		    'labels' => array(
		        'name' => __('Glossary Terms', 'cooltech'), // Rename these to suit
		        'singular_name' => __('Glossary Term', 'cooltech'),
		        'add_new' => __('Add New', 'cooltech'),
		        'add_new_item' => __('Add New Glossary Term', 'cooltech'),
		        'edit' => __('Edit', 'cooltech'),
		        'edit_item' => __('Edit Glossary Term', 'cooltech'),
		        'new_item' => __('New Glossary Term', 'cooltech'),
		        'view' => __('View Glossary Term', 'cooltech'),
		        'view_item' => __('View Glossary Term', 'cooltech'),
		        'search_items' => __('Search Glossary Term', 'cooltech'),
		        'not_found' => __('No Case Glossary Term', 'cooltech'),
		        'not_found_in_trash' => __('No Glossary Term found in Trash', 'cooltech')
		    ),
		    'public' => true,
		    'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		    'has_archive' => true,
		    'supports' => array(
		        'title',
		        'editor',
		        'excerpt',
		        'thumbnail',
		        'custom-fields'
		    ), // Go to Dashboard Custom cooltech Blank post for supports
		    'can_export' => true, // Allows export in Tools > Export
		    'taxonomies' => array(
		    ) // Add Category and Post Tags support
		));
		register_post_type('zero', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Net Zeros', 'cooltech'), // Rename these to suit
            'singular_name' => __('Net Zero', 'cooltech'),
            'add_new' => __('Add New', 'cooltech'),
            'add_new_item' => __('Add New Net Zero', 'cooltech'),
            'edit' => __('Edit', 'cooltech'),
            'edit_item' => __('Edit Net Zero', 'cooltech'),
            'new_item' => __('New Net Zero', 'cooltech'),
            'view' => __('View Net Zero', 'cooltech'),
            'view_item' => __('View Net Zero', 'cooltech'),
            'search_items' => __('Search Net Zero', 'cooltech'),
            'not_found' => __('No Net Zero found', 'cooltech'),
            'not_found_in_trash' => __('No Net Zero found in Trash', 'cooltech')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
						'custom-fields',
						'technology-type'
        ), // Go to Dashboard Custom cooltech Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'country','type','manufacturer','refrigerant','application','technology-type','post_tag'
        ) // Add Category and Post Tags support
    ));
}

add_action( 'init', 'create_cooltech_taxonomies', 0 );

// create two taxonomies, Types and writers for the post type "book"
function create_cooltech_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Sectors', 'taxonomy general name', 'cooltech' ),
		'singular_name'     => _x( 'Sector', 'taxonomy singular name', 'cooltech' ),
		'search_items'      => __( 'Search Sectors', 'cooltech' ),
		'all_items'         => __( 'All Sectors', 'cooltech' ),
		'parent_item'       => __( 'Parent Sector', 'cooltech' ),
		'parent_item_colon' => __( 'Parent Sector:', 'cooltech' ),
		'edit_item'         => __( 'Edit Sector', 'cooltech' ),
		'update_item'       => __( 'Update Sector', 'cooltech' ),
		'add_new_item'      => __( 'Add New Sector', 'cooltech' ),
		'new_item_name'     => __( 'New Sector Name', 'cooltech' ),
		'menu_name'         => __( 'Sector', 'cooltech' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'sector' ),
	);

	register_taxonomy( 'type', array( 'cooltech' ), $args );

	$labels = array(
		'name'              => _x( 'Countries', 'taxonomy general name', 'cooltech' ),
		'singular_name'     => _x( 'Country', 'taxonomy singular name', 'cooltech' ),
		'search_items'      => __( 'Search Countries', 'cooltech' ),
		'all_items'         => __( 'All Countries', 'cooltech' ),
		'parent_item'       => __( 'Parent Country', 'cooltech' ),
		'parent_item_colon' => __( 'Parent Country:', 'cooltech' ),
		'edit_item'         => __( 'Edit Country', 'cooltech' ),
		'update_item'       => __( 'Update Country', 'cooltech' ),
		'add_new_item'      => __( 'Add New Country', 'cooltech' ),
		'new_item_name'     => __( 'New Country Name', 'cooltech' ),
		'menu_name'         => __( 'Country', 'cooltech' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'country' ),
	);
	register_taxonomy( 'country', array( 'cooltech' ), $args );

	$labels = array(
		'name'              => _x( 'Manufacturers', 'taxonomy general name', 'cooltech' ),
		'singular_name'     => _x( 'Manufacturer', 'taxonomy singular name', 'cooltech' ),
		'search_items'      => __( 'Search Manufacturer', 'cooltech' ),
		'all_items'         => __( 'All Manufacturer', 'cooltech' ),
		'parent_item'       => __( 'Parent Manufacturer', 'cooltech' ),
		'parent_item_colon' => __( 'Parent Manufacturer:', 'cooltech' ),
		'edit_item'         => __( 'Edit Manufacturer', 'cooltech' ),
		'update_item'       => __( 'Update Manufacturer', 'cooltech' ),
		'add_new_item'      => __( 'Add New Manufacturer', 'cooltech' ),
		'new_item_name'     => __( 'New Manufacturer Name', 'cooltech' ),
		'menu_name'         => __( 'Manufacturer', 'cooltech' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'manufacturer' ),
	);
	register_taxonomy( 'manufacturer', array( 'cooltech' ), $args );

	$labels = array(
	  'name'              => _x( 'Applications', 'taxonomy general name', 'cooltech' ),
	  'singular_name'     => _x( 'Application', 'taxonomy singular name', 'cooltech' ),
	  'search_items'      => __( 'Search Application', 'cooltech' ),
	  'all_items'         => __( 'All Application', 'cooltech' ),
	  'parent_item'       => __( 'Parent Application', 'cooltech' ),
	  'parent_item_colon' => __( 'Parent Application:', 'cooltech' ),
	  'edit_item'         => __( 'Edit Application', 'cooltech' ),
	  'update_item'       => __( 'Update Application', 'cooltech' ),
	  'add_new_item'      => __( 'Add New Application', 'cooltech' ),
	  'new_item_name'     => __( 'New Application Name', 'cooltech' ),
	  'menu_name'         => __( 'Application', 'cooltech' ),
	);

	$args = array(
	  'hierarchical'      => false,
	  'labels'            => $labels,
	  'show_ui'           => true,
	  'show_admin_column' => true,
	  'query_var'         => true,
	  'rewrite'           => array( 'slug' => 'application' ),
	);
	register_taxonomy( 'application', array( 'cooltech' ), $args );

	$labels = array(
	  'name'              => _x( 'Refrigerants', 'taxonomy general name', 'cooltech' ),
	  'singular_name'     => _x( 'Refrigerant', 'taxonomy singular name', 'cooltech' ),
	  'search_items'      => __( 'Search Refrigerant', 'cooltech' ),
	  'all_items'         => __( 'All Refrigerant', 'cooltech' ),
	  'parent_item'       => __( 'Parent Refrigerant', 'cooltech' ),
	  'parent_item_colon' => __( 'Parent Refrigerant:', 'cooltech' ),
	  'edit_item'         => __( 'Edit Refrigerant', 'cooltech' ),
	  'update_item'       => __( 'Update Refrigerant', 'cooltech' ),
	  'add_new_item'      => __( 'Add New Refrigerant', 'cooltech' ),
	  'new_item_name'     => __( 'New Refrigerant Name', 'cooltech' ),
	  'menu_name'         => __( 'Refrigerant', 'cooltech' ),
	);

	$args = array(
	  'hierarchical'      => false,
	  'labels'            => $labels,
	  'show_ui'           => true,
	  'show_admin_column' => true,
	  'query_var'         => true,
	  'rewrite'           => array( 'slug' => 'refrigerant' ),
	);
	register_taxonomy( 'refrigerant', array( 'cooltech' ), $args );

	$labels = array(
	  'name'              => _x( 'Technology Types', 'taxonomy general name', 'cooltech' ),
	  'singular_name'     => _x( 'Technology Type', 'taxonomy singular name', 'cooltech' ),
	  'search_items'      => __( 'Search Technology Type', 'cooltech' ),
	  'all_items'         => __( 'All Technology Type', 'cooltech' ),
	  'parent_item'       => __( 'Parent Technology Type', 'cooltech' ),
	  'parent_item_colon' => __( 'Parent Technology Type:', 'cooltech' ),
	  'edit_item'         => __( 'Edit Technology Type', 'cooltech' ),
	  'update_item'       => __( 'Update Technology Type', 'cooltech' ),
	  'add_new_item'      => __( 'Add New Technology Type', 'cooltech' ),
	  'new_item_name'     => __( 'New Technology Type Name', 'cooltech' ),
	  'menu_name'         => __( 'Technology Type', 'cooltech' ),
	);

	$args = array(
	  'hierarchical'      => false,
	  'labels'            => $labels,
	  'show_ui'           => true,
	  'show_admin_column' => true,
	  'query_var'         => true,
	  'rewrite'           => array( 'slug' => 'technology-type' ),
	);
	register_taxonomy( 'technology-type', array( 'cooltech' ), $args );

}

function get_sector_from_slug($slug='') {

	if($slug) {
		$t=get_term_by('slug', $slug, 'type');

		$parent=$t->term_id;

		} else {
		$parent=0;
		}

		$terms = get_terms( array(
			'taxonomy' => 'type',
			'hide_empty' => false,
			'parent'=>$parent,
			'orderby'=>'term_order'
			) );
		return $terms;
}

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function cooltech_shortcode_demo_2($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

function find_glossary($atts, $content) {

	if($atts["url"]) {
		$g=get_page_by_path($atts["url"],'','glossary');
	} else if ($atts["id"]) {
		$g=get_post($atts["id"]);
	} else {
		$g=get_page_by_title($content, '', 'glossary' );
	}
	ob_start();?>
	<a class="glossary_suggestion" href="<?php echo home_url(); ?>/glossary#<?php echo $g->post_name; ?>" title="<?php echo $g->post_content ?>"><?php echo $content; ?></a>
	<?php
		$out = ob_get_contents();
		ob_end_clean();
	return $out;

}

function add_footnote($atts, $content) {
	ob_start();
	if($atts["nourl"]) {
		?>
	<a class="footnote" title="<?php echo $content ?>"></a>
<?php	} else {
	?>
	<a class="footnote" href="<?php echo $content; ?>" target="_blank" title="<?php echo $content ?>"></a>
	<?php
		}
		$out = ob_get_contents();
		ob_end_clean();
	return $out;
}



function cooltech_shortcode_cat($atts, $content = null)
{

	if($atts["cat"]) {
		$slug=$atts["cat"];
	//	$terms=get_sector_fron_slug($slug);
		$terms=get_sector_from_slug($slug);
	} else {

	$q = get_queried_object();

		if($q) {
			$slug=$q->slug;
		}
	$terms=get_sector_from_slug($slug);
	}
	ob_start();
 	//	print_r($terms);
	// 	echo $slug;
	switch(count($terms)) {

		case 2:
		$cols="col-md-4 col-sm-4";
		break;
		case 3:
		$cols="col-md-4 col-sm-12";
		break;
		default:
		$cols="col-md-3 col-sm-6";
		break;
	}
	?>
	<section class="category-list <?php echo $slug; ?>">
		<div class="container">
		<?php

				if($atts["lineparent"]=="1") {
					?>
						<div class="row titolo_lineparent">
							<div class="col-sm-12">
						 	<?php $term = get_term_by('slug', $slug, 'type'); $name = $term->name; ?>

								<div><img class="icon-category" src="<?php echo get_template_directory_uri();?>/img/icon-<?php echo $slug;?>-net.svg" width="120" alt="Icon <?php echo $t->name; ?>"></div>
								<div class="title_h2 <?php echo $slug; ?>"><?php echo $name; ?> </div>
							</div>
						</div>
					<?php
				}
	 			?>
				<div class="row justify-content-center">
					<?php foreach ( $terms  as $t ) { ?>
					<?php
						if($atts["link"]) {
							$link=home_url()."/sector/". $t->slug."?".$atts["link"];
							$classzero="icon-zero";
						} elseif ($atts["page"]) {
							$link=home_url()."/path-to-zero-".$slug;
							$classzero="";
						} else {
							$link=home_url()."/sector/". $t->slug;
							$classzero="";
						}
						?>

						<div class="<?php echo $cols;?> cat_col">
							<?php if($atts["logo"]) { ?>
								<div class="cat_icon text-sm-left"> <img class="<?php echo $classzero; ?> icon-category" src="<?php echo get_template_directory_uri();?>/img/icon-<?php echo $t->slug;?>.svg" alt="Icon <?php echo $t->name; ?>"> </div>
							<?php
							}
							?>
								<div class="cat_title text-sm-left"><h3><?php echo $t->name; ?><?php if($name) { echo "&nbsp; ".$name; }?></h3> </div>
								<div class="cat_desc text-sm-left align-items-stretch"> <?php
								if($atts["lineparent"]=="1") {
									$desc=get_term_meta($t->term_id, 'net_to_zero_intro', true );
									echo $desc;
								} else {
									echo do_shortcode($t->description);
							 	}
									?>
							  </div>
								<div class="cat_button">

									<a href="<?php echo $link;?>" class="btn btn-rounded btn-block btn-outline-dark <?php echo $slug; ?>">
										<?php _e("Enter Database", "cooltech"); ?>
									</a>
								</div>
						</div>
		<?php } ?>
			</div>
		</div>
		</section>

		<?php
			$out = ob_get_contents();
			ob_end_clean();
    return $out;
}

function show_last_case_study() {
$args=array("post_type"=>"case-study","numberposts"=>1,'meta_key'   => 'expand',
'meta_value' => true);
	$cs=get_posts($args);

	$image_id=get_post_thumbnail_id( $cs[0]->ID );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
		ob_start();
?>
<section id="case-study-homepage" style="height: 100vh;background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php echo $post_thumbnail_img[0]; ?>')">
<?php		// print_r($cs);
		?>
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-center">
						<div class="case-study-label"><?php _e("CASE STUDY","cooltech"); ?> </div>
	          <h1 class="text-white font-weight-bold"><a class="text-white" href="<?php echo site_url(); ?>/case-studies"><?php echo $cs[0]->post_title; ?></a></h1>
						<div class="text-white case-study-home-excerpt"><?php echo $cs[0]->post_excerpt; ?> </div><div>
						<a class="btn btn-primary btn-arrow btn--300 m-auto" href="<?php echo site_url(); ?>/case-studies"> <?php _e("More Case Studies","cooltech"); ?> <i class="i-arrow-right-w"></i></a></div>
	        </div>
	       <!-- <div class="col-lg-8 align-self-baseline">

				 </div> -->
	      </div>

	  </div>

</section>
		<?php
		$out = ob_get_contents();
		ob_end_clean();
	return $out;
}

function show_net_to_zero($atts) {
	if($atts["class"]) {
		$class=$atts["class"];
	}
$args=array("post_type"=>"page","numberposts"=>1,"name"=>"net-to-zero");
	$cs=get_posts($args);

	$image_id=get_post_thumbnail_id( $cs[0]->ID );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
		ob_start();
?>
<section id="net-to-zero" class="<?php echo $class; ?>" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php echo $post_thumbnail_img[0]; ?>')">
<?php		// print_r($cs);
		?>
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-center">
					<!--	<div class="case-study-label"><?php _e("NET TO ZERO","cooltech"); ?> </div>
					-->
					<h1 class="text-white font-weight-bold"><a class="text-white" href="<?php echo site_url(); ?>/net-to-zero"><?php echo $cs[0]->post_title; ?></a></h1>
						<div class="text-white case-study-home-excerpt"><?php echo $cs[0]->post_excerpt; ?> </div><div>
						<a class="btn btn-primary btn-arrow btn--300 m-auto" href="<?php echo site_url(); ?>/net-to-zero"> <?php _e("Go to Net to Zero","cooltech"); ?> <i class="i-arrow-right-w"></i></a></div>
	        </div>
	       <!-- <div class="col-lg-8 align-self-baseline">

				 </div> -->
	      </div>

	  </div>

</section>
		<?php
		$out = ob_get_contents();
		ob_end_clean();
	return $out;
}

function get_tags_in_use($category_ID, $taxonomy){

	if($_GET["pt"]=="zero") {
		$t=array("zero");
	} else {
		$t=array("zero","case-study","equipment");
	}

	$args = array(
		'tax_query' => array(
			array(
		'taxonomy' => 'type',
		'field' => 'id',
		'terms' => $category_ID)
		),
  	'posts_per_page' => -1,
		'post_type'=>$t
		);
		if(is_user_logged_in()) {
			$args['post_status'] = array( 'publish', 'draft' );
		}

    // Set up the query for our posts
    $my_posts = new WP_Query($args);

		// print_r($my_posts);

	//	print_r($my_posts);
		$all_tags=array();
		$x=0;


    // If there are posts in this category, loop through them
    if ($my_posts->have_posts()): while ($my_posts->have_posts()): $my_posts->the_post();

		//	echo ">><b>".$my_posts->post->post_title."</b>";
      // Get all tags of current post
      $post_tags = wp_get_post_terms($my_posts->post->ID, $taxonomy);
		//	print_r($post_tags);

      // Loop through each tag
      foreach ($post_tags as $tag):

        // Set up our tags by id, name, and/or slug
        $tag_id = $tag->term_id;
        $tag_name = $tag->name;
        $tag_slug = $tag->slug;
				//echo $x;
				$tags=array("id"=>$tag_id,"name"=>$tag_name,"slug"=>$tag_slug);
				$all_tags[$x]= $tags;
				$x++;

      	endforeach;
    		endwhile; endif;
				//	print_r($all_tags);
  			return unique_multidim_array($all_tags,"id");
		}

		// create custom Ajax call for WordPress
		add_action( 'wp_ajax_nopriv_filterElements', 'filterElements' );
		add_action( 'wp_ajax_filterElements', 'filterElements' );


		function filterElements() {
			$tax_query = array('relation' => 'AND');

			if(isset($_POST["numpage"])) {
				$paged=$_POST["numpage"];
			} else {
				$paged=1;
			}

    	if (isset( $_POST["sector"]))
    	{
        $tax_query[] =  array(
                'taxonomy' => 'type',
                'field' => 'slug',
                'terms' =>  $_POST["sector"]
            );
    }
    if ($_POST["application"]!="0")
    {
        $tax_query[] =  array(
                'taxonomy' => 'application',
                'field' => 'slug',
                'terms' => $_POST["application"]
            );
    }
    if ($_POST["country"]!="0")
    {
        $tax_query[] =  array(
                'taxonomy' => 'country',
                'field' => 'slug',
                'terms' => $_POST["country"]
            );
    }
		if ($_POST["manufacturer"]!="0")
		{
				$tax_query[] =  array(
								'taxonomy' => 'manufacturer',
								'field' => 'slug',
								'terms' => $_POST["manufacturer"]
						);
		}
		if ($_POST["refrigerant"]!="0")
		{
				$tax_query[] =  array(
								'taxonomy' => 'refrigerant',
								'field' => 'slug',
								'terms' => $_POST["refrigerant"]
						);
		}
		if ($_POST["tt"]!="0")
		{
				$tax_query[] =  array(
								'taxonomy' => 'technology-type',
								'field' => 'slug',
								'terms' => $_POST["tt"]
						);
		}
		if($_POST["type"]!="0") {
			 $type=$_POST["type"];
		} else {
			$type=array("equipment","case-study");
		}

		$args = array(
    'post_type' => $type,
    'tax_query' => $tax_query,
		'orderby' => 'title',
		'order'=>"ASC",
		'posts_per_page'=>10,
		'paged'=>$paged
	);

		if(is_user_logged_in()) {
			$args['post_status'] = array( 'publish', 'draft' );
		}
			$elements=array();

			// print_r($tax_query);
			//$posts=get_posts($args);

			$query = new WP_Query($args);
			$posts = $query->posts;
 			$max_num_pages = $query->max_num_pages;

			// echo ">>".$max_num_pages;
			?>
			<script>
				totpages=<?php echo $max_num_pages; ?>
			</script>
			<?php
			$x=0;

			foreach($posts as $po) {

				$p=new Element($po);
				$args=array( 'fields' => 'names' );

				$p->application=wp_get_post_terms( $p->post->ID, "application", $args );
				$p->technology_type=wp_get_post_terms( $p->post->ID, "technology-type", $args );
				$p->manufacturer=wp_get_post_terms( $p->post->ID, "manufacturer", $args );
				$p->refrigerant=wp_get_post_terms( $p->post->ID, "refrigerant", $args );
				$p->country=wp_get_post_terms( $p->post->ID, "country", $args );
				$p->energy_efficency=get_post_meta($p->post->ID,"energy_efficency",true);
				$source=get_post_meta($p->post->ID,"source",true);
				$expanded=get_post_meta($p->post->ID,"expand",true);
				if($expanded) {
					$p->expanded=$expanded;
				}
				if($source) {
					$p->source=$source;
				}
				$p->web=get_post_meta($p->post->ID,"website",true);
				if($web) {
					$p->web=$web;
				}
				$p->sector=$p->get_sector();

				$img_id = get_post_thumbnail_id( $p->post->ID );
				$img = wp_get_attachment_image_src( $img_id, "medium");
				$p->img=$img[0];
				array_push($elements,$p);
 				include 'contenuto-ajax.php';
				}

		//	echo json_encode($elements);

		}

		function showClassTags($tags, $type="slug", $sep=" ") {
			if($type=="slug") {
				foreach($tags as $tag) {
						echo $tag->slug.$sep;
				}
			}
		}

		function getTypeLabel($type) {
			switch ($type) {
		    case "zero":
		       // return "Net Zero Equipment";
					 return "";
		        break;
		    case "equipment":
		      //  return "Equipment";
					return "";
		        break;
		    case "case-study":
		        return "Case Study";
		        break;
				}
		}

	function ja_ajax_search() {
		echo $_POST["search"];
	$results = new WP_Query( array(
		'post_type'     => array( 'equipment', 'case-history' ),
		'post_status'   => 'publish',
		'nopaging'      => true,
		'posts_per_page'=> 100,
		's'             => stripslashes( $_POST['search'] ),
	) );
	$items = array();
	if ( !empty( $results->posts ) ) {
		foreach ( $results->posts as $result ) {
			$items[] = $result->post_title;
		}
	}

// print_r($items);
	$terms = get_terms( array(
	    'taxonomy' => array('country','manufacturer','application','refrigerant'),
	    'hide_empty' => false,'s' => stripslashes( $_POST['search'] ),
	) );
	// print_r($terms);
	foreach ( $terms as $term ) {
	//	$items[] = $term->name;
	}

//	print_r($items);

//	wp_send_json_success( $items );
}
add_action( 'wp_ajax_search_site',        'ja_ajax_search' );
add_action( 'wp_ajax_nopriv_search_site', 'ja_ajax_search' );

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
		// for every list of tags
    foreach($array as $val) {
			// if the id(key) is not in key array
        if (!in_array($val[$key], $key_array)) {
					// add in the key (id) array
            $key_array[$i] = $val[$key];
						// add in array
            $temp_array[$i] = $val;
        }
        $i++;
    }
		usort($temp_array,"order_tags_by_name");
    return $temp_array;
}

function order_tags_by_name($a,$b) {
	if ($a["name"] == $b["name"]) {
    return 0;
  }
  return ($a["name"] < $b["name"] ? -1 : 1);
}

function get_tax_level($id, $tax){
    $ancestors = get_ancestors($id, $tax);
    return count($ancestors)+1;
}

$countrycodes = array(
"Afghanistan"=>"AF",
"\xc3\x85land Islands"=>"AX",
"Albania"=>"AL",
"Algeria"=>"DZ",
"American Samoa"=>"AS",
"Andorra"=>"AD",
"Angola"=>"AO",
"Anguilla"=>"AI",
"Antarctica"=>"AQ",
"Antigua and Barbuda"=>"AG",
"Argentina"=>"AR",
"Armenia"=>"AM",
"Aruba"=>"AW",
"Australia"=>"AU",
"Austria"=>"AT",
"Azerbaijan"=>"AZ",
"Bahamas"=>"BS",
"Bahrain"=>"BH",
"Bangladesh"=>"BD",
"Barbados"=>"BB",
"Belarus"=>"BY",
"Belgium"=>"BE",
"Belize"=>"BZ",
"Benin"=>"BJ",
"Bermuda"=>"BM",
"Bhutan"=>"BT",
"Bolivia, Plurinational State of"=>"BO",
"Bonaire, Sint Eustatius and Saba"=>"BQ",
"Bosnia and Herzegovina"=>"BA",
"Botswana"=>"BW",
"Bouvet Island"=>"BV",
"Brazil"=>"BR",
"British Indian Ocean Territory"=>"IO",
"Brunei Darussalam"=>"BN",
"Bulgaria"=>"BG",
"Burkina Faso"=>"BF",
"Burundi"=>"BI",
"Cambodia"=>"KH",
"Cameroon"=>"CM",
"Canada"=>"CA",
"Cabo Verde"=>"CV",
"Cayman Islands"=>"KY",
"Central African Republic"=>"CF",
"Chad"=>"TD",
"Chile"=>"CL",
"China"=>"CN",
"Christmas Island"=>"CX",
"Cocos (Keeling) Islands"=>"CC",
"Colombia"=>"CO",
"Comoros"=>"KM",
"Congo"=>"CG",
"Congo, The Democratic Republic of the"=>"CD",
"Cook Islands"=>"CK",
"Costa Rica"=>"CR",
"C\xc3\xb4te d'Ivoire"=>"CI",
"Croatia"=>"HR",
"Cuba"=>"CU",
"Cura\xc3\xa7ao"=>"CW",
"Cyprus"=>"CY",
"Czech Republic"=>"CZ",
"Denmark"=>"DK",
"Djibouti"=>"DJ",
"Dominica"=>"DM",
"Dominican Republic"=>"DO",
"Ecuador"=>"EC",
"Egypt"=>"EG",
"El Salvador"=>"SV",
"Equatorial Guinea"=>"GQ",
"Eritrea"=>"ER",
"Estonia"=>"EE",
"Ethiopia"=>"ET",
"Falkland Islands (Malvinas)"=>"FK",
"Faroe Islands"=>"FO",
"Fiji"=>"FJ",
"Finland"=>"FI",
"France"=>"FR",
"French Guiana"=>"GF",
"French Polynesia"=>"PF",
"French Southern Territories"=>"TF",
"Gabon"=>"GA",
"Gambia"=>"GM",
"Georgia"=>"GE",
"Germany"=>"DE",
"Ghana"=>"GH",
"Gibraltar"=>"GI",
"Greece"=>"GR",
"Greenland"=>"GL",
"Grenada"=>"GD",
"Guadeloupe"=>"GP",
"Guam"=>"GU",
"Guatemala"=>"GT",
"Guernsey"=>"GG",
"Guinea"=>"GN",
"Guinea-Bissau"=>"GW",
"Guyana"=>"GY",
"Haiti"=>"HT",
"Heard Island and McDonald Islands"=>"HM",
"Holy See"=>"VA",
"Honduras"=>"HN",
"Hong Kong"=>"HK",
"Hungary"=>"HU",
"Iceland"=>"IS",
"India"=>"IN",
"Indonesia"=>"ID",
"Iran, Islamic Republic of"=>"IR",
"Iraq"=>"IQ",
"Ireland"=>"IE",
"Isle of Man"=>"IM",
"Israel"=>"IL",
"Italy"=>"IT",
"Jamaica"=>"JM",
"Japan"=>"JP",
"Jersey"=>"JE",
"Jordan"=>"JO",
"Kazakhstan"=>"KZ",
"Kenya"=>"KE",
"Kiribati"=>"KI",
"Korea, Democratic People's Republic of"=>"KP",
"Korea, Republic of"=>"KR",
"Kuwait"=>"KW",
"Kyrgyzstan"=>"KG",
"Lao People's Democratic Republic"=>"LA",
"Latvia"=>"LV",
"Lebanon"=>"LB",
"Lesotho"=>"LS",
"Liberia"=>"LR",
"Libia"=>"LY",
"Liechtenstein"=>"LI",
"Lithuania"=>"LT",
"Luxembourg"=>"LU",
"Macao"=>"MO",
"Macedonia, The Former Yugoslav Republic of"=>"MK",
"Madagascar"=>"MG",
"Malawi"=>"MW",
"Malaysia"=>"MY",
"Maldives"=>"MV",
"Mali"=>"ML",
"Malta"=>"MT",
"Marshall Islands"=>"MH",
"Martinique"=>"MQ",
"Mauritania"=>"MR",
"Mauritius"=>"MU",
"Mayotte"=>"YT",
"Mexico"=>"MX",
"Micronesia, Federated States of"=>"FM",
"Moldova, Republic of"=>"MD",
"Monaco"=>"MC",
"Mongolia"=>"MN",
"Montenegro"=>"ME",
"Montserrat"=>"MS",
"Morocco"=>"MA",
"Mozambique"=>"MZ",
"Myanmar"=>"MM",
"Namibia"=>"NA",
"Nauru"=>"NR",
"Nepal"=>"NP",
"Netherlands"=>"NL",
"New Caledonia"=>"NC",
"New Zealand"=>"NZ",
"Nicaragua"=>"NI",
"Niger"=>"NE",
"Nigeria"=>"NG",
"Niue"=>"NU",
"Norfolk Island"=>"NF",
"Northern Mariana Islands"=>"MP",
"Norway"=>"NO",
"Oman"=>"OM",
"Pakistan"=>"PK",
"Palau"=>"PW",
"Palestine, State of"=>"PS",
"Panama"=>"PA",
"Papua New Guinea"=>"PG",
"Paraguay"=>"PY",
"Peru"=>"PE",
"Philippines"=>"PH",
"Pitcairn"=>"PN",
"Poland"=>"PL",
"Portugal"=>"PT",
"Puerto Rico"=>"PR",
"Qatar"=>"QA",
"R\xc3\xa9union"=>"RE",
"Romania"=>"RO",
"Russian Federation"=>"RU",
"Rwanda"=>"RW",
"Saint Barth\xc3\xa9lemy"=>"BL",
"Saint Helena, Ascension and Tristan Da Cunha"=>"SH",
"Saint Kitts and Nevis"=>"KN",
"Saint Lucia"=>"LC",
"Saint Martin (French part)"=>"MF",
"Saint Pierre and Miquelon"=>"PM",
"Saint Vincent and the Grenadines"=>"VC",
"Samoa"=>"WS",
"San Marino"=>"SM",
"Sao Tome and Principe"=>"ST",
"Saudi Arabia"=>"SA",
"Senegal"=>"SN",
"Serbia"=>"RS",
"Seychelles"=>"SC",
"Sierra Leone"=>"SL",
"Singapore"=>"SG",
"Sint Maarten (Dutch part)"=>"SX",
"Slovakia"=>"SK",
"Slovenia"=>"SI",
"Solomon Islands"=>"SB",
"Somalia"=>"SO",
"South Africa"=>"ZA",
"South Georgia and the South Sandwich Islands"=>"GS",
"South Sudan"=>"SS",
"Spain"=>"ES",
"Sri Lanka"=>"LK",
"Sudan"=>"SD",
"Suriname"=>"SR",
"Svalbard and Jan Mayen"=>"SJ",
"Swaziland"=>"SZ",
"Sweden"=>"SE",
"Switzerland"=>"CH",
"Syrian Arab Republic"=>"SY",
"Taiwan, Province of China"=>"TW",
"Tajikistan"=>"TJ",
"Tanzania, United Republic of"=>"TZ",
"Thailand"=>"TH",
"Timor-Leste"=>"TL",
"Togo"=>"TG",
"Tokelau"=>"TK",
"Tonga"=>"TO",
"Trinidad and Tobago"=>"TT",
"Tunisia"=>"TN",
"Turkey"=>"TR",
"Turkmenistan"=>"TM",
"Turks and Caicos Islands"=>"TC",
"Tuvalu"=>"TV",
"Uganda"=>"UG",
"Ukraine"=>"UA",
"United Arab Emirates"=>"AE",
"United Kingdom"=>"GB",
"United States of America"=>"US",
"United States Minor Outlying Islands"=>"UM",
"Uruguay"=>"UY",
"USA"=>"US",
"Uzbekistan"=>"UZ",
"Vanuatu"=>"VU",
"Venezuela, Bolivarian Republic of"=>"VE",
"Viet Nam"=>"VN",
"Virgin Islands, British"=>"VG",
"Virgin Islands, U.S."=>"VI",
"Wallis and Futuna"=>"WF",
"Western Sahara"=>"EH",
"Yemen"=>"YE",
"Zambia"=>"ZM",
"Zimbabwe"=>"ZW"
);

add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Turquoise', 'cooltech' ),
		'slug'  => 'turquoise',
		'color'	=> '#2EDBC0',
	),
	array(
		'name'  => __( 'Chathams Blue 1', 'cooltech' ),
		'slug'  => 'chathams-1',
		'color' => '#165774',
	),
	array(
		'name'  => __( 'Picton Blue', 'cooltech' ),
		'slug'  => 'picton',
		'color' => '#4DAEEF',
	),
	array(
		'name'	=> __( 'Eastern Blue', 'cooltech' ),
		'slug'	=> 'eastern-blue',
		'color'	=> '#2290BE',
	),
	array(
		'name'	=> __( 'Chathams Blue 2', 'cooltech' ),
		'slug'	=> 'chathams-2',
		'color'	=> '#12316A',
	),
	array(
		'name'	=> __( 'Seashell', 'cooltech' ),
		'slug'	=> 'seashell',
		'color'	=> '#F1F1F1',
	),
	array(
			'name'	=> __( 'Polar', 'cooltech' ),
			'slug'	=> 'polar',
			'color'	=> '#D5F2F6',
		),
		array(
				'name'	=> __( 'Geyser', 'cooltech' ),
				'slug'	=> 'geyser',
				'color'	=> '#D0DDE3',
			),
		array(
					'name'	=> __( 'Hawkes Blue', 'cooltech' ),
					'slug'	=> 'hawkes-blue',
					'color'	=> '#DBEFFC',
		),
		array(
					'name'	=> __( 'Link Water', 'cooltech' ),
					'slug'	=> 'link-water',
					'color'	=> '#D3E9F2',
		),
		array(
					'name'	=> __( 'Mischka', 'cooltech' ),
					'slug'	=> 'mischka',
					'color'	=> '#D0D6E1',
		),
		array(
					'name'	=> __( 'Iceberg', 'cooltech' ),
					'slug'	=> 'iceberg',
					'color'	=> '#D4EBF1',
		),
) );

//add new menu for theme-options page with page callback theme-options-page.



function theme_option_page() {
?>
<div class="wrap">
<h1>Cooltech Theme Options Page</h1>
<form method="post" action="options.php">
<?php
// display settings field on theme-option page
settings_fields("theme-options-grp");
// display all sections for theme-options page
do_settings_sections("theme-options");
submit_button();
?>
</form>
</div>
<?php }
function add_theme_menu_item() {
	add_theme_page("Theme Customization", "Cooltech Theme Customization", "edit_pages", "theme-options", "theme_option_page", null, 99);
}
 add_action("admin_menu", "add_theme_menu_item");
function theme_section_description(){
		echo '<p>Theme Option Section</p>';
}
function options_callback() {
		$options = get_option( 'top_menu_option' );
		echo '<input name="top_menu_option" id="first_field_option" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> Check for enabling top menu';
}
function carousel_callback() {
		$options = get_option( 'carousel_option' );
		echo '<input name="carousel_option" id="carousel_option" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> Check for enabling Carousel';
}
function ntz_callback() {
		$options = get_option( 'ntz_option' );
		echo '<input name="ntz_option" id="ntz_option" type="checkbox" value="1" class="code" ' . checked( 1, $options, false ) . ' /> Check for enabling Net to Zero Product List filter';
}
function test_theme_settings(){
		add_option('top_menu_option',0);// add theme option to database
		add_option('carousel',0);
		add_option('ntz',0);
		add_settings_section( 'first_section', 'New Theme Options Section',
		'theme_section_description','theme-options');
		add_settings_field('top_menu_option','Top Menu','options_callback',
		'theme-options','first_section');
		add_settings_field('carousel','Carousel','carousel_callback',
		'theme-options','first_section');
		add_settings_field('time_slide','Time Slide','time_slide_callback',
		'theme-options','first_section');
		add_settings_field('ntz','Net to Zero','ntz_callback',
		'theme-options','first_section');

		add_settings_field('footer_button_url','Button Url','button_url_callback',
		'theme-options','first_section');
		add_settings_field('footer_button_text','Button Text','button_text_callback',
		'theme-options','first_section');
		add_settings_field('footer_small_text','Small Text','small_text_callback',
		'theme-options','first_section');
		//add settings field to the “first_section”
		//add settings filed with callback display_test_twitter_element.
		add_settings_field('footer_textbig', 'Main Text Footer', 'display_footer_main_text', 'theme-options', 'first_section');
		add_settings_field('footer_subtitle', 'Second Text Footer', 'display_footer_subtitle', 'theme-options', 'first_section');
		register_setting( 'theme-options-grp', 'footer_textbig');
		register_setting( 'theme-options-grp', 'footer_subtitle');
		register_setting( 'theme-options-grp', 'footer_button_url');
		register_setting( 'theme-options-grp', 'footer_button_text');
		register_setting( 'theme-options-grp', 'top_menu_option');
		register_setting( 'theme-options-grp', 'carousel_option');
		register_setting( 'theme-options-grp', 'footer_small_text');
		register_setting( 'theme-options-grp', 'time_slide');
		register_setting( 'theme-options-grp', 'ntz_option');
}
function button_text_callback() { ?>
	<input type="text" name="footer_button_text" value="<?php echo get_option('footer_button_text'); ?>"/>
<?php
}
function time_slide_callback() { ?>
	<input type="text" name="time_slide" value="<?php echo get_option('time_slide'); ?>" />
<?php
}
function button_url_callback() { ?>
	<input type="text" name="footer_button_url" value="<?php echo get_option('footer_button_url'); ?>" />
<?php
}
function small_text_callback(){
//php code to take input from text field for twitter URL.
?>
<textarea rows="5" cols="50" name="footer_small_text"><?php echo get_option('footer_small_text'); ?> </textarea>
<?php
}
function display_footer_main_text(){
//php code to take input from text field for twitter URL.
?>
<textarea rows="5" cols="50" name="footer_textbig"><?php echo get_option('footer_textbig'); ?> </textarea>

<?php
}
function display_footer_subtitle(){
//php code to take input from text field for twitter URL.
?>
<textarea rows="5" cols="50" name="footer_subtitle"><?php echo get_option('footer_subtitle'); ?> </textarea>

<?php
}

add_action( 'pre_get_posts', 'custom_get_posts' );

function custom_get_posts( $query ) {

  if( (is_category() || is_archive()) && $query->is_main_query() ) {
    $query->query_vars['orderby'] = 'name';
    $query->query_vars['order'] = 'ASC';
  }

}


function getCountryLabel($type) {
	switch ($type) {
    case "zero":
        return "Availability";
        break;
    case "equipment":
        return "Manufacturer Country";
        break;
    case "case-study":
        return "Country";
        break;
		}
}

function add_search_panel() {
	global $post;

	$image_id=get_post_thumbnail_id( $post->ID );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
	ob_start();
	?>

	<header class="masthead" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php echo $post_thumbnail_img[0]; ?>')">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="h1-home text-white font-weight-bold"><?php echo $post->post_excerpt; ?></h1>

	        </div>
	        <div class="col-lg-5 align-self-baseline" style="margin-top:1rem">
              <?php if ( shortcode_exists('wpdreams_ajaxsearchlite') ) {
                echo do_shortcode('[wpdreams_ajaxsearchlite]');
                }
              ?>
            </div>
	      </div>
	    </div>
	  </header>

	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}


function add_filter_bar($atts) {
	ob_start();
	$slug=$atts["slug"];
	//echo $slug;
	//$term=get_term_by("slug", $slug);
	$term = get_term_by('slug', $slug, 'type');
	echo $term->term_id;
	?>

	<input type="hidden" id="sector" value="<?php echo $slug ?>">
	<div id="selectblock" class="row d-print-none">
		<div id="selectcolumn" class="col-sm-12">
		<?php
//		print_r($term);
// 	$tags=array_unique(get_tags_in_use($term->term_id,"application"));
		$tags=get_tags_in_use($term->term_id,"application");
	//	print_r($tags); ?>

	 <div class="selectdiv">	<select id="application" class="select-filter" name="application">
			<option value="0"> <?php _e("Applications","cooltech"); ?></option>
			<?php foreach($tags as $tag) { ?>
			<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
			<?php }?>
		</select> </div>
		<?php
		// print_r($term);
		$tags=get_tags_in_use($term->term_id,"country");

		//print_r($tags); ?>
		<div class="selectdiv"><select id="country" class="select-filter" name="country">
			<option value="0">
				<?php
				if($_GET["pt"]=="zero") {
			 		_e("Availability");
		 		} else {
					_e("Country","cooltech");
				}
			 ?> </option>
			<?php foreach($tags as $tag) { ?>
			<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
			<?php }?>
		</select></div>
		<?php
		// print_r($term);
		$tags=get_tags_in_use($term->term_id,"refrigerant");
; ?>
<div class="selectdiv">
		<select id="refrigerant" class="select-filter" name="refrigerant">
			<option value="0"><?php _e("Refrigerant","cooltech"); ?>  </option>
			<?php foreach($tags as $tag) { ?>
			<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
			<?php }?>
		</select>
	</div>
		<?php
		// print_r($term);
		$tags=get_tags_in_use($term->term_id,"manufacturer");
		//print_r($tags); ?>
		<div class="selectdiv">
		<select id="manufacturer" class="select-filter" name="manufacturer">
			<option value="0"> <?php _e("Manufacturer","cooltech"); ?> </option>
			<?php foreach($tags as $tag) { ?>
			<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
			<?php }?>
		</select>
	</div>
		<?php
		// print_r($term);
		$tags=get_tags_in_use($term->term_id,"technology-type");
 ?>
<div class="selectdiv">
		<select id="technology-type" class="select-filter" name="technology-type">
			<option value="0"> <?php _e("Technology Type","cooltech"); ?> </option>
			<?php foreach($tags as $tag) { ?>
			<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
			<?php }?>
		</select>
</div>

		<input type="hidden" class="select-filter" id="type" value="zero">


		</div>
	</div>

	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}


 add_action('admin_init','test_theme_settings');

 class NestedMenu
{
    private $flat_menu;
    public $items;

    function __construct($name)
    {
        $this->flat_menu = wp_get_nav_menu_items($name);
        $this->items = array();
        foreach ($this->flat_menu as $item) {
            if (!$item->menu_item_parent) {
                array_push($this->items, $item);
            }
        }
    }

    public function get_submenu($item)
    {
        $submenu = array();
        foreach ($this->flat_menu as $subitem) {
            if ($subitem->menu_item_parent == $item->ID) {
                array_push($submenu, $subitem);
            }
        }
        return $submenu;
    }
}
?>
