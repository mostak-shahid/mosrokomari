<?php
function mosrokomari_metaboxes() {
    global $container_list, $section_list, $mosrokomari_options;
    $sections_enable = $mosrokomari_options['page-layout-settings']['Enabled'];
    $sections_disable = $mosrokomari_options['page-layout-settings']['Disabled'];
    $layout = ( $mosrokomari_options['general-page-layout'] ) ? $mosrokomari_options['general-page-layout'] : 'ns';    
    $sidebar = array();
    $sidebars = array();
    $sidebar = @$mosrokomari_options['sections-sidebar-custom'];
    if ($sidebar) {
        foreach ($sidebar as $value) {
            $key = strtolower(str_replace(' ', '_', $value));
            $sidebars[$key] = $value;
        }
    }

    $forms = get_formadable_form_list();
    $pages_id = get_all_pages_list_with_id ();
    $pages_link = get_all_pages_list_with_link ();
    $prefix = '_mosrokomari_';

     $page_settings = new_cmb2_box(array(
        'id' => $prefix . 'page_settings',
        'title' => __('Page Settings', 'cmb2'),
        'object_types' => array('page', 'post'),
    ));   

    $page_settings->add_field( array(
        'name' => 'Hide Page Title',
        'desc' => 'Yes I like to hide page title for this page',
        'id'   => $prefix . 'page_title',
        'type' => 'checkbox',
        //'default' => true,
    ));
    $page_settings->add_field(array(
        'name' => 'Page Title Background Image',
        'desc' => '',
        'id'   => $prefix.'banner_image',        
        'type' => 'file',
        /*'attributes' => array(
            'required'            => false, // Will be required only if visible.
            'data-conditional-id' => $prefix . 'page_title',
        ),*/
    )); 

    /*$page_settings->add_field(array(
        'name' => 'Section Image 1',
        'desc' => '',
        'id'   => $prefix.'icon_image',        
        'type' => 'file',
    ));

    $page_settings->add_field(array(
        'name' => 'Section Image 2',
        'desc' => '',
        'id'   => $prefix.'hover_icon_image',        
        'type' => 'file',
    ));
    $page_settings->add_field( array(
        'name' => 'Section Title',
        'desc' => 'If section title is different from page title',
        'id' => $prefix.'section_title',
        'type' => 'text'
    ) );
    $page_settings->add_field( array(
        'name' => 'Section Text',
        'desc' => '',
        'id' => $prefix.'section_text',
        'type' => 'textarea'
    ) );
    $page_settings->add_field( array(
        'name' => 'Read More',
        'desc' => 'If section title is different from page title',
        'id' => $prefix.'section_readmore',
        'type' => 'text'
    ) );*/

    $page_settings->add_field( array(
        'name'    => 'Text Layout',
        'id'      => $prefix . 'text_layout',
        'type'    => 'radio_inline',
        'options' => $container_list,
        'default' => 'container',
    ));

    $page_settings->add_field( array( 
        'name' => __('Page Column Layout', 'cmb2'), 
        'desc' => __('Choose Layout of this page.', 'cmb2'), 
        'id' => $prefix . 'page_layout', 
        'type' => 'image_select', 
        'options' => array( 
            'ns' => array(
                //'title' => 'Full Width', 
                'alt' => 'Full Width', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/1col.png'
            ), 
            'ls' => array(
                //'title' => 'Sidebar Left', 
                'alt' => 'Sidebar Left', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/2cl.png'
            ), 
            'rs' => array(
                //'title' => 'Sidebar Right', 
                'alt' => 'Sidebar Right', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/2cr.png'
            ), 
        ), 
        'default' => $mosrokomari_options['general-page-layout'], 
    ));

    $page_settings->add_field( array(
        'name'             => 'Select Sidebar',
        'desc'             => 'Select a Sidebar',
        'id'               => $prefix . 'page_sidebar',
        'show_option_none' => true,
        'type'             => 'select',
        'options'          => $sidebars,
    ) );

    $page_settings->add_field( array(
        'name'    => 'Avobe Content',
        'id'      => $prefix . 'avobe_page',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'    => 'Before Content',
        'id'      => $prefix . 'before_page',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'    => 'Before Loop',
        'id'      => $prefix . 'before_loop',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'    => 'After Loop',
        'id'      => $prefix . 'after_loop',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'    => 'After Content',
        'id'      => $prefix . 'after_page',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'    => 'Below Content',
        'id'      => $prefix . 'below_page',
        'type'    => 'wysiwyg',
        'options' => array(
            'textarea_rows' => 3
        )
    ) );

    $page_settings->add_field( array(
        'name'             => 'Select Sidebar',
        'desc'             => 'Select a Sidebar',
        'id'               => $prefix . 'page_sidebar',
        'show_option_none' => true,
        'type'             => 'select',
        'options'          => $sidebars,
    ) );

    $page_settings->add_field(array(
        'name'    => 'Page Row Layout',
        'id'      => $prefix . 'page_section_layout',
        'type'    => 'tb_sorter',
        //'desc'      => '<a href="'.admin_url( 'admin-ajax.php' ).'?action=reset_prl&post_id='.$post_id.'">Click here</a> to reset "Page Row Layout"',
        'options' => array(
            /*'enabled'  => array(
                'highlights' => 'Highlights',
                'slider'     => 'Slider',
                'staticpage' => 'Static Page',              
            ),
            'disabled' => array(
                'services'   => 'Services'
            )*/
            'Enabled'  => $sections_enable,
            'Disabled' => $sections_disable,
            //'New'      =>  
        ),
    ));   

    



  
    $gallery_details = new_cmb2_box(array(
        'id' => $prefix . 'gallery_details',
        'title' => __('Gallery Details', 'cmb2'),
        'object_types' => array('page'),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/lightbox-gallery-page.php' ),
    )); 
    $gallery_details->add_field(array(
        'name' => __('Gallery Location', 'cmb2'),  
        'id' => $prefix . 'gallery_location', 
        'type'             => 'select',
        'default'          => 'before',
        'options'          => array(
            'before' => __( 'Before Content', 'cmb2' ),
            'after'   => __( 'After Content', 'cmb2' ),
        ),
    ));

    $gallery_details->add_field( array(
        'name' => 'Image per page',
        'id'   => $prefix . 'image_per_page',
        'type' => 'text_number',
    ));
    $gallery_details->add_field( array(
        'name' => 'Each image width',
        'id'   => $prefix . 'image_width',
        'type' => 'text_number',
    ));
    $gallery_details->add_field( array(
        'name' => 'Each image height',
        'id'   => $prefix . 'image_height',
        'type' => 'text_number',
    ));
    $gallery_details->add_field( array(
        'name'             => 'Large Image Size',
        'desc'             => 'Select an option',
        'id'               => $prefix . 'large_image_size',
        'type'             => 'select',
        'default'          => 'container',
        'options'          => array(
            'actual' => __( 'Actual Size', 'cmb2' ),
            'max'   => __( 'Max Size (Width 1920px)', 'cmb2' ),
            'container'     => __( 'Container Size (Width 1140px)', 'cmb2' ),
        ),
    ) );
    $gallery_details->add_field( array( 
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
        /*'type' => 'image_select', 
        'options' => array( 
            '6' => array(
                //'title' => 'Full Width', 
                'alt' => '2 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/2-col-portfolio.png'
            ), 
            '4' => array(
                //'title' => 'Sidebar Left', 
                'alt' => '3 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/3-col-portfolio.png'
            ), 
            '3' => array(
                //'title' => 'Sidebar Right', 
                'alt' => '4 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/4-col-portfolio.png'
            ), 
        ), 
        'default' => '6',*/
    ));      
    $gallery_details->add_field(array(
        'name' => 'Grid Spacing',
        'desc' => 'Yes I like to use gap between grids.',
        'id'   => $prefix.'gallery_gap',
        'type' => 'checkbox',
    ));  
    $gallery_details->add_field(array(
        'name' => 'Gallery Images',
        'desc' => '',
        'id'   => $prefix.'gallery_images',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
    ));

    $multy_gallery_details = new_cmb2_box(array(
        'id' => $prefix . 'multy_gallery_details',
        'title' => __('Multy Gallery Details', 'cmb2'),
        'object_types' => array('page'),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/lightbox-multy-gallery-page.php' ),        
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true
    )); 
    $multy_gallery_details->add_field(array(
        'name' => __('Gallery Location', 'cmb2'),  
        'id' => $prefix . 'multy_gallery_location', 
        'type'             => 'select',
        'default'          => 'before',
        'options'          => array(
            'before' => __( 'Before Content', 'cmb2' ),
            'after'   => __( 'After Content', 'cmb2' ),
        ),
    ));
    $multy_gallery_details->add_field(array(
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'multy_gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
        /*'type' => 'image_select', 
        'options' => array( 
            '6' => array(
                //'title' => 'Full Width', 
                'alt' => '2 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/2-col-portfolio.png'
            ), 
            '4' => array(
                //'title' => 'Sidebar Left', 
                'alt' => '3 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/3-col-portfolio.png'
            ), 
            '3' => array(
                //'title' => 'Sidebar Right', 
                'alt' => '4 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/4-col-portfolio.png'
            ), 
        ), 
        'default' => '6',*/
    ));  
    $multy_gallery_details->add_field(array(
        'name' => 'Grid Spacing',
        'desc' => 'Yes I like to use gap between grids.',
        'id'   => $prefix.'multy_gallery_gap',
        'type' => 'checkbox',
    )); 

    $multy_gallery_details->add_field(array(
        'name' => 'Image per section',
        'id'   => $prefix . 'multy_gallery_image_per_page',
        'desc' => __('Leave empty if you like to show all images.', 'cmb2'), 
        'type' => 'text_number',
    ));
    $multy_gallery_details->add_field( array(
        'name'             => 'Large Image Size',
        'desc'             => 'Select an option',
        'id'               => $prefix . 'multy_gallery_large_image_size',
        'type'             => 'select',
        'default'          => 'container',
        'options'          => array(
            'actual' => __( 'Actual Size', 'cmb2' ),
            'max'   => __( 'Max Size (Width 1920px)', 'cmb2' ),
            'container'     => __( 'Container Size (Width 1140px)', 'cmb2' ),
        ),
    ) );
    $multy_gallery_details->add_field(array(
        'name' => 'Each image width',
        'id'   => $prefix . 'multy_gallery_image_width',
        'type' => 'text_number',
    ));
    $multy_gallery_details->add_field(array(
        'name' => 'Each image height',
        'id'   => $prefix . 'multy_gallery_image_height',
        'type' => 'text_number',
    ));


    $multy_gallery_details_id = $multy_gallery_details->add_field( array(
        'id'   => $prefix . 'multy_gallery_details_group',
        'type' => 'group',
    )); 

    $multy_gallery_details->add_group_field( $multy_gallery_details_id, array(
        'name' => 'Gallery Title',
        'id'   => $prefix . 'multy_gallery_title_text',
        'type' => 'text',
    ));   

    $multy_gallery_details->add_group_field( $multy_gallery_details_id, array(
        'name'    => 'Gallery Title Image',
        'desc'    => 'Upload an image or enter an URL.',
        'id'      => $prefix . 'multy_gallery_title_images',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            //'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
             'image/gif',
             'image/jpeg',
             'image/png',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));    
    $multy_gallery_details->add_group_field( $multy_gallery_details_id, array(
        'name'             => 'Large Image Size',
        'desc'             => 'Select an option',
        'id'               => $prefix . 'multy_gallery_large_image_size',
        'type'             => 'select',
        'default'          => 'custom',
        'options'          => array(
            'actual' => __( 'Actual Size', 'cmb2' ),
            'max'   => __( 'Max Size (Width 1920px)', 'cmb2' ),
            'container'     => __( 'Container Size (Width 1140px)', 'cmb2' ),
        ),
    ) );  

    $multy_gallery_details->add_group_field( $multy_gallery_details_id, array(
        'name'    => 'Tab Details',
        'desc'    => 'Tab Name, Tab Desccription',
        'id'      => $prefix . 'multy_gallery_tab_details',
        'type'    => 'text',
        'repeatable' => true,
    )); 

    $multy_gallery_details->add_group_field( $multy_gallery_details_id, array(
        'name' => 'Gallery Image URL',
        'id'   => $prefix . 'multy_gallery_tab_images',
        'type' => 'file_list',
        'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        'query_args' => array( 'type' => 'image' ), // Only images attachment
        'repeatable' => true,
    ));



    $link_gallery_details = new_cmb2_box(array(
        'id'           => $prefix . 'link_gallery_details',
        'title'        => 'Gallery Details',
        'object_types' => array( 'page' ),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/link-gallery-page.php' ),
        'context'      => 'normal',
        'priority'     => 'default'
    ));
    $link_gallery_details->add_field(array(
        'name' => __('Gallery Location', 'cmb2'),  
        'id' => $prefix . 'link_gallery_location', 
        'type'             => 'select',
        'default'          => 'before',
        'options'          => array(
            'before' => __( 'Before Content', 'cmb2' ),
            'after'   => __( 'After Content', 'cmb2' ),
        ),
    ));
 
    $link_gallery_details->add_field( array( 
        'name' => __('Gallery Layout', 'cmb2'), 
        'id' => $prefix . 'link_gallery_layout', 
        'type' => 'select', 
        'default'          => '6',
        'options'          => array(
            '6' => __( 'Two Column', 'cmb2' ),
            '4'   => __( 'Three Column', 'cmb2' ),
            '3'     => __( 'Four Column', 'cmb2' ),
        ),
        /*'type' => 'image_select', 
        'options' => array( 
            '6' => array(
                //'title' => 'Full Width', 
                'alt' => '2 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/2-col-portfolio.png'
            ), 
            '4' => array(
                //'title' => 'Sidebar Left', 
                'alt' => '3 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/3-col-portfolio.png'
            ), 
            '3' => array(
                //'title' => 'Sidebar Right', 
                'alt' => '4 Column', 
                'img' => get_template_directory_uri() . '/inc/theme-options/ReduxCore/assets/img/4-col-portfolio.png'
            ), 
        ), 
        'default' => '6',*/
    ));      
    $link_gallery_details->add_field(array(
        'name' => 'Grid Spacing',
        'desc' => 'Yes I like to use gap between grids.',
        'id'   => $prefix.'link_gallery_gap',
        'type' => 'checkbox',
    ));  
    $link_gallery_details->add_field( array(
        'name' => 'Each image width',
        'id'   => $prefix . 'link_image_width',
        'type' => 'text_number',
    ));
    $link_gallery_details->add_field( array(
        'name' => 'Each image height',
        'id'   => $prefix . 'link_image_height',
        'type' => 'text_number',
    )); 

    $link_gallery_details_id = $link_gallery_details->add_field( array(
        'id'   => $prefix . 'link_gallery_details_group',
        'type' => 'group',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name' => 'Gallery Image Text',
        'id'   => $prefix . 'link_gallery_details_text',
        'type' => 'text',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name' => 'Gallery Image URL',
        'id'   => $prefix . 'link_gallery_details_url',
        'type' => 'text_url',
    ));

    $link_gallery_details->add_group_field( $link_gallery_details_id, array(
        'name'    => 'Gallery Image',
        'desc'    => 'Upload an image or enter an URL.',
        'id'      => $prefix . 'link_gallery_details_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        // 'query_args' => array(
        //     'type' => 'application/pdf', // Make library only display PDFs.
        // ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));


/*    $offer_details = new_cmb2_box(array(
        'id' => $prefix.'offer_details',
        'title' => __( 'Spcial offer Details', 'cmb2' ),
        'object_types'  => array( 'page' ), // Post type 
    ));    
    $offer_details->add_field(array(
        'name' => 'Main Title',
        'desc' => '',
        'id'   => $prefix.'offer_maintitle',
        'type' => 'text',
    )); 
    $offer_details->add_field(array(
        'name' => 'Sub Title',
        'desc' => '',
        'id'   => $prefix.'offer_subtitle',
        'type' => 'text',
    ));
    $offer_details->add_field(array(
        'name' => 'Offer list Title',
        'desc' => '',
        'id'   => $prefix.'offer_listtitle',
        'type' => 'text',
    ));  
    $offer_details->add_field(array(
        'name' => 'Offer List',
        'desc' => '',
        'id'   => $prefix.'offer_list',
        'type' => 'text',
        'repeatable' => true,
    )); 
    $offer_details->add_field(array(
        'name' => 'Offer Promo Title',
        'desc' => '',
        'id'   => $prefix.'offer_promotitle',
        'type' => 'text',
    )); 
    $offer_details->add_field( array(
        'name'             => esc_html__( 'Offer Form', 'cmb2' ),
        'id'               => $prefix . 'offer_form',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => $forms,
    ) );*/

    $tab_group_details = new_cmb2_box(array(
        'id' => $prefix . 'tab_group_details',
        'title' => __('Multy Tab Details', 'cmb2'),
        'object_types' => array('page'),
        //'show_on'      => array( 'key' => 'page-template', 'value' => 'page-template/lightbox-multy-gallery-page.php' ),        
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true
    )); 
    $tab_group_details->add_field(array(
        'name' => __('Tab Location', 'cmb2'),  
        'id' => $prefix . 'tab_group_location', 
        'type'             => 'select',
        'default'          => 'before',
        'options'          => array(
            'before' => __( 'Before Content', 'cmb2' ),
            'after'   => __( 'After Content', 'cmb2' ),
        ),
    ));

    $tab_group_details_id = $tab_group_details->add_field( array(
        'id'   => $prefix . 'tab_group_details_group',
        'type' => 'group',
    )); 

    $tab_group_details->add_group_field( $tab_group_details_id, array(
        'name' => 'Tab Title',
        'id'   => $prefix . 'tab_group_title_text',
        'type' => 'text',
    ));   

    $tab_group_details->add_group_field( $tab_group_details_id, array(
        'name'    => 'Tab Title Image',
        'desc'    => 'Upload an image or enter an URL.',
        'id'      => $prefix . 'tab_group_title_images',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Add File' // Change upload button text. Default: "Add or Upload File"
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            //'type' => 'application/pdf', // Make library only display PDFs.
            // Or only allow gif, jpg, or png images
            'type' => array(
             'image/gif',
             'image/jpeg',
             'image/png',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ));    
    $tab_group_details->add_group_field( $tab_group_details_id, array(
        'name'    => 'Tab Details',
        'desc'    => 'Tab Name, Tab Desccription, Tab Content',
        'id'      => $prefix . 'tab_group_tab_details',
        'type'    => 'text',
        'repeatable' => true,
    ));  

     $pricing_settings = new_cmb2_box(array(
        'id' => $prefix . 'pricing_settings',
        'title' => __('Pricing Settings', 'cmb2'),
        'object_types' => array('pricing'),
    ));   

    $pricing_settings->add_field( array(
        'name' => 'Featured',
        'desc' => 'Yes this is a pricing',
        'id'   => $prefix . 'pricing_featured',
        'type' => 'checkbox',
        //'default' => true,
    ));
    $pricing_settings->add_field( array(
        'name' => 'Pricing Money',
        'id'   => $prefix . 'pricing_money',
        'type' => 'text_money',
        'before_field' => '$', 
        // Replaces default '$'
    ) );
    $pricing_settings->add_field( array(
        'name' => __( 'Sign up URL', 'cmb2' ),
        'id'   => $prefix . 'pricing_url',
        'type' => 'text_url',
        // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    ) );
    $pricing_settings->add_field( array(
        'name' => __( 'Features', 'cmb2' ),
        'id'   => $prefix . 'pricing_features',
        'type' => 'text',
        'repeatable'  => true,
        // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
    ) );
}
add_action('cmb2_admin_init', 'mosrokomari_metaboxes');