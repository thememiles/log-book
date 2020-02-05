<?php
//=============================================================
// Breadcrumb Options
//=============================================================
if ( ! function_exists( 'log_book_breadcrumb_action' ) ) :
    function log_book_breadcrumb_action() { 

    $breadcrumb_type = log_book_get_option( 'breadcrumb_type' );

    if($breadcrumb_type == 'normal'): ?>

            <!-- Breadcrumb Header -->
      
          <?php log_book_breadcrumb_trail(); ?>
         
        <!-- /Breadcrumb Header -->
	<?php
    endif; 
    }
endif;

add_action( 'log_book_breadcrumb_options', 'log_book_breadcrumb_action' );


//=============================================================
// Social Icon hook of the theme
//=============================================================
if ( ! function_exists( 'log_book_top_header_social_icon_action' ) ) :
	
	function log_book_top_header_social_icon_action() { ?>
		<div class="col-md-6 col-sm-12 social-links">
    		<?php if ( has_nav_menu( 'social' ) ) : ?>
                   <?php wp_nav_menu( array(
                        'theme_location'  => 'social',
                        'menu_id'         => '',
                        'menu_class'      => '',
                        'container_class' => 'social-icons',
                        
                    ) ); 
                    ?>
                 
               
            <?php endif; ?>
		</div>
	<?php }

endif;

add_action('log_book_top_header_social_icon', 'log_book_top_header_social_icon_action');

//=============================================================
// Footer Menu hook of the theme
//=============================================================
if ( ! function_exists( 'log_book_footer_menu_action' ) ) :
    
    function log_book_footer_menu_action() { ?>

           <?php if ( has_nav_menu( 'social' ) ) : ?>
                   <?php wp_nav_menu( array(
                        'theme_location'  => 'footer-menu',
                        'menu_id'         => '',
                        'menu_class'      => '',
            ) ); 
             endif; 
         }

endif;

add_action('log_book_footer_menu', 'log_book_footer_menu_action');



/**
 * enqueue Script for admin dashboard.
 */

if (!function_exists('log_book_widgets_backend_enqueue')) :
    function log_book_widgets_backend_enqueue($hook)
    {
        if ('widgets.php' != $hook)
        {
            return;
        }

        wp_register_script('log-book-custom-widgets', get_template_directory_uri() . '/assets/js/widget.js', array('jquery'), true);
        wp_enqueue_media();
        wp_enqueue_script('log-book-custom-widgets');
    }

    add_action('admin_enqueue_scripts', 'log_book_widgets_backend_enqueue');
endif;