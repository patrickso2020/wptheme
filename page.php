<?php
// if ($post->post_name == 'events') {
// 	header('Location: ' . REGISTRATION_URL . '/externalcalendar.php');
// 	exit;
// }
if (($post->post_name == 'team-rosters' && !REGISTRATION_LOGGED_IN) || (($post->post_name == 'team-rosters-summer' && !REGISTRATION_LOGGED_IN))) {
	header('Location: ' . REGISTRATION_URL . '/login.php');
	exit;
}
if (($post->post_name == 'power-roster' && !REGISTRATION_LOGGED_IN)) {
	header('Location: ' . REGISTRATION_URL . '/login.php');
	exit;
}
?>
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
			<?php if (get_post_meta($post->ID, '_show_subpages', true ) == 'true' ) : ?>
				<?php query_posts(array('showposts' => '-1', 'post_type' => 'page', 'post_parent' => $post->ID,)); ?>
				<?php while (have_posts()): the_post(); ?>
					<div class="post">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php $content = $post->post_content; $pos = strpos($content, '<!--more'); ?>
						<?php if ($pos != false) : ?>
							<?php $content = substr($content, 0, $pos);?>
							<?php echo apply_filters('the_content', $content ); ?>
							<a href="<?php echo get_permalink($post->ID); ?>">Read more...</a>
						<?php else : ?>
							<?php echo apply_filters('the_content', $content ); ?>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			<?php endif; ?>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
