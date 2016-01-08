<?php
class LD_Widget_Google_Maps extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_google_maps', 
			__('Section: Google Maps (PB)' , 'lovey_dovey'),
			array('description' => __('Show location on Google Maps', 'lovey_dovey'),) //args
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
			
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Our Wedding Location', 'lovey_dovey');
		$height = isset( $instance[ 'height' ] ) ? $instance[ 'height' ] : 500 ;
		$position = isset( $instance[ 'position' ] ) ? $instance[ 'position' ] : '0,0' ;

		$gmap_zoom = 17;
		$latlng = explode( ',' , $position, 2 );
		$latlng = array_map( 'trim', $latlng ); 
		
		echo $args['before_widget'];
		?>
		<div class="section">
			<div class="title"><?php echo $title; ?></div>
			<div class="js-gmap gmap" data-zoom="<?php echo $gmap_zoom; ?>" data-lat="<?php echo $latlng[0]; ?>" data-lng="<?php echo $latlng[1]; ?>" data-scroll="false" style="height: <?php echo $height.'px'; ?>;"></div>
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
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Our Wedding Location', 'lovey_dovey');
		$height = isset( $instance[ 'height' ] ) ? $instance[ 'height' ] : 500 ;
		$position = isset( $instance[ 'position' ] ) ? $instance[ 'position' ] : '0,0' ;
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'position' ); ?>"><?php _e( 'Location (Latitude , Longitude): e.g. -7.982425, 112.631036', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'position' ); ?>" name="<?php echo $this->get_field_name( 'position' ); ?>" type="text" value="<?php echo esc_attr( $position ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['height'] = (int) $new_instance['height'];
		$instance['position'] = $new_instance['position'];
		return $instance;
	}

}
