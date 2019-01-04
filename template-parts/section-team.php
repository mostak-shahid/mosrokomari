<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-team-animation'];
$animation_delay = ( $mosrokomari_options['sections-team-animation-delay'] ) ? $mosrokomari_options['sections-team-animation-delay'] : 0;
$title = $mosrokomari_options['sections-team-title'];
$content = $mosrokomari_options['sections-team-content'];

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_team', $page_details ); 
?>
<section id="section-team" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_team hook
		* @hooked start_container_fluid 10 (output .container-fluid)
		*/
		do_action( 'action_before_team', $page_details ); 
		?>
		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif; ?>
		<?php if ($content) : ?>				
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></div>
		<?php endif; ?>
			<?php 		
			/*
			* action_team_archive_page hook
			* @hooked start_row 10
			* @hooked team_archive_page_fnc 10
			* @hooked end_div 10
			*/
			do_action( 'action_team_archive', $page_details ); 
			?>
		<?php 
		/*
		* action_after_team hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_team', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_team', $page_details  ); ?>