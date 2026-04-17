<?php get_header(); ?>
<div class="container pt90 pb90" style="height: 500px">
	<div class="row align-items-center" style="height: 500px">
		<div class="col-12 text-center">
			<div class="f190 f700">404</div>
			<div class="mb20 ">
				<?php _e('Ой, здається, ви потрапили не туди','bobcat');?> 🙂
			</div>
			<div class="secondary_color">
				<?php _e('Не хвилюйтесь! Просто поверніться','bobcat');?>
				<a href="<?php echo get_home_url(); ?>" class="" title="<?php _e('на головну сторінку','bobcat');?>"><?php _e('на головну сторінку','bobcat');?></a>
			</div>
		</div>
	</div>
</div>
<?php get_footer();