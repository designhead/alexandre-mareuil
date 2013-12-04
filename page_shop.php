<?php
/*
Template Name: Shop
*/
?>

<?php get_header(); ?>

<div id="content">
	<div class="container">
		<div class="sidebar left">
			<ul class="categories">
				<?php wp_list_categories(array('taxonomy' => 'product_cat', 'title_li' => '','style' => 'list','current_category' => 0, 'hide_empty' => false)); ?>
			</ul>
		</div>
		<div class="shop">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post" id="post-<?php the_ID(); ?>">
				<h1><?php the_title(); ?></h1>
				<?php the_content('<p>Read the rest of this page &raquo;</p>'); ?>
				<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				</div>
			<?php endwhile; endif; ?>
			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		</div>
		<div class="sidebar right">
			<?php
				$defaults = array(
					'theme_location'  => '',
					'menu'            => 'shop-fr',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'shop',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
					);
			    wp_nav_menu( $defaults );
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
