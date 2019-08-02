<?php
    require_once "conf/aerialway.conf.php";
?>

<?php foreach ( $RENDER_ZOOMS as $zoom ):?>
    .aerialway[zoom = <?php echo $zoom?>] {
	<?php foreach ( $AERIALWAY AS $selector => $a ): ?>	    
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
    .aerialwaypoint[zoom = <?php echo $zoom?>] {
	<?php foreach ( $AERIALWAYPOINT AS $selector => $a ): ?>	
	    <?php if ( !empty($a['zooms']) && in_array($zoom,$a['zooms']) ): ?>
		<?php echo $selector?> {
		    <?php if ( !empty($a['point-file']) ): ?>			
			point-file: url('/pattern/~<?php echo $a['point-file']?>-<?php echo $zoom?>.png');
		    <?php endif; ?>
		}
	    <?php endif; ?>
	<?php endforeach; ?>
    }
<?php endforeach;?>

