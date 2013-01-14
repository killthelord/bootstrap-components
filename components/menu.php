<?php

	$exclude = array('position', 'delimiter', 'splitter', 'tag');
	
	$attrs['class'] .= ' bsc-menu dropdown-menu';
	$attrs['role'] = 'menu';
	$attrs['aria-labelledby'] = 'dropdownMenu';
	
	if(!empty($attrs['align']))
		$attrs['class'] .= ' pull-'.$attrs['align'];
?>
<ul <?php echo bsc_attrs($attrs, $exclude) ?>>
<?php 
	if(stripos($content, '[bsc-menuitem') === 0){
		echo do_shortcode($content);
	}
	else{
		$items = bsc_splitter($content, $attrs['splitter'], $attrs['delimiter']);
		foreach($items as $i){
			if(trim($i[0]) == 'divider'){
				echo '<li class="divider"></li>';
				continue;
			}
			echo "<li><a tabindex='-1' href='{$i[0]}'>{$i[1]}</a></li>";
		}
	}
?>
</ul>