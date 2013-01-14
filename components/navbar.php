<?php

	$exclude = array('title','splitter','delimiter', 'position', 'title_right', 'inverse', 'href');
	$id = 'navbar_'.rand();
	$attrs['class'] .= ' bsc-navbar navbar navbar-'.$attrs['position'];	
	if($attrs['inverse'] == 'true'){
		$attrs['class'] .= ' navbar-inverse';
	}

?>

<div <?php echo bsc_attrs($attrs, $exclude); ?>>
  <div class="navbar-inner">
    <div class="container">
 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".<?php echo $id; ?>">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
 	<?php if($attrs['title_right'] != 'true'): ?>
      <a class="brand" href="<?php echo $attrs['href']; ?>"><?php echo $attrs['title']; ?></a>
 	<?php endif; ?>
 	
      <div class="<?php echo $id; ?> nav-collapse">
        <?php echo do_shortcode($content); ?>
      </div>
      
 	<?php if($attrs['title_right'] == 'true'): ?>
      <a class="brand" href="#"><?php echo $attrs['title']; ?></a>
 	<?php endif; ?>
 
    </div>
  </div>
</div>