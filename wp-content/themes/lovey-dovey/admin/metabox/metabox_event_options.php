<?php

return array(
	'id'          => '_event_options',
	'types'       => array( 'event' ),
	'title'       => __( 'Event Options', 'lovey-dovey' ),
	'priority'    => 'high',
	'template'    => array(
		array(
			'type'        => 'date',
			'name'        => 'event_date',
			'label'       => __( 'Event Date', 'lovey-dovey' ),
			'format'      => 'yy-mm-dd',
			'default'     => 'now',
			'validation'  => 'required',
		),
		array(
			'type'        => 'textbox',
			'name'        => 'event_time',
			'label'       => __('Time', 'lovey_dovey'),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'event_venue',
			'label'       => __('Venue', 'lovey_dovey'),
		),
		array(
			'type'        => 'textbox',
			'name'        => 'event_address',
			'label'       => __('Address', 'lovey_dovey'),
		),
		array(
			'type'				=> 'textbox',
			'name'				=> 'event_map',
			'label'				=> __('Google Map Latitude / Longitude', 'lovey_dovey'),
			'description' => __('Comma separated, e.g. "-7.9812985, 112.6319264"', 'lovey_dovey'),
		),
	),
);