<?php 
global $mosrokomari_options; 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$select = $mosrokomari_options['sections-banner-select'];
$slides = $mosrokomari_options['sections-banner-details'];
$shortcode = $mosrokomari_options['sections-banner-shortcode'];
$n = 1;
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_before_banner', $page_details );
?>
<section id="section-banner">
	<?php do_action( 'action_before_banner_loop', $page_details ); ?>	
	<?php if ($select == 'shortcode') : ?>
		<?php echo do_shortcode( $shortcode ); ?>
	<?php else : ?>

		<div <?php if ( $select == 'banner' ) echo 'class="static-banner"'; else echo 'id="section-banner-owl" class="owl-carousel owl-theme"';   ?>>
		<?php foreach ($slides as $slide) : ?>
	
			<div class="wrapper">
			<?php 
			/*
			* Coming from theme option, see in theme-hook.php
			*/
			do_action( 'action_before_banner_title', $page_details ); 
			?>
					<div class="col-md-6">
				<?php do_action( 'action_before_banner_content', $page_details ); ?>
				<div class="banner-content">

					<div class="banner-text">
						<?php if ($slide["title"]) : ?>
						<h2 class="banner-title"><?php echo do_shortcode( $slide["title"] ) ?></h2>
						<?php endif; ?>
						<?php if ($slide["description"]) : ?>
						<div class="banner-desc">
							<?php echo do_shortcode(  $slide["description"] )?>					
						</div>
						<?php endif; ?>
						<?php if($slide["link_url"] AND $slide["link_title"]) : ?>
							<a class="btn btn-banner" href="<?php echo do_shortcode( $slide["link_url"] ) ?>" <?php if ($slide["target"]) echo 'target="_blank"'; ?>><?php echo do_shortcode( $slide["link_title"] )?></a>
						<?php endif; ?>
					</div>

				</div>
				<?php do_action( 'action_after_banner_content', $page_details ); ?>						
					</div>
					<div class="col-md-6"><?php echo wp_get_attachment_image( $slide["attachment_id"], 'full', false, array( 'class' => 'img-responsive img-banner', 'alt' => $alt_tag['inner'] . strip_tags(do_shortcode( $slide["title"] )) )) ?></div>
					
					<?php 
					/*
					* @hook action_after_banner_url
					* hooked end_div 10
					*/
					do_action( 'action_after_banner_url', $page_details ); 
					?>
				<?php if ($select == 'banner' AND $n==1) break; $n++; ?>
			</div>

		<?php endforeach; ?>
		</div>

	<?php endif; ?>
	<?php do_action( 'action_after_banner_loop', $page_details ); ?>
</section>
<?php do_action( 'action_after_banner', $page_details ); ?>