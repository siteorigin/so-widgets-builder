<?php

return array (
	'builder' => array(
		'label' => __( 'SiteOrigin (SiteOrigin Page Builder)', 'so-widgets-bundle' ),
	),
	'checkbox' => array(
		'label' => __( 'Checkbox', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'checkboxes' => array(
		'label' => __( 'Checkboxes', 'so-widgets-bundle' ),
		'fields' => array( 'options' ),
	),
	'color' => array(
		'label' => __( 'Color', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'font' => array(
		'label' => __( 'Font', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'icon' => array(
		'label' => __( 'Icon', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'image-size' => array(
		'label' => __( 'Image Size', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'link' => array(
		'label' => __( 'Link', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'measurement' => array(
		'label' => __( 'Measurement', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'media' => array(
		'label' => __( 'Media', 'so-widgets-bundle' ),
		'fields' => array( 'choose', 'update', 'library' ),
	),
	'number' => array(
		'label' => __( 'Number', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'placeholder', 'min', 'max' ),
	),
	'posts' => array(
		'label' => __( 'Posts', 'so-widgets-bundle' ),
	),
	'radio' => array(
		'label' => __( 'Radio', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'options' ),
	),
	'repeater' => array(
		'label' => __( 'Repeater', 'so-widgets-bundle' ),
		'fields' => array( 'sub_fields' )
	),
	'section' => array(
		'label' => __( 'Section', 'so-widgets-bundle' ),
		'fields' => array( 'sub_fields' )
	),
	'select' => array(
		'label' => __( 'Select', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'prompt', 'options' ),
	),
	'slider' => array(
		'label' => __( 'Slider', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'min', 'max' ),
	),
	'text' => array(
		'label' => __( 'Text', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'placeholder' ),
	),
	'textarea' => array(
		'label' => __( 'Textarea', 'so-widgets-bundle' ),
		'fields' => array( 'default', 'placeholder' ),
	),
	'tinymce' => array(
		'label' => __( 'TinyMCE Editor', 'so-widgets-bundle' ),
		'fields' => array( 'default' ),
	),
	'widget' => array(
		'label' => __( 'Widget', 'so-widgets-bundle' ),
		'fields' => array( 'class' ),
	),
);