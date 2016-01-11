<?php

function easy_event_settings_page() {
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Debugging WP', 'easy_event' ); ?></h1>

		<form method="post" action="options.php">
			<?php
			settings_fields( "section" );
			do_settings_sections( "easy-event-options" );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

function easy_event_add_theme_menu_item() {
	add_submenu_page( 'edit.php?post_type=easy_event', esc_html__( 'Setting', 'easy_event' ), esc_html__( 'Setting', 'easy_event' ), 'manage_options', 'easy-event-setting', 'easy_event_settings_page' );
}

add_action( 'admin_menu', 'easy_event_add_theme_menu_item' );


function easy_event_display_select_theme_element() {
	$single_template = get_option( 'easy_event_single_template' );

	?>
	<textarea name="easy_event_single_template" id="easy_event_single_template" cols="100" rows="10"><?php echo $single_template; ?></textarea>
	<?php
}

function easy_event_display_theme_panel_fields() {
	add_settings_section( 'section', 'All Settings', null, 'easy-event-options' );

	add_settings_field( 'easy_event_single_template', esc_html__( 'Single Template', 'easy_event' ), 'easy_event_display_select_theme_element', 'easy-event-options', 'section' );

	register_setting( 'section', 'easy_event_single_template' );
}

add_action( 'admin_init', 'easy_event_display_theme_panel_fields' );