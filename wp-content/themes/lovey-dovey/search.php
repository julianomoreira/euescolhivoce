<?php get_header(); ?>

<section id="content" class="content-section">
	<div class="container">

		<div class="main-section" role="main">
					
			<div class="search-info">
				<div class="row">
					<div class="keyword col-sm-6"><?php printf( __( 'Search results for "%s"', 'lovey_dovey' ), '<strong>' . get_search_query() . '</strong>' ); ?></div>

					<?php
					global $wp_query, $paged, $posts_per_page; //var_dump($wp_query);
					if ($wp_query->post_count > 0) {
						$start = ( ( $paged == 0 ) ? 0 : $paged - 1 ) * $posts_per_page + 1;
						$end = $start + $wp_query->post_count - 1;
					} else {
						$start = 0;
						$end = 0;
					}
					?>
					<div class="count col-sm-6"><?php printf( __( 'Showing results %s - %s of %s results found', 'lovey_dovey' ), $start, $end, $wp_query->found_posts ); ?></div>
				</div>
			</div>

			<div class="search-loop">

				<?php if ( have_posts() ) : while( have_posts() ) : the_post() ; ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-post' ); ?>>

						<h4 class="post-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>

						<div class="post-content"><?php the_excerpt(); ?></div>

						<div class="post-meta"><?php echo get_the_date(); ?></div>

					</article>

				<?php endwhile; else: ?>

					<p><?php _e( 'Sorry, no results found, please try another keyword', 'lovey_dovey' ); ?></p>

				<?php endif; ?>

			</div>

			<?php 
			$prev = get_previous_posts_link('Newer Posts');
			$next = get_next_posts_link('Older Posts');

			if ( ( ! empty ($prev) ) || ( ! empty($next) ) ) { 
			?>
			<nav id="pagination" class="pagination clearfix heading">
				<div class="prev"><?php previous_posts_link('Newer Posts'); ?></div>
				<div class="next"><?php next_posts_link('Older Posts'); ?></div>
			</nav>
			<?php } ?>

		</div>

		<div class="aside-section">
			<?php get_sidebar(); ?>
		</div>


	</div>
</section>

<?php get_footer(); ?>