<?php
	
	$exclude = array('type','align','stacked','splitter','delimiter');
	
	$attrs['type'] = empty($attrs['type']) ? 'pills' : $attrs['type'];
	$attrs['class'] .= ' nav nav-'.$attrs['type'];
	if($attrs['stacked'] == 'true')
		$attrs['class'] .= ' nav-staked';
	if(!empty($attrs['align']))
		$attrs['class'] .= ' pull-'.$attrs['align'];
	
	$content = do_shortcode($content);
	
	$items = bsc_splitter($content, $attrs['splitter'], $attrs['delimiter']);
?>
<ul <?php echo bsc_attrs($attrs, $exclude); ?>>
<?php 
	foreach($items as $item){
		if(count($item) == 1){
			echo $item[0];
			continue;
		}
		$args['href'] = $item[1];
?>
		  <li class="<?php echo $item[2]; ?>">
		  <?php if($item[2] == 'divider') continue; ?>
		    <a <?php echo bsc_attrs($args); ?>>
		    	<?php echo $item[0] ?>
		    </a>
		  </li>
<?php } ?>
</ul>