						<div id="fb-root"></div>
						<?php //Add this code to implement facebook commenting ?>
						<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));
						</script>
						<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="5" data-width="100%" data-colorscheme="light"></div>