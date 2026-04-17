<?php
	/** @params
	 * $videosrc string - url to video
	 * $class string - 'youtube_video' (default) or 'local_video'
	 * $image array - background image or youtube
	 * $modal = show in modal (empty by default)
	 * */
	function get_the_video($videosrc = '', $image = '', $player ='youtube_video', $modal=''): string {
		$html       = '';
		$embed_link = '';
		if($videosrc){
			if($player == 'local_video') {
				if(!$image){
					$image = get_template_directory_uri() . '/images/noimage.jpg';
				}
				$embed_link = $videosrc;
			}else{
				if ( ! $image ) {
					if(str_contains( $videosrc, 'vimeo' ) ) {
						$path       = parse_url($videosrc, PHP_URL_PATH);
						$id         = basename($path);
						$json_url   = "https://vimeo.com/api/oembed.json?url=http%3A//vimeo.com/$id";
						$json       = file_get_contents($json_url);
						$data       = json_decode($json, TRUE);
						$image      = [
							'url'   => $data["thumbnail_url"],
							'sizes' => [
								'large'     => $data["thumbnail_url"],
								'thumb_420' => $data["thumbnail_url"]
							],
							'width' => '600',
							'height'=> '600',
						];
					}else{
						preg_match('/src="(.+?)"/', $videosrc, $matches_url );
						$src = $matches_url[1];
						preg_match('/embed(.*?)?feature/', $src, $matches_id );
						$id = $matches_id[1];
						$id = str_replace( str_split( '?/' ), '', $id );
						$image = [
							'url'    => "https://img.youtube.com/vi/" . $id . "/maxresdefault.jpg",
							'sizes'  => [
								'large'     => 'https://img.youtube.com/vi/' . $id . '/sddefault.jpg',
								'thumb_420' => 'https://img.youtube.com/vi/' . $id . '/0.jpg'
							],
							'width'  => '600',
							'height' => '600',
						];
					}
				}
				if ( preg_match('/src="(.+?)"/', $videosrc, $matches) ) {
					$embed_link = $matches[1];
				}
			}
			$html = get_the_picture($image, 'cover_image lazy') . '<div class="video_bt '.$modal.'" data-src="'.$embed_link.'"></div>';
			if(!$modal){
				$html .= '<div class="iframe_wr h-100 zindex10"><iframe class="embed-responsive-item" src="" title="'.__('video','bobcat').'"></iframe></div>';
			}
		}
		return $html;
	}
	function the_video($videosrc = '', $image = '', $player ='youtube_video', $modal=''): void {
		echo get_the_video($videosrc, $image, $player, $modal);
	}