<?php

function wizixo_add_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'custom',
		[
			'title' => esc_html__( 'Custom Widgets', 'wizixo' ),
			'icon' => 'fa fa-plug',
		]
	);


}
add_action( 'elementor/elements/categories_registered', 'wizixo_add_elementor_widget_categories' );
