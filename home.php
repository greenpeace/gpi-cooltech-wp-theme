<?php
/**
 * Template Name: Page Home;
 *
 * Template for displaying case studies
 *
 * @package understrap
 */
 get_header();


$page_layout="cr";

?>



	<main role="main home">
		<!-- section -->
		<!-- <section> -->

		<header class="masthead">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h2 class="text-black font-weight-bold">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</h2>
	        </div>
	        <div class="col-lg-6 align-self-baseline">
	          <p class="text-white-75 font-weight-light mb-5"></p>
					<?php	echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
	    <!--    <input type="text" name="s" class="form-control search-autocomplete" placeholder="Search"> -->
	        </div>
	      </div>
	    </div>
	  </header>

		<div class="div-home">


		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="<?php echo $page_layout; ?>">
				<?php the_content(); ?>
			</div>

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

		<!-- </section> -->
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
