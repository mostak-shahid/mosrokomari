<?php 
global $mosrokomari_options;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$animation = $mosrokomari_options['sections-service-animation'];
$animation_delay = $mosrokomari_options['sections-service-animation-delay'];
$title = $mosrokomari_options['sections-service-title'];
$content = $mosrokomari_options['sections-service-content'];
$layout = $mosrokomari_options['sections-service-layout'];
$gap = $mosrokomari_options['sections-service-gap'][1];
$slides = $mosrokomari_options['sections-service-slides'];
$view = $mosrokomari_options['sections-service-view'];
if($layout == '3') { $colsize = 4; }
elseif($layout == '4') { $colsize = 3; }
else { $colsize = 6; }
if ($colsize < 6) $smallcol = 6;
else  $smallcol = 12;
$n = 1;
$total = sizeof($slides);
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_service', $page_details ); 
?>

<section id="section-service" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">		
		<?php 
		/*
		* action_before_service hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_service', $page_details ); 
		?>
		<?php if ($title) : ?>
		<div class="container">		
			<div class="title-wrapper">
				<?php $sub_title = ($mosrokomari_options['sections-service-sub-title']) ? '<small>' . $mosrokomari_options['sections-service-sub-title'] . '</small>' : ''; ?>
				<h2 class="title"><?php echo $sub_title . do_shortcode( $title ); ?></h2>				
			</div>
		</div>
		<?php endif; ?>
		<?php if ($content) : ?>			
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></div>
		<?php endif; ?>
		<div class="services <?php if ($view == 'slider') echo 'with-slider'; ?>">
			<div <?php if ($view == 'slider') echo 'id="section-service-owl" class=" owl-carousel owl-theme"'; elseif ($view == 'grid') echo 'class="row"'; else echo 'class=""'; ?> >
			<?php do_action( 'action_before_service_loop', $page_details ); ?>

				<?php foreach ($slides as $slide) :	?>
					
				<div class="<?php if ($view == 'grid') echo 'col-sm-'.$smallcol.' col-md-'.$colsize; else echo 'wrapper'?><?php if ($gap) echo ' mt15 mb15'; else echo ' no-padding'?>">
					<div class="service-unit">
						<div class="img-part">
							<?php if ($slide['image']) : ?>
								<img class="img-responsive img-service-one" src="<?php echo wp_get_attachment_url( $slide['attachment_id'] ) ?>" alt="<?php echo $alt_tag['inner'] . strip_tags(do_shortcode( $slide['title'] )) ?>" width="<?php echo $slide['width'] ?>" height="<?php echo $slide['height'] ?>">
							<?php endif; ?>
							<?php if ($slide['photo']) : ?>
								<img class="img-responsive img-service-two" src="<?php echo wp_get_attachment_url( $slide['photo_attachment_id'] ) ?>" alt="<?php echo $alt_tag['inner'] . strip_tags(do_shortcode( $slide['title'] )) ?>" width="<?php echo $slide['photo_width'] ?>" height="<?php echo $slide['photo_height'] ?>">
							<?php endif; ?>
						</div>
						<div class="content">	
							<div class="wrapper">					
								<h3 class="service-section-title"><?php echo do_shortcode($slide['title']) ?></h3>
								<div class="service-section-desc"><?php echo do_shortcode( $slide['description'] ) ?></div>
							<?php if($slide['link_title']) : ?>
								<span class="rd-more"><?php echo $slide['link_title'] ?></span>
							<?php endif; ?>
							</div>	
						</div>
						<a class="service-link" href="<?php echo do_shortcode( $slide['link_url'] ) ?>">View More</a>
					</div>
				</div>
				<?php if ($view == 'grid' AND $n%$layout == 0 AND $n<$total) echo '<div class="hidden-xs hidden-sm clearfix"></div>';  if ($view == 'grid' AND $n%2 == 0 AND $n<$total) echo '<div class="hidden-md hidden-lg clearfix"></div>'; $n++;?>	
				<?php endforeach;?>

			<?php do_action( 'action_after_service_loop' ); ?>
			</div>
		</div>
		<?php 
		/*
		* action_after_service hook
		* @hooked end_div 10
		*/
		do_action( 'action_after_service', $page_details ); 
		?>
	</div>
</section>
<?php do_action( 'action_below_service', $page_details ); ?>

