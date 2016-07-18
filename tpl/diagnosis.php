<div class="wrap">
	<h1><?php _e( 'Widgets Builder Diagnosis', 'so-widgets-bundle' ) ?></h1>

	<p style="margin-bottom: 20px;">
		<?php _e( "The widgets builder can't work with your current installation.", 'so-widgets-builder' ) ?>
		<?php _e( "See the diagnosis below for information on what you could fix.", 'so-widgets-builder' ) ?>
	</p>

	<pre style="background-color: #fff; padding: 20px; max-width: 620px; border: 1px solid #d8d8d8"><?php echo $this->diagnosis_information() ?></pre>
</div>