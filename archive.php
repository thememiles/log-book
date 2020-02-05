<?php
/**
 * The template for displaying archive pages
 * @package log-book
 * @version 1.0.1
 */
get_header();
$breadcrumb_type = log_book_get_option( 'breadcrumb_type' );

 if($breadcrumb_type == 'normal'): 
 ?>
<!-- Breadcrumb Header -->
    <div class="tm-breadcrumb" <?php echo $header_style; ?>>
        <div class="container">
            <h1 class="title"><?php the_archive_title(); ?></h1>
            <?php do_action( 'log_book_breadcrumb_options' ); ?>
        </div>
    </div>
    <!-- /Breadcrumb Header -->
<?php endif; ?>

<div class="container">
    <!-- Main Content Area -->
    <section class="section-wrap">
        <div class="row">
            <div class="col-sm-12">
                <!-- Blog Grid Posts -->
                <div class="tm-blog-grid">
                    <div class="row">

                        <div <?php if(get_theme_mod('archive_sidebar')==true) : ?> class="col-md-12" <?php else: ?>class="col-md-8 left-block" <?php endif; ?> >
            		    
                         <?php if($breadcrumb_type == 'disable'): ?>		

                             <h1 class="title blog-post col-lg-12 "><?php the_archive_title(); ?></h1>
                             
                          <?php endif; 

                            if ( have_posts() ) :
                                
                                /* Start the Loop */
                                while ( have_posts() ) : the_post();
																
								get_template_part( 'template-parts/post/content');
								
                                 endwhile;
                
                            else :
                
                                get_template_part( 'template-parts/post/content', 'none' );
                
                            endif;
                        ?>

                            <div class="tm-pagination">
                               <?php the_posts_pagination( array(
                                'mid_size'  => 2,
                                'prev_text' => __( '<<', 'log-book' ),
                                'next_text' => __( '>>', 'log-book' ),
                                 ) ); ?>
                            </div>
                            
                		</div>
        				
                          
        	           <?php if(get_theme_mod('archive_sidebar')==false) : ?> 
        			
        			   <div class="col-md-4">    
                            
                            <div class="tm-sidebar">
                                
                                 <?php get_sidebar(); ?>

                            </div> 
                            
                        </div>
                	
                        <?php endif; ?> 
                    </div><!-- .row -->
            	</div>
            </div>
        </div>  
    </section>    
</div>      
<?php get_footer();
