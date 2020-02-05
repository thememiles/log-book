<?php
/**
 * Recommended plugins
 *
 * @package log-book
 * @version 1.0.1
 */
if ( ! function_exists( 'log_book_recommended_plugins' ) ) :
	/**
	 * Recommend plugins.
	 *
	 * @since 1.0.1
	 */
	function log_book_recommended_plugins() {
		
		$plugins = array(

			array(
				'name'     => esc_html__( 'One Click Demo Import', 'log-book' ),
				'slug'     => 'one-click-demo-import',
				'required' => false,
			),
			
	
			array(
				  'name'   => esc_html__( 'Contact Form, Drag and Drop Form Builder for WordPress Everest Forms', 'log-book' ),
				'slug'     => 'everest-forms',
				'required' => false,
			),

           array(
				'name'     => esc_html__( 'Mailchimp', 'log-book' ),
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),

			array(
				'name'     => esc_html__( 'Instagram Feed', 'log-book' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			),

			array(
				'name'     => esc_html__( 'Elementor', 'log-book' ),
				'slug'     => 'elementor',
				'required' => false,
			),

		);
		tgmpa( $plugins );
	}
endif;
add_action( 'tgmpa_register', 'log_book_recommended_plugins' );
