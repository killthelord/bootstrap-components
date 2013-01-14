<?php
	$attrs['class'] .= ' bsc-descriptions';
	$cls = 'bsc-descriptions-item row-fluid dl'.($attrs['horizontal'] == 'true' ? '-horizontal' : '');
	
	$content = do_shortcode($content);
	$content = bsc_splitter($content, $attrs['splitter'], $attrs['delimiter']);
?>
<div <?php echo bsc_attrs($attrs, array('content', 'horizontal')); ?>>
<?php foreach($content as $k => $v){ ?>
	<dl class="<?php echo $cls; ?>">
		<dt class="label label-info span4"><?php echo ucfirst(trim($v[0])); ?></dt>
		<dd class="content span8"><?php echo $v[1]; ?></dd>
	</dl>
<?php } ?>
</div>
