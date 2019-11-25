<?php
/**
 * Template Name: Simple Page
 *
 *
 * @package understrap
 */
get_header();

$image_id=get_post_thumbnail_id( $post->ID );
$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );

$classes=array("generic-page");

?>

	<main role="main">
		<!-- section -->
		<!-- <section> -->




		<section style="background-color:#D2E9F1;">
		<div class="container bg-white">
			<div class="row">
				<div class="col-sm-12">
			<h1 class="font-weight-bold"><?php the_title(); ?></h1>
			</div>
			</div>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

				<?php the_content(); ?>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'cooltech' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>

	</div>
</section>
		<!-- </section> -->
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
