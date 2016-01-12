<?php
/**
 * Created by PhpStorm.
 * User: Tu TV
 * Date: 11/1/2016
 * Time: 9:21 AM
 */

/**
 *  Override Easy Event Template
 *
 * @param $single_template
 *
 * @return mixed
 */
function easy_event_override_template( $single_template ) {
	global $post;

	if ( $post->post_type == 'easy_event' ) {
		if ( is_archive() ) {
			if ( locate_template( 'ee-templates/archive.php' ) != '' ) {
				return locate_template( 'ee-templates/archive.php' );
			}
		}

		if ( locate_template( 'ee-templates/single.php' ) != '' ) {
			return locate_template( 'ee-templates/single.php' );
		}
	}

	return $single_template;
}

add_filter( 'template_include', 'easy_event_override_template' );

/**
 * Filter Easy Event default
 *
 * @param $content
 *
 * @return mixed
 */
function easy_event_filter_the_content( $content ) {
	$content_temp = $content;
	if ( get_post_type() == 'easy_event' ) {
		$single_template = get_option( 'easy_event_single_template' );
		if ( $single_template == '' || $single_template == false ) {
			$single_template = file_get_contents( EASY_EVENT_DIR . '/template-default/single-content.php' );
		}

		$post_id = get_the_ID();

		// Description
		$description = get_post_meta( $post_id, 'easy_event_description', true );
		$content     = str_replace( '[ee_description]', $description, $single_template );

		// Content
		$content = str_replace( '[ee_content]', $content_temp, $content );

		// Start time
		$start_time = get_post_meta( $post_id, 'easy_event_time_start', true );
		$content    = str_replace( '[ee_start_time]', $start_time, $content );

		// Start date
		$start_date = get_post_meta( $post_id, 'easy_event_date_start', true );
		$content    = str_replace( '[ee_start_date]', $start_date, $content );

		// Finish time
		$finish_time = get_post_meta( $post_id, 'easy_event_time_finish', true );
		$content     = str_replace( '[ee_finish_time]', $finish_time, $content );

		// Finish date
		$finish_date = get_post_meta( $post_id, 'easy_event_date_finish', true );
		$content     = str_replace( '[ee_finish_date]', $finish_date, $content );

		// Address
		$address = get_post_meta( $post_id, 'easy_event_address', true );
		$content = str_replace( '[ee_address]', $address, $content );

		// Top
		$top_html = '';
		$image    = get_post_thumbnail_id( $post_id );
		if ( $image != '' ) {
			$featured_image = wp_get_attachment_image( $image, 'full' );

			$top_html .= '<div class="ee-thumbnail">' . $featured_image . '</div>';
		}

		/**
		 * Count down
		 */
		if ( $start_date != '' ) {
			$time_event = $start_date . ' ';
			if ( $start_time == '' ) {
				$time_event .= '00:00:00';
			} else {
				$time_event .= $start_time . ':00';
			}

			$time_builder = date_create()->createFromFormat(
				'd/m/Y H:i:s',
				$time_event
			);

			$top_html .= '<div class="ee-count-down" data-time="' . $time_builder->format( 'Y/m/d H:i:s' ) . '">
			<div class="days ee_round">
				<div class="number">0</div>
				<div class="text">' . esc_html__( 'Days', 'easy_event' ) . '</div>
			</div>
			<div class="hours ee_round">
				<div class="number">0</div>
				<div class="text">' . esc_html__( 'Hours', 'easy_event' ) . '</div>
			</div>
			<div class="minutes ee_round">
				<div class="number">0</div>
				<div class="text">' . esc_html__( 'Minutes', 'easy_event' ) . '</div>
			</div>
			<div class="seconds ee_round">
				<div class="number">0</div>
				<div class="text">' . esc_html__( 'Seconds', 'easy_event' ) . '</div>
			</div>
		</div>';
		}

		if ( $top_html != '' ) {
			$top_html = '<div class="ee-top">' . $top_html . '</div>';
		}
		$content = str_replace( '[ee_top]', $top_html, $content );

		wp_enqueue_style( 'easy_event', EASY_EVENT_URI . '/assets/css/style.min.css', array(), EASY_EVENT_VERSION );
		wp_enqueue_script(
			'jquery-countdown',
			EASY_EVENT_URI . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), EASY_EVENT_VERSION
		);
		wp_enqueue_script(
			'easy-event',
			EASY_EVENT_URI . '/assets/js/easy-event.js',
			array( 'jquery', 'jquery-countdown' ),
			EASY_EVENT_VERSION
		);
	}

	return $content;
}

add_filter( 'the_content', 'easy_event_filter_the_content' );