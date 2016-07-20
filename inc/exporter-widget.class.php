<?php

class SiteOrigin_Widget_Exporter_Widget extends SiteOrigin_Widget_Custom_Widget {

	public function get_php_code( $args ){
		$code = file_get_contents( plugin_dir_path( __FILE__ ) . '../src/widget.php' );

		$args = wp_parse_args( $args, array(
			'widget_id' => '',
			'widget_name' => '',
			'widget_help' => '',
		) );

		// Add in the various $args
		$code = str_replace( '{{WIDGET_ID}}', 'cw-' . $args['widget_id'], $code );
		$code = str_replace( '{{WIDGET_NAME}}', addslashes( $args['widget_name'] ), $code );
		$code = str_replace( '{{WIDGET_DESCRIPTION}}', addslashes( $args['widget_description'] ), $code );
		$code = str_replace( '{{WIDGET_NAME_RAW}}', ( $args['widget_name'] ), $code );
		$code = str_replace( '{{WIDGET_DESCRIPTION_RAW}}', ( $args['widget_description'] ), $code );
		$code = str_replace( '{{WIDGET_HELP}}', $args['widget_help'], $code );

		// Set the class
		$widget_code = str_replace( '_SiteOrigin_Widget_Custom_Widget', $this->widget_class, $code );

		// Add the initialization functions
		$widget_code = $this->get_php_code_initialize( $widget_code );

		// Add the form
		$widget_code = $this->get_php_code_form( $widget_code );

		// Add the HTML template
		$widget_code = $this->get_php_code_template( $widget_code );

		// Add in the LESS code and variables
		$widget_code = $this->get_php_code_less( $widget_code );
		$widget_code = $this->get_php_code_less_vars( $widget_code );

		return $widget_code;
	}

	private function get_php_code_initialize( $widget_code ) {
		$initialize_code = '';

		if( ! empty( $this->custom_options[ 'scripts' ] ) ) {
			$initialize_code .= '$scripts = array();' . "\n";
			foreach( $this->custom_options[ 'scripts' ] as $script ) {
				if( empty( $script[ 'file' ] ) ) continue;

				$file = get_attached_file( $script[ 'file' ] );
				$attachment = get_post( $script[ 'file' ] );

				$initialize_code .= '$scripts[] = array(' . "\n";
				$initialize_code .= "\t'" . addslashes( 'custom-widget-' . $attachment->post_name ) . "',\n";
				$initialize_code .= "\tplugin_dir_url( __FILE__ ) . 'assets/" . basename( $file ) . "',\n";
				$initialize_code .= "\t" . ( $script['jquery'] ? "array( 'jquery' )" : 'false' ) . ",\n";
				$initialize_code .= ");\n";
			}
			$initialize_code .= '$this->register_frontend_scripts( $scripts );' . "\n";
		}

		if( ! empty( $this->custom_options[ 'styles' ] ) ) {
			$initialize_code .= '$styles = array();' . "\n";
			foreach( $this->custom_options[ 'styles' ] as $style ) {
				if( empty( $style[ 'file' ] ) ) continue;

				$file = get_attached_file( $style[ 'file' ] );
				$attachment = get_post( $style[ 'file' ] );

				$initialize_code .= '$styles[] = array(' . "\n";
				$initialize_code .= "\t'" . addslashes( 'custom-widget-' . $attachment->post_name ) . "',\n";
				$initialize_code .= "\tplugin_dir_url( __FILE__ ) . 'assets/" . basename( $file ) . "',\n";
				$initialize_code .= ");\n";
			}
			$initialize_code .= '$this->register_frontend_styles( $styles );' . "\n";
		}

		$initialize_code = str_replace( "\n", "\n\t\t", $initialize_code );
		return str_replace( '/* {{INITIALIZE}} */', $initialize_code, $widget_code );
	}

	private function get_php_code_form( $widget_code ){
		$form = $this->initialize_form();
		$form = var_export( $form, true );
		$form = str_replace( "\n", "\n\t\t", $form );
		$form = str_replace( "  ", "\t", $form );

		return str_replace( '/* {{RETURN_FORM}} */', 'return ' . $form . ';', $widget_code );
	}

	private function get_php_code_template( $widget_code ) {
		$tpl = $this->custom_options[ 'template_code' ];
		$twig = $this->get_twig( $tpl );

		// Create the Twig PHP file
		$stream = $twig->tokenize( $tpl, 'default' );
		$nodes = $twig->parse( $stream );
		$template_php = $twig->compile( $nodes );
		$template_php = trim( str_replace('<?php', '', $template_php) );

		// Get the
		preg_match( '/class (__TwigTemplate_.*?) extends Twig_Template/', $template_php, $matches );
		$template_classname = $matches[1];

		$widget_code = str_replace(
			'/* {{TWIG_TEMPLATE}} */',
			$template_php,
			$widget_code
		);

		$template_function_php = '$tpl = new ' . $template_classname . '( $twig );' . "\n";
		$template_function_php .= 'return $tpl->render( $instance );';

		return str_replace(
			'/* {{RETURN_HTML}} */',
			str_replace( "\n", "\n\t\t", $template_function_php ),
			$widget_code
		);
	}

	private function get_php_code_less( $widget_code ) {
		$less_code = $this->custom_options[ 'less_code' ];
		$less_code = str_replace( "\n", "\n\t\t\t", $less_code );
		return str_replace(
			'/* {{RETURN_LESS_CONTENT}} */',
			'return "' . addcslashes( $less_code, '"' ) . '";',
			$widget_code
		);
	}

	private function get_php_code_less_vars( $widget_code ) {
		$less_vars_code = '$return = array();' . "\n";
		preg_match_all( '/\@(.*?) *\:.*?;/', $this->custom_options[ 'less_code' ], $matches );
		if( !empty( $matches[0] ) ) {
			for ($i = 0; $i < count($matches[0]); $i++) {
				$parts = explode( '-', $matches[1][$i] );
				$instance_var = '$instance[ "' . implode( '"]["', $parts ) . '" ]';

				$less_vars_code .= 'if ( isset( ' . $instance_var . ' ) ) $return[ "' . $matches[1][$i] . '" ] = ' . $instance_var . ';' . "\n";
			}
		}
		$less_vars_code .= 'return $return;';
		return str_replace(
			'/* {{RETURN_LESS_VARIABLES}} */',
			str_replace( "\n", "\n\t\t", $less_vars_code ),
			$widget_code
		);
	}
}