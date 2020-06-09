<?php get_header(); ?>
<div class="container">
<div class="page-title">
<div class="shell">
<h1><?php the_title();?></h1>
</div>
</div>
<div class="shell">


<div class="main">
	<div <?php post_class() ?>>
		<div class="content post">
			<?php if (have_posts()) : ?>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<h2 class="pagetitle">
					<?php if (is_category()) { ?>
						Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category
					<?php } elseif( is_tag() ) { ?>
						Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;
					<?php } elseif (is_day()) { ?>
						Archive for <?php the_time('F jS, Y'); ?>
					<?php } elseif (is_month()) { ?>
						Archive for <?php the_time('F, Y'); ?>
					<?php } elseif (is_year()) { ?>
						Archive for <?php the_time('Y'); ?>
					<?php } elseif (is_author()) { ?>
						Author Archive
					<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						Blog Archives
					<?php } ?>
				</h2>
				
				<?php while (have_posts()) : the_post(); ?>
					<div <?php post_class() ?>>
						<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>
		
						<div class="entry">
							<?php the_content('Read the rest of this entry &raquo;'); ?>
						</div>
		
						<p class="postmetadata">
							<?php the_tags('Tags: ', ', ', '<br />'); ?> 
							Posted in <?php the_category(', ') ?> | 
							<?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
						</p>
						
					</div>
					
				<?php endwhile; ?>
		
				<div class="navigation">
					<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
					<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
				</div>
				
			<?php else :
				if ( is_category() ) { // If this is a category archive
					printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
				} else if ( is_date() ) { // If this is a date archive
					echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
				} else if ( is_author() ) { // If this is a category archive
					$userdata = get_userdatabylogin(get_query_var('author_name'));
					printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
				} else {
					echo("<h2 class='center'>No posts found.</h2>");
				}
				get_search_form();
				endif;
			?>
		<div class="cl">&nbsp;</div>
		</div>
	</div>
</div>
<?php get_sidebar(); ?></div></div>


<?php get_footer(); ?>