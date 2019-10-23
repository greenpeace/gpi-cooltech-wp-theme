<?php
/**
 * Template Name: Page with Right Sidebar
 *
 * Template for displaying case studies
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

		<header class="masthead"  style="background-image:url('<?php echo $post_thumbnail_img[0]; ?>')">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="text-black font-weight-bold"><?php the_title(); ?></h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">

	        </div>
	      </div>
	    </div>
	  </header>

		<section>
		<div class="container">

			<div class="row">
			<div class="col-sm-8">
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
	<div class="col-sm-4"> <?php  get_sidebar(); ?> </div>

	</div>
</section>
		<!-- </section> -->
		<!-- /section -->
	</main>



<?php get_footer(); ?>
