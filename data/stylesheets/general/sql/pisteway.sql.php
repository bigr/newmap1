<?php
require_once "inc/utils.php";
require_once "conf/pgis.php";
require_once "conf/sqlite.php";
require_once "conf/pisteway.conf.php";
require_once "sql/_common.sql.php";


function sql_pisteway($where = '1 = 1',$order = 'z_order') {
	global $PISTEWAY;
	$layerSql = _getLayerSql();
	$propertyWhereQuery = getPropertyWhereQuery($PISTEWAY);
	$propertyWhereQuery = str_replace("pisteway",'piste:type',$propertyWhereQuery);
	$propertyWhereQuery = str_replace("difficulty",'piste:difficulty',$propertyWhereQuery);
	$propertyWhereQuery = str_replace("grooming",'piste:grooming',$propertyWhereQuery);
return <<<EOD
    SELECT
	way,
	"piste:type" AS pisteway,
	COALESCE("piste:difficulty",'no') AS difficulty,
	"piste:grooming" AS grooming,
	name AS name,
	    $layerSql as 
	layer,
	osm_id
    FROM osm_pisteway
    WHERE
		    ($propertyWhereQuery)
	    AND ($where)
EOD;
}

function sql_pisteway_short($layer,$where = '1 = 1',$order = 'z_order') {
    return "SELECT * FROM pisteways WHERE layer = $layer";
}


function sql_pistearea($cols = '0',$where = '1 = 1',$order = 'z_order') {
	global $PISTEAREA;
	$layerSql = _getLayerSql();
	$propertyWhereQuery = getPropertyWhereQuery($PISTEAREA);
	$propertyWhereQuery = str_replace("pisteway",'piste:type',$propertyWhereQuery);
	$propertyWhereQuery = str_replace("difficulty",'piste:difficulty',$propertyWhereQuery);
	$propertyWhereQuery = str_replace("grooming",'piste:grooming',$propertyWhereQuery);
return <<<EOD
    SELECT
	way,	  
	"piste:type" AS pisteway,
	COALESCE("piste:difficulty",'no') AS difficulty,
	"piste:grooming" AS grooming,
	name AS name,
	($layerSql) AS layer,
	osm_id,
	way_area,
	$cols
    FROM osm_pistearea
    WHERE
	    	($propertyWhereQuery)
		AND ($where)
EOD;
}


function sql_pistearea_short($layer, $cols = '0',$where = '1 = 1',$order = 'z_order') {
    return "SELECT * FROM pisteareas WHERE layer = $layer ORDER BY way_area";
}

