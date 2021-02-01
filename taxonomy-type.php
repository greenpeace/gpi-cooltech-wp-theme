<?php get_header(); ?>
<script>

jQuery.fn.isOnScreen = function(){

    var win = jQuery(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

};

jQuery(document).ready(function($) {
	var x = 2;
	var carico = 0 ;

	$(window).scroll(function(){

			if ($('#footer').isOnScreen() && carico===0 && jQuery("header").hasClass("second-taxonomy") && x<=totpages) {
        console.log("scroll fine");
					// The element is visible, do something
          $(".infinite-loading").show();
					loadData();

			} else {
					// The element is NOT visible, do something else
			}
	});

function loadData() {
		carico=1;
		console.log("cambio");
		$.ajax({
				type: 'POST',
				url: ajax_url,
				data: {
						manufacturer: $("#manufacturer").val(),
						refrigerant: $("#refrigerant").val(),
						country: $("#country").val(),
						application: $("#application").val(),
						sector:$("#sector").val(),
						tt:$("#technology-type").val(),
						type:$("#type").val(),
						action: 'filterElements',
						numpage: x,
            totpage: totpages
				},
				success: function(data, textStatus, XMLHttpRequest) {
						var len = data.length;
						data = data.substring(0, len - 1);
						console.log("aggiungo da taxonomy");
            $(".infinite-loading").hide();
            console.log(data);
						$('#results').append(data);
						carico=0;
						x=x+1;

				},
				error: function(MLHttpRequest, textStatus, errorThrown) {
					console.log(errorThrown);
				}
		});
}

});

</script>
<?php
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
	          <h1 class="last-sector text-black font-weight-bold <?php echo $parent->slug; ?>">  <?php if($_GET["pt"]=="zero") { echo "Net to Zero "; }?><?php single_cat_title(); ?> <?php echo $parent->name ?>
						<?php  $id=get_queried_object()->parent;
						$parent=	get_term($id,"type"); ?>
						</h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">
						<div><h3 class="<?php echo $parent->slug; ?>">
              <?php if($_GET["pt"]=="zero") { ?>
                <?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'net_to_zero_desc', true ));
    						?>
              <?php } else { ?>
              <?php echo get_queried_object()->description; ?></h3></div>
            <?php }  ?>
              <?php if(!$_REQUEST["pt"]) { ?>
						<div class="text-full-second"><?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
						?> </div>
          <?php } ?>
				  </div>
	      </div>
      </div>
        <?php if($_GET["pt"]=="zero") { ?>
          <?php $pdf=get_term_meta(get_queried_object()->term_id,"pdf",true); ?>
          <?php $file=wp_get_attachment_url($pdf )?>
          <?php if($pdf) { ?>
            <div class="row">
              <div class="col-sm-12 text-center">
                <div class="download-pdf <?php echo $parent->slug; ?>">
                <a href="<?php echo $file; ?>" target="_blank"> DOWNLOAD PDF </a><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-pdf" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-file-pdf fa-w-12 fa-2x"><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z" class=""></path></svg></i></div>
                </div>
            </div>
        <?php }
        } ?>

				<?php $term = $wp_query->queried_object;
        // print_r($term);
        ?>
      <div class="row">
         <div class="col-lg-12 align-self-end">
				<input type="hidden" id="sector" value="<?php echo $slug ?>">
				<div id="selectblock" class="row d-print-none">
					<div id="selectcolumn" class="col-sm-12">
					<?php
			//		print_r($term);
		// 	$tags=array_unique(get_tags_in_use($term->term_id,"application"));
					$tags=get_tags_in_use($term->term_id,"application");
				//	print_r($tags); ?>

				 <div class="selectdiv">	<select id="application" class="select-filter" name="application">
						<option value="0"> <?php _e("Applications","cooltech"); ?></option>
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
  <?php if($_GET["pt"]=="zero") { ?>
      <inpt type="hidden" id="type" value="zero">
  <?php } else { ?>
    <div class="selectdiv">
					<select class="select-filter" id="type">
						<option value="0"><?php _e("Type","cooltech"); ?></option>
          	<option value="equipment"><?php _e("Cool Technologies Products","cooltech"); ?></option>
          	<option value="case-study"><?php _e("Case Study","cooltech"); ?></option>
              <?php 
              $options = get_option( 'ntz_option' );
              if ($options) { ?>
						<option value="zero"><?php _e("Pathway to Zero Products","cooltech"); ?> </option>
              <?php } ?>
					</select>
      </div>
    <?php
    }
    ?>
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
						<div class="text-intro"> 	<?php echo nl2br(do_shortcode(get_queried_object()->description)); ?> </div>
						<div class="text-full">
						<?php echo do_shortcode(get_term_meta( get_queried_object()->term_id, 'full_text', true ));
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
						<div class="row">
							<div class="col-sm-12">
								<div class="print-icon float-right print-icon-results">
									<a href="javascript:window.print()"> <svg class="print-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.95 160h-287.9C76.824 160 48 188.803 48 224v138.667h79.899V448H384.1v-85.333H464V224c0-35.197-28.825-64-64.05-64zM352 416H160V288h192v128zm32.101-352H127.899v80H384.1V64z"/></svg>	 </a>
								</div>
							</div>
						</div>
				<div id="results">
				<?php
				$x=0;
				if($_GET["pt"]) {
					$queryadd="&post_type=".$_GET["pt"];
				}
				// query_posts(array("orderby"=>"title","order"=>"ASC"));
				query_posts($query_string."&orderby=title&order=ASC&paged=1&posts_per_page=10".$queryadd);
        global $wp_query;
        $totpag=$wp_query->max_num_pages;
        ?>
        <script>
          var totpages=<?php echo $totpag; ?>
        </script>
        <?php
				if (have_posts()): while (have_posts()) : the_post();

							$el=new Element($post);
						//	print_r($el);


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

					<div class="row d-lg-none">
								<div class="col-md-12"><h2 class="result_title"><?php the_title(); ?></h2> </div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h2 class="result_title d-none d-sm-none d-md-none d-lg-block"><?php the_title(); ?></h2>
							<?php  if($expanded!=1) { ?>
								<button class="<?php echo $parent->slug; ?> expand_text btn btn-rounded btn-outline-dark"> <?php _e( 'More Information', 'cooltech' ); ?>

								</button>
							<?php  } else { ?>
								<a class="more_text <?php echo $parent->slug; ?> btn btn-rounded btn-outline-dark" href="<?php the_permalink(); ?>"><?php _e( 'More Information', 'cooltech' ); ?>  </a>
						<?php } ?></div>
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

								<div class="result_meta_title"><?php _e( 'Manufacturer', 'cooltech' ); ?></div>
								<div class="result_meta_content">
								<?php foreach ($ma as $m ) { ?>
								<?php echo $m->name ?> <?php if(next($ma)) { echo "/"; } ?>
							<?php	} ?>
								</div>
								<div class="result_meta_title">
									<?php
									if($post->post_type=="equipment") {
										_e( 'Manufacturer Country', 'cooltech' );
									} else {
										_e( 'Country', 'cooltech' );
									}
										?>
								</div>
								<div class="result_meta_content">
								<?php foreach ($co as $c ) { ?>
								<?php echo $c->name ?> <?php if(next($co)) { echo "/"; } ?>
							<?php	} ?>
								</div>
							</div>
							<div class="col-md-3">
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
								<?php if($web) {?>
								<div class="result_meta_title"><?php _e( 'Website', 'cooltech' ); ?></div>
								<div class="result_meta_content result_web"><a href="<?php echo $web ?>" target="_blank"><?php echo $web; ?></a></div>
								<?php } ?>
								<?php if ($source) { ?>
								<div class="result_meta_title"><a title="<?php echo $source; ?>" class="result_meta_title" href="<?php  echo add_http($source); ?>" target="_blank"><?php _e( 'Source', 'cooltech' ); ?></a></div>
								<div class="result_meta_content result_source"><?php  echo createLink($source); ?></div>
								<?php } ?>

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
		</div>
    <?php ?>
		<div class="infinite-loading"> <div class="lds-ring"><div></div><div></div><div></div><div></div></div> </div>
    <?php ?>

		</section>

			<?php // get_template_part('loop'); ?>

			<?php // get_template_part('pagination'); ?>


		<!-- /section -->
	</main>

<?php get_footer(); ?>
