<?php
require_once "conf/text.conf.php";



/**
 * Zoom -> grade -> urb name visibility/render priority maping
 */
function urb_priorities($zoom,$grade) {		
	$sz = urb_name_size($zoom,$grade);
	$factor = linear(array(5 => 0.7, 8 => 0.8, 11 => 1, 13 => 1, 15 => 1.1,18 => 1.2),$zoom);
	$z2 = linear(array(5 => 1.1, 10 => 1.5, 12 => 1),$zoom);
	$z3 = linear(array(5 => 1.5, 10 => 2.5, 12 => 1),$zoom);
	$factor = linear(array(5 => 0.7, 8 => 0.8, 11 => 1, 12 => 1.3, 15 => 1.0),$zoom);
	if ( $sz > 96*$factor ) return -1;
	if ( $sz > 32*$factor ) return 0;
	if ( $sz > 16*$factor ) return 1;
	if ( $sz > $z2*8.0*$factor) return 2;
	if ( $sz > $z3*4.0*$factor ) return 3;
	if ( $sz > 2.0*$factor ) return 4;			
	return false;
}
 
/**
 * Urb name text color grade x zoom maping
 */
function urb_name_color($grade) {
	return array(5 => '#444444', 8 => '#000000');
}

/**
 * Urb name text opacity grade x zoom maping
 */
function urb_name_opacity($zoom,$grade) {
	$sz = urb_name_size($zoom,$grade);
	return linear(array(15 => 1, 40=>0.9, 80=> 0.65, 140 => 0.5),$sz);
	
}

$URB_NAME_UPPERCASE_SIZE = array(5 => 25, 13 => 40);

$URB_NAME_SIZE_ZOOM_EXPEX = array(4 => 1.72,5 => 1.30, 8 => 1.40, 11 => 1.28);
$URB_NAME_SIZE_GRADE_EXPEX = array(5 => 1.105,7 => 1.09, 15 => 1.08,30 => 1.07);

/**
 * Urb name text size grade x zoom maping
 */
function urb_name_size($zoom,$grade) {
	global $URB_NAME_SIZE_ZOOM_EXPEX, $URB_NAME_SIZE_GRADE_EXPEX;
	return expex($URB_NAME_SIZE_GRADE_EXPEX,$grade) * expex($URB_NAME_SIZE_ZOOM_EXPEX,$zoom) * 0.035;	
} 
 
/**
 * Urb name text halo radius grade x zoom maping
 */
function urb_name_halo_radius($grade) {	
	return array(12 => 3);
}

$URB_NAME_HALO_OPACITY = array(5=>0.1,7=>0.16,9=>0.33);

/**
 * Urb name dy grade x zoom maping
 */
function urb_name_dy($zoom,$grade) {
	$sz = urb_name_size($zoom,$grade);		
	return $sz * linear(array(10 => 0.25, 40 => 0.4, 120 => 0),$sz);
}


/**
 * Urb name wrap width grade x zoom maping
 */
function urb_name_wrap_width($zoom,$grade) {
	return urb_name_size($zoom,$grade) * 3.5;
}

/**
 * Column containg name of the urb
 */
$URB_NAME_COLUMN = array(
 5 => 'name_very_short',
 6 => 'name_very_short',
 7 => 'name_very_short',
 8 => 'name_very_short',
 9 => 'name_very_short',
10 => 'name_very_short',
11 => 'name_very_short',
12 => 'name_short',
13 => 'name_short',
14 => 'name_short',
15 => 'name',
16 => 'name',
17 => 'name',
18 => 'name'
);

/**
 * Zoom -> grade -> suburb name visibility/render priority maping
 */
function suburb_priorities($zoom,$grade) {	
	$sz = suburb_name_size($zoom,$grade);
	$z2 = linear(array(5 => 1.5, 10 => 1.4, 12 => 1),$zoom);
	$z3 = linear(array(5 => 2.5, 10 => 2.0, 12 => 1),$zoom);
	$factor = linear(array(5 => 0.7, 8 => 0.8, 11 => 1, 12 => 1, 14 => 1.4,15 => 1.2),$zoom);
	if ( $sz > 64*$factor ) return -1;
	if ( $sz > 32*$factor ) return 0;
	if ( $sz > 16*$factor ) return 1;
	if ( $sz > 8.0*$z2*$factor) return 2;
	if ( $sz > 4.0*$z3*$factor ) return 3;
	if ( $sz > 2.0*$factor ) return 4;			
	return false;
}
 
/**
 * Suburb name text color grade x zoom maping
 */
function suburb_name_color($grade) {
	return array(14 => '#000000');
}

/**
 * Urb name text opacity grade x zoom maping
 */
function suburb_name_opacity($zoom,$grade) {
	$sz = suburb_name_size($zoom,$grade);
	return linear(array(13 => 0.75, 20 => 0.6, 40=>0.5, 70 => 0.4, 120 => 0.3),$sz);	
}

$SUBURB_NAME_UPPERCASE_SIZE = array(5 => 50, 13 => 50);

$SUBURB_NAME_SIZE_ZOOM_EXPEX = array(5 => 1.5, 8 => 1.55, 12 => 1.55,14 => 1.65,15 => 1.75);
$SUBURB_NAME_SIZE_GRADE_EXPEX = array(5 => 1.08);


$SUBURB_NAME_HALO_OPACITY = array(13 => 0.7,16=>0.4);

/**
 * Suburb name text size grade x zoom maping
 */
function suburb_name_size($zoom,$grade) {
	global $SUBURB_NAME_SIZE_ZOOM_EXPEX, $SUBURB_NAME_SIZE_GRADE_EXPEX;
	return expex($SUBURB_NAME_SIZE_GRADE_EXPEX,$grade) * expex($SUBURB_NAME_SIZE_ZOOM_EXPEX,$zoom) * 0.0105;	
}

/**
 * Suburb name text halo radius grade x zoom maping
 */
function suburb_name_halo_radius($grade) {
	return array(12 => 4,14=>5,16 => 2);
}

/**
 * Suburb name wrap width grade x zoom maping
 */
function suburb_name_wrap_width($zoom,$grade) {
	return suburb_name_size($zoom,$grade) * 4;
}

/**
 * Zoom -> grade -> locality name visibility/render priority maping
 */
function locality_priorities($zoom) {	
	if ( $zoom < 12 ) return false;
	if ( $zoom == 12 ) return 4;
	$sz = locality_name_size($zoom);
	$factor = linear(array(5 => 0.7, 8 => 0.8, 11 => 1, 13 => 1, 15 => 1.1,18 => 1.2),$zoom);	
	if ( $sz > 96*$factor ) return -1;
	if ( $sz > 48*$factor ) return 0;
	if ( $sz > 24*$factor ) return 1;
	if ( $sz > 12.0*$factor) return 2;
	if ( $sz > 6.0*$factor ) return 3;
	if ( $sz > 3.0*$factor ) return 4;			
	return false;	
}

/**
 * Locality name text color grade x zoom maping
 */
function locality_name_color($zoom) {		
	return '#000000';		
}

/**
 * Locality name text size grade x zoom maping
 */
function locality_name_size($zoom) {		
	return 7 * pow(1.1,($zoom - 12));	
} 

/**
 * Locality name text halo radius grade x zoom maping
 */
function locality_name_halo_radius() {
	return array(14 => 2);
}


/**
 * Locality name wrap width grade x zoom maping
 */
function locality_name_wrap_width($zoom) {
	return locality_name_size($zoom) * 4;
}


function locality_name_opacity($zoom) {
	$sz = locality_name_size($zoom);
	return linear(array(15 => 0.8, 30=>0.7, 60 => 0.5, 120 => 0.22),$sz);	
}
