<?php get_header(); ?>

	<div id="content">
	<div class="container">
		<div class="sidebar left">
			<ul class="categories">
				<?php wp_list_categories('&title_li='); ?>
			</ul>
		</div>
	<div class="main-content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php previous_post_link('&laquo; %link') ?> | <?php next_post_link('%link &raquo;') ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>

							
		</div>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>
	</div>
</div>

<?php get_footer(); ?>