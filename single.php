<?php
/**
 * The template for displaying all single posts
 * @package log-book
 * @version 1.0.1
 */

$breadcrumb_type = log_book_get_option( 'breadcrumb_type' );

get_header();

 if($breadcrumb_type == 'normal'): 

?>

<!-- Breadcrumb Header -->
    <div class="tm-breadcrumb" <?php echo $header_style; ?>>
        <div class="container">
            <h1 class="title"><?php the_title(); ?></h1>
            <?php do_action( 'log_book_breadcrumb_options' ); ?>
        </div>
    </div>
    <!-- /Breadcrumb Header -->
<?php endif; ?>    

<div class="container">
    <!-- Main Content Area -->
    <section class="section-wrap">
        <div class="row">
            <div <?php if(get_theme_mod('post_sidebar')==true) : ?> class="col-md-12" <?php else: ?>class="col-md-8 left-block" <?php endif; ?> >
                   
                    <?php
                        /* Start the Loop */
                        while ( have_posts() ) : the_post();
            
                            get_template_part( 'template-parts/post/single');
						
                        if(!get_theme_mod('article_next_post')) :
                       
                           echo"<div class='tm-post-nav'>";	
     
                            the_post_navigation( array(
                                    'prev_text' => '<div class="prev-post"><div class="arrow"><i class="fa fa-arrow-left" aria-hidden="true"></i>' . __( ' <strong></strong>', 'log-book' ) . '</div>
                                        <div class="post-title">
                                <strong><div>' . __( 'Previous Post', 'log-book' ) . '</div></strong>
                                <p>%title</p></div></div>',

                                    'next_text' => ' <div class="next-post">
                            <div class="arrow"><i class="fa fa-arrow-right" aria-hidden="true"></i>' . __( '', 'log-book' ) . '</div>
                            <div class="post-title">
                                <strong><div>' . __( 'Next Post', 'log-book' ) . ' </div></strong>
                                <p>%title</p></div></div>',
                            ) );
                            
                          
                        echo "</div>";  
                        
                        endif;


                        if(!get_theme_mod('article_related_post')) :
                           get_template_part('include/related_post');
                        endif;  


                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        echo "<div class='tm-content-box tm-comments'>"; 
                            comments_template();
                        echo "</div>"; 
                    endif;  
                     
                    endwhile; // End of the loop.
                   ?>
              
                </div><!--col-sm-8 -->
           
			
			<?php if(get_theme_mod('post_sidebar')==false) : ?> 
			
			   <div class="col-md-4">    

                    <div class="tm-sidebar">

                         <?php get_sidebar(); ?>

                    </div>   
               
                </div>
	
            <?php endif; ?> 
        </div>
	</section>
</div>
<?php get_footer();
