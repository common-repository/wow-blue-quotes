<?php
/*
Plugin Name: WoW Blue Quotes
Plugin URI: 
Description: Add a blue quote to your post or pages like GM posts in battle.net forums with a great style, using [bluequote][/bluequote]. Also you can show author and two links to sources.
Version: 2.0
Date: Sep 27, 2011
Author: jGarp
Author URI: 
*/ 

function wowBlueQuotes( $atts, $content = null ) {  
	extract(shortcode_atts(array(  
        "author" => '',
		"link"   => '',
		"source"   => ''
    ), $atts));
	
	$bluequote  = '<div class="wowbq-bluequote">';
	if(!(empty($author) and empty($link) and empty($source))) {
		$bluequote .= '<div class="wowbq-postedby">';
		if(!empty($author)) {
			$bluequote .= __("Originally Posted by", "wowbq").' <strong>'.$author.'</strong>';
		}
		if(!empty($link) and !empty($source)) {
			$bluequote .= ' (<a href="'.$link.'" target="_blank">'.__("Blue Tracker", "wowbq").'</a> / <a href="'.$source.'" target="_blank">'.__("Official Forums", "wowbq").'</a>)';
		}else if(!empty($link)) {
			$bluequote .= ' (<a href="'.$link.'" target="_blank">'.__("Blue Tracker", "wowbq").'</a>)';
		}else if(!empty($source)) {
			$bluequote .= ' (<a href="'.$source.'" target="_blank">'.__("Official Forums", "wowbq").'</a>)';
		}
		$bluequote .= '</div><div class="wowbq-clear"></div>';
	}
	$bluequote .= $content.'</div><div class="wowbq-clear"></div>';
	
    return $bluequote;
}

/* create shortcode */
add_shortcode("bluequote", "wowBlueQuotes");

/* load style */
wp_enqueue_style('wow-blue-quotes-custom-css', plugins_url('style.css', __FILE__));

/* load jquery.corner script */
wp_enqueue_script('wow-blue-quotes-jquery.corner', plugins_url('/js/jquery.corner.js', __FILE__), array('jquery') );

/* load custom script */
wp_enqueue_script('wow-blue-quotes-custom-js', plugins_url('/js/custom.js', __FILE__), array('jquery', 'wow-blue-quotes-jquery.corner') );
?>