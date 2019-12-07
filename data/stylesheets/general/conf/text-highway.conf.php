<?php
require_once "conf/text.conf.php";
require_once "conf/highway.conf.php";


/**
 * Zoom -> grade -> road name visibility/render priority maping
 */
$ROAD_NAME_PRIORITIES = array (
 5 => array(),
 6 => array(),
 7 => array(),
 8 => array(),
 9 => array(),
10 => array(),
11 => array(),
12 => array(),
13 => array(),
14 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3, 
		HIGHWAY_UNCLASSIFIED => 3,
	),
15 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3, 
		HIGHWAY_UNCLASSIFIED => 3,
		HIGHWAY_SERVICE      => 3,
		HIGHWAY_RESIDENTIAL  => 3,
	),
16 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3, 
		HIGHWAY_UNCLASSIFIED => 3,
		HIGHWAY_SERVICE      => 3,
		HIGHWAY_RESIDENTIAL  => 3,
	),
17 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3, 
		HIGHWAY_UNCLASSIFIED => 3,
		HIGHWAY_SERVICE      => 3,
		HIGHWAY_RESIDENTIAL  => 3,
	),
18 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3, 
		HIGHWAY_UNCLASSIFIED => 3,
		HIGHWAY_SERVICE      => 3,
		HIGHWAY_RESIDENTIAL  => 3,
	),
);


/**
 * Zoom -> grade -> road ref visibility/render priority maping
 */
$ROAD_REF_PRIORITIES = array (
 5 => array(),
 6 => array(),
 7 => array(),
 8 => array(),
 9 => array(
		HIGHWAY_MOTORWAY     => 4,
		HIGHWAY_TRUNK        => 4,
		HIGHWAY_PRIMARY      => 4,
	),
10 => array(
		HIGHWAY_MOTORWAY     => 4,
		HIGHWAY_TRUNK        => 4,
		HIGHWAY_PRIMARY      => 4,
	),
11 => array(
		HIGHWAY_MOTORWAY     => 4,
		HIGHWAY_TRUNK        => 4,
		HIGHWAY_PRIMARY      => 4,
		HIGHWAY_SECONDARY    => 4,
	),
12 => array(
		HIGHWAY_MOTORWAY     => 4,
		HIGHWAY_TRUNK        => 4,
		HIGHWAY_PRIMARY      => 4,
		HIGHWAY_SECONDARY    => 4,
	),
13 => array(
		HIGHWAY_MOTORWAY     => 3,
		HIGHWAY_TRUNK        => 3,
		HIGHWAY_PRIMARY      => 3,
		HIGHWAY_SECONDARY    => 3,
		HIGHWAY_TERTIARY     => 3,
		HIGHWAY_UNCLASSIFIED => 3,
	),	
14 => array(
		HIGHWAY_MOTORWAY     => 2,
		HIGHWAY_TRUNK        => 2,
		HIGHWAY_PRIMARY      => 2,
		HIGHWAY_SECONDARY    => 2,
		HIGHWAY_TERTIARY     => 2,
		HIGHWAY_UNCLASSIFIED => 2,
	),
15 => array(
		HIGHWAY_MOTORWAY     => 2,
		HIGHWAY_TRUNK        => 2,
		HIGHWAY_PRIMARY      => 2,
		HIGHWAY_SECONDARY    => 2,
		HIGHWAY_TERTIARY     => 2,
		HIGHWAY_UNCLASSIFIED => 2,
	),
16 => array(
		HIGHWAY_MOTORWAY     => 1,
		HIGHWAY_TRUNK        => 1,
		HIGHWAY_PRIMARY      => 1,
		HIGHWAY_SECONDARY    => 1,
		HIGHWAY_TERTIARY     => 1, 
		HIGHWAY_UNCLASSIFIED => 1,	
	),
17 => array(
		HIGHWAY_MOTORWAY     => 1,
		HIGHWAY_TRUNK        => 1,
		HIGHWAY_PRIMARY      => 1,		
		HIGHWAY_SECONDARY    => 1,
		HIGHWAY_TERTIARY     => 1, 
		HIGHWAY_UNCLASSIFIED => 1,	
	),
18 => array(
		HIGHWAY_MOTORWAY     => 1,
		HIGHWAY_TRUNK        => 1,
		HIGHWAY_PRIMARY      => 1,
		HIGHWAY_PRIMARY      => 1,
		HIGHWAY_SECONDARY    => 1,
		HIGHWAY_TERTIARY     => 1, 
		HIGHWAY_UNCLASSIFIED => 1,	
	),
);


/**
 * Road name text color grade x zoom maping
 */
$ROAD_NAME_COLOR = array(
HIGHWAY_MOTORWAY     => array(14 => '#000000'),
HIGHWAY_TRUNK        => array(14 => '#000000'),
HIGHWAY_PRIMARY      => array(14 => '#000000'),
HIGHWAY_SECONDARY    => array(14 => '#000000'),
HIGHWAY_TERTIARY     => array(14 => '#000000'),
HIGHWAY_UNCLASSIFIED => array(14 => '#000000'),
HIGHWAY_SERVICE      => array(15 => '#000000'),
HIGHWAY_RESIDENTIAL  => array(15 => '#000000'),
);

/**
 * Road name text size grade x zoom maping
 */
$ROAD_NAME_SIZE = array(
HIGHWAY_MOTORWAY     => array(14 => '11.5',15 => '14',16 => '20', 18 =>'25'),
HIGHWAY_TRUNK        => array(14 => '11.5',15 => '14',16 => '20', 18 =>'25'),
HIGHWAY_PRIMARY      => array(14 => '11.5',15 => '14',16 => '20', 18 =>'25'),
HIGHWAY_SECONDARY    => array(14 => '11.5',15 => '14',16 => '19', 18 =>'24'),
HIGHWAY_TERTIARY     => array(14 => '11.5',15 => '14',16 => '18', 18 =>'23'),
HIGHWAY_UNCLASSIFIED => array(14 => '11.5',15 => '14',16 => '17', 18 =>'22'),
HIGHWAY_SERVICE      => array(15 => '11',16 => '15.5',18 => '19'),
HIGHWAY_RESIDENTIAL  => array(15 => '11',16 => '15.5',18 => '19'),
);

/**
 * Road name text halo radius grade x zoom maping
 */
$ROAD_NAME_HALO_RADIUS = array(
HIGHWAY_MOTORWAY     => array(14 => '2'),
HIGHWAY_TRUNK        => array(14 => '2'),
HIGHWAY_PRIMARY      => array(14 => '2'),
HIGHWAY_SECONDARY    => array(14 => '2'),
HIGHWAY_TERTIARY     => array(14 => '2'),
HIGHWAY_UNCLASSIFIED => array(14 => '2'),
HIGHWAY_SERVICE      => array(15 => '2'),
HIGHWAY_RESIDENTIAL  => array(15 => '2'),
);


/**
 * Road ref text color grade x zoom maping
 */
$ROAD_REF_COLOR = array(
HIGHWAY_MOTORWAY     => array(8 => '#ffffff'),
HIGHWAY_TRUNK        => array(8 => '#ffffff'),
HIGHWAY_PRIMARY      => array(8 => '#ffffff'),
HIGHWAY_SECONDARY    => array(8 => '#ffffff'),
HIGHWAY_TERTIARY     => array(8 => '#ffffff'),
HIGHWAY_UNCLASSIFIED => array(8 => '#ffffff'),
);

/**
 * Road ref text size grade x zoom maping
 */
$ROAD_REF_SIZE = array(
HIGHWAY_MOTORWAY     => array(8 => 10.5,16=>13),
HIGHWAY_TRUNK        => array(8 => 10.5,16=>13),
HIGHWAY_PRIMARY      => array(8 => 10.5,16=>13),
HIGHWAY_SECONDARY    => array(8 => 10.5,16=>13),
HIGHWAY_TERTIARY     => array(8 => 10.5,16=>13),
HIGHWAY_UNCLASSIFIED => array(8 => 10.5,16=>13),
);

$ROAD_REF_MINIMUM_DISTANCE  = array(
HIGHWAY_MOTORWAY     => array(8 => 50, 17 => 200),
HIGHWAY_TRUNK        => array(8 => 50, 17 => 200),
HIGHWAY_PRIMARY      => array(8 => 50, 17 => 200),
HIGHWAY_SECONDARY    => array(8 => 50, 17 => 200),
HIGHWAY_TERTIARY     => array(8 => 50, 17 => 200),
HIGHWAY_UNCLASSIFIED => array(8 => 50, 17 => 200),
);
/**
 * Height of the road ref shield
 */
$ROAD_REF_SHIELD_HEIGHT = array(
HIGHWAY_MOTORWAY     => array(8 => 14, 16 => 16),
HIGHWAY_TRUNK        => array(8 => 14, 16 => 16),
HIGHWAY_PRIMARY      => array(8 => 13, 16 => 15),
HIGHWAY_SECONDARY    => array(8 => 12, 16 => 14),
HIGHWAY_TERTIARY     => array(8 => 12, 16 => 14),
HIGHWAY_UNCLASSIFIED => array(8 => 12, 16 => 14),
);

/**
 * Width of the one letter in road ref shield
 */
$ROAD_REF_SHIELD_LETTER_WIDTH = array(
HIGHWAY_MOTORWAY     => array(8 =>  5, 12 => 7.0),
HIGHWAY_TRUNK        => array(8 =>  5, 12 => 7.0),
HIGHWAY_PRIMARY      => array(8 =>  5, 12 => 6.5),
HIGHWAY_SECONDARY    => array(8 =>  5, 12 => 6.5),
HIGHWAY_TERTIARY     => array(8 =>  5, 12 => 6.5),
HIGHWAY_UNCLASSIFIED => array(8 =>  5, 12 => 6.5),
);

/**
 * Width padding of the road ref shield
 */
$ROAD_REF_SHIELD_PADDING_WIDTH = $ROAD_REF_SHIELD_LETTER_WIDTH;

/**
 * Background color of the road ref shield
 */
$ROAD_REF_SHIELD_FILL = array(
HIGHWAY_MOTORWAY     => array(8 => '#1b3c88'),
HIGHWAY_TRUNK        => array(8 => '#1b3c88'),
HIGHWAY_PRIMARY      => array(8 => '#1b3c88'),
HIGHWAY_SECONDARY    => array(8 => '#1b3c88'),
HIGHWAY_TERTIARY     => array(8 => '#1b3c88'),
HIGHWAY_UNCLASSIFIED => array(8 => '#1b3c88'),
);

/**
 * Border color of the road ref shield
 */
$ROAD_REF_SHIELD_BORDER_COLOR = $ROAD_REF_COLOR;

/**
 * Border width of the road ref shield
 */
$ROAD_REF_SHIELD_BORDER_WIDTH = array(
HIGHWAY_MOTORWAY     => array(8 => 0),
HIGHWAY_TRUNK        => array(8 => 0),
HIGHWAY_PRIMARY      => array(9 => 0),
HIGHWAY_SECONDARY    => array(11 => 0),
HIGHWAY_TERTIARY     => array(13 => 0),
HIGHWAY_UNCLASSIFIED => array(13 => 0),
);

/**
 * Width of the margine of theroad ref shield
 */
$ROAD_REF_SHIELD_MARGIN = array(
HIGHWAY_MOTORWAY     => array(8 => 0),
HIGHWAY_TRUNK        => array(8 => 0),
HIGHWAY_PRIMARY      => array(9 => 0),
HIGHWAY_SECONDARY    => array(11 => 0),
HIGHWAY_TERTIARY     => array(13 => 0),
HIGHWAY_UNCLASSIFIED => array(13 => 0),
);



/**
 * Zoom -> grade -> road ref visibility/render priority maping
 */
$ROAD_INTREF_PRIORITIES = array ( 
 7 => 4,
 8 => 4,
 9 => 4,
10 => 4,
11 => 4,
12 => 4,
13 => 4,
14 => 4,
15 => 4,
16 => 4,
17 => 4,
18 => 4
);



/**
 * Road ref text color grade x zoom maping
 */
$ROAD_INTREF_COLOR = array(8 => '#ffffff');

/**
 * Road ref text size grade x zoom maping
 */
$ROAD_INTREF_SIZE = array(8 => 11,12=>14);

$ROAD_INTREF_MINIMUM_DISTANCE  = array(7 => 50, 17 => 100);

$ROAD_INTREF_SPACING  = array(7 => 100, 17 => 500);


/**
 * Height of the road ref shield
 */
$ROAD_INTREF_SHIELD_HEIGHT = array(7 => 15, 12 => 17);


/**
 * Width of the one letter in road ref shield
 */
$ROAD_INTREF_SHIELD_LETTER_WIDTH = array(7 =>  6, 12 => 7);

/**
 * Width padding of the road ref shield
 */
$ROAD_INTREF_SHIELD_PADDING_WIDTH = $ROAD_INTREF_SHIELD_LETTER_WIDTH;

/**
 * Background color of the road ref shield
 */
$ROAD_INTREF_SHIELD_FILL = array(8 => '#559944');

/**
 * Border color of the road ref shield
 */
$ROAD_INTREF_SHIELD_BORDER_COLOR = $ROAD_INTREF_COLOR;

/**
 * Border width of the road ref shield
 */
$ROAD_INTREF_SHIELD_BORDER_WIDTH = array(8 => 0);

/**
 * Width of the margine of theroad ref shield
 */
$ROAD_INTREF_SHIELD_MARGIN = array(8 => 0);


/**
 * Zoom -> grade -> access shield priorities maping
 */
$HIGHWAY_ACCESS_PRIORITIES = array (
14 => 4,
15 => 4,
16 => 4,
17 => 4,
18 => 4,
);

/**
 * highway access text size
 */
$HIGHWAY_ACCESS_SIZE = array(13 => 12);


/**
 * Minmial distance of access shield
 */
$HIGHWAY_ACCESS_MINDISTANCE = array(13=>20);


$HIGHWAY_ACCESS_DENSITY = array(
	14 =>  6,
	15 => 17,
	16 => 50,
	17 => 150,
	18 => 600,
);
