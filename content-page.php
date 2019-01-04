<?php
$before_loop = get_post_meta( get_the_ID(), '_mosrokomari_before_loop', true );
$after_loop = get_post_meta( get_the_ID(), '_mosrokomari_after_loop', true );
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_page_content_loop', $page_details ); 
echo do_shortcode( $before_loop );
?>
<?php $page_layout = get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true )? get_post_meta( get_the_ID(), '_mosrokomari_page_layout', true ) : $mosrokomari_options['general-page-layout']; ?>

	<?php while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>					
				<?php if (has_post_thumbnail()):?>
						<div class="blog-img-container">
							<?php if($page_layout != 'ns') : ?>
							<?php the_post_thumbnail('blog-image', array('class' => 'img-responsive img-blog img-centered'))?>
							<?php else : ?>
							<?php the_post_thumbnail('blog-image-full', array('class' => 'img-responsive img-blog img-centered'))?>
							<?php endif; ?>
						</div>
				<?php endif;?>
						<div class="content">
							<?php the_content()?>
						</div>
						<?php do_action( 'action_after_page_content_area', $page_details ); ?>
					</div>
	<?php endwhile;	?>
<?php 
echo do_shortcode( $after_loop );
do_action( 'action_below_page_content_loop', $page_details ); 
?>