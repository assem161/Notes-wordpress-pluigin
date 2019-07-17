<?php 
function Notes_shortcode($atts,$content = null){
	global $post;
	$atts = shortcode_atts(array(	
			"title" => "my notes",
			"count" => 10,
			"category" => "all"),$atts);

	// check category return all
	if ($atts['category'] == 'all') {
		$terms = '';
	}else{
		$terms = array(
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $atts['category']	
			)
		);
	}

	// start work with post type Notes


	$args = array(
	    'post_type' => 'Notes',
	    'post_status' => 'publish',
	    'orderby'  		=> 'due_date',
	    'order'    		=> 'ASC',
	    'post_per_page' => $atts['count'],
	    'tax_query' =>  $terms
	);	

	$Notes = new WP_Query( $args );

	if($Notes->have_posts()){
		$category = str_replace('-', ' ', $atts['category']);
		$category = strtolower($category);

		$output = '';

		$output .='<div class="Notes-wrap">';

		while ( $Notes->have_posts()) {
			$Notes->the_post();

			// get field values ---------
			$prioity  = get_post_meta($post->ID,'prioity',true);
			$detalies = get_post_meta($post->ID,'detalies',true);
			$due_date = get_post_meta($post->ID,'due-date',true);

			$output .='<div class="Note">';
			$output .='<h4>'.get_the_title().'</h4>';
			$output .='<div class="detalies">'.$detalies.'</div>';
			$output .='<div class="piroity">'.$prioity.'</div>';
			$output .='<div class="due-date">Date : '.$due_date.'</div>';
			$output .='</div>';
		}

		$output .='</div>';

		 wp_reset_postdata();
		return $output;
	}else{
		return '<p>there is no Notes</p>';
	}
}

add_shortcode('Notes','Notes_shortcode');