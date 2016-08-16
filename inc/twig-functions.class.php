<?php

class SiteOrigin_Widget_Twig_Functions {
    
    static function so_query( $query ) {
		if ( ! class_exists( 'SiteOrigin_Widget_Twig_Query' ) ) {
			include plugin_dir_path( __FILE__ ) . 'twig-query.class.php';
		}

	return function_exists( 'siteorigin_widget_post_selector_process_query' ) ?
	    new SiteOrigin_Widget_Twig_Query( siteorigin_widget_post_selector_process_query ( $query ) ) :
	    __( 'Page builder is required to render this field.', 'so-widgets-builder' );
    }

}
