<?php
class LD_Widget_Photo_Gallery extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_photo_gallery', 
			__('Section: Photo Gallery (PB)' , 'lovey_dovey'),
			array('description' => __('Display Photo Gallery', 'lovey_dovey'),) //args
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
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Photo Gallery', 'lovey_dovey');
		$order_by = isset( $instance['order_by'] ) ? $instance['order_by'] : 'menu_order';
		$color_scheme = isset ( $instance['color_scheme'] ) ? $instance['color_scheme'] : 'light';
		$gallery_page_url = isset( $instance[ 'gallery_page_url' ] ) ? $instance[ 'gallery_page_url' ] : '';
		
		?>
		<div class="section <?php echo $color_scheme; ?>-scheme">
			<div class="container"> 
				<div class="title"><?php echo $title; ?></div>
				<?php
				$shortcode_attr = array();

				foreach($instance as $k => $v){
					if(empty($v)) continue;
					if ($k === 'ids') $shortcode_attr[] = $k.'="'.esc_attr($v).'"';
				}
				echo do_shortcode('[gallery '.implode(' ', $shortcode_attr).' orderby="'.$order_by.'"]'); 

				if ( !empty( $gallery_page_url) ) { ?>
				<div class="more-gallery"><a href="<?php echo $gallery_page_url; ?>" class="button heading"><?php _e('View All Photos','lovey_dovey'); ?></a></div>
				<?php } ?>
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
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Photo Gallery', 'lovey_dovey');
		$ids = isset( $instance['ids'] ) ? $instance['ids'] : '';
		$order_by = isset( $instance['order_by'] ) ? $instance['order_by'] : 'menu_order';
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';
		$gallery_page_url = isset( $instance[ 'gallery_page_url' ] ) ? $instance[ 'gallery_page_url' ] : '';
	
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ids' ) ?>"><?php _e( 'Gallery Images:', 'lovey_dovey' ) ?></label>
			<a href="#" onclick="return false;" class="ld-photo-gallery-widget-select-attachments"><?php _e('Edit gallery', 'lovey_dovey') ?></a>
			<input type="text" class="widefat" value="<?php echo esc_attr($ids) ?>" name="<?php echo $this->get_field_name('ids') ?>" readonly />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('order_by'); ?>"><?php _e('Order by:', 'lovey_dovey'); ?></label>
			<select class= "widefat" id="<?php echo $this->get_field_id('order_by'); ?>" name="<?php echo $this->get_field_name('order_by'); ?>">
				<option value="menu_order" <?php selected ($order_by, 'menu_order' ); ?> ><?php _e('Menu Order', 'lovey_dovey'); ?></option>
				<option value="rand" <?php selected ($order_by, 'rand' ); ?> ><?php _e('Random', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('color_scheme'); ?>"><?php _e('Color scheme:', 'lovey_dovey'); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id('color_scheme'); ?>" name="<?php echo $this->get_field_name('color_scheme'); ?>">
				<option value="light" <?php selected ($color_scheme, 'light' ); ?> ><?php _e('Black on White', 'lovey_dovey'); ?></option>
				<option value="dark" <?php selected ($color_scheme, 'dark' ); ?> ><?php _e('White on Black', 'lovey_dovey'); ?></option>
				<option value="gray" <?php selected ($color_scheme, 'gray' ); ?> ><?php _e('Black on Light Gray', 'lovey_dovey'); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'gallery_page_url' ); ?>"><?php _e( 'Gallery Page URL:', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'gallery_page_url' ); ?>" name="<?php echo $this->get_field_name( 'gallery_page_url' ); ?>" type="text" value="<?php echo esc_attr( $gallery_page_url ); ?>">
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
		$instance['ids'] = $new_instance['ids'];
		$instance['order_by'] = $new_instance['order_by'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['gallery_page_url'] = $new_instance['gallery_page_url'];
		return $instance;
	}

}
