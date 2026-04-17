<a href="<?php the_permalink(); ?>" class="inner_wr h-100" title="<?php the_title();?>">
	<div class="d-block loop_title_wr f24 l12 mb40 f000"><?php the_title();?></div>
	<div class="d-flex align-items-center">
		<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"  class="mr10">
			<rect width="32" height="32" rx="16" fill="#266AF6"/>
			<path d="M9.5715 21.0004L11.0001 22.429L19.5715 13.8576L21.0001 15.2861L22.4286 13.8576L21.0001 12.429L22.4286 11.0004L21.0001 9.57185L19.5715 11.0004L18.1429 9.57185L16.7144 11.0004L18.1429 12.429L9.5715 21.0004ZM13.8572 11.0004L15.2858 9.57185L16.7144 11.0004L15.2858 12.429L13.8572 11.0004ZM13.8572 11.0004L12.4286 12.429L11.0001 11.0004L12.4286 9.57185L13.8572 11.0004ZM21.0001 18.1433L22.4286 16.7147L21.0001 15.2861L19.5715 16.7147L21.0001 18.1433ZM21.0001 18.1433L19.5715 19.5718L21.0001 21.0004L22.4286 19.5718L21.0001 18.1433Z" fill="white"/>
		</svg>
		<?php _e('Read more','bobcat');?>
	</div>
</a>