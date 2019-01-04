<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-partner-animation'];
$animation_delay = ( $mosrokomari_options['sections-partner-animation-delay'] ) ? $mosrokomari_options['sections-partner-animation-delay'] : 0;
$title = $mosrokomari_options['sections-partner-title'];
$content = $mosrokomari_options['sections-partner-content'];
$slides = $mosrokomari_options['sections-partner-slides'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_partner', $page_details ); 
?>
<section id="section-partner" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_partner hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_partner', $page_details ); 
		?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<?php $sub_title = ($mosrokomari_options['sections-service-sub-title']) ? '<small>' . $mosrokomari_options['sections-service-sub-title'] . '</small>' : ''; ?>
						<h2 class="title"><?php echo $sub_title . do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php if (@$slides) : ?>

					<div class="row">
					<?php foreach ($slides as $slide) : ?>
						<?php
						$url = ($slide['url']) ? esc_url( $slide['url'] ) : 'javascript:void(0)';
						?>
						<div class="wrapper-partner"><a href="<?php echo $url ?>"><img class="img-responsive img-partner" src="<?php echo wp_get_attachment_url($slide['attachment_id']) ?>" alt="<?php echo $slide['title'] ?>"></a></div>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
		<?php 
		/*
		* action_after_partner hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_partner', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_partner', $page_details  ); ?>