<?php

class SiteOrigin_Widgets_Builder_Form extends SiteOrigin_Widget {

	function __construct( ) {
		parent::__construct(
			'widget-builder-form',
			__( 'SiteOrigin Widget Builder', 'so-widgets-builder' ),
			array(
				'has_preview' => false,
			),
			array(),
			array(),
			plugin_dir_path(__FILE__)
		);

		static $form_number = 1;
		$this->number = $form_number++;
	}

	/**
	 * Initialize the Builder Form field
	 *
	 * @return array
	 */
	function initialize_form() {

		return array(
			'description' => array(
				'label' => __( 'Widget Description', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
			),

			'has_title' => array(
				'label' => __( 'Title Field', 'so-widgets-builder' ),
				'description' => __( 'Does this widget need a title field', 'so-widgets-builder' ),
				'type' => 'checkbox',
				'default' => true,
			),

			'fields' => array(
				'type' => 'repeater',
				'label' => __( 'Widget Form Fields', 'so-widgets-builder' ),
				'item_name'  => __( 'Field', 'so-widgets-builder' ),
				'item_label' => array(
					'selector'     => ".siteorigin-widget-input[id*='fields-label']",
					'update_event' => 'change',
					'value_method' => 'val'
				),
				'fields' => $this->get_field_array( 4 ),
			),

			'scripts' => array(
				'type' => 'repeater',
				'label' => __( 'Javascript Scripts', 'so-widgets-builder' ),
				'item_name'  => __( 'Script', 'so-widgets-builder' ),
				'fields' => array(
					'file' => array(
						'type' => 'media',
						'label' => __( 'Javascript File', 'so-widgets-builder' ),
						'choose' => __( 'Choose Script', 'so-widgets-builder' ),
						'update' => __( 'Update Script', 'so-widgets-builder' ),
						'library' => 'file',
					),
					'jquery' => array(
						'type' => 'checkbox',
						'label' => __( 'Requires jQuery', 'so-widgets-builder' ),
						'default' => false
					)
				)
			),

			'styles' => array(
				'type' => 'repeater',
				'label' => __( 'CSS Styles', 'so-widgets-builder' ),
				'item_name'  => __( 'Style', 'so-widgets-builder' ),
				'fields' => array(
					'file' => array(
						'type' => 'media',
						'label' => __( 'CSS File', 'so-widgets-builder' ),
						'choose' => __( 'Choose Style', 'so-widgets-builder' ),
						'update' => __( 'Update Style', 'so-widgets-builder' ),
						'library' => 'file',
					),
				)
			),

			'template_code' => array(
				'type' => 'code',
				'rows' => 8,
				'label' => __( 'Template HTML Code', 'so-widgets-builder' ),
			),

			'less_code' => array(
				'type' => 'code',
				'rows' => 8,
				'label' => __( 'Template LESS Code', 'so-widgets-builder' ),
			),
		);
	}

	/**
	 * These are fields that all field types will have
	 *
	 * @return array
	 */
	private function get_general_field_fields(){
		return array(
			'type' => array(
				'label' => __( 'Field Type', 'so-widgets-builder' ),
				'type' => 'select',
				'default' => 'text',
				'state_emitter' => array(
					'callback' => 'select',
					'args' => array( 'field_type_{$repeater}' )
				)
			),
			'label' => array(
				'label' => __( 'Field Label', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
			),
			'description' => array(
				'label' => __( 'Field Description', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
			),
			'variable' => array(
				'label' => __( 'Variable Name', 'so-widgets-builder' ),
				'type' => 'text',
				'description' => __( 'Machine readable name for this field. Should only consist of lowercase characters and _ characters.', 'so-widgets-builder' ),
				'default' => '',
			),
		);
	}

	private function get_specific_fields(){
		return array(
			'default' => array(
				'label' => __( 'Default Value', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
				'_for_fields' => array(),
			),

			'placeholder' => array(
				'label' => __( 'Placeholder', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
				'_for_fields' => array(),
			),

			// Number fields
			'min' => array(
				'label' => __( 'Minimum Value', 'so-widgets-builder' ),
				'type' => 'number',
				'default' => 0,
				'_for_fields' => array(),
			),
			'max' => array(
				'label' => __( 'Maximum Value', 'so-widgets-builder' ),
				'type' => 'number',
				'default' => 100,
				'_for_fields' => array(),
			),

			// Select fields
			'prompt' => array(
				'label' => __( 'Prompt', 'so-widgets-builder' ),
				'description' => __( 'Text that prompts a user on select values', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
				'_for_fields' => array(),
			),
			'options' => array(
				'label' => __( 'Options', 'so-widgets-builder' ),
				'item_label' => array(
					'selector'     => ".siteorigin-widget-input[id*='fields-label']",
					'update_event' => 'change',
					'value_method' => 'val'
				),
				'description' => __( 'Select options available to this field', 'so-widgets-builder' ),
				'type' => 'repeater',
				'fields' => array(
					'label' => array(
						'label' => __( 'Label', 'so-widgets-builder' ),
						'type' => 'text',
					),
					'value' => array(
						'label' => __( 'Value', 'so-widgets-builder' ),
						'type' => 'text',
					),
				),
				'_for_fields' => array(),
			),

			// Media field
			'choose' => array(
				'label' => __( 'Choose Label', 'so-widgets-builder' ),
				'description' => __( 'A label for the title of the media selector dialog.', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => __( 'Choose Media', 'so-widgets-builder' ),
				'_for_fields' => array(),
			),
			'update' => array(
				'label' => __( 'Update Label', 'so-widgets-builder' ),
				'description' => __( 'A label for the confirmation button of the media selector dialog.', 'so-widgets-builder' ),
				'type' => 'text',
				'default' =>  __( 'Set Media', 'so-widgets-builder' ),
				'_for_fields' => array(),
			),
			'library' => array(
				'label' => __( 'Library', 'so-widgets-builder' ),
				'description' => __( 'What type of fields are allowed.', 'so-widgets-builder' ),
				'type' => 'select',
				'default' => 'file',
				'options' => array(
					'file' => __( 'File', 'so-widgets-builder' ),
					'image' => __( 'Image	', 'so-widgets-builder' ),
					'audio' => __( 'Audio', 'so-widgets-builder' ),
					'video' => __( 'Video', 'so-widgets-builder' ),
				),
				'_for_fields' => array(),
			),

			// The widget field
			'class' => array(
				'label' => __( 'Widget Class', 'so-widgets-builder' ),
				'description' => __( 'The class name for a sub widget.', 'so-widgets-builder' ),
				'type' => 'text',
				'default' => '',
				'_for_fields' => array(),
			)
		);
	}

	private function get_field_array( $depth ){
		if( $depth == 0 ) return array();

		static $fields;
		if( empty( $fields ) ) {
			$fields = include plugin_dir_path( __FILE__ ) . '../data/fields.php';
		}

		$return = array_merge(
			$this->get_general_field_fields(),
			$this->get_specific_fields()
		);

		// Add the field types to the type field
		$type_array = array();
		foreach( $fields as $k => & $field ) {
			$type_array[$k] = $field['label'];
		}
		$return['type']['options'] = $type_array;

		// Add the sub fields
		if( $depth >= 1 ) {
			$return['sub_fields'] = array(
				'type' => 'repeater',
				'label' => __( 'Fields', 'so-widgets-builder' ),
				'item_name'  => __( 'Field', 'so-widgets-builder' ),
				'item_label' => array(
					'selector'     => ".siteorigin-widget-input[id*='fields-label']",
					'update_event' => 'change',
					'value_method' => 'val'
				),
				'fields' => $this->get_field_array( --$depth ),
				'_for_fields' => array(),
			);
		}

		// Fill in all the _for_fields values
		foreach( $fields as $k => $field ) {
			if( empty( $field[ 'fields' ] ) ) continue;
			foreach( $field[ 'fields' ] as $f ) {
				// Skip any fields that don't have _for_fields
				if( ! isset( $return[$f]['_for_fields'] ) ) continue;
				$return[$f]['_for_fields'][] = $k;
			}
		}

		// Convert the _for_fields values into state handler arguments
		foreach( $return as & $f ) {
			if( ! isset( $f['_for_fields'] ) ) continue;

			$f['state_handler'] = array(
				'field_type_{$repeater}[' . implode( ',', $f['_for_fields'] ) . ']' => array('show'),
				'_else[field_type_{$repeater}]' => array( 'hide' ),
			);
			unset( $f['_for_fields'] );
		}

		return $return;
	}

	/**
	 * Get a specially prefixed name
	 *
	 * @param string $field_name
	 *
	 * @return string
	 */
	function get_field_name( $field_name ){
		return 'so_custom_widget[' . $field_name . ']';
	}

	/**
	 * Chance the message displayed while loading the form.
	 */
	function scripts_loading_message(){
		?><p><strong><?php _e('Scripts and styles for this form are loading.', 'siteorigin-premium') ?></strong></p><?php
	}

	/**
	 * This widget will never be rendered on the frontend, so add a noop.
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

	}

	function update($new_instance, $old_instance) {
		// Do all the necessary sanitization
		$new_instance = parent::update($new_instance, $old_instance);

		$fields = include plugin_dir_path( __FILE__ ) . '../data/fields.php';

		$field_fields = array_merge(
			$this->get_general_field_fields(),
			$this->get_specific_fields()
		);
		foreach( $fields as $k => $field ) {
			if( empty( $field[ 'fields' ] ) ) continue;
			foreach( $field[ 'fields' ] as $f ) {
				// Skip any fields that don't have _for_fields
				if( ! isset( $field_fields[$f]['_for_fields'] ) ) continue;
				$field_fields[$f]['_for_fields'][] = $k;
			}
		}

		$new_instance['fields'] = $this->remove_excess_attributes( $new_instance['fields'], $field_fields );

		return $new_instance;
	}

	/**
	 * @param $fields
	 * @param $field_fields
	 * @return mixed
	 */
	private function remove_excess_attributes( $fields, $field_fields ){
		foreach( $fields as & $field ) {
			$type = ! empty( $field['type'] ) ? $field['type'] : false;
			if( empty( $type ) ) continue;

			foreach( $field as $k => $v ) {
				if( empty( $field_fields[$k] ) || empty( $field_fields[$k]['_for_fields'] ) ) continue;
				if( ! in_array( $type, $field_fields[$k]['_for_fields'] ) ) {
					unset( $field[$k] );
				}
			}

			if( !empty( $field['sub_fields'] ) ) {
				$field['sub_fields'] = $this->remove_excess_attributes( $field['sub_fields'], $field_fields );
			}
		}

		return $fields;
	}
}