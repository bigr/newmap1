<?php
require_once "conf/text.conf.php";
require_once "conf/symbol.conf.php";

$TEXT_SYMBOL_DENSITY = array(11 => 5,12 => 10,13 => 90, 14 => 250, 15 => 1000,16 => 20000);

$TEXT_SYMBOL = array(
	"[tourism='information'][information='guidepost']" => array(
			'zooms' => array(13 => 4, 14 => 4, 15 => 3,16 => 3, 17 => 3, 18 => 3),
			'size' => array(13 => 8,14 => 9, 15 => 10, 17=>13),
			'color' => array(15 => '#440000'),
		),
	"[historic='castle'][castle_type='no'][ruins='no'],[historic='castle'][castle_type='stately'][ruins='no'],[historic='castle'][castle_type='schloss'][ruins='no'],[historic='castle'][castle_type='burg;schloss'][ruins='no'],[historic='castle'][castle_type='palace'][ruins='no'],[historic='castle'][castle_type='manor'][ruins='no'],[historic='castle'][castle_type='castle'][ruins='no'],[historic='castle'][castle_type='defensive;stately'][ruins='no'],[historic='castle'][castle_type='chateau'][ruins='no'],[historic='castle'][castle_type='kremlin'][ruins='no']" => array(
	        'zooms' => array(12 => 4, 13 => 3, 14 => 3, 15 => 3, 16 => 3, 17 => 2, 18 => 2),
			'size' => array(12 => 9, 13 => 12, 16 => 15, 17 => 18),
			'color' => array(15 => '#990000'),
	    ),
	"[historic='castle'][castle_type='defensive'],[historic='castle'][castle_type='burg'],[historic='castle'][castle_type='fortress'],[historic='castle'][castle_type='festung'],[historic='castle'][castle_type='tower'],[historic='castle'][castle_type='tower'],[historic='castle'][castle_type='castrum'],[historic='castle'][castle_type='mansion'],[historic='castle'][castle_type='citadel'],[historic='castle'][castle_type='fortification'],[historic='castle'][castle_type='medieval']" => array(
	        'zooms' => array(12 => 4, 13 => 3, 14 => 3, 15 => 3, 16 => 3, 17 => 2, 18 => 2),
			'size' => array(12 => 10, 13 => 13, 16 => 16, 17 => 19),
			'color' => array(15 => '#990000'),
	    ),
	"[ruins!='no'][historic='castle'],[ruins='castle']" => array(
	        'zooms' => array(13 => 4, 14 => 3, 15 => 3, 16 => 3, 17 => 2, 18 => 2),
			'size' => array(13 => 11, 16 => 13, 17 => 18),
			'color' => array(15 => '#990000'),
	    ),
	"[historic='monastery'],[\"place_of_worship:type\"='monastery'],[place_of_worship='monastery'],[historic='monument'],[man_made='tower'][\"tower:type\"='communication'],[tourism='zoo'],[natural='cave_entrance'],[amenity='theatre'],[tourism='museum']" => array(
			'zooms' => array(13 => 4, 14 => 4, 15 => 3, 16 => 3, 17 => 2, 18 => 2),
			'size' => array(13 => 10, 16 => 12, 17 => 17),
			'color' => array(15 => '#990000'),
		),
	"[tourism='hotel'],[tourism='hostel'],[tourism='motel']" => array(
			'zooms' => array(14 => 4, 15 => 4,16 => 4, 17 => 3, 18 => 3),
			'size' => array(14 => 9,15 => 10, 17=>15),
			'color' => array(15 => '#000000'),
		),
	"[tourism='guest_house']" => array(
			'zooms' => array(15 => 4,16 => 4, 17 => 4, 18 => 3),
			'size' => array(15 => 9,17=>12),
			'color' => array(15 => '#000000'),
		),
	"[amenity='restaurant'], [amenity='fast_food'], [amenity='cafe'], [amenity='pub'], [amenity='bar']" => array(
			'zooms' => array(15 => 4,16 => 4, 17 => 4, 18 => 4),
			'size' => array(16 => 9,17=>11),
			'color' => array(16 => '#000000'),
		),
	"[amenity='hospital'], [amenity='university'], [amenity='school'], [amenity='library']" => array(
			'zooms' => array(14 => 4, 15 => 4, 16 => 4, 17 => 4, 18 => 4),
			'size' => array(14 => 9, 15 => 10, 17=>15),
			'color' => array(16 => '#000000'),
		),
	"[historic='memorial']" => array(
			'zooms' => array(13 => 4, 14 => 4, 15 => 4, 16 => 4, 17 => 3, 18 => 3),
			'size' => array(13=>9 ,15 => 10,17=>14),
			'color' => array(16 => '#000000'),
		),
	"[historic='monument']" => array(
			'zooms' => array(13 => 4, 14 => 4, 15 => 3, 16 => 3, 17 => 3, 18 => 3),
			'size' => array(13=>10 ,15 => 11,17=>15),
			'color' => array(16 => '#000000'),
		),	
	"[tourism='camp_site']" => array(
			'zooms' => array(13 => 4, 14 => 3, 15 => 2, 16 => 1, 17 => 1, 18 => 1),
			'size' => array(13 => 11,17=>17),
			'color' => array(16 => '#000000'),
		),
	"[amenity='bank']" => array(
			'zooms' => array(14 => 4, 15 => 4, 16 => 3, 17 => 3, 18 => 3),
			'size' => array(14 => 9,17=>12),
			'color' => array(16 => '#000000'),
		),
);
