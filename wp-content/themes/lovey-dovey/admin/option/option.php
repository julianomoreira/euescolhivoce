<?php

/**
 * ======================================================================================
 * Functions
 * ======================================================================================
 */

function ld_theme_options_scheme_all_typography() {
	$return = array();

	global $lovey_dovey_data;
	foreach ( $lovey_dovey_data['typography_types'] as $type => $label ) {
		$return[] = array(
			'type'   => 'section',
			'title'  =>	$label,
			'fields' => array(
				array(
					'type'       => 'select',
					'name'       => $type . '_font_face',
					'label'      => __( 'Font Face', 'lovey_dovey' ),
					'items'      => array(
						'data' => array(
							array(
								'source' => 'function',
								'value'  => 'ld_data_source_regular_font_faces',
							),
							array(
								'source' => 'function',
								'value'  => 'vp_get_gwf_family',
							),
						),
					),
					'default'    => array(
						$lovey_dovey_data['default_value'][$type . '_font_face'],
					),
					'validation' => 'required',
				),
			),
		);
	}

	return $return;
}

function ld_theme_options_all_ninja_forms() {
	$return = array();

	if( function_exists( 'ninja_forms_get_all_forms' ) ) { 
		$all_forms = ninja_forms_get_all_forms();
		if (! empty($all_forms)) {
			foreach ($all_forms as $form) { 
				$return[] = array(
					'label' => $form['data']['form_title'],
					'value' => $form['id'],);
			}
		}
	}
	return $return;
}

return array(
	'title' => __('Lovey+Dovey Options', 'lovey_dovey'),
	'logo' => '',
	'menus' => array(
		array(
			'title' => __('Global Setting', 'lovey_dovey'),
			'name' => 'logo_and_favicon',
			'icon' => 'font-awesome:fa-flag',
			'controls' => array(
				array(
					'type' => 'toggle',
					'name' => 'enable_preloader',
					'label' => __( 'Page Preloader', 'lovey_dovey' ),
					'default' => 1,
				),
				array(
					'type' => 'textbox',
					'name' => 'header_date_format',
					'label' => __('Header Date Format', 'lovey_dovey'),
					'default' => 'Y.m.d',
					'validation' => 'required',
				),
				array(
					'type'	=> 'section',
					'title' => __('Site Logo', 'lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'logo',
							'label' => __('Header Logo Image', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'logo_footer',
							'label' => __('Footer Logo Image', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'logo_retina',
							'label' => __('Header Logo Image (Retina Version)', 'lovey_dovey'),
							'description' => __('Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'logo_footer_retina',
							'label' => __('Footer Logo Image (Retina Version)', 'lovey_dovey'),
							'description' => __('Please name your file following the normal version (e.g. logo.png) with a suffix @2x (e.g. logo@2x.png)', 'lovey_dovey'),
						),
					),
				),
				array(
					'type'	=> 'section',
					'title' => __('Site Favicon', 'lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'favicon',
							'description' => __('Recommended: .ICO 64x64px size', 'lovey_dovey'),
							'label' => __('General Site Icon', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'favicon_iphone',
							'description' => __('Recommended: .PNG 60x60px size', 'lovey_dovey'),
							'label' => __('Icon for iPhone', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'favicon_iphone_retina',
							'description' => __('Recommended: .PNG 120x120px size', 'lovey_dovey'),
							'label' => __('Icon for iPhone Retina', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'favicon_ipad',
							'description' => __('Recommended: .PNG 76x76px size', 'lovey_dovey'),
							'label' => __('Icon for iPad', 'lovey_dovey'),
						),
						array(
							'type' => 'upload',
							'name' => 'favicon_ipad_retina',
							'description' => __('Recommended: .PNG 152x152px size', 'lovey_dovey'),
							'label' => __('Icon for iPad Retina', 'lovey_dovey'),
						),
					),
				),
				array(
					'type' => 'textarea',
					'name' => 'copyright_text',
					'label' => __('Copyright Text', 'lovey_dovey'),
					'default' => 'Powered by <a href="https://wordpress.org/">Wordpress</a>. Designed by <a href="http://vafpress.com/">Vafpress</a>.<BR>Copyright &copy; 2014 Lovey+Dovey, All Right Reserved',
				),
			),
		),
		array(
			'title' => __('Guestbook', 'lovey_dovey'),
			'name' => 'guestbook',
			'icon' => 'font-awesome:fa-book',
			'controls' => array(
				array(
					'type' => 'select',
					'name' => 'guestbook_form',
					'label' => __('Guestbook Form','lovey_dovey'),
					'items' => ld_theme_options_all_ninja_forms(),
				),
				array(
					'type' => 'select',
					'name' => 'gb_name_id',
					'label' => __('Field ID for Name','lovey_dovey'),
					'items' => array(
						'data' => array(
							array(
								'source' => 'binding',
								'field' => 'guestbook_form',
								'value' => 'ld_ninja_form_get_fields_by_form_id',
							),
						),
					),
				),
				array(
					'type' => 'select',
					'name' => 'gb_message_id',
					'label' => __('Field ID for Message','lovey_dovey'),
					'items' => array(
						'data' => array(
							array(
								'source' => 'binding',
								'field' => 'guestbook_form',
								'value' => 'ld_ninja_form_get_fields_by_form_id',
							),
						),
					),
				),
			),
		),
		array(
			'title' => __('Appearance', 'lovey_dovey'),
			'name' => 'appearance',
			'icon' => 'font-awesome:fa-magic',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Color Scheme', 'lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'color',
							'name' => 'color_accent',
							'label' => __('Set Color Accent', 'lovey_dovey'),
							'default' => 'rgba(220,100,100,1)',
						),
					),
				),
			),
		),
		array(
			'title' => __('Font Settings', 'lovey_dovey'),
			'name' => 'font_settings',
			'icon' => 'font-awesome:fa-text-width',
			'controls' => ld_theme_options_scheme_all_typography(),
		),
		array(
			'title'    => __( 'Page Title', 'lovey_dovey' ),
			'name'     => 'page_title',
			'icon'     => 'font-awesome:fa-columns',
			'controls' => array(
				array(
					'type'    => 'checkbox',
					'name'    => 'pages_with_title_section',
					'label'   => __( 'Enable Page Title Section in', 'lovey_dovey' ),
					'items'   => array(
						array(
							'label' => __( 'Blog Index (default Posts page)', 'lovey_dovey' ),
							'value' => 'blog_index',
						),
						array(
							'label' => __( 'Search result', 'lovey_dovey' ),
							'value' => 'search',
						),
						array(
							'label' => __( 'Blog Archive (category, tag, author, date archive)', 'lovey_dovey' ),
							'value' => 'blog_archive',
						),
						array(
							'label' => __( 'Blog Single (can be overrided via single post editor\'s metabox)', 'lovey_dovey' ),
							'value' => 'blog_single',
						),
						array(
							'label' => __( 'Single Page (can be overrided via single page editor\'s metabox)', 'lovey_dovey' ),
							'value' => 'page_single',
						),
					),
					'default' => array(
						'{{all}}',
					),
				),
				array(
					'type'   => 'section',
					'title'  => __( 'Default Style', 'lovey_dovey' ),
					'fields' => array(
						array(
							'type'    => 'radiobutton',
							'name'    => 'title_section_color_scheme',
							'label'   => __( 'Color Scheme', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'Black on White', 'lovey_dovey' ),
									'value' => 'light',
								),
								array(
									'label' => __( 'White on Black', 'lovey_dovey' ),
									'value' => 'dark',
								),
							),
							'default' => array(
								'dark',
							),
						),
						array(
							'type'    => 'upload',
							'name'    => 'title_section_background_image',
							'label'   => __( 'Background Image', 'lovey_dovey' ),
						),
						array(
							'type'    => 'select',
							'name'    => 'title_section_background_position',
							'label'   => __( 'Background Position', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'left top', 'lovey_dovey' ),
									'value' => 'left top',
								),
								array(
									'label' => __( 'center top', 'lovey_dovey' ),
									'value' => 'center top',
								),
								array(
									'label' => __( 'right top', 'lovey_dovey' ),
									'value' => 'right top',
								),
								array(
									'label' => __( 'left center', 'lovey_dovey' ),
									'value' => 'left center',
								),
								array(
									'label' => __( 'center center', 'lovey_dovey' ),
									'value' => 'center center',
								),
								array(
									'label' => __( 'right center', 'lovey_dovey' ),
									'value' => 'right center',
								),
								array(
									'label' => __( 'left bottom', 'lovey_dovey' ),
									'value' => 'left bottom',
								),
								array(
									'label' => __( 'center bottom', 'lovey_dovey' ),
									'value' => 'center bottom',
								),
								array(
									'label' => __( 'right bottom', 'lovey_dovey' ),
									'value' => 'right bottom',
								),
							),
						),
						array(
							'type'    => 'select',
							'name'    => 'title_section_background_attachment',
							'label'   => __( 'Background Attachment', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'scroll', 'lovey_dovey' ),
									'value' => 'scroll',
								),
								array(
									'label' => __( 'fixed', 'lovey_dovey' ),
									'value' => 'fixed',
								),
							),
						),
						array(
							'type'    => 'select',
							'name'    => 'title_section_background_repeat',
							'label'   => __( 'Background Repeat', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'no-repeat', 'lovey_dovey' ),
									'value' => 'no-repeat',
								),
								array(
									'label' => __( 'repeat', 'lovey_dovey' ),
									'value' => 'repeat',
								),
								array(
									'label' => __( 'repeat-x', 'lovey_dovey' ),
									'value' => 'repeat-x',
								),
								array(
									'label' => __( 'repeat-y', 'lovey_dovey' ),
									'value' => 'repeat-y',
								),
							),
						),
						array(
							'type'    => 'select',
							'name'    => 'title_section_background_size',
							'label'   => __( 'Background Size', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'auto', 'lovey_dovey' ),
									'value' => 'auto',
								),
								array(
									'label' => __( 'contain', 'lovey_dovey' ),
									'value' => 'contain',
								),
								array(
									'label' => __( 'cover', 'lovey_dovey' ),
									'value' => 'cover',
								),
							),
						),
						array(
							'type'    => 'select',
							'name'    => 'title_section_overlay',
							'label'   => __( 'Overlay', 'lovey_dovey' ),
							'items'   => array(
								array(
									'label' => __( 'none', 'lovey_dovey' ),
									'value' => 'none',
								),
								array(
									'label' => __( 'dotted-overlay', 'lovey_dovey' ),
									'value' => 'dotted-overlay',
								),
								array(
									'label' => __( 'black-overlay', 'lovey_dovey' ),
									'value' => 'black-overlay',
								),
							),
							'default' => 'none',
						),
						array(
							'type'    => 'toggle',
							'name'    => 'title_section_enable_parallax',
							'label'   => __( 'Enable Parallax', 'lovey_dovey' ),
							'default' => 1,
						),
					),
				),
			),
		),
		array(
			'title' => __('The Couple', 'lovey_dovey'),
			'name' => 'couple_settings',
			'icon' => 'font-awesome:fa-heart',
			'controls' => array(
				array(
					'type'         => 'datetime',
					'name'         => 'wedding_date',
					'label'        => __('Wedding Date', 'lovey_dovey'),
					'time_only'    => false,
					'is_rtl'       => false,
					'control_type' => 'slider',
					'date_format'  => 'yy-mm-dd',
					'time_format'  => 'HH:mm',
				),
				array(
					'type' => 'section',
					'title' => __('Party A (Left)','lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'party_a_photo',
							'label' => __('Photo', 'lovey_dovey'),	
							// 'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_fullname',
							'label' => __('Full Name', 'lovey_dovey'),
							'default' => 'Lovey Dawson',
							'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_nickname',
							'label' => __('Nickname', 'lovey_dovey'),
							'default' => 'Lovey',
							'validation' => 'required',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'party_a_gender',
							'label' => __('Gender', 'lovey_dovey'),
							'items' => array(
								array(
									'value' => 'male',
									'label' => __('Male', 'lovey_dovey')
								),
								array(
									'value' => 'female',
									'label' => __('Female', 'lovey_dovey')
								),
							),
							'default' => array(
								'male',
							),
						),
						array(
							'type' => 'textarea',
							'name' => 'party_a_about',
							'label' => __('About', 'lovey_dovey'),
							'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_facebook',
							'label' => __('Facebook Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_twitter',
							'label' => __('Twitter Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_googleplus',
							'label' => __('Google+ Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_instagram',
							'label' => __('Instagram Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_a_email',
							'label' => __('Email Account', 'lovey_dovey'),
							'validation' => 'email',
						),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Party B (Right)','lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'upload',
							'name' => 'party_b_photo',
							'label' => __('Photo', 'lovey_dovey'),	
							// 'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_fullname',
							'label' => __('Full Name', 'lovey_dovey'),
							'default' => 'Dovey White',
							'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_nickname',
							'label' => __('Nickname', 'lovey_dovey'),
							'default' => 'Dovey',
							'validation' => 'required',
						),
						array(
							'type' => 'radiobutton',
							'name' => 'party_b_gender',
							'label' => __('Gender', 'lovey_dovey'),
							'items' => array(
								array(
									'value' => 'male',
									'label' => __('Male', 'lovey_dovey')
								),
								array(
									'value' => 'female',
									'label' => __('Female', 'lovey_dovey')
								),
							),
							'default' => array(
								'female',
							),
						),
						array(
							'type' => 'textarea',
							'name' => 'party_b_about',
							'label' => __('About', 'lovey_dovey'),
							'validation' => 'required',
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_facebook',
							'label' => __('Facebook Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_twitter',
							'label' => __('Twitter Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_googleplus',
							'label' => __('Google+ Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_instagram',
							'label' => __('Instagram Account', 'lovey_dovey'),
						),
						array(
							'type' => 'textbox',
							'name' => 'party_b_email',
							'label' => __('Email Account', 'lovey_dovey'),
							'validation' => 'email',
						),
					),
				),
			),
		),
		array(
			'title' => __('Custom Scripts', 'lovey_dovey'),
			'name' => 'custom_scripts',
			'icon' => 'font-awesome:fa-code',
			'controls' => array(
				array(
					'type' => 'section',
					'title' => __('Document Scripts', 'lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'head_script',
							'label' => __('Head Script', 'lovey_dovey'),
							'mode' => 'html',
						),
						array(
							'type' => 'codeeditor',
							'name' => 'foot_script',
							'label' => __('Foot Script', 'lovey_dovey'),
							'mode' => 'html',
						),
					),
				),
				array(
					'type' => 'section',
					'title' => __('Custom CSS', 'lovey_dovey'),
					'fields' => array(
						array(
							'type' => 'codeeditor',
							'name' => 'custom_css',
							'label' => __('Custom CSS', 'lovey_dovey'),
							'mode' => 'css',
						),
					),
				),
			),
		),
	)
);

/**
 *EOF
 */