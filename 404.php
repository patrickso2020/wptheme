<?php get_header(); ?>

<?php get_sidebar(); ?>

<div class="main">
	<div <?php post_class() ?>>
		<div class="content post">
			<h2 class="center">Error 404 - Not Found</h2>
			<p>Please check the URL for proper spelling and capitalization. If you're having trouble locating a destination, try visiting the <a href="<?php echo get_option('home') ?>">home page</a></p>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<div class="cl">&nbsp;</div>

<?php get_footer(); ?>