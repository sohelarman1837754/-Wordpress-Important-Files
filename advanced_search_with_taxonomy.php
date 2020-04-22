<?php



add_action( 'init', 'my_theme_custom_post' );
function my_theme_custom_post() {
    register_post_type( 'agent',
        array(
            'labels' => array(
                'name' => __( 'Agents' ),
                'singular_name' => __( 'Agent' )
            ),
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
            'show_ui' => true,
            'public' => false
        )
	);
	

	register_taxonomy(
        'agent_location',  
        'agent',                  
        array(
            'hierarchical'          => true,
            'label'                 => 'Agent Location',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'agent-location', 
                'with_front'    => true 
                )
            )
    );

	register_taxonomy(
        'agent_project',  
        'agent',                  
        array(
            'hierarchical'          => true,
            'label'                 => 'Agent Project',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'agent-project', 
                'with_front'    => true 
                )
            )
    );

	register_taxonomy(
        'agent_size',  
        'agent',                  
        array(
            'hierarchical'          => true,
            'label'                 => 'Agent Size',  
            'query_var'             => true,
            'show_admin_column'     => true,
            'rewrite'               => array(
                'slug'              => 'agent-size', 
                'with_front'    => true 
                )
            )
    );
}


function agent_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => -1,
	), $atts) );
	

	if(!empty($_GET['a_location'])) {
		$a_location = $_GET['a_location'];
	} else {
		$a_location = '';
	}

	if(!empty($_GET['a_project'])) {
		$a_project = $_GET['a_project'];
	} else {
		$a_project = '';
	}

	if(!empty($_GET['a_size'])) {
		$a_size = $_GET['a_size'];
	} else {
		$a_size = '';
	}

	if(!empty($_GET['a_name'])) {
		$a_name = $_GET['a_name'];
	} else {
		$a_name = '';
	}


	$tax_query = array('relation' => 'AND');

	if(!empty($a_location)) {
		$tax_query[]= array(
          array(
	        'taxonomy' => 'product_cat',
	        'terms' => $a_location,
	        'field' => 'slug',
	        'include_children' => true,
	        'operator' => 'IN'
	    )
   	  );
	}

	if(!empty($a_project)) {
			$tax_query[]= array(
          array(
	        'taxonomy' => 'product_cat',
	        'terms' => $a_project,
	        'field' => 'slug',
	        'include_children' => true,
	        'operator' => 'IN'
	    )
   	  );
	}

	if(!empty($a_size)) {
			$tax_query[]= array(
          array(
	        'taxonomy' => 'product_cat',
	        'terms' => $a_size,
	        'field' => 'slug',
	        'include_children' => true,
	        'operator' => 'IN'
	    )
   	  );
	}
     
    $q = new WP_Query(
		array(
			'posts_per_page' => $count, 
			'post_type' => 'agent',
			's' => $a_name,
			'tax_query' => $tax_query
		)
	); 
	
	$list = '';

	


	$list .= '<form action="" class="project-search">
		<div class="search-element">
			<input value="'.$a_name.'" type="search" name="a_name" placeholder="Type name"/>
		</div>';

		$agent_location = get_terms( 'agent_location' );
		if(! empty( $agent_location ) && ! is_wp_error( $agent_location )) {
			$list .='<div class="search-element"><select name="a_location"><option value="">All Locations</option>';
			foreach ( $agent_location as $location ) {
				if($a_location == $location->term_id) {
					$l_markup = 'selected="selected"';
				} else {
					$l_markup = '';
				}
				$list .= '<option '.$l_markup.' value="' . $location->term_id . '">' . $location->name . '</option>';
			}
			$list .='</select></div>';
		}

		$agent_project = get_terms( 'agent_project' );
		if(! empty( $agent_project ) && ! is_wp_error( $agent_project )) {
			$list .='<div class="search-element"><select name="a_project"><option value="">All Projects</option>';
			foreach ( $agent_project as $project ) {
				if($a_project == $project->term_id) {
					$p_markup = 'selected="selected"';
				} else {
					$p_markup = '';
				}
				$list .= '<option '.$p_markup.' value="' . $project->term_id . '">' . $project->name . '</option>';
			}
			$list .='</select></div>';
		}

		$agent_size = get_terms( 'agent_size' );
		if(! empty( $agent_size ) && ! is_wp_error( $agent_size )) {
			$list .='<div class="search-element"><select name="a_size"><option value="">All Sizes</option>';
			foreach ( $agent_size as $size ) {
				if($a_size == $size->term_id) {
					$s_markup = 'selected="selected"';
				} else {
					$s_markup = '';
				}
				$list .= '<option '.$s_markup.' value="' . $size->term_id . '">' . $size->name . '</option>';
			}
			$list .='</select></div>';
		}

		$list .='
		<button type="submit">Search</button>
	</form>';
         
    $list .= '<div class="agent-list">';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $custom_field = get_post_meta($idd, 'custom_field', true);
        $post_content = get_the_content();
        $list .= '
        <div class="single-agent-item">
            <h2>' .do_shortcode( get_the_title() ). '</h2>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam excepturi magni culpa illum velit eaque asperiores quidem. Iure ab reiciendis saepe temporibus aperiam, quisquam magni commodi harum incidunt sed libero?</p>

			<div class="agent-info">';

			$agent_location = get_the_terms( get_the_ID(), 'agent_location' );

			if($agent_location && ! is_wp_error( $agent_location )) {
				$locations_array = array();

				foreach ( $agent_location as $location ) {
					$locations_array[] = $location->name;
				}
									
				$locations = join( ", ", $locations_array );

				$list .= '<p class="info"><strong>Locations:</strong> '.$locations.'</p>';
			}

			$agent_project = get_the_terms( get_the_ID(), 'agent_project' );

			if($agent_project && ! is_wp_error( $agent_project )) {
				$projects_array = array();

				foreach ( $agent_project as $project ) {
					$projects_array[] = $project->name;
				}
									
				$projects = join( ", ", $projects_array );

				$list .= '<p class="info"><strong>Projects:</strong> '.$projects.'</p>';
			}

			$agent_size = get_the_terms( get_the_ID(), 'agent_size' );

			if($agent_size && ! is_wp_error( $agent_size )) {
				$size_array = array();

				foreach ( $agent_size as $size ) {
					$size_array[] = $size->name;
				}
									
				$sizes = join( ", ", $size_array );

				$list .= '<p class="info"><strong>Sizes:</strong> '.$sizes.'</p>';
			}

			$list .='</div>

			<a href="" class="button">Contact agent</a>
        </div>
        ';        
    endwhile;
    $list.= '</div>';
    wp_reset_query();
    return $list;
}
add_shortcode('agents', 'agent_list_shortcode');  
