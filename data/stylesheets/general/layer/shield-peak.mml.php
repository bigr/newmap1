<?php
	require_once "sql/shield-peak.sql.php";
?>
<?php if ( $TILE ): ?>	
{
	"id": "shieldPeak-priority<?php echo $priority?>",
	"name": "shieldPeak-priority<?php echo $priority?>",
	"class": "shieldPeak priority<?php echo $priority?>",
	"srs": "<?php echo SRS900913?>",
	<?php echo ds_pgis(sql_shieldPeak_short(),'way',true);?>
}
<?php endif; ?>
