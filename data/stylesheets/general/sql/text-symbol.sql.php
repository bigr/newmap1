<?php
require_once "inc/utils.php";
require_once "conf/pgis.php";
require_once "conf/text-symbol.conf.php";
require_once "sql/_common.sql.php";
require_once "sql/symbol.sql.php";

function sql_text_symbol_short($priority) {
	  global $RENDER_ZOOMS,$SYMBOL_DENSITY,$SYMBOL;
	  $zoom = $RENDER_ZOOMS[0];
		$count = linear($SYMBOL_DENSITY,$RENDER_ZOOMS[0]);
		$type = 0;
		$types = array();
		foreach ( $SYMBOL AS $a ) {
			 $type++;
			 if ( !empty($a['zooms'][$zoom]) && $a['zooms'][$zoom] == $priority ) {
				 $types[] = $type;
			 } 			 
		}
		
		$types = empty($types) ? 'false' : 'type IN ('.implode(',',$types).')';
    return "
			SELECT way,type,count,name FROM symbols S
			CROSS JOIN LATERAL (SELECT density AS count FROM symbol_density D ORDER BY ST_Transform(S.way,4326) <-> D.geom LIMIT 1) T
			WHERE (name IS NOT NULL AND name <> '')  AND count < $count AND $types
			ORDER BY grade DESC
    ";
}
