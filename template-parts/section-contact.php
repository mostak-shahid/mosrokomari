<?php 
global $mosrokomari_options;
$animation = $mosrokomari_options['sections-contact-animation'];
$animation_delay = ( $mosrokomari_options['sections-contact-animation-delay'] ) ? $mosrokomari_options['sections-contact-animation-delay'] : 0;
$short_code = $mosrokomari_options['sections-contact-shortcode'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_banner', $page_details );
?>
<section id="section-contact" <?php if ($animation) echo 'data-wow-delay="'.$animation_delay.'s" class="wow '.$animation.'"' ?>>
	<div class="content-wrap">
		
		<?php 
		/*
		* action_before_contact hook
		* @hooked start_container 10 (output .container)
		*/
		do_action( 'action_before_contact', $page_details );
		?>			
			<?php 
			/*
			* action_before_contact_form hook
			* @hooked contact_title_fnc 10
			*/
			do_action( 'action_before_contact_form', $page_details );
			?>	
			<?php 
			/*
			* action_contact_form hook
			* @hooked contact_form_fnc 10
			*/
			do_action( 'action_contact_form', $page_details );
			?>			

			<?php do_action( 'action_after_contact_form', $page_details );?>

		<?php 
		/*
		* action_after_contact hook
		* @hooked end_div 10
		*/		
		do_action( 'action_after_contact', $page_details ); 
		?>		
		
	</div>
</section>
<?php do_action( 'action_below_contact', $post_slug ); ?>