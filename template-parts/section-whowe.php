<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-whowe-animation'];
$animation_delay = ( $mosrokomari_options['sections-whowe-animation-delay'] ) ? $mosrokomari_options['sections-whowe-animation-delay'] : 0;
$title = $mosrokomari_options['sections-whowe-title'];
$content = $mosrokomari_options['sections-whowe-content'];
$media = $mosrokomari_options['sections-whowe-media'];
$link_title = $mosrokomari_options['sections-whowe-url']['text_field_1'];
$link_url = $mosrokomari_options['sections-whowe-url']['text_field_2'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_whowe', $page_details ); 
?>
<section id="section-whowe" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_whowe hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_whowe', $page_details ); 
		?>
		<div class="row">
			<div class="col-lg-6">
			<?php 
			if (@$media['id']) $img_url = wp_get_attachment_url( $media['id'] );
			elseif (@$media['url']) $img_url = $media['url'];
			else $img_url = get_template_directory_uri() . '/images/whowe.jpg';			
			?>
			<img class="img-responsive img-centered img-whowe" src="<?php echo $img_url ?>" alt="<?php echo do_shortcode( $title ); ?>">
			</div>
			<div class="col-lg-6">
				<div class="flex flex-start">
					<div class="wrapper">
						<?php if ($title) : ?>				
							<div class="title-wrapper">
							<?php $sub_title = ($mosrokomari_options['sections-whowe-sub-title']) ? '<small>' . $mosrokomari_options['sections-whowe-sub-title'] . '</small>' : ''; ?>
								<h2 class="title"><?php echo $sub_title . do_shortcode( $title ); ?></h2>				
							</div>
						<?php endif; ?>
						<?php if ($content) : ?>				
							<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
						<?php endif; ?>
						<?php if (@$link_title AND @$link_url) echo '<a class="btn btn-whowe" href="'.do_shortcode( $link_url ).'">'.$link_title.'</a>'; ?>
					</div>
				</div>
			</div>
		</div>

		<?php 
		/*
		* action_after_whowe hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_whowe', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_whowe', $page_details  ); ?>