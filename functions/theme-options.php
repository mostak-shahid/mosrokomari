<?php
	/*My Code*/
	//$forms = get_formadable_form_list();
    global $container_list, $animations, $section_list, $bootstrap_grids, $col_ratio;
    $page_sections = array_diff($section_list,array('banner' => 'Banner Section', 'welcome' => 'Welcome Section'));
//var_dump ($forms);
	/*My Code*/
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "mosrokomari_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        //'display_name'         => $theme->get( 'Name' ),
        'display_name'         => 'Mos Academy',
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null, //number or null 0 te dashboard er upore
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => 'dashicons-smiley', //dash icon or directly image link
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => __( 'Documentation', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => __( 'Support', 'redux-framework-demo' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => __( 'Extensions', 'redux-framework-demo' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/mostak-shahid/',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/mosrokomaribd/',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://twitter.com/mostak_shahid',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.linkedin.com/in/mdmostakshahid/',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */




    // -> Add options here

    
    //Main Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Main Settings', 'redux-framework-demo' ),
        'id'               => 'main-settings',
        'desc' => "<div class='redux-info-field'><h3>".__('Welcome to Mos Academy Options', 'redux-framework-demo')."</h3>
        <p>".__('This theme was developed by', 'redux-framework-demo')." <a href=\"https://github.com/mostak-shahid/\" target=\"_blank\">Md. Mostak Shahid</a></p></div>",
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-dashboard',
        'fields'     => array(
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Logo', 'redux-framework-demo' ),
                'compiler' => 'true',
                'subtitle' => __( 'Upload your logo here.', 'redux-framework-demo' ),
                'default'  => array( 'url' => get_stylesheet_directory_uri().'/images/rokomari-logo.png' ),
            ),
            array(
                'id'       => 'logo-option',
                'type'     => 'radio',
                'title'    => __( 'Logo option for large devices', 'redux-framework-demo' ),
                'options'  => array(
                    'logo' => 'Logo',
                    'title' => 'Title and Description'
                ),
                'default'  => 'title'
            ), 
        )
    ) );
    //Main Settings
    //Basic Styling
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Basic Styling', 'redux-framework-demo' ),
        'id'               => 'basic-styling',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-art',
        'fields'     => array(
            array(
                'id'       => 'basic-styling-primary-color',
                'type'     => 'color',
                'title'    => __( 'Primary Color', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose the default Highlight color for your site.', 'redux-framework-demo' ),
                'validate' => 'color',
            ),
            array(
                'id'       => 'basic-styling-secondary-color',
                'type'     => 'color',
                'title'    => __( 'Secondary Color', 'redux-framework-demo' ),
                'subtitle' => __( 'This is used for hover effects.', 'redux-framework-demo' ),
                'validate' => 'color',
            ),
            array(
                'id'       => 'basic-styling-link-color',
                'type'     => 'link_color',
                'title'    => __( 'Links Color', 'redux-framework-demo' ),
                'output'   => array('a'),
            ),

            array(
                'id'       => 'basic-styling-primary-color-background',
                'type'     => 'textarea',
                'title'    => __( 'Primary Color for background', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' ),
                'default'  => '.small-nav.top',
            ),
            array(
                'id'       => 'basic-styling-primary-color-text',
                'type'     => 'textarea',
                'title'    => __( 'Primary Color for text', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' )
            ),
            array(
                'id'       => 'basic-styling-primary-color-border',
                'type'     => 'textarea',
                'title'    => __( 'Primary Color for border', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' )
            ),
            array(
                'id'       => 'basic-styling-secondary-color-background',
                'type'     => 'textarea',
                'title'    => __( 'secondary Color for background', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' ),
                'default'  => '.small-nav.bottom',
            ),
            array(
                'id'       => 'basic-styling-secondary-color-text',
                'type'     => 'textarea',
                'title'    => __( 'Secondary Color for text', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' )
            ),
            array(
                'id'       => 'basic-styling-secondary-color-border',
                'type'     => 'textarea',
                'title'    => __( 'Secondary Color for border', 'redux-framework-demo' ),
                'desc'     => __( 'Seperate sections by comma.', 'redux-framework-demo' )
            )
        )
    ) );
    //Basic Styling
    //Typography
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Typography', 'redux-framework-demo' ),
        'id'               => 'typography',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-text-width',
        'fields'     => array(
            array(
                'id'       => 'typography-fonts',
                'type'     => 'checkbox',
                'title'    => __( 'Fonts', 'redux-framework-demo' ),
                'desc'     => __( 'Please check the name of font you like to load for your website.', 'redux-framework-demo' ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'font-awesome' => 'Font Awesome',
                    'oldstandard' => 'Old Standard TT',
                    'opensans' => 'OpenSans',
                    'poppins' => 'Poppins',
                    'montserrat' => 'Montserrat',
                    'sourcesanspro' => 'Source Sans Pro',
                    'sourceserifpro' => 'Source Serif Pro',
                    'ubuntu' => 'Ubuntu'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    'font-awesome' => '1',
                    'oldstandard' => '0',
                    'opensans' => '0',
                    'poppins' => '0',
                    'montserrat' => '0',
                    'ubuntu' => '0'
                )
            ),
            array(
                'id'       => 'typography-body-font',
                'type'     => 'typography',
                'title'    => __( 'Body Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the body font properties.', 'redux-framework-demo' ),
                'google'   => false,
                //'line-height'   => false,
                'default'  => array(
                    'color'       => '#959595',
                    'font-size'   => '16px',
                    'font-weight' => 'Normal',
                ),
                //'output' => array('body'),
            ),
            array(
                'id'       => 'typography-title-font',
                'type'     => 'typography',
                'title'    => __( 'Section Title Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Specify the Section Title font properties.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('.title'),
            ),
            array(
                'id'       => 'typography-page-title-font',
                'type'     => 'typography',
                'title'    => __( 'Page Title Font', 'redux-framework-demo' ),
                'subtitle' => __( 'This Styles Your Page Titles.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('#page-title span'),
            ),
            array(
                'id'       => 'typography-h1-font',
                'type'     => 'typography',
                'title'    => __( 'H1 Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'This Styles Your Page Titles.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('h1', '.h1'),
            ),
            array(
                'id'       => 'typography-h2-font',
                'type'     => 'typography',
                'title'    => __( 'H2 Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for h2.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('h2', '.h2'),
            ),
            array(
                'id'       => 'typography-h3-font',
                'type'     => 'typography',
                'title'    => __( 'H3 Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for h3.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('h3', '.h3'),
            ),
            array(
                'id'       => 'typography-h4-font',
                'type'     => 'typography',
                'title'    => __( 'H4 Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for h4.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('h4', '.h4'),
            ),
            array(
                'id'       => 'typography-h5-font',
                'type'     => 'typography',
                'title'    => __( 'H5 Headings', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for h5.', 'redux-framework-demo' ),
                'google'   => false,
                'output' => array('h5', '.h5'),
            ),
        )
    ) );
    //Typography      
    //General Page  
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Page', 'redux-framework-demo' ),
        'id'               => 'general-page',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-admin-page',
        'fields'     => array(
            array(
                'id'       => 'general-page-layout',
                'type'     => 'image_select',
                'title'    => __( 'General Page Layout', 'redux-framework-demo' ),
                'options'  => array(
                    'ns' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'ls' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'rs' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'ns'
            ),
            array(
                'id'       => 'page-layout-settings',
                'type'     => 'sorter',
                'title'    => 'General Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => $page_sections
                ),
            ),
        )
    ) );
    //General Page 
    
    //Home Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Home Page', 'redux-framework-demo' ),
        'id'               => 'home',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'     => array(
            array(
                'id'       => 'home-layout-settings',
                'type'     => 'sorter',
                'title'    => 'Home Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => $section_list
                ),
            ),

        )
    ) );   
	
	//Blog page
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Archive Page', 'redux-framework-demo' ),
        'id'               => 'blog',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'dashicons dashicons-admin-post',
        'fields'     => array(
            array(
                'id'       => 'blog-archive-title',
                'type'     => 'text',
                'title'    => __( 'Blog Archive Page Title', 'redux-framework-demo' ),
                'default'  => 'Blog',
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ), 
            array(
                'id'       => 'blog-archive-grid',
                'type'     => 'image_select',
                'title'    => __( 'Post Grid', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '3 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '4 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '2'
            ),            
            array(
                'id'       => 'blog-archive-content-layout',
                'type'     => 'image_select',
                'title'    => __( 'Content Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'Row View',
                        'img' => get_template_directory_uri() .'/images/horizontal.png'
                    ),
                    '2' => array(
                        'alt' => 'Column View',
                        'img' => get_template_directory_uri() .'/images/vertical.png'
                    )
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'blog-archive-section1-width',
                'type'     => 'select',
                'title'    => __( '1st Section Size', 'redux-framework-demo' ),
                'options'  => $bootstrap_grids,
                'required' => array( 'blog-archive-content-layout', '=', '2' )
            ),
            array(
                'id'       => 'blog-archive-section1-zigzag',
                'type'     => 'switch',
                'title'    => __( 'Zigzag Mode', 'redux-framework-demo' ),
                //'options' => array('on', 'off'),
                'default'  => false,
                'required' => array( 'blog-archive-content-layout', '=', '2' )
            ),
            array(
                'id'       => 'blog-archive-section1',
                'type'     => 'multi_text',
                'title'    => __( '1st Section Elements', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'blog-archive-section2',
                'type'     => 'multi_text',
                'title'    => __( '2nd Section Elements', 'redux-framework-demo' ),
            ),

            array(
                'id'       => 'blog-layout-settings',
                'type'     => 'sorter',
                'title'    => 'Archive Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => $page_sections
                ),
            ),
            array(
                'id'       => 'single-blog-title-option',
                'type'     => 'radio',
                'title'    => __( 'Single Blog page title type', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1' => 'Post Title',
                    '2' => 'Static Header'
                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'single-blog-comment',
                'type'     => 'radio',
                'title'    => __( 'Comment Option', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '0' => 'No I don\'t like to use comment',
                    '1' => 'Let me choose when I post',
                ),
                'default'  => '0'
            ),
            array(
                'id'       => 'single-blog-comment-style',
                'type'     => 'radio',
                'title'    => __( 'Comment Type', 'redux-framework-demo' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'wp' => 'Default Comment',
                    'fb' => 'Facebook Comment',
                ),
                'default'  => 'wp',
                'required' => array( 'single-blog-comment', '=', '1' ),
            ),
            array(
                'id'       => 'single-blog-title',
                'type'     => 'text',
                'title'    => __( 'Single Blog page title', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'single-blog-title-option', '=', 2 ),
            ),
            /*array(
                'id'       => 'blog-archive-meta',
                'type'     => 'switch',
                'title'    => 'Show Post Meta',
                'desc' => 'Do you like to show post meta avobe post content?.',
                'default'  => false
            ),
            array(
                'id'       => 'blog-archive-meta-options',
                'type'     => 'checkbox',
                'title'    => __( 'Meta to show', 'redux-framework-demo' ),
                'required' => array( 'blog-archive-meta', '=', true ),
                //Must provide key => value pairs for multi checkbox options
                'options'  => array(
                    'date' => 'Date',
                    'author' => 'Author',
                    'tags' => 'Tags',
                    'categories' => 'Categories',
                    'comment' => 'Comments'
                ),
                //See how std has changed? you also don't need to specify opts that are 0.
                'default'  => array(
                    'date' => '1',
                    'author' => '1',
                    'tags' => '0',
                    'comment' => '0'
                )
            ),*/            
        )
    ) );        
    
    //Thank you Page
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Thank you Page', 'redux-framework-demo' ),
        'id'               => 'thanks',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-thumbs-up',
        'fields'     => array(
            array(
                'id'       => 'thanks-layout-settings',
                'type'     => 'sorter',
                'title'    => 'Thank you Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => $page_sections
                ),
            ),

        )
    ) );  
    //Thank Page
    //404 Page  
    Redux::setSection( $opt_name, array(
        'title'            => __( '404 Page', 'redux-framework-demo' ),
        'id'               => '404-page',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-error',
        'fields'     => array(
            array(
                'id'       => '404-page-title',
                'type'     => 'text',
                'title'    => __( '404 Page Title', 'redux-framework-demo' ),
                'default'  => '404 Page',
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ), 
            array(
                'id'       => '404-layout-settings',
                'type'     => 'sorter',
                'title'    => '404 Page Layout',
                'subtitle' => 'You can add multiple drop areas or columns.',
                'compiler' => 'true',
                'options'  => array(
                    'Enabled'  => array(),
                    'Disabled' => $page_sections
                ),
            ),
        )
    ) );
    //Contact Page 
    
    
    //Contact Info   
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Info', 'redux-framework-demo' ),
        'id'               => 'contact-section',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'fa fa-address-card',
        'fields'     => array(
            array(
                'id'        => 'contact-phone',
                'type'      => 'multi_text',
                'title'     => __( 'Phone', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-fax',
                'type'      => 'multi_text',
                'title'     => __( 'Fax', 'redux-framework-demo' ),
                'desc'      => __( '<b>Example:</b> 00 0000 0000', 'redux-framework-demo' ),                
                'validate' => 'no_html',
            ),
            array(
                'id'        => 'contact-email',
                'type'      => 'multi_text',
                'title'     => __( 'Email', 'redux-framework-demo' ),
                'default'   => '',
                'desc'     => '<b>Example:</b> example@domain.com',
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'contact-hour',
                'type'     => 'multi_text',
                'title'    => __( 'Business Hours', 'redux-framework-demo' ),
                'subtitle'       => __( 'You can use span tag ( &lt;span&gt;&lt;/span&gt; ) here.', 'redux-framework-demo' ),
                'desc'     => __( '<b>Example:</b> 6.30am - 6pm <span>(Mon-Fri)</span>', 'redux-framework-demo' ),
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'          => 'contact-address',
                'type'        => 'mos_address',
                'title'       => __( 'Contact Address', 'redux-framework-demo' ),           
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'map_link' => true,
                    'review_link' => true,
                    'review_link_img' => true,
                    'review_link_img_h' => true,
                    'target' => true,
                )
            ),
            array(
                'id'          => 'contact-social',
                'type'        => 'mos_social',
                //'type'        => 'kad_icons',
                'title'       => __( 'Social Media', 'redux-framework-demo' ),             
                'show' => array(
                    'title' => true,
                    'basic_icon' => true,
                    'hover_icon' => true,
                    'link_url' => true,
                    'target' => true,
                )
            ),
        )
    ) );
    //Contact Section

    //Schema & Review Snippets
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Schema & Review Snippets', 'redux-framework-demo' ),
        'id'               => 'schema-section',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'fa fa-sitemap',
        'fields'     => array(
            array(
                'id'       => 'schema-option',
                'type'     => 'switch',
                'title'    => __( 'Schema', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you like to enable Schema for your website?', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'schema-street',
                'type'     => 'text',
                'title'    => __( 'Street Address', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'schema-option', '=', 1 ),
            ),
            array(
                'id'       => 'schema-locality',
                'type'     => 'text',
                'title'    => __( 'Locality', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'schema-option', '=', 1 ),
            ),
            array(
                'id'       => 'schema-region',
                'type'     => 'text',
                'title'    => __( 'Region', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'schema-option', '=', 1 ),
            ),
            array(
                'id'       => 'schema-postal',
                'type'     => 'text',
                'title'    => __( 'Postal Code', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'schema-option', '=', 1 ),
            ),

            array(
                'id'          => 'schema-slides',
                'type'        => 'slides',
                'required' => array( 'schema-option', '=', '1' ),
                'title'       => __( 'Add Schema', 'redux-framework-demo' ),                 
                'show' => array(
                    'title' => true,
                    'description' => false,
                    'url' => true              // <<========= that is what was asked at the top.
                ),
                'placeholder' => array(
                    'title'       => __( 'Schema Name', 'redux-framework-demo' ),
                    'url'         => __( 'Schema Type', 'redux-framework-demo' ),
                ),
            ),
            array(
                'id'       => 'snippets-option',
                'type'     => 'switch',
                'title'    => __( 'Snippets', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you like to enable Review Snippets for your website?', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'snippets-name',
                'type'     => 'text',
                'title'    => __( 'Primary Keyword', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'snippets-option', '=', 1 ),
            ),
            array(
                'id'       => 'snippets-value',
                'type'     => 'text',
                'title'    => __( 'Rating Value', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'snippets-option', '=', 1 ),
            ),
            array(
                'id'       => 'snippets-count',
                'type'     => 'text',
                'title'    => __( 'Review Count', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'required' => array( 'snippets-option', '=', 1 ),
            ),
        )
    ) );
    //Schema & Review Snippets


    //Misc Settings
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Misc Settings', 'redux-framework-demo' ),
        'id'               => 'misc-settings',
        //'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-css',
    ) );

    //Click to Show
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Click to Show', 'redux-framework-demo' ),
        'id'               => 'misc-cts',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-cts-number',
                'type'     => 'switch',
                'title'    => __( 'Hide phone number', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled'
            ),
            array(
                'id'       => 'misc-cts-limit',
                'type'     => 'text',
                'title'    => 'Number of Digit to show',
                'subtitle' => 'If the number didnot seperated by space then this will come to play',
                'validate' => 'numeric',
                'required' => array( 'misc-cts-number', '=', true )
            ),
            array(
                'id'       => 'misc-cts-text',
                'type'     => 'text',
                'title'    => 'Text to show',
                'subtitle' => 'This will show instead of hidden number',
                'default'  => 'Show Number',
                'validate' => 'no_html',
                'required' => array( 'misc-cts-number', '=', true )
            ),
            array(
                'id'       => 'misc-cts-small-email',
                'type'     => 'switch',
                'title'    => __( 'Hide Email on smaller devices', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled'
            ),
            array(
                'id'       => 'misc-cts-small-email-text',
                'type'     => 'text',
                'title'    => 'Text to show',
                'subtitle' => 'This will show instead of email',
                'default' => 'Email Us',
                'validate' => 'no_html',
                'required' => array( 'misc-cts-small-email', '=', true )
            ),
            array(
                'id'      => 'misc-cts-small-email-devices',
                'type'    => 'checkbox',
                'title'   => __( 'Devices', 'redux-framework-demo' ),
                'options' => array(
                    'hidden-xs' => 'Extra Small Device (for phones - screens less than 768px wide)',
                    'hidden-sm' => 'Small Device (for tablets - screens equal to or greater than 768px wide)',
                    'hidden-md' => 'Medium Device (for small laptops - screens equal to or greater than 992px wide)'
                ),
                'required' => array( 'misc-cts-small-email', '=', true )
            ),
            array(
                'id'       => 'misc-cts-small-number',
                'type'     => 'switch',
                'title'    => __( 'Hide Phone number on smaller devices', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled'
            ),
            array(
                'id'       => 'misc-cts-small-number-text',
                'type'     => 'text',
                'title'    => 'Text to show',
                'subtitle' => 'This will show instead of number',
                'default'  => 'Tap to Call',
                'validate' => 'no_html',
                'required' => array( 'misc-cts-small-number', '=', true )
            ),
            array(
                'id'      => 'misc-cts-small-number-devices',
                'type'    => 'checkbox',
                'title'   => __( 'Devices', 'redux-framework-demo' ),
                'options' => array(
                    'hidden-xs' => 'Extra Small Device (for phones - screens less than 768px wide)',
                    'hidden-sm' => 'Small Device (for tablets - screens equal to or greater than 768px wide)',
                    'hidden-md' => 'Medium Device (for small laptops - screens equal to or greater than 992px wide)'
                ),
                'required' => array( 'misc-cts-small-number', '=', true )
            ),
        )
    ) );
    //Scripting
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Scripting', 'redux-framework-demo' ),
        'id'               => 'misc-scripting',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-settings-css',
                'type'     => 'ace_editor',
                'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_mosrokomari">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "body{\n   margin: 0 auto;\n}"
            ),
            array(
                'id'       => 'misc-settings-js',
                'type'     => 'ace_editor',
                'title'    => __( 'JS Code', 'redux-framework-demo' ),
                'subtitle' => __( 'Paste your JS code here.', 'redux-framework-demo' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                //'desc'     => 'Possible modes can be found at <a href="' . 'http://' . 'ace.c9.io" target="_mosrokomari">' . 'http://' . 'ace.c9.io/</a>.',
                //'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
        )
    ) );
    //Page Loader
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Loader', 'redux-framework-demo' ),
        'id'               => 'misc-loader',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-page-loader',
                'type'     => 'switch',
                'title'    => __( 'Page Loader Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the page loader', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
            array(
                'id'       => 'misc-page-loader-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Page Loader image', 'redux-framework-demo' ),
                'compiler' => 'true'
            ),
            array(
                'id'       => 'misc-page-loader-image-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'misc-page-loader-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Footer Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'misc-page-loader-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'misc-page-loader-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Footer Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'misc-page-loader-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'misc-page-loader-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'default'  => array(
                    'background-repeat' => 'no-repeat',
                    'background-size' => 'cover',
                    'background-attachment' => '',
                    'background-position' => 'center top',
                    'background-image' => get_template_directory_uri() . '/images/footer-bg.png.png',
                ),
                'required' => array( 'misc-page-loader-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'misc-page-loader-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'misc-page-loader-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'misc-page-loader-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Back to Top
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Back to Top', 'redux-framework-demo' ),
        'id'               => 'misc-btt',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-back-top',
                'type'     => 'switch',
                'title'    => __( 'Back to Top Option', 'redux-framework-demo' ),
                'subtitle' => __( 'Do you want to use the back to top', 'redux-framework-demo' ),
                'default'  => 0,
                'on'       => 'Enabled',
                'off'      => 'Disabled',
            ),
        )
    ) );
    //Mobile Sticky
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Mobile Sticky', 'redux-framework-demo' ),
        'id'               => 'misc-sticky',
		'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'misc-sticky-layout',
                'type'     => 'sorter',
                'title'    => 'Layout Manager',
                'compiler' => 'true',
                'options'  => array(
                    'On Header'  => array(
                        'menu' => 'Menu'
                    ),
                    'On Footer' => array(
                        'phone'     => 'Phone',
                        'email' => 'Email'),
                    'Disabled' => array(
                        'smlogo'     => 'Logo',
                    ),

                ),
                /*'limits'   => array(
                    'disabled' => 1,
                    'backup'   => 2,
                ),*/
            ),
		)
	) );
	//MISC

    //Page Sections
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Sections', 'redux-framework-demo' ),
        'id'               => 'sections',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-adjust-alt'
    ) );
    //Header Section 
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header Section', 'redux-framework-demo' ),
        'id'               => 'header-section',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-header-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-header-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-header-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#main-header .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),
            array(
                'id'       => 'sections-header--border',
                'type'     => 'border',
                'title'    => __( 'Header Border', 'redux-framework-demo' ),
                'output'   => array( '#main-header .content-wrap' ),
                'all'      => false,
            ),
            
            array(
                'id'       => 'header-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Header Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'header-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'header-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Header Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'header-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'header-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Header Background', 'redux-framework-demo' ),
                'required' => array( 'header-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'header-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Header Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'header-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'header-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),

        )
    ) );
    //Footer Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Section', 'redux-framework-demo' ),
        'id'               => 'sections-footer',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-footer-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-footer-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-footer-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#footer .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-footer-border',
                'type'     => 'border',
                'title'    => __( 'Footer Section Border', 'redux-framework-demo' ),
                'output'   => array( '#footer .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-footer-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                //'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ),
            array(
                'id'      => 'sections-footer-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'           => 'footer-layout',
                'type'         => 'textarea',
                'title'        => __( 'Footer Layout', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped, you can use shortcodes.', 'redux-framework-demo' ),                
                'desc'     => '<b>Example:</b> [element_start name="" id="" class=""], [element_end name="" id="" class=""], [site_identity class="" container_class=""][mainmenu container="" container_class="" menu_class=""]',
                'validate' => 'no_html',                          
                //'required' => array( 'header-design', '=', '0' ),
            ),
            array(
                'id'       => 'sections-footer-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Footer Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-footer-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-footer-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Footer Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-footer-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-footer-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),				
				'default'  => array(
					'background-repeat' => 'no-repeat',
					'background-size' => 'cover',
					'background-attachment' => '',
					'background-position' => 'center top',
					'background-image' => get_template_directory_uri() . '/images/footer-bg.png',
				),
                'required' => array( 'sections-footer-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-footer-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Footer Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-footer-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-footer-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );   
    //Header Section  
    //Page Title Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page Title Section', 'redux-framework-demo' ),
        'id'               => 'sections-title',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-title-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-title-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-title-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#page-title .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-title-border',
                'type'     => 'border',
                'title'    => __( 'Page Title Border', 'redux-framework-demo' ),
                'output'   => array( '#page-title .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-title-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Page Title Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-title-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-title-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-title-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-title-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'required' => array( 'sections-title-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-title-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Page Title Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-title-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-title-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Breadcrumbs Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Breadcrumbs Section', 'redux-framework-demo' ),
        'id'               => 'sections-breadcrumbs',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-breadcrumbs-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-breadcrumbs-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-breadcrumbs-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-breadcrumbs .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-breadcrumbs-border',
                'type'     => 'border',
                'title'    => __( 'Breadcrumbs Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-breadcrumbs .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-breadcrumbs-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-breadcrumbs-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-breadcrumbs-title',
                'type'     => 'text',
                'title'    => __( 'Breadcrumbs Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-breadcrumbs-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            
            array(
                'id'       => 'sections-breadcrumbs-option',
                'type'     => 'switch',
                'title'    => __( 'Breadcrumbs', 'redux-framework-demo' ),
                //'options' => array('on', 'off'),
                'default'  => false,
            ),

            array(
                'id'       => 'sections-breadcrumbs-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Breadcrumbs Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-breadcrumbs-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-breadcrumbs-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-breadcrumbs-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-breadcrumbs-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Breadcrumbs Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-breadcrumbs-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-breadcrumbs-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Baner Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Banner Section', 'redux-framework-demo' ),
        'id'               => 'sections-banner',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-banner-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'       => 'sections-banner-select',
                'type'     => 'select',
                'title'    => __( 'Choose a Home Image Slider', 'redux-framework-demo' ),
                'subtitle' => __( 'If you don\'t want an image slider on your home page choose none.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'banner' => 'Banner',
                    'carousel' => 'Carousel Slider',
                    'shortcode' => 'From Shortcode',
                ),
                'default'  => 'banner'
            ),
            array(
                'id'          => 'sections-banner-details',
                'type'        => 'mos_slides',
                'title'       => __( 'Slider Images', 'redux-framework-demo' ),
                'subtitle'    => __( 'Use large images (Max Width 1920px) for best results.', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
                'required' => array( 'sections-banner-select', '!=', 'shortcode' ),
            ),            
            array(
                'id'       => 'sections-banner-shortcode',
                'type'     => 'text',
                'title'    => __( 'Shortcode', 'redux-framework-demo' ),
                'subtitle' => __( 'All HTML will be stripped', 'redux-framework-demo' ),
                'validate' => 'no_html',
                'default'  => 'No HTML is allowed in here.',
                'required' => array( 'sections-banner-select', '=', 'shortcode' ),
            ),
            array(
                'id'       => 'sections-banner-title-font',
                'type'     => 'typography',
                'title'    => __( 'Slider Title Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for Slider Title.', 'redux-framework-demo' ),
                'google'   => false,
                'output'      => array( '#section-banner .banner-content .banner-title' ),
            ),
            array(
                'id'       => 'sections-banner-description-font',
                'type'     => 'typography',
                'title'    => __( 'Slider Description Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for Slider Description.', 'redux-framework-demo' ),
                'google'   => false,
                'output'      => array( '#section-banner .banner-content .banner-desc' ),
            ),
            array(
                'id'       => 'sections-banner-link-title-font',
                'type'     => 'typography',
                'title'    => __( 'Slider Link Title Font', 'redux-framework-demo' ),
                'subtitle' => __( 'Choose Size and Style for Slider Link Title.', 'redux-framework-demo' ),
                'google'   => false,
                'output'      => array( '#section-banner .banner-content .btn-banner' ),
            ),

            array(
                'id'       => 'sections-banner-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Banner Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-banner-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-banner-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Banner Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-banner-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-banner-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Banner Section Background', 'redux-framework-demo' ),				
				'default'  => array(
					'background-repeat' => 'no-repeat',
					'background-size' => 'cover',
					'background-attachment' => '',
					'background-position' => 'center top',
					'background-image' => get_template_directory_uri() . '/images/banner-bg.png',
				),
                'required' => array( 'sections-banner-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-banner-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Banner Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-banner-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-banner-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );    
    //Content Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Content Section', 'redux-framework-demo' ),
        'id'               => 'sections-content',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-content-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-content-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-content-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '.page-content .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-content-border',
                'type'     => 'border',
                'title'    => __( 'Content Border', 'redux-framework-demo' ),
                'output'   => array( '.page-content .content-wrap' ),
                'all'      => false,
            ), 
            array(
                'id'       => 'sections-content-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Content Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-content-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-content-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-content-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-content-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'required' => array( 'sections-content-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-content-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Content Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-content-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-content-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Welcome Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Welcome Section', 'redux-framework-demo' ),
        'id'               => 'sections-welcome',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-welcome-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-welcome-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-welcome .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-welcome-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-welcome .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-welcome-border',
                'type'     => 'border',
                'title'    => __( 'Welcome Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-welcome .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-welcome-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-welcome-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-welcome-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Sub Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default'  => 'How we can help your business'
            ),
            array(
                'id'       => 'sections-welcome-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default'  => 'We Are a Full Service Marketing and Design Firm'
            ),
            array(
                'id'      => 'sections-welcome-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                ),
                'default'  => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>'
            ), 
            array(
                'id'       => 'sections-welcome-url',
                'type'     => 'mos_group',                
                'title'    => 'Welcome Url',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Title',
                   'text_field_2' => 'Link',
                )
            ),            
            array(
                'id'          => 'sections-welcome-details',
                'type'        => 'mos_slides',
                'title'       => __( 'Welcome Slides', 'redux-framework-demo' ),             
                'show' => array(
                    'title' => true,
                    'description' => false,
                    'link_title' => false,
                    'link_url' => true,
                    'target' => false,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'link_url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
            ),    

            array(
                'id'       => 'sections-welcome-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Welcome Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-welcome-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-welcome-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Welcome Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-welcome-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-welcome-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Welcome Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-welcome-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-welcome-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Welcome Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-welcome-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-welcome-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 
    //Service Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Service Section', 'redux-framework-demo' ),
        'id'               => 'sections-service',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-service-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-service-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-service .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-service-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-service .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-service-border',
                'type'     => 'border',
                'title'    => __( 'Service Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-service .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-service-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-service-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-service-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Sub Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'How we can help your business',
            ),
            array(
                'id'       => 'sections-service-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'Our Creative Works',
            ),
            array(
                'id'      => 'sections-service-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),

            array(
                'id'          => 'sections-service-slides',
                'type'        => 'mos_service_slides',
                'title'       => __( 'Slider Details', 'redux-framework-demo' ),
                'subtitle'    => __( 'Use large images (Max Width 1920px) for best results.', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'link_title' => true,
                    'link_url' => true,
                    'target' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'link_title'         => __( 'Link Title', 'redux-framework-demo' ),
                    'link_url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
            ),
            array(
                'id'       => 'sections-service-layout',
                'type'     => 'image_select',
                'title'    => __( 'Service Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '3 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '4 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '2'
            ),
            array(
                'id'       => 'sections-service-view',
                'type'     => 'select',
                'title'    => __( 'Service View', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'grid' => 'Grid',
                    'slider' => 'Slider',                    
                ),
                'default'  => 'grid'
            ), 
            array(
                'id'       => 'sections-service-gap',
                'type'     => 'checkbox',
                'title'    => __( 'Grid Spacing', 'redux-framework-demo' ),                
                'options'  => array(
                    '1' => 'Yes I like to use gap between grids.',
                ),
            ), 
            array(
                'id'       => 'sections-service-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Service Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-service-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-service-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Service Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-service-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-service-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Service Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-service-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-service-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Service Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-service-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-service-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 
    //Achievement Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Achievement Section', 'redux-framework-demo' ),
        'id'               => 'sections-achievement',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-achievement-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-achievement-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-achievement .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-achievement-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-achievement .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-achievement-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-achievement .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-achievement-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-achievement-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-achievement-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'know our success of our business',
            ),
            array(
                'id'       => 'sections-achievement-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'We Have Done More Achievement',
            ),
            array(
                'id'      => 'sections-achievement-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                ),
                'default' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>'
            ),
            array(
                'id'          => 'sections-achievement-slides',
                'type'        => 'slides',
                'title'       => __( 'Achievement Slides', 'redux-framework-demo' ),
                'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'redux-framework-demo' ),               
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => false              // <<========= that is what was asked at the top.
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Countable Number', 'redux-framework-demo' )
                ),
            ),
            array(
                'id'       => 'sections-achievement-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-achievement-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-achievement-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-achievement-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-achievement-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-achievement-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-achievement-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-achievement-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-achievement-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 
    //Who We Are Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Who We Are Section', 'redux-framework-demo' ),
        'id'               => 'sections-whowe',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-whowe-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-whowe-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-whowe .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-whowe-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-whowe .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-whowe-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-whowe .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-whowe-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-whowe-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-whowe-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'How we can help your business',
            ),
            array(
                'id'       => 'sections-whowe-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                ),
                'default' => 'We Are a Full Service Marketing and Design Firm',
            ),
            array(
                'id'      => 'sections-whowe-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                ),
                'default' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.It has survived not only five centuries, but also the leap into electronic typesetting.</p>'
            ),
            array(
                'id'       => 'sections-whowe-url',
                'type'     => 'mos_group',                
                'title'    => 'Welcome Url',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Title',
                   'text_field_2' => 'Link',
                )
            ),
            array(
                'id'       => 'sections-whowe-media',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Section Image', 'redux-framework-demo' ),
                'compiler' => 'true',
                'default'  => array( 'url' => get_template_directory_uri() . '/images/whowe.jpg' ),
            ),
            array(
                'id'       => 'sections-whowe-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-whowe-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-whowe-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-whowe-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-whowe-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-whowe-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-whowe-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-whowe-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-whowe-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );
    //Pricing Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Pricing Section', 'redux-framework-demo' ),
        'id'               => 'sections-pricing',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-pricing-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-pricing-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-pricing .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-pricing-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-pricing .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-pricing-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-pricing .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-pricing-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-pricing-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-pricing-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Sub Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'       => 'sections-pricing-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-pricing-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-pricing-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-pricing-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-pricing-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-pricing-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-pricing-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-pricing-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-pricing-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-pricing-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-pricing-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Video Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Video Section', 'redux-framework-demo' ),
        'id'               => 'sections-video',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-video-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-video-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-video .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-video-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-video .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-video-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-video .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-video-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-video-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-video-bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Video banner', 'redux-framework-demo' ),
                'compiler' => 'true',
                'default'  => array( 'url' => get_template_directory_uri() . '/images/video-bg.png' ),
            ),
            array(
                'id'       => 'sections-video-icon',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Video icon', 'redux-framework-demo' ),
                'compiler' => 'true',
                'default'  => array( 'url' => get_template_directory_uri() . '/images/videoicon.png' ),
            ),            
            array(
                'id'       => 'sections-video-url',
                'type'     => 'text',
                'title'    => __( 'Video URL', 'redux-framework-demo' ),
                'validate' => 'url',
                'default'  => 'https://www.youtube.com/embed/cWLCbjyYPdc',
            ),
            array(
                'id'       => 'sections-video-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-video-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-video-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-video-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-video-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-video-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-video-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-video-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-video-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );    
    //Blog Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog Section', 'redux-framework-demo' ),
        'id'               => 'sections-blog',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-blog-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-blog-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blog .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-blog-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-blog .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-blog-border',
                'type'     => 'border',
                'title'    => __( 'Blog Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-blog .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-blog-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-blog-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-blog-title',
                'type'     => 'text',
                'title'    => __( 'Blog Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-blog-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'            => 'sections-blog-count',
                'type'          => 'slider',
                'title'         => __( 'Max number of posts to show', 'redux-framework-demo' ),
                'subtitle'      => __( 'Set more than 1 for slider.', 'redux-framework-demo' ),
                'desc'          => __( 'Slider description. Min: 2, max: 30, step: 1, default value: 3', 'redux-framework-demo' ),
                'default'       => 3,
                'min'           => 2,
                'step'          => 1,
                'max'           => 30,
                'display_value' => 'label'
            ), 
            array(
                'id'       => 'sections-blog-layout',
                'type'     => 'image_select',
                'title'    => __( 'Blog Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => '1 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '3 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '4 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'sections-blog-view',
                'type'     => 'select',
                'title'    => __( 'Blog View', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'grid' => 'Grid',
                    'slider' => 'Slider',
                    
                ),
                'default'  => 'grid'
            ),             
            
            array(
                'id'       => 'sections-blog-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Blog Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-blog-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-blog-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Blog Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-blog-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-blog-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Blog Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-blog-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-blog-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Blog Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-blog-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-blog-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 
    //Partner Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Partner Section', 'redux-framework-demo' ),
        'id'               => 'sections-partner',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(
            array(
                'id'       => 'sections-partner-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-partner-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-partner .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),  
            array(
                'id'             => 'sections-partner-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-partner .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-partner-border',
                'type'     => 'border',
                'title'    => __( 'Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-partner .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-partner-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-partner-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-partner-sub-title',
                'type'     => 'text',
                'title'    => __( 'Section Sub Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'       => 'sections-partner-title',
                'type'     => 'text',
                'title'    => __( 'Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br /&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-partner-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'          => 'sections-partner-slides',
                'type'        => 'slides',
                'title'       => __( 'Partner Details', 'redux-framework-demo' ),              
                'show' => array(
                    'title' => true,
                    'description' => false,
                    'url' => true              // <<========= that is what was asked at the top.
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),
            ),
            array(
                'id'       => 'sections-partner-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-partner-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-partner-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-partner-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-partner-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-partner-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-partner-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-partner-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-partner-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Linking Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Linking Section', 'redux-framework-demo' ),
        'id'               => 'sections-button',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-button-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),   
            array(
                'id'             => 'sections-button-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-button .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-button-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-button .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),        
            array(
                'id'       => 'sections-button-border',
                'type'     => 'border',
                'title'    => __( 'Linking Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-button .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-button-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-button-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ), 
            array(
                'id'       => 'sections-button-title',
                'type'     => 'text',
                'title'    => __( 'Linking Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ), 
            array(
                'id'      => 'sections-button-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),    
            array(
                'id'          => 'sections-button-slides',
                'type'        => 'slides',
                'title'       => __( 'Add Link', 'redux-framework-demo' ),               
                'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true,
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'url'         => __( 'Read More link!', 'redux-framework-demo' ),
                ),
            ),
            array(
                'id'       => 'sections-button-gap',
                'type'     => 'checkbox',
                'title'    => __( 'Grid Spacing', 'redux-framework-demo' ),                
                'options'  => array(
                    '1' => 'Yes I like to use gap between grids.',
                ),
            ),
            array(
                'id'       => 'sections-button-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Link Section Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-button-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-button-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Linking Section Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-button-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-button-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Linking Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-button-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-button-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Linking Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-button-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-button-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Contact Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Contact Section', 'redux-framework-demo' ),
        'id'               => 'sections-contact',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-contact-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-contact-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-contact .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-contact-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-contact .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),         
            array(
                'id'       => 'sections-contact-border',
                'type'     => 'border',
                'title'    => __( 'Contact Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-contact .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-contact-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-contact-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ), 
            array(
                'id'       => 'sections-contact-title',
                'type'     => 'text',
                'title'    => __( 'Contact Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ), 
            array(
                'id'      => 'sections-contact-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ), 
            array(
                'id'       => 'sections-contact-shortcode',
                'type'     => 'text',
                'title'    => __( 'Contact form shortcode', 'redux-framework-demo' ),
                'desc'     => __( 'All HTML will be stripped.', 'redux-framework-demo' ),
                'validate' => 'no_html',
            ),  
            array(
                'id'       => 'sections-contact-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Contact Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-contact-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-contact-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Contact Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-contact-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-contact-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Contact Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-contact-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-contact-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Contact Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-contact-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-contact-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) ); 	
    //Team Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Team Section', 'redux-framework-demo' ),
        'id'               => 'sections-team',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-team-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-team-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-team .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ),
            array(
                'id'             => 'sections-team-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-team .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-team-border',
                'type'     => 'border',
                'title'    => __( 'Team Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-team .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-team-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-team-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-team-title',
                'type'     => 'text',
                'title'    => __( 'Team Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-team-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ), 
            array(
                'id'          => 'sections-team-slides',
                'type'        => 'mos_person',
                'title'       => __( 'Slides Options', 'redux-framework-demo' ),
                'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'redux-framework-demo' ),               
                /*'show' => array(
                    'title' => true,
                    'description' => true,
                    'url' => true
                ),
                'placeholder' => array(
                    'title'       => __( 'This is a title', 'redux-framework-demo' ),
                    'description' => __( 'Description Here', 'redux-framework-demo' ),
                    'url'         => __( 'Give us a link!', 'redux-framework-demo' ),
                ),*/
            ), 
            array(
                'id'       => 'sections-team-layout',
                'type'     => 'image_select',
                'title'    => __( 'Team Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => '2 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => '3 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => '4 Column',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '2col'
            ), 
            array(
                'id'       => 'sections-team-view',
                'type'     => 'select',
                'title'    => __( 'Team View', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'grid' => 'Grid',
                    'slider' => 'Slider',
                    
                ),
                'default'  => 'grid'
            ),           
            array(
                'id'       => 'sections-team-padding',
                'type'     => 'switch',
                'title'    => __( 'Space between each member', 'redux-framework-demo' ),
                'default'  => false,
            ),
            array(
                'id'            => 'sections-team-count',
                'type'          => 'slider',
                'title'         => __( 'Max number of member to show', 'redux-framework-demo' ),
                //'subtitle'      => __( 'This slider displays the value as a label.', 'redux-framework-demo' ),
                'desc'          => __( 'Team description. Min: 2, max: 24, step: 1, default value: 2', 'redux-framework-demo' ),
                'default'       => 2,
                'min'           => 2,
                'step'          => 1,
                'max'           => 24,
                'display_value' => 'label'
            ), 

            array(
                'id'       => 'sections-team-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Team Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-team-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-team-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Team Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-team-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-team-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Team Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-team-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-team-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Team Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-team-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-team-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );      
    //Gallery Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Gallery Section', 'redux-framework-demo' ),
        'id'               => 'sections-gallery',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-gallery-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-gallery-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-gallery .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-gallery-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-gallery .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-gallery-border',
                'type'     => 'border',
                'title'    => __( 'Gallery Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-gallery .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-gallery-animation',
                'type'     => 'select',
                'title'    => __( 'Animation Style for this section', 'redux-framework-demo' ),
                'options'  => $animations,
                'validate' => 'no_html',
            ),
            array(
                'id'       => 'sections-gallery-animation-delay',
                'type'     => 'text',
                'title'    => __( 'Animation Delay for this section', 'redux-framework-demo' ),
                'subtitle' => __( 'This must be numeric.', 'redux-framework-demo' ),
                'desc'     => __( 'Unit will be second.', 'redux-framework-demo' ),
                'validate' => 'numeric',
                'default'  => '0',
            ),
            array(
                'id'       => 'sections-gallery-title',
                'type'     => 'text',
                'title'    => __( 'Gallery Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),                    
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-gallery-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-gallery-images',
                'type'     => 'gallery',
                'title'    => __( 'Add/Edit Gallery', 'redux-framework-demo' ),                
            ),
            array(
                'id'            => 'sections-gallery-count',
                'type'          => 'slider',
                'title'         => __( 'Max number of images to show', 'redux-framework-demo' ),
                'subtitle'      => __( 'Set more than 1 for slider.', 'redux-framework-demo' ),
                'desc'          => __( 'Slider description. Min: 1, max: 30, step: 1, default value: 3', 'redux-framework-demo' ),
                'default'       => 3,
                'min'           => 1,
                'step'          => 1,
                'max'           => 30,
                'display_value' => 'label'
            ),
            array(
                'id'       => 'sections-gallery-layout',
                'type'     => 'image_select',
                'title'    => __( 'Gallery Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '3'
            ),

            array(
                'id'       => 'sections-gallery-small-size',
                'type'     => 'mos_group',                
                'title'    => 'Each Image Size',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Image Width',
                   'text_field_2' => 'Image Hwight',
                )
            ),

            array(
                'id'       => 'sections-gallery-large-size',
                'type'     => 'select',
                'title'    => __( 'Large Image Size', 'redux-framework-demo' ),
                'desc'     => __( 'Select an option.', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'actual' => __( 'Actual Size', 'redux-framework-demo' ),
                    'max'   => __( 'Max Size (Width 1920px)', 'redux-framework-demo' ),
                    'container'     => __( 'Container Size (Width 1140px)', 'redux-framework-demo' ),
                ),
                'actual'  => '2'
            ),
            array(
                'id'       => 'sections-gallery-view',
                'type'     => 'select',
                'title'    => __( 'Gallery View', 'redux-framework-demo' ),
                //Must provide key => value pairs for select options
                'options'  => array(
                    'grid' => 'Grid',
                    'slider' => 'Slider',
                    
                ),
                'default'  => 'grid'
            ), 
            array(
                'id'       => 'sections-gallery-gap',
                'type'     => 'checkbox',
                'title'    => __( 'Grid Spacing', 'redux-framework-demo' ),                
                'options'  => array(
                    '1' => 'Yes I like to use gap between grids.',
                ),
            ),  
            array(
                'id'       => 'sections-gallery-zoom',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Zoom Icon', 'redux-framework-demo' ),
                'compiler' => 'true',                
                'default'  => array( 'url' => get_template_directory_uri() . '/images/plus.png' ),
            ), 
            array(
                'id'       => 'sections-gallery-view-more',
                'type'     => 'mos_group',                
                'title'    => 'View More Link(if any)',
                'show' => array (
                    'text_field_1' => true,
                    'text_field_2' => true,
                    'text_field_3' => true,
                    'text_field_4' => true,
                ),
                'placeholder' => array(
                   'text_field_1' => 'Text',
                   'text_field_2' => 'URL',
                   'text_field_3' => 'Container Class',
                   'text_field_4' => 'Link Class',
                )
            ),  
            array(
                'id'       => 'sections-gallery-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Gallery Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-gallery-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-gallery-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Gallery Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-gallery-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-gallery-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Gallery Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-gallery-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-gallery-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Gallery Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-gallery-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-gallery-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );     
    //Sidebar Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Sidebar Section', 'redux-framework-demo' ),
        'id'               => 'sections-sidebar',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array( 
            array(
                'id'       => 'sections-sidebar-custom',
                'type'     => 'multi_text',
                'title'    => __( 'Add Sidebar', 'redux-framework-demo' ),
            ),            
            array(
                'id'       => 'sections-sidebar-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Sidebar Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-sidebar-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-sidebar-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Sidebar Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-sidebar-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-sidebar-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Sidebar Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-sidebar-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-sidebar-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Sidebar Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-sidebar-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-sidebar-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );  
    //Widgets Section
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Widgets Section', 'redux-framework-demo' ),
        'id'               => 'sections-widgets',
        'subsection'       => true,
        'desc'             => '',
        'customizer_width' => '450px',
        'icon'             => 'el el-move',
        'fields'     => array(  
            array(
                'id'       => 'sections-widgets-text-layout',
                'type'     => 'radio',
                'title'    => __( 'Inner Content Width', 'redux-framework-demo' ),
                'options'  => $container_list,
                'default'  => 'container'
            ),
            array(
                'id'             => 'sections-widgets-padding',
                'type'           => 'spacing',
                'mode'           => 'padding',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Padding', 'redux-framework-demo' ),
            ), 
            array(
                'id'             => 'sections-widgets-margin',
                'type'           => 'spacing',
                'mode'           => 'margin',
                'all'            => false,
                'units'          => array( 'em', 'px', '%', 'vw', 'vh' ),
                'units_extended' => 'true',
                'output'         => array( '#section-widgets .content-wrap' ),
                'title'          => __( 'Section Margin', 'redux-framework-demo' ),
            ),       
            array(
                'id'       => 'sections-widgets-border',
                'type'     => 'border',
                'title'    => __( 'Widgets Section Border', 'redux-framework-demo' ),
                'output'   => array( '#section-widgets .content-wrap' ),
                'all'      => false,
            ),
            array(
                'id'       => 'sections-widgets-title',
                'type'     => 'text',
                'title'    => __( 'Widgets Section Title', 'redux-framework-demo' ),
                'desc'     => 'You can use span tag ( &lt;span&gt;&lt;/span&gt;, &lt;strong&gt;&lt;/strong&gt;, &lt;em&gt;&lt;/em&gt;, &lt;br&gt;&lt;/br&gt;) here.',
                'validate'     => 'html_custom',
                'allowed_html' => array(
                    'br'     => array(),
                    'em'     => array(),
                    'strong' => array(),
                    'span' => array(
                        'id' => array(),
                        'class' => array()
                    )
                )
            ),
            array(
                'id'      => 'sections-widgets-content',
                'type'    => 'editor',
                'title'   => __( 'Section Content', 'redux-framework-demo' ),
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    //'tabindex' => 1,
                    //'editor_css' => '',
                    'teeny'         => false,
                    //'tinymce' => array(),
                    //'quicktags'     => false,
                )
            ),
            array(
                'id'       => 'sections-widgets-layout',
                'type'     => 'image_select',
                'title'    => __( 'Widgets Layout', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/1-col-portfolio.png'
                    ),
                    '2' => array(
                        'alt' => 'Full Width',
                        'img' => ReduxFramework::$_url . 'assets/img/2-col-portfolio.png'
                    ),
                    '3' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/3-col-portfolio.png'
                    ),
                    '4' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/4-col-portfolio.png'
                    )
                ),
                'default'  => '2col'
            ), 
            array(
                'id'       => 'sections-widgets-background-type',
                'type'     => 'button_set',
                'title'    => __( 'Widgets Background Type', 'redux-framework-demo' ),
                'options'  => array(
                    '1' => 'Gradient',
                    '2' => 'Solid Color/Image',
                    '3' => 'RGBA Color'
                ),
                'default'  => '2',
            ),

            array(
                'id'     => 'sections-widgets-background-start',
                'type'   => 'section',
                'indent' => true, // Indent all options below until the next 'section' option is set.
            ),
            array(
                'id'       => 'sections-widgets-background-gradient',
                'type'     => 'color_gradient',
                'title'    => __( 'Widgets Background', 'redux-framework-demo' ),
                'validate' => 'color',              
                'required' => array( 'sections-widgets-background-type', '=', '1' ),
            ),
            array(
                'id'       => 'sections-widgets-background-solid',
                'type'     => 'background',                
                'title'    => __( 'Widgets Section Background', 'redux-framework-demo' ),
                'required' => array( 'sections-widgets-background-type', '=', '2' ),
            ),
            array(
                'id'       => 'sections-widgets-background-rgba',
                'type'     => 'color_rgba',
                'title'    => __( 'Widgets Section Background', 'redux-framework-demo' ),
                'validate' => 'colorrgba',
                'required' => array( 'sections-widgets-background-type', '=', '3' ),
            ),
            array(
                'id'     => 'sections-widgets-background-end',
                'type'   => 'section',
                'indent' => false, // Indent all options below until the next 'section' option is set.
            ),
        )
    ) );    	

	/*
    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'redux-framework-demo' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
	*/
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a mosrokomari section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
/*    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }*/

