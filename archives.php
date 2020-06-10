<?php
/*
Template Name: Archives
*/
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
	<div <?php post_class() ?>>
		<div class="content post">
			<?php get_search_form(); ?>
			<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
			
			<h2>Archives by Subject:</h2>
			<ul>
				 <?php wp_list_categories(); ?>
			</ul>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<?php get_sidebar(); ?>
</div>
</div>

<?php get_footer(); ?>