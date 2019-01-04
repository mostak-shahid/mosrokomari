<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-button-animation'];
$animation_delay = $mosrokomari_options['sections-button-animation-delay'];
$title = $mosrokomari_options['sections-button-title'];
$content = $mosrokomari_options['sections-button-content'];
$buttons = $mosrokomari_options['sections-button-slides'];
$gap = $mosrokomari_options['sections-button-gap'][1];
$count = sizeof($buttons);
$class = 'col-md-4 col-sm-6';
if($count == 1)
	$class = 'col-md-6 col-md-offset-3 col-sm-6';
elseif($count % 4 == 0)
	$class = 'col-md-3 col-sm-6';
elseif($count % 3 == 0)
	$class = 'col-md-4 col-sm-6';
elseif($count == 2)
	$class = 'col-md-6 col-sm-6';


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_button', $page_details );
?>
<section id="section-button" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_button hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_button', $page_details ); 
		?>
		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif; ?>
		<?php if ($content) : ?>				
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></div>
		<?php endif; ?>
		<?php //var_dump($buttons) ?>	
			<div class="row">
				<?php foreach ($buttons as $button) : ?>	
					<div class="<?php echo $class; if ($gap) echo ' mb30'; else echo ' no-padding' ?>">
						<div class="wrapper-btn">
							<div class="img-wrapper">
								<?php echo wp_get_attachment_image( $button["attachment_id"], 'full', false, array( 'class' => 'img-responsive img-button', 'alt' => $alt_tag['inner'] . $button["title"] )) ?>								
							</div>
							<div class="text-wrapper">
								<span class="title-btn"><?php echo $button["title"] ?></span>
								<span class="desc-btn"><?php echo $button["description"] ?></span>
							</div>
							<a href="<?php echo do_shortcode( $button["url"] ) ?>" class="btn-button">Read More</a>
						</div>
					</div>	
				<?php endforeach; ?>			
			</div>
		<?php 
		/*
		* action_after_service hook
		* @hooked end_div 10
		*/		
		do_action( 'action_after_button', $page_details ); 
		?>
		
	</div>
</section>
<?php do_action( 'action_below_button', $page_details ); ?>