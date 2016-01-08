<?php

/**
 *  Regular Font
 */
function ld_get_regular_font_faces() {
	return array(
		'"Helvetica Neue", Helvetica, Arial, sans-serif',
		'Georgia, "Times New Roman", Times, serif',
		'Menlo, Monaco, Consolas, "Courier New", monospace',
	);
}
function ld_data_source_regular_font_faces() {
	$ret = array();

	foreach ( ld_get_regular_font_faces() as $font ) {
		$ret[] = array( 'label' => sprintf( __( 'Standard : %s', 'lovey_dovey' ), $font ), 'value' => $font );
	}
	return $ret;
}

/**
 * Social Media Links
 */
function ld_data_source_social_media_links() {
	return array(
		array( 'value' => 'behance', 'label' => 'Behance' ),
		array( 'value' => 'blogger', 'label' => 'Blogger' ),
		array( 'value' => 'delicious', 'label' => 'Delicious' ),
		array( 'value' => 'deviantart', 'label' => 'DeviantArt' ),
		array( 'value' => 'digg', 'label' => 'Digg' ),
		array( 'value' => 'dribbble', 'label' => 'Dribbble' ),
		array( 'value' => 'dropbox', 'label' => 'Dropbox' ),
		array( 'value' => 'email', 'label' => 'Email' ),
		array( 'value' => 'facebook', 'label' => 'Facebook' ),
		array( 'value' => 'flickr', 'label' => 'Flickr' ),
		array( 'value' => 'forrst', 'label' => 'Forrst' ),
		array( 'value' => 'foursquare', 'label' => 'Foursquare' ),
		array( 'value' => 'github', 'label' => 'Github' ),
		array( 'value' => 'googleplus', 'label' => 'Google+' ),
		array( 'value' => 'instagram', 'label' => 'Instagram' ),
		array( 'value' => 'lastfm', 'label' => 'Last.FM' ),
		array( 'value' => 'linkedin', 'label' => 'LinkedIn' ),
		array( 'value' => 'myspace', 'label' => 'MySpace' ),
		array( 'value' => 'pinterest', 'label' => 'Pinterest' ),
		array( 'value' => 'reddit', 'label' => 'Reddit' ),
		array( 'value' => 'rss', 'label' => 'RSS' ),
		array( 'value' => 'skype', 'label' => 'Skype' ),
		array( 'value' => 'soundcloud', 'label' => 'SoundCloud' ),
		array( 'value' => 'stumbleupon', 'label' => 'StumbleUpon' ),
		array( 'value' => 'tumblr', 'label' => 'Tumblr' ),
		array( 'value' => 'twitter', 'label' => 'Twitter' ),
		array( 'value' => 'vimeo', 'label' => 'Vimeo' ),
		array( 'value' => 'wordpress', 'label' => 'WordPress' ),
		array( 'value' => 'xing', 'label' => 'Xing' ),
		array( 'value' => 'yahoo', 'label' => 'Yahoo' ),
		array( 'value' => 'youtube', 'label' => 'Youtube' ),
	);
}

function ld_ninja_form_get_fields_by_form_id($form_id) {
	$return = array();
	if ( function_exists( 'ninja_forms_get_fields_by_form_id' ) ) {
		$all_fields = ninja_forms_get_fields_by_form_id($form_id);
		if (! empty($all_fields) ) {
			foreach ($all_fields as $field) {
				if ($field['type'] !== '_submit') {
					$return[] = array(
						'label' => $field['data']['label'] . ' (' . $field['id'] . ')',
						'value' => $field['id'],
					);
				}
			}
		}
	}
	return $return;
}
VP_Security::instance()->whitelist_function('ld_ninja_form_get_fields_by_form_id');

