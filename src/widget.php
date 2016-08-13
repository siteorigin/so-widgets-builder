<?php
/*
Widget Name: {{WIDGET_NAME_RAW}}
Description: {{WIDGET_DESCRIPTION_RAW}}
*/

class _SiteOrigin_Widget_Custom_Widget extends SiteOrigin_Widget {
	function __construct(){
		parent::__construct(
			'{{WIDGET_ID}}',
			'{{WIDGET_NAME}}',
			array(
				'description' => '{{WIDGET_DESCRIPTION}}',
				'help' => '{{WIDGET_HELP}}'
			),
			array(

			),
			false ,
			plugin_dir_path(__FILE__)
		);
	}

	function initialize(){
		/* {{INITIALIZE}} */
	}

	function initialize_form(){
		/* {{RETURN_FORM}} */
	}

	function get_html_content( $instance, $args, $template_vars, $css_name ){
		$twig = $this->get_twig();

		/* {{RETURN_HTML}} */
	}

	function get_less_variables( $instance ) {
		/* {{RETURN_LESS_VARIABLES}} */
	}

	function get_less_content( $instance ){
		/* {{RETURN_LESS_CONTENT}} */
	}

	function get_twig(){
		$twig = new Twig_Environment( null, array(
			'autoescape' => true,
		) );

		if( ! class_exists( 'SiteOrigin_Widget_Twig_Extension' ) ) {
			include plugin_dir_path( __FILE__ ) . '../../inc/twig-extension.class.php';
		}

		$twig->addExtension( new SiteOrigin_Widget_Twig_Extension() );

		return $twig;
	}
}

siteorigin_widget_register( '{{WIDGET_ID}}', __FILE__, '_SiteOrigin_Widget_Custom_Widget' );

/* {{TWIG_TEMPLATE}} */