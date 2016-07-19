<?php

class SiteOrigin_Widget_Exporter_Widget extends SiteOrigin_Widget_Custom_Widget {
	public function get_php_code(){
		$code = file_get_contents( plugin_dir_path( __FILE__ ) . '../src/widget.php' );

		// Set the class
		$widget_code = str_replace( '_SiteOrigin_Widget_Custom_Widget', $this->widget_class, $code );

		// Add the form
		$form = $this->initialize_form();
		$form = var_export( $form, true );
		$form = str_replace( "\n", "\n\t\t", $form );
		$form = str_replace( "  ", "\t", $form );

		$widget_code = str_replace( '/* {{RETURN_FORM}} */', 'return ' . $form, $widget_code );

		// Add the HTML template
		$tpl = $this->custom_options[ 'template_code' ];
		$twig = $this->get_twig( $tpl );

		// Create the Twig PHP file
		$stream = $twig->tokenize( $tpl, 'default' );
		$nodes = $twig->parse( $stream );
		$template_php = $twig->compile( $nodes );
		$template_php = trim( str_replace('<?php', '', $template_php) );

		preg_match( '/class (__TwigTemplate_.*?) extends Twig_Template/', $template_php, $matches );
		$classname = $matches[1];

		$template_function_php = 'if( ! class_exists("' . $classname . '") ) {' . "\n\t";
		$template_function_php .= str_replace( "\n", "\n\t", $template_php ) . "\n";
		$template_function_php .= '}' . "\n";
		$template_function_php .= '$tpl = new ' . $classname . '( $twig );' . "\n";
		$template_function_php .= 'return $tpl->render( $instance );';

		$widget_code = str_replace(
			'/* {{RETURN_HTML}} */',
			str_replace( "\n", "\n\t\t", $template_function_php ),
			$widget_code
		);

		// Add in the LESS code
		$less_code = $this->custom_options[ 'less_code' ];
		$less_code = str_replace( "\n", "\n\t\t\t", $less_code );
		$widget_code = str_replace(
			'/* {{RETURN_LESS_CONTENT}} */',
			'return "' . addcslashes( $less_code, '"' ) . '";',
			$widget_code
		);

		// Add in the LESS variables
		$less_vars_code = '$return = array();' . "\n";
		preg_match_all( '/\@(.*?) *\:.*?;/', $this->custom_options[ 'less_code' ], $matches );
		if( !empty( $matches[0] ) ) {
			for ($i = 0; $i < count($matches[0]); $i++) {
				$parts = explode( '-', $matches[1][$i] );
				$instance_var = '$instance[ "' . implode( '"]["', $parts ) . '" ]';

				$less_vars_code .= 'if isset( ' . $instance_var . ' ) $return[ "' . $matches[1][$i] . '" ] = ' . $instance_var . ';' . "\n";
			}
		}
		$less_vars_code .= 'return $return;';
		$widget_code = str_replace(
			'/* {{RETURN_LESS_VARIABLES}} */',
			str_replace( "\n", "\n\t\t", $less_vars_code ),
			$widget_code
		);

		return $widget_code;
	}
}