<?php
/*
Template Name: Full image page
*/
?>

<?php get_header(); ?>

<div id="content">
	<div class="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
			<?php the_post_thumbnail('full'); ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>

<?php get_footer(); ?>