<?php get_header();
$current_term_level = get_tax_level(get_queried_object()->term_id, get_queried_object()->taxonomy);
$slug=get_queried_object()->slug;
?>

<main role="main">

		<!-- section -->
<?php if ($current_term_level < 2) {
	$image_id = get_term_meta( get_queried_object()->term_id, 'image', true );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
	?>
	<header class="masthead" style="background-image:url('<?php echo $post_thumbnail_img[0]; ?>')">
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
				<div class="col-lg-10 align-self-end">
					<h1 class="text-white font-weight-bold"><?php single_cat_title(); ?>

					</h1>
				</div>
				<div class="col-lg-8 align-self-baseline">
					<?php
					//echo $current_term_level;
					if ($current_term_level == 2) {
					echo "<h3>".get_queried_object()->description."</h3>";
					} ?>

				</div>
			</div>
		</div>
	</header>
<?php
} else { ?>
		<header class="masthead second-taxonomy">
	    <div class="container">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="text-black font-weight-bold"><?php single_cat_title(); ?>
						<?php  $id=get_queried_object()->parent;
						$parent=	get_term($id,"type");
						echo $parent->name;

							 ?>
						</h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">
						<?php

						echo "<h3>".get_queried_object()->description."</h3>";
						?>

	        </div>
	      </div>

				<?php $term = $wp_query->queried_object; ?>
				<div id="selectblock" class="row">
					<div class="col-sm-12">
					<?php
			//		print_r($term);
		// 	$tags=array_unique(get_tags_in_use($term->term_id,"application"));
					$tags=get_tags_in_use($term->term_id,"application");
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


	    </div>
	  </header>
<?php } ?>
<?php
	// echo $current_term_level;
	if ($current_term_level <2) {
 ?>
	<section class="sector-first <?php echo $slug;  ?>">
		<div class="container">
			<div class="row">
				<div class="col-sm-10 offset-sm-1">
						<div class="text-intro">	<?php echo do_shortcode(get_queried_object()->description); ?> </div>
						<?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
							// echo jqFootnotes(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
						?>
				</div>
			</div>
		</div>
	</section>
		<?php
			echo do_shortcode('[cooltech_cat]');
			} else {
			    // show third drop-down
			}
			 ?>
			<?php
			$term = $wp_query->queried_object;

			if($term->parent) {
				?>

				<section class="results">

				<?php
				$x=0;
				if (have_posts()): while (have_posts()) : the_post(); ?>
					<?php
					$terms=get_the_terms($post,array("application","country","refrigerant","manufacturer","technology-type"));

					?>

					<!-- article -->
					<article class="element <?php showClassTags($terms);?><?php echo $post->post_type; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!--	<div class="col-sm-6 col-md-4 d-flex pb-3"> -->
					<div class="row">
				<!--		<div class="col-md-3">

					</div> -->


						<?php
						$se=wp_get_post_terms( $post->ID, "type", $args );
						// print_r($se);
						$ap=wp_get_post_terms( $post->ID, "application", $args );
						$tt=wp_get_post_terms( $post->ID, "technology-type", $args );
						$ma=wp_get_post_terms( $post->ID, "manufacturer", $args );
						$re=wp_get_post_terms( $post->ID, "refrigerant", $args );

						$ee=get_post_meta($post->ID,"energy-efficency",true);
						?>

						<div class="col-md-3">

						<h2 class="result_title"><?php the_title(); ?></h2>
						<?php  if($post->post_type=="equipment") { ?>
						<button class="expand_text btn btn-rounded btn-outline-dark"> More Information </button>
					<?php  } else { ?>
						<a class="btn btn-rounded btn-outline-dark" href="<?php the_permalink(); ?>"> More Information </a>
					<?php } ?>
					</div>
						<div class="col-md-3">
								<div class="result_meta_title"><?php _e( 'Sector', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($se as $s ) { ?>
								<?php echo $s->name ?><br/>
							<?php	} ?></div>
								<div class="result_meta_title">Application</div>
								<div class="result_meta_content">
								<?php foreach ($ap as $a ) { ?>
										<?php	echo $a->name ?><br/>
									<?php	}?>
								</div>
								<div class="result_meta_title">Technology Type </div>
								<div class="result_meta_content">
								<?php foreach ($tt as $t ) { ?>
									<?php echo $t->name ?><br/>
							<?php	} ?>
							</div>
							 </div>
						<div class="col-md-3">
								<div class="result_meta_title">Refrigerant</div>
								<div class="result_meta_content">
								<?php foreach ($re as $r ) { ?>
								<?php echo $r->name ?><br/>
							<?php	} ?></div>

								<div class="result_meta_title">Manufacturer</div>
								<div class="result_meta_content">
								<?php foreach ($ma as $m ) { ?>
								<?php echo $m->name ?> <?php if(next($ma)) { echo "/"; } ?>
							<?php	} ?>
								</div>
							</div>
							<div class="col-sm-3">
									<div class="result_meta_title">Energy Efficency</div>
									<div class="result_meta_content"><?php echo $ee; ?></div>
							</div>
						</div>

						<?php  // the_content(); ?>
						<div class="equipment_full_text">
							<div class="row">
							<div class="col-sm-3">
								<?php if(get_the_post_thumbnail_url( $post, $size = 'full' )) {
									?>
									<img class="img-fluid" src="<?php echo get_the_post_thumbnail_url( $post, $size = 'full' ); ?>">
									<?php
								}; ?>
							</div>
							<div class="col-sm-9">
								<?php the_content(); ?>
							</div>
						</div>
						</div>
					</article>

				<?php
				$x++;
			endwhile; ?>
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
