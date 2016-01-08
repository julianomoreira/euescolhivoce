<?php

/*
 * Template Name: Guestbook
 * Description: Create the Guestbook page using Ninja Forms
 */

?>

<?php get_header(); 
global $lovey_dovey_data;

if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

<section id="content" class="content-section">
	<div class="container">
		<div class="page-no-sidebar guestbook">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="page-content">
							<?php the_content(); ?>
						</div>
						<div class="guestbook-form">
						<?php if( function_exists( 'ninja_forms_display_form' ) ) {
							$gb_form = ld_option( 'guestbook_form' );
							if ( ! empty( $gb_form ) ) ninja_forms_display_form( $gb_form );
						} ?>
						</div>
						
						<?php 
						$gb_form = ld_option( 'guestbook_form' );
						$gb_name_id = ld_option( 'gb_name_id' );
						$gb_message_id = ld_option( 'gb_message_id' );

						$args = array( 'form_id' => $gb_form );
						$subs = Ninja_Forms()->subs()->get( $args );

						
						if (! empty($subs)) { ?>
							<div class="list-guestbook-entries">
							<?php
								// echo $lovey_dovey_data['DOM']['guestbook'];
							?>
									
								<?php

								foreach ( $subs as $sub ) {
									$all_fields = $sub->get_all_fields(); 
									if (! empty($all_fields) ) { ?>
										<div class="guestbook-entry">
											<p class="guestbook-message"><?php echo $all_fields[$gb_message_id]; ?></p>
											<div class="guestbook-name"><?php echo $all_fields[$gb_name_id]; ?></div>
										</div>
										<div class="separator list-guestbook-separator">
											<b></b>
											<span><i class="fa fa-heart"></i></span>
											<b></b>
										</div>
								<?php
									}
								}

							?>
								
							</div>
						<?php }							
						?>
						
					</article>
				</div>

			</div>	
		</div>
	</div>
</section>

<?php endwhile; endif;

get_footer(); ?>