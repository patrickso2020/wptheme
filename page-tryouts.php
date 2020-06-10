<?php get_header(); ?>
<div class="wp-container">
<div class="page-title">
<div class="shell">
<h1><?php the_title();?></h1>
</div>
</div>
<div class="shell">


<div class="main">
	<?php the_post(); ?>
	<div <?php post_class() ?>>
		<div class="content post">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="top-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></div>
			<?php endif; ?>
			<?php the_content(); ?>
		<?php $id = $post->ID; ?>
		<?php query_posts('showposts=-1&post_type=tryouts&orderby=menu_order&order=ASC'); ?>
		<?php while (have_posts()): the_post(); ?>
			<div class="section">
				<?php $url = get_post_meta($post->ID, '_register_url', true); ?>
				<h3><?php the_title(); ?><?php echo ($register != '') ? '<a href="' . $url . '" target="_blank">Register Online</a>' : '' ; ?></h3>
				<?php $div = get_post_meta($post->ID, '_division', false);?>
				<?php if ($div) : ?>
					<?php foreach ($div as $d) : ?>
						<p><?php echo $d; ?></p>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
				<?php the_content(); ?>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
</div></div>


<?php get_footer(); ?>