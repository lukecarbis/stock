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
		});
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		});
	});
	// Primary feature color.
	wp.customize( 'stock_primary_feature_color', function( value ) {
		value.bind( function( to ) {
			$( '.entry-content a, .entry-content a:visited, .comment-content a, .comment-content a:visited, .comment-author a, .comment-author a:visited, .entry-footer a, .entry-footer a:visited' ).css( {
				'color': to
			});
		});
	});
	// Secondary feature color.
	wp.customize( 'stock_secondary_feature_color', function( value ) {
		value.bind( function( to ) {
			$( 'h2.site-description' ).css( {
				'color': to
			});
		});
	});
	// Text color.
	wp.customize( 'stock_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'body, button, input, select, textarea' ).css( {
				'color': to
			});
		});
	});
	// Entry color.
	wp.customize( 'stock_entry_title_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1.entry-title a' ).css( {
				'color': to
			});
		});
	});
	// Input background color.
	wp.customize( 'stock_input_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'input, select, textarea' ).css( {
				'background-color': to
			});
		});
	});
	// Input text color.
	wp.customize( 'stock_input_text_color', function( value ) {
		value.bind( function( to ) {
			$( 'input, input[type=\"text\"], input[type=\"email\"],	input[type=\"url\"], input[type=\"password\"], input[type=\"search\"], select, textarea' ).css( {
				'color': to
			});
		});
	});
	// Input focus text color.
	wp.customize( 'stock_input_focus_color', function( value ) {
		var inputs = $( 'input, input[type=\"text\"], input[type=\"email\"], input[type=\"url\"], input[type=\"password\"], input[type=\"search\"], select, textarea' );
		value.bind( function( to ) {
			var from = '';
			inputs.off( 'focus' ).on( 'focus', function() {
				from = $( this ).css( 'color' );
				$( this ).css( {
					'color': to
				});
			});
			inputs.off( 'blur' ).on( 'blur', function() {
				$( this ).css( {
					'color': from
				});
			});
		});
	});
	// Footer text.
	wp.customize( 'stock_footer_text', function( value ) {
		value.bind( function( to ) {
			$( '.site-info' ).html( to );
		});
	});
} )( jQuery );
