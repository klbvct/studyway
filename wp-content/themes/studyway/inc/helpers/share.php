<?php function social_sharing(): void {?>
	<?php
	$share_url = urlencode(get_permalink());
	$share_title = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
	?>
	<div class="post_share_wr social_share_wr d-flex flex-wrap align-items-center">
		<a href="https://www.facebook.com/share.php?u=<?php echo $share_url ?>&title=<?php echo $share_title;?>" rel="noopener nofollow" target="_blank" class="facebook mes_item" title="<?php _e('share in facebook','bobcat'); ?>">
			<i class="icon-facebook"></i>
		</a>
		<a href="tg://msg_url?url=<?php echo $share_url;?>" rel="noopener nofollow" class="telegram mes_item ml15" target="_blank" title="<?php _e('share in telegram','bobcat'); ?>">
			<i class="icon-paper-plane-empty"></i>
		</a>
	</div>
<?php }