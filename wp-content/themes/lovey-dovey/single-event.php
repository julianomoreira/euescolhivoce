<?php get_header(); ?>
	<section id="content" class="content-section">
		<div class="container">
			<div class="page-no-sidebar event-single">
				<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php $event_map = ld_event_option('event_map'); ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="event-thumbnail">
							<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 1140, 712, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
						</div>
					<?php endif; ?>

					<div class="event-detail">
						<div class="event-content">
							<?php the_content(); ?>
						</div>
						<div class="event-meta">
							<div class="event-meta-title"><?php _e('Event Details', 'lovey_dovey'); ?></div>
							<ul>
							<?php
							$event_date = strtotime(ld_event_option('event_date'));
							if (! empty($event_date)) {
								echo '<li class="event-meta-date"><i class="li_calendar"></i>'. date_i18n(get_option('date_format'),$event_date).'</li>';
							} 
							$event_time = ld_event_option('event_time');
							if (! empty($event_time)) {
								echo '<li class="event-meta-time"><i class="li_clock"></i>'. $event_time .'</li>';
							}
							$event_venue = ld_event_option('event_venue');
							if (! empty($event_venue)) {
								echo '<li class="event-meta-venue"><i class="li_shop"></i>'. $event_venue .'</li>';
							}
							$event_address = ld_event_option('event_address');
							if (! empty($event_address)) {
								$link = '';
								if (! empty($event_map)) { 
									// $link = ' <a href="#event-map" class="open-map btn btn-default btn-xs"><i class="li_world"></i>'. __('Show Map', 'lovey_dovey'). '</a>';
									$link = ' <a href="#event-map" class="open-map">('. __('Show in Map', 'lovey_dovey'). ')</a>';
								}
								echo '<li class="event-meta-address"><i class="li_location"></i>'. $event_address . $link . '</li>';					
							}
							?>
							</ul>
						</div>

					</div>

					<?php if (! empty($event_map)) { 
						
						$latlng = explode( ',' , $event_map, 2 );
						$latlng = array_map( 'trim', $latlng ); 

						$gmap_zoom = 17; ?>
						
						<div class="event-map mfp-hide" id="event-map">
							<div class="js-gmap gmap" data-zoom="<?php echo $gmap_zoom; ?>" data-lat="<?php echo $latlng[0]; ?>" data-lng="<?php echo $latlng[1]; ?>" data-scroll="true"></div>
						</div>
						
					<?php }	?>
					
				</article>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>