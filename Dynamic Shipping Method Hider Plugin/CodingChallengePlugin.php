<?php
/*
   Plugin Name: Awesomeness Repeater
   Plugin URI: http://myawesomeness.com
   description: My Repeating Shortcode
   */


  function repeater_func($atts, $content = "" ) {
	
	$value = shortcode_atts( array(
        'content' => "",
		'x' => '1'
    ), $atts );
	
    $repeat = $value['x'];
	$text = "<li>{$value['content']}</li>";
	
	return '<ul>' . str_repeat($text, $repeat) . '</ul>';
	
}
add_shortcode( 'repeat', 'repeater_func' );

?>
