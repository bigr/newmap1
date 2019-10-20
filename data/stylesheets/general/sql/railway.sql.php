<?php
require_once "sql/_common.sql.php";

function _getRailwayColSql() {
	return "(CASE WHEN railway='construction' THEN construction ELSE railway END)";
}

function _getRailwayGradeSql() {
	$railwayCol = _getRailwayColSql();
	
	return "
		(CASE
			WHEN $railwayCol IN ('rail','narrow_gaugue') THEN (CASE
				WHEN usage IN ('main','mainline','highspeed') THEN 1				
				WHEN usage IN ('industrial','military','tourism','Stock','yard','siding','garage','preserved') THEN 4
				WHEN service IN ('siding','spur','yeard') THEN 4
				ELSE 2
			END) 
			WHEN $railwayCol IN ('preserved','preserved_rail') THEN 4
			WHEN $railwayCol = 'light_rail' THEN 3
			WHEN $railwayCol = 'disused' THEN 5
		END)
	";
}

function sql_railway_short($layer, $cols = '0',$order = 'grade') {
    return "SELECT * FROM railways WHERE layer = $layer ORDER BY $order";
}

function sql_railway($cols = '0',$where = '1 = 1',$order = 'z_order') {
	$layerSql = _getNewLayerSql();
	$isBridgeSql = _isBridgeSql();
	$isTunnelSql = _isTunnelSql();	
	$railwayCol = _getRailwayColSql();
	$railwayGradeSql = _getRailwayGradeSql();
return <<<EOD
	SELECT
			way,
				(CASE
					WHEN $railwayCol IN ('rail','light_rail','disused','abandoned','narrow_gauge') THEN 'train'
					WHEN $railwayCol = 'tram' THEN 'tram'
					WHEN $railwayCol = 'subway' THEN 'subway'
					WHEN $railwayCol = 'funicular' THEN 'funicular'
					WHEN $railwayCol = 'monorail' THEN 'monorail'
					WHEN $railwayCol = 'platform' THEN 'platform'
					WHEN $railwayCol = 'abandoned' THEN 'abandoned'
					ELSE 'unknown'
				END) AS
			type,
				$railwayGradeSql AS				
			grade,
			railway,				
				(CASE
					WHEN $isBridgeSql THEN CAST('yes' AS text)
					ELSE CAST('no' AS text)
				END) AS 
			is_bridge,
				(CASE
					WHEN $isTunnelSql THEN CAST('yes' AS text)
					ELSE CAST('no' AS text)
				END) AS 
			is_tunnel,
				(CASE WHEN railway = 'construction' THEN CAST('yes' AS text) ELSE CAST('no' AS text) END) AS
			is_construction,
			$layerSql AS layer,
			$cols,
			usage,
			service,
			gauge,
			cutting,
			embankment,
			electrified,
			frequency,
			voltage,
			operator,
			maxspeed,
			wikipedia,
			website,
			colour,
			transport,
			public_transport,
			tram,
			name,
			surface,
			width,
			osm_id,
			ST_Length(ST_Transform(way,900913)) AS
			    way_length
		FROM osm_railway
		WHERE
				    railway IS NOT NULL AND railway<>''
			    AND ($where)
		ORDER BY ($railwayGradeSql), osm_id DESC
EOD;
}


function sql_text_railway() {
	return "SELECT * FROM railways WHERE COALESCE(name,'') <> ''";
}
