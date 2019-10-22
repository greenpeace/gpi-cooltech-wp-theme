<?php get_header(); ?>

	<main role="main">

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

		<?php
		echo do_shortcode('[cooltech_cat]');
		?>


		<!-- section -->
		<section>
			<div class="container">

			<h1><?php _e( 'Latest Posts', 'cooltech' ); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
			</div>
		</section>
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
