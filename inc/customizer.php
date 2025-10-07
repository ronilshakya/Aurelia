<?php
/**
 * Aurelia Theme Customizer
 *
 * @package Aurelia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function aurelia_get_social_networks() {
    return ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube'];
}

function aurelia_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'aurelia_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'aurelia_customize_partial_blogdescription',
			)
		);
	}

	// -----------social linke---------------
	// Create a section for social links
    $wp_customize->add_section('aurelia_social_section', array(
        'title'       => __('Social Media Links', 'aurelia'),
        'priority'    => 30,
        'description' => __('Add your social media URLs here'),
    ));

    // Define an array of social networks
    $social_networks = aurelia_get_social_networks();

    foreach ($social_networks as $network) {
        // Setting
        $wp_customize->add_setting("aurelia_{$network}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        // Control
        $wp_customize->add_control("aurelia_{$network}_link_control", array(
            'label'    => ucfirst($network) . ' URL',
            'section'  => 'aurelia_social_section',
            'settings' => "aurelia_{$network}_link",
            'type'     => 'url',
        ));
    }
}
add_action( 'customize_register', 'aurelia_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function aurelia_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function aurelia_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aurelia_customize_preview_js() {
	wp_enqueue_script( 'aurelia-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'aurelia_customize_preview_js' );


