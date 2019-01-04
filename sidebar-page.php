<?php global $mosrokomari_options;?>
<div class="sidebar">
	<?php
	if(is_shop()) {
		$page_id = get_option( 'woocommerce_shop_page_id' );
	} else {
		$page_id = get_the_ID();		
	} 
	$sidebar = ( get_post_meta( $page_id, '_mosrokomari_page_sidebar', true ) ) ? get_post_meta( $page_id, '_mosrokomari_page_sidebar', true ) : 'sidebar-page';
	if ( is_active_sidebar( $sidebar ) ) :
		dynamic_sidebar( $sidebar );
	endif; 
	?>
</div>