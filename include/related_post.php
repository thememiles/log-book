<?php 
$orig_post = $post;
global $post;

$categories        = get_the_category($post->ID);

$related_post_text = log_book_get_option( 'you_may_like_text' );

if ($categories) {

	$category_ids = array();

	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	
	$args = array(
		'category__in'       => $category_ids,
		'post__not_in'       => array($post->ID),
		'posts_per_page'     => 3, // Number of related posts that will be shown.
		'ignore_sticky_posts'=> 1,
		'orderby'            => 'rand'
	);

	$my_query = new wp_query( $args );
	if( $my_query->have_posts() ) { ?>
	<div class="tm-content-box tm-related-posts">
		 	 <h2 class="section-heading"><?php echo esc_html($related_post_text); ?></h2>
	
      <div class="row">
		<?php while( $my_query->have_posts() ) {
			$my_query->the_post();?>

			     <!-- Post -->
                <div class="col-sm-3">
                    <div class="related-post">
                    	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	                        <div class="post-img">
	                        	<?php the_post_thumbnail( 'random-thumb', array( 'class' => 'img-responsive' ) );
	                        	?>

	                        </div>
	                    <?php endif; ?>    
                        <h4><a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title(); ?></a></h4>
                    </div>
                </div>
				
		<?php
		}
                                
		echo '</div></div>';
       
	}
}

wp_reset_postdata();

?>