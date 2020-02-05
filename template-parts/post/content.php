<?php
/**
 * Template part for displaying posts
 * @package log-book
 * @version 1.0.1
 */

if(get_theme_mod('home_style')=='Simple') : 

 $column = 'col-lg-12 masonry post';
 
 else :
 
 $column = 'col-lg-12 masonry post';
 
 endif;

$readmore      = log_book_get_option( 'readmore_text' );
$hide_category = log_book_get_option( 'post_categories' );
 ?>
  
<article id="post-<?php the_ID(); ?>" <?php post_class( $column ); ?>>

    <div class="blog-post">
      <?php if( has_post_thumbnail() ) { ?>
    
        <div class="post-thumbnail">
           <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('full'); ?></a>
        </div>
       <?php } ?> 
        <div class="post-content">
            <h3 class="post-title <?php if( !has_post_thumbnail() ) { echo "no-image"; }?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="post-description">
              <?php  echo wp_kses_post( wp_trim_words(get_the_content(), 30) ); ?>
            </p>
            <div class="blog-post-meta">
                <ul>
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

                    <li <i class="fa fa-folder-o " aria-hidden="true" ></i><a href="<?php echo esc_url( $category_link); ?> "><?php
                 echo esc_html(" ".$category_name);?></a></li>

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
            <?php if(!empty($readmore)){ ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-colored"><?php echo esc_html($readmore); ?></a>
        <?php } ?>
        </div>
    </div>
   
</article><!-- #post-## -->
