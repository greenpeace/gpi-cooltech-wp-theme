<?php get_header(); ?>

	<main role="main">
	<!-- section -->
		<section>
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<?php if (have_posts()): while (have_posts()) : the_post(); ?>
							<!-- article -->
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<!-- post thumbnail -->
									<?php if (has_post_thumbnail()) : // Check if Thumbnail exists?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php the_post_thumbnail(); // Fullsize image for the single post?>
										</a>
									<?php endif; ?>
									<!-- /post thumbnail -->
									<!-- post title -->
									<h1>
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
									</h1>
									<!-- /post title -->
									<?php the_content(); ?>

									<?php edit_post_link(); // Always handy to have Edit Post Links available?>
								</article>

								<!-- /article -->
						<?php endwhile; ?>
						<?php else: ?>
							<!-- article -->
							<article>
								<h1><?php _e('Sorry, nothing to display.', 'cooltech'); ?></h1>
							</article>
							<!-- /article -->
						<?php endif; ?>
					</div>
					<div class="col-sm-4">
						<?php  get_sidebar(); ?>
						<?php the_tags(__('Tags: ', 'cooltech'), ', ', '<br>'); ?>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>
