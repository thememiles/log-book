<?php
/**
 * Template part for displaying posts
 * @package log-book
 * @version 1.0.1
 */
$hide_category = log_book_get_option( 'post_categories' );
$breadcrumb_type = log_book_get_option( 'breadcrumb_type' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-detail tm-content-box boxed">
	<?php if (has_post_thumbnail()) {
            $image_id = get_post_thumbnail_id();
            $image_url = wp_get_attachment_image_src($image_id, 'full', true);
            ?>
			<div class="blog-banner">
				<img class="img-responsive" src="<?php echo  $image_url[0]; ?>" alt="<?php the_title(); ?>" />
			</div>
	<?php } ?>
		<div class="post-meta">
			<ul class="meta-list single-meta">
				 <?php if ( 'post' === get_post_type() ): log_book_posted_on(); endif; 
                    
                    $the_cat = get_the_category();
                    if(!empty($the_cat))
                    {
                        $category_name = $the_cat[0]->cat_name;
                        $category_description = $the_cat[0]->category_description;
                        $category_link = get_category_link( $the_cat[0]->cat_ID );
                    }
                    if( $hide_category != 1)
                    {
                    ?>

                    <li><span class="category"> <i class="fa fa-folder-o " aria-hidden="true" ></i><a href="<?php echo esc_url( $category_link); ?> "><?php
                 echo esc_html($category_name);?></a></span></li>

                 <?php } 

                    if(!get_theme_mod('article_comment_link')) :?>
                
                        <li class="meta-comment list-inline-item">
                            <?php $cmt_link = get_comments_link(); 
                                  $num_comments = get_comments_number();
                                    if ( $num_comments == 0 ) {
                                        $comment = __( 'No Comments', 'log-book' );
                                    } elseif ( $num_comments > 1 ) {
                                        $comment = $num_comments . __( ' Comments', 'log-book' );
                                    } else {
                                        $comment = __('1 Comment', 'log-book' );
                                    }
                                  
                            ?>  
                            <i class="fa fa-comment-o" aria-hidden="true"></i>
                            <a href="<?php echo esc_url( $cmt_link ); ?>"><?php echo esc_html( $comment );?></a>
                        </li>
                    <?php endif; ?>
			</ul>
		</div>
		<div class="post-title">
           <?php if($breadcrumb_type == 'disable'): ?>
           
             <h1 class="post-title"><a href="#"><?php the_title(); ?></a></h1>

          <?php endif; ?>

			<?php the_content(); ?>
		</div>
		 
	</div>
</article><!-- #post-## -->

