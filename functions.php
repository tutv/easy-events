<?php

/**
 * Custom excerpt
 *
 * @param $post_excerpt
 *
 * @return mixed|string
 */
function easy_event_the_excerpt( $post_excerpt ) {
	$post_id = get_the_ID();
	$post    = get_post( $post_id );

	$excerpt_temp = $post->post_excerpt;

	if ( $excerpt_temp == '' ) {
		$excerpt_temp = get_post_meta( $post_id, 'easy_event_description', true );
	}

	if ( $excerpt_temp == '' ) {
		$excerpt_temp = strip_tags( $post->post_content );
	}

	$excerpt_temp = strip_shortcodes( $excerpt_temp );

	/**
	 * Excerpt length
	 */
	$excerpt_length = get_option( 'easy_event_excerpt_length' );
	if ( $excerpt_length == false ) {
		$excerpt_length = 250;
	}

	$excerpt_length += 5;
	if ( mb_strlen( $excerpt_temp ) > $excerpt_length ) {
		$subex   = mb_substr( $excerpt_temp, 0, $excerpt_length - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			return mb_substr( $subex, 0, $excut ) . '[...]';;
		} else {
			return $subex . '[...]';
		}
	} else {
		return $excerpt_temp;
	}
}

add_filter( 'the_excerpt', 'easy_event_the_excerpt' );