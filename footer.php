<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Stock
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php
			echo wp_kses_post(
				get_theme_mod(
					'stock_footer_text',
					sprintf( '<a href="%s">%s</a>', esc_url( 'http://wordpress.org/' ), __( 'Proudly powered by WordPress', 'stock' ) )
				)
			);
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
