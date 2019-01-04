<?php 
global $mosrokomari_options; 
function gradient_manager($options) {
	$from = $options['from'];
	$to = $options['to'];
	echo 'background: '.$from.';';
	echo 'background: -moz-linear-gradient(top,  '.$from.' 0%, '.$to. ' 100%);';
	echo 'background: -webkit-linear-gradient(top,  '.$from.' 0%, '.$to. ' 100%);';
	echo 'background: linear-gradient(to bottom, '.$from.' 0%, '.$to. ' 100%);';
	echo 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$from.'", endColorstr="'.$to.'",GradientType=0 );';
}
function background_manager ($options) {
    foreach ($options as $key => $value){
		if($key != 'media' AND $value) {
			if( $key !='background-image') {
				echo $key . ':' . $value . ';';
			} else {
				echo $key . ':url(' . $value . ');';					
			}
		}
    }
}
function rgba_manager ($options) {
	echo 'background-color: '. $options['rgba'];
}
function mosrokomari_theme_css () {
	global $mosrokomari_options; 
?>
<style>
.scrollup {	
    background-image: url('<?php echo get_template_directory_uri() ?>/images/icon_top.png');
}
#thanks-page {
	background-image: url('<?php echo get_template_directory_uri() ?>/images/thank-you-1-bg.jpg');
}

<?php if ($mosrokomari_options['basic-styling-primary-color']) : ?>
	<?php if ($mosrokomari_options['basic-styling-primary-color-background']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-primary-color-background'],',') ?> {
			background-color: <?php echo $mosrokomari_options['basic-styling-primary-color']; ?>;
		}
	<?php endif; ?>
	<?php if ($mosrokomari_options['basic-styling-primary-color-text']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-primary-color-text'],',') ?> {
			color: <?php echo $mosrokomari_options['basic-styling-primary-color']; ?>;
		}
	<?php endif; ?>
	<?php if ($mosrokomari_options['basic-styling-primary-color-border']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-primary-color-border'],',') ?> {
			border-color: <?php echo $mosrokomari_options['basic-styling-primary-color']; ?> !important;
		}
	<?php endif; ?>
<?php endif; ?>
<?php if ($mosrokomari_options['basic-styling-secondary-color']) : ?>
	<?php if ($mosrokomari_options['basic-styling-secondary-color-background']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-secondary-color-background'],',') ?> {
			background-color: <?php echo $mosrokomari_options['basic-styling-secondary-color']; ?>;
		}
	<?php endif; ?>
	<?php if ($mosrokomari_options['basic-styling-secondary-color-text']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-secondary-color-text'],',') ?> {
			color: <?php echo $mosrokomari_options['basic-styling-secondary-color']; ?>;
		}
	<?php endif; ?>
	<?php if ($mosrokomari_options['basic-styling-secondary-color-border']) : ?>		
		<?php echo rtrim($mosrokomari_options['basic-styling-secondary-color-border'],',') ?> {
			border-color: <?php echo $mosrokomari_options['basic-styling-secondary-color']; ?> !important;
		}
	<?php endif; ?>

<?php endif; ?>
body {<?php 
	if ($mosrokomari_options['typography-body-font']['color']) echo 'color: ' . $mosrokomari_options['typography-body-font']['color'] . ';';
	if ($mosrokomari_options['typography-body-font']['font-style']) echo 'font-style: ' . $mosrokomari_options['typography-body-font']['font-style'] . ';';
	if ($mosrokomari_options['typography-body-font']['font-family']) echo 'font-family: ' . $mosrokomari_options['typography-body-font']['font-family'] . ';';
	if ($mosrokomari_options['typography-body-font']['font-size']) echo 'font-size: ' . $mosrokomari_options['typography-body-font']['font-size'] . ';';
	if ($mosrokomari_options['typography-body-font']['font-height']) echo 'line-height: ' . $mosrokomari_options['typography-body-font']['font-height'] . ';';
	if ($mosrokomari_options['typography-body-font']['font-weight']) echo 'font-weight: ' . $mosrokomari_options['typography-body-font']['font-weight'] . ';';
	?>}
.se-pre-con {
<?php if ($mosrokomari_options['misc-page-loader-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['misc-page-loader-background-gradient'])?>
<?php elseif ($mosrokomari_options['misc-page-loader-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['misc-page-loader-background-solid'])?>
<?php elseif ($mosrokomari_options['misc-page-loader-background-type'] == 3 AND $mosrokomari_options['misc-page-loader-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['misc-page-loader-background-rgba'])?>
<?php endif; ?>}
#top-header {
<?php if ($mosrokomari_options['header-top-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['header-top-background-gradient'])?>
<?php elseif ($mosrokomari_options['header-top-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['header-top-background-solid'])?>
<?php elseif ($mosrokomari_options['header-top-background-type'] == 3 AND $mosrokomari_options['header-top-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['header-top-background-rgba'])?>
<?php endif; ?>}
#main-header {
<?php if ($mosrokomari_options['header-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['header-background-gradient'])?>
<?php elseif ($mosrokomari_options['header-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['header-background-solid'])?>
<?php elseif ($mosrokomari_options['header-background-type'] == 3 AND $mosrokomari_options['header-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['header-background-rgba'])?>
<?php endif; ?>}
#nav-area,
#nav-area .sub-menu li,
.small-header .small-nav .small-menu {
<?php if ($mosrokomari_options['header-menu-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['header-menu-background-gradient'])?>
<?php elseif ($mosrokomari_options['header-menu-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['header-menu-background-solid'])?>
<?php elseif ($mosrokomari_options['header-menu-background-type'] == 3 AND $mosrokomari_options['header-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['header-menu-background-rgba'])?>
<?php endif; ?>}
.small-header .small-nav .mobile-menu {
<?php if ($mosrokomari_options['small-menu-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['small-menu-background-gradient'])?>
<?php elseif ($mosrokomari_options['small-menu-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['small-menu-background-solid'])?>
<?php elseif ($mosrokomari_options['small-menu-background-type'] == 3 AND $mosrokomari_options['small-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['small-menu-background-rgba'])?>
<?php endif; ?>}
#page-title {
<?php if ($mosrokomari_options['sections-title-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-title-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-title-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-title-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-title-background-type'] == 3 AND $mosrokomari_options['sections-title-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-title-background-rgba'])?>
<?php endif; ?>}
#section-breadcrumbs {
<?php if ($mosrokomari_options['sections-breadcrumbs-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-breadcrumbs-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-breadcrumbs-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-breadcrumbs-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-breadcrumbs-background-type'] == 3 AND $mosrokomari_options['sections-breadcrumbs-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-breadcrumbs-background-rgba'])?>
<?php endif; ?>}
#section-banner {
<?php if ($mosrokomari_options['sections-banner-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-banner-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-banner-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-banner-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-banner-background-type'] == 3 AND $mosrokomari_options['sections-banner-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-banner-background-rgba'])?>
<?php endif; ?>}
.page-content {
<?php if ($mosrokomari_options['sections-content-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-content-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-content-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-content-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-content-background-type'] == 3 AND $mosrokomari_options['sections-content-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-content-background-rgba'])?>
<?php endif; ?>}
#section-service {
<?php if ($mosrokomari_options['sections-service-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-service-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-service-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-service-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-service-background-type'] == 3 AND $mosrokomari_options['sections-service-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-service-background-rgba'])?>
<?php endif; ?>}
#section-achievement {
<?php if ($mosrokomari_options['sections-achievement-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-achievement-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-achievement-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-achievement-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-achievement-background-type'] == 3 AND $mosrokomari_options['sections-achievement-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-achievement-background-rgba'])?>
<?php endif; ?>}
#section-whowe {
<?php if ($mosrokomari_options['sections-whowe-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-whowe-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-whowe-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-whowe-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-whowe-background-type'] == 3 AND $mosrokomari_options['sections-whowe-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-whowe-background-rgba'])?>
<?php endif; ?>}
#section-partner {
<?php if ($mosrokomari_options['sections-partner-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-partner-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-partner-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-partner-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-partner-background-type'] == 3 AND $mosrokomari_options['sections-partner-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-partner-background-rgba'])?>
<?php endif; ?>}
#section-video {
<?php if ($mosrokomari_options['sections-video-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-video-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-video-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-video-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-video-background-type'] == 3 AND $mosrokomari_options['sections-video-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-video-background-rgba'])?>
<?php endif; ?>}
#section-pricing {
<?php if ($mosrokomari_options['sections-pricing-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-pricing-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-pricing-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-pricing-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-pricing-background-type'] == 3 AND $mosrokomari_options['sections-pricing-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-pricing-background-rgba'])?>
<?php endif; ?>}
#section-blog {
<?php if ($mosrokomari_options['sections-blog-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-blog-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-blog-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-blog-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-blog-background-type'] == 3 AND $mosrokomari_options['sections-blog-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-blog-background-rgba'])?>
<?php endif; ?>}
#section-button {
<?php if ($mosrokomari_options['sections-button-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-button-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-button-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-button-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-button-background-type'] == 3 AND $mosrokomari_options['sections-button-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-button-background-rgba'])?>
<?php endif; ?>}
#section-contact {
<?php if ($mosrokomari_options['sections-contact-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-contact-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-contact-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-contact-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-contact-background-type'] == 3 AND $mosrokomari_options['sections-contact-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-contact-background-rgba'])?>
<?php endif; ?>}
#section-welcome {
<?php if ($mosrokomari_options['sections-welcome-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-welcome-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-welcome-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-welcome-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-welcome-background-type'] == 3 AND $mosrokomari_options['sections-welcome-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-welcome-background-rgba'])?>
<?php endif; ?>}
#section-gallery {
<?php if ($mosrokomari_options['sections-gallery-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-gallery-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-gallery-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-gallery-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-gallery-background-type'] == 3 AND $mosrokomari_options['sections-gallery-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-gallery-background-rgba'])?>
<?php endif; ?>}
.sidebar {
<?php if ($mosrokomari_options['sections-sidebar-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-sidebar-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-sidebar-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-sidebar-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-sidebar-background-type'] == 3 AND $mosrokomari_options['sections-sidebar-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-sidebar-background-rgba'])?>
<?php endif; ?>}
#section-widgets {
<?php if ($mosrokomari_options['sections-widgets-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-widgets-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-widgets-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-widgets-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-widgets-background-type'] == 3 AND $mosrokomari_options['sections-widgets-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-widgets-background-rgba'])?>
<?php endif; ?>}
#footer {
<?php if ($mosrokomari_options['sections-footer-background-type'] == 1) : ?>
	<?php gradient_manager($mosrokomari_options['sections-footer-background-gradient'])?>
<?php elseif ($mosrokomari_options['sections-footer-background-type'] == 2) : ?>
	<?php background_manager($mosrokomari_options['sections-footer-background-solid'])?>
<?php elseif ($mosrokomari_options['sections-footer-background-type'] == 3 AND $mosrokomari_options['sections-footer-background-rgba']['rgba']) : ?>
	<?php rgba_manager($mosrokomari_options['sections-footer-background-rgba'])?>
<?php endif; ?>}




</style>
<?php
}
add_action( 'wp_head', 'mosrokomari_theme_css', 999, 1 );
function mosrokomari_theme_js () {
	global $mosrokomari_options; 
?>
<script>
	jQuery(document).ready(function($) {
	<?php if ($mosrokomari_options['misc-cts-number']) : ?>
	<?php $text = ($mosrokomari_options['misc-cts-text']) ? ($mosrokomari_options['misc-cts-text']) : 'Show Number';?>
	<?php $limit = ($mosrokomari_options['misc-cts-limit']) ? $mosrokomari_options['misc-cts-limit'] : 2 ?>
		$('body').find('.clickToShow').each(function( number ) {
			var before_number = '';
			var number = $(this).attr('href').replace(/[a-z :]/gmi, "");
			var text = $(this).html();
			var numeric = text.match(/^[0-9 ]/gmi);
			if (numeric == 0){
				var slices = text.split(" ");
				var length = slices.length;
				if (length > 1) before_number = slices[0];
				else before_number = text.substring(0, <?php echo $limit?>);
				$( this ).css('display', 'none').after('<a class="clickToShowBtn" href="javascript:void(0)">'+before_number+' <?php echo $text ?>'+'</a>');
			}
		});

		$('.clickToShowBtn').click(function(){
		    $(this).toggle();
		    $(this).siblings('.clickToShow').toggle();
		});
	<?php endif; ?>
	<?php if ($mosrokomari_options['misc-cts-small-number'] AND $mosrokomari_options['misc-cts-small-number-text']) : ?>
		$('body').find('.phoneToShow').each(function( number ) {
			var text = $(this).html();
			<?php 
			$bign = 'hidden-xs hidden-sm hidden-md hidden-lg';
			$smalln = '';
			foreach ($mosrokomari_options['misc-cts-small-number-devices'] as $device => $value) {
				if ($value) {
					$smalln .= $device . ' ';
					$bign = str_replace($device,"",$bign);
				}
			} 
			?>
			$( this ).html('<span class="<?php echo $smalln ?>">' + text + '</span>' + '<span class="<?php echo $bign ?>">' + '<?php echo  $mosrokomari_options['misc-cts-small-number-text'] ?>' + '</span>')
		});
	<?php endif; ?>
	<?php if ($mosrokomari_options['misc-cts-small-email'] AND $mosrokomari_options['misc-cts-small-email-text']) : ?>
		$('body').find('.mailToShow').each(function( number ) {
			var text = $(this).html();
			<?php 
			$big = 'hidden-xs hidden-sm hidden-md hidden-lg';
			$small = '';
			foreach ($mosrokomari_options['misc-cts-small-email-devices'] as $device => $value) {
				if ($value) {
					$small .= $device . ' ';
					$big = str_replace($device,"",$big);
				}
			} 
			?>
			$( this ).html('<span class="<?php echo $small ?>">' + text + '</span>' + '<span class="<?php echo $big ?>">' + '<?php echo  $mosrokomari_options['misc-cts-small-email-text'] ?>' + '</span>')
		});
	<?php endif; ?>
		var owl_banner_owl = $('#section-banner-owl');
		owl_banner_owl.owlCarousel({
		    loop: true,
		    nav: true,
		    dots: true,
		    items:1,
		    margin: 0,	    	    
		    lazyLoad: true,
		    autoplay: true,
		    autoplayTimeout: 6000,
		    autoplayHoverPause: true,
		});
	<?php $service_layout = ($mosrokomari_options['sections-service-layout']) ? $mosrokomari_options['sections-service-layout'] : 3; ?>
		var owl_service_owl = $('#section-service-owl');
		owl_service_owl.owlCarousel({
		    loop: true,
		    nav: true,
		    dots: true,
		    margin: 0,	    	    
		    lazyLoad: true,
		    autoplay: true,
		    autoplayTimeout: 6000,
		    autoplayHoverPause: true,
		<?php if($service_layout ==1) : ?>
			items:1,
		<?php else : ?>
			responsive:{
				0: {
		    		items:2,
				},
				992: {
		    		items:3,
				},
				1200: {
		    		items:<?php echo $service_layout ?>,
				}
			}
		<?php endif; ?>
		});
		<?php 
		$blog_layout = ($mosrokomari_options['sections-blog-layout']) ? $mosrokomari_options['sections-blog-layout'] : 3; 
		?>
		var owl_blog_owl = $('#section-blog-owl');
		owl_blog_owl.owlCarousel({
		    loop: true,
		    nav: true,
		    dots: true,
		    margin: 0,	    	    
		    lazyLoad: true,
		    autoplay: true,
		    autoplayTimeout: 6000,
		    autoplayHoverPause: true,
		<?php if($blog_layout ==1) : ?>
			items:1,
		<?php else : ?>
			responsive:{
				0: {
		    		items:1,
				},
				992: {
		    		items:2,
				},
				1200: {
		    		items:<?php echo $blog_layout ?>,
				}
			}
		<?php endif; ?>		
		});
		<?php 
		$gallery_layout = ($mosrokomari_options['sections-gallery-layout']) ? $mosrokomari_options['sections-gallery-layout'] : 3; 
		?>
		var owl_gallery_owl = $('#section-gallery-owl');
		owl_gallery_owl.owlCarousel({
		    loop: true,
		    nav: true,
		    dots: true,
		    margin: 0,	    	    
		    lazyLoad: true,
		    autoplay: true,
		    autoplayTimeout: 6000,
		    autoplayHoverPause: true,
		<?php if($gallery_layout ==1) : ?>
			items:1,
		<?php else : ?>
			responsive:{
				0: {
		    		items:1,
				},
				992: {
		    		items:2,
				},
				1200: {
		    		items:<?php echo $gallery_layout ?>,
				}
			}
		<?php endif; ?>
		});
	});
</script>
	<?php
}
add_action( 'wp_footer', 'mosrokomari_theme_js', 998, 1 );