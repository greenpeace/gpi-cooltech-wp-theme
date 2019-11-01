<?php

 get_header();

 global $countrycodes;

 $terms = get_terms( array(
   "taxonomy" => "country",
 ) );

 foreach ($terms as $term) {
	 $args = array(
	'post_type' => 'case-study',
	'tax_query' => array(
		array(
			'taxonomy' => 'country',
			'field' => 'id',
			'terms' => $term->term_id
		)
	)
);
	 	$posts = get_posts($args);
	//	print_r($posts);
				if($posts) {
				$titles="";
				$x=0;
				foreach($posts as $p) {
				//	print_r($p);
					$titles.=addslashes($p->post_title." ");
					if(next($posts)) {
						$titles.=" / ";
					}
					$x++;
				}
				if($x==1) { $link=get_permalink($p); }
				$iso.='{"id":"'.$countrycodes[$term->name].'","name": "'.$term->name.'","description":"'.$titles.'","fill": am4core.color("#165773"),"value":'.$x.',"link":"'.$link.'"},';
				}
 }
?>

	<main role="main" style="background-color:#D2E9F1">
		<!-- section -->
		<!-- <section> -->

		<header class="masthead" style="background-color:#D2E9F1">
	    <div id="chartdiv" class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">

	        </div>
	      </div>

	  </header>
<section id="case-study-results-title">
<div class="container">
	<div class="row">
			<div class="col-sm-12"><h1 class="case-study" style="text-align:center"><?php _e("Case Studies","cooltech"); ?> </h1> </div>
	</div>
</div>
</section>
<div id="case-study-results" class="container">
<div class="row">

	<?php // La Query

	$args=array("post_type"=>"case-study");
$the_query = new WP_Query( $args );
$x=0;
// Il Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$co=wp_get_post_terms( $post->ID, "country", $args);
    $ap=wp_get_post_terms($post->ID, "application",$args)
		?>
		<div class="col-sm-4 col-card">
	  <div class="card <?php echo $co[0]->name; ?>">
			<a href="<?php the_permalink(); ?>">
			<?php if(get_the_post_thumbnail_url($post, $size = 'full' )) { ?>
	    <img src="<?php echo get_the_post_thumbnail_url($post, $size = 'medium' ); ?>" class="card-img-top" alt="...">
		<?php } else { ?>
			<img class="card-img-top" src="<?php echo get_template_directory_uri(); ?>/img/image-empty-medium.jpg">
		<?php } ?>
	</a>
	    <div class="card-body">
	      <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	      <p class="card-text"><?php echo wp_trim_words( $post->post_content, 40, $more = "...") ?></p>
	      <p class="card-text"><small class="text-muted">
					<?php
						echo $co[0]->name;
					?> /
          <?php foreach($ap as $a) {
            echo $a->name."&nbsp;";
          } ?>

				</small></p>
	    </div>
	  </div>
</div>


          <?php // edit_post_link(); ?>

        </article>


		<?php
endwhile; ?>


</div>
	</main>


<?php get_footer(); ?>
<script>
// Create map instance
var chart = am4core.create("chartdiv", am4maps.MapChart);
// Set map definition
chart.geodata = am4geodata_worldLow;
chart.background.fill = am4core.color("#D2E9F1");
chart.background.fillOpacity = 1;
// Set projection
chart.projection = new am4maps.projections.Miller();
chart.chartContainer.wheelable = false;
// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
// Make map load polygon (like country names) data from GeoJSON
polygonSeries.useGeodata = true;
// Configure series
var polygonTemplate = polygonSeries.mapPolygons.template;


polygonTemplate.events.on("hit", function(ev) {
  // zoom to an object
//  ev.target.series.chart.zoomToMapObject(ev.target);
//	console.log(ev.target.dataItem.dataContext.value);
  jQuery(".col-card").css("display","flex");
	if(ev.target.dataItem.dataContext.value==1) {
			document.location.href=ev.target.dataItem.dataContext.link;
	} else {
				jQuery(".card:not(." + ev.target.dataItem.dataContext.name + ")").parent().css("display", "none");
				jQuery('html, body').stop().animate({
			scrollTop: jQuery("#case-study-results-title").offset().top
	}, 1000, 'linear');
	}
  // get object info
  console.log(ev.target.dataItem.dataContext.name);
});

// polygonTemplate.tooltipText = "{name}";
polygonTemplate.fill = am4core.color("#FFF");
 polygonTemplate.tooltipText = "{name}: {description}";
// Create hover state and set alternative fill color
var hs = polygonTemplate.states.create("hover");
hs.properties.fill = am4core.color("#2290BE");
// Remove Antarctica
polygonSeries.exclude = ["AQ"];
// Add some data
polygonSeries.data = [<?php echo $iso; ?>];
// Bind "fill" property to "fill" key in data
polygonTemplate.propertyFields.fill = "fill";
</script>
