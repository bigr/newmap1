<?php
	require_once "inc/patterns.php";
	require_once "conf/landcover.conf.php";
	require_once "conf/waters.conf.php";
?>



<?php foreach ( $RENDER_ZOOMS as $zoom ):?>
	.coastline {
	    polygon-fill: <?php echo linear($_WATER_COLOR,$zoom)?>;
	}

	.landcover[zoom = <?php echo $zoom?>][way_area >= <?php echo pixelareas($LANDCOVER_MINIMAL_AREA,$zoom)?>] {
		<?php foreach ( $LANDCOVER AS $selector => $a ): ?>
		    <?php if ( !empty($a['zooms']) &&  in_array($zoom,$a['zooms']) ):?>
			<?php echo $selector?> {
			    ::level<?php echo $a['level']?> {					
				polygon-fill: <?php echo linear($a['color'],$zoom)?>;
				polygon-smooth: <?php echo !empty($a['smooth']) ? $a['smooth'] : 0  ?>;
			    }
			}
		    <?php endif;?>
		    <?php if ( !empty($a['pattern-zooms']) && in_array($zoom,$a['pattern-zooms']) ): ?>
			<?php echo $selector?> {
			    ::level<?php echo $a['level']?> {
				<?php if ( !empty($a['pattern-file']) ): ?>
				    polygon-pattern-file: url('../../general/pattern/~<?php echo $a['pattern-file']?>-<?php echo $zoom?>.png');
				<?php else: ?>
				    polygon-pattern-file: url('<?php echo
					    getPatternFile($a['pattern'],
						    exponential($a['pattern-size'],$zoom),
						    linear($a['pattern-rotation'],$zoom),
						    linear($a['pattern-opacity'],$zoom),
						    linear($a['pattern-color'],$zoom),
						    exponential($a['pattern-stroke'],$zoom)
					    )
				    ?>');
				<?php endif; ?>
				polygon-pattern-smooth: <?php echo !empty($a['smooth']) ? $a['smooth'] : 0  ?>;
			    }
			}
		    <?php endif; ?>
		<?php endforeach; ?>
	}	
	.landcover_line[zoom = <?php echo $zoom?>] {
	<?php foreach ( $LANDCOVER_LINE AS $selector => $a ): ?>	    
	    <?php if ( !empty($a['zooms']) && in_array($zoom,$a['zooms']) ): ?>
		<?php echo $selector?> {
		    <?php if ( !empty($a['pattern-file']) ): ?>			
			line-pattern-file: url('../../general/pattern/~<?php echo $a['pattern-file']?>-<?php echo $zoom?>.png');
		    <?php endif; ?>		    
		    line-color: <?php echo empty($a['color']) ? '#000000' : linear($a['color'],$zoom)?>;
		    line-width: <?php echo empty($a['width']) ? 1.0 : linear($a['width'],$zoom)?>;
		    line-opacity: <?php echo empty($a['opacity']) ? 1.0 : linear($a['opacity'],$zoom)?>;		    
         }
	    <?php endif; ?>
	<?php endforeach; ?>
    }
    
    .landcover_point[zoom = <?php echo $zoom?>] {
	<?php foreach ( $LANDCOVER_POINT AS $selector => $a ): ?>	    
	    <?php if ( !empty($a['zooms']) && in_array($zoom,$a['zooms']) ): ?>
		<?php echo $selector?> {
		    <?php if ( !empty($a['symbol-file']) ): ?>
                         point-file: url('../../general/symbol/~<?php echo $a['symbol-file']?>-<?php echo $zoom?>-<?php echo empty($a['symbol-color']) ? '#000000' : linear($a['symbol-color'],$zoom)?>.png');			 
		    <?php endif; ?>
                }
	    <?php endif; ?>
	<?php endforeach; ?>
    }    
	
	<?php if ( in_array($zoom, $RESIDENTIALCOVER_HACK_ZOOMS) ):?>
	.residentialcoverhack[zoom = <?php echo $zoom?>] {
	    line-color: <?php echo linear($RESIDENTIALCOVER_HACK_COLOR,$zoom)?>;
	    line-width: <?php echo meterlengthes($RESIDENTIALCOVER_HACK_WIDTH,$zoom)?>;
	}
	<?php endif; ?>
	
	.placescover[zoom = <?php echo $zoom?>] {
	    <?php foreach ( range(0,40) as $grade ):?> 				    		
		[grade = <?php echo $grade?>] {		    
		    <?php if ( in_array(urb_priorities($zoom,$grade),array(false,4)) ):?>
			<?php if ( $zoom > 8 ): ?>
			marker-fill: #ffffff;
			marker-line-color: #ffffff;
			marker-line-width: 0;
			marker-placement: point;
			marker-width: 10;
			marker-height: 10;
			marker-allow-overlap: true;			
			<?php endif; ?>
		    <?php else: ?>
			point-file: url('../../general/pattern/~place-<?php echo $zoom?>-<?php echo $grade?>.png');
		    <?php endif; ?>
		}		
	    <?php endforeach; ?>
	}
	
<?php endforeach;?>

