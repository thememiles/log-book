<?php
/**
 * Template part for displaying a message that posts cannot be found
 * @package log-book
 * @version 1.0.1
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="title"><?php echo  esc_html_e('Nothing Found', 'log-book' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'log-book' ), esc_url( admin_url( 'post-new.php' ) ) ) ); ?></p>

		<?php else : ?>

			<p><?php echo esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'log-book' ); ?></p>
			<?php
			endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
