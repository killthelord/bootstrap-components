<?php

	$attrs['class'] .= ' bsc-table table';
	if($attrs['stripped'] == 'true')
		$attrs['class'] .= ' table-stripped';
	if($attrs['bordered'] == 'true')
		$attrs['class'] .= ' table-bordered';
	if($attrs['hover'] == 'true')
		$attrs['class'] .= ' table-hover';
	if($attrs['condensed'] == 'true')
		$attrs['class'] .= ' table-condensed';
		
	if(is_numeric($attrs['columns'])){
		$columns = bsc_data($attrs['columns']);		
	}
	else{
		$coldelimiter = empty($attrs['column_delimiter']) ? ',' : $attrs['column_delimiter'];
		$columns = split($coldelimiter, $attrs['columns']);	
	}
	
	$exclude = array(
		'stripped', 
		'bordered', 
		'hover', 
		'condensed', 
		'columns', 
		'caption',
		'splitter',
		'delimiter',
		'column_delimiter'
	);	
?>
<table <?php echo bsc_attrs($attrs, $exclude); ?>>
<?php if(!is_null($attrs['caption'])): ?>
	<caption><?php echo do_shortcode($attrs['caption']); ?></caption>
<?php endif; ?>
<?php if(is_array($columns)): ?>
	<thead>
		<tr>
		<?php foreach($columns as $col): ?>
			<th><?php echo do_shortcode($col); ?></th>
		<?php endforeach; ?>	
		</tr>
	</thead>
<?php endif; ?>
	<tbody>
<?php if(stripos(trim($content), '[bsc-row') !== false): ?>
	<?php echo do_shortcode($content) ?>
<?php else: ?>
	<?php 
		$rows = bsc_splitter($content, $attrs['splitter'], $attrs['delimiter']);
		foreach($rows as $row){	
	?>
	<tr>
	<?php foreach($row as $cell): ?>
		<td><?php echo do_shortcode($cell) ?></td>
	<?php endforeach; ?>
	</tr>
	<?php } ?>
<?php endif; ?>
	</tbody>
</table>