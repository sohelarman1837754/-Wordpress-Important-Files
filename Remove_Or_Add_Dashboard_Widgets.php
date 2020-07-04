<?php
//For Remove the Widgets
function remove_dashboard_widgets() {
    global $wp_meta_boxes;
 
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health']);
 
}
 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );




//For adding a new Widget

function wpdocs_add_dashboard_widgets() {
    wp_add_dashboard_widget( 'dashboard_widget', 'Example Dashboard Widget', 'dashboard_widget_function' );
}
add_action( 'wp_dashboard_setup', 'wpdocs_add_dashboard_widgets' );
 
/**
 * Output the contents of the dashboard widget
 */
function dashboard_widget_function( $post, $callback_args ) {
    esc_html_e( "Hello World, this is my first Dashboard Widget!", "textdomain" );
}
