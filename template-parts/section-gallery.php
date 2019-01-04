<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-gallery-animation'];
$animation_delay = ( $mosrokomari_options['sections-gallery-animation-delay'] ) ? $mosrokomari_options['sections-gallery-animation-delay'] : 0;
$title = $mosrokomari_options['sections-gallery-title'];
$content = $mosrokomari_options['sections-gallery-content'];
$images = $mosrokomari_options['sections-gallery-images'];
$count = $mosrokomari_options['sections-gallery-count'] - 1;
$layout = $mosrokomari_options['sections-gallery-layout'];
$gap = $mosrokomari_options['sections-gallery-gap'][1];
if($layout == '3') { $colsize = 4; }
elseif($layout == '4') { $colsize = 3; }
elseif($layout == '2') { $colsize = 6; }
else { $colsize = 12; }
if ($colsize < 6) $smallcol = 6;
else  $smallcol = 12;
$view = $mosrokomari_options['sections-gallery-view'];

?>
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_gallery', $page_details );
?>
<?php if ($images) : ?>
	<?php $images_arr = explode(',', $images); ?>
<section id="section-gallery" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_gallery hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_gallery', $page_details );
		?>

		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif ?>
		<?php if ($content) : ?>				
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></h2></div>
		<?php endif ?>
			<div <?php if ($view == 'slider') echo 'id="section-gallery-owl" class="gallery owl-carousel owl-theme"'; elseif ($view == 'grid') echo 'class="row gallery"'; else echo 'class="gallery"'; ?>>
			<?php 
			$image_width = $mosrokomari_options['sections-gallery-small-size']['text_field_1'];
			$image_height = $mosrokomari_options['sections-gallery-small-size']['text_field_2'];
			$large_image_size = $mosrokomari_options['sections-gallery-large-size'];
			foreach ($images_arr as $key => $attachment_id) : 
				$attachment_url = wp_get_attachment_url( $attachment_id );
				$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); 
				if ($image_width OR $image_height ) $img_url = aq_resize($attachment_url, $image_width, $image_height, true);
				else $img_url = $attachment_url;
			?>	
				<div class="<?php if ($view == 'slider') : echo 'wrapper'; else : ?> col-xs-<?php echo $smallcol; ?> col-md-<?php echo $colsize; ?><?php if (!$gap) echo ' no-padding'; else echo ' mb30'?><?php endif;?>">
					<div class="img-container">
						<a href="<?php if ($large_image_size == 'max') echo aq_resize($attachment_url, 1920); elseif ($large_image_size == 'container') echo aq_resize($attachment_url, 1140); else echo $attachment_url ?>" data-fancybox="gallery" data-caption="">
							<?php 
							$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
							list($width, $height) = getimagesize($img_url);
							?>
							<img class="img-responsive img-gallery" src="<?php echo $img_url; ?>" alt="<?php echo $alt_tag['inner'] . $attachment_alt; ?>" width="<?php echo $width ?>" height="<?php echo $height ?>">
							<?php //echo wp_get_attachment_image( $attachment_id, 'gallery-section-resized', false, array('class' => 'img-responsive img-gallery', 'alt' => $alt_tag['inner'] . $attachment_alt) ) ?>
						
							<div class="hover-box hidden-sm hidden-xs">
								<div class="hover-zoom">
									<?php 
									$zoom = wp_get_attachment_url( $mosrokomari_options['sections-gallery-zoom']['id'] );
									if (!$zoom) $zoom = get_template_directory_uri() . '/images/plus.png';
									list($width, $height) = getimagesize($zoom);
									?>
									<img src="<?php echo $zoom;?>" alt="<?php $alt_tag['inner']?> Zoom" width="<?php echo $width ?>" height="<?php echo $height ?>">
								</div>
							</div> 
						</a>
					</div>
				</div>
				<?php if ($key >= $count) break ?>
			<?php endforeach; ?>
			</div>
			<div class="row">
			<?php if($mosrokomari_options['sections-gallery-view-more']['text_field_3']) echo '<div class="'.$mosrokomari_options['sections-gallery-view-more']['text_field_3'].'">'; ?>
				<?php if ($mosrokomari_options['sections-gallery-view-more']['text_field_1'] AND $mosrokomari_options['sections-gallery-view-more']['text_field_2']) : ?>
					<a class="<?php echo do_shortcode( $mosrokomari_options['sections-gallery-view-more']['text_field_4'] )  ?>" href="<?php echo do_shortcode( $mosrokomari_options['sections-gallery-view-more']['text_field_2'] )  ?>"><?php echo do_shortcode( $mosrokomari_options['sections-gallery-view-more']['text_field_1'] )  ?></a>
				<?php endif; ?>
			<?php if($mosrokomari_options['sections-gallery-view-more']['text_field_3']) echo '</div>'; ?>
			</div>
		<?php 
		/*
		* action_after_gallery hook
		* @hooked end_div 10
		*/		
		do_action( 'action_after_gallery', $page_details );
		?>
		
	</div>
</section>
<?php endif; ?>
<?php do_action( 'action_below_gallery', $page_details );?>