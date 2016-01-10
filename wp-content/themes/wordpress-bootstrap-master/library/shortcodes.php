<?php

// shortcodes




// Buttons
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
	'size' => 'default', /* mini, small, default, large */
	'url'  => '',
	'text' => '', 
	), $atts ) );
	
	if($type == "default"){
		$type = "";
	}
	else{ 
		$type = "btn-" . $type;
	}
	
	if($size == "default"){
		$size = "";
	}
	else{
		$size = "btn-" . $size;
	}
	
	$output = '<a href="' . $url . '" class="btn '. $type . ' ' . $size . '">';
	$output .= $text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('button', 'buttons'); 

// Alerts
function alerts( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= $text . '</div>';
	
	return $output;
}

add_shortcode('alert', 'alerts');

// Block Messages
function block_messages( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'alert-info', /* alert-info, alert-success, alert-error */
	'close' => 'false', /* display close link */
	'text' => '', 
	), $atts ) );
	
	$output = '<div class="fade in alert alert-block alert-'. $type . '">';
	if($close == 'true') {
		$output .= '<a class="close" data-dismiss="alert">×</a>';
	}
	$output .= '<p>' . $text . '</p></div>';
	
	return $output;
}

add_shortcode('block-message', 'block_messages'); 

// Block Messages
function blockquotes( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'float' => '', /* left, right */
	'cite' => '', /* text for cite */
	), $atts ) );
	
	$output = '<blockquote';
	if($float == 'left') {
		$output .= ' class="pull-left"';
	}
	elseif($float == 'right'){
		$output .= ' class="pull-right"';
	}
	$output .= '><p>' . $content . '</p>';
	
	if($cite){
		$output .= '<small>' . $cite . '</small>';
	}
	
	$output .= '</blockquote>';
	
	return $output;
}

add_shortcode('blockquote', 'blockquotes'); 
 
// Info boxes
function infobox_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'titulo' => '',
	'class' => '',
	), $atts ) );
	
	$output = '<div class="infobox';
	
	if($class){
	    $output .= ' '.$class;
	}
	
	$output .= '"><h3>' . $titulo . '</h3>';
	$output .= '<p>' . $content . '</p>';
	$output .= '</div>';
	
	return $output;
}

add_shortcode( 'infobox', 'infobox_shortcode' );

// Iframes
function leyenda_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'texto' => '',
	'class' => '',
	), $atts ) );
	
	$output = '<div class="leyenda';
	
	if($class){
	    $output .= ' '.$class;
	}
	
	// Borramos el p
	$chars = ' \t\n\r\0\x0B';
	$subpattern = '(<(br|p)[^>]*>)';
    $pattern = '~(^'.$subpattern.'|'.$subpattern.'$)~i';
	$data = trim(preg_replace($pattern, '', $content), $chars);
	$data = preg_replace('/width="\d+"/i', "", $data);
	$data = preg_replace('/height="\d+"/i', "", $data);
    $data = addClass($data, 'video');
    
	$output .= '"><div class="iframe">'. $data.' </div>';
	$output .= '<p>' . $texto . '</p>';
	$output .= '</div>';
	
	return $output;
}

add_shortcode( 'leyenda', 'leyenda_shortcode' );

function addClass($htmlString = '', $newClass) 
{
    $pattern = '/class="([^"]*)"/';

    // class attribute set
    if (preg_match($pattern, $htmlString, $matches)) {
        $definedClasses = explode(' ', $matches[1]);
        if (!in_array($newClass, $definedClasses)) {
            $definedClasses[] = $newClass;
            $htmlString = str_replace($matches[0], sprintf('class="%s"', implode(' ', $definedClasses)), $htmlString);
        }
    }

    // class attribute not set
    else {
        $htmlString = str_replace("<iframe", sprintf('<iframe class="%s" ', $newClass), $htmlString);
    }

    return $htmlString;
}

?>
