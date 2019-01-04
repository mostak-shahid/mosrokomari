<?php /*Template Name: Team Page Template with tab*/?>
<?php 
global $mosrokomari_options;

$all_sections = get_post_meta( get_the_ID(), '_mosrokomari_page_section_layout', true );
$sections = ( @$all_sections["Enabled"] ) ? @$all_sections["Enabled"] : $mosrokomari_options['page-layout-settings']['Enabled'];


get_header(); 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_team_tab_page', $page_details ); 
?>

<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : $mosrokomari_options['general-page-layout']; ?>
<section id="team-page" class="page-content">
	<div class="content-wrap">

		<?php 
		/*
		* action_before_team_tab_page hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_page', $page_details ); 
		?>
		<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>
				<?php if ( have_posts() ) :?>
					<?php get_template_part( 'content', 'page' ) ?>
				<?php endif; ?>
				<?php 		
				/*
				* action_team_tab_archive_page hook
				* @hooked start_row 10
				* @hooked action_team_tab_archive_page_fnc 10
				* @hooked end_div 10
				*/
				do_action( 'action_team_tab_archive_page', $page_details ); 
				?>
				<?php if($page_layout != 'ns') : ?>
				</div>
				<div class="post-widgets col-md-4 <?php if($page_layout == 'ls') echo 'col-md-pull-8' ?>">
					<?php get_sidebar();?>
				</div>
			</div>
				<?php endif; ?>

		<?php 
		/*
		* action_after_team_tab_page hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_team_tab_page', $page_details ); 
		?>
	</div>
</section>
<?php do_action( 'action_below_page', $page_details  ); ?>

<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>
