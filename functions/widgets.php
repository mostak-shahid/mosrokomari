<?php
//Add widgets area
function mosrokomari_widgets_init(){
	global $mosrokomari_options;
	if (@$mosrokomari_options['sections-sidebar-custom']) : 
		foreach ($mosrokomari_options['sections-sidebar-custom'] as $name) {
			$id = strtolower(str_replace(' ', '_', $name));
			register_sidebar(array(
				'id' => $id,
				'name' => __($name, 'mosrokomari'),
				//'description' => __('Add widgets here to appear in your Left SideBar', 'mosrokomari'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
				'after_widget' => '</div>'
			));	
		}
	endif; 
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar for Post', 'mosrokomari'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'sidebar-page',
		'name' => __('Sidebar for Page', 'mosrokomari'),
		//'description' => __('Add widgets here to appear in your Left SideBar', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_1',
		'name' => __('Footer Column 1', 'mosrokomari'),
		'description' => __('Add widgets here to appear in your Footer Column 1', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_2',
		'name' => __('Footer Column 2', 'mosrokomari'),
		'description' => __('Add widgets here to appear in your Footer Column 2', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_3',
		'name' => __('Footer Column 3', 'mosrokomari'),
		'description' => __('Add widgets here to appear in your Footer Column 3', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));	
	register_sidebar(array(
		'id' => 'footer_4',
		'name' => __('Footer Column 4', 'mosrokomari'),
		'description' => __('Add widgets here to appear in your Footer Column 4', 'mosrokomari'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
		'after_widget' => '</div>'
	));		
	register_widget( 'Mos_Contact_Widget' );	
	register_widget( 'Mos_Contact_Widget_Email' );
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );	
	if( is_plugin_active( 'formidable/formidable.php' ) ) {
		register_widget( 'Mos_Formadable_Form' );	
	}
}
add_action('widgets_init', 'mosrokomari_widgets_init');

class Mos_Formadable_Form extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mos-formadable-form', // Base ID
			__( 'Mos Formidable Form' ), // Name
			array( 
				'description' => __( 'Formadable Form widgets with custom heading' ), 
				'classname' => 'widget_mos_formadable_form'
			) // Args
		);
	}
	public function widget( $args, $instance ) {
		?>
		<?php echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
			<div class="widget_mos_formadable_form_unit">
				<h2 class="form-title">
				<?php 
				global $mosrokomari_options;
				$contact_phone = $mosrokomari_options['contact-phone'];
				?>

				<span class="call">
					<span class="hidden-xs hidden-sm">Call us on <a class="clickToShow" href="tel:<?php echo $contact_phone ?>"><?php echo $contact_phone ?></a></span>
					<span class="hidden-md hidden-lg"><a href="tel:<?php echo $contact_phone ?>">Tap to Call</a></span>
				</span> or contact us using the form below for an obligation free quote.
				</h2>
				<?php if ($instance['form']) : ?>
				<div class="form-container">
						<?php echo FrmFormsController::get_form_shortcode( array( 'id' => $instance['form'], 'title' => false, 'description' => false ) ); ?>
				</div>
				<?php endif; ?>

			</div>
		<?php echo $args['after_widget'] ?>
<?php
	}
	public function form( $instance ) {
		?>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo __( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
			</p>
		</div>
		<div>
			<p>
			<?php $forms = get_formadable_form_list();?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>"><?php echo __( 'Form:' ); ?></label> 
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form' ) ); ?>" >
			<?php foreach ($forms as $key => $value) : ?>
				<option value="<?php echo $key ?>" <?php selected( $instance['form'], $key ) ?>><?php echo $value ?></option>
			<?php endforeach; ?>
			</select>			
			</p>
		</div>
		<?php 
	}
	//Save form data into database *Necessary if you want to modify the input values
	// public function update( $new_instance, $old_instance ) {
	// 	$instance = array();
	// 	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	// 	$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
	// 	$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';

	// 	return $instance;
	// }

}

class Mos_Contact_Widget_Email extends WP_Widget {
	function __construct() {
		parent::__construct(
			'mos-contact-widget-default', // Base ID
			__( 'Mos Contact Without Map' ), // Name
			array( 
				'description' => __( 'Contact info box with address, phone number and email' ), 
				'classname' => 'widget_mos_contact'
			) // Args
		);
	}
	public function widget( $args, $instance ) {
		?>
		<?php echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
			<div class="mos_contact_default">
				<p class="flex-container widgets-address">
					<img src="<?php echo get_template_directory_uri() . '/images/widgets-address.png' ?>" alt="<?php echo $alt_tag['inner'] . 'Address Icon'?>">
					<span><?php echo $instance['address'] ?></span>
				</p>
				<p class="flex-container widgets-email">					
					<img src="<?php echo get_template_directory_uri() . '/images/widgets-email.png' ?>" alt="<?php echo $alt_tag['inner'] . 'Email Icon'?>">
					<a href="mailto:<?php echo $instance['email'] ?>"><?php echo $instance['email'] ?></a>
				</p>
				<p class="flex-container widgets-call">					
					<img src="<?php echo get_template_directory_uri() . '/images/widgets-phone.png' ?>" alt="<?php echo $alt_tag['inner'] . 'Phone Icon'?>">
					<span class="hidden-xs hidden-sm"><a class="clickToShow" href="tel:<?php echo $instance['phone'] ?>"><?php echo $instance['phone'] ?></a><!-- <a href="javascript:toggle();" class="clickToShowButton"><?php echo  substr($instance['phone'],0,2) ?> show number</a> -->
					</span>
					<span class="visible-xs visible-sm"><a href="tel:<?php echo $instance['phone'] ?>">Tap to Call</a></span>
				</p>
			</div>
		<?php echo $args['after_widget'] ?>
<?php
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	//Generate the form
	public function form( $instance ) {
		?>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo __( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
			</p>
		</div>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php echo __( 'Address:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo $instance['address']; ?>">
			</p>
		</div>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php echo __( 'Phone:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="tel" value="<?php echo $instance['phone']; ?>">
			</p>
		</div>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"><?php echo __( 'Email:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>" type="tel" value="<?php echo $instance['email']; ?>">
			</p>
		</div>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	//Save form data into database *Necessary if you want to modify the input values
	// public function update( $new_instance, $old_instance ) {
	// 	$instance = array();
	// 	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	// 	$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
	// 	$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';

	// 	return $instance;
	// }

} // class Mos_Contact_Widget_Email
/**
 * Adds Mos_Contact_Widget widget.
 */
class Mos_Contact_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	//Show widget unit in admin pannel
	function __construct() {
		parent::__construct(
			'mos-contact-widget', // Base ID
			__( 'Mos Contact With Map' ), // Name
			array( 
				'description' => __( 'Contact info box with address, phone number and google map' ), 
				'classname' => 'widget_mos_contact'
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	//Show widget unit in Front end
	public function widget( $args, $instance ) {
		// echo $args['before_widget'];
		// if ( ! empty( $instance['title'] ) ) {
		// 	echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		// }
		// echo esc_html__( 'Hello, World!', 'text_domain' );
		// echo $args['after_widget'];
		?>
		<?php echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		?>
			<div class="mos_contact">
				<?php if ($instance['address']) : ?>
				<p class="widgets-address"><?php echo $instance['address'] ?></p>
				<?php endif; ?>
				<?php if ($instance['phone']) : ?>
				<p class="widgets-call">
					<span class="hidden-xs"><a class="clickToShow" href="tel:<?php echo $instance['phone'] ?>" style="display: none;"><?php echo $instance['phone'] ?></a><a href="javascript:toggle();" class="clickToShowButton"><?php echo  substr($instance['phone'],0,2) ?> show number</a>
					</span>
					<span class="visible-xs"><a href="tel:<?php echo $instance['phone'] ?>">Tap to Call</a></span>
				</p>
				<?php endif; ?>
				<p class="widgets-map"><a class="map-holder" href="<?php echo $instance['map_url'] ?>" target="_mosrokomari" rel="noopener noreferrer"><img class="alignnone wp-image-434 size-full img-responsive img-center" src="<?php echo $instance['map_img'] ?>" alt="Location"></a></p>
			</div>
		<?php echo $args['after_widget'] ?>
<?php
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	//Generate the form
	public function form( $instance ) {
		?>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo __( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $instance['title']; ?>">
			</p>
		</div>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>"><?php echo __( 'Address:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'address' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'address' ) ); ?>" type="text" value="<?php echo $instance['address']; ?>">
			</p>
		</div>
		<div>
			<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>"><?php echo __( 'Phone:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'phone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'phone' ) ); ?>" type="tel" value="<?php echo $instance['phone']; ?>">
			</p>
		</div>
		<div>
			<p>
			<?php $map_img = $instance['map_img']? $instance['map_img'] : get_template_directory_uri() . '/images/google-maps-logo-480.jpg';?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'map_url' ) ); ?>"><?php echo __( 'Map Url:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'map_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'map_url' ) ); ?>" type="url" value="<?php echo $instance['map_url']; ?>">
			</p>
			<div class="map-img-wrapper">
				<img src="<?php echo $map_img ?>" alt="">
			</div>
			<div class="button-wrapper">
				<button type="button" class="button btn-success btn-half-block open-window left">Upload Image</button>
				<button type="button" class="button btn-danger btn-half-block remove-img right">Remove Image</button>
				<input class="map_img_url" id="<?php echo esc_attr( $this->get_field_id( 'map_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'map_img' ) ); ?>" type="hidden" value="<?php echo $map_img ?>">
			</div>
		</div>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	//Save form data into database *Necessary if you want to modify the input values
	// public function update( $new_instance, $old_instance ) {
	// 	$instance = array();
	// 	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	// 	$instance['address'] = ( ! empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
	// 	$instance['phone'] = ( ! empty( $new_instance['phone'] ) ) ? strip_tags( $new_instance['phone'] ) : '';

	// 	return $instance;
	// }

} // class Mos_Contact_Widget