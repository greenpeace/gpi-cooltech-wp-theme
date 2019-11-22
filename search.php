<?php get_header(); ?>

<section class="basic-background">
	<main role="main">
		<!-- section -->
		<div class="container">
				<div class="row">
					<div class="col-sm-12">
					<h1><?php echo sprintf(__('%s Search Results for ', 'cooltech'), $wp_query->found_posts); echo get_search_query(); ?></h1>
								<?php get_template_part('loop-search'); ?>

							<?php get_template_part('pagination'); ?>
					</div>
			</div>
		</div>

	</main>
</section>
<?php // get_sidebar();?>

<?php get_footer(); ?>
