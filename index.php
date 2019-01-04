<?php  
global $mosrokomari_options;
$animation = @$mosrokomari_options['sections-content-animation'];
$animation_delay = @$mosrokomari_options['sections-content-animation-delay'];


$page_for_posts = get_option( 'page_for_posts' );
//$sections = $mosrokomari_options['blog-layout-settings']['Enabled'];
$sections = get_post_meta( $page_for_posts, '_mosrokomari_page_section_layout', true )['Enabled'];
$avobe_page = get_post_meta( $page_for_posts, '_mosrokomari_avobe_page', true );
$before_page = get_post_meta( $page_for_posts, '_mosrokomari_before_page', true );
$before_loop = get_post_meta( $page_for_posts, '_mosrokomari_before_loop', true );
$after_loop = get_post_meta( $page_for_posts, '_mosrokomari_after_loop', true );
$after_page = get_post_meta( $page_for_posts, '_mosrokomari_after_page', true );
$below_page = get_post_meta( $page_for_posts, '_mosrokomari_below_page', true );
if($sections ) {
	$shift = array_shift($sections);
}
?>
<?php 
get_header(); 
if (is_home()) echo do_shortcode( $avobe_page );
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blog_page', $page_details ); 
?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : 'ns'; ?>
<section id="blog-page" class="page-content" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		<?php 
		/*
		* action_before_blog_page hook
		* @hooked action_before_blog_page 10 (output .container)
		*/
		do_action( 'action_before_blog_page', $page_details ); 
		if (is_home()) echo do_shortcode( $before_page );
		?>
			<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>
				<?php
				do_action( 'action_before_blog_loop', $page_details ); 
				if (is_home()) echo do_shortcode( $before_loop );
				?>
				<?php if ( have_posts() ) :?>		
					<?php get_template_part( 'content', get_post_format() ) ?>
					
					<div class="pagination-wrapper">
					<?php
						the_posts_pagination( array(
							'show_all' => false,
							'screen_reader_text' => " ",
							'prev_text'          => 'Prev',
							'next_text'          => 'Next',
						) );
					?>
					</div>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif;?>
				<?php
				do_action( 'action_after_blog_loop', $page_details ); 
				if (is_home()) echo do_shortcode( $after_loop );
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
		* action_after_blog_page hook
		* @hooked end_div 10
		*/
		if (is_home()) echo do_shortcode( $after_page );
		do_action( 'action_after_blog_page', $page_details ); 
		?>
	</div>
</section>
<?php 
if (is_home()) echo do_shortcode( $below_page );
do_action( 'action_below_blog_page', $page_details ); 
?>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>

