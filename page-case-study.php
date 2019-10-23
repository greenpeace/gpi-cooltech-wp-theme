<?php /**
 * Template Name: Page Case Study
 *
 * Template for displaying case studies
 *
 * @package understrap
 */
 get_header(); ?>

	<main role="main" style="background-color:#D2E9F1">
		<!-- section -->
		<!-- <section> -->

		<header class="masthead" style="background-color:#D2E9F1">
	    <div id="chartdiv" class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">

	        </div>
	      </div>

	  </header>
		<section>
<div class="container">
	<div class="row">
			<div class="col-sm-12"><h1 style="text-align:center"><?php _e("Case Study","cooltech"); ?> </h1> </div>
	</div>
</div>
</section>
<div class="container">
<div class="row">

	<?php // La Query
	global $countrycodes;
	$args=array("post_type"=>"case-study");
$the_query = new WP_Query( $args );
$x=0;
// Il Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post();

		?>
		<div class="col-sm-4 col-card">
	  <div class="card">
			<a href="<?php the_permalink(); ?>">
			<?php if(get_the_post_thumbnail_url($post, $size = 'full' )) { ?>
	    <img src="<?php echo get_the_post_thumbnail_url($post, $size = 'medium' ); ?>" class="card-img-top" alt="...">
		<?php } else { ?>
			<img class="card-img-top" src="<?php echo get_template_directory_uri(); ?>/img/image-empty-medium.jpg">
		<?php } ?>
	</a>
	    <div class="card-body">
	      <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	      <p class="card-text"><?php echo wp_trim_words( $post->post_content, 55, $more = "...") ?></p>
	      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
	    </div>
	  </div>
</div>


          <?php // edit_post_link(); ?>

        </article>
<?php
	$country=wp_get_post_terms( $the_query->post->ID, "country", $args );
	if($country) {
		if($countrycodes[$country[0]->name]) {
			if($x>0) {
				$iso.=",";
			}
		// $iso.='{id:"'.$countrycodes[$country[0]->name].'", url:"../?country='.$country[0]->slug.'"}';
		$iso.='{"id":"'.$countrycodes[$country[0]->name].'","name": "'.$country[0]->name.'", "fill": am4core.color("#165773")}';
		$x++;
		}
	}
	?>

		<?php
endwhile; ?>


</div>
	</main>

<?php // get_sidebar(); ?>

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

  // get object info
  console.log(ev.target.dataItem.dataContext.name);
});

// polygonTemplate.tooltipText = "{name}";
polygonTemplate.fill = am4core.color("#FFF");
 polygonTemplate.tooltipText = "{name}: gnegne {value}";
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
