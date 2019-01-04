<?php 
global $mosrokomari_options;
$title = $mosrokomari_options['sections-product-title'];
$content = $mosrokomari_options['sections-product-content'];
$slides = $mosrokomari_options['sections-product-slides'];
$sizeofslides = sizeof($slides);
?>
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
}
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_product', $page_details ); 
?>
<section id="section-product">
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_service hook
		* @hooked start_container_fluid 10 (output .container-fluid)
		*/
		do_action( 'action_before_product', $page_details );
		?>
		<?php if ($title) : ?>			
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif; ?>
		<?php if ($content) : ?>			
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></div>
		<?php endif; ?>
			<div class="row">
				<div <?php if ( $sizeofslides ) echo 'id="section-product-owl" class="owl-carousel owl-theme"'; ?>>
				<?php foreach ($slides as $slide) : ?>
					<div class="product-unit">
						<?php 
						$attachment_alt = get_post_meta( $slide["attachment_id"], '_wp_attachment_image_alt', true );
						?>
						<img src="<?php echo $slide["image"] ?>" alt="<?php echo $alt_tag['inner'] . $attachment_alt ?>">
						<div class="content">
						<?php if ($slide["title"]) : ?>	
							<h3><?php echo $slide["title"] ?></h3>
						<?php endif; ?>
						<?php if ($slide["description"]) : ?>
							<p><?php echo $slide["description"] ?></p>
						<?php endif; ?>
						<?php if ($slide["url"]) : ?>
							<a href="<?php echo $slide["url"] ?>">Read More</a>
						<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		<?php 
		/*
		* action_after_product hook
		* @hooked end_div 10
		*/
		do_action( 'action_after_product', $page_details );
		?>
		
	</div>
</section>
<?php do_action( 'action_below_product', $page_details );  ?>