<?php /*Template Name: Group Tab Page Template*/?>
<?php 
global $mosrokomari_options;
$all_sections = get_post_meta( get_the_ID(), '_mosrokomari_page_section_layout', true );
$sections = ( @$all_sections["Enabled"] ) ? @$all_sections["Enabled"] : $mosrokomari_options['page-layout-settings']['Enabled'];
?>
<?php 
get_header(); 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_page', $page_details ); 
?>
<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : $mosrokomari_options['general-page-layout']; ?>
<section id="contact-page" class="page-content">
	<div class="content-wrap">
		<?php 
		/*
		* action_before_page hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_page', $page_details ); 
		?>
			<div class="<?php if($page_layout != 'ns') echo 'row'; else echo 'no-row' ?>">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
				<?php if ( have_posts() ) :?>					
					<?php if ($gallery_location == "after") get_template_part( 'content', 'page' ); ?>
					<?php 
					$tab_group_details = get_post_meta( get_the_ID(), '_mosrokomari_tab_group_details_group', true ); 
					if ($tab_group_details) :  ?>
						<?php foreach ($tab_group_details as $tab_single_details) : ?>
							<?php $udi = rand(100, 999) ?>
					<div class="tab-container">
						<h2 class="tab-title"><?php echo do_shortcode( $tab_single_details["_mosrokomari_tab_group_title_text"] );?></h2>
						<?php if ($tab_single_details["_mosrokomari_tab_group_title_images_id"]) : ?>
						<img class="img-responsive img-centered img-tab-title" src="<?php echo wp_get_attachment_url($tab_single_details["_mosrokomari_tab_group_title_images_id"]) ?>" alt="<?php echo $alt_tag["inner"] . $tab_single_details["_mosrokomari_tab_group_title_text"] ?>">
						<?php endif; ?>
						<?php if (sizeof($tab_single_details['_mosrokomari_tab_group_tab_details']) > 1)) : ?>
						<ul class="nav nav-tabs">
							<?php $n = 0;?>
							<?php foreach ($tab_single_details['_mosrokomari_tab_group_tab_details'] as $value) : ?>
								<?php $slice = explode(",",$value);?>
							<li <?php if (!$n) echo 'class="active"' ?>><a data-toggle="tab" href="#<?php echo strtolower( str_replace(array (' ', '.'), '_', $slice['0'])) . '_' .$udi ; ?>"><?php echo do_shortcode( $slice['0'] ) ?></a></li>
							<?php $n++; endforeach; ?>
						</ul>
						<?php endif; ?>
						<div class="tab-content">
							<?php $n = 0;?>
							<?php foreach ($tab_single_details['_mosrokomari_tab_group_tab_details'] as $value) : ?>
								<?php $slice = explode(",",$value);	?>
							<div id="<?php echo strtolower( str_replace(array (' ', '.'), '_', $slice['0'])) . '_' .$udi ; ?>" class="tab-pane fade <?php if (!$n) echo 'in active' ?>">
								<div class="desc"><?php echo do_shortcode( $slice['1'] ) ?></div>
								<div class="con"><?php echo do_shortcode( $slice['2'] ) ?></div>
							</div>

							<?php $n++; endforeach; ?>

						</div>								
					</div>
						<?php endforeach; ?>
					<?php endif ?>
					<?php if ($gallery_location == "before") get_template_part( 'content', 'page' ); ?>
				<?php endif; ?>

				</div>
			<?php if($page_layout != 'ns') : ?>
				<div class="page-widgets col-md-4 <?php if($page_layout == 'ls') echo 'col-md-pull-8' ?>">
					<?php get_sidebar('page');?>
				</div>
			<?php endif; ?>
			</div>
		<?php 
		/*
		* action_after_page hook
		* @hooked end_div 10
		*/
		do_action( 'action_after_page', $page_details ); 
		?>
	</div>
</section>
<?php do_action( 'action_below_page', $page_details ); ?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>