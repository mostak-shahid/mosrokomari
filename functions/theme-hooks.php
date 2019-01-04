<?php
add_action( 'init', 'text_layout_manager' );
function text_layout_manager () {
    global $mosrokomari_options;
    //Header
    if ($mosrokomari_options['sections-header-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_header', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_header', 'start_row', 11, 1 );
        add_action( 'action_before_header', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_header', 'end_div', 10, 1 );
        add_action( 'action_after_header', 'end_div', 11, 1 );
        add_action( 'action_after_header', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-header-text-layout'] == 'container-fliud') {
        add_action( 'action_before_header', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_header', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-header-text-layout'] == 'container-full') {
        add_action( 'action_before_header', 'start_full_width', 10, 1 );
        add_action( 'action_after_header', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_header', 'start_container', 10, 1 );
        add_action( 'action_after_header', 'end_div', 10, 1 );
    }
    //Page Title
    if ($mosrokomari_options['sections-title-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_title', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_title', 'start_row', 11, 1 );
        add_action( 'action_before_title', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_title', 'end_div', 10, 1 );
        add_action( 'action_after_title', 'end_div', 11, 1 );
        add_action( 'action_after_title', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-title-text-layout'] == 'container-fliud') {
        add_action( 'action_before_title', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_title', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-title-text-layout'] == 'container-full') {
        add_action( 'action_before_title', 'start_full_width', 10, 1 );
        add_action( 'action_after_title', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_title', 'start_container', 10, 1 );
        add_action( 'action_after_title', 'end_div', 10, 1 );
    }
    //Breadcrumbs
    if ($mosrokomari_options['sections-breadcrumbs-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_breadcrumb', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_breadcrumb', 'start_row', 11, 1 );
        add_action( 'action_before_breadcrumb', 'start_container_col_10', 12, 1 );

        add_action( 'action_below_breadcrumb', 'end_div', 10, 1 );
        add_action( 'action_below_breadcrumb', 'end_div', 11, 1 );
        add_action( 'action_below_breadcrumb', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-breadcrumbs-text-layout'] == 'container-fliud') {
        add_action( 'action_before_breadcrumb', 'start_container_fluid', 10, 1 );
        add_action( 'action_below_breadcrumb', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-breadcrumbs-text-layout'] == 'container-full') {
        add_action( 'action_before_breadcrumb', 'start_full_width', 10, 1 );
        add_action( 'action_below_breadcrumb', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_breadcrumb', 'start_container', 10, 1 );
        add_action( 'action_below_breadcrumb', 'end_div', 10, 1 );
    }
    //Banner
    if ($mosrokomari_options['sections-banner-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_banner_title', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_banner_title', 'start_row', 11, 1 );
        add_action( 'action_before_banner_title', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_banner_url', 'end_div', 10, 1 );
        add_action( 'action_after_banner_url', 'end_div', 11, 1 );
        add_action( 'action_after_banner_url', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-banner-text-layout'] == 'container-fliud') {
        add_action( 'action_before_banner_title', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_banner_url', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-banner-text-layout'] == 'container-full') {
        add_action( 'action_before_banner_title', 'start_full_width', 10, 1 );
        add_action( 'action_after_banner_url', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_banner_title', 'start_container', 10, 1 );
        add_action( 'action_after_banner_url', 'end_div', 10, 1 );
    }
    //Content
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $post_id = url_to_postid( $url );
    $text_layout = ( get_post_meta( $post_id, '_mosrokomari_text_layout', true ) ) ?  get_post_meta( $post_id, '_mosrokomari_text_layout', true ) : $mosrokomari_options['sections-contact-text-layout'];
    if ($text_layout == 'container-fliud-spacing') {
        add_action( 'action_before_page', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_page', 'start_row', 11, 1 );
        add_action( 'action_before_page', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_page', 'end_div', 10, 1 );
        add_action( 'action_after_page', 'end_div', 11, 1 );
        add_action( 'action_after_page', 'end_div', 12, 1 );   
    } elseif ($text_layout == 'container-fliud') {
        add_action( 'action_before_page', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_page', 'end_div', 10, 1 );
    } elseif ($text_layout == 'container-full') {
        add_action( 'action_before_page', 'start_full_width', 10, 1 );
        add_action( 'action_after_page', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_page', 'start_container', 10, 1 );
        add_action( 'action_after_page', 'end_div', 10, 1 );
    }
    //Service
    if ($mosrokomari_options['sections-service-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_service', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_service', 'start_row', 11, 1 );
        add_action( 'action_before_service', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_service', 'end_div', 10, 1 );
        add_action( 'action_after_service', 'end_div', 11, 1 );
        add_action( 'action_after_service', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-service-text-layout'] == 'container-fliud') {
        add_action( 'action_before_service', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_service', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-service-text-layout'] == 'container-full') {
        add_action( 'action_before_service', 'start_full_width', 10, 1 );
        add_action( 'action_after_service', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_service', 'start_container', 10, 1 );
        add_action( 'action_after_service', 'end_div', 10, 1 );
    }
    //Achivement
    if ($mosrokomari_options['sections-achievement-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_achievement', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_achievement', 'start_row', 11, 1 );
        add_action( 'action_before_achievement', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_achievement', 'end_div', 10, 1 );
        add_action( 'action_after_achievement', 'end_div', 11, 1 );
        add_action( 'action_after_achievement', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-achievement-text-layout'] == 'container-fliud') {
        add_action( 'action_before_achievement', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_achievement', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-achievement-text-layout'] == 'container-full') {
        add_action( 'action_before_achievement', 'start_full_width', 10, 1 );
        add_action( 'action_after_achievement', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_achievement', 'start_container', 10, 1 );
        add_action( 'action_after_achievement', 'end_div', 10, 1 );
    }
    //Who We Are
    if ($mosrokomari_options['sections-whowe-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_whowe', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_whowe', 'start_row', 11, 1 );
        add_action( 'action_before_whowe', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_whowe', 'end_div', 10, 1 );
        add_action( 'action_after_whowe', 'end_div', 11, 1 );
        add_action( 'action_after_whowe', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-whowe-text-layout'] == 'container-fliud') {
        add_action( 'action_before_whowe', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_whowe', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-whowe-text-layout'] == 'container-full') {
        add_action( 'action_before_whowe', 'start_full_width', 10, 1 );
        add_action( 'action_after_whowe', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_whowe', 'start_container', 10, 1 );
        add_action( 'action_after_whowe', 'end_div', 10, 1 );
    }
    //Blog
    if ($mosrokomari_options['sections-blog-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_blog', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_blog', 'start_row', 11, 1 );
        add_action( 'action_before_blog', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_blog', 'end_div', 10, 1 );
        add_action( 'action_after_blog', 'end_div', 11, 1 );
        add_action( 'action_after_blog', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-blog-text-layout'] == 'container-fliud') {
        add_action( 'action_before_blog', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_blog', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-blog-text-layout'] == 'container-full') {
        add_action( 'action_before_blog', 'start_full_width', 10, 1 );
        add_action( 'action_after_blog', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_blog', 'start_container', 10, 1 );
        add_action( 'action_after_blog', 'end_div', 10, 1 );
    }
    //Partner Section
    if ($mosrokomari_options['sections-partner-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_partner', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_partner', 'start_row', 11, 1 );
        add_action( 'action_before_partner', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_partner', 'end_div', 10, 1 );
        add_action( 'action_after_partner', 'end_div', 11, 1 );
        add_action( 'action_after_partner', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-partner-text-layout'] == 'container-fliud') {
        add_action( 'action_before_partner', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_partner', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-partner-text-layout'] == 'container-full') {
        add_action( 'action_before_partner', 'start_full_width', 10, 1 );
        add_action( 'action_after_partner', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_partner', 'start_container', 10, 1 );
        add_action( 'action_after_partner', 'end_div', 10, 1 );
    }
    //Pricing Section
    if ($mosrokomari_options['sections-pricing-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_pricing', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_pricing', 'start_row', 11, 1 );
        add_action( 'action_before_pricing', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_pricing', 'end_div', 10, 1 );
        add_action( 'action_after_pricing', 'end_div', 11, 1 );
        add_action( 'action_after_pricing', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-pricing-text-layout'] == 'container-fliud') {
        add_action( 'action_before_pricing', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_pricing', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-pricing-text-layout'] == 'container-full') {
        add_action( 'action_before_pricing', 'start_full_width', 10, 1 );
        add_action( 'action_after_pricing', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_pricing', 'start_container', 10, 1 );
        add_action( 'action_after_pricing', 'end_div', 10, 1 );
    }
    //Video Section
    if ($mosrokomari_options['sections-video-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_video', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_video', 'start_row', 11, 1 );
        add_action( 'action_before_video', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_video', 'end_div', 10, 1 );
        add_action( 'action_after_video', 'end_div', 11, 1 );
        add_action( 'action_after_video', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-video-text-layout'] == 'container-fliud') {
        add_action( 'action_before_video', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_video', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-video-text-layout'] == 'container-full') {
        add_action( 'action_before_video', 'start_full_width', 10, 1 );
        add_action( 'action_after_video', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_video', 'start_container', 10, 1 );
        add_action( 'action_after_video', 'end_div', 10, 1 );
    }
    //Button
    if ($mosrokomari_options['sections-button-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_button', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_button', 'start_row', 11, 1 );
        add_action( 'action_before_button', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_button', 'end_div', 10, 1 );
        add_action( 'action_after_button', 'end_div', 11, 1 );
        add_action( 'action_after_button', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-button-text-layout'] == 'container-fliud') {
        add_action( 'action_before_button', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_button', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-button-text-layout'] == 'container-full') {
        add_action( 'action_before_button', 'start_full_width', 10, 1 );
        add_action( 'action_after_button', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_button', 'start_container', 10, 1 );
        add_action( 'action_after_button', 'end_div', 10, 1 );
    }
    //Contact
    if ($mosrokomari_options['sections-contact-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_contact', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_contact', 'start_row', 11, 1 );
        add_action( 'action_before_contact', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_contact', 'end_div', 10, 1 );
        add_action( 'action_after_contact', 'end_div', 11, 1 );
        add_action( 'action_after_contact', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-contact-text-layout'] == 'container-fliud') {
        add_action( 'action_before_contact', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_contact', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-contact-text-layout'] == 'container-full') {
        add_action( 'action_before_contact', 'start_full_width', 10, 1 );
        add_action( 'action_after_contact', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_contact', 'start_container', 10, 1 );
        add_action( 'action_after_contact', 'end_div', 10, 1 );
    }
    //Welcome
    if ($mosrokomari_options['sections-welcome-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_welcome', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_welcome', 'start_row', 11, 1 );
        add_action( 'action_before_welcome', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_welcome', 'end_div', 10, 1 );
        add_action( 'action_after_welcome', 'end_div', 11, 1 );
        add_action( 'action_after_welcome', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-welcome-text-layout'] == 'container-fliud') {
        add_action( 'action_before_welcome', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_welcome', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-welcome-text-layout'] == 'container-full') {
        add_action( 'action_before_welcome', 'start_full_width', 10, 1 );
        add_action( 'action_after_welcome', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_welcome', 'start_container', 10, 1 );
        add_action( 'action_after_welcome', 'end_div', 10, 1 );
    }
    //Team
    if ($mosrokomari_options['sections-team-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_team', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_team', 'start_row', 11, 1 );
        add_action( 'action_before_team', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_team', 'end_div', 10, 1 );
        add_action( 'action_after_team', 'end_div', 11, 1 );
        add_action( 'action_after_team', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-team-text-layout'] == 'container-fliud') {
        add_action( 'action_before_team', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_team', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-team-text-layout'] == 'container-full') {
        add_action( 'action_before_team', 'start_full_width', 10, 1 );
        add_action( 'action_after_team', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_team', 'start_container', 10, 1 );
        add_action( 'action_after_team', 'end_div', 10, 1 );
    }
    //Gallery
    if ($mosrokomari_options['sections-gallery-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_gallery', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_gallery', 'start_row', 11, 1 );
        add_action( 'action_before_gallery', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_gallery', 'end_div', 10, 1 );
        add_action( 'action_after_gallery', 'end_div', 11, 1 );
        add_action( 'action_after_gallery', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-gallery-text-layout'] == 'container-fliud') {
        add_action( 'action_before_gallery', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_gallery', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-gallery-text-layout'] == 'container-full') {
        add_action( 'action_before_gallery', 'start_full_width', 10, 1 );
        add_action( 'action_after_gallery', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_gallery', 'start_container', 10, 1 );
        add_action( 'action_after_gallery', 'end_div', 10, 1 );
    }
    //Widgets
    if ($mosrokomari_options['sections-widgets-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_widgets', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_widgets', 'start_row', 11, 1 );
        add_action( 'action_before_widgets', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_widgets', 'end_div', 10, 1 );
        add_action( 'action_after_widgets', 'end_div', 11, 1 );
        add_action( 'action_after_widgets', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-widgets-text-layout'] == 'container-fliud') {
        add_action( 'action_before_widgets', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_widgets', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-widgets-text-layout'] == 'container-full') {
        add_action( 'action_before_widgets', 'start_full_width', 10, 1 );
        add_action( 'action_after_widgets', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_widgets', 'start_container', 10, 1 );
        add_action( 'action_after_widgets', 'end_div', 10, 1 );
    }
    //Footer
    if ($mosrokomari_options['sections-footer-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_footer', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_footer', 'start_row', 11, 1 );
        add_action( 'action_before_footer', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_footer', 'end_div', 10, 1 );
        add_action( 'action_after_footer', 'end_div', 11, 1 );
        add_action( 'action_after_footer', 'end_div', 12, 1 );   
    } elseif ($mosrokomari_options['sections-footer-text-layout'] == 'container-fliud') {
        add_action( 'action_before_footer', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_footer', 'end_div', 10, 1 );
    } elseif ($mosrokomari_options['sections-footer-text-layout'] == 'container-full') {
        add_action( 'action_before_footer', 'start_full_width', 10, 1 );
        add_action( 'action_after_footer', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_footer', 'start_container', 10, 1 );
        add_action( 'action_after_footer', 'end_div', 10, 1 );
    }
    //Blog Page
    $page_for_posts = get_option( 'page_for_posts' );
    $layout = get_post_meta( $page_for_posts, '_mosrokomari_text_layout', true );
    if ($layout == 'container-fliud-spacing') {
        add_action( 'action_before_blog_page', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_blog_page', 'start_row', 11, 1 );
        add_action( 'action_before_blog_page', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_blog_page', 'end_div', 10, 1 );
        add_action( 'action_after_blog_page', 'end_div', 11, 1 );
        add_action( 'action_after_blog_page', 'end_div', 12, 1 );   
    } elseif ($layout == 'container-fliud') {
        add_action( 'action_before_blog_page', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_blog_page', 'end_div', 10, 1 );
    } elseif ($layout == 'container-full') {
        add_action( 'action_before_blog_page', 'start_full_width', 10, 1 );
        add_action( 'action_after_blog_page', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_blog_page', 'start_container', 10, 1 );
        add_action( 'action_after_blog_page', 'end_div', 10, 1 );
    }
    
}


add_action( 'action_before_team_page', 'start_container', 10, 1 );
add_action( 'action_after_team_page', 'end_div', 10, 1 );

add_action( 'action_before_team_tab_page', 'start_container', 10, 1 );
add_action( 'action_after_team_tab_page', 'end_div', 10, 1 );

add_action( 'action_before_team_tab_page', 'start_container', 10, 1 );
add_action( 'action_after_team_tab_page', 'end_div', 10, 1 );



add_action( 'action_team_archive_page', 'team_archive_page_fnc', 10, 1 );

add_action( 'action_team_archive', 'start_row', 10, 1 );
add_action( 'action_team_archive', 'team_archive_page_fnc', 20, 1 );
add_action( 'action_team_archive', 'end_div', 30, 1 );


function team_archive_page_fnc () {
    global $mosrokomari_options;
    $members = $mosrokomari_options['sections-team-slides'];
    $padding = ($mosrokomari_options['sections-team-padding']) ? '' : 'no-padding' ;
    $layout = $mosrokomari_options['sections-team-layout'];
    $count = $mosrokomari_options['sections-team-count'];
    $n = 1;
    if($layout == '3col') $colsize = 4;
    elseif($layout == '4col') $colsize = 3;
    else $colsize = 6;
    foreach ($members as $member) : ?>
        <div class="col-sm-6 col-md-<?php echo $colsize ?> <?php echo $padding ?>">
            <div class="team-unit">
            <?php if ($member['attachment_id']) {
                echo wp_get_attachment_image( $member['attachment_id'], 'team-img', false, array('class' => 'img-responsive img-centered img-team') );
                }
            ?>
                <div class="details">
                    <h2 class="name"><?php echo $member['title'] ?></h2>
                <?php if ($member['description']) : ?>
                    <p class="desc"><?php echo $member['description'] ?></p>
                <?php endif; ?>
                    <ul class="list-unstyled info">
                    <?php if($member['address']) : ?>
                        <li class="member-address"><i class="fa fa-map-marker"></i> <?php echo $member['address'] ?></li>
                    <?php endif; ?>
                    <?php if($member['organization']) : ?>
                        <li class="member-organization"><i class="fa fa-building"></i> <?php echo $member['organization'] ?></li>
                    <?php endif; ?>
                    <?php if($member['phone']) : ?>
                        <li class="member-phone"><a href="tel:<?php echo $member['phone'] ?>"><i class="fa fa-phone"></i> <?php echo $member['phone'] ?></a></li>
                    <?php endif; ?>
                    <?php if($member['email']) : ?>
                        <li class="member-email"><a href="mailto:<?php echo $member['email'] ?>"><i class="fa fa-envelope"></i> <?php echo $member['email'] ?></a></li>
                    <?php endif; ?>
                    <?php if($member['facebook']) : ?>
                        <li class="member-facebook"><a href="<?php echo $member['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                    <?php endif; ?>
                    <?php if($member['twitter']) : ?>
                        <li class="member-twitter"><a href="<?php echo $member['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
                    <?php endif; ?>
                    <?php if($member['linkedin']) : ?>
                        <li class="member-linkedin"><a href="<?php echo $member['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                    <?php endif; ?>
                    <?php if($member['google-plus']) : ?>
                        <li class="member-google-plus"><a href="<?php echo $member['google-plus'] ?>" target="_blank"><i class="fa fa-google-plus"></i> Google Plus</a></li>
                    <?php endif; ?>
                    <?php if($member['instagram']) : ?>
                        <li class="member-instagram"><a href="<?php echo $member['instagram'] ?>" target="_blank"><i class="fa fa-instagram"></i> Instagram</a></li>
                    <?php endif; ?>
                    <?php if($member['youtube']) : ?>
                        <li class="member-youtube"><a href="<?php echo $member['youtube'] ?>" target="_blank"><i class="fa fa-youtube"></i> Youtube</a></li>
                    <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php 
        if($n>=$count) break; $n++;
    endforeach;

}
add_action( 'action_team_tab_archive_page', 'start_row', 10, 1 );
add_action( 'action_team_tab_archive_page', 'action_team_tab_archive_page_fnc', 20, 1 );
add_action( 'action_team_tab_archive_page', 'end_div', 30, 1 );
function action_team_tab_archive_page_fnc () {
    global $mosrokomari_options;
    $members = $mosrokomari_options['sections-team-slides'];
    $n = 1;
    ?>
    <div class="col-md-4">
    <ul class="nav nav-pills nav-stacked">
    <?php foreach ($members as $member) : ?>
        <li <?php if($n == 1) echo 'class="active"' ?>>
            <a href="#tab-<?php echo $n ?>" data-toggle="pill">
            <?php if ($member['attachment_id']) : ?>
                <span class="small-img">
                        <?php echo wp_get_attachment_image( $member['attachment_id'], 'team-img', false, array('class' => 'img-responsive img-team', 'width'=> '80px', 'height' => '80xp') ); ?>
                </span>
            <?php endif;?>
                <span class="desc">
                <?php echo $member['title'] ?><br  />                
                <?php if($member['organization']) : ?>
                    <?php echo $member['organization'] ?>
                <?php endif; ?>
                </span>                
            </a>
        </li>
    <?php $n++; endforeach; ?>
    </ul>
    </div>
    <div class="tab-content col-md-8">
    <?php $n = 1; ?>
    <?php foreach ($members as $member) : ?>
        <div class="tab-pane <?php if($n == 1) echo 'active';?>" id="tab-<?php echo $n ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="content-part">
                        <h3><?php echo $member['title'] ?></h3>
                        <ul class="list-unstyled info">
                        <?php if($member['address']) : ?>
                            <li class="member-address"><i class="fa fa-map-marker"></i> <?php echo $member['address'] ?></li>
                        <?php endif; ?>
                        <?php if($member['organization']) : ?>
                            <li class="member-organization"><i class="fa fa-building"></i> <?php echo $member['organization'] ?></li>
                        <?php endif; ?>
                        <?php if($member['phone']) : ?>
                            <li class="member-phone"><a href="tel:<?php echo $member['phone'] ?>"><i class="fa fa-phone"></i> <?php echo $member['phone'] ?></a></li>
                        <?php endif; ?>
                        <?php if($member['email']) : ?>
                            <li class="member-email"><a href="mailto:<?php echo $member['email'] ?>"><i class="fa fa-envelope"></i> <?php echo $member['email'] ?></a></li>
                        <?php endif; ?>
                        <?php if($member['facebook']) : ?>
                            <li class="member-facebook"><a href="<?php echo $member['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <?php endif; ?>
                        <?php if($member['twitter']) : ?>
                            <li class="member-twitter"><a href="<?php echo $member['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
                        <?php endif; ?>
                        <?php if($member['linkedin']) : ?>
                            <li class="member-linkedin"><a href="<?php echo $member['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
                        <?php endif; ?>
                        <?php if($member['google-plus']) : ?>
                            <li class="member-google-plus"><a href="<?php echo $member['google-plus'] ?>" target="_blank"><i class="fa fa-google-plus"></i> Google Plus</a></li>
                        <?php endif; ?>
                        <?php if($member['instagram']) : ?>
                            <li class="member-instagram"><a href="<?php echo $member['instagram'] ?>" target="_blank"><i class="fa fa-instagram"></i> Instagram</a></li>
                        <?php endif; ?>
                        <?php if($member['youtube']) : ?>
                            <li class="member-youtube"><a href="<?php echo $member['youtube'] ?>" target="_blank"><i class="fa fa-youtube"></i> Youtube</a></li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </div> 
                <div class="col-md-6">
                    <?php if ($member['attachment_id']) {
                        echo wp_get_attachment_image( $member['attachment_id'], 'team-img', false, array('class' => 'img-responsive img-centered img-team') );
                        }
                    ?>
                
                </div> 
            </div>


        <?php if ($member['description']) : ?>
            <p class="desc"><?php echo $member['description'] ?></p>
        <?php endif; ?>
        </div>
    <?php $n++; endforeach; ?>
    </div><!-- tab content -->
    <?php 
}






add_action( 'action_before_section_blog_loop_item', 'action_before_general_blog_loop_item_fnc', 10, 1 );
function action_before_general_blog_loop_item_fnc () {
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
    $alt_tag = mos_alt_generator(get_the_ID());
} 
    ?>

        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
    if (has_post_thumbnail()):
        $attachment_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
    ?>
        <div class="blog-img-container">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('col-4-full', array('class' => 'img-responsive img-blog img-centered', 'alt' => $alt_tag['inner'] . get_the_title()))?></a>
        </div>
    <?php endif;
}

add_action( 'action_before_section_blog_loop_item_title', 'action_before_general_blog_loop_item_title_fnc', 10, 1 );
function action_before_general_blog_loop_item_title_fnc () {
    ?>
    <div class="content blog">
    <?php
}
add_action( 'action_section_blog_loop_item_title', 'action_blog_loop_general_item_title_fnc', 10, 1 );
function action_blog_loop_general_item_title_fnc () {
    if (is_single()) : ?>
        <h2 class="blog-title" title="<?php the_title(); ?>"><?php the_title(); ?></h2>
    <?php else : ?>
        <h2 class="blog-title" title="<?php the_title(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h2>
    <?php endif;
}
add_action( 'action_after_blog_section_loop_item_title', 'action_general_post_meta_fnc', 5, 1 );
add_action( 'action_after_blog_section_loop_item_title', 'action_general_post_content_fnc', 10, 1 );
function action_general_post_meta_fnc () {
    global $mosrokomari_options;
    if($mosrokomari_options['blog-archive-meta']) : ?>
        <ul class="list-unstyled post-meta">
            <?php if($mosrokomari_options['blog-archive-meta-options']['author']) : ?>
                <li><i class="fa fa-user"></i> <?php echo ucfirst(get_the_author()); ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['date']) : ?>
                <li><i class="fa fa-calendar"></i> <?php echo get_the_date('j M Y');  ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['tags']) : ?>
                <!-- <li><?php the_category( ', ' ); ?></li> -->
                <li><?php the_tags( '<i class="fa fa-tags"></i> Tags: ', ', ' ); ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['comment']) : ?>
                <li><i class="fa fa-comments"></i> <?php comments_popup_link( '0 Comments', '1 Comment', '% Comments' ); ?></li>
            <?php endif; ?>
        </ul>
    <?php endif;
}
function action_general_post_content_fnc() {
    global $mosrokomari_options; 
    $excerpt = $mosrokomari_options['blog-use-excerpt'];
    $limit = $mosrokomari_options['blog-use-excerpt-limit'];
    $readmore = $mosrokomari_options['blog-use-excerpt-readmore-text'];
    //edit_post_link( 'Edit Post' );
    if (is_single() OR !$excerpt) : ?>
        <div class="desc"><?php the_content()?></div>        
    <?php else: ?>
        <div class="desc"><?php echo wp_trim_words(get_the_content(), $limit, '')?></div>
        <a href="<?php the_permalink(); ?>" class="btn btn-blog"><?php echo $readmore?></a>
    <?php endif;
}
add_action( 'action_after_blog_section_loop_item', 'action_after_general_blog_loop_item_fnc', 10, 1 );
function action_after_general_blog_loop_item_fnc () {
    ?>
        </div>
    </div>
    <?php 
}

/*Final Blog looping*/
add_action( 'action_before_blog_page_loop_item', 'post_wrapper_start_fnc', 10, 1 );
add_action( 'action_before_blog_page_loop_item', 'post_img_container_start_fnc', 20, 1 );

add_action( 'action_before_blog_page_loop_item_title', 'post_thumbnail_fnc', 10, 1 );
add_action( 'action_before_blog_page_loop_item_title', 'post_meta_fnc', 20, 1 );
add_action( 'action_before_blog_page_loop_item_title', 'end_div', 30, 1 );

add_action( 'action_blog_page_loop_item_title', 'action_blog_loop_general_item_title_fnc', 10, 1 );
add_action( 'action_after_blog_page_loop_item_title', 'action_general_post_content_fnc', 10, 1 );
add_action( 'action_after_blog_page_loop_item_title', 'action_general_post_content_fnc', 10, 1 );


add_action( 'action_after_page_blog_loop_item', 'end_div', 10, 1 );/*end of post_wrapper_start_fnc*/

function post_wrapper_start_fnc () {
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php 
}
function post_img_container_start_fnc () {
    ?>
    <div class="blog-img-container">
    <?php 
}
function post_thumbnail_fnc() {
	global $mosrokomari_options;
    ?>

    <?php 
    if (has_post_thumbnail()):
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
            $alt_tag = mos_alt_generator(get_the_ID());
        } 
        ?>
    	<?php if (is_single()) : ?>
        	<?php if($page_layout != 'ns') : ?>
        		<?php the_post_thumbnail('blog-image', array('class' => 'img-responsive img-blog img-centered', 'alt' => $alt_tag['inner'] . get_the_title()))?>
        	<?php else : ?>
        		<?php the_post_thumbnail('blog-image-full', array('class' => 'img-responsive img-blog img-centered', 'alt' => $alt_tag['inner'] . get_the_title()))?>
        	<?php endif; ?>
        <?php else : ?>
        	<?php
        	$img_url = get_the_post_thumbnail_url();
        	$width = ( $mosrokomari_options['blog-archive-grid-img']['width'] ) ? $mosrokomari_options['blog-archive-grid-img']['width'] : '750';
        	$height = ( $mosrokomari_options['blog-archive-grid-img']['height'] ) ? $mosrokomari_options['blog-archive-grid-img']['height'] : '750';
        	?>
        	<a href="<?php the_permalink() ?>"><img src="<?php echo aq_resize($img_url, $width, $height, true) ?>" alt="<?php echo $alt_tag['inner'] . get_the_title() ?>"></a>
        <?php endif ?>
    <?php endif;
}
function post_meta_fnc () {
    global $mosrokomari_options;
    if($mosrokomari_options['blog-archive-meta']) : ?>
        <ul class="list-unstyled post-meta">
            <?php if($mosrokomari_options['blog-archive-meta-options']['date']) : ?>
                <li class="date"><i class="fa fa-calendar"></i> <?php echo get_the_date('j M Y');  ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['author']) : ?>
                <li class="author"><i class="fa fa-user"></i> <?php echo ucfirst(get_the_author()); ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['tags']) : ?>
                <li class="tags"><?php the_tags( '<i class="fa fa-tags"></i> ', ', ' ); ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['categories']) : ?>
                <li class="categories"><i class="fa fa-folder"></i> <?php the_category( ', ' ); ?></li>
            <?php endif; ?>
            <?php if($mosrokomari_options['blog-archive-meta-options']['comment']) : ?>
                <li class="comments"><i class="fa fa-comments"></i> <?php comments_popup_link( '0 Comments', '1 Comment', '% Comments' ); ?></li>
            <?php endif; ?>
        </ul>
    <?php endif;
}


add_action( 'action_before_contact_form', 'contact_title_fnc', 10, 1 );
function contact_title_fnc () {
    global $mosrokomari_options;
    $title = $mosrokomari_options['sections-contact-title'];
    $contact_phone = $mosrokomari_options['contact-phone'];
    ?>
    <?php if ($title) : ?> 
    <div class="title-wrapper">             
        <h2 class="title"><?php echo do_shortcode( $title ); ?></h2>
    </div>
    <?php endif; ?>
    <?php
}
add_action( 'action_contact_form', 'contact_form_fnc', 10, 1 );
function contact_form_fnc () {
    global $mosrokomari_options;
    $short_code = $mosrokomari_options['sections-contact-shortcode'];
    ?>
    <div class="form-wrapper">
    <?php echo do_shortcode( $short_code ); ?>
    </div>
    <?php  
}

add_action( 'action_testimonial_archive_page', 'testimonial_archive_fnc', 10, 1 );
function testimonial_archive_fnc ($page_details) {
    global $mosrokomari_options;
    $grid = $mosrokomari_options['testimonial-page-grid'];
    if($grid == '4') { $colsize = 3; }
    elseif($grid == '3') { $colsize = 4; }
    elseif($grid == '2') { $colsize = 6; }
    else { $colsize = 12; }
    $count = ($mosrokomari_options['testimonial-page-count']) ? $mosrokomari_options['testimonial-page-count'] : '-1';
    $args = array(
        'posts_per_page'=>$count,
        'post_type'=>'testimonial',
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );
    $query = new WP_Query($args); 
    $n = 1;
    ?>
    <?php if ($query -> have_posts()) : ?>
        <div class="row testimonials">
        <?php  while ($query -> have_posts()) : $query -> the_post(); ?>
            <?php
            $designation = get_post_meta( get_the_ID(), '_mosrokomari_testimonial_designation', true );
            $image = get_post_meta( get_the_ID(), '_mosrokomari_testimonial_image', true );
            $oembed = get_post_meta( get_the_ID(), '_mosrokomari_testimonial_oembed', true );
            ?>
            <div class="col-md-<?php echo $colsize?> <?php if ($colsize < 6 ) echo 'col-sm-6';?>">
                <div class="testimonial-content">
                    <h4 class="author"><?php the_title() ?></h4>
                    <p class="designation"><?php echo $designation ?></p>
                    <div class="desc"><?php the_content(); ?></div>         
                <?php if ($oembed) {
                    $slice = explode("=",$oembed);
                    $video_id = end($slice);                    
                }               
                ?>
                <?php if($video_id) : ?>
                    <div class="img-section">
                        <?php $final_image = ($image) ? $image : 'https://img.youtube.com/vi/'.$video_id.'/maxresdefault.jpg'; ?>
                        <img src="<?php echo $final_image ?>" alt="<?php echo mos_alt_generator(get_the_ID()) . $author ?>" class="img-responsive">
                        <span id="<?php echo $video_id ?>" class="video-icon"></span>
                    </div>
                <?php endif; ?>   
                </div>    
            </div>
            <?php if ($grid > 1 AND $n%$grid == 0 AND $n<$count) echo '</div><div class="row testimonials">'; $n++;?>
        <?php endwhile;?>
        </div>
        <div class="pagination-wrapper testimonial-pagination"> 
            <nav class="navigation pagination" role="navigation">
                <div class="nav-links">
                <?php 
                $big = 999999999; // need an unlikely integer
                 echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $query->max_num_pages,
                    'prev_text'          => __('Prev'),
                    'next_text'          => __('Next')
                ) );
                ?>
                </div>
            </nav>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata();
}
add_action( 'action_below_footer', 'back_to_top_fnc', 10, 1 );
function back_to_top_fnc () {
    ?>
    <a href="javascript:void(0)" class="scrollup" style="display: none;"><img width="40" height="40" src="<?php echo get_template_directory_uri() ?>/images/icon_top.png" alt="Back To Top"></a>
    <?php 
}

add_action( 'mos_welcome_content', 'mos_welcome_content_fnc', 10, 1 );
function mos_welcome_content_fnc () {
    global $mosrokomari_options;
    $title = $mosrokomari_options['sections-welcome-title'];
    $content = $mosrokomari_options['sections-welcome-content'];
    $url = $mosrokomari_options['sections-welcome-url'];
    $slides = $mosrokomari_options['sections-welcome-details'];
    $link_title = $mosrokomari_options['sections-welcome-url']['text_field_1'];
    $link_url = $mosrokomari_options['sections-welcome-url']['text_field_2'];


    if (@$slides) echo '<div class="row"><div class="col-md-6">';
    echo '<div class="content-area">';
    $sub_title = ($mosrokomari_options['sections-welcome-sub-title']) ? '<small>' . $mosrokomari_options['sections-welcome-sub-title'] . '</small>' : '';
    if ($title) echo '<div class="title-wrapper"><h2 class="title">' . $sub_title . do_shortcode( $title ) . '</h2></div>';
    if ($content) echo '<div class="desc '.$class .'"> '.do_shortcode( $content ).'</div>';
    if (@$link_title AND @$link_url) echo '<a class="btn btn-welcome" href="'.do_shortcode( $link_url ).'">'.$link_title.'</a>';

    echo '</div><!--./content-area-->';
    if (@$slides) {
        echo '</div><div class="col-md-6">';
        echo '<div class="slides-area"><div class="row">';
        foreach ($slides as $slide) {
            $link_url = ($slide['link_url']) ? $slide['link_url'] : 'javascript:void(0)';
            $attachment_id = ($slide['attachment_id']) ? $slide['attachment_id'] : '';
            $stitle = ($slide['title']) ? $slide['title'] : '';
            echo '<div class="col-sm-6"><div class="thumbnail slider-unit"><a href="'.$link_url.'">';
            echo '<img src="'.wp_get_attachment_url( $attachment_id ).'" alt="'.get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ).'" style="width:100%">';
            echo '<div class="caption"><p class="slider-details">'.$stitle.'</p></div></a></div></div>';
        }
        echo '</div><!--./row--></div><!--./slides-area-->';
        echo '</div></div>';
    }
}






function start_container () { ?><div class="container"><?php }
function start_container_fluid () { ?><div class="container-fluid"><?php }
function start_full_width () { ?><div class="start_full_width"><?php }
function start_row () { ?><div class="row"><?php }
function start_container_col_10 () { ?><div class="col-lg-10 col-lg-offset-1 col-lg-offset-right-1"><?php }


function start_col_1 () { ?><div class="col-md-1"><?php }
function start_col_2 () { ?><div class="col-md-2"><?php }
function start_col_3 () { ?><div class="col-md-3"><?php }
function start_col_4 () { ?><div class="col-md-4"><?php }
function start_col_5 () { ?><div class="col-md-5"><?php }
function start_col_6 () { ?><div class="col-md-6"><?php }
function start_col_8 () { ?><div class="col-md-8"><?php }
function start_col_7 () { ?><div class="col-md-7"><?php }
function start_col_9 () { ?><div class="col-md-9"><?php }
function start_col_10 () { ?><div class="col-md-10"><?php }
function start_col_11 () { ?><div class="col-md-11"><?php }
function start_col_12 () { ?><div class="col-md-12"><?php }

function start_text_center () { ?><div class="text-center"><?php }
function start_text_right () { ?><div class="text-right"><?php }
function start_text_left () { ?><div class="text-left"><?php }
function end_div () { ?></div><?php }
/*function wpdocs_who_is_hook( $a, $b ) {
    echo '<code>';
        print_r( $a );
    echo '</code>';
 
    echo '<br />'.$b;
}
add_action( 'wpdocs_i_am_hook', 'wpdocs_who_is_hook', 10, 2 );
$a = array(
    'eye patch'  => 'yes',
    'parrot'     => true,
    'wooden leg' => 1
);
$b = __( 'And Hook said: "I ate ice cream with Peter Pan."', 'textdomain' ); 
do_action( 'wpdocs_i_am_hook', $a, $b );*/
//add_action('after_switch_theme', 'mytheme_setup_options');
//
//function mytheme_setup_options () {
//
//}
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) AND $post->post_type == 'page' ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    } else {
        $classes[] = $post->post_type . '-archive';
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );