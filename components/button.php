<?php

	$exclude = array('size','state','icon','icon_white','block','split', 'caret', 'dropup');

	$tag = empty($attrs['href']) ? 'button' : 'a';
	$attrs['class'] .= ' btn';
	
	if(!empty($attrs['size']))
		$attrs['class'] .= ' btn-'.$attrs['size'];
	
	if(!empty($attrs['state']))
		$attrs['class'] .= ' btn-'.$attrs['state'];
	
	if($attrs['block'] == 'true')
		$attrs['class'] .= ' btn-block';
		
	if($attrs['dropup'] == 'true')
		$attrs['class'] .= ' dropup';
	
	if($attrs['split'] == 'true'){
		$group = true;
		$split = true;
	}
		
	if(($pos = stripos($content, '[bsc-menu')) !== false){
		$menu = substr($content, $pos);
		$content = substr($content, 0, $pos);
		$group = true;
	}
	
	// start group
	if($group)
		echo '<div class="btn-group">';

	if($menu && !$split){
		$attrs['class'] .= ' dropdown-toggle';
		$attrs['data-toggle'] = 'dropdown';
		$caret = ' <span class="caret"></span>';
	}
	
	// start button
	echo "<{$tag} ".bsc_attrs($attrs, $exclude).">";
	if(!empty($attrs['icon'])){
		echo "<i class='icon-{$attrs["icon"]}";
		if($attrs['icon_white'] == 'true')
			echo ' icon-white';
		echo "'></i> ";
	}
	echo $content;
	if($menu && !$split)
		echo $caret;
	
	echo "</{$tag}>"; // end button
	
	if($group){
	
		// print split
		if($split){ 
			if(!empty($attrs['size']))
				$size .= ' btn-'.$attrs['size'];
?>
		<button class="btn dropdown-toggle <?php echo $size; ?>" data-toggle="dropdown">
			<span class="caret"></span>
		</button>
<?php 
		}
		
		//print menu
		if($menu)
			echo do_shortcode($menu);
	
		echo "</div>"; // close group
	} 
?>