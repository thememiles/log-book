<?php
/**
 * Displays footer site info
 *
 * @package log-book
 * @version 1.0.1
 */

?>

<!-- Bottom Bar -->
<div class="tm-bottom-bar">
	<div class="container">
		<div class="copyright">

			<?php $copyright_text = log_book_get_option( 'copyright_text' ); 
						    
	        if ( ! empty( $copyright_text ) ) : ?>
	    
	           <?php echo wp_kses_data( $copyright_text ); ?>
	    
	        <?php endif; ?>

	            <a href="<?php echo esc_url( __( 'https://www.wordpress.org/', 'log-book' ) ); ?>">  <?php printf( esc_html__( ' Proudly powered by %s ', 'log-book' ), 'WordPress ' ); ?>
							    </a>
								<span class="sep"> <?php esc_html_e('|','log-book') ?>  </span>

				<?php printf( esc_html__( ' Theme: %1$s by %2$s.', 'log-book' ), 'Log Book', '<a href="https://www.thememiles.com/" target="_blank">ThemeMiles</a>' ); ?>

		</div>
		<div class="bottom-nav">
			<?php echo do_action('log_book_footer_menu'); ?>
		</div>
	</div>
</div><!-- /Bottom Bar -->