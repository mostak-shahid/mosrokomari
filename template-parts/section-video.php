<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-video-animation'];
$animation_delay = ( $mosrokomari_options['sections-video-animation-delay'] ) ? $mosrokomari_options['sections-video-animation-delay'] : 0;
$video_bg = $mosrokomari_options['sections-video-bg'];
$video_icon = $mosrokomari_options['sections-video-icon'];
$video_url = $mosrokomari_options['sections-video-url'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_video', $page_details ); 
?>
<section id="section-video" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_video hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_video', $page_details ); 
		?>
		<div class="video-wrapper">
			<!-- <div class="embed-responsive embed-responsive-16by9" style="display: none">
				<iframe class="embed-responsive-item" src="<?php echo esc_url( $video_url ) ?>"></iframe>
			</div>
			<video width="320" height="240" autoplay>
				<source src="movie.mp4" type="video/mp4">
				<source src="movie.ogg" type="video/ogg">
				Your browser does not support the video tag.
			</video> -->
			<div class="video-banner">
				<?php
				if ($video_bg['attachment_id']) $banner_url = wp_get_attachment_url( $video_bg['attachment_id'] );
				elseif ($video_bg['url']) $banner_url = esc_url( $video_bg['url'] );
				else $banner_url = get_template_directory_uri() . '/images/video-bg.png';
				?>
				<img class="img-responsive img-video-banner" src="<?php echo $banner_url ?>" alt="Video Banner">
				<?php
				if ($video_icon['attachment_id']) $icon_url = wp_get_attachment_url( $video_icon['attachment_id'] );
				elseif ($video_icon['url']) $icon_url = esc_url( $video_icon['url'] );
				else $icon_url = get_template_directory_uri() . '/images/video-bg.png';
				?>
				<img class="img-responsive img-video-icon" src="<?php echo $icon_url ?>" alt="Video Icon" data-url="<?php echo esc_url( $video_url ) ?>">
			</div>
		</div>
		<?php 
		/*
		* action_after_video hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_video', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_video', $page_details  ); ?>