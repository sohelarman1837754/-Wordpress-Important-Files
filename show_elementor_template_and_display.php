<?php

// Grab The templates

$templates = Elementor\Plugin::instance()->templates_manager->get_source( 'local' )->get_items();

        $options = [
            '0' => '— ' . __( 'Select', 'auros-core' ) . ' —',
        ];

        $types = [];

        foreach ( $templates as $template ) {
            $options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            $types[ $template['template_id'] ] = $template['type'];
        }


//Show On Control
	$this->add_control(
			'select_template',
			[
				'label' => __( 'Select Template', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 0,
	            'options' => $options,
	            'types' => $types,
			]
		);
    
   //Render The template
   $html.=''.\Elementor\Plugin::instance()->frontend->get_builder_content_for_display($settings['select_template']).'';
