<?php get_header(); ?>
<section id="content" class="content-section">
	<div class="container">

		<div class="main-section" role="main">
			<?php get_template_part( 'content' ); ?>			
			<?php comments_template(); ?>
		</div>

		<div class="aside-section">
			<?php get_sidebar(); ?>
		</div>
		
	</div>
</section>
<?php get_footer(); ?>
