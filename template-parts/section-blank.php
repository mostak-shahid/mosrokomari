<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-blank-animation'];
$animation_delay = ( $mosrokomari_options['sections-blank-animation-delay'] ) ? $mosrokomari_options['sections-blank-animation-delay'] : 0;
$title = $mosrokomari_options['sections-blank-title'];
$content = $mosrokomari_options['sections-blank-content'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blank', $page_details ); 
?>
<section id="section-blank" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_blank hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_blank', $page_details ); 
		?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
		<?php 
		/*
		* action_after_blank hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_blank', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_blank', $page_details  ); ?>