<?php get_header();
$current_term_level = get_tax_level(get_queried_object()->term_id, get_queried_object()->taxonomy);
$slug=get_queried_object()->slug;

if($current_term_level==1) {
	$font="industrial";
} else {
	$font="font-weight-bold";
}
?>

<main role="main">

		<!-- section -->
<?php if ($current_term_level < 2) {
	$image_id = get_term_meta( get_queried_object()->term_id, 'image', true );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
	?>
	<header class="masthead" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(<?php echo $post_thumbnail_img[0]; ?>)">
		<div class="container h-100">
			<div class="row h-100 align-items-center justify-content-center text-center">
				<div class="col-lg-10 align-self-center">
					<h1 class="text-white <?php echo $font; ?>"><?php single_cat_title(); ?>

					</h1>
				</div>
			<!--	<div class="col-lg-8 align-self-baseline">


			</div> -->
			</div>
		</div>
	</header>
<?php
} else {
	$id=get_queried_object()->parent;
	$parent=	get_term($id,"type");
	?>
		<header class="masthead second-taxonomy">
	    <div class="container">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="last-sector text-black font-weight-bold <?php echo $parent->slug; ?>"><?php single_cat_title(); ?> <?php echo $parent->name ?>
						<?php  $id=get_queried_object()->parent;
						$parent=	get_term($id,"type"); ?>
						</h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">
						<div><h3 class="<?php echo $parent->slug; ?>"><?php echo get_queried_object()->description; ?></h3></div>
						<div class="text-full-second"><?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
						?> </div>

				  </div>
	      </div>
				<?php $term = $wp_query->queried_object; ?>
				<div id="selectblock" class="row d-print-none">
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
						<option value="0"><?php _e("Country","cooltech"); ?> </option>
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
						<option value="0"><?php _e("Refrigerant","cooltech"); ?>  </option>
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
						<option value="0"> <?php _e("Manufacturer","cooltech"); ?> </option>
						<?php foreach($tags as $tag) { ?>
						<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
						<?php }?>
					</select>
				</div>
					<?php
					// print_r($term);
					$tags=get_tags_in_use($term->term_id,"technology-type");
			 ?>
<div class="selectdiv">
					<select id="technology-type" class="select-filter" name="technology-type">
						<option value="0"> <?php _e("Technology Type","cooltech"); ?> </option>
						<?php foreach($tags as $tag) { ?>
						<option value="<?php echo $tag["slug"] ?>"><?php echo $tag["name"]; ?> </option>
						<?php }?>
					</select>
</div>
<div class="selectdiv">
					<select class="select-filter" id="type">
						<option value="0"><?php _e("Type","cooltech"); ?></option>
						<option value="equipment"><?php _e("Equipment","cooltech"); ?></option>
						<option value="case-study"><?php _e("Case Study","cooltech"); ?></option>
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
						<div class="text-intro">	<?php echo nl2br(do_shortcode(get_queried_object()->description)); ?> </div>
						<div class="text-full">
						<?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
							// echo jqFootnotes(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
						?></div>
				</div>
			</div>
		</div>
	</section>
	<?php
	$n1=get_term_meta(get_queried_object()->term_id, 'magic_numbers_number_1', true );
	$n2=get_term_meta(get_queried_object()->term_id, 'magic_numbers_number_2', true );
	$n3=get_term_meta(get_queried_object()->term_id, 'magic_numbers_number_3', true );
	$t1=get_term_meta(get_queried_object()->term_id, 'magic_numbers_text_1', true );
	$t2=get_term_meta(get_queried_object()->term_id, 'magic_numbers_text_2', true );
	$t3=get_term_meta(get_queried_object()->term_id, 'magic_numbers_text_3', true );


if($n1 && $n2 && $n3) {

	$n1=preg_split ('/\d+\K/' ,$n1 );
	$n2=preg_split ('/\d+\K/' ,$n2 );
	$n3=preg_split ('/\d+\K/' ,$n3 );


	?>
	<section id="magic-tax" class="<?php echo $slug ?>-numbers magic-numbers wp-block-cooltech-block-magic-numbers">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="magic-up">
					 	 <div class="magic-number"><?php echo $n1[0]; ?></div>
					 	 <div class="magic-value"><?php echo $n1[1]; ?></div>
				 	</div>
					<div class="magic-text"><?php echo do_shortcode($t1) ?></div>
				</div>
				<div class="col-md-4">
					<div class="magic-up">
						 <div class="magic-number"><?php echo $n2[0]; ?></div>
						 <div class="magic-value"><?php echo $n2[1]; ?></div>
					</div>
					<div class="magic-text"><?php echo do_shortcode($t2) ?></div>
				</div>
				<div class="col-md-4">
					<div class="magic-up">
						 <div class="magic-number"><?php echo $n3[0]; ?></div>
						 <div class="magic-value"><?php echo $n3[1]; ?></div>
					</div>
					<div class="magic-text"><?php echo do_shortcode($t3); ?></div>
				</div>
			</div>
		</div>
	</section>
		<?php
		}
			echo do_shortcode('[cooltech_cat]');
			} else {
			    // show third drop-down
			}
			 ?>
			<?php
			$term = $wp_query->queried_object;

			if($term->parent) {
				?>

				<section class="results <?php echo $parent->slug; ?>">
					<div class="container">
				<div class="clearfix"><div class="print-icon float-right"><a href="javascript:window.print()">	<img src="<?php echo get_template_directory_uri(); ?>/img/_ionicons_svg_md-print.svg" width="40" /> </a></div></div>
				<?php
				$x=0;
				if (have_posts()): while (have_posts()) : the_post();

						$args=array("childless"=>true);
						$se=wp_get_post_terms( $post->ID, "type", $args );
						// print_r($se);
						$ap=wp_get_post_terms( $post->ID, "application", $args );
						$tt=wp_get_post_terms( $post->ID, "technology-type", $args );
						$ma=wp_get_post_terms( $post->ID, "manufacturer", $args );
						$re=wp_get_post_terms( $post->ID, "refrigerant", $args );
						$co=wp_get_post_terms( $post->ID, "country", $args );

						$ee=get_post_meta($post->ID,"energy_efficency",true);
						$source=get_post_meta($post->ID,"source",true);
						$web=get_post_meta($post->ID,"website",true);

						$expanded=get_post_meta($post->ID,"expand",true);
				?>
					<!-- article -->
					<article class="element <?php showClassTags($ap); showClassTags($tt);showClassTags($ma);showClassTags($re); showClassTags($co); ?><?php echo $post->post_type; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<!--	<div class="col-sm-6 col-md-4 d-flex pb-3"> -->
					<div class="row">
						<div class="col-md-3 col-title-element">

						<h2 class="result_title"><?php the_title(); ?></h2>
						<?php  if($expanded!=1) { ?>
						<button class="<?php echo $parent->slug; ?> expand_text btn btn-rounded btn-outline-dark"> <?php _e( 'More Information', 'cooltech' ); ?> </button>
					<?php  } else { ?>
						<a class="more_text <?php echo $parent->slug; ?> btn btn-rounded btn-outline-dark" href="<?php the_permalink(); ?>"><?php _e( 'More Information', 'cooltech' ); ?>  </a>
					<?php } ?>
					</div>
						<div class="col-md-3">
								<div class="result_meta_title"><?php _e( 'Sector', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($se as $s ) {
									$p=get_term($s->parent); ?>
								<?php echo $p->name." ".$s->name ?><br/>
							<?php	} ?></div>
								<div class="result_meta_title"><?php _e( 'Application', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($ap as $a ) { ?>
										<?php	echo $a->name ?><br/>
									<?php	}?>
								</div>
								<div class="result_meta_title"><?php _e( 'Technology Type', 'cooltech' ); ?> </div>
								<div class="result_meta_content">
								<?php foreach ($tt as $t ) { ?>
									<?php echo $t->name ?><br/>
							<?php	} ?>
							</div>
							 </div>
						<div class="col-md-3">
								<div class="result_meta_title"><?php _e( 'Refrigerant', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($re as $r ) { ?>
								<?php echo $r->name ?><br/>
							<?php	} ?></div>

								<div class="result_meta_title"><?php _e( 'Manufacturer Country', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($ma as $m ) { ?>
								<?php echo $m->name ?> <?php if(next($ma)) { echo "/"; } ?>
							<?php	} ?>
								</div>
							</div>
							<div class="col-sm-3">
									<div class="result_meta_title"><?php _e( 'Energy Efficency', 'cooltech' ); ?></div>
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
								<div><?php the_content(); ?></div>
								<div class="result_meta_title"><?php _e( 'Website', 'cooltech' ); ?></div>
								<div class="result_meta_content"><?php  echo $web; ?></div>
								<div class="result_meta_title"><?php _e( 'Source', 'cooltech' ); ?></div>
								<div class="result_meta_content"><?php  echo $source; ?></div>
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
		</div>
		</section>

			<?php // get_template_part('loop'); ?>

			<?php // get_template_part('pagination'); ?>


		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
