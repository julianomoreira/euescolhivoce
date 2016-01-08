<?php

/*
 * Template Name: About Couple
 * Description: Page template for Couple description
 */

?>

<?php get_header(); 

if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

<section id="content" class="content-section">
	<div class="container">
		<div class="page-no-sidebar about">
			<div class="row">
				<?php if ( has_post_thumbnail() ) {
					$a = 'col-md-4 col-sm-4';
					$b = 'col-md-8 col-sm-8';
				} else {
					$a = '';
					$b = 'col-md-8 col-md-offset-2';
				} ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="<?php echo $a; ?>">
						<div class="page-thumbnail">
							<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 340, 0, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
						</div>
					</div>
				<?php endif; ?>
				<div class="<?php echo $b; ?>">
					<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					</article>
				</div>

			</div>	
		</div>
	</div>
</section>

<?php endwhile; endif;

get_footer(); ?>