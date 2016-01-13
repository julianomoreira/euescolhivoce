<?php
class LD_Widget_Post_Type_Event extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_post_type_event',
			__('Section: Post Type Event (PB)' , 'lovey_dovey'),
			array('description' => __('Post Type Event', 'lovey_dovey'),) //args
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
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';
		$column = isset( $instance['column']) ? absint( $instance['column'] ) : 2;
		echo $args['before_widget'];
		?>
		<div class="section <?php echo $color_scheme; ?>-scheme">
			<div class="container">
				<div class="title"><?php echo $instance['title']; ?></div>
				<div class="row">
					<?php
					$the_query = new WP_Query( array('post_type' => 'event') );
					if ( $the_query->have_posts() ) {
						echo '<div class="grid-loop js-isotope-grid list-event">';
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							?>
							<div id="event-grid-<?php the_ID(); ?>" <?php post_class( 'event-grid-post col-md-' . 12 / $column . ' col-sm-6 ' ); ?>>
								<div class="event-grid-post-wrapper">

									<?php if ( has_post_thumbnail() ) : ?>
									<div class="event-grid-post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 570, null, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
										</a>
									</div>
									<?php endif; ?>

									<h4 class="event-grid-post-title heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

									<div class="event-grid-excerpt"><?php the_excerpt(); ?></div>

									<div class="event-meta">
										<?php
										$event_date = strtotime(ld_event_option('event_date'));
										if (! empty($event_date)) {
											echo '<div class="event-meta-date"><i class="li_calendar"></i>'. date_i18n($instance['dateformat'],$event_date).'</div>';
										}
										$event_time = ld_event_option('event_time');
										if (! empty($event_time)) {
											echo '<div class="event-meta-time"><i class="li_clock"></i>'. $event_time .'</div>';
										}
										$event_venue = ld_event_option('event_venue');
										if (! empty($event_venue)) {
											echo '<div class="event-meta-venue"><i class="li_shop"></i>'. $event_venue .'</div>';
										}
										$event_address = ld_event_option('event_address');
										if (! empty($event_address)) {
											echo '<div class="event-meta-address"><i class="li_location"></i>'. $event_address .'</div>';
										}
										?>
									</div>

									<div class="event-detail-link"><a href="<?php echo get_permalink(); ?>" class="button heading"><?php _e('Ver Mais Detalhes', 'lovey_dovey'); ?></a></div>

								</div>
							</div>

							<?php
						}
						echo '</div>';
					} else {
						// no posts found
					}
					/* Restore original Post Data */
					wp_reset_postdata();
					?>
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
		$title = isset( $instance['title'] ) ? $instance['title'] : __('The Events', 'lovey_dovey');
		$dateformat = isset( $instance['dateformat'] ) ? $instance['dateformat'] : 'l, F jS Y';
		$color_scheme = isset( $instance[ 'color_scheme' ] ) ? $instance[ 'color_scheme' ] : 'light';
		$column = isset( $instance['column']) ? absint( $instance['column'] ) : 2;
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

		<p><label for="<?php echo $this->get_field_id( 'dateformat' ); ?>"><?php _e( 'Date Format:', 'lovey_dovey' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'dateformat' ); ?>" name="<?php echo $this->get_field_name( 'dateformat' ); ?>" type="text" value="<?php echo esc_attr( $dateformat ); ?>"></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'column' ); ?>"><?php _e( 'Number of column per row:', 'lovey_dovey' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="2" <?php selected ($column, '2' ); ?> ><?php _e('2', 'lovey_dovey'); ?></option>
				<option value="3" <?php selected ($column, '3' ); ?> ><?php _e('3', 'lovey_dovey'); ?></option>
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
		$instance['dateformat'] = ( ! empty( $new_instance['dateformat'] ) ) ? $new_instance['dateformat'] : 'l, F jS Y';
		$instance['color_scheme'] = $new_instance['color_scheme'];
		$instance['column'] = $new_instance['column'];
		return $instance;
	}

}
