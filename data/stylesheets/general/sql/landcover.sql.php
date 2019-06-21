<?php
require_once "inc/utils.php";
require_once "conf/pgis.php";
require_once "conf/landcover.conf.php";
require_once "sql/_common.sql.php";

function sql_landcover($cols = '0',$where = '1 = 1',$order = 'z_order') {
	global $LANDCOVER;
	$propertyWhereQuery = getPropertyWhereQuery($LANDCOVER)	;
return <<<EOD
	SELECT
		osm_id,
		way,
			COALESCE(landuse,CAST('no' AS text)) AS
		landuse,
			COALESCE("natural",CAST('no' AS text)) AS
		natural,
			COALESCE(leisure,CAST('no' AS text)) AS
		leisure,
			COALESCE(amenity,CAST('no' AS text)) AS
		amenity,
		COALESCE(place,CAST('no' AS text)) AS
			place,
		sport,
			COALESCE(power,CAST('no' AS text)) AS 
		power,
			COALESCE(tourism,CAST('no' AS text)) AS 
		tourism,
			COALESCE(historic,CAST('no' AS text)) AS 
		historic,
		COALESCE(wood,type,CAST('no' AS text)) AS wood,
		COALESCE(religion,CAST('no' AS text)) AS religion,
		name,
		way_area,
			ST_Centroid(way) AS
		centroid,
		wikipedia,
		website,
		ele,
		type,
		attribution,
		species,
		operator,
		$cols
	FROM osm_landcover
	WHERE
				($propertyWhereQuery)
			AND building IS NULL
			AND ($where)	
	ORDER BY way_area DESC
EOD;
}

function sql_landcover_short($cols = '0',$where = '1 = 1',$order = 'z_order') {
	return 'SELECT * FROM landcovers ORDER BY way_area DESC';
}

function sql_landcover_line($cols = '0',$where = '1 = 1',$order = 'z_order') {
	global $LANDCOVER_LINE;
	$propertyWhereQuery = getPropertyWhereQuery($LANDCOVER_LINE);
	return <<<EOD
	SELECT
		osm_id,
		way,			
			COALESCE("natural",CAST('no' AS text)) AS
		natural,		
			COALESCE(wood,type,CAST('no' AS text)) AS 
		wood,
		name,
		wikipedia,
		website,
	$cols
	FROM osm_landcover_line
	WHERE
				($propertyWhereQuery)			
			AND ($where)	
EOD;
}

function sql_landcover_line_short($cols = '0',$where = '1 = 1',$order = 'z_order') {
	return 'SELECT * FROM landcover_lines';
}

function sql_landcover_point($cols = '0',$where = '1 = 1',$order = 'z_order') {
	global $LANDCOVER_POINT;
	$propertyWhereQuery = getPropertyWhereQuery($LANDCOVER_POINT)	;
	return <<<EOD
	SELECT
		osm_id,
		way,	
			COALESCE("natural",CAST('no' AS text)) AS
		natural,					
			COALESCE(wood,type,CAST('no' AS text)) AS
		wood,
		name,	
		species,
		genus,
		taxon,
		denotation,
		attribution,	
		wikipedia,
		website,
	$cols
	FROM osm_landcover_point
	WHERE
				($propertyWhereQuery)			
			AND ($where)	
EOD;
}

function sql_landcover_point_short($cols = '0',$where = '1 = 1',$order = 'z_order') {
	return 'SELECT * FROM landcover_points';
}

function sql_residentialcover_hack($cols = '0',$where = '1 = 1',$order = 'z_order') {	
return <<<EOD
	SELECT
		way,
		$cols
	FROM highways
	WHERE grade = 7	
EOD;
}

function sql_placescover($cols = '0',$where = '1 = 1') {    
return "   
    SELECT way,grade FROM places WHERE type='urb'
";
}
