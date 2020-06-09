<?php get_header(); ?>

<?php get_sidebar(); ?>

<div class="main">
	<?php the_post(); ?>
	<div <?php post_class() ?>>
		<div class="content post">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php endif; ?>
			<?php the_content(); ?>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<div class="cl">&nbsp;</div>

<?php get_footer(); ?>