<?php
/**
 * The header for our theme
 *
 * @package log-book
 * @version 1.0.1
 */
// For top header
$header_status    = log_book_get_option( 'show_top_header' );
$back_to_top_type = log_book_get_option( 'back_to_top_type' );
$unique_id        = esc_attr( uniqid( 'search-form-' ) );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
  if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}

if($back_to_top_type == 'enable'): ?>
  <div id="backTop"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
<?php endif; ?>

 <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e('Skip to content', 'log-book'); ?></a>
	
<?php if( $header_status == '1' ): ?>
<!-- Topbar -->
    <div class="tm-topbar">
        <div class="container">
            <!-- Social Links -->
            <div class="social-icons">
                <?php   do_action( 'log_book_top_header_social_icon' );?>
                
            </div>
            <!-- /Social Links -->

            <!-- Language and search -->
            <div class="search-area">
               
                <div class="search-top">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input  type="search" id="<?php echo $unique_id; ?>" class="form-control" type="text" placeholder="<?php echo esc_attr__( "Search &hellip;","log-book" ); ?>" value="<?php echo get_search_query(); ?>" name="s"/>
                        <button type="submit" class="btn btn-colored" name="submit" value="">
                            <span class="icon-magnifying-glass"></span>
                        </button>
                    </form>    
                </div>
            </div>
            <!-- /Language and search -->
        </div>
    </div>
    <!-- /Topbar -->
 <?php endif; ?>
    <!-- Menu Bar -->
    <div class="menu-bar default">
        <div class="container">

            <div class="logo-top">
               <?php get_template_part( 'template-parts/header/site', 'branding' ); ?></a>
            </div>

            <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <div class="menu-links">
                 <?php wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'main-menu',
                        ) ); 
                        ?>
            </div>
            <?php endif; ?>
          
        </div>
    </div>
    <!-- /Menu Bar -->


    <!-- Mobile Menu -->
  
    <div id="dl-menu" class="dl-menuwrapper">
        <button class="dl-trigger"><?php esc_html_e('Open Menu','log-book'); ?></button>
         <?php wp_nav_menu( array(
            'container'       => false, 
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'dl-menu',
            ) ); 
            ?>
      
    </div><!-- /dl-menuwrapper -->
    <!-- /Mobile Menu -->
     <?php 

    // Custom image.
    global $header_image, $header_style;
    $header_image = get_header_image();
 
    if( $header_image ){
        $header_style = 'style="background-image: url('.esc_url( $header_image ).');"';                 

    } else{

        $header_style = '';
    }

    ?>
	