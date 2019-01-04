<?php
global $mosrokomari_options;
$logo_option = $mosrokomari_options['logo-option'];
$logo_url = $mosrokomari_options['logo']['url'];
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_focuskw', true ) ?>">
    <meta name="description" content="<?php echo get_post_meta( get_the_ID(),'_yoast_wpseo_metadesc', true ) ?>">
    <meta name="author" content="Md. Mostak Shahid">   

    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5shiv.js"></script>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/respond.min.js"></script>
    <![endif]-->


    <?php wp_head(); ?>
    <?php //require_once ('scripts.php') ?>   
    <?php require_once ('schema.php') ?>
</head>
<body <?php body_class(); ?>>
<!-- <span class="text-danger"><?php echo get_page_template(); ?></span> -->
<?php 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_above_header', $page_details );
?>
<input id="loader-status" type="hidden" value="<?php echo $mosrokomari_options['misc-page-loader'] ?>">
<?php if ($mosrokomari_options['misc-page-loader']) : ?>
    <div class="se-pre-con">
    <?php if ($mosrokomari_options['misc-page-loader-image']['url']) : ?>
        <img class="img-responsive animation <?php echo $mosrokomari_options['misc-page-loader-image-animation'] ?>" src="<?php echo do_shortcode( $mosrokomari_options['misc-page-loader-image']['url'] ); ?>">
    <?php else : ?>
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    <?php endif; ?>
    </div>
<?php endif; ?>





    <?php echo do_shortcode( '[site_identity container_class="small-logo hidden-md hidden-lg"]' ) ?>          

    <header id="main-header">
        <div class="content-wrap hidden-xs hidden-sm">
<?php


do_action( 'action_before_header', $page_details );
echo do_shortcode( '[element_start class="row"][element_start class="col-md-3"][site_identity][element_end class="col-md-3"][element_start class="col-md-9"][mosmenu container="nav" container_class="mosmenu menu-right" menu_class="mos-menu" location="mainmenu"][element_end class="col-md-9"][element_end class="row"]' );
do_action( 'action_after_header', $page_details );

?>        

        </div>
    </header>
<?php 
do_action( 'action_below_header', $page_details );
$hide_title = get_post_meta( get_the_ID(), '_mosrokomari_page_title', true );



if (!is_front_page()) :
    $banner_image = get_post_meta( get_the_ID(), '_mosrokomari_banner_image', true );
    do_action( 'action_avobe_title', $page_details );
?>
    <section id="page-title" <?php if ($banner_image) echo 'style="background-image: url('.$banner_image.');"'?> >
        <div class="content-wrap">
            <?php do_action( 'action_before_title', $page_details ); ?>
            <span>
        	<?php 
        	if (is_home()) 
                _e($mosrokomari_options['blog-archive-title']);
            elseif (is_single()) {
                if($mosrokomari_options['single-blog-title-option'] == 2 AND $mosrokomari_options['single-blog-title'])
                    echo $mosrokomari_options['single-blog-title'];
                else the_title();
            }
            elseif (is_404()) {                    
                _e($mosrokomari_options['404-page-title']);
            }
            elseif (is_search()){
                _e('Search reasult for ');
                echo get_search_query();
            }
            elseif (is_shop() OR is_product_category()){
                _e('Shop');
            }
        	elseif(!$hide_title) the_title();
        	?>            	
            </span>
            <?php do_action( 'action_after_title', $page_details ); ?>
        </div>
    </section>
    <?php do_action( 'action_below_title', $page_details ); ?>
    <?php if ($mosrokomari_options['sections-breadcrumbs-option']) : ?>
    <?php 
    $title = $mosrokomari_options['sections-breadcrumbs-title'];
    $content = $mosrokomari_options['sections-breadcrumbs-content'];
    ?>
    <section id="section-breadcrumbs">
        <div class="content-wrap">
            <?php do_action( 'action_before_breadcrumb', $page_details ); ?>
            <?php if ($title) : ?>              
                <div class="title-wrapper">
                    <h2 class="title"><?php echo do_shortcode( $title ); ?></h2>                
                </div>
            <?php endif; ?>
            <?php if ($content) : ?>                
                <div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
            <?php endif; ?>
            <?php mos_breadcrumbs() ?>
            <?php do_action( 'action_below_breadcrumb', $page_details ); ?>
        </div>
    </section>
    <?php endif; ?>
<?php endif; ?>