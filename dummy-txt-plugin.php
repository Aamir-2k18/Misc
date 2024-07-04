<?php 
/*
Plugin Name: Dummy Text
URI: n/a
Author: A
Author URI: n/a
Version: 1.0
Description: A plugin that generates Dummy Text paragraphs.
*/
function dtxt($p) {
    extract(shortcode_atts(array('p'=>'p'), $p));
    $para = "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mollis dolor et hendrerit ultrices. Donec eget orci nisl. Nunc et tellus tempor, placerat lacus at, maximus leo. Maecenas id ex at quam laoreet viverra sit amet nec enim. Aenean commodo pulvinar magna, non venenatis dui pharetra eu. Integer rhoncus, risus placerat pretium suscipit, sapien dolor bibendum nisl, porta rhoncus erat sapien at sem. Suspendisse potenti. Nullam vulputate pretium dui non dictum.";
    if($p == null ||$p == "" || $p == 1){ return $para;}
    elseif($p > 1){ return str_repeat($para, $p); }
    else{return $para; }
}

add_shortcode('dt', 'dtxt');
?>