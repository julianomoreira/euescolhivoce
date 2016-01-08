<div class="blog-loop">
<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-container'); ?>>

		<?php if ( is_single() ) : ?>
			<h2 class="post-title"><?php echo the_title(); ?></h2>
		<?php else : ?>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
		<?php endif; ?>

		<div class="post-meta-mobile">
			<span class="post-meta-date"><?php echo get_the_date(); ?></span>
			<span class="post-meta-author"><?php echo the_author_posts_link(); ?></span>
			<span class="post-meta-comment-count"><a href="<?php comments_link(); ?>"><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a></span>
		</div>

		<div class="post-meta">
			<div class="post-meta-date">
				<div class="post-meta-date-part-day"><?php echo get_the_date('d'); ?></div>
				<div class="post-meta-date-part-month-year">
					<div class="post-meta-date-part-month"><?php echo get_the_date('M'); ?></div>
					<div class="post-meta-date-part-year"><?php echo get_the_date('Y'); ?></div>
				</div>
			</div>

			<?php if ( is_sticky() ) : ?>
				<div class="sticky-ribbon">
					<div class="sticky-text"><label><?php echo __('Featured','lovey_dovey'); ?></label></div>
				</div>
			<?php endif; ?>

			<div class="post-meta-author"><?php echo __('by ','lovey_dovey'); echo the_author_posts_link(); ?></div>

			<div class="post-meta-comment-count"><a href="<?php comments_link(); ?>"><?php comments_number( 'no comments', '1 comment', '% comments' ); ?></a></div>
		</div>


		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<img src="<?php echo ld_aq_resize( get_post_thumbnail_id(), 640, 360, true, true ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" />
			</div>
		<?php endif; ?>
		
		<div class="post-content">
			<?php the_content('read more...'); ?>
		</div>			
		
		<?php wp_link_pages(array(
			'before'           =>'<nav class="pagination heading clearfix link-page">', 
			'after'            =>'</nav>',
			'next_or_number'   =>'next', 
			'previouspagelink' => '&laquo; '.__('previous', 'lovey_dovey'), 
			'nextpagelink'     =>__('next', 'lovey_dovey').' &raquo;', 
		)); ?>
		<?php if ( is_single() ) : ?>
		<div class="tagcloud clearfix">
			<?php the_tags('',' ',''); ?>
		</div>
		<?php endif; ?>
	</article>
<?php	endwhile; else : 	
	echo wpautop( 'Sorry, no posts were found' );
endif; ?>
</div>