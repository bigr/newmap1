<?php
    require_once "conf/aeroway.conf.php";
    require_once "conf/landcover.conf.php";
?>

<?php foreach ( $RENDER_ZOOMS as $zoom ):?>
    .aeroway[zoom = <?php echo $zoom?>] {
	<?php foreach ( $AEROWAY AS $selector => $a ): ?>	    
	    <?php if ( !empty($a['zooms']) && in_array($zoom,$a['zooms']) ): ?>
		<?php echo $selector?> {
		    <?php if ( !empty($a['pattern-file']) ): ?>			
			line-pattern-file: url('/pattern/~<?php echo $a['pattern-file']?>-<?php echo $zoom?>.png');
		    <?php endif; ?>		    
		    line-color: <?php echo empty($a['color']) ? '#000000' : linear($a['color'],$zoom)?>;
		    line-width: <?php echo empty($a['width']) ? 1.0 : linear($a['width'],$zoom)?>;
		    line-opacity: <?php echo empty($a['opacity']) ? 1.0 : linear($a['opacity'],$zoom)?>;		    
        }
	    <?php endif; ?>
	<?php endforeach; ?>
    }
    .aeroarea[zoom = <?php echo $zoom;?>][way_area >= <?php echo pixelareas($LANDCOVER_MINIMAL_AREA,$zoom)?>] {
		<?php foreach ( $AEROAREA AS $selector => $a ): ?>
		    <?php if ( !empty($a['zooms']) &&  in_array($zoom,$a['zooms']) ):?>							
			    polygon-fill: <?php echo linear($a['color'],$zoom)?>;			    			
		    <?php endif;?>
		    <?php if ( !empty($a['pattern-zooms']) && in_array($zoom,$a['pattern-zooms']) ): ?>			
			    <?php if ( !empty($a['pattern-file']) ): ?>
				polygon-pattern-file: url('/pattern/~<?php echo $a['pattern-file']?>-<?php echo $zoom?>.png');
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
		    <?php endif; ?>
		<?php endforeach; ?>
	}
<?php endforeach;?>

