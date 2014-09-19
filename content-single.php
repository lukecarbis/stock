<?php
/**
 * @package Stock
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="<?php esc_attr_e( has_post_thumbnail() ? 'entry-header has-thumbnail' : 'entry-header' ) ?>">

		<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>

		<?php
		if ( has_post_thumbnail() ) {
			$image   = get_the_post_thumbnail();
			$pattern = '/src="([^"]*)"/';

			preg_match( $pattern, $image, $matches );

			printf( '<div class="entry-thumbnail" style="background-image: url(%s);"></div>', esc_attr( $matches[1] ) ); //xss ok
		}
		?>

		<div class="entry-meta">
			<?php stock_posted_on(); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'stock' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php stock_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
