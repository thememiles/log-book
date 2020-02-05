<?php
/**
 * The template for displaying all pages
 * @package log-book
 * @version 1.0.1
 */
get_header(); ?>

<!-- Breadcrumb Header -->
    <div class="tm-breadcrumb" <?php echo $header_style; ?>>
        <div class="container">
            <h1 class="title"><?php echo esc_html__('Store','log-book'); ?></h1>
            <?php do_action( 'log_book_breadcrumb_options' ); ?>
        </div>
    </div>
<!-- /Breadcrumb Header -->
<div class="container">
    <!-- Main Content Area -->
    <section class="section-wrap">
        <div class="row">
             <div  class="col-md-12">
                <div class="tm-author-detail tm-content-box">
                  <?php if (have_posts()) :
                        woocommerce_content();
                    endif;
                    ?>
                       
                </div><!-- tm-author-detail -->
            </div>    

        </div><!-- .row -->
	</div>
</div>
<?php get_footer();