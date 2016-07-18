<?php

return array (
	'builder' => array(
		'label' => __( 'Builder (SiteOrigin Page Builder)', 'so-widgets-builder' ),
	),
	'checkbox' => array(
		'label' => __( 'Checkbox', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'checkboxes' => array(
		'label' => __( 'Checkboxes', 'so-widgets-builder' ),
		'fields' => array( 'options' ),
	),
	'color' => array(
		'label' => __( 'Color', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'font' => array(
		'label' => __( 'Font', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'icon' => array(
		'label' => __( 'Icon', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'image-size' => array(
		'label' => __( 'Image Size', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'link' => array(
		'label' => __( 'Link', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'measurement' => array(
		'label' => __( 'Measurement', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'media' => array(
		'label' => __( 'Media', 'so-widgets-builder' ),
		'fields' => array( 'choose', 'update', 'library' ),
	),
	'number' => array(
		'label' => __( 'Number', 'so-widgets-builder' ),
		'fields' => array( 'default', 'placeholder', 'min', 'max' ),
	),
	'posts' => array(
		'label' => __( 'Posts', 'so-widgets-builder' ),
	),
	'radio' => array(
		'label' => __( 'Radio', 'so-widgets-builder' ),
		'fields' => array( 'default', 'options' ),
	),
	'repeater' => array(
		'label' => __( 'Repeater', 'so-widgets-builder' ),
		'fields' => array( 'sub_fields' )
	),
	'section' => array(
		'label' => __( 'Section', 'so-widgets-builder' ),
		'fields' => array( 'sub_fields' )
	),
	'select' => array(
		'label' => __( 'Select', 'so-widgets-builder' ),
		'fields' => array( 'default', 'prompt', 'options' ),
	),
	'slider' => array(
		'label' => __( 'Slider', 'so-widgets-builder' ),
		'fields' => array( 'default', 'min', 'max' ),
	),
	'text' => array(
		'label' => __( 'Text', 'so-widgets-builder' ),
		'fields' => array( 'default', 'placeholder' ),
	),
	'textarea' => array(
		'label' => __( 'Textarea', 'so-widgets-builder' ),
		'fields' => array( 'default', 'placeholder' ),
	),
	'tinymce' => array(
		'label' => __( 'TinyMCE Editor', 'so-widgets-builder' ),
		'fields' => array( 'default' ),
	),
	'widget' => array(
		'label' => __( 'Widget', 'so-widgets-builder' ),
		'fields' => array( 'class' ),
	),
);