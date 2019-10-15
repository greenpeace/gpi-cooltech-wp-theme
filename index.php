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

	 <section>
		 <div class="container">

		 <div class="tab-content" id="pills-tabContent">

		 <?php  $tabs=array(126,128,132);
		 $args = array(
  	 	'numberposts' => 3,
  		'post_type'   => 'page'
			);

			$pages = get_posts( $args );
			$x=0;
			?>

			<?php
				foreach($pages as $page) {
			?>
			<div class="tab-pane fade <?php echo '',($x == 0 ? 'show active' : ''); ?>" id="pills-<?php echo $page->ID; ?>" role="tabpanel" aria-labelledby="pills-<?php echo $page->ID ?>-tab">
				<div class="row">
					<div class="col">
				<?php echo get_the_post_thumbnail($page->ID); ?>
					</div>
					<div class="col">
						<h2><?php echo $page->post_title;  ?></h2>
				<?php echo $page->post_content; ?>
				<div>
				<a class="btn btn-rounded btn-outline-dark" href="<?php echo get_permalink($page->ID); ?>"> More information <i class="i-arrow-left"></i></a>
				</div>
					</div>
				</div>
			</div>
			<?php
				$x++;
					}
		 	?>
		 	</div>


		<div class="row">
			<div class="col-md-12">
		 <ul id="cooling-tab" class="nav nav-pills mb-3" id="pills-tab" role="tablist">

			 <?php
			 		$x=0;
				 foreach($pages as $page) {
			 ?>
			 <li class="nav-item nav-fill">
				<a class="btn btn-rounded btn-outline-dark nav-link <?php echo '',($x == 0 ? 'active' : ''); ?>" id="pills-<?php echo $page->ID; ?>-tab" data-toggle="pill" href="#pills-<?php echo $page->ID; ?>" role="tab" aria-controls="<?php echo $page->ID; ?>" aria-selected="true"><?php echo $page->post_title; ?></a>
			</li>
			 <?php
			 		$x++;
				 }
				?>
		 </ul>
	 </div>
	 </div>
	 </div>
	</section>
<!--
		<section>
			<div class="container">
					<div class="odometer"></div>

			</div>
		</section>
-->
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
