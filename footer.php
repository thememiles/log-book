<?php
/**
 * The template for displaying the footer
 * @package log-book
 * @version 1.0.1
 */

?>

<!--================================
        START FOOTER AREA
    =================================-->
  <!-- Footer -->
	<section class="section-wrap">
		<footer class="footer basic">
    	
    	   <?php get_template_part( 'template-parts/footer/site', 'info' ); ?>

        </footer>
    </section>
	
<!--================================
    END FOOTER AREA
    =================================-->

<?php wp_footer(); ?>

</body>

</html>
