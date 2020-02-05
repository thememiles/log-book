<?php
/**
 * The template for displaying 404 pages (not found)
 * @package log-book
 * @version 1.0.1
 */
get_header(); ?>

<!-- Breadcrumb Header -->
    <div class="tm-breadcrumb" <?php echo $header_style; ?>>
        <div class="container">
            <h1 class="title"><?php echo esc_html__("404 - Not Found","log-book");?></h1>
            <?php do_action( 'log_book_breadcrumb_options' ); ?>
        </div>
    </div>
    <!-- /Breadcrumb Header -->
    <div class="container">
        <!-- Main Content Area -->
        <section class="section-wrap">
            <div class="row">
                <div class="col-sm-12"> 
                    <div class="tm-content-box notfound">
                        <h1><?php echo esc_html__("404","log-book");?></h1>
                        <p><?php echo esc_html__("Oops! The page you are looking for does not exist or may be down","log-book");?></p>
                        <hr>
                        <a href="<?php echo esc_url(home_url()); ?>" class="btn btn-colored"><?php echo esc_html__("back to home page","log-book");?></a>
                    </div>
                </div>              
            </div>
        </section>
        <!-- /Main Content Area -->
    </div>
<?php get_footer();
