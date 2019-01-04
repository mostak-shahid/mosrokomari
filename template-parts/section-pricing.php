<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-pricing-animation'];
$animation_delay = ( $mosrokomari_options['sections-pricing-animation-delay'] ) ? $mosrokomari_options['sections-pricing-animation-delay'] : 0;
$title = $mosrokomari_options['sections-pricing-title'];
$content = $mosrokomari_options['sections-pricing-content'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_pricing', $page_details ); 
?>
<section id="section-pricing" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_pricing hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_pricing', $page_details ); 
		?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<?php $sub_title = ($mosrokomari_options['sections-pricing-sub-title']) ? '<small>' . $mosrokomari_options['sections-pricing-sub-title'] . '</small>' : ''; ?>
						<h2 class="title"><?php echo $sub_title . do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php
				$args = array(
					'post_type' => 'pricing',
					'posts_per_page' => 3,
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) : ?>
				<div class="pricing-wrapper">
					<div class="row">
						<?php 
						while ( $query->have_posts() ) : $query->the_post();
							$featured = get_post_meta( get_the_ID(), '_mosrokomari_pricing_featured', true );
							$money = get_post_meta( get_the_ID(), '_mosrokomari_pricing_money', true );
							$url = get_post_meta( get_the_ID(), '_mosrokomari_pricing_url', true );
							$features = get_post_meta( get_the_ID(), '_mosrokomari_pricing_features', true );
						?>
						<div class="col-md-4">
							<div class="pricing-unit <?php if ($featured) echo 'featured-unit'; ?>">
								<?php if (@$featured) : ?>
									<span class="feature-text">Popular</span>
								<?php endif; ?>
								<?php if (@$money) : ?>
									<span class="pricing-money"><?php echo $money ?></span>
								<?php endif; ?>
								<h4 class="pricing-title"><?php echo get_the_title(); ?></h4>
								<?php if (@$features) : ?>
									<ul class="pricing-features">
										<?php foreach ($features as $feature) : ?>
											<li><?php echo $feature ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
								<?php if ($url) : ?>
									<div class="btn-wrapper"><a class="btn btn-pricing" href="<?php echo esc_url( $url ) ?>">Sign up</a></div>									
								<?php endif; ?>
							</div>
						</div>
						<?php endwhile; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
				<?php endif; ?>

						
		<?php 
		/*
		* action_after_pricing hook
		* @hooked end_div 10 
		*/
		do_action( 'action_after_pricing', $page_details ); 
		?>	
	</div>
</section>
<?php do_action( 'action_below_pricing', $page_details  ); ?>