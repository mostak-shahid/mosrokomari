<?php
/*Small Changes*/
function mosrokomari_login_logo() { 
	global $mosrokomari_options;
	?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo wp_get_attachment_url( $mosrokomari_options["logo"]["id"] )?>);
            width: 100%;
            max-width: 320px;
            height:<?php echo $mosrokomari_options["logo"]["height"] ?>px;
    		background-size: contain;
    		background-repeat: no-repeat;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'mosrokomari_login_logo' );

function mosrokomari_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'mosrokomari_login_logo_url' );

function mosrokomari_login_logo_url_title() {
    return get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' );
}
add_filter( 'login_headertitle', 'mosrokomari_login_logo_url_title' );


/*Adding Css and JS*/
function mosrokomari_login_stylesheet() {
    wp_enqueue_style( 'style-login', get_template_directory_uri() . '/css/style-login.css' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'style-login', get_template_directory_uri() . '/js/style-login.js', 'jquery' );
}
add_action( 'login_enqueue_scripts', 'mosrokomari_login_stylesheet' );


/*Additional fields*/
function mosrokomari_additional_fields( $user_contact ) {

    // Add user contact methods
    $user_contact['phone']   = __( 'Phone' );
    $user_contact['address'] = __( 'Address' );

    // Remove user contact methods
    // unset( $user_contact['aim']    );
    // unset( $user_contact['jabber'] );

    return $user_contact;
}
add_filter( 'user_contactmethods', 'mosrokomari_additional_fields' );

/*Register fields*/
//1. Add a new form element...
add_action( 'register_form', 'mosrokomari_register_form' );
function mosrokomari_register_form() {

    $first_name = ( ! empty( $_POST['first_name'] ) ) ? sanitize_text_field( $_POST['first_name'] ) : '';
    $last_name = ( ! empty( $_POST['last_name'] ) ) ? sanitize_text_field( $_POST['last_name'] ) : '';
    $phone = ( ! empty( $_POST['phone'] ) ) ? sanitize_text_field( $_POST['phone'] ) : '';
    $address = ( ! empty( $_POST['address'] ) ) ? sanitize_text_field( $_POST['address'] ) : '';
        
    ?>
    <p class="first_name_con hide_after">
        <label for="first_name"><?php _e( 'First Name', 'mydomain' ) ?><br />
        <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(  $first_name  ); ?>" size="25" /></label>
    </p>
    <p class="last_name_con hide_after">
        <label for="last_name"><?php _e( 'Last Name', 'mydomain' ) ?><br />
        <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(  $last_name  ); ?>" size="25" /></label>
    </p>
    <p class="phone_con hide_after">
        <label for="phone"><?php _e( 'Phone', 'mydomain' ) ?><br />
        <input type="tel" name="phone" id="phone" class="input" value="<?php echo esc_attr(  $phone  ); ?>" size="25" /></label>
    </p>
    <p class="address_con hide_after">
        <label for="address"><?php _e( 'Address', 'mydomain' ) ?><br />
        <input type="text" name="address" id="address" class="input" value="<?php echo esc_attr(  $address  ); ?>" size="25" /></label>
    </p>
    <p class="address_con hide_after">
        <input type="button" name="next" id="next" class="button" value="Next">
    </p>
    <?php
}

//2. Add validation. In this case, we make sure first_name is required.
add_filter( 'registration_errors', 'mosrokomari_registration_errors', 10, 3 );
function mosrokomari_registration_errors( $errors, $sanitized_user_login, $user_email ) {
    
    if ( empty( $_POST['first_name'] ) || ! empty( $_POST['first_name'] ) && trim( $_POST['first_name'] ) == '' ) {
        $errors->add( 'first_name_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include a first name.', 'mydomain' ) ) );
    }    

    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'mosrokomari_user_register' );
function mosrokomari_user_register( $user_id ) {
    if ( ! empty( $_POST['first_name'] ) ) {
        update_user_meta( $user_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( ! empty( $_POST['last_name'] ) ) {
        update_user_meta( $user_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }
    if ( ! empty( $_POST['phone'] ) ) {
        update_user_meta( $user_id, 'phone', sanitize_text_field( $_POST['phone'] ) );
    }
    if ( ! empty( $_POST['address'] ) ) {
        update_user_meta( $user_id, 'address', sanitize_text_field( $_POST['address'] ) );
    }
}

/*Redirect*/

/*Login redirect*/
function mosrokomari_login_redirect( $redirect_to, $request, $user  ) {
    if (is_array( $user->roles )) {
        if (in_array( 'subscriber', $user->roles )) {
            return home_url('/dashboard/');
        } else {
            return admin_url();
        }
    } else {
        return home_url('/');
    }
    //return ( is_array( $user->roles ) && in_array( 'administrator', $user->roles ) ) ? admin_url() : home_url('/shopmanager/');
}
add_filter( 'login_redirect', 'mosrokomari_login_redirect', 10, 3 );

function mosrokomari_single_post_redirect () {
    if (get_post_type() == 'p_file' AND !is_user_logged_in()) {
        $url = home_url();
        ?>
        <script>window.location.href = '<?php echo home_url() ?>';</script>
        <?php 
        exit();
    }
}
add_action( 'wp_head', 'mosrokomari_single_post_redirect' );

/*Limit admin access*/
function mosrokomari_blockusers_init() {
    if ( is_admin() && !current_user_can( 'administrator' ) && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url('/dashboard/') );
        exit;
    }
}
add_action( 'init', 'mosrokomari_blockusers_init' );