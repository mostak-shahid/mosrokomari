<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-blog-animation'];
$animation_delay = ( $mosrokomari_options['sections-blog-animation-delay'] ) ? $mosrokomari_options['sections-blog-animation-delay'] : 0;
$view = $mosrokomari_options['sections-blog-view'];
$title = $mosrokomari_options['sections-blog-title'];
$content = $mosrokomari_options['sections-blog-content'];
$layout = $mosrokomari_options['sections-blog-layout'];

if($layout == '3') { $colsize = 4; }
elseif($layout == '4') { $colsize = 3; }
elseif($layout == '2') { $colsize = 6; }
else { $colsize = 12; }
if ($colsize < 6) $smallcol = 6;
else  $smallcol = 12;
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 

?>
<?php
$count = ($mosrokomari_options['sections-blog-count']) ? $mosrokomari_options['sections-blog-count'] : '-1' ;
$args = array(
	'posts_per_page'=>$count,
	'post_type'=>'post'
);
$query = new WP_Query($args); 
$n = 1;
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blog', $page_details );
?>
<section id="section-blog" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">

		<?php 
		/*
		* action_before_blog hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_blog', $page_details );
		?>
		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ) ?></h2>				
			</div>
		<?php endif; ?>
		<?php if ($content) : ?>				
			<div class="content-wrapper"><?php echo do_shortcode( $content ); ?></div>
		<?php endif; ?>

		<?php if ($query -> have_posts()) : ?>
			<?php do_action( 'action_before_blog_loop', $page_details ); ?>
			<div <?php if ($view == 'slider') echo 'id="section-blog-owl" class="blogs owl-carousel owl-theme"'; else echo 'class="row blogs grid"'; ?> >
			<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
				<div class="<?php if ($view == 'grid') echo 'col-sm-'.$smallcol.' col-md-'.$colsize; else echo 'wrapper'?>">
		                <div class="wrapper">
		                	<div class="feature-image">
		                		<?php 
		                		$img_url = get_the_post_thumbnail_url(); 
		                		if ($img_url) {
		                			$img_url = aq_resize($img_url, 360);
		                			echo '<img class="img-responsive img-blog" src="'.$img_url.'" alt="'.get_the_title().'">';
		                		}
		                		?>
		                	</div>
		                	<div class="desc">		                		
			                	<h3 class="blog-title"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
			                	<div class="blog-date"><?php echo get_the_date('d M, Y') ?></div>
		                	</div>
		                </div>
				</div>
				<?php if ($view == 'grid' AND $n%$layout == 0 AND $n<$count) echo '<div class="hidden-xs hidden-sm clearfix"></div>';  if ($view == 'grid' AND $n%2 == 0 AND $n<$count) echo '<div class="hidden-lg hidden-md clearfix"></div>'; $n++;?>
			<?php endwhile;?>
			</div>			
			<?php do_action( 'action_after_blog_loop', $page_details ); ?>				
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif;?>
		<?php wp_reset_postdata();?>
		<?php 
		/*
		* action_after_blog hook
		* @hooked end_div 10
		*/	
		do_action( 'action_after_blog', $page_details );
		?>

	</div>
</section>
<?php do_action( 'action_below_blog', $page_details ); ?>
