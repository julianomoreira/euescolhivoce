<?php

/**
 * Define Constants
 */
define('LD_THEMEROOT', trailingslashit(get_template_directory_uri()));
define('LD_CSS', LD_THEMEROOT . 'css/');
define('LD_IMAGES', LD_THEMEROOT . 'images/');
define('LD_JS', LD_THEMEROOT . 'js/');

define('LD_IMAGES_DIR', trailingslashit(get_template_directory() . '/images'));
define('LD_CSS_DIR', trailingslashit(get_template_directory() . '/css'));
define('LD_JS_DIR', trailingslashit(get_template_directory() . '/js'));
define('LD_INCLUDES_DIR', trailingslashit(get_template_directory() . '/includes'));
define('LD_WIDGETS_DIR', trailingslashit(get_template_directory() . '/widgets'));
define('LD_ADMIN_DIR', trailingslashit(get_template_directory() . '/admin' ) );

/**
 * Content Width
 */
if ( ! isset( $content_width ) ) { $content_width = 1140; }
/**
 * Load languages
 */
load_theme_textdomain('lovey_dovey', get_template_directory() . '/languages/pt_PT.po');

/**
 * Global variables
 */
global $lovey_dovey_data;
$lovey_dovey_data = array(
	'typography_types' => array (
		'heading'    => __( 'Heading Typography', 'lovey_dovey' ),
		'body'       => __( 'Body Typography', 'lovey_dovey' ),
	),
	'default_value' => array(
		'heading_font_face'    => 'Raleway',
		'body_font_face'       => 'Open Sans',
	),
	'DOM' => array(
		'guestbook' => '',
	)
);

/**
 * Include LD Nav Walker
 */
require_once( LD_ADMIN_DIR . 'menu/ld_nav_walker.php' );

/**
 * Include Vafpress Framework functions
 */
require_once( 'functions-vafpress-framework.php' );

/**
 * Include all files in /includes directory
 */
$includes_files = glob( LD_INCLUDES_DIR . '*' );
foreach ( $includes_files as $file ) {
	require_once( $file );
}

/**
 * TGM
 */

add_action('tgmpa_register', 'ld_tgmpa');
function ld_tgmpa() {
	$plugins = array (
		array(
			'name'     => 'Page Builder by SiteOrigin',
			'slug'     => 'siteorigin-panels',
			'required' => true,
		),
		array(
			'name'     => 'Ninja Forms',
			'slug'     => 'ninja-forms',
			'required' => true,
		),
		array(
			'name'     => 'WP Retina 2x',
			'slug'     => 'wp-retina-2x',
			'required' => false,
		),
	);

	$config = array(
		'domain'		   => 'lovey_dovey',
		'parent_menu_slug' => 'plugins.php',
		'parent_url_slug'  => 'plugins.php',
		'strings'		   => array(
			'menu_title'   => __('Required Plugins', 'lovey_dovey'),
		)
	);

	tgmpa($plugins, $config);
}

/**
 * Abstract Function to Call Aqua Resizer
 */
function ld_aq_resize( $attachment_id, $width = null, $height = null, $crop = true, $single = true ) {

	if ( is_null( $attachment_id ) ) return null;

	$image = wp_get_attachment_image_src( $attachment_id, 'full' );

	$return = aq_resize( $image[0], $width, $height, $crop, $single );

	if ( $return ) {
		return $return;
	}
	else {
		return $image[0];
	}
}

/**
 * Embed Scripts into Page
 */
function ld_theme_scripts()
{
	$theme_data = wp_get_theme();
	/**
	 * CSS
	 */

	// Theme stylesheet
	wp_enqueue_style( 'style', get_stylesheet_uri() ); // WP default stylesheet

	// GoogleFonts
	global $lovey_dovey_data;

	$font_weights = array(100, 200, 300, 400, 500, 600, 700, 800, 900);
	$font_styles = array('normal', 'italic');

	foreach ( $lovey_dovey_data['typography_types'] as $type => $label ) {

		if ( ! in_array( ld_option( $type . '_font_face' ), ld_get_regular_font_faces() )  ) {
			VP_Site_GoogleWebFont::instance()->add( ld_option( $type . '_font_face' ), $font_weights, $font_styles);
		}
	}
	VP_Site_GoogleWebFont::instance()->register_and_enqueue();

	// Other CSS
	// wp_register_style( 'bootstrap', LD_CSS . 'bootstrap.min.css', array(), '3.1.1' );
	wp_register_style( 'bootstrap-ld', LD_CSS . 'bootstrap.ld.css', array(), '3.1.1' );
	wp_register_style( 'fontawesome', LD_CSS . 'font-awesome.min.css', array(), '4.0.3' );
	wp_register_style( 'linecons', LD_CSS . 'linecons.css', array(), '1.0.0' );
	wp_register_style( 'socmed', LD_CSS . 'socmed.css', array() );
	wp_register_style( 'countdown', LD_CSS . 'jquery.countdown.css', array() );
	wp_register_style( 'jquery-magnific-popup', LD_CSS . 'magnific-popup.css', array(), '0.9.9' );
	wp_register_style( 'jquery-justifiedgallery', LD_CSS . 'justifiedgallery.min.css', array(), '3.2.0' );
	wp_register_style( 'ld-style', LD_CSS . 'style.css', array(
		'bootstrap-ld',
		'fontawesome',
		'linecons',
		'socmed',
		'countdown',
		'jquery-magnific-popup',
		'jquery-justifiedgallery',
	), $theme_data->get( 'Version' ) );
	wp_enqueue_style( 'ld-style' );

	// Dynamic Style
	ob_start(); include( LD_CSS_DIR . '/style-dynamic.php' ); $dynamic_style = ob_get_clean();
	wp_add_inline_style( 'ld-style', $dynamic_style );
	wp_add_inline_style( 'ld-style', ld_option( 'custom_css' ) );

	/**
	 * JS
	 */
	wp_enqueue_script( 'modernizr', LD_JS . 'modernizr-latest.js' );
	wp_register_script( 'bootstrap', LD_JS . 'bootstrap.min.js', array( 'jquery' ), '3.1.1' );
	wp_register_script( 'smoothscroll', LD_JS . 'smoothscroll.min.js', array( 'jquery' ), '1.2.1' );
	wp_register_script( 'jquery-backstretch', LD_JS. 'jquery.backstretch.min.js', array( 'jquery' ), '2.0.4' );
	wp_register_script( 'jquery-plugin', LD_JS. 'jquery.plugin.min.js', array( 'jquery' ) );
	wp_register_script( 'jquery-countdown', LD_JS. 'jquery.countdown.min.js', array( 'jquery', 'jquery-plugin' ) );
	wp_register_script( 'jquery-parallax', LD_JS . 'jquery.parallax.min.js', array( 'jquery' ), '1.1.3' );
	wp_register_script( 'jquery-countdown-br', LD_JS . 'jquery.countdown.pt-BR.js', array( 'jquery' ), '2.0.0' );
	wp_register_script( 'jquery-magnific-popup', LD_JS . 'jquery.magnific-popup.min.js', array( 'jquery' ), '0.9.9' );
	wp_register_script( 'jquery-justifiedgallery', LD_JS . 'jquery.justifiedgallery.min.js', array( 'jquery', 'jquery-magnific-popup' ), '3.2.0' );
	wp_register_script( 'jquery-waypoints', LD_JS . 'waypoints.min.js', array(), '2.0.4' );
	wp_register_script( 'imagesloaded', LD_JS . 'imagesloaded.pkgd.min.js', array(), '3.1.4' );
	wp_register_script( 'gmap-api', 'http://maps.google.com/maps/api/js?sensor=false' );
	wp_register_script( 'jquery-gmap3', LD_JS . 'gmap3.min.js', array( 'jquery', 'gmap-api' ), '6.0.0' );
	wp_deregister_script( 'isotope' );
	wp_register_script( 'isotope', LD_JS . 'isotope.pkgd.min.js', array( 'imagesloaded' ), '2.0.0' );
	wp_register_script( 'ld-script', LD_JS . 'script.js', array(
		'jquery',
		'bootstrap',
		'smoothscroll',
		'jquery-backstretch',
		'jquery-countdown',
		'jquery-magnific-popup',
		'jquery-justifiedgallery',
		'jquery-waypoints',
		'jquery-gmap3',
		'isotope',
		'jquery-countdown-br',
	), $theme_data->get( 'Version' ) );
	wp_enqueue_script('ld-script');

	wp_localize_script('ld-script', 'loveydovey', array(
		'gb_name_id' => ld_option( 'gb_name_id' ),
		'gb_message_id' => ld_option( 'gb_message_id' ),
		'is_mobile_or_tablet' => Mobile_Detect::is_mobile_or_tablet() ? 'true' : 'false',
	));

}
add_action('wp_enqueue_scripts', 'ld_theme_scripts');


function ld_admin_scripts()
{
	wp_enqueue_script( 'ld-admin-script', get_template_directory_uri() . '/admin/js/script.js', array( 'jquery' ));
}
add_action('admin_enqueue_scripts', 'ld_admin_scripts');


/**
 * Change WP Title format for better SEO
 */

if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function ld_slug_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
  }
  add_action( 'wp_head', 'ld_slug_render_title');

	function ld_filter_wp_title( $title ) {
		global $page, $paged;

		if ( is_feed() ) return $title;

		$site_description = get_bloginfo( 'description' );

		$filtered_title = $title . get_bloginfo( 'name' );
		$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
		$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'lovey_dovey' ), max( $paged, $page ) ) : '';

		return $filtered_title;
	}
	add_filter( 'wp_title', 'ld_filter_wp_title');

}

/**
 * Register navigation location
 */
function ld_action_register_menus() {
	register_nav_menus( array(
		'header-navigation' => __( 'Header Navigation', 'lovey_dovey' ),
	) );
}
add_action( 'init', 'ld_action_register_menus' );

/**
 * Excerpt ellipsis
 */
function ld_excerpt_more( $excerpt ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ld_excerpt_more' );


/**
 * Add events post type
 */
function ld_add_event_post_type() {
	$labels = array(
		'name'               => _x( 'Events', 'post type general name', 'lovey_dovey' ),
		'singular_name'      => _x( 'Event', 'post type singular name', 'lovey_dovey' ),
		'menu_name'          => _x( 'Events', 'admin menu', 'lovey_dovey' ),
		'name_admin_bar'     => _x( 'Event', 'add new on admin bar', 'lovey_dovey' ),
		'add_new'            => _x( 'Add New', 'event', 'lovey_dovey' ),
		'add_new_item'       => __( 'Add New Event', 'lovey_dovey' ),
		'new_item'           => __( 'New Event', 'lovey_dovey' ),
		'edit_item'          => __( 'Edit Event', 'lovey_dovey' ),
		'view_item'          => __( 'View Event', 'lovey_dovey' ),
		'all_items'          => __( 'All Events', 'lovey_dovey' ),
		'search_items'       => __( 'Search Events', 'lovey_dovey' ),
		'parent_item_colon'  => __( 'Parent Events:', 'lovey_dovey' ),
		'not_found'          => __( 'No events found.', 'lovey_dovey' ),
		'not_found_in_trash' => __( 'No events found in Trash.', 'lovey_dovey' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'event' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' )
	);

	register_post_type( 'event', $args );
}
add_action( 'init' , 'ld_add_event_post_type' );

/**
 * Add theme supports
 */
function ld_action_add_theme_supports() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'ld_action_add_theme_supports' );

/**
 * Add Widget
 */
function ld_widgets_init() {

	$widgets_files = array_filter( glob( LD_WIDGETS_DIR . '*' ), 'is_file');
	foreach ( $widgets_files as $file ) {
		require_once( $file );
	}

	register_widget( 'LD_Widget_Couple_Summary_And_Countdown' );
	register_widget( 'LD_Widget_Quote' );
	register_widget( 'LD_Widget_RSVP' );
	register_widget( 'LD_Widget_Post_Type_Event' );
	register_widget( 'LD_Widget_Photo_Gallery' );
	register_widget( 'LD_Widget_Recent_Posts' );
	register_widget( 'LD_Widget_Google_Maps' );
	register_widget( 'LD_Widget_Text' );

	register_sidebar( array(
		'name'          => 'Content sidebar',
		'id'            => 'content_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'ld_widgets_init' );

/**
 * Modifying Site Origin Page Builder
 */
function ld_admin_print_styles() {
	?>
	<style type="text/css">

	#so-panels-panels .so-tool-button.so-row-add,
	#so-panels-panels .so-tool-button.so-prebuilt-add,
	#so-panels-panels .so-tool-button.so-history,
	#so-panels-panels .so-tool-button.so-live-editor,
	#so-panels-panels .so-row-toolbar,
	.so-panels-dialog .so-visual-styles,
	.so-panels-dialog.so-panels-dialog-has-right-sidebar .so-right-sidebar
	{
		display: none !important;
	}
	.so-panels-dialog.so-panels-dialog-has-right-sidebar .so-content {
		right: 30px !important;
	}
	</style>
	<?php
}
add_action( 'admin_print_styles-post-new.php', 'ld_admin_print_styles' );
add_action( 'admin_print_styles-post.php', 'ld_admin_print_styles' );

/**
 * Change Widget Search
 */
function ld_change_search_widget( $html ) {
	ob_start(); ?>
	<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="search-form">
		<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php _e( 'Search on this site', 'lovey_dovey' ); ?>" />
		<span class="icon fa fa-search"></span>
		<button class="button" type="submit"><?php _e( 'Search', 'lovey_dovey' ); ?></button>
	</form>
	<?php return ob_get_clean();
}
add_filter( 'get_search_form', 'ld_change_search_widget' );

/**
 * Callback comment item html
 */
function ld_list_comments_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php' ) );
}

/**
 * Multi pages
 */
function ld_link_pages_link ($link, $i) {
	global $page;
	if ($i > $page) {
		return '<div class="next">'. $link . '</div>';
	} else {
		return '<div class="link">'. $prev . '</div>';
	}
}
add_filter('wp_link_pages_link', 'ld_link_pages_link', 10, 2);

/**
 * Security Functions
 */
function ld_kses($html)
{
	$allow = array_merge(wp_kses_allowed_html( 'post' ), array(
		'link' => array(
			'href'    => true,
			'rel'     => true,
			'type'    => true,
		),
		'script' => array(
			'src' => true,
			'charset' => true,
			'type'    => true,
		)
	));
	return wp_kses($html, $allow);
}

/**
 * Gallery Shortcode with Justified Gallery style
 */
function ld_shortcodes() {

	function ld_shortcode_gallery( $output = '', $atts, $content = false, $tag = false ) {

		$ids = explode( ',', $atts['ids'] );
		$ids = array_map( 'trim', $ids );

		ob_start(); ?>
		<div class="ld-gallery js-justifiedgallery" data-orderby="<?php echo $atts['orderby']; ?>">
			<?php
			foreach ( $ids as $id ) :
				echo wp_get_attachment_link( $id, 'large' );
			endforeach;
			?>
		</div>
		<?php $ret = ob_get_clean();

		return $ret;
	}
	add_filter( 'post_gallery', 'ld_shortcode_gallery', 10, 4 );
}
add_action( 'init', 'ld_shortcodes' );

/* ninja_forms_post_process */

/**
 * Filter widgets
 */
function ld_add_recommended_widgets($widgets){

	// Add in all the widgets bundle widgets
	$ld_widgets = array(
		'LD_Widget_Couple_Summary_And_Countdown',
		'LD_Widget_Quote',
		'LD_Widget_RSVP',
		'LD_Widget_Post_Type_Event',
		'LD_Widget_Photo_Gallery',
		'LD_Widget_Recent_Posts',
		'LD_Widget_Google_Maps',
		'LD_Widget_Text',
	);

	foreach($ld_widgets as $ld_widget) {
		if( isset( $widgets[$ld_widget] ) ) {
			$widgets[$ld_widget]['groups'] = array('theme-widgets-bundle');
			$widgets[$ld_widget]['icon'] = 'dashicons dashicons-awards';
		}
	}

	return $widgets;

}
add_filter('siteorigin_panels_widgets', 'ld_add_recommended_widgets', 20);

function ld_add_widgets_dialog_tabs($tabs){

	$tabs = array();

	$tabs[] = array(
		'title' => __('Theme Widgets Bundle', 'lovey_dovey'),
		'filter' => array(
			'groups' => array('theme-widgets-bundle')
		)
	);

	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'ld_add_widgets_dialog_tabs', 30);

add_filter('ld_widget_section_text', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
/**
 * EOF
 */
