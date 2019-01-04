<?php /*Template Name: Lightbox Multy Gallery Page Template*/ ?>
<?php 
global $mosrokomari_options;
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
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_gallery_page', $page_details ); 
?>
<?php $image_per_page =  get_post_meta( get_the_ID(), '_mosrokomari_image_per_page', true ) ? get_post_meta( get_the_ID(), '_mosrokomari_image_per_page', true ) : 6;?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : $mosrokomari_options['general-page-layout']; ?>
<section id="lightbox-multy-gallery-page" class="page-content">
	<div class="content-wrap">

		<?php 
		/*
		* action_before_gallery_page hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_page', $page_details ); 
		?>
		<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>

				<?php if ( have_posts() ) :?>
					<?php 
					$gallery_location = get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_location', true );
					$gallery_layout = get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_layout', true );
					$gallery_gap = get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_gap', true );
					$per_page = (get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_per_page', true )) ? get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_per_page', true ) : '-1' ;

					$large_image_size = (get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_large_image_size', true )) ? get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_large_image_size', true ) : 'container' ;
					$image_width = (get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_width', true )) ? get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_width', true ) : '263' ;
					$image_height = (get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_height', true )) ? get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_image_height', true ) : '263' ;


					$gallery_details_group = get_post_meta( get_the_ID(), '_mosrokomari_multy_gallery_details_group', true );
					//var_dump($gallery_details_group);
					?>
					<?php if ($gallery_location == "after") get_template_part( 'content', 'page' ); ?>
					<?php if ($gallery_details_group) : ?>
						<?php $n = 1; ?>
						<?php foreach ($gallery_details_group as $gallery_details_value) : ?>
							<?php
							$top_title = $gallery_details_value["_mosrokomari_multy_gallery_title_text"];
							$top_title_img = wp_get_attachment_url($gallery_details_value["_mosrokomari_multy_gallery_title_images_id"]);

							$tab_details = $gallery_details_value["_mosrokomari_multy_gallery_tab_details"];
							//var_dump($tab_details);
							// $tab_names = rtrim($gallery_details_value["_mosrokomari_multy_gallery_tab_names"], ',');
							// $tab_name_arr = explode(",",$tab_names);
							if (@$gallery_details_value["_mosrokomari_multy_gallery_tab_images"][0]) : 
							?>
							<div class="tab-container">
							<?php if ($top_title) : ?>
								<h2 class="tab-title"><?php echo $top_title ?></h2>
							<?php endif; ?>
							<?php if ($top_title_img) : ?>
								<img class="img-responsive img-centered img-tab-title" src="<?php echo $top_title_img ?>" alt="<?php echo $alt_tag['inner'] . get_the_title() ?>"></h2>
							<?php endif; ?>


								<ul class="nav nav-tabs">
								<?php $active = 0; ?>
								<?php foreach ($tab_details as $tab_detail) : ?>
									<?php 
									$slice = explode(",",$tab_detail);
									$name = $slice[0];
									?>
									<li <?php if (!$active) echo 'class="active"' ?>><a data-toggle="tab" href="#<?php echo strtolower(str_replace(' ', '_', $name)) . '_' . $n ?>"><?php echo $name ?></a></li>
									<?php $active++ ?>
								<?php endforeach; ?>
								</ul>

								<div class="tab-content">
								<?php $active = 0; ?>
								<?php foreach ($tab_details as $tab_detail) : ?>
									<?php 
									$slice = explode(",",$tab_detail);
									$name = $slice[0];
									$name = ltrim(@$slice[1]," ");
									?>
									<div id="<?php echo strtolower(str_replace(' ', '_', $name)) . '_' . $n ?>" class="tab-pane fade <?php if (!$active) echo 'in active' ?>">
										<div class="desc"><?php echo $desc ?></div>
									<?php if ($gallery_details_value["_mosrokomari_multy_gallery_tab_images"]) : ?>
										<div id="group_gallery_<?php echo $active ?>" class="row">
										<?php foreach ($gallery_details_value["_mosrokomari_multy_gallery_tab_images"][$active] as $attachment_id => $url) : ?>
											<?php $raw_url = wp_get_attachment_url( $attachment_id ) ?>	
											<div class="col-xs-6 col-md-<?php echo $gallery_layout;  if ($gallery_gap) echo ' mb30'; else echo ' no-padding';?>">
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
																<img src="<?php echo do_shortcode( $mosrokomari_options['sections-gallery-zoom']['url'] );?>" alt="<?php $alt_tag['inner']?> Zoom">
															</div>
														</div> 
													</a>
												</div>
											</div>									
										<?php endforeach; ?>
										</div>		
									<?php endif; ?>
									</div>

									<?php $active++ ?>
								<?php endforeach; ?>
								</div>								
							</div>
							<?php endif; ?>
							<?php $n++; ?>
						<?php endforeach; ?>
					<?php endif; ?>
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
		do_action( 'action_after_gallery_page', $page_details ); 
		?>
	</div>
</section>
<?php do_action( 'action_below_page', $page_details ); ?>
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
