//

1: First create a style.file 
2: Create a PHP file for enquing the style sheet And call it in to plugin 
like : require_once(  plugin_dir_path( __FILE__ ) . '/inc/custon-editor-style.php');



3 Enquing the style url
Code :

//custon-editor-style.php

function add_my_stylesheet() 
{
    wp_enqueue_style( 'myCSS', plugins_url( '/assets/css/editor-style.css', __FILE__ ) );
}

add_action('elementor/editor/before_enqueue_scripts', 'add_my_stylesheet');


4: Create a class with background
.test-icon{
    background-image: url(../img/accordion.png) !important;
    background-repeat: no-repeat;
    background-size: auto !important;
    margin-top: -5px !important;
    width: 60px !important;
    height: 45px !important;
    display: block;
    margin-left: auto;
    margin-right: auto;
    background-position:center;
}

And call the class On Elementor get_icon();


