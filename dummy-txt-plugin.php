<?php 
/*
Plugin Name: Dummy Text
URI: n/a
Author: Aamir
Author URI: n/a
Version: 1.0
Description: A plugin that generates Dummy Text paragraphs. [dt p=3]
*/

function dtxt($atts) {
    // Set default value for 'p' as 1
    $atts = shortcode_atts(array('p' => 1), $atts);
    $p = intval($atts['p']); // Convert the 'p' attribute to an integer
    
    // Dummy text paragraph
    $para = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mollis dolor et hendrerit ultrices. Donec eget orci nisl.   Maecenas id ex at quam laoreet viverra sit amet nec enim. Aenean commodo pulvinar magna, non venenatis dui pharetra eu.  </p>";

    // Return paragraphs based on the value of 'p'
    if ($p < 1) {
        $p = 1;
    }
    return str_repeat($para, $p);
}

add_shortcode('dt', 'dtxt');
