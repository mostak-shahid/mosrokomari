<?php get_header(); ?>
<section id="page-content">
	<div class="container">
<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		// Include the page content template.
		//get_template_part( 'content', 'page' );
		the_content();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	// End the loop.
	endwhile;
?>
	
	</div>
	
	<div class="container">
		<pre>
			<?php 
			global $mosrokomari_options;
			var_dump($mosrokomari_options);
			?>
		</pre>
	</div>
</section>
<?php get_footer(); ?>
