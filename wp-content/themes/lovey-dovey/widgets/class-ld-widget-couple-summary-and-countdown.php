<?php
class LD_Widget_Couple_Summary_And_Countdown extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	public function __construct () {
		parent::__construct (
			'ld_widget_section_couple_summary_and_countdown', 
			__('Section: Couple Summary and Countdown (PB)' , 'lovey_dovey'),
			array('description' => __('Couple Summary and Countdown', 'lovey_dovey'),) //args
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
		$ids = explode(',', $instance['slideshow']);

		$urls = array();
		foreach ($ids as $id) {
			$urls[] = wp_get_attachment_url($id);
		}

		$urls_text = implode("\n", $urls);

		?>
		<div class="section light-scheme">
			<div class="backstretch-slider js-backstretch" style="min-height:<?php echo (int) $instance['height'].'px'; ?>" data-images="<?php echo esc_attr($urls_text); ?>"></div>
			<div class="container">
				<div class="hero-section">
					<div class="row">
						<div class="col-md-4 col-md-offset-1">
							<div class="party party-a">
								<div class="photo-profile round-image">
									<img src="<?php echo ld_option('party_a_photo'); ?>" class="round-image" alt="Photo Profile A" >
								</div>
								<div class="separator party-icon">
									<b></b>
									<span><i class="couple-icon icon-<?php echo ld_option('party_a_gender'); ?>"></i></span>
									<b></b>
								</div>
								<h3 class="party-name color-accent heading">
									<?php echo ld_option('party_a_fullname'); ?>
								</h3>
								<div class="party-about">
									<?php echo ld_option('party_a_about'); ?>
								</div>
								<div class="party-social">
									<?php if (ld_option('party_a_facebook')) : ?><a href="<?php echo ld_option('party_a_facebook'); ?>"><i class="socmed socmed-facebook"></i></a><?php endif; ?>
									<?php if (ld_option('party_a_twitter')) : ?><a href="<?php echo ld_option('party_a_twitter'); ?>"><i class="socmed socmed-twitter"></i></a><?php endif; ?>
									<?php if (ld_option('party_a_googleplus')) : ?><a href="<?php echo ld_option('party_a_googleplus'); ?>"><i class="socmed socmed-googleplus"></i></a><?php endif; ?>
									<?php if (ld_option('party_a_instagram')) : ?><a href="<?php echo ld_option('party_a_instagram'); ?>"><i class="socmed socmed-instagram"></i></a><?php endif; ?>
									<?php if (ld_option('party_a_email')) : ?><a href="mailto:<?php echo ld_option('party_a_email'); ?>"><i class="socmed socmed-email"></i></a><?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="couple-separator">
								<img src="<?php echo LD_IMAGES . 'separator.png'; ?>" alt="Separator">
							</div>
						</div>
						<div class="col-md-4">
							<div class="party party-b">
								<div class="photo-profile round-image">
									<img src="<?php echo ld_option('party_b_photo'); ?>" class="round-image" alt="Photo Profile B">
								</div>
								<div class="separator party-icon">
									<b></b>
									<span><i class="couple-icon icon-<?php echo ld_option('party_b_gender'); ?>"></i></span>
									<b></b>
								</div>
								<h3 class="party-name color-accent heading">
									<?php echo ld_option('party_b_fullname'); ?>
								</h3>
								<div class="party-about">
									<?php echo ld_option('party_b_about'); ?>
								</div>
								<div class="party-social">
									<?php if (ld_option('party_b_facebook')) : ?><a href="<?php echo ld_option('party_b_facebook'); ?>"><i class="socmed socmed-facebook"></i></a><?php endif; ?>
									<?php if (ld_option('party_b_twitter')) : ?><a href="<?php echo ld_option('party_b_twitter'); ?>"><i class="socmed socmed-twitter"></i></a><?php endif; ?>
									<?php if (ld_option('party_b_googleplus')) : ?><a href="<?php echo ld_option('party_b_googleplus'); ?>"><i class="socmed socmed-googleplus"></i></a><?php endif; ?>
									<?php if (ld_option('party_b_instagram')) : ?><a href="<?php echo ld_option('party_b_instagram'); ?>"><i class="socmed socmed-instagram"></i></a><?php endif; ?>
									<?php if (ld_option('party_b_email')) : ?><a href="mailto:<?php echo ld_option('party_b_email'); ?>"><i class="socmed socmed-email"></i></a><?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>	

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div class="text-and-date">
							<div class="married-text heading">
							<?php 
								$timestamp = strtotime(ld_option('wedding_date'));
								$seconds = $timestamp - current_time('timestamp') ;
								if ($timestamp > current_time('timestamp')) {
									echo $instance[ 'before_married_text' ]; 	
								} else {
									echo $instance[ 'after_married_text' ]; 	
								}
							?>
							</div>	
							<div class="separator date-separator">
								<b></b>
								<span><?php	echo date_i18n($instance['dateformat'], $timestamp); ?></span>
								<b></b>
							</div>
							<div class="js-countdown countdown" data-diff="<?php echo $seconds; ?>"></div>
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
		if ( isset( $instance[ 'slideshow' ] ) ) {
			$slideshow = $instance[ 'slideshow' ];
		}
		else {
			$slideshow = '';
		}

		if ( isset( $instance[ 'before_married_text' ] ) ) {
			$before_married_text = $instance[ 'before_married_text' ];
		}
		else {
			$before_married_text = 'are <span>getting married</span>';
		}

		if ( isset( $instance[ 'after_married_text' ] ) ) {
			$after_married_text = $instance[ 'after_married_text' ];
		}
		else {
			$after_married_text = 'have been <span>married</span> since';
		}

		if ( isset( $instance[ 'height' ] ) ) {
			$height = $instance[ 'height' ];
		} else {
			$height = 400;
		}

		if ( isset ( $instance[ 'dateformat' ] ) ) {
			$dateformat = $instance['dateformat'];
		} else {
			$dateformat = 'l, F jS Y';
		}
	?>
		<p><label for="<?php echo $this->get_field_id( 'slideshow' ); ?>"><?php _e( 'Slideshow image(s) link:', 'lovey_dovey' ); ?></label>
		<a href="#" onclick="return false;" class="ld-couple-summary-widget-select-slideshow-images"><?php _e('Edit Slideshow', 'lovey_dovey') ?></a>
		<input type="text" class="widefat" value="<?php echo esc_attr($slideshow) ?>" name="<?php echo $this->get_field_name('slideshow') ?>" readonly />
		
		<p><label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Slideshow image(s) min-height:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'before_married_text' ); ?>"><?php _e( 'Before Married Text:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'before_married_text' ); ?>" name="<?php echo $this->get_field_name( 'before_married_text' ); ?>" type="text" value="<?php echo esc_attr( $before_married_text ); ?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'after_married_text' ); ?>"><?php _e( 'After Married Text:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'after_married_text' ); ?>" name="<?php echo $this->get_field_name( 'after_married_text' ); ?>" type="text" value="<?php echo esc_attr( $after_married_text ); ?>"></p>

		<p><label for="<?php echo $this->get_field_id( 'dateformat' ); ?>"><?php _e( 'Date Format:', 'lovey_dovey' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'dateformat' ); ?>" name="<?php echo $this->get_field_name( 'dateformat' ); ?>" type="text" value="<?php echo esc_attr( $dateformat ); ?>"></p>
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
		$instance['slideshow'] = ( ! empty( $new_instance['slideshow'] ) ) ? $new_instance['slideshow'] : '';
		$instance['before_married_text'] = ( ! empty( $new_instance['before_married_text'] ) ) ? $new_instance['before_married_text'] : '';
		$instance['after_married_text'] = ( ! empty( $new_instance['after_married_text'] ) ) ? $new_instance['after_married_text'] : '';
		$instance['dateformat'] = ( ! empty( $new_instance['dateformat'] ) ) ? addslashes($new_instance['dateformat']) : 'l, F jS Y';

		if ((int) $new_instance['height'] == 0) {
			$instance['height'] = 400;
		} else {
			if ((int) $instance['height'] < 400) {
				$instance['height'] = 400;
			} else {
				$instance['height'] = (int) $new_instance['height'];
			}
		}
		return $instance;
	}

}