<?php  
global $mosrokomari_options;
$sections = $mosrokomari_options['blog-layout-settings']['Enabled'];
if($sections ) {
	$shift = array_shift($sections);
}
?>
<?php get_header(); ?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mospress_page_layout', true )? get_post_meta( get_the_ID(), '_mospress_page_layout', true ) : $mosrokomari_options['blog-archive-layout']; ?>
<section id="single-blog-page" class="page-content">
	<div class="content-wrap">
		<div class="container">
			<?php if($page_layout != 'ns') : ?>
			<div class="row">
				<div class="<?php if($page_layout != 'ns' ) echo 'col-md-8'; if($page_layout == 'ls') echo ' col-md-push-4' ?>">
			<?php endif; ?>
				<?php if ( have_posts() ) :?>		
					<?php //get_template_part( 'content', get_post_format() ) ?>
					<?php if (has_post_thumbnail()): ?>
						<?php the_post_thumbnail('max-size', array('class' => 'img-responsive img-featured' )) ?>
					<?php endif; ?>
					<h1><?php the_title(); ?></h1>
					<div class="desc"><?php the_content(); ?></div>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif;?>
					<div class="post-linking">
						<div class="row">
							<div class="col-md-6 text-left">								
								<?php previous_post_link("%link", "Previous Post") ; ?>
							</div>
							<div class="col-md-6 text-right">
								<?php next_post_link("%link", "Next Post"); ?>
							</div>						
						</div>
					</div>
					<?php if ($mosrokomari_options['single-blog-comment']) : ?>
						<?php if ($mosrokomari_options['single-blog-comment-style'] == 'fb') : ?>
							<?php require_once ('functions/facebook-comments.php') ?>
						<?php else : ?>							
							<?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>
						<?php endif; ?>
					<?php endif; ?>
				<?php if($page_layout != 'ns') : ?>
				</div>
				<div class="post-widgets col-md-4 <?php if($page_layout == 'ls') echo 'col-md-pull-8' ?>">
					<?php get_sidebar();?>
				</div>
			</div>
				<?php endif; ?>
		</div>
	</div>
</section>
<?php if($sections ) { foreach ($sections as $key => $value) { get_template_part( 'template-parts/section', $key );}}?>
<?php get_footer(); ?>

