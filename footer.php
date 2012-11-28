<?php
/**
 * The template for displaying the footer.
 *
 */
?>

	<footer>

		<?php get_sidebar( 'footer' ); ?>

		<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			Copyright &copy; <?php bloginfo( 'name' ); ?> <?php echo date('Y'); ?> 
		</a>

	</footer>

</div> 	<!-- .container -->
<?php wp_footer(); ?>

</body>
</html>