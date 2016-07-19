<?php

class _SiteOrigin_Widget_Custom_Widget extends SiteOrigin_Widget {
	function __construct(){
		parent::__construct(
			'sow-cta',
			__('SiteOrigin CUSTOM WIDGET', 'so-widgets-bundle'),
			array(
				'description' => __('A simple call-to-action widget with massive power.', 'so-widgets-bundle'),
				// 'help' => 'https://siteorigin.com/widgets-bundle/call-action-widget/'
			),
			array(

			),
			false ,
			plugin_dir_path(__FILE__)
		);
	}

	function initialize(){

	}

	function initialize_form(){
		/* {{RETURN_FORM}} */
	}

	function get_html_content( $instance, $args, $template_vars, $css_name ){
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

		return $twig;
	}
}