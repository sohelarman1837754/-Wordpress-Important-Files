<?php

 $q = new WP_Query( array(
    'post_type'      => 'product',
      'posts_per_page' => -1, 
  ));


while($q->have_posts()) : $q->the_post();
			
  //content here
endwhile;
