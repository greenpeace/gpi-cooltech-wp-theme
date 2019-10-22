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
	'/class-wp-bootstrap-navwalker.php', '/blocks.php'   // Load custom WordPress nav walker.
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



if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
  //  add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

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

        wp_register_script('cooltechscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('cooltechscripts'); // Enqueue it!

				wp_register_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '4.3.0'); // Conditionizr
				wp_enqueue_script('bootstrapjs');

				wp_register_script('waypoints', get_template_directory_uri()  . '/js/jquery.waypoints.min.js', array( 'jquery' ));
				wp_enqueue_script('waypoints');

				wp_register_script('sidr', get_template_directory_uri()  . '/js/jquery.sidr.min.js', array( 'jquery' ));
				wp_enqueue_script('sidr');

				wp_register_script('animate', get_template_directory_uri()  . '/js/jquery.animateNumber.min.js', array( 'jquery' ));
				wp_enqueue_script('animate');

wp_localize_script(
		'global',
		'global',
		array(
			'ajax' => admin_url( 'admin-ajax.php' ),
		)
	);

}

// Load cooltech Blank conditional scripts
function cooltech_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load cooltech Blank styles
function cooltech_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('cooltech', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('cooltech'); // Enqueue it!

		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap-ct.css', array(), '1.0', 'all');
		wp_enqueue_style('bootstrap'); // Enqueue it!

		wp_register_style('theme-css', get_template_directory_uri() . '/css/theme.css');
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
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'cooltech'),
        'description' => __('Description for this widget-area...', 'cooltech'),
        'id' => 'widget-area-2',
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

// Custom Comments Callback
function cooltechcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

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
						'custom-fields',
						'technology-type'
        ), // Go to Dashboard Custom cooltech Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'country','type','manufacturer','refrigerant','application','technology-type'
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
						'technology-type'
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

		$terms = get_terms( array(
				'taxonomy' => 'type',
				'hide_empty' => false,
				'parent'=>$t->term_id
			) );
		} else {
			$terms = get_terms( array(
				'taxonomy' => 'type',
				'hide_empty' => false,
				'parent'=>0
				) );
		}
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

// Shortcode Demo with simple <h2> tag
function cooltech_shortcode_cat($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
	$q = get_queried_object();
	if($q) {
		$slug=$q->slug;
	}
	$terms=get_sector_from_slug($slug);
	ob_start();
	?>
	</div>
	<section class="category-list <?php echo $slug; ?>">
		<?php	global $page_layout; ?>
		<div class="<?php echo $page_layout ?>">
				<div class="row">
			<?php foreach ( $terms  as $t ) { ?>
						<div class="col-md-3 col-sm-6">
								<div><h3><?php echo $t->name; ?></h3> </div>
								<div class="cat_desc align-items-stretch"> <?php echo get_term_meta( $t->term_id, 'intro', true );  ?> </div>
								<div> <a href="<?php echo home_url(); ?>/sector/<?php echo $t->slug ?>" class="btn btn-rounded btn-block btn-outline-dark <?php echo $slug; ?>"> Enter Database  </a>
								</div>
						</div>
		<?php } ?>
			</div>
		</div>
		</section>
		<div class="<?php echo $page_layout; ?>">
		<?php
			$out = ob_get_contents();
			ob_end_clean();
    return $out;
}

function get_tags_in_use($category_ID, $taxonomy){
    // Set up the query for our posts
    $my_posts = new WP_Query(array(
			'tax_query' => array(
				array(
			'taxonomy' => 'type',
			'field' => 'id',
			'terms' => $category_ID
		)
	),
      'posts_per_page' => -1 // All posts from that category
    ));
	//	print_r($my_posts);
		$all_tags=array();
		$x=0;


    // If there are posts in this category, loop through them
    if ($my_posts->have_posts()): while ($my_posts->have_posts()): $my_posts->the_post();

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
			//	print_r($all_tags);

      endforeach;
    	endwhile; endif;
	//	print_r($all_tags);
  		return unique_multidim_array($all_tags,"id");
		}

		// create custom Ajax call for WordPress
		add_action( 'wp_ajax_nopriv_filterElements', 'filterElements' );
		add_action( 'wp_ajax_filterElements', 'filterElements' );

		function filterElements() {

				echo $_POST["manufacturer"];

		}

		function showClassTags($tags, $type="slug") {
			if($type=="slug") {
				foreach($tags as $tag) {
						echo $tag->slug." ";
				}
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
	print_r($terms);
	foreach ( $terms as $term ) {
	//	$items[] = $term->name;
	}

	print_r($items);

//	wp_send_json_success( $items );
}
add_action( 'wp_ajax_search_site',        'ja_ajax_search' );
add_action( 'wp_ajax_nopriv_search_site', 'ja_ajax_search' );

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
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
"United Kingdom of Great Britain and Northern Ireland"=>"GB",
"United States of America"=>"US",
"United States Minor Outlying Islands"=>"UM",
"Uruguay"=>"UY",
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

?>
