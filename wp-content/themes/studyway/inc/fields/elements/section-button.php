<?php
	$button = $args['button_args'];
	$class  = "button ". (!empty($button['button_class']) ? $button['button_class'] : '') .' '. (!empty($button['button_style']['value']) ? $button['button_style']['value'] : '');
?>
<a
	href    = "<?php echo $button['button_url'] ?? '#';?>"
	title   = "<?php echo $button['button_title'] ?? ''; ?>"
	class   = "<?php echo $class; ?> slide-in-left"
	<?php echo $button['button_attributes'] ?? '';?>
>
	<?php echo $button['button_title'] ?? ''; ?>
</a>