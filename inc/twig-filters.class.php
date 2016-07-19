<?php

class SiteOrigin_Widget_Twig_Filters {
	
	static function panels_render( $panels_data ){
		return function_exists( 'siteorigin_panels_render' ) ?
			siteorigin_panels_render( 'w'.substr( md5( json_encode( $panels_data ) ), 0, 8 ), true, $panels_data ) :
			__( 'Page builder is required to render this field.', 'so-widgets-builder' );
	}

	static function image( $id, $type = 'html', $size = 'full' ) {
		switch( $type ) {
			case 'html' :
				return wp_get_attachment_image( $id, $size );
				break;

			default :
				$src = wp_get_attachment_image_src( $id, $size );
				if( empty( $src ) ) return '';
				if( $type == 'src' ) {
					return $src[0];
				}
				else if( $type == 'width' ) {
					return $src[1];
				}
				else if( $type == 'height' ) {
					return $src[2];
				}
				break;
		}
	}
	
}