<?php get_header();
$current_term_level = get_tax_level(get_queried_object()->term_id, get_queried_object()->taxonomy);
?>

	<main role="main">

		<!-- section -->

		<header class="masthead">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="text-black font-weight-bold"><?php single_cat_title(); ?></h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">

	        </div>
	      </div>
	    </div>
	  </header>

		<section> <h2><?php echo get_term_meta( get_queried_object()->term_id, 'intro', true ); ?> </h2>
			<br/>
		<?php echo get_queried_object()->description; ?>
		</section>
			<?php
			// echo $current_term_level;
			if ($current_term_level == 0) {
			    echo do_shortcode('[cooltech_cat]');
			} else if ($current_term_level == 1) {
			    echo do_shortcode('[cooltech_cat]');
			} else {
			    // show third drop-down
			}
			 ?>
			<?php
			$term = $wp_query->queried_object;

			if($term->parent) {
				?>
				<section>
						<div class="container">
							<div id="selectblock" class="row">
								<div class="col-sm-12">
								<?php
						//		print_r($term);
								$tags=array_unique(get_tags_in_use($term->term_id,"application"));
							//	print_r($tags); ?>
							 <div class="selectdiv">	<select id="application" class="select-filter" name="application">
									<option value="0"> Applications </option>
									<?php foreach($tags as $tag) { ?>
									<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
									<?php }?>
					 			</select> </div>
								<?php
								// print_r($term);
								$tags=get_tags_in_use($term->term_id,"country");

								//print_r($tags); ?>
								<div class="selectdiv"><select id="country" class="select-filter" name="country">
									<option value="0"> Country </option>
									<?php foreach($tags as $tag) { ?>
									<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
									<?php }?>
								</select></div>
								<?php
								// print_r($term);
								$tags=get_tags_in_use($term->term_id,"refrigerant");
						; ?>
						<div class="selectdiv">
								<select id="refrigerant" class="select-filter" name="refrigerant">
									<option value="0"> Refrigerant </option>
									<?php foreach($tags as $tag) { ?>
									<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
									<?php }?>
								</select>
							</div>
								<?php
								// print_r($term);
								$tags=get_tags_in_use($term->term_id,"manufacturer");
								//print_r($tags); ?>
								<div class="selectdiv">
								<select id="manufacturer" class="select-filter" name="manufacturer">
									<option value="0"> Manufacturer </option>
									<?php foreach($tags as $tag) { ?>
									<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
									<?php }?>
								</select>
							</div>
								<?php
								// print_r($term);
								$tags=get_tags_in_use($term->term_id,"technology-type");
						; ?>
<div class="selectdiv">
								<select id="technology-type" class="select-filter" name="technology-type">
									<option value="0"> Technology Type </option>
									<?php foreach($tags as $tag) { ?>
									<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
									<?php }?>
								</select>
</div>
<div class="selectdiv">
								<select class="select-filter" id="type">
									<option value="0"> Type </option>
									<option value="equipment"> Equipment </option>
									<option value="case-study"> Case Study </option>
								</select>
</div>
								</div>
							</div>


						<div class="row">

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<?php
					$terms=get_the_terms($post,array("application","country","refrigerant","manufacturer","technology-type"));


					?>

					<!-- article -->
					<div class="col-sm-6 col-md-4 d-flex pb-3">
					<div class="card card-block element w-100 <?php showClassTags($terms);?><?php echo $post->post_type; ?>">
					<article class="element" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php
						$se=wp_get_post_terms( $post->ID, "type", $args );
						$ap=wp_get_post_terms( $post->ID, "application", $args );
						$tt=wp_get_post_terms( $post->ID, "technology-type", $args );
						$ma=wp_get_post_terms( $post->ID, "manufacturer", $args );
						$re=wp_get_post_terms( $post->ID, "refrigerant", $args );
						 ?>



						<h2><?php the_title(); ?></h2>

						<div class="d-table w-100">
							<div class="d-table-cell w-50">
								<div>Sector</div>
								<?php foreach ($se as $s ) { ?>
								<b><?php echo $s->name ?></b><br/>
							<?php	} ?>
								<div>Application</div>		<?php foreach ($ap as $a ) { ?>
										<b><?php	echo $a->name ?></b><br/>
									<?php	}?>
								<div>Technology Type </div>
								<?php foreach ($tt as $t ) { ?>
								<b><?php echo $t->name ?></b><br/>
							<?php	} ?>
							 </div>
							<div class="d-table-cell w-50">
								<div>Refrigerant</div>
								<?php foreach ($re as $r ) { ?>
								<b><?php echo $r->name ?></b><br/>
							<?php	} ?>
								<div>Energy Efficency</div>
								<div>Manufacturer</div>
								<?php foreach ($ma as $m ) { ?>
								<b><?php echo $m->name ?></b><br/>
							<?php	} ?>
							</div>
						</div>

						<?php  // the_content(); ?>

						<br class="clear">
						<div class="d-table-cell w-100"><button class="expand_text btn btn-rounded btn-outline-dark"> More Information </a> </button>
						<div class="equipment_full_text"><?php the_content(); ?> </div>

						 </div>



						<?php edit_post_link(); ?>

					</article>
				</div>
			</div>

					<!-- /article -->

				<?php endwhile; ?>
				<?php endif; ?>
				<?php
			}
			?>

			</div>
		</section>

			<?php // get_template_part('loop'); ?>

			<?php // get_template_part('pagination'); ?>


		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
