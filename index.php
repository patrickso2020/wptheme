<?php get_header(); ?>
<div class="container">

	<?php query_posts('post_type=slides&showposts=-1'); ?>
	<?php if (have_posts()) : ?>
		<div class="slider" id="mycarousel">
			<div class="slider-holder">
				<ul class="carousel"
  data-flickity='{ "cellSelector": ".carousel-cell" }'>
					<?php while (have_posts()) : the_post(); ?>
						<li class="carousel-cell">
							<div class="img"><img src="<?php echo ecf_get_image_url(get_post_meta($post->ID, '_slide_image', true)) ?>" alt="" /></div>
                            

							<div class="slide-cnt">
                            <div class="shell">
                            							<h3><?php the_title(); ?></h3>
								<?php the_content(''); ?>
							</div>
                            </div>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
	<div class="shell">
<div class="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div <?php post_class() ?>>
				<div class="content post">
                <?php the_date();?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php $image = get_post_meta($post->ID, '_post_image', true); ?>
					<?php if ($image) : ?>
						<div class="img"><a href="<?php the_permalink(); ?>"><img alt="" src="<?php echo ecf_get_image_url($image); ?>" /></a></div>
					<?php endif; ?>
					<?php the_excerpt(''); ?>
					<p><a href="<?php the_permalink(); ?>" class="red-butt">Read More</a></p>
				</div>
			</div>
		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>



</div>	
</div>
<?php get_footer(); ?>