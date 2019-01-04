<?php
show_admin_bar( false );
function mos_excerpt_more($more) {
    global $post;
    //return ' <a class="moretag btn btn-primary" href="'. get_permalink($post->ID) . '">Read More »</a>'; //Change to suit your needs
    return ''; //Change to suit your needs
} 
add_filter( 'excerpt_more', 'mos_excerpt_more' );

//with template 
//mosrokomari_add_page('puppy-home', 'Puppy Home', 'templates/template-puppies-home.php');
//without template
//mosrokomari_add_page('csvimport', 'CSV Import', 'default');
function mos_add_page($page_slug, $page_title, $page_template) {
    $page = get_page_by_path( $page_slug , OBJECT );
    //var_dump($page);
    if(!$page){
        $page_details = array(
            'post_title' => $page_title,
            'post_name' => $page_slug,
            'post_date' => gmdate("Y-m-d h:i:s"),
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page',
        );
        $page_id = wp_insert_post( $page_details );
        add_post_meta( $page_id, '_wp_page_template', $page_template );
    }
}
// Function to get the client IP address
function mos_get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function get_child_pages_by_parent_id($pageId,$limit = -1) {
    $pages = array();
    $args = array(
        'post_type' => 'page',
        'post_parent' => $pageId,
        'posts_per_page' => $limit
    );
    $the_query = new WP_Query( $args );
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $pages[get_the_permalink()] = get_the_title();
    }
    wp_reset_postdata();
    return $pages;
}
/**
 * Menu fallback. Link to the menu editor if that is useful.
 *
 * @param  array $args
 * @return string
 */
function mos_link_to_menu_editor( $args ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
    // see wp-includes/nav-menu-template.php for available arguments
    extract( $args );
    $link = $link_before
        . '<a href="' .admin_url( 'nav-menus.php' ) . '">' . $before . 'Add a menu' . $after . '</a>'
        . $link_after;
    // We have a list
    if ( FALSE !== stripos( $items_wrap, '<ul' ) or FALSE !== stripos( $items_wrap, '<ol' )) {
        $link = "<li>$link</li>";
    }
    $output = sprintf( $items_wrap, $menu_id, $menu_class, $link );
    if ( ! empty ( $container ) ){
        $output  = "<$container class='$container_class' id='$container_id'>$output</$container>";
    }
    if ( $echo ) {
        echo $output;
    }
    return $output;
}
function get_attachment_id( $url ) {
    $attachment_id = 0;
    $dir = wp_upload_dir();
    if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
        $file = basename( $url );
        $query_args = array(
            'post_type'   => 'attachment',
            'post_status' => 'inherit',
            'fields'      => 'ids',
            'meta_query'  => array(
                array(
                    'value'   => $file,
                    'compare' => 'LIKE',
                    'key'     => '_wp_attachment_metadata',
                ),
            )
        );
        $query = new WP_Query( $query_args );
        if ( $query->have_posts() ) {
            foreach ( $query->posts as $post_id ) {
                $meta = wp_get_attachment_metadata( $post_id );
                $original_file       = basename( $meta['file'] );
                $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                    $attachment_id = $post_id;
                    break;
                }
            }
        }
    }
    return $attachment_id;
}

//add_action('admin_bar_menu', 'mos_admin_bar_menu', 100);
function mos_admin_bar_menu($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'theme-option',
        'title' => 'Theme Option',
        'href'  => '#',
        'meta'  => array(
            'title' => __('Theme Option'),   
            'class' => 'theme_option'         
        ),
    ));
    /*$admin_bar->add_menu( array(
        'id'    => 'my-sub-item',
        'parent' => 'my-item',
        'title' => 'My Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Sub Menu Item'),
            'target' => '_mosrokomari',
            'class' => 'my_menu_item_class'
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'my-second-sub-item',
        'parent' => 'my-item',
        'title' => 'My Second Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Second Sub Menu Item'),
            'target' => '_mosrokomari',
            'class' => 'my_menu_item_class'
        ),
    ));*/
}

//For 4.9 page template not found
function wp_42573_fix_template_caching( WP_Screen $current_screen ) {
    // Only flush the file cache with each request to post list table, edit post screen, or theme editor.
    if ( ! in_array( $current_screen->base, array( 'post', 'edit', 'theme-editor' ), true ) ) {
        return;
    }
    $theme = wp_get_theme();
    if ( ! $theme ) {
        return;
    }
    $cache_hash = md5( $theme->get_theme_root() . '/' . $theme->get_stylesheet() );
    $label = sanitize_key( 'files_' . $cache_hash . '-' . $theme->get( 'Version' ) );
    $transient_key = substr( $label, 0, 29 ) . md5( $label );
    delete_transient( $transient_key );
}
//add_action( 'current_screen', 'wp_42573_fix_template_caching' );

// add more buttons to the html editor
function mos_add_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
        //QTags.addButton( id*, display*, arg1*, arg2, access_key, title, priority, instance );
        QTags.addButton( 'home_url', 'Home URL', '[home_url]' );
        QTags.addButton( 'phone_number', 'Phone Number', '[phone_number number=\'\']', '[/phone_number]' );
        /*function manage_phone_number() {
            var phone_number = prompt( 'Enter a phone number:', '' );
            if ( phone_number ) {
                QTags.insertContent('<a href="tel:[phone_number number=\'' + phone_number +'\']"></a>');
            } else {
                QTags.insertContent('<a href="tel:[phone_number]"></a>');
            }
        }*/


        QTags.addButton( 'eg_hr', 'hr', '<hr />', '', 'h', 'Horizontal rule line', 201 );
        QTags.addButton( 'my_prompt', 'Add Class', my_prompt );
        function my_prompt() {
            var my_class = prompt( 'Enter a class name:', '' );

            if ( my_class ) {
                QTags.insertContent(' class="' + my_class +'"');
            }
        }
    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'mos_add_quicktags' );


function get_formadable_form_list () {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if ( is_plugin_active( 'formidable/formidable.php' ) ) {
        global $wpdb;
        $results = $wpdb->get_results( "SELECT * FROM `".$wpdb->prefix."frm_forms` WHERE `status`!='trash' AND `is_template`='0'" );
        $forms = array('0' => 'Select a Form');
        foreach ($results as $result) {
            $forms[$result->id] = $result-> name;       
        }
        return $forms;
    } 
    return false;

}
function get_all_pages_list_with_link () {
    $output = array();
    $pages = get_pages(); 
    foreach ( $pages as $page ) {
        $output[get_page_link( $page->ID )] = $page->post_title;
    }
    return $output;
}
function get_all_pages_list_with_id () {
    $output = array();
    $pages = get_pages(); 
    foreach ( $pages as $page ) {
        $output[$page->ID] = $page->post_title;
    }
    return $output;
}
function mos_admin_notice_csv () {
    global $post_type, $pagenow;
    //post=16&action=edit
    $post_id = @$_GET['post'];
    $action = @$_GET['action'];
    //string(4) "page" string(8) "edit.php"
    //$pagenow == 'edit.php' AND $post_type == 'page'
    if ($post_id AND $action == 'edit') : ?>
            <div class="notice notice-info">
                <p><a href="<?php echo admin_url( 'admin-ajax.php' ) ?>?action=reset_prl&post_id=<?php echo $post_id ?>">Click here</a> to reset "Page Row Layout"</p>
            </div>

    <?php endif;

}
add_action( 'admin_notices', 'mos_admin_notice_csv' );

function mos_split_sentences($data) {
    $split_sentences = '%(?#!php/i split_sentences Rev:20160820_1800)
        # Split sentences on whitespace between them.
        # See: http://stackoverflow.com/a/5844564/433790
        (?<=          # Sentence split location preceded by
          [.!?]       # either an end of sentence punct,
        | [.!?][\'"]  # or end of sentence punct and quote.
        )             # End positive lookbehind.
        (?<!          # But don\'t split after these:
          Mr\.        # Either "Mr."
        | Mrs\.       # Or "Mrs."
        | Ms\.        # Or "Ms."
        | Jr\.        # Or "Jr."
        | Dr\.        # Or "Dr."
        | Prof\.      # Or "Prof."
        | Sr\.        # Or "Sr."
        | T\.V\.A\.   # Or "T.V.A."
                     # Or... (you get the idea).
        )             # End negative lookbehind.
        \s+           # Split on whitespace between sentences,
        (?=\S)        # (but not at end of string).
        %xi';  // End $split_sentences.

    $sentences = preg_split($split_sentences, $data, -1, PREG_SPLIT_NO_EMPTY);
}


function be_attachment_field_credit( $form_fields, $post ) {
    $form_fields['media-url'] = array(
        'label' => 'Media URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'media_url', true ),
        'helps' => 'If necessary',
    );
 
    /*$form_fields['be-photographer-url'] = array(
        'label' => 'Photographer URL',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'be_photographer_url', true ),
        'helps' => 'Add Photographer URL',
    );*/
 
    return $form_fields;
}
 
add_filter( 'attachment_fields_to_edit', 'be_attachment_field_credit', 10, 2 );
 
/**
 * Save values of Photographer Name and URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */
 
function be_attachment_field_credit_save( $post, $attachment ) {
    if( isset( $attachment['be-photographer-name'] ) )
        update_post_meta( $post['ID'], 'be_photographer_name', $attachment['be-photographer-name'] );
 
    if( isset( $attachment['be-photographer-url'] ) )
        update_post_meta( $post['ID'], 'be_photographer_url', esc_url( $attachment['be-photographer-url'] ) );
 
    return $post;
}
 
add_filter( 'attachment_fields_to_save', 'be_attachment_field_credit_save', 10, 2 );

function mobile_menu ($value) {
    global $mosrokomari_options;
    $contact_phone = $mosrokomari_options['contact-phone'];
    $contact_email = $mosrokomari_options['contact-email'];
    $size = sizeof($value) - 1;
    if ($size == 3) {
        $tc = 'row icon-menu';
        $bc = 'col-xs-4';
    }
    elseif ($size == 2) {
        $tc = 'row text-menu';
        $bc = 'col-xs-6';
    }
    else {
        $tc = 'full-menu';
        $bc = '';
    }
    ?>
    <div class="<?php echo $tc ?>">
    <?php foreach ( $value as $key => $value ) : ?>
        <?php if ( $key == 'menu' ) : ?>  
        <div class="<?php echo $bc ?>">              
            <a href="javascript:void(0)" class="small-menu">
                <i class="fa fa-bars"></i><span class="text"> Menu</span> 
            </a>
        </div>
        <?php elseif ( $key == 'phone' ) : ?>
            <div class="<?php echo $bc ?>">
                <a class="small-phone" href="tel:<?php echo preg_replace('/[^0-9]/', '', $contact_phone[0]) ?>"><i class="fa fa-phone-square"></i><span class="text"> Call Us</span></a>
            </div>
            
        <?php elseif ( $key == 'email' ) : ?>
            <div class="<?php echo $bc ?>">
                <a class="small-email" href="mailto:<?php echo $contact_email[0];?>"><i class="fa fa-envelope"></i><span class="text"> Email Us</span></a> 
            </div>        
        <?php elseif ( $key == 'smlogo' ) : ?>
            <div class="sm-logo">
                <?php
                    $attachment_id = get_option( 'site_icon' );
                    $img_url = aq_resize(wp_get_attachment_url( $attachment_id ), 33, 33, true);
                ?>
                <a class="small-logo" href="<?php echo home_url();?>"><img src="<?php echo $img_url ?>" alt="<?php echo get_bloginfo( 'name' ) ?> - Logo" width="33" height="33"></a> 
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>


        <?php

}

function mos_get_terms ($taxonomy = 'category') {
    global $wpdb;
    $output = array();
    $all_taxonomies = $wpdb->get_results( "SELECT {$wpdb->prefix}term_taxonomy.term_id, {$wpdb->prefix}term_taxonomy.taxonomy, {$wpdb->prefix}terms.name, {$wpdb->prefix}terms.slug, {$wpdb->prefix}term_taxonomy.description, {$wpdb->prefix}term_taxonomy.parent, {$wpdb->prefix}term_taxonomy.count, {$wpdb->prefix}terms.term_group FROM {$wpdb->prefix}term_taxonomy INNER JOIN {$wpdb->prefix}terms ON {$wpdb->prefix}term_taxonomy.term_id={$wpdb->prefix}terms.term_id", ARRAY_A);

    foreach ($all_taxonomies as $key => $value) {
        if ($value["taxonomy"] == $taxonomy) {
            $output[] = $value;
        }
    }
    return $output;
}
//$terms = mos_get_terms ("testimonial-category");


/********************/
/** Theme Speed Up **/
/********************/
/*Defer parsing of javascript.*/
if (!(is_admin() )) {
    function mos_academy_defer_parsing_of_js ( $url ) {
        if ( FALSE === strpos( $url, '.js' ) ) return $url;
        if ( strpos( $url, 'jquery.js' ) ) return $url;
        // return "$url' defer ";
        return "$url' defer onload='";
    }
    add_filter( 'clean_url', 'mos_academy_defer_parsing_of_js', 11, 1 );
}
/*Remove query string*/
function mos_academy_remove_script_version( $src ){ 
    $parts = explode( '?', $src );  
    return $parts[0]; 
} 
add_filter( 'script_loader_src', 'mos_academy_remove_script_version', 15, 1 ); 
add_filter( 'style_loader_src', 'mos_academy_remove_script_version', 15, 1 );
