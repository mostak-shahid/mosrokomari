<?php
function admin_shortcodes_page(){
	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null )
    add_menu_page( 
        __( 'Theme Short Codes', 'textdomain' ),
        'Short Codes',
        'manage_options',
        'shortcodes',
        'shortcodes_page',
        'dashicons-book-alt',
        3
    ); 
}
add_action( 'admin_menu', 'admin_shortcodes_page' );
function shortcodes_page(){
	?>
	<div class="wrap">
		<h1>Theme Short Codes</h1>
		<ol>
			<li>[site_identity class='' container_class=''] <span class="sdetagils">displays site identity according to theme option</span></li>
			<li>[site_name link='0'] <span class="sdetagils">displays site name with/without site url</span></li>
			<li>[element_start name='div' class='' id='' href='' src='' imgwidth='if only name img' imgheight='if there is imgwidth' atts=''] <span class="sdetagils">starts an element. **you can use home_url() as dynamick link**</span></li>
			<li>[element_end name='div' class='' id=''] <span class="sdetagils">ends an element</span></li>
			<li>[mosmenu container='nav' container_class='mosmenu' menu_class='mos-menu' location='' menu_name=''] <span class="sdetagils">displays menu according to configuration</span></li>
			<li>[theme_creadit icon=''] <span class="sdetagils">displays theme creadit</span></li>
			<li>[this_year] <span class="sdetagils">displays current year</span></li>
			<li>[home_url] <span class="sdetagils">displays home page URL</span></li>
			<li>[phone_number] <span class="sdetagils">displays the 1st phone number from theme option</span></li>
			<li>[social_menu google_review='' display='inline/block' title='0/1'] <span class="sdetagils">displays social media from theme option</span></li>
			<li>[feature_image wrapper_element='div' wrapper_atts='' height='' width=''] <span class="sdetagils">displays feature image of post</span></li>
			<li>[title wrapper_element='div' wrapper_atts='' link='' link_field='' link_atts=''] <span class="sdetagils">displays title of post</span></li>
			<li>[meta wrapper_element='div' wrapper_atts='' field=''] <span class="sdetagils">displays title of post</span></li>
			<li>[content wrapper_element='div' wrapper_atts='' limit='' text_after='' text='' link=''] <span class="sdetagils">displays content of post according to settings</span></li>
			<li>[post_author wrapper_element='div' wrapper_atts=''] <span class="sdetagils">displays author of post</span></li>
			<li>[post_date wrapper_element='div' wrapper_atts='' format = 'd m Y'] <span class="sdetagils">displays date of post</span></li>
			<li>[address offset=0 map=0 address=1] <span class="sdetagils">displays address from theme option</span></li>
			<li>[email offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays email from theme option</span></li>
			<li>[phone offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays phone from theme option</span></li>
			<li>[fax offset=0 index=0 all=1 seperator=', '] <span class="sdetagils">displays fax from theme option</span></li>
			<li>[hours] <span class="sdetagils">displays business hours from theme option</span></li>
			<li>[product_search] <span class="sdetagils">displays product search form</span></li>
			<li>[mos_post post_type='post/custom post type' taxonomy='' terms='' count='-1' grid='' format='title, content, meta:meta_field_name']<span class="sdetagils">displays post with shortcode</span></li>
			<li>[wp_login_form]<span class="sdetagils">displays login form if user is not logged in</span></li>

		</ol>
	</div>
	<?php
}

function site_identity_func( $atts = array(), $content = null ) {
	global $mosrokomari_options;
	$logo_url = ($mosrokomari_options['logo']['url']) ? $mosrokomari_options['logo']['url'] : get_template_directory_uri(). '/images/logo.png';
	$logo_option = $mosrokomari_options['logo-option'];
	
	$atts = shortcode_atts( array(
		'class' => '',
		'container_class' => ''
	), $atts, 'site_logo' ); 
	if($logo_option == 'logo') :
		list($width, $height) = getimagesize($logo_url);
		return '<div class="'.$atts['container_class'].'">
					<div class="site-branding '.$atts['class'].'">
	                    <a class="logo" href="'.home_url().'"><img src="'.$logo_url.'" alt="'.get_bloginfo('name').' - Logo" width="'.$width.'" height="'.$height.'"></a> 
	                </div>
	            </div>'; 
	else :
		return '<div class="'.$atts['container_class'].'">
					<div class="site-branding '.$atts['class'].'">                              
		                <div class="logo-text">            
		                    <h1 class="site-title"><a href="'.home_url().'">'.get_bloginfo('name').'</a></h1>
		                    <p class="site-description">'.get_bloginfo( 'description' ).'</p>
		                </div>
		            </div>  
				</div>'; 
	endif;
}
add_shortcode( 'site_identity', 'site_identity_func' );

function site_name_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'link' => 0,
	), $atts, 'site_name' );
	if ($atts['link']) $html .=	'<a href="'.esc_url( home_url( '/' ) ).'">';
	$html .= get_bloginfo('name');
	if ($atts['link']) $html .=	'</a>';
	return $html;
}
add_shortcode( 'site_name', 'site_name_func' );

function element_start_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'name' => 'div',
		'class' => '',
		'id' => '',
		'href' => '',
		'src' => '',
		'imgwidth' => '',
		'imgheight' => '',
		'atts' => '',
	), $atts, 'element_start' ); 
	$html = '<'.$atts['name'];
	if($atts['id']) $html .= ' id="'.$atts['id'].'"';
	if($atts['class']) $html .= ' class="'.$atts['class'].'"';
	if ($atts['name'] == 'a' AND $atts['href']) {
		$html .= ' href="'. str_replace('home_url()', home_url(), $atts['href']).'"';
	}

	if($atts['name'] == 'img' AND $atts['src']){
		if($atts['imgwidth'] AND  $atts['imgheight'])
			$html .= ' src="'.aq_resize(str_replace('home_url()', home_url(), $atts['src']), $atts['imgwidth'], $atts['imgheight'], true).'"';
		elseif($atts['imgwidth'])
			$html .= ' src="'.aq_resize(str_replace('home_url()', home_url(), $atts['src']), $atts['imgwidth'], '', true).'"';
		else 
			$html .= ' src="'. str_replace('home_url()', home_url(), $atts['src']).'"';
	}	
	if($atts['atts']) $html .= ' '.$atts['atts'];
	$html .= ' >';

	return $html;
}
add_shortcode( 'element_start', 'element_start_func' );

function element_end_func( $atts = array(), $content = '' ) {	
	$atts = shortcode_atts( array(
		'name' => 'div',
		'class' => '',
		'id' => ''
	), $atts, 'site_logo' ); 	
	$html = '</'.$atts['name'].'><!--/'.$atts['name'];
	if($atts['id']) $html .= '#'.$atts['id'];
	if($atts['class']) $html .= '.'.$atts['class'];
	$html .= '-->';

	return $html;
}
add_shortcode( 'element_end', 'element_end_func' );

function mosmenu_func( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
	    'container'         => 'nav',
	    'container_class'   => 'mosmenu',
	    'menu_class'        => 'mos-menu',
	    'location'        	=> '',
	    'menu_name'        	=> '',
	), $atts, 'mosmenu' );
    return wp_nav_menu( array(
        'menu'              => $atts['menu_name'],
        'theme_location'    => $atts['location'],
        'container'         => $atts['container'],
        'container_class'   => $atts['container_class'],
        'menu_class'        => $atts['menu_class'],
        'fallback_cb'       => 'mos_link_to_menu_editor',
        'echo'				=> false 
        )
    );
}
add_shortcode( 'mosmenu', 'mosmenu_func' );

function theme_creadit_func( $atts = array(), $content = '' ) {
	$html = "";
	$atts = shortcode_atts( array(
		'icon' => '',
	), $atts, 'theme_creadit' );
	$html .= '<div class="copyright">';
	$html .= '&copy; '. date("Y") .' <a href="'.esc_url( home_url( '/' ) ).'"> '.get_bloginfo('name') .'</a>. All Rights Reserved. ';
	if ($atts['icon']){		
		$icon = str_replace('home_url()', home_url(), $atts['icon']);
		list($width, $height) = getimagesize($icon);
		$html .= '<img class="belocal-icon" src="'. $icon . '" alt="BeLocal Today Logo" width="'.$width.'" height="'.$height.'">';
	}
	$html .= 'Digital Transformation by <a href="https://www.belocal.today/" class="belocal" target="_blank" >BeLocal Today</a>';
	$html .= '</div>';
	return $html;
}
add_shortcode( 'theme_creadit', 'theme_creadit_func' );
	
function this_year_func( $atts = array(), $content = '' ) {
	return date('Y');
}
add_shortcode( 'this_year', 'this_year_func' );

function mos_home_url( $atts ){
    return home_url('');
}
add_shortcode( 'home_url', 'mos_home_url' );

function mos_phone_number( $atts, $content = null ) {
    global $mosrokomari_options;
    $html = '';
    $default = shortcode_atts( array(
        'number' => $mosrokomari_options['contact-phone']['0'],
    ), $atts );
    $html .= '<span class="phone-number">';
    $html .= '<a class="phoneToShow" href="tel:';
    if ($default['number'])
        $html .= preg_replace('/[^0-9]/', '', $default['number']);
    else 
    	$html .= preg_replace('/[^0-9]/', '', $mosrokomari_options['contact-phone']['0']);
    $html .= '" >';
    if (!$content)
    	$html .= $mosrokomari_options['contact-phone']['0'];
	else
	    $html .= $content;    	
    $html .= '</a>';
    $html .= '</span>';
    return $html;
}
add_shortcode( 'phone_number', 'mos_phone_number' );

function social_menu_fnc( $atts = array(), $content = '' ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
		$alt_tag = mos_alt_generator(get_the_ID());
	} 
	global $mosrokomari_options;
	$html = '';
	$contact_social = $mosrokomari_options['contact-social'];
	$contact_address = $mosrokomari_options['contact-address'];
	$atts = shortcode_atts( array(
		'google_review' => '',
		'display' => '',
		'title' => 1,
	), $atts, 'social_menu' );
	if ($atts['display'] == 'inline') $display = 'list-inline';
	else  $display = 'list-unstyled';
	$html .= '<ul class="'.$display.' social-menu">';
	foreach ($contact_social as $social) :	
		if ($social['link_url'] AND $social['basic_icon']) :
			$str = '';
			if (filter_var(do_shortcode($social['basic_icon']), FILTER_VALIDATE_URL)) {
				$basic_icon = do_shortcode($social['basic_icon']);
				list($width, $height) = getimagesize($basic_icon);
				$str = '<span class="social-img"><img src="'.$basic_icon.'" alt="'.$alt_tag['social'] . $social['title'].'" width="'.$width.'" height="'.$height.'"></span>';
				if ($social['hover_icon']) {
					$hover_icon = do_shortcode($social['hover_icon']);
					list($hwidth, $hheight) = getimagesize($hover_icon);
					$str .= '<span class="social-img-hover"><img src="'.$hover_icon.'" alt="'.$alt_tag['social'] . $social['title'].'" width="'.$hwidth.'" height="'.$hheight.'"></span>'; //hover_icon
				}
			}
			else { 
				$str = '<span class="social-icon"><i class="'.$social['basic_icon'].'"></i></span>';
				if ($social['hover_icon'])
					$str .= '<span class="social-icon-hover"><i class="'.$social['hover_icon'].'"></i></span>';
			}
			$html .= '<li class="social-list '.strtolower(preg_replace('/\s+/', '_', $social['title'])).'"><a href="'.esc_url( $social['link_url'] ).'"';
			if ($social['target'])
				$html .= ' target="_blank"';
			$html .= '>' . $str;
			if ($atts['title']) $html .= '<span class="social-title">' . $social['title'] .'</span>';
			$html .= '</a></li>';
		endif;	
	endforeach;
	if ($atts['google_review']) {
		foreach ($contact_address as $address) {
			if ($address['review_link'] AND $address['review_link_img']) {
				$review_link_img = do_shortcode($address['review_link_img']);
				list($gwidth, $gheight) = getimagesize($review_link_img);

				$html .= '<li class="social-review"><a href="'. esc_url( $address['review_link']) .'" target="_blank"><span class="social-img"><img src="'.do_shortcode($address['review_link_img']).'" alt="'.$alt_tag['social'] . 'Google Review" width="'.$gwidth.'" height="'.$gheight.'"></span>';
				if ($address['review_link_img_h']) {					
					$review_link_img_h = do_shortcode($address['review_link_img_h']);
					list($ghwidth, $ghheight) = getimagesize($review_link_img_h);
					$html .= '<span class="social-img-hover"><img src="'. esc_url( do_shortcode($address['review_link_img_h'])).'" alt="'.$alt_tag['social'] . 'Google Review" width="'.$ghwidth.'" height="'.$ghheight.'"></span>';
				}
				if ($atts['title']) $html .= '<span class="social-title">Google Review</span>';
				$html .= '</a></li>';
			}
		}
	}

	$html .= '</ul>';
	return $html;
}
add_shortcode( 'social_menu', 'social_menu_fnc' );

function feature_image_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'div',
		'wrapper_atts' => '',
		'height' => '',
		'width' => '',
	), $atts, 'feature_image' );

	if (has_post_thumbnail()):
		if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
		if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
		if ($atts['wrapper_element']) $html .= '>';
		list($width, $height) = getimagesize(get_the_post_thumbnail_url());
		if ($atts['width'] AND $atts['height']) :
			if ($width > $atts['width'] AND $height > $atts['height']) $img = aq_resize(get_the_post_thumbnail_url(), $atts['width'], $atts['height'], true);
			else $img = get_the_post_thumbnail_url();
		else : 
			$img = get_the_post_thumbnail_url();
		endif;
		list($fwidth, $fheight) = getimagesize($img);
		$html .= '<img class="img-responsive img-featured" src="'.$img.'" alt="'.get_the_title().'" width="'.$fwidth.'" height="'.$fheight.'" />';
		if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';		
	endif;
	return $html;
}
add_shortcode( 'feature_image', 'feature_image_func' );

function title_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'div',
		'wrapper_atts' => '',
		'link' => '',
		'link_field' => '',
		'link_atts' => '',
	), $atts, 'title' );
	if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
	if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
	if ($atts['wrapper_element']) $html .= '>';
	if ($atts['link'] == true ) {
		$html .= '<a ' . $atts['link_atts'] . ' href="';
		if ($atts['link_field']) $html .= ( get_post_meta( get_the_ID(), $atts['link_field'], true ) ) ? get_post_meta( get_the_ID(), $atts['link_field'], true ) : 'javascript:void(0)';
		else $html .= get_the_permalink();
		$html .= '">';
	}
	$html .= get_the_title();
	if ($atts['link'] == true ) $html .= '</a>';
	if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	return $html;
}
add_shortcode( 'title', 'title_func' );

function meta_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'div',
		'wrapper_atts' => '',
		'field' => '',
	), $atts, 'meta' );
	$value = get_post_meta( get_the_ID(), $atts['field'], true );
	if ($value) :
		if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
		if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
		if ($atts['wrapper_element'] == 'a') $html .= ' href="'. $value . '"';
		if ($atts['wrapper_element']) $html .= '>';
		$html .= $value;
		if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	endif;
	return $html;
}
add_shortcode( 'meta', 'meta_func' );

function content_func( $atts = array(), $content = '' ) {
	$html = '';
	// limit='30'  text='Read More' link='true'
	$atts = shortcode_atts( array(
		'wrapper_element' => 'div',
		'wrapper_atts' => '',
		'limit' => 0,
		'text_after' => '',
		'text' => 'Read More',
		'link' => 0,
	), $atts, 'content' );
	if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
	if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
	if ($atts['wrapper_element']) $html .= '>';
	$html .= '<span class="con-wrap">';
	if ($atts['limit']) $html .= wp_trim_words(get_the_content(), $atts['limit'], $atts['text_after']);
	else $html .= wpautop(get_the_content());
	$html .= "</span>";
	if ($atts['link'] AND $atts['text'] )
		$html .= '<span class="link-wrapper"><a href="'.get_the_permalink().'" class="blog-read-more">'.$atts['text'].'</a></span>';
	if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	return $html;
}
add_shortcode( 'content', 'content_func' );

function post_author_func( $atts = array(), $post_author = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'span',
		'wrapper_atts' => 'class="post-author"',
	), $atts, 'post_author' );
	if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
	if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
	if ($atts['wrapper_element']) $html .= '>';
	$html .= get_the_author();
	if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	return $html;
}
add_shortcode( 'post_author', 'post_author_func' );

function post_date_func( $atts = array(), $post_date = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'wrapper_element' => 'span',
		'wrapper_atts' => 'class="post-time"',
		'format' => 'd m Y',
	), $atts, 'post_date' );
	if ($atts['wrapper_element']) $html .= '<'. $atts['wrapper_element'];
	if ($atts['wrapper_atts']) $html .= ' ' . $atts['wrapper_atts'];
	if ($atts['wrapper_element']) $html .= '>';
	$html .= get_the_time($atts['format']);
	if ($atts['wrapper_element']) $html .= '</'. $atts['wrapper_element'] . '>';
	return $html;
}
add_shortcode( 'post_date', 'post_date_func' );

function address_func( $atts = array(), $content = '' ) {
	global $mosrokomari_options;
	$contact_address = $mosrokomari_options['contact-address'];
	$html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'map' => 0,
		'address' => 1
	), $atts, 'address' );
	$n = 1;
	$html .= '<span class="address-wrap">'; 
	foreach ($contact_address as $address) :
	$html .= '<span class="address">';
		if ($n > $atts['offset']) :
			if ($address[map_link]) $html .= '<a target="_blank" href="'.$address[map_link].'">';
			if ($atts['map']) :		
				$html .= '<span class="img-part">';
					$html .= '<img class="img-responsive img-map" src="'.$address[image].'" alt="">';
				$html .= '</span>';
			endif;
			if ($atts['address']) :	
				$html .= '<span class="text-part">';
					$html .= $address['description'];
				$html .= '</span>';
			endif;
			if ($address[map_link]) $html .= '</a>';	

		endif;
		$n++;		
	$html .= '</span>';
	endforeach;
	$html .= '</span>';
	return $html;
}
add_shortcode( 'address', 'address_func' );

function email_func( $atts = array(), $content = '' ) {	
	global $mosrokomari_options;
	$contact_email = $mosrokomari_options['contact-email'];
	$html = '';	
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', ',
	), $atts, 'email' );
	$n = 1;

	$html .= '<span class="email-wrap">';
	if ($atts['index']) :
		$i = $atts['index'] - 1;
		$html .= '<span class="email">';
			$html .= '<a class="mailToShow" href="mailto:'.$contact_email[$i].'">'.$contact_email[$i].'</a>';
		$html .= '</span>';	
	else :
		foreach ($contact_email as $email) :
			if ($atts['offset'] AND $n > $atts['offset']) :
				$html .= '<span class="email">';
					$html .= '<a class="mailToShow" href="mailto:'.$email.'">'.$email.'</a>';
				$html .= '</span>';
				$html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;
}
add_shortcode( 'email', 'email_func' );

function phone_func( $atts = array(), $content = '' ) {
    global $mosrokomari_options;
    $html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', '
	), $atts, 'phone' );
	$n = 1; 
	$html .= '<span class="phone-number-wrap">';
	if ($atts['index']) :
		$i = $atts['index'] - 1;
	    $html .= '<span class="phone-number">';
	    $html .= '<a class="phoneToShow" href="tel:';
	    $html .= preg_replace('/[^0-9]/', '', $mosrokomari_options['contact-phone'][$i]);
	    $html .= '" >';
	    $html .= $mosrokomari_options['contact-phone'][$i];  
	    $html .= '</a>';
	    $html .= '</span>';		
	else :
		foreach ($mosrokomari_options['contact-phone'] as $phone) :
			if ($n > $atts['offset']) :
			    $html .= '<span class="phone-number">';
			    $html .= '<a class="phoneToShow" href="tel:';
			    $html .= preg_replace('/[^0-9]/', '', $phone);
			    $html .= '" >';
			    $html .= $phone;  
			    $html .= '</a>';
			    $html .= '</span>';
			    $html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	$output .= '</span>';
	return $output;
}
add_shortcode( 'phone', 'phone_func' );

function fax_func( $atts = array(), $content = '' ) {
    global $mosrokomari_options;
    $html = '';
	$atts = shortcode_atts( array(
		'offset' => 0,
		'index' => 0,
		'all' => 1,
		'seperator' => ', '
	), $atts, 'fax' );
	$n = 1;
	if ($atts['index']) :
		$i = $atts['index'] - 1; 		    
		$html .= '<span class="fax-number">';
	    $html .= '<a class="phoneToShow" href="tel:';
	    $html .= preg_replace('/[^0-9]/', '', $fax);
	    $html .= '" >';
	    $html .= $fax;  
	    $html .= '</a>';
	    $html .= '</span>';
	else :
		foreach ($mosrokomari_options['contact-fax'] as $fax) :
			if ($n > $atts['offset']) :
			    $html .= '<span class="fax-number">';
			    $html .= '<a class="phoneToShow" href="tel:';
			    $html .= preg_replace('/[^0-9]/', '', $fax);
			    $html .= '" >';
			    $html .= $fax;  
			    $html .= '</a>';
			    $html .= '</span>';
			    $html .= $atts['seperator'];
			endif;
			$n++;
		endforeach;
	endif;
	$output = rtrim(  $html, $atts['seperator']);
	return $output;
}
add_shortcode( 'fax', 'fax_func' );

function hours_func( $atts = array(), $content = '' ) {
    global $mosrokomari_options;
    $html = '';
    $html .= '<div class="contact-hour-wrapper">'; 
    $html .= '<ul class="contact-hour">'; 
	foreach ($mosrokomari_options['contact-hour'] as $hour) :
    $html .= '<li>' . $hour . '</li>';
	endforeach;
    $html .= '</ul>'; 
    $html .= '</div>'; 

    return $html;
}
add_shortcode( 'hours', 'hours_func' );
function product_search_fnc( $atts = array(), $content = '' ) {
	$form = '';
	$form .= '<form role="search" method="get" class="woocommerce-product-search" action="'.esc_url( home_url() ).'">';
	$form .= '<div class="input-group">';
	//$form .= '<label class="screen-reader-text" for="s">Search for:</label>';
	$form .= '<input type="search" placeholder="Search Products" value="'.get_search_query().'" name="s" class="form-control" required>';
	$form .= '<span class="input-group-btn">';
	$form .= '<button type="submit" class="btn btn-default">Search</button>';
	$form .= '</span>';
	$form .= '</div>';
	$form .= '<input type="hidden" name="post_type" value="product" />';
	$form .= '</form>';
	return $form;

	/*
                <div class="input-group">
                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                    <input type="search" placeholder="Search Products" value="'.get_search_query().'" name="s" class="form-control" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
	*/
}
add_shortcode( 'product_search', 'product_search_fnc' );

function mos_post_func( $atts = array(), $content = '' ) {
	$html = '';
	$atts = shortcode_atts( array(
		'post_type' => 'post',
		'taxonomy' => '',
		'terms'	=> '',
		'count' => '-1',
		'grid' => '',
		'format' => 'title, content, meta:meta_field_name'
	), $atts, 'mos_post' );
	$count = ($atts['count']) ? $atts['count'] : '-1' ;
	$args = array(
		'posts_per_page'=> $count,
		'post_type'=> $atts['post_type']
	);
	if ($atts['taxonomy'] AND $atts['terms']) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => $atts['taxonomy'],
				'field'    => 'term_id',
				'terms'    =>  $atts['terms'],
			)
		);
	}
	$query = new WP_Query($args); 
	$count_posts = wp_count_posts($atts['post_type']);
	$total = ($count > 0)? $count : $count_posts->publish;
	$n = 1;
	if ($query -> have_posts()) : 
		if ($atts['grid'] > 1) $html .= '<div class="row">';
		while ($query -> have_posts()) : $query -> the_post(); 
			$html .= '<div class="'.$atts['post_type'].'-wrapper">';
			$slices = explode(',', str_replace(' ', '', $atts['format']));
			foreach ($slices as $slice) {
				if ($slice == 'title') {
					$html .= '<h3 class="'.$atts['post_type'].'-title">';
					$html .= get_the_title();
					$html .= '</h3><!--/.'.$atts['post_type'].'-title-->';
				} elseif ($slice == 'content') {
					$html .= '<div class="'.$atts['post_type'].'-content">';
					$html .= get_the_content();
					$html .= '</div><!--/.'.$atts['post_type'].'-content-->';					
				} elseif (preg_match("/meta:/i", $slice)) {					
					$pieces = explode(':', str_replace(' ', '', $slice));
					$html .= '<div class="'.$atts['post_type'].'-meta-'.end($pieces).'">';
					$html .= get_post_meta( get_the_ID(), end($pieces), true );
					$html .= '</div><!--/.'.$atts['post_type'].'-meta-'.end($pieces).'-->';					
				}
			}

			$html .= '</div><!--/.'.$atts['post_type'].'-wrapper-->';
			$n++;
		endwhile;
		if ($atts['grid'] > 1) $html .= '</div>';
	endif;
	wp_reset_postdata();
	return $html;
}
add_shortcode( 'mos_post', 'mos_post_func' );
function wp_login_form_fnc( $atts = array(), $content = '' ) {
	$html = '';
	// $atts = shortcode_atts( array(
	// 	'id' => 'value',
	// ), $atts, 'wp_login_form' );
$html .= '<div class="login">';
	$html .= '<form name="loginform" class="loginform" action="'.home_url().'/wp-login.php" method="post">';
		$html .= '<p>';
			$html .= '<label for="user_login">Username or Email Address<br />';
			$html .= '<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>';
		$html .= '</p>';
		$html .= '<p>';
			$html .= '<label for="user_pass">Password<br />';
			$html .= '<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>';
		$html .= '</p>';
		$html .= '<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label></p>';
		$html .= '<p class="submit">';
			$html .= '<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />';
			$html .= '<input type="hidden" name="redirect_to" value="'.home_url().'/wp-admin/" />';
			$html .= '<input type="hidden" name="testcookie" value="1" />';
		$html .= '</p>';
	$html .= '</form>';

	$html .= '<p class="nav">';
	$html .= '<a rel="nofollow" href="'.home_url().'/wp-login.php?action=register">Register</a> | 	<a href="'.home_url().'/wp-login.php?action=lostpassword">Lost your password?</a>';
	$html .= '</p>';
$html .= '</div>';
if (is_user_logged_in()) 
	return false;
return $html;
}
add_shortcode( 'wp_login_form', 'wp_login_form_fnc' );