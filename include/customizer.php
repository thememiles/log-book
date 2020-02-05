<?php
/**
 *Log Book: Customizer
 *
 * @package log-book
 * @version 1.0.1
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function log_book_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_image'  )->transport    = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
  

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title a',
		'render_callback' => 'log_book_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
		'render_callback' => 'log_book_customize_partial_blogdescription',
	) );
		
	/**
	 * Theme options.
	 */
	 $default = log_book_default_theme_options();
	 
	 $wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'log-book' ),
			'priority'   => 30,
			'capability' => 'edit_theme_options',
		)
	);
	
	// Header Section.
	$wp_customize->add_section( 'section_header',
		array(
			'title'      => esc_html__( 'Header Options', 'log-book' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);


	 /*Settings sidebar on front page*/
    $wp_customize->add_setting( 'log_book_sidebar', array(
        'capability'        => 'edit_theme_options',
        'default'           => $default['log_book_sidebar'],
        'sanitize_callback' => 'log_book_sanitize_select'
    ) );
    $wp_customize->add_control( 'log_book_sidebar', array(
        'choices' => array(
                'right-sidebar' => __('Right Sidebar','log-book'),
                'left-sidebar'  => __('Left Sidebar','log-book'),
               
            ),
        'label'         => __( 'Select Sidebar Options', 'log-book' ),
        'section'       => 'log_book_new_section_post',
        'settings'      => 'log_book_sidebar',
        'type'          => 'select',
        'priority'	    => 0
    ) );
	
	
	// Setting show_top_header.
	$wp_customize->add_setting( 'show_top_header',
		array(
			'default'           => $default['show_top_header'],
			'sanitize_callback' => 'log_book_sanitize_checkbox',
		)
	);
	
	$wp_customize->add_control( 'show_top_header',
		array(
			'label'    			=> esc_html__( 'Show Header - Top', 'log-book' ),
			'section'  			=> 'section_header',
			'type'     			=> 'checkbox',
			'priority' 			=> 100,
		)
	);
	

	// Breadcrumb Section.
	$wp_customize->add_section( 'section_breadcrumb',
		array(
			'title'      => esc_html__( 'Breadcrumb Options', 'log-book' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);
	
	// Setting breadcrumb_type.
	$wp_customize->add_setting( 'breadcrumb_type',
		array(
			'default'           => $default['breadcrumb_type'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'log_book_sanitize_select',
		)
	);
	
	$wp_customize->add_control( 'breadcrumb_type',
		array(
			'label'       => esc_html__( 'Breadcrumb Type', 'log-book' ),
			'section'     => 'section_breadcrumb',
			'type'        => 'radio',
			'priority'    => 100,
			'choices'     => array(
				'disable' => esc_html__( 'Disable', 'log-book' ),
				'normal'  => esc_html__( 'Normal', 'log-book' ),
			),
		)
	);
	
	// Layout Section.
	$wp_customize->add_section( 'log_book_new_section_general' , array(
   		'title'      => esc_html__('Layout Settings','log-book' ),
   		'description'=> '',
   		'priority'   => 10,
		'capability' => 'edit_theme_options',
	    'panel'      => 'theme_option_panel',
	) );
	
	// Setting Layout.
	$wp_customize->add_setting(
	        'home_style',
	        array(
	            'default'           => 'Simple',
				'sanitize_callback' => 'sanitize_text_field',
			
	        )
	    );
    	
    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'home_layout',
			array(
				'label'       =>  esc_html__('Home Style Layout','log-book'),
				'section'     => 'log_book_new_section_general',
				'settings'    => 'home_style',
				'type'        => 'radio',
				'priority'	  => 3,
				'choices'     => array(
					'Simple'  =>  esc_html__('Simple Style Layout','log-book'),
					'Grid'    =>  esc_html__('Grid Style Layout  [Premium Version]','log-book'),
					'List'    =>  esc_html__('List Style Layout [Premium Version]','log-book'),
					
				)
			)
		)
	);
    
	
    $wp_customize->add_setting(
        'home_sidebar',
        array(
            'default'           => false,
			'sanitize_callback' => 'log_book_sanitize_checkbox',
        )
    );
	
		
	$wp_customize->add_setting(
        'post_sidebar',
        array(
            'default'           => false,
			'sanitize_callback' => 'log_book_sanitize_checkbox',
        )
    );

	$wp_customize->add_setting(
        'archive_sidebar',
        array(
            'default'           => false,
			'sanitize_callback' => 'log_book_sanitize_checkbox',
        )
    );
	
	$wp_customize->add_setting(
        'pages_sidebar',
        array(
            'default'           => false,
			'sanitize_callback' => 'log_book_sanitize_checkbox',
        )
    );
	
	
   $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sidebar_homepage',
			array(
				'label'      =>  esc_html__('Disable Sidebar on Homepage','log-book'),
				'section'    => 'log_book_new_section_general',
				'settings'   => 'home_sidebar',
				'type'		 => 'checkbox',
				'priority'	 => 4
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sidebar_post',
			array(
				'label'      =>  esc_html__('Disable Sidebar on Posts','log-book'),
				'section'    => 'log_book_new_section_general',
				'settings'   => 'post_sidebar',
				'type'		 => 'checkbox',
				'priority'	 => 5
			)
		)
	);
		
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sidebar_archive',
			array(
				'label'      =>  esc_html__('Disable Sidebar on Archives','log-book'),
				'section'    => 'log_book_new_section_general',
				'settings'   => 'archive_sidebar',
				'type'		 => 'checkbox',
				'priority'	 => 6
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'pages_archive',
			array(
				'label'      =>  esc_html__('Disable Sidebar on Pages','log-book'),
				'section'    => 'log_book_new_section_general',
				'settings'   => 'pages_sidebar',
				'type'		 => 'checkbox',
				'priority'	 => 6
			)
		)
	);
	
	// Footer Section.
	$wp_customize->add_section( 'section_footer',
		array(
			'title'      => esc_html__( 'Footer Options', 'log-book' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);
	
	// Setting copyright_text.
	$wp_customize->add_setting( 'copyright_text',
		array(
			'default'           => $default['copyright_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control( 'copyright_text',
		array(
			'label'    => esc_html__( 'Copyright Text', 'log-book' ),
			'section'  => 'section_footer',
			'type'     => 'text',
			'priority' => 100,
		)
	);
	
	
	// Back To Top Section.
	$wp_customize->add_section( 'section_back_to_top',
		array(
			'title'      => esc_html__( 'Back To Top Options', 'log-book' ),
			'priority'   => 100,
			'capability' => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
		)
	);
	
	// Setting breadcrumb_type.
	$wp_customize->add_setting( 'back_to_top_type',
		array(
			'default'           => $default['back_to_top'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'log_book_sanitize_select',
		)
	);
	
	$wp_customize->add_control( 'back_to_top_type',
		array(
			'label'       => esc_html__( 'Active?', 'log-book' ),
			'section'     => 'section_back_to_top',
			'type'        => 'radio',
			'priority'    => 100,
			'choices'     => array(
				'disable' => esc_html__( 'Disable', 'log-book' ),
				'enable'  => esc_html__( 'Enable', 'log-book' ),
			),
		)
	);

	// Post Settings
	
	$wp_customize->add_section( 'log_book_new_section_post' , array(
   		'title'          => esc_html__('Post Settings','log-book' ),
   		'description'    => '',
   		'priority'       => 96,
		'capability'     => 'edit_theme_options',
			'panel'      => 'theme_option_panel',
	) );

    
	// Post Settings
	$wp_customize->add_setting(
        'article_tags',
        array(
            'default'          => false,
			'sanitize_callback'=> 'log_book_sanitize_checkbox',
        )
    );

	$wp_customize->add_setting(
        'article_author',
        array(
            'default'          => false,
			'sanitize_callback'=> 'log_book_sanitize_checkbox',
        )
    );

	$wp_customize->add_setting(
        'article_related_post',
        array(
            'default'          => false,
			'sanitize_callback'=> 'log_book_sanitize_checkbox',
        )
    );
	
	$wp_customize->add_setting(
        'article_next_post',
        array(
            'default'          => false,
			'sanitize_callback'=> 'log_book_sanitize_checkbox',
        )
    );
	$wp_customize->add_setting(
        'article_comment_link',
        array(
            'default'          => false,
			'sanitize_callback'=> 'log_book_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_setting(
	        'article_like_link',
	        array(
	            'default'          => false,
				'sanitize_callback'=> 'log_book_sanitize_checkbox',
	        )
	    );

    
		$wp_customize->add_setting(
	        'article_date_area',
	        array(
	            'default'          => false,
				'sanitize_callback'=> 'log_book_sanitize_checkbox',
	        )
	    );
		$wp_customize->add_setting(
	        'post_categories',
	        array(
	            'default'          => false,
				'sanitize_callback'=> 'log_book_sanitize_checkbox',
	        )
	    );
    
  	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_cat',
			array(
				'label'      =>  esc_html__('Hide Category','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'post_categories',
				'type'		 => 'checkbox',
				'priority'	 => 3
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_date',
			array(
				'label'      =>  esc_html__('Hide Date','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_date_area',
				'type'		 => 'checkbox',
				'priority'	 => 2
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_tags',
			array(
				'label'      =>  esc_html__('Hide Tags','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_tags',
				'type'		 => 'checkbox',
				'priority'	 => 5
			)
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_share_author',
			array(
				'label'      =>  esc_html__('Hide Post Navi','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_next_post',
				'type'		 => 'checkbox',
				'priority'	 => 8
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_comment_link',
			array(
				'label'      =>  esc_html__('Hide Comment Link','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_comment_link',
				'type'		 => 'checkbox',
				'priority'	 => 4
			)
		)
	);
    

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_author',
			array(
				'label'      =>  esc_html__('Hide Author Name','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_author',
				'type'		 => 'checkbox',
				'priority'	 => 1
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'post_related',
			array(
				'label'      =>  esc_html__('Hide Related Posts Box','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'article_related_post',
				'type'		 => 'checkbox',
				'priority'	 => 9
			)
		)
	);

    // Setting Read More Text.
	$wp_customize->add_setting( 'you_may_like_text',
		array(
			'default'           => $default['you_may_like_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control( 'you_may_like_text',
		array(
			'label'    => esc_html__( 'Related Posts Text', 'log-book' ),
			'section'  => 'log_book_new_section_post',
			'type'     => 'text',
			'priority' => 100,
		)
	);

     
    // Setting Read More Text.
	$wp_customize->add_setting( 'readmore_text',
		array(
			'default'           => $default['readmore_text'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	
	$wp_customize->add_control( 'readmore_text',
		array(
			'label'    => esc_html__( 'Continue Reading Button Text', 'log-book' ),
			'section'  => 'log_book_new_section_post',
			'type'     => 'text',
			'priority' => 100,
		)
	);


	 $wp_customize->add_setting(
        'sticky_sidebar',
        array(
            'default'           => 0,
			'sanitize_callback' => 'log_book_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'sticky_sidebar',
			array(
				'label'      => esc_html__('Disable Sticky Sidebar','log-book'),
				'section'    => 'log_book_new_section_post',
				'settings'   => 'sticky_sidebar',
				'type'		 => 'checkbox',
				'priority'	 => 0
			)
		)
	);

		
}

add_action( 'customize_register', 'log_book_customize_register' );


/**
 * Render the site title for the selective refresh partial.
 *
 * @since log-book 1.0.1
 * @see log_book_customize_register()
 *
 * @return void
 */
function log_book_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since log-book 1.0
 * @see log_book_customize_register()
 *
 * @return void
 */
function log_book_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function log_book_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Return whether we're on a view that supports a one or two column layout.
 */
function log_book_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

if ( ! function_exists( 'log_book_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function log_book_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true === $checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'log_book_sanitize_positive_integer' ) ) :

	/**
	 * Sanitize positive integer.
	 *
	 * @since 1.0.0
	 *
	 * @param int                  $input Number to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return int Sanitized number; otherwise, the setting default.
	 */
	function log_book_sanitize_positive_integer( $input, $setting ) {

		$input = absint( $input );

		// If the input is an absolute integer, return it.
		// otherwise, return the default.
		return ( $input ? $input : $setting->default );

	}

endif;

if ( ! function_exists( 'log_book_sanitize_select' ) ) :

	/**
	 * Sanitize select.
	 *
	 * @since 1.0.1
	 *
	 * @param mixed                $input The value to sanitize.
	 * @param WP_Customize_Setting $setting WP_Customize_Setting instance.
	 * @return mixed Sanitized value.
	 */
	function log_book_sanitize_select( $input, $setting ) {

		// Ensure input is clean.
		$input   = sanitize_text_field( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

	}

endif;



if ( ! function_exists( 'log_book_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function log_book_default_theme_options() {

		$defaults                               = array();

		// Header.
		$defaults['show_top_header']            = false;

		// Sidebar Options.
		$defaults['log_book_sidebar']           ='right-sidebar';

		// Post.
		$defaults['readmore_text']              = esc_html__( 'Continue Reading', 'log-book' );

		$defaults['you_may_like_text']          = esc_html__( 'Related Post', 'log-book' );

		//Back To Top
		$defaults['back_to_top']                = 'enable';

		// Footer.
		$defaults['copyright_text']             = esc_html__( 'Copyright &copy; All rights reserved.', 'log-book' );

		// Breadcrumb.
		$defaults['breadcrumb_type']            = 'normal';
		
		//slider active
		$defaults['log-book_feature_post_status']= false;
		
		return $defaults;
	}

endif;

if ( ! function_exists( 'log_book_is_top_header_active' ) ) :

	/**
	 * Check if featured slider is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function log_book_is_top_header_active( $control ) {

		if ( true == $control->manager->get_setting( 'show_top_header' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'log_book_get_option' ) ) :

	/**
	 * Get theme option.
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function log_book_get_option( $key ) {

		if ( empty( $key ) ) {

			return;

		}

		$value            = '';

		$default          = log_book_default_theme_options();

		$default_value    = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {

			$default_value = $default[ $key ];

		}

		if ( null !== $default_value ) {

			$value = get_theme_mod( $key, $default_value );

		}else {

			$value = get_theme_mod( $key );

		}

		return $value;

	}

endif;

if ( ! function_exists( 'log_book_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see log-book_custom_header_setup().
 */
function log_book_header_style() { 

$header_text_color = get_header_textcolor();
	if( !empty( $header_text_color ) ): ?>
		<style type="text/css">
			   .site-header a,
			   .site-header p{
					color: #<?php echo esc_attr( $header_text_color ); ?>;
			   }
		</style>
			
		<?php
	endif;
}

endif;

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function log_book_customize_preview_js() {
	wp_enqueue_script( 'log-book-customize-preview', get_theme_file_uri( '/assets/js/customize-preview.js' ), array( 'customize-preview' ), '1.0', true );
}
add_action( 'customize_preview_init', 'log_book_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function log_book_panels_js() {
	wp_enqueue_script( 'log-book-customize-controls', get_theme_file_uri( '/assets/js/customize-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'log_book_panels_js' );
