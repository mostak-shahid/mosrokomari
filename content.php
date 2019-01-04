<?php 
global $mosrokomari_options;
$grid = $mosrokomari_options['blog-archive-grid'];
$zigzag = $mosrokomari_options['blog-archive-section1-zigzag'];
if($grid == '4') { $colsize = 3; }
elseif($grid == '3') { $colsize = 4; }
elseif($grid == '2') { $colsize = 6; }
else { $colsize = 12; }
if (is_single()) $colsize = 12;
$n = 1;
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_before_blog_page_loop', $page_details );
?>
		<div class="blogs">
			<?php if ($colsize != 12) : ?>
				<div class="row">
			<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ($colsize != 12) : ?>
			<div class="col-md-<?php echo $colsize?> <?php if ($colsize < 6 ) echo 'col-sm-6';?>">
			<?php endif; ?>
						<div class="blog-content<?php if ($mosrokomari_options['blog-archive-content-layout'] == 2) echo ' row' ?>">
		                	<?php
		                	if ($mosrokomari_options['blog-archive-content-layout'] == 2 AND $mosrokomari_options['blog-archive-section1-width']) :
			                	$sec_1 = $mosrokomari_options['blog-archive-section1-width'];
			                	$slice = explode("-",$sec_1);
			                	$num = 12 - end($slice);
			                	if (@$zigzag AND $n%2==0) $sec_1 .= ' ' . $slice[0] . '-' . $slice[1] . '-push-' . $num;
			                	$sec_2 = $slice[0] . '-' . $slice[1] . '-' . $num;
			                	if (@$zigzag AND $n%2==0) $sec_2 .= ' ' . $slice[0] . '-' . $slice[1] . '-pull-' . end($slice);
			                endif
		                	?>
		                	<div class="sec-1 <?php  echo $sec_1 ?>">
			                <?php if (@$mosrokomari_options['blog-archive-section1']) : ?>
			                	<?php foreach ($mosrokomari_options['blog-archive-section1'] as $shortcodes) : ?>
			                		<?php echo do_shortcode( $shortcodes ) ?>
			                	<?php endforeach; ?>
			                <?php endif; ?>
		                	</div>
		                	<div class="sec-2 <?php  echo $sec_2 ?>">
			                <?php if (@$mosrokomari_options['blog-archive-section2']) : ?>		                		
			                	<?php foreach ($mosrokomari_options['blog-archive-section2'] as $shortcodes) : ?>
			                		<?php echo do_shortcode( $shortcodes ) ?>
			                	<?php endforeach; ?>
			                <?php endif; ?>
		                	</div>  
		                </div> 

			<?php if ($colsize != 12) : ?>
			</div>
			<?php endif ?>

			<?php if ($grid > 1 AND $n%$grid == 0) echo '</div><div class="row blogs">'; $n++;?>
		<?php endwhile;?>
			<?php if ($colsize != 12) : ?>
				</div>
			<?php endif; ?>
		</div>
<?php do_action( 'action_below_blog_page_loop', $page_details );?>
