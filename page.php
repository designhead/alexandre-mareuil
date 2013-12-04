<?php get_header(); ?>

<div id="content">
	<div class="container">
		<div class="main-content">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
				<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
