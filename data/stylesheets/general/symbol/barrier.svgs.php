<?php
if ( !defined('ROOT') ) {
	define('ROOT',dirname(dirname(dirname(__FILE__))));

	set_include_path (        
		get_include_path() . PATH_SEPARATOR .
		ROOT . '/general/'
	);
}
require_once "conf/barrier.conf.php";	


foreach ( $RENDER_ZOOMS as $zoom ) {
	foreach ( $BARRIERPOINT AS $selector => $a ) {
		if ( !empty($a['symbol-file']) && !empty($a['zooms']) && in_array($zoom,$a['zooms']) ) {
			
			$size = exponential($a['symbol-size'],$zoom);			
			$color = empty($a['symbol-color']) ? '#000000' : linear($a['symbol-color'],$zoom);
			$opacity = empty($a['symbol-opacity']) ? '1' : linear($a['symbol-opacity'],$zoom);
			
			$pre = "";
			$post = "";
						
			require "{$a['symbol-file']}.svg.tpl";
			
			svg2png("/symbol/~{$a['symbol-file']}-$zoom-$color.png",$svg);
		}
	}
}


