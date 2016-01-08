<?php

define( 'LD_ADMINDIR', trailingslashit( get_template_directory() . '/admin' ) );
define( 'LD_ADMINURI', trailingslashit( get_template_directory_uri() . '/admin' ) );

/**
 * ======================================================================================
 * Includes
 * ======================================================================================
 */

/**
 * Include Vafpress Framework
 */
require_once 'vafpress-framework/bootstrap.php';
require_once 'admin/data-sources.php';

/**
 * Lovey Dovey Vafpress Framework Extension
 */
$vpfs = VP_FileSystem::instance();
$vpfs->add_directories('views', LD_ADMINDIR . 'views');
VP_AutoLoader::add_directories(LD_ADMINDIR . 'classes', 'VP_');

add_filter( 'vp_dependencies_array', 'ld_dt_add_resources', null, 1 );

function ld_dt_add_resources($dependencies)
{
	$dependencies['scripts']['paths']['qualia-dt'] = array(
		'path'     => LD_ADMINURI . 'public/datetime.js',
		'deps'     => array('jquery-ui-timepicker-addon'),
		'ver'      => '1',
		'override' => false,
	);
	$dependencies['scripts']['paths']['jquery-ui-timepicker-addon'] = array(
		'path'     => LD_ADMINURI . 'public/jquery-ui-timepicker-addon.min.js',
		'deps'     => array('jquery-ui-slider', 'jquery-ui-datepicker'),
		'ver'      => '1',
		'override' => false,
	);
	$dependencies['styles']['paths']['jquery-ui-timepicker-addon'] = array(
		'path'     => LD_ADMINURI . 'public/jquery-ui-timepicker-addon.min.css',
		'deps'     => array('jqui'),
	);
	$dependencies['rules']['datetime'] = array(
		'js'  => array('qualia-dt'),
		'css' => array('jqui', 'jquery-ui-timepicker-addon'),
	);
	return $dependencies;
}

/**
 * Abstract Function to access theme_options values
 */
if ( ! function_exists( 'ld_option' ) ) {
	function ld_option($name) 
	{
		return vp_option( "ld_option." . $name );
	}
}
/**
 * Abstract Function to access event_options metabox values
 */
if ( ! function_exists( 'ld_event_option' ) ) {

	function ld_event_option( $key, $default = null ) {
		return vp_metabox( '_event_options' . '.' . $key, $default );
	}
}
/**
 * Abstract Function to access page_options metabox values
 */
if ( ! function_exists( 'ld_page_option' ) ) {

	function ld_page_option( $key, $default = null ) {
		return vp_metabox( '_page_options' . '.' . $key, $default );
	}

}

/**
 * Initialize Theme Options via Vafpress Framework
 */
$tmpl_opt  = get_template_directory() . '/admin/option/option.php';
global $ld_theme_option;
// Create instance of Options
$ld_theme_options = new VP_Option(array(
	'is_dev_mode'           => false,                                  // dev mode, default to false
	'option_key'            => 'ld_option',                           // options key in db, required
	'page_slug'             => 'ld_option',                           // options page slug, required
	'template'              => $tmpl_opt,                              // template file path or array, required
	'menu_page'             => 'themes.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
	'use_auto_group_naming' => true,                                   // default to true
	'use_util_menu'         => true,                                   // default to true, shows utility menu
	'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'
	'layout'                => 'fixed',                                // fluid or fixed, default to fixed
	'page_title'            => __( 'Theme Options', 'lovey_dovey' ), // page title
	'menu_label'            => __( 'Theme Options', 'lovey_dovey' ), // menu label
));

/**
 * Initialize Metaboxes
 */
new VP_Metabox( LD_ADMINDIR . 'metabox/metabox_event_options.php' );
new VP_Metabox( LD_ADMINDIR . 'metabox/metabox_page_options.php' );
