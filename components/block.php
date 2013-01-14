<?php
	$header = true;
	$attrs['class'] .= ' bsc-block row-fluid';
	if(!empty($attrs['border']))
		$attrs['class'] .= ' bsc-block-'.$attrs['border'];
	if($attrs['fit'] == 'true')
		$attrs['class'] .= ' bsc-block-fit';
	
	$content = do_shortcode($content);
	
	if(empty($attrs['title'])){
		$header = false;
	}
	else if(($custom_header = bsc_data($attrs['title']))){
		$header = false;
	}
		
	if(!$header && !$custom_header && $attrs['fit'] != 'true') 
		$attrs['class'] .= ' bsc-block-no-header';
?>
<div <?php echo bsc_attrs($attrs, array('border', 'fit', 'title')); ?>>
<?php if($header):?>
	<div class="bsc-block-header navbar">
	  	<div class="navbar-inner">
	    	<a class="brand" href="#"><?php echo $attrs['title']; ?></a>
	    	<ul class="nav"></ul>
	  	</div>
	</div>
<?php elseif($custom_header): ?>
	<?php echo $custom_header; ?>
<?php endif; ?>

	<div class="bsc-block-content">
		<?php echo $content; ?>
	</div>
</div>