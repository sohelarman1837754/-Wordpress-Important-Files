<?php
//Register post type
function wizixo_custom_posts() {
    register_post_type( 'bike',
        array(
            'labels' => array(
                'name' => esc_html__( 'Portfolio','wizixo' ),
                'singular_name' => esc_html__( 'Service','wizixo' )
            ),
            'supports' => array('title', 'editor', 'thumbnail'),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => false,
            'menu_position' => 7
        )
    );  

}
add_action( 'init', 'wizixo_custom_posts' );


//taxonomy
function wizixo_custom_post_taxonomy() {
 
     register_taxonomy(
        'bikecat',  
        'bike',                  
        array(
            'hierarchical'          => true,
            'label'                 =>esc_html__('Portfolio Category','wizixo'),  
            'query_var'             => true,
            'show_admin_column'     => true,
            'has_archive' => true,
            'rewrite'               => array(
                'slug'              => esc_html__('portfolio-cat','wizixo'), 
                'with_front'    => true ,
                )
            )
    );

}
add_action( 'init', 'wizixo_custom_post_taxonomy');




/*============Query===========*/
 $q = new WP_Query( array(
    'post_type'      => 'product',
      'posts_per_page' => -1, 
  ));


while($q->have_posts()) : $q->the_post();
			
  //content here
endwhile;
