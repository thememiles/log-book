<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package log-book
 * @version 1.0.1
 */

if ( ! function_exists( 'log_book_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function log_book_posted_on() {
	
	// Get the author name; wrap it in a link.
	$byline = sprintf('<span class="author vcard"><i class="fa fa-user-o" aria-hidden="true" ></i> <a class="url fn n" href=" ' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ). '</a></span>');
	

	// Finally, let's write all of this to the page.
	if(!get_theme_mod('article_author')) : 
	echo '<li class="byline list-inline-item">'. $byline .'</li>';
	endif; 
	 
	if(!get_theme_mod('article_date_area')) : 
	echo '<li class="posted-on list-inline-item"><i class="fa fa-calendar-o" aria-hidden="true"></i>' . log_book_time_link() . '</li>';
	endif;
}
endif;


if ( ! function_exists( 'log_book_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function log_book_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d'); 
	
	$time_string = sprintf( $time_string,
		esc_attr(get_the_date( DATE_W3C )),
		esc_html(get_the_date()),
		esc_attr(get_the_modified_date( DATE_W3C )),
		esc_html(get_the_modified_date())
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'log-book' ),
		'<a href="' . esc_url( get_day_link( $archive_year, $archive_month, $archive_day) ) . '" rel="bookmark">' . $time_string . '</a>'
	);
}
endif;


if ( ! function_exists( 'log_book_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function log_book_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'log-book' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( log_book_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && log-book_categorized_blog() ) || $tags_list ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && log-book_categorized_blog() ) {
							echo '<span class="cat-links">' . log-book_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Categories', 'log-book' ) . '</span>' . esc_html( $categories_list) . '</span>';
						}

						if ( $tags_list && ! is_wp_error( $tags_list ) ) {
							echo '<span class="tags-links">' . log-book_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Tags', 'log-book' ) . '</span>' . esc_html( $tags_list) . '</span>';
						}

					echo '</span>';
				}
			}

			log_book_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}
}
endif;


if ( ! function_exists( 'log_book_edit_link' ) ) :
/**
 * Returns an accessibility-friendly link to edit a post or page.
 *
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
function log_book_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'log-book' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function log_book_categorized_blog() {
	$category_count = get_transient( 'log_book_categories' );

	if ( false === $category_count ) {
		// Create an array of all the categories that are attached to posts.
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$category_count = count( $categories );

		set_transient( 'log_book_categories', $category_count );
	}

	// Allow viewing case of 0 or 1 categories in post preview.
	if ( is_preview() ) {
		return true;
	}

	return $category_count > 1;
}


/**
 * Flush out the transients used in log_book_categorized_blog.
 */
function log_book_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'log_book_categories' );
}
add_action( 'edit_category', 'log_book_category_transient_flusher' );
add_action( 'save_post',     'log_book_category_transient_flusher' );
