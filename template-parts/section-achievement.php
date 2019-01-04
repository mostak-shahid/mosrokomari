<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-achievement-animation'];
$animation_delay = ( $mosrokomari_options['sections-achievement-animation-delay'] ) ? $mosrokomari_options['sections-achievement-animation-delay'] : 0;
$title = $mosrokomari_options['sections-achievement-title'];
$content = $mosrokomari_options['sections-achievement-content'];
$slides = $mosrokomari_options['sections-achievement-slides'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_achievement', $page_details ); 
?>
<section id="section-achievement" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_achievement hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_achievement', $page_details ); 
		?>
		<div class="row">
			<div class="col-md-5">
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<?php $sub_title = ($mosrokomari_options['sections-achievement-sub-title']) ? '<small>' . $mosrokomari_options['sections-achievement-sub-title'] . '</small>' : ''; ?>
						<h2 class="title"><?php echo $sub_title . do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>			
			</div>
			<div class="col-md-7">
			<?php if (@$slides) : ?>
				<?php $n = 1; ?>
				<div class="row">
				<?php foreach ($slides as $slide) : ?>
					<div class="col-md-6">
						<div class="tile-wrapper <?php if($n%4==0) echo 'sky'; elseif($n%3==0) echo 'pink'; elseif($n%2==0) echo 'green'; else echo 'blue'; ?>">
							<div class="tile">
								<span class="count"><?php echo $slide['description'] ?></span>							
								<span class="text"><?php echo $slide['title'] ?></span>							
							</div>
						</div>
					</div>
					<?php if ($n%2==0) echo '</div><div class="row">'; $n++;?>
				<?php endforeach;?>
				</div>
			<?php endif;?>

			</div>
		</div>

		<?php 
		/*
		* action_after_achievement hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_achievement', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_achievement', $page_details  ); ?>