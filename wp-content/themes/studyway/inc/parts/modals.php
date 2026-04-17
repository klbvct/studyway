<?php
	/**
	 * Renders a modal layout with the given id, title, and content.
	 *
	 * @param string $id      The ID attribute of the modal.
	 * @param string $title   The title of the modal.
	 * @param string $content The content of the modal body.
	 * @return string The HTML representation of the modal layout.
	 */
	function the_modal_layout($id = '', $title = '', $content = ''){
		$picture = get_the_picture([
			'url'           => get_template_directory_uri().'/images/modal_bg.jpg',
			'sizes'         => [
				'large'     => get_template_directory_uri().'/images/modal_bg_320.jpg',
				'thumb_420' => get_template_directory_uri().'/images/modal_bg_320.jpg',
			],
			'width'         => '1201',
			'height'        => '1201',
		], 'lazy cover_image');
		if($id == 'thankyou'){
			return '<div class="modal fade" id="'. $id .'" tabindex="-1" role="dialog" aria-labelledby="ModalCenterLongTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close f20" data-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="text-center mb30 mt50">
								'.get_the_picture( [ 'url' => get_template_directory_uri().'/images/ico_hands.png', 'width' => '60', 'height' => '44', ], 'lazy').'
							</div>
							<div class="modal-title l1 f40 f600 text-center mb30">'.$title.'</div>
							<div class=" modal_content_wr l12">'.$content.'</div>
						</div>
					</div>
				</div>
			</div>';
		}else{
			return '<div class="modal fade" id="'. $id .'" tabindex="-1" role="dialog" aria-labelledby="ModalCenterLongTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<button type="button" class="close f20" data-dismiss="modal" aria-label="Close"></button>
						<div class="d-flex flex-wrap">
							<div class="col-12 col-lg-5 position-relative modal_bg">'.$picture.'</div>
							<div class="col-12 col-lg-7 col_right">
								<div class="modal-header">
									<div class="modal-title l1 f24 f600">'.$title.'</div>
								</div>
								<div class="modal-body">'.$content.'</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
		}
	}
	function get_modal_layout($id = '', $title = '', $content = ''){
		echo the_modal_layout($id, $title, $content);
	}
	
	get_modal_layout('thankyou',  __('Thank you','bobcat'), __('We will contact you soon','bobcat')); // show after cf7 form sent
	get_modal_layout('callback', __('Order consultation','bobcat'), do_shortcode ('[contact-form-7 id="137" title="Зворотній звязок"]')); // callback form