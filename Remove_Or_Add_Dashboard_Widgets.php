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

function another_add_dashboard_widgets() {
   add_meta_box( 'id', 'Dashboard Widget Title', 'dash_widget', 'dashboard', 'side', 'high' );
}
add_action( 'wp_dashboard_setup', 'another_add_dashboard_widgets' );

/**
 * Output the contents of the dashboard widget
 */
function dash_widget( $post, $callback_args ) {
    $html='This is a Another widget. <a href="https://google.com">Contact the outhor</a>';

    echo $html;
}

