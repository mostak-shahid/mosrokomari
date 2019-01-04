<?php /*Template Name: Lightbox Gallery Page Template*/ ?>
<?php 
global $mosrokomari_options;
$avobe_page = get_post_meta( get_the_ID(), '_mosrokomari_avobe_page', true );
$before_page = get_post_meta( get_the_ID(), '_mosrokomari_before_page', true );
$after_page = get_post_meta( get_the_ID(), '_mosrokomari_after_page', true );
$below_page = get_post_meta( get_the_ID(), '_mosrokomari_below_page', true );

$all_sections = get_post_meta( get_the_ID(), '_mosrokomari_page_section_layout', true );
$sections = ( @$all_sections["Enabled"] ) ? @$all_sections["Enabled"] : $mosrokomari_options['page-layout-settings']['Enabled'];
?>
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
?>
<?php 
get_header(); 
echo do_shortcode( $avobe_page );
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_page', $page_details ); 
?>
<?php $image_per_page =  get_post_meta( get_the_ID(), '_mosrokomari_image_per_page', true ) ? get_post_meta( get_the_ID(), '_mosrokomari_image_per_page', true ) : 6;?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : $mosrokomari_options['general-page-layout']; ?>
<section id="lightbox-gallery-page" class="page-content">
	<div class="content-wrap">

		<?php 
		/*
		* action_before_gallery_page hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_page', $page_details ); 
		echo do_shortcode( $before_page );
		?>
		<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>
				<?php if ( have_posts() ) :?>
					<?php
					$gallery_location = get_post_meta( get_the_ID(), '_mosrokomari_gallery_location', true ); 
					$gallery_images = get_post_meta( get_the_ID(), '_mosrokomari_gallery_images', true );
					$layout = ( get_post_meta( get_the_ID(), '_mosrokomari_gallery_layout', true ) ) ? get_post_meta( get_the_ID(), '_mosrokomari_gallery_layout', true ) : '6';
					$gallery_gap = get_post_meta( get_the_ID(), '_mosrokomari_gallery_gap', true );

					$large_image_size =  get_post_meta( get_the_ID(), '_mosrokomari_large_image_size', true );
					$image_width =  get_post_meta( get_the_ID(), '_mosrokomari_image_width', true );
					$image_height =  get_post_meta( get_the_ID(), '_mosrokomari_image_height', true );
					?>
					<?php if ($gallery_location == "after") get_template_part( 'content', 'page' ); ?>
					<div class="gallery-images">
					<?php
					if($gallery_images) : ?>
						<div id="gallery" class="<?php if ($gallery_gap) echo 'row' ?>">
							<?php foreach ( $gallery_images as $attachment_id => $attachment_url ) : ?>
								<?php $raw_url = wp_get_attachment_url( $attachment_id ) ?>									
								<div class="col-xs-6 col-md-<?php echo $layout; if ($gallery_gap) echo ' mb30'; else echo ' no-padding';?>">
									<div class="img-container">
										<a href="<?php if ($large_image_size == 'max') echo aq_resize($raw_url, 1920); elseif ($large_image_size == 'container') echo aq_resize($raw_url, 1140); else echo $raw_url ?>" data-fancybox="gallery" data-caption="">
											<?php 
											$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); 
											if ($image_width OR $image_height ) $img_url = aq_resize($raw_url, $image_width, $image_height, true);
											else $img_url = $raw_url;
											?>

											<img class="img-responsive img-gallery" src="<?php echo $img_url; ?>" alt="<?php echo $alt_tag['inner'] . $attachment_alt; ?>">
											<?php //echo wp_get_attachment_image( $attachment_id, 'gallery-section-resized', false, array('class' => 'img-responsive img-gallery', 'alt' => $alt_tag['inner'] . $attachment_alt) ); ?>
										
											<div class="hover-box">
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
							<?php endforeach; ?>
						</div>
						<div class="galleryHolder"></div>
					<?php endif;?>
					</div>
					<?php if ($gallery_location == "before") get_template_part( 'content', 'page' ); ?>					
				<?php endif; ?>
			<?php if($page_layout != 'ns') : ?>
				</div>
				<div class="page-widgets col-md-4 <?php if($page_layout == 'ls') echo 'col-md-pull-8' ?>">
					<?php get_sidebar('page');?>
				</div>
			</div>
			<?php endif; ?>
		<?php 
		/*
		* action_after_gallery_page hook
		* @hooked end_div 10
		*/
		echo do_shortcode( $after_page ); 
		do_action( 'action_after_page', $page_details );
		?>
	</div>
</section>
<?php 
echo do_shortcode( $below_page );
do_action( 'action_below_page', $page_details ); 
?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>
<script>
jQuery(document).ready(function($) {	
	$("div.galleryHolder").jPages({
        containerID: "gallery",
        perPage: <?php echo $image_per_page ?>,
        previous: "prev",
        next: "next",
    });
    if ($(".galleryHolder a").length <= 3){
    	$('.galleryHolder').hide();
    }
});	
</script>
