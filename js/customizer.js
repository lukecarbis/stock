/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Primary feature color.
	wp.customize( 'stock_primary_feature_color', function( value ) {
		value.bind( function( to ) {
			$( '.entry-content a, .entry-content a:visited, .comment-content a, .comment-content a:visited, .comment-author a, .comment-author a:visited, .entry-footer a, .entry-footer a:visited' ).css( {
				'color': to,
			} );
		} );
	} );
	// Secondary feature color.
	wp.customize( 'stock_secondary_feature_color', function( value ) {
		value.bind( function( to ) {
			$( 'h2.site-description' ).css( {
				'color': to,
			} );
		} );
	} );
	// Footer text.
	wp.customize( 'stock_footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).html( to );
		} );
	} );
} )( jQuery );
