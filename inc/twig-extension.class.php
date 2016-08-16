<?php
class SiteOrigin_Widget_Twig_Extension extends Twig_Extension {

	public function getName() {
		return 'so-widget-builder';
	}

	public function getGlobals() {
		if ( ! class_exists( 'SiteOrigin_Widget_Twig_Proxy' ) ) {
			include plugin_dir_path( __FILE__ ) . 'twig-proxy.class.php';
		}

		return array(
			'wp' => new SiteOrigin_Widget_Twig_Proxy(),
		);
	}

	public function getFunctions() {
		if ( ! class_exists( 'SiteOrigin_Widget_Twig_Functions' ) ) {
			include plugin_dir_path( __FILE__ ) . 'twig-functions.class.php';
		}

		return array(
			new Twig_SimpleFunction( 'so_query', array( 'SiteOrigin_Widget_Twig_Functions', 'so_query' ) ),
		);
	}

	public function getFilters() {
		if ( ! class_exists( 'SiteOrigin_Widget_Twig_Filters' ) ) {
			include plugin_dir_path( __FILE__ ) . 'twig-filters.class.php';
		}

		return array(
			new Twig_SimpleFilter('panels_render', array( 'SiteOrigin_Widget_Twig_Filters', 'panels_render' ) ),
			new Twig_SimpleFilter('image', array( 'SiteOrigin_Widget_Twig_Filters', 'image' ) ),
		);
	}
}
