<?php
class LD_Widget_Quote extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_quote', 
			__('Section: Quote (PB)' , 'lovey_dovey'),
			array('description' => __('Quote', 'lovey_dovey'),) //args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		$background_image = $instance['bg_image'];
		$background_repeat = $instance['bg_repeat'];
		$background_position = $instance['bg_position'];
		$background_attachment = $instance['bg_attachment'];
		$background_size = $instance['bg_size'];
		$parallax = $instance['parallax'];
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';

		if ( $parallax ) wp_enqueue_script( 'jquery-parallax' );

		$style = implode( " ", array(
			! empty( $background_image ) ? "background-image: url($background_image);" : "",
			! empty( $background_position ) ? "background-position: $background_position;" : "",
			! empty( $background_repeat ) ? "background-repeat: $background_repeat;" : "",
			! empty( $background_size ) ? "background-size: $background_size;" : "",
			! empty( $background_attachment ) ? "background-attachment: $background_attachment;" : "",
		) );
		?>

		<div class="section <?php echo $color_scheme; ?>-scheme" >
			<?php if (! empty ($background_image) ) { ?>
				<div class="section-background <?php echo $parallax ? 'parallax-background' : ''; ?> <?php if ($instance['overlay'] != 'none') { echo $instance['overlay']; } ?>" style="<?php echo $style; ?>"></div>
			<?php } ?>

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="quote-text">
							<?php echo $instance['quote']; ?>
						</div>
						<div class="cite-text">
							<?php echo $instance['cite']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'quote' ] ) ) {
			$quote = $instance[ 'quote' ];
		}
		else {
			$quote = '';
		}

		if ( isset( $instance[ 'cite' ] ) ) {
			$cite = $instance[ 'cite' ];
		}
		else {
			$cite = '';
		}

		if ( isset( $instance[ 'bg_image' ] ) ) {
			$bg_image = $instance[ 'bg_image' ];
		}
		else {
			$bg_image = '';
		}

		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';

		$bg_position = isset( $instance['bg_position'] ) ? $instance['bg_position'] : '';
		$bg_attachment = isset( $instance['bg_attachment'] ) ? $instance['bg_attachment'] : '';
		$bg_repeat = isset( $instance['bg_repeat'] ) ? $instance['bg_repeat'] : '';
		$bg_size = isset( $instance['bg_size'] ) ? $instance['bg_size'] : '';
		$overlay = isset( $instance['overlay'] ) ? $instance['overlay'] : 'none';

	?>
		<p><label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e( 'Quote:', 'lovey_dovey' ); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>" rows="4"><?php echo esc_attr( $quote ); ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id( 'cite' ); ?>"><?php _e( 'Cite:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'cite' ); ?>" name="<?php echo $this->get_field_name( 'cite' ); ?>" type="text" value="<?php echo esc_attr( $cite ); ?>"></p>

		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color scheme:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>">
				<option value="light" <?php selected ($color_scheme, 'light' ); ?> ><?php _e('Black on White', 'lovey_dovey'); ?></option>
				<option value="dark" <?php selected ($color_scheme, 'dark' ); ?> ><?php _e('White on Black', 'lovey_dovey'); ?></option>
				<option value="gray" <?php selected ($color_scheme, 'gray' ); ?> ><?php _e('Black on Light Gray', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'bg_image' ); ?>"><?php _e( 'Background Image:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'bg_image' ); ?>" name="<?php echo $this->get_field_name( 'bg_image' ); ?>" type="text" value="<?php echo esc_attr( $bg_image ); ?>"></p>

		<p>
			<label for="<?php echo $this->get_field_id('bg_position'); ?>"><?php _e('Background Position:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('bg_position'); ?>" name="<?php echo $this->get_field_name('bg_position'); ?>">
				<option value="left top" <?php selected ($bg_position, 'left top'); ?> ><?php _e('left top', 'lovey_dovey'); ?></option>
				<option value="center top" <?php selected ($bg_position, 'center top'); ?> ><?php _e('center top', 'lovey_dovey'); ?></option>
				<option value="right top" <?php selected ($bg_position, 'right top'); ?> ><?php _e('right top', 'lovey_dovey'); ?></option>

				<option value="left center" <?php selected ($bg_position, 'left center'); ?> ><?php _e('left center', 'lovey_dovey'); ?></option>
				<option value="center center" <?php selected ($bg_position, 'center center'); ?> ><?php _e('center center', 'lovey_dovey'); ?></option>
				<option value="right center" <?php selected ($bg_position, 'right center'); ?> ><?php _e('right center', 'lovey_dovey'); ?></option>

				<option value="left bottom" <?php selected ($bg_position, 'left bottom'); ?> ><?php _e('left bottom', 'lovey_dovey'); ?></option>
				<option value="center bottom" <?php selected ($bg_position, 'center bottom'); ?> ><?php _e('center bottom', 'lovey_dovey'); ?></option>
				<option value="right bottom" <?php selected ($bg_position, 'right bottom'); ?> ><?php _e('right bottom', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('bg_attachment'); ?>"><?php _e('Background Attachment:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('bg_attachment'); ?>" name="<?php echo $this->get_field_name('bg_attachment'); ?>">
				<option value="scroll" <?php selected ($bg_attachment, 'scroll'); ?> ><?php _e('scroll', 'lovey_dovey'); ?></option>
				<option value="fixed" <?php selected ($bg_attachment, 'fixed'); ?> ><?php _e('fixed', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('bg_repeat'); ?>"><?php _e('Background Repeat:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('bg_repeat'); ?>" name="<?php echo $this->get_field_name('bg_repeat'); ?>">
				<option value="no-repeat" <?php selected ($bg_repeat, 'no-repeat'); ?> ><?php _e('no-repeat', 'lovey_dovey'); ?></option>
				<option value="repeat" <?php selected ($bg_repeat, 'repeat'); ?> ><?php _e('repeat', 'lovey_dovey'); ?></option>
				<option value="repeat-x" <?php selected ($bg_repeat, 'repeat-x'); ?> ><?php _e('repeat-x', 'lovey_dovey'); ?></option>
				<option value="repeat-y" <?php selected ($bg_repeat, 'repeat-y'); ?> ><?php _e('repeat-y', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('bg_size'); ?>"><?php _e('Background Size:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('bg_size'); ?>" name="<?php echo $this->get_field_name('bg_size'); ?>">
				<option value="auto" <?php selected ($bg_size, 'auto'); ?> ><?php _e('auto', 'lovey_dovey'); ?></option>
				<option value="contain" <?php selected ($bg_size, 'contain'); ?> ><?php _e('contain', 'lovey_dovey'); ?></option>
				<option value="cover" <?php selected ($bg_size, 'cover'); ?> ><?php _e('cover', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('overlay'); ?>"><?php _e('Overlay:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('overlay'); ?>" name="<?php echo $this->get_field_name('overlay'); ?>">
				<option value="none" <?php selected ($overlay, 'none'); ?> ><?php _e('none', 'lovey_dovey'); ?></option>
				<option value="dotted-overlay" <?php selected ($overlay, 'dotted-overlay'); ?> ><?php _e('dotted-overlay', 'lovey_dovey'); ?></option>
				<option value="black-overlay" <?php selected ($overlay, 'black-overlay'); ?> ><?php _e('black-overlay', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('parallax'); ?>" name="<?php echo $this->get_field_name('parallax'); ?>" type="checkbox" <?php checked(isset($instance['parallax']) ? $instance['parallax'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('parallax'); ?>"><?php _e('Enable Parallax','lovey_dovey'); ?></label>
		</p>
	<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
		$instance['quote'] = ( ! empty( $new_instance['quote'] ) ) ? $new_instance['quote'] : '';
		$instance['cite'] = ( ! empty( $new_instance['cite'] ) ) ? $new_instance['cite'] : '';
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['bg_image'] = ( ! empty( $new_instance['bg_image'] ) ) ? $new_instance['bg_image'] : '';
		$instance['bg_position'] = ( ! empty( $new_instance['bg_position'] ) ) ? $new_instance['bg_position'] : '';
		$instance['bg_attachment'] = ( ! empty( $new_instance['bg_attachment'] ) ) ? $new_instance['bg_attachment'] : '';
		$instance['bg_repeat'] = ( ! empty( $new_instance['bg_repeat'] ) ) ? $new_instance['bg_repeat'] : '';
		$instance['bg_size'] = ( ! empty( $new_instance['bg_size'] ) ) ? $new_instance['bg_size'] : '';
		$instance['overlay'] = ( ! empty( $new_instance['overlay'] ) ) ? $new_instance['overlay'] : '';
		$instance['parallax'] = isset($new_instance['parallax']);
		return $instance;
	}

}