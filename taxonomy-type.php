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

    $(".select-filter").change(function() {
      x=2;
    });


	$(window).scroll(function(){
      if ($('#footer').isOnScreen()) {
          //    console.log("x"+x+"totpages"+totpages);
      }
      console.log("totpages"+totpages);
      console.log(x);

			if ($('#footer').isOnScreen() && carico===0 && jQuery("header").hasClass("second-taxonomy") && x<=totpages) {


					// The element is visible, do something
          $(".infinite-loading").show();
					loadData();

			} else {
					// The element is NOT visible, do something else

			}
	});

function loadData() {
		carico=1;
	//	console.log("cambio");
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
            totpages: totpages
				},
				success: function(data, textStatus, XMLHttpRequest) {
						var len = data.length;
						data = data.substring(0, len - 1);
						// console.log("aggiungo da taxonomy");
            $(".infinite-loading").hide();
            // console.log(data);
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
  require_once("inc/header-parent-sector.php");
} else {
  require_once("inc/header-child-sector.php");
}  ?>
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
                <div id="block-filters-print" class="d-flex justify-content-between align-items-center">
                <div id="filters"> </div>
								<div class="print-icon print-icon-results">
									<a href="javascript:window.print()"> <svg class="print-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.95 160h-287.9C76.824 160 48 188.803 48 224v138.667h79.899V448H384.1v-85.333H464V224c0-35.197-28.825-64-64.05-64zM352 416H160V288h192v128zm32.101-352H127.899v80H384.1V64z"/></svg>	 </a>
								</div>
              </div>

							</div>
						</div>
				<div id="results">

				<?php
				$x=0;
				if($_GET["pt"]) {
					$queryadd="&post_type=".$_GET["pt"];
				}
        if(is_user_logged_in()) {
          $queryadd.="&post_status=any";
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
            $web=explode(",",$web);

						$expanded=get_post_meta($post->ID,"expand",true);

            $img_id = get_post_thumbnail_id( $post->ID );
            $img = wp_get_attachment_image_src( $img_id, "medium");
				?>
					<!-- article -->
					<article class="element <?php showClassTags($ap); showClassTags($tt);showClassTags($ma);showClassTags($re); showClassTags($co); ?><?php echo $post->post_type; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="row">
								<div class="col-md-12">
                  <div class="product-title-block">

                    <div><h2 class="result_title">
                      <?php
                      $title=get_the_title();

                      $hide=get_post_meta($post->ID, "hide_manufacturer", true);
                      echo getFullTitle($title,$ma[0]->name,$post->post_type,$hide); ?>

                      </h2>
                      <div class="subtitle-product-list"><?php echo getTypeLabel($post->post_type);  ?></div>
                    </div>


                    <?php  if($expanded!=1 && $post->post_type!="zero") { ?>
                      <button class="<?php echo $parent->slug; ?> expand_text btn btn-rounded btn-outline-dark"> <?php _e( 'More Information', 'cooltech' ); ?>

                      </button>
                      <?php  } else { ?>
                        <a class="more_text <?php echo $parent->slug; ?> btn btn-rounded btn-outline-dark" href="<?php the_permalink(); ?>"><?php _e( 'More Information', 'cooltech' ); ?>  </a>
                      <?php } ?>
                     </div>

               </div>
					</div>
					<div class="row">
						<div class="col-md-3">
            <?php
            if($img_id) {
              ?> <img src="<?php echo $img[0] ?>" class="img-fluid" />
            <?php }
            ?>
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
									} elseif($post->post_type=="zero") {
                    _e( 'Availability', 'cooltech' );
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
                <!--  <img src="<?php echo $img[0]; ?>" class="img-fluid" /> -->
							    <div class="result_meta_title"><?php _e( 'Energy Efficiency', 'cooltech' ); ?></div>
									<div class="result_meta_content"><?php echo wp_trim_words($ee, 25, "..."); ?></div>

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
								<?php if($web) {
                  ?>
								<div class="result_meta_title"><?php _e( 'Website', 'cooltech' ); ?></div>
								<div class="result_meta_content result_web">
                  <?php foreach ($web as $w) {?>
                  <a href="<?php echo $w ?>" target="_blank"><?php echo $w; ?></a>
                  <?php } ?>
                  </div>
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



		<!-- /section -->
	</main>


<?php get_footer(); ?>
