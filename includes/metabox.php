<?php

add_filter( 'rwmb_meta_boxes', 'easy_event_register_meta_boxes_event' );
function easy_event_register_meta_boxes_event( $meta_boxes ) {
	$prefix = 'easy_event_';

	$meta_boxes[] = array(
		'id'         => $prefix . 'times',
		'title'      => __( 'Time event', 'easy_event' ),
		'post_types' => array( 'easy_event' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'id'         => $prefix . 'date_start',
				'name'       => __( 'Start time', 'easy_event' ),
				'desc'       => '',
				'type'       => 'date',
				'std'        => date( 'd/m/Y' ),
				'js_options' => array(
					'appendText'      => '(dd/mm/yyyy)',
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'easy_event' ),
					'dateFormat'      => 'dd/mm/yy',
					'numberOfMonths'  => 1,
					'showButtonPanel' => true,
				),
			),
			array(
				'id'         => $prefix . 'date_finish',
				'name'       => __( 'Finish Time', 'easy_event' ),
				'desc'       => '',
				'type'       => 'date',
				'std'        => date( 'd/m/Y' ),
				'js_options' => array(
					'appendText'      => '(dd/mm/yyyy)',
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'easy_event' ),
					'dateFormat'      => 'dd/mm/yy',
					'numberOfMonths'  => 1,
					'showButtonPanel' => true,
				),
			),
			array(
				'id'   => $prefix . 'address',
				'name' => __( 'Address', 'easy_event' ),
				'type' => 'text',
			),
			array(
				'id'            => $prefix . 'map',
				'name'          => __( 'Location', 'easy_event' ),
				'type'          => 'map',
				// Default location: 'latitude,longitude[,zoom]' (zoom is optional)
				'std'           => '-6.233406,-35.049906,15',
				// Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
				'address_field' => $prefix . 'address',
			),

		),
	);

	return $meta_boxes;
}