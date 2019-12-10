// Get Next And Prev Post Title and Links

// Prev Post
$prev_post = get_adjacent_post(false, '', true);
if(!empty($prev_post)) {
echo '<a href="' . get_permalink($prev_post->ID) . '" title="' . $prev_post->post_title . '">' . $prev_post->post_title . '</a>'; }

// Next Post
$next_post = get_adjacent_post(false, '', false);
if(!empty($next_post)) {
echo '<a href="' . get_permalink($next_post->ID) . '" title="' . $next_post->post_title . '">' . $next_post->post_title . '</a>'; }
