<?php

	if(is_string($content)){
		$delimiter = empty($attrs['delimiter']) ? ',' : $attrs['delimiter'];
		$content = explode($delimiter, $content);
	}
?>
<tr <?php echo bsc_attrs($attrs, 'delimiter'); ?>>
<?php foreach($content as $cell): ?>
	<?php if(stripos(trim($cell), '[bsc-cell') === false): ?>
		<td><?php echo do_shortcode($cell); ?></td>
	<?php else: ?>
		<?php echo do_shortcode($cell); ?>	
	<?php endif; ?>
<?php endforeach; ?>
</tr>