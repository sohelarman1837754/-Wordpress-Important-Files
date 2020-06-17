<?php

function show_current_user_post_list( $atts = array() ) {

if (!is_user_logged_in()) return;
$items='';   
$args = array(
    'post_type'      => 'video',
    'author'         => get_current_user_id(),
    'status'         => 'publish',
    'posts_per_page' => 10
    );
$jobs = get_posts( $args );
foreach($jobs as $job){

	$items.='<h1>'.$job->post_title.' <a href="'.home_url('wp-admin/post.php?post='.$job->ID.'&action=edit').'"> Edit</a></h1>';
  

  }

return $items;
}
add_shortcode( 'user_post_list', 'show_current_user_post_list' );
