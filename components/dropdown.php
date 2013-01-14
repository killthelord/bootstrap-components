<?php
	$exclude = array(
		'tag', 'position', 'delimiter', 'splitter', 'align', 'label', 'href', 'dropup'
	);
	$attrs['tag'] = empty($attrs['tag']) ? 'li' : $attrs['tag'];
	$btn_tag = 'a';

	$attrs['class'] .= ' dropdown';	
	
	if($attrs['dropup'])
		$attrs['class'] .= ' dropup';
	$buffer = '<'.$attrs['tag'].' '.bsc_attrs($attrs, $exclude).'>';
	$attrs['class'] = '';
	
	$buffer .= '<'.$btn_tag.' href="'.$attrs['href'].'" class="dropdown-toggle" data-toggle="dropdown">'.$attrs['label'].' <b class="caret"></b></'.$btn_tag.'>';
	$buffer .= bsc('menu', $attrs, $content);
	$buffer .= '</'.$attrs['tag'].'>';
	echo $buffer;
?>
