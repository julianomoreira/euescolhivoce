<?php 
get_header();

$using_site_origin = get_post_meta( get_the_ID(), 'panels_data', true );

if ( have_posts() ) : while( have_posts() ) : the_post(); 

	if ( !empty( $using_site_origin ) ) : ?>

		<section id="content" <?php ( 'site-origin-page content-section' ); ?>>
			<?php the_content(); ?>
		</section>

	<?php else : ?>
		<section id="content" class="content-section">
			<div class="container">
				<div class="main-section" role="main">
					<div class="page-loop">

						<article id="page-<?php the_ID(); ?>" <?php post_class(''); ?>>
							<h2 class="page-title"><?php echo the_title(); ?></h2>

							<?php if ( has_post_thumbnail() ) : ?>
							<div class="page-thumbnail">
								<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 800, 450, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
							</div>
							<?php endif; ?>
							<div class="page-content">
								<?php the_content(); ?>
							</div>
						</article>

						<?php comments_template(); ?>

					</div>
				</div>

				<div class="aside-section">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</section>

	<?php endif; 
endwhile; endif;

get_footer();
?>