<?php

add_filter( 'rwmb_meta_boxes', 'easy_event_register_meta_boxes_event' );
function easy_event_register_meta_boxes_event( $meta_boxes ) {
	$prefix = 'easy_event_';

	$meta_boxes[] = array(
		'id'         => $prefix . 'settings',
		'title'      => __( 'Event settings', 'easy_event' ),
		'post_types' => array( 'easy_event' ),
		'context'    => 'normal',
		'priority'   => 'high',
		'fields'     => array(
			array(
				'id'   => $prefix . 'description',
				'name' => __( 'Description', 'easy_event' ),
				'desc' => '',
				'type' => 'textarea',
			),
			array(
				'id'         => $prefix . 'date_start',
				'name'       => __( 'Start Date', 'easy_event' ),
				'desc'       => '',
				'type'       => 'date',
				'std'        => date( 'd/m/Y' ),
				'js_options' => array(
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'easy_event' ),
					'dateFormat'      => 'dd/mm/yy',
					'numberOfMonths'  => 1,
					'showButtonPanel' => true,
					'stepMinute'      => 15,
				),
			),
			array(
				'id'         => $prefix . 'time_start',
				'name'       => __( 'Start Time', 'easy_event' ),
				'desc'       => '',
				'type'       => 'time',
				'js_options' => array(
					'stepMinute' => 5,
				),
			),
			array(
				'id'         => $prefix . 'date_finish',
				'name'       => __( 'Finish Date', 'easy_event' ),
				'desc'       => '',
				'type'       => 'date',
				'std'        => date( 'd/m/Y' ),
				'js_options' => array(
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'easy_event' ),
					'dateFormat'      => 'dd/mm/yy',
					'numberOfMonths'  => 1,
					'showButtonPanel' => true,
				),
			),
			array(
				'id'         => $prefix . 'time_finish',
				'name'       => __( 'Finish Time', 'easy_event' ),
				'desc'       => '',
				'type'       => 'time',
				'js_options' => array(
					'stepMinute' => 5,
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
				'std'           => '-6.233406,-35.049906,15',
				'address_field' => $prefix . 'address',
			),
		)
	);

	return $meta_boxes;
}