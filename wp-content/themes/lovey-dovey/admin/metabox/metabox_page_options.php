<?php

return array(
	'id'          => '_page_options',
	'types'       => array_merge( array( 'page', 'post', 'event' ) ),
	'title'       => __( 'Page Options', 'lovey_dovey' ),
	'priority'    => 'core',
	'template'    => array(
		array(
			'type'        => 'radiobutton',
			'name'        => 'enable_page_title_section',
			'label'       => __( 'Page Title Section', 'lovey_dovey' ),
			'description' => __( 'If you set this page as "Posts Page" in your Reading Settings, this option will be overrided by Default Settings in Theme Options', 'lovey_dovey' ),
			'items'       => array(
				array(
					'label' => __( 'Inherit from Theme Options', 'lovey_dovey' ),
					'value' => -1,
				),
				array(
					'label' => __( 'Disabled', 'lovey_dovey' ),
					'value' => 0,
				),
				array(
					'label' => __( 'Enabled', 'lovey_dovey' ),
					'value' => 1,
				),
			),
			'default'     => array(
				-1,
			),
		),
	),
);