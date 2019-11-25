<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section class="basic-background">
			<div class="container">
					<div class="row">
						<div class="col-sm-12">
								<!-- article -->
								<article id="post-404">
									<h1><?php _e( 'Page not found', 'cooltech' ); ?></h1>
									<h2>
										<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'cooltech' ); ?></a>
									</h2>
								</article>
								<!-- /article -->
						</div>
					</div>
				</div>
		</section>
		<!-- /section -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
