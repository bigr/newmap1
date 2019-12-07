<?php
    require_once "conf/text-symbol.conf.php";
?>

<?php foreach ( $RENDER_ZOOMS as $zoom ):?>
    .textSymbol[zoom = <?php echo $zoom?>] {
	<?php $i = 0; foreach ( $SYMBOL as $selector => $a ): ++$i; ?>
	    <?php if ( !empty($a['text-zooms']) && array_key_exists($zoom, $a['text-zooms']) ): ?>
		.priority<?php echo $a['text-zooms'][$zoom] ?> {
		    [type = <?php echo $i?>] {
			text-face-name: "<?php echo FONT_ITALIC_SERIF ?>";
			text-name: "[name]";		    
			text-fill: <?php echo !empty($a['text-color'])?linear($a['text-color'],$zoom):'#000000'?>;
			<?php $textSize = !empty($a['text-size'])?exponential($a['text-size'],$zoom):9; ?>
			text-size: <?php echo text_limiter($textSize) ?>;			
			
			<?php if ( !empty($a['opacity']) ): ?>
			    text-opacity: <?php echo round(linear($a['opacity'],$zoom))?>;
			<?php else: ?>
			    text-opacity: 0.7;
			<?php endif; ?>
			<?php if ( !empty($a['halo-radius']) ): ?>
			    text-halo-radius: <?php echo round(exponential($a['halo-radius'],$zoom))?>;
			<?php else: ?>
			    text-halo-radius: 5;
			<?php endif; ?>		    
			<?php if ( !empty($a['halo-color']) ): ?>
			    text-halo-fill: fadeout(<?php echo linear($a['halo-color'],$zoom)?>,<?php echo empty($a['halo-opacity'])?67:100-100*floatval(linear($a['halo-opacity'],$zoom))?>);
			<?php else: ?>
			    text-halo-fill: fadeout(rgb(255,255,255),<?php echo empty($a['halo-opacity'])?67:100-100*floatval($a['halo-opacity'])?>);
			<?php endif; ?>
			<?php if ( !empty($a['dy']) ): ?>
			    text-dy: <?php echo linear($a['dy'],$zoom)?>;
			<?php else: ?>
			    text-dy: 0;
			<?php endif; ?>
			<?php if ( !empty($a['vertical-alignment'][$zoom]) ): ?>
			    text-vertical-alignment: <?php echo $a['vertical-alignment'][$zoom]?>;
			<?php else: ?>
			    text-vertical-alignment: middle;
			<?php endif; ?>
			<?php if ( !empty($a['dx']) ): ?>
			    text-dx: <?php echo linear($a['dx'],$zoom)?>;
			<?php else: ?>
			    text-dx: <?php echo round(!empty($a['symbol-size'])?exponential($a['symbol-size'],$zoom):13)/2 + (!empty($a['halo-radius'])?$a['halo-radius']:5) + 2 ?>;
			<?php endif; ?>
			<?php if ( !empty($a['horizontal-alignment'][$zoom]) ): ?>
			    text-horizontal-alignment: <?php echo $a['horizontal-alignment'][$zoom]?>;
			<?php else: ?>
			    text-horizontal-alignment: right;
			<?php endif; ?>
			<?php if ( !empty($a['minimum-distance'][$zoom]) ): ?>
			    text-min-distance: <?php echo $a['minimum-distance'][$zoom]?>;
			<?php else: ?>
			    text-min-distance: 0;
			<?php endif; ?>
			<?php if ( !empty($a['wrap-width']) ): ?>
			    text-wrap-width: <?php echo $a['wrap-width'];?>;
			<?php else: ?>
			    text-wrap-width: <?php echo $textSize * 10 ?>;
			<?php endif; ?>
			
			text-placement-type: simple;
			text-placements: "X,N,S,E,W,NE,SE,NW,SW,<?php echo text_limiter($textSize*0.9)?>,<?php echo text_limiter($textSize*0.75)?>,<?php echo text_limiter($textSize*0.5)?>,<?php echo text_limiter($textSize*0.25)?>";

			text-min-distance: <?php echo text_limiter($textSize*1.75)?>px;
		    }
		}		
	    <?php endif; ?>
	<?php endforeach; ?>
    }		
<?php endforeach;?>

