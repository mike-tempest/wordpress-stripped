<?php
/**
 * admin.class.php
 *
 * This file contains class mt_Admin_Pages that builds theme option pages
 * in the wp-admin
 *
 * @package wordpress-stripped
 */

//check if class already exists
if( !class_exists( 'mt_Admin_Pages' ) ) {
    /**
     *
     * Class for creating admin theme options
     * @author Matt <info@michaeltempest.co.uk>
     * @since 1.0
     */
	abstract class mt_Admin_Pages {

	    /**
	     *
	     * array of settings for the options
	     * @var 	array
	     * @since 	1.0
	     */
		protected $admin_page;

		/**
		 *
		 * array of fields to be used
		 * @var 	array
		 * @since	1.0
		 */
		protected $fields;

		/**
		 *
		 * array of sections to be used
		 * @var 	array
		 * @since	1.0
		 */
		protected $section;

		/**
		 *
		 * Builds the page content
		 * @returns 	html
		 * @author		Matt <info@michaeltempest.co.uk>
		 * @since 		1.0
		 */
		function create_page_content() { ?>
			<div class="wrap">
				<?php
					// Give the user some response to the save action.
					settings_errors();
				?>
				<form action="options.php" method="post">
					<?php
						settings_fields( $this->admin_page['settings_section'] ); // Settings group.
						do_settings_sections( $this->admin_page['settings_section'] ); // Churn out the settings section Database options.
						submit_button(); // Add the submit button to the mix.
					?>
				</form>
			</div>
		<?php }

		/**
		 *
		 * html for a textbox field
		 * @param 		array $args
		 * @return 		html
		 * @author		Matt <info@michaeltempest.co.uk>
		 * @since		1.0
		 */
		function textbox_field( $args ) { ?>
			<input id="<?php echo $args['field_name']; ?>" name="<?php echo $this->admin_page['settings_name']; ?>[<?php echo $args['field_name']; ?>]" size='40' type='text' value="<?php echo $this->get_theme_options( $args['field_name'] ); ?>" class="regular-text" />
			<?php
				if( !empty( $args['field_desc'] ) )
					echo '<p class="description">' . $args['field_desc'] . '</p>';
			?>
		<?php }

		/**
		 *
		 * html for a textarea field
		 * @param 		array $args
		 * @return 		html
		 * @author 		Matt <info@michaeltempest.co.uk>
		 * @since		1.0
		 */
		function textarea_field( $args ) { ?>
			<textarea id="<?php echo $args['field_name']; ?>" name="<?php echo $this->admin_page['settings_name']; ?>[<?php echo $args['field_name']; ?>]" rows="10" cols="50" class="large-text code"><?php
				if( $this->get_theme_options( $args['field_name'] ) )
					echo $this->get_theme_options( $args['field_name'] );
			?></textarea>
			<?php
				if( !empty( $args['field_desc'] ) )
					echo '<p class="description">' . $args['field_desc'] . '</p>';
			?>
		<?php }

		/**
		 *
		 * html for a wysiwyg field
		 * @param 		array $args
		 * @return 		html
		 * @author		Matt <info@michaeltempest.co.uk>
		 * @since 		1.0
		 * @todo 		get this to work
		 */
		function wysiwyg_field( $args ) {
			$content = stripslashes( $this->get_theme_options( $args['field_name'] ) ); // Set the $content var up
			wp_editor( $content, $args['field_name'], array(
				'textarea_name' => $this->admin_page['settings_name'] . '[' .  $args['field_name'] . ']'
			) );
			if( !empty( $args['field_desc'] ) )
				echo '<p class="description">' . $args['field_desc'] . '</p>';
		}

		/**
		 *
		 * html for a radio field
		 * @param 		array $args
		 * @return 		html
		 * @author		Matt <info@michaeltempest.co.uk>
		 */
		function radio_field( $args ) {
			$max = count( $args['field_options'] );
			$i = 0;
			foreach( $args['field_options'] as $key => $value ) { $i += 1; ?>
				<label>
					<input type="radio" value="<?php echo $value; ?>" id="<?php echo $args['field_name']; ?>" name="<?php echo $this->admin_page['settings_name']; ?>[<?php echo $args['field_name']; ?>]" <?php if( $this->get_theme_options( $args['field_name'] ) == $value ) {
						echo 'checked="checked"';
					} ?> />
					<?php echo $key; ?>
				</label>
				<?php if( $i < $max ) { // Add a break after the radio buttons unless it is the last radio button.
					echo '<br />';
				} ?>
			<?php }
			if( !empty( $args['field_desc'] ) )
				echo '<p class="description">' . $args['field_desc'] . '</p>';
		}

		/**
		 *
		 * html for a select field
		 * @param 		array $args
		 * @return 		html
		 * @since		1.0
		 * @author		Matt <info@michaeltempest.co.uk>
		 */
		function select_field( $args ) {
			echo '<select id="' . $args['field_name'] . '" name="' . $this->admin_page['settings_name'] . '[' . $args['field_name'] . ']">';
				foreach( $args['field_options'] as $key => $value ) { ?>
					<option value="<?php echo $value; ?>" <?php if( $this->get_theme_options( $args['field_name'] ) == $value ) {
						echo 'selected="selected"';
					} ?>><?php echo $key; ?></option>
				<?php }
			echo '</select>';
			if( !empty( $args['field_desc'] ) )
				echo '<p class="description">' . $args['field_desc'] . '</p>';
		}

		/**
		 *
		 * html for a subtitle text
		 * @return 	html
		 * @since 		1.0
		 * @author		Matt <info@michaeltempest.co.uk>
		 */
		function settings_description() { ?>
			<div id="icon-options-general" class="icon32"><br /></div>
			<h2><?php echo $this->admin_page['page_title']; ?></h2>
			<?php if( $this->admin_page['settings_desc'] ) { ?>
				<p><?php echo $this->admin_page['settings_desc']; ?></p>
			<?php } ?>
		<?php }

        /**
         *
         * Get theme data
         * @param 	int $id
         * @return string/bool
         * @since 	1.0
         * @author	Michael Tempest <info@michaeltempest.co.uk>
         */
		function get_theme_options( $id ) {
			$options = get_option( $this->admin_page['settings_name'] );
			// Make a check to see if it exists first.
			if( !empty( $options[$id] ) )
				return stripslashes( trim( $options[$id] ) ); // Return the saved data.
			else
				return false; // Else just return false.
		}

		/**
		 *
		 * Registers theme options
		 * @author	Michael Tempest <info@michaeltempest.co.uk>
		 * @since 	1.0
		 */
		function register_theme_settings() {

			register_setting(
				$this->admin_page['settings_section'], // Store all settings under the $this->section var as an array.
				$this->admin_page['settings_name'] // Set the name of the options, all values will be saved in this array.
			);
			// Create the settings section.
			add_settings_section(
				$this->admin_page['settings_name'], // Set the unique ID of the section.
				false, // Set the title of the section.
				array( // Show the settings content in the section.
					&$this,
					'settings_description'
				),
				$this->admin_page['settings_section'] // This is the page name the settings section should appear on.
			);
			// Loop through the fields that have been defined and add them to the settings section.
			foreach ( $this->fields as $field ) {
				// Set up the callback array.
				$callback_args = array(
					'field_name' => $field['name'],
					'label_for' => $field['name']
				);
				// If there are options included in the $fields array merge the options into the $callback_args array.
				if( array_key_exists( 'options', $field ) )
					$callback_args = array_merge( $callback_args, array(
						'field_options' => $field['options']
					) );
				// If there is a description included in the $fields array merge the description in the $callback_args array.
				if( array_key_exists( 'desc', $field ) )
					$callback_args = array_merge( $callback_args, array(
						'field_desc' => $field['desc']
					) );
				// Create the settings field.
				add_settings_field(
					$field['name'], // Set the field name.
					$field['title'], // Set the field title.
					array(
						&$this,
						$field['type'] . '_field' // Pull through the field HTML.
					),
					$this->admin_page['settings_section'], // Add it to the page.
					$this->admin_page['settings_name'], // Add it to the settings section via the settings ID.
					$callback_args
				);
				unset( $callback_args );
			}
		}
		
	}
}