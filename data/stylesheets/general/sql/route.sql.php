<?php
require_once "sql/_common.sql.php";
require_once "sql/highway.sql.php";
require_once "conf/route.conf.php";

function _getHikingRouteColorSql($col) {
    return "
	(CASE
	    WHEN $col LIKE 'red:%' THEN 'red'
	    WHEN $col LIKE 'blue:%' THEN 'blue'
	    WHEN $col LIKE 'green:%' THEN 'green'
	    WHEN $col LIKE 'yellow:%' THEN 'yellow'
	    ELSE 'unknown'
	END)
    ";
}

function _getHikingGradeSql($col) {
    return "
	(CASE
	    WHEN $col LIKE '%_bar' THEN 0
	    WHEN $col LIKE '%_corner' THEN 1
	    WHEN $col LIKE '%_backslash' THEN 1
	    WHEN $col LIKE '%_L' THEN 2
	    WHEN $col LIKE '%_triangle' THEN 2
	    WHEN $col LIKE '%_bowl' THEN 2
	    WHEN $col LIKE '%_turned_T' THEN 2
	    ELSE 3
	END)
    ";
}

function _getBicycleGradeSql($col) {
    return "
	(CASE
	    WHEN $col IN ('icn','iwn') THEN 0
	    WHEN $col IN ('ncn','nwn') THEN 1
	    WHEN $col IN ('rcn','rwn') THEN 2
	    WHEN $col IN ('lcn','lwn') THEN 3	    
	    ELSE 4
	END)
    ";
}

function _getHikingRouteColumn($col,$offset) {
    global $ROUTE_BICYCLE_GRADES;
    global $RENDER_ZOOMS;
    global $ROUTE_MAX_COUNT;
    
    
    
    $bicycleGrade = _getBicycleGradeSql('network0');
    
    $zoom = end($RENDER_ZOOMS);
    $maxBicycleGrade = end($ROUTE_BICYCLE_GRADES[$zoom]);
    
    if ( empty($maxBicycleGrade) )
	$maxBicycleGrade = 1000;
    
    
    $tmp = array();
    foreach ( range(2,$ROUTE_MAX_COUNT) as $i ) {
	if ( $offset+$i-1 > $ROUTE_MAX_COUNT ) break;
	
	if ( $offset+$i <= $ROUTE_MAX_COUNT ) {
	    $tmp2 = "
		(CASE
		    WHEN route0 NOT IN ('bicycle','mtb') OR $bicycleGrade > $maxBicycleGrade THEN $col".($offset+$i)."
		    ELSE $col".($offset+$i-1)."
		END)
	    ";
	}
	else {
	    $tmp2 = "
		(CASE
		    WHEN route0 NOT IN ('bicycle','mtb') OR $bicycleGrade > $maxBicycleGrade THEN NULL
		    ELSE $col".($offset+$i-1)."
		END)
	    ";
	}
	$tmp[] = "\t\tWHEN route$i IN ('foot','hiking') THEN $tmp2";	
    }
    $tmp = implode("\n",$tmp);
    if ( $offset < $ROUTE_MAX_COUNT ) {
	$tmp2 = "
	    (CASE
		WHEN route0 NOT IN ('bicycle','mtb') OR $bicycleGrade > $maxBicycleGrade THEN $col".($offset+1)."
		ELSE {$col}{$offset}
	    END)
	";
    }
    else {
	$tmp2 = "
	    (CASE
		WHEN route0 NOT IN ('bicycle','mtb') OR $bicycleGrade > $maxBicycleGrade THEN NULL
		ELSE {$col}{$offset}
	    END)
	";
    }
    
    
    
    return " 
	(CASE
	    WHEN route0 IN ('foot','hiking') THEN {$col}{$offset}
	    WHEN route1 IN ('foot','hiking') THEN $tmp2
	    $tmp
	END)
    ";
}


function sql_route_hiking($offset, $cols = '0',$where = '1 = 1') {
    $highwayGradeSql = _getHighwayGradeSql(true);    
    $highwayGradeSql = str_replace("smoothness","T1.smoothness",$highwayGradeSql);
    $highwayGradeSql = str_replace("surface","T1.surface",$highwayGradeSql);
    $highwayGradeSql = str_replace("highway","T1.highway",$highwayGradeSql);
    $highwayGradeSql = str_replace("tracktype","T1.tracktype",$highwayGradeSql);

return <<<EOD
    SELECT
        R.way,
        $highwayGradeSql AS highway_grade,
        T1.highway,
		1 AS offsetside,
		(CASE
             WHEN route IN ('bicycle','mtb') THEN 'violet'
             WHEN route IN ('ski') THEN 'turquoise'
             WHEN COALESCE(kct_blue,'') <> '' THEN 'blue'
             WHEN COALESCE(kct_green,'') <> '' THEN 'green'
             WHEN COALESCE(kct_yellow,'') <> '' THEN 'yellow'
             WHEN COALESCE(kct_red,'') <> '' THEN 'red'
             WHEN "osmc:symbol" LIKE 'red:%' THEN 'red'
             WHEN "osmc:symbol" LIKE 'blue:%' THEN 'blue'
             WHEN "osmc:symbol" LIKE 'green:%' THEN 'green'
             WHEN "osmc:symbol" LIKE 'yellow:%' THEN 'yellow'
             WHEN "osmc:symbol" LIKE 'black:%' THEN 'black'
             WHEN "osmc:symbol" LIKE 'white:%' THEN 'white'
             WHEN "osmc:symbol" LIKE 'brown:%' THEN 'brown'
             WHEN "osmc:symbol" LIKE 'orange:%' THEN 'orange'
             WHEN "osmc:symbol" LIKE 'purple:%' THEN 'purple'
             WHEN COALESCE(colour,color,'') <> '' THEN COALESCE(colour,color)
             ELSE 'red'
        END) AS color,
		R.sac_scale,
		R.route,
		20 as density,
		R.network
        FROM osm_route R
        LEFT JOIN osm_highway T1 ON T1.osm_id = R.member_id
        WHERE (SELECT Count(*) FROM osm_route R2 WHERE R2.member_id = R.member_id AND R.osm_id < R2.osm_id) = $offset
            AND R.route IN ('foot','hiking')
EOD;

/*
return <<<EOD
	SELECT 
		T1.way,
		    $highwayGradeSql AS
		highway_grade,
		T1.highway,
		T1.offsetside,		   
		T1.color,
		T1.sac_scale,
		T1.route,
		$cols
	FROM routes2 T1
	LEFT JOIN routes2 T2 ON T1.osm_id = T2.osm_id AND T2."offset" <  T1."offset" AND T1."color" <> T2."color" AND (T2.route <> 'bicycle' OR T2.network <> '')
	WHERE
		T1.route IN ('foot','hiking')
	    AND ($where)
	GROUP BY T1."way",T1."osm_id",T1."offsetside",T1."color",T1."sac_scale",T1."route",T1."highway",T1."tracktype"
	HAVING count(DISTINCT T2.offset)+1 = $offset
EOD;
*/
}


function sql_route_bicycle($offset,$cols = '0',$where = '1 = 1') {	
    $highwayGradeSql = _getHighwayGradeSql(true);    
    $highwayGradeSql = str_replace("smoothness","T1.smoothness",$highwayGradeSql);
    $highwayGradeSql = str_replace("surface","T1.surface",$highwayGradeSql);
    $highwayGradeSql = str_replace("highway","T1.highway",$highwayGradeSql);
    $highwayGradeSql = str_replace("tracktype","T1.tracktype",$highwayGradeSql);
return <<<EOD
    SELECT
        R.way,
        $highwayGradeSql AS highway_grade,
        T1.highway,
		1 AS offsetside,
		R."mtb:scale",
		R.route,
		20 as density,
		R.network,
		'no' AS oneway
        FROM osm_route R
        LEFT JOIN osm_highway T1 ON T1.osm_id = R.member_id
        WHERE (SELECT Count(*) FROM osm_route R2 WHERE R2.member_id = R.member_id AND R.osm_id < R2.osm_id) = $offset
            AND R.route IN ('bicycle','mtb')
EOD;

/*
return <<<EOD
	SELECT 
		T1.way,
		    $highwayGradeSql AS
		highway_grade,
		T1.highway,
		T1.offsetside,
		T1."mtb:scale",
		T1.route,
		T1.density,
		T1.network,
		(CASE 
		    WHEN T1.oneway IN ('false','0','no') THEN 'no'
		    WHEN T1.oneway IN ('true','1','yes') THEN 'yes'
		    ELSE COALESCE(T1.oneway,CAST('no' AS text))
		END) AS oneway,		
		$cols
	FROM osm_routes T1
	LEFT JOIN routes2 T2 ON T1.osm_id = T2.osm_id AND T2."offset" <  T1."offset" AND T1."color" <> T2."color" AND (T2.route <> 'bicycle' OR T2.network <> '')
	WHERE
		T1.route IN ('bicycle','mtb')	   
	    AND ($where)
	GROUP BY T1."way",T1."osm_id",T1."offsetside",T1."mtb:scale",T1."route",T1."highway",T1."tracktype",T1.density,T1.network,T1.oneway
	HAVING count(DISTINCT T2.offset)+1 = $offset
EOD;
*/
}

function sql_route_ski($offset,$cols = '0',$where = '1 = 1') {	
    $highwayGradeSql = _getHighwayGradeSql(true); 
    $highwayGradeSql = str_replace("smoothness","T1.smoothness",$highwayGradeSql);
    $highwayGradeSql = str_replace("surface","T1.surface",$highwayGradeSql);
    $highwayGradeSql = str_replace("highway","T1.highway",$highwayGradeSql);
    $highwayGradeSql = str_replace("tracktype","T1.tracktype",$highwayGradeSql);   

return <<<EOD
    SELECT
        R.way,
        $highwayGradeSql AS highway_grade,
        T1.highway,
		1 AS offsetside,
		R.route
        FROM osm_route R
        LEFT JOIN osm_highway T1 ON T1.osm_id = R.member_id
        WHERE (SELECT Count(*) FROM osm_route R2 WHERE R2.member_id = R.member_id AND R.osm_id < R2.osm_id) = $offset
            AND R.route IN ('ski')
EOD;

/*
return <<<EOD
	SELECT 
		T1.way,
		    $highwayGradeSql AS
		highway_grade,
		T1.highway,
		T1.offsetside,
		T1.route,	  
		$cols
	FROM routes2 T1
	LEFT JOIN routes2 T2 ON T1.osm_id = T2.osm_id AND T2."offset" <  T1."offset" AND T1."color" <> T2."color" AND (T2.route <> 'bicycle' OR T2.network <> '')
	WHERE
		T1.route IN ('ski')	    
	    AND ($where)
	GROUP BY T1."way",T1."osm_id",T1."offsetside",T1."route",T1."highway",T1."tracktype"
	HAVING count(DISTINCT T2.offset)+1 = $offset
EOD;
*/
}
