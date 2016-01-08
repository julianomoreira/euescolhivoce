<?php
class LD_Widget_Recent_Posts extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_recent_posts', 
			__('Section: Recent Posts (PB)' , 'lovey_dovey'),
			array('description' => __('Display Recent Blog Posts', 'lovey_dovey'),) //args
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

		$title = isset( $instance['title'] ) ? $instance['title'] : __('Recent Blog Posts', 'lovey_dovey');
		$number = isset( $instance['number']) ? absint( $instance['number'] ) : 3;
		$column = isset( $instance['column']) ? absint( $instance['column'] ) : 3;
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';

		global $wp_query; $temp = $wp_query;
		$wp_query = new WP_Query( array(
			'post_type'           => 'post',
			'posts_per_page'      => $number,
			'ignore_sticky_posts' => 1,
		) );

		echo $args['before_widget'];
		
		?>
		<div class="section <?php echo $color_scheme; ?>-scheme">
			<div class="container"> 
				<div class="title"><?php echo $title; ?></div>
				<div class="grid-loop js-isotope-grid"> 
					<?php while( have_posts() ) : the_post(); ?>
						<div id="blog-grid-<?php the_ID(); ?>" <?php post_class( 'blog-grid-post col-md-' . 12 / $column . ' col-sm-6 ' ); ?>>
							<div class="blog-grid-post-wrapper">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="blog-grid-post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 570, null, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
									</a>
								</div>
							<?php endif; ?>

							<h4 class="blog-grid-post-title heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							
							<div class="blog-grid-post-content"><?php the_excerpt(); ?></div>

							<small class="blog-grid-post-date-and-author"><?php echo get_the_date(); echo ' by '; echo the_author_posts_link(); ?></small>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		
		<?php
		echo $args['after_widget'];

		$wp_query = $temp; wp_reset_postdata();
	}

	/**
	 * Ouputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title = isset( $instance['title'] ) ? $instance['title'] : __('Recent Blog Posts', 'lovey_dovey');
		$number = isset( $instance['number']) ? absint( $instance['number'] ) : 3;
		$column = isset( $instance['column']) ? absint( $instance['column'] ) : 3;
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'lovey_dovey' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'lovey_dovey' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php _e( 'Number of column per row:', 'lovey_dovey' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="2" <?php selected ($column, '2' ); ?> ><?php _e('2', 'lovey_dovey'); ?></option>
				<option value="3" <?php selected ($column, '3' ); ?> ><?php _e('3', 'lovey_dovey'); ?></option>
				<option value="4" <?php selected ($column, '4' ); ?> ><?php _e('4', 'lovey_dovey'); ?></option>
			</select>
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
		$instance['number'] = $new_instance['number'];
		$instance['column'] = $new_instance['column'];
		$instance['color_scheme'] = $new_instance['color_scheme'];
		return $instance;
	}

}
