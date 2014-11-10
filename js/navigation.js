/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 * Also, shows the dropdown menu when a child element has focus
 */
( function() {
	var container, button, menu, links;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	};

	links = menu.querySelectorAll( '#site-navigation ul.sub-menu li a' );

	for ( var i = 0; i < links.length; i++ ) {
		links[ i ].onblur = function() {
			var parentMenu = this.parentNode.parentNode;
			while( parentMenu.getAttribute( 'id' ) !== 'site-navigation' ) {
				parentMenu.className = parentMenu.className.replace( ' nav-focus', '' );
				parentMenu = parentMenu.parentNode.parentNode;
			}
		}
		links[ i ].onfocus = function() {
			var parentMenu = this.parentNode.parentNode;
			while( parentMenu.getAttribute( 'id' ) !== 'site-navigation' ) {
				parentMenu.className += ' nav-focus';
				parentMenu = parentMenu.parentNode.parentNode;
			}
		}
	}
} )();
