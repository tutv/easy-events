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
				'id'         => $prefix . 'date',
				'name'       => __( 'Date', 'easy_event' ),
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
		),
	);

	return $meta_boxes;
}