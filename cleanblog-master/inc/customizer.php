<?php

/**
 * Registers options with the Theme Customizer
 *
 * @param      object    $wp_customize    The WordPress Theme Customizer
 * @package    belajarcpp
 * @since      1.0.0
 * @version    1.0.0
 */

function belajarcpp_register_theme_customizer( $wp_customize ) {

	/* Link Color */
	$wp_customize->add_setting(
		'belajarcpp_link_color',
		array(
			'default'     		 => '#0085a1',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'   		 => 'refresh'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
			    'label'      => 'Link Color',
			    'section'    => 'colors',
			    'settings'   => 'belajarcpp_link_color'
			)
		)
	);

	/* Header Background Color */
	$wp_customize->add_setting(
		'belajarcpp_header_background_color',
		array(
			'default'     		 => '#444',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'   		 => 'refresh'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
			    'label'      => 'Header Background Color',
			    'section'    => 'colors',
			    'settings'   => 'belajarcpp_header_background_color'
			)
		)
	);


	/*-----------------------------------------------------------*
	 * Defining our own 'Social Links' section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'belajarcpp_social_links',
		array(
			'title'     => 'Social Links',
			'priority'  => 30
		)
	);

	/* Twitter URL */
	$wp_customize->add_setting(
		'belajarcpp_social_twitter',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_twitter',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Twitter',
			'type'     => 'text'
		)
	);

	/* Facebook URL */
	$wp_customize->add_setting(
		'belajarcpp_social_facebook',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_facebook',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Facebook',
			'type'     => 'text'
		)
	);

	/* Google URL */
	$wp_customize->add_setting(
		'belajarcpp_social_google',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_google',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Google+',
			'type'     => 'text'
		)
	);

	/* Pinterest URL */
	$wp_customize->add_setting(
		'belajarcpp_social_pinterest',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_pinterest',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Pinterest',
			'type'     => 'text'
		)
	);

	/* Linkedin URL */
	$wp_customize->add_setting(
		'belajarcpp_social_linkedin',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_linkedin',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Linkedin',
			'type'     => 'text'
		)
	);

	/* Github URL */
	$wp_customize->add_setting(
		'belajarcpp_social_github',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_github',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Github',
			'type'     => 'text'
		)
	);

	/* Instagram URL */
	$wp_customize->add_setting(
		'belajarcpp_social_instagram',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_instagram',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Instagram',
			'type'     => 'text'
		)
	);

	/* Medium URL */
	$wp_customize->add_setting(
		'belajarcpp_social_medium',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_medium',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Medium',
			'type'     => 'text'
		)
	);

	/* Vine URL */
	$wp_customize->add_setting(
		'belajarcpp_social_vine',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_vine',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Vine',
			'type'     => 'text'
		)
	);

	/* Tumblr URL */
	$wp_customize->add_setting(
		'belajarcpp_social_tumblr',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_tumblr',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'Tumblr',
			'type'     => 'text'
		)
	);

	/* YouTube URL */
	$wp_customize->add_setting(
		'belajarcpp_social_youtube',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_social_youtube',
		array(
			'section'  => 'belajarcpp_social_links',
			'label'    => 'YouTube',
			'type'     => 'text'
		)
	);

	/*-----------------------------------------------------------*
	 * Defining our own 'Display Options' section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'belajarcpp_display_options',
		array(
			'title'     => 'Display Options',
			'priority'  => 40
		)
	);

	/* Show or Hide post excerpt */
	$wp_customize->add_setting(
		'belajarcpp_post_excerpt',
		array(
			'default'   => 'hide',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport' => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_post_excerpt',
		array(
			'section'  => 'belajarcpp_display_options',
			'label'    => 'Post Excerpts',
			'type'     => 'radio',
			'choices'  => array(
				'hide'    => 'Hide',
				'show'   => 'Show'
			)
		)
	);

	/* Darken Header? */
	$wp_customize->add_setting(
		'belajarcpp_darken_header',
		array(
			'default'   => 'no',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport' => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_darken_header',
		array(
			'section'  => 'belajarcpp_display_options',
			'label'    => 'Darken Header?',
			'type'     => 'radio',
			'choices'  => array(
				'no'    => 'No',
				'yes'   => 'Yes'
			)
		)
	);

	/* Parallax Header? */
	$wp_customize->add_setting(
		'belajarcpp_parallax_header',
		array(
			'default'   => 'no',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport' => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_parallax_header',
		array(
			'section'  => 'belajarcpp_display_options',
			'label'    => 'Parallax Header?',
			'type'     => 'radio',
			'choices'  => array(
				'no'    => 'No',
				'yes'   => 'Yes'
			)
		)
	);

	/* Display Copyright */
	$wp_customize->add_setting(
		'belajarcpp_footer_copyright_text',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_copyright',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_footer_copyright_text',
		array(
			'section'  => 'belajarcpp_display_options',
			'label'    => 'Copyright Message',
			'type'     => 'text'
		)
	);

	/*-----------------------------------------------------------*
	 * Defining our own 'Home Intro' section
	 *-----------------------------------------------------------*/
	$wp_customize->add_section(
		'belajarcpp_homeintro_options',
		array(
			'title'     => 'Home Intro',
			'priority'  => 20
		)
	);

	/* Background Image */
	$wp_customize->add_setting(
		'belajarcpp_homeintro_image',
		array(
		    'default'     		 => get_template_directory_uri() . '/img/home-bg.jpg',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
		    'transport'   		 => 'refresh'
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'belajarcpp_homeintro_image',
			array(
			    'label'    => 'Background Image',
			    'settings' => 'belajarcpp_homeintro_image',
			    'section'  => 'belajarcpp_homeintro_options'
			)
		)
	);

	/* Home Intro Title */
	$wp_customize->add_setting(
		'belajarcpp_homeintro_title',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_homeintro_title',
		array(
			'section'  => 'belajarcpp_homeintro_options',
			'label'    => 'Title',
			'type'     => 'text'
		)
	);

	/* Home Intro Subtitle */
	$wp_customize->add_setting(
		'belajarcpp_homeintro_subtitle',
		array(
			'default'            => '',
			'sanitize_callback'  => 'belajarcpp_sanitize_input',
			'transport'          => 'refresh'
		)
	);
	$wp_customize->add_control(
		'belajarcpp_homeintro_subtitle',
		array(
			'section'  => 'belajarcpp_homeintro_options',
			'label'    => 'Subtitle',
			'type'     => 'text'
		)
	);

} // end belajarcpp_register_theme_customizer
add_action( 'customize_register', 'belajarcpp_register_theme_customizer' );
/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string    $input    The string to sanitize
 * @return     string              The sanitized string
 * @package    belajarcpp
 * @since      1.0.0
 * @version    1.0.0
 */
function belajarcpp_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
} // end belajarcpp_sanitize_input

function belajarcpp_sanitize_copyright( $input ) {
	$allowed = array(
		's'			=> array(),
		'br'		=> array(),
		'em'		=> array(),
		'i'			=> array(),
		'strong'	=> array(),
		'b'			=> array(),
		'a'			=> array(
			'href'			=> array(),
			'title'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'form'		=> array(
			'id'			=> array(),
			'class'			=> array(),
			'action'		=> array(),
			'method'		=> array(),
			'autocomplete'	=> array(),
			'style'			=> array(),
		),
		'input'		=> array(
			'type'			=> array(),
			'name'			=> array(),
			'class' 		=> array(),
			'id'			=> array(),
			'value'			=> array(),
			'placeholder'	=> array(),
			'tabindex'		=> array(),
			'style'			=> array(),
		),
		'img'		=> array(
			'src'			=> array(),
			'alt'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
			'height'		=> array(),
			'width'			=> array(),
		),
		'span'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'p'			=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'div'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'blockquote' => array(
			'cite'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
	);
    return wp_kses( $input, $allowed );
} // end belajarcpp_sanitize_copyright

/**
 * Writes styles out the `<head>` element of the page based on the configuration options
 * saved in the Theme Customizer.
 *
 * @since      1.0.0
 * @version    1.0.0
 */
function belajarcpp_customizer_css() {
?>
	<style type="text/css">
		-moz-selection,
		::selection{
			background: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}
		body{
			webkit-tap-highlight-color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}
		a:hover {
			color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}
		.pager li>a:hover, .pager li>a:focus {
			color: #fff;
			background-color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
			border: 1px solid <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}

		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover {
			background: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
			border-color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}

		button:focus,
		input[type="button"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		button:active,
		input[type="button"]:active,
		input[type="reset"]:active,
		input[type="submit"]:active {
			background: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
			border-color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		textarea:focus {
			border: 1px solid <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}

		.navbar-custom.is-fixed .nav li a:hover, .navbar-custom.is-fixed .nav li a:focus {
			color: <?php echo get_theme_mod( 'belajarcpp_link_color' ); ?>;
		}

		<?php if ( get_theme_mod( 'belajarcpp_darken_header' ) !== 'no' ) { ?>
		body.admin-bar .navbar-custom.is-fixed { top:-32px; }

		header.intro-header { position: relative; }

		header.intro-header .row {
		z-index: 3;
		position: relative;
		}

		header.intro-header .container:after {
		background: rgba(0,0,0,0.2);
		z-index: 2;
		content: '';
		width: 100%;
		height: 100%;
		display: block;
		position: absolute;
		top: 0;
		left: 0;
		}

		@media only screen and (min-width: 1170px)
		.navbar-custom {
		z-index: 9999;
		}
		<?php } ?>
		<?php if ( get_theme_mod( 'belajarcpp_parallax_header' ) !== 'no' ) { ?>
		.intro-header {
			background-attachment: fixed;
		}
		<?php } ?>
	</style>
<?php
} // end belajarcpp_customizer_css
add_action( 'wp_head', 'belajarcpp_customizer_css' );
/**
 * Registers the Theme Customizer Preview with WordPress.
 *
 * @package    belajarcpp
 * @since      1.0.0
 * @version    1.0.0
 */
function belajarcpp_customizer_live_preview() {
	wp_enqueue_script(
		'belajarcpp-theme-customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		'1.0.0',
		true
	);
} // end belajarcpp_customizer_live_preview
add_action( 'customize_preview_init', 'belajarcpp_customizer_live_preview' );
