<?php
class SiteOrigin_Widget_Twig_Query implements Iterator {
    private $wp_query_args;
    private $query;
    private $have_post = FALSE;

    public function __construct( $wp_query_args ) {
	$this->wp_query_args = $wp_query_args;
    }

    function rewind() {
	$this->query = new WP_Query( $this->wp_query_args );
	$this->next();
    }

    function next() {
	if ( $this->have_post = isset( $this->query ) && $this->query->have_posts() ) {
	    $this->query->the_post();
	}
	else if ( isset( $this->query ) ) {
	    wp_reset_postdata();
	    unset( $this->query );
	}
    }

    function current() {
	return get_post();
    }

    function key() {
	return get_the_ID();
    }

    function valid() {
	return $this->have_post;
    }
}
