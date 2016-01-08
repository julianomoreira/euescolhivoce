<?php 
get_header(); ?>
	<section id="content" class="content-section">
		<div class="container">
			<div class="main-section" role="main">

				<?php get_template_part( 'content' ); ?>

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
<?php
get_footer(); ?>