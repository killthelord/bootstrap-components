<?php

	$exclude = array('type','align','splitter','delimiter', 'position');
	
	$attrs['position'] = empty($attrs['position']) ? 'top' : $attrs['position'];
	$attrs['class'] .= ' bsc-tab tabbable tabs-'.$attrs['position'];	
	
	$attrs['type'] = empty($attrs['type']) ? 'tabs' : $attrs['type'];
	$tab['class'] .= ' nav nav-'.$attrs['type'];
	if(!empty($attrs['align']))
		$tab['class'] .= ' pull-'.$attrs['align'];
	
	$content = do_shortcode($content);

	$items = bsc_splitter($content, $attrs['splitter'], $attrs['delimiter']);

	$tab_result = '';
  	foreach($items as $i => $item){
		if(count($item) == 1){
			$tab_result .= $item[0];
			continue;
		}	
		
		$items[$i]['id'] = 'tab'.rand();

		if(strpos($items[$i][2], 'link') !== false){
			$items[$i]['args']['href'] = $items[$i][1];
		}
		else{
			$items[$i]['args']['data-toggle'] = 'tab';
			$items[$i]['args']['href'] = '#'.$items[$i]['id'];
		}
		
		$tab_result .= '<li class="'.$items[$i][2].'">';
    	$tab_result .= "<a ".bsc_attrs($items[$i]['args']).">";
    	$tab_result .= trim($items[$i][0]);
    	if($dropdown) $tab_result .= '<b class="caret"></b>';
		$tab_result .= "</a>";
		$tab_result .= $items[$i]['dropdown'];
		$tab_result .= "</li>";
  	}
	
?>

<div <?php echo bsc_attrs($attrs, $exclude); ?>> 

<?php if($attrs['position'] != 'below'): ?>
  <ul <?php echo bsc_attrs($tab); ?>>
  <?php echo $tab_result; ?>
  </ul>
<?php endif; ?>

  <div class="tab-content">
  <?php 
  	foreach($items as $item){
  		if($item['dropdown']) continue;
  ?>
    <div class="tab-pane <?php echo $item[2] ?>" id="<?php echo $item['id']; ?>">
      <p><?php echo $item[1]; ?></p>
    </div>
  <?php 
  	} 
  ?>
  </div>
  
<?php if($attrs['position'] == 'below'): ?>
  <ul <?php echo bsc_attrs($tab); ?>>
  <?php echo $tab_result; ?>
  </ul>
<?php endif; ?>
</div>