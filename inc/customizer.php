<?php
/**
 * Stock Theme Customizer
 *
 * @package Stock
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function stock_customize_register( $wp_customize ) {
	$default_colors  = stock_get_default_colors();

	$wp_customize->add_setting( 'stock_primary_feature_color' , array(
		'default'           => isset( $default_colors['primary'] ) ? $default_colors['primary'] : null,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'stock_secondary_feature_color' , array(
		'default'           => isset( $default_colors['secondary'] ) ? $default_colors['secondary'] : null,
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_setting( 'stock_footer_text' , array(
		'default'           => sprintf( '<a href="%s">%s</a>', esc_url( 'http://wordpress.org/' ), __( 'Proudly powered by WordPress', 'stock' ) ),
		'transport'         => 'postMessage',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_section( 'stock_footer_section' , array(
		'title'    => __( 'Footer', 'stock' ),
		'priority' => 100,
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stock_primary_feature_color', array(
		'label'    => __( 'Primary Feature Color', 'stock' ),
		'section'  => 'colors',
		'settings' => 'stock_primary_feature_color',
	) ) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'stock_secondary_feature_color', array(
		'label'    => __( 'Secondary Feature Color', 'stock' ),
		'section'  => 'colors',
		'settings' => 'stock_secondary_feature_color',
	) ) );

	$wp_customize->add_control( 'stock_footer_text', array(
		'label'   => __( 'Footer Text', 'stock' ),
		'section' => 'stock_footer_section',
	) );

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'stock_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function stock_customize_preview_js() {
	wp_enqueue_script( 'stock_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'stock_customize_preview_js' );
