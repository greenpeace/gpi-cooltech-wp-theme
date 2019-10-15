<?php /**
 * Template Name: Page Case Study
 *
 * Template for displaying case studies
 *
 * @package understrap
 */
 get_header(); ?>

	<main role="main">
		<!-- section -->
		<!-- <section> -->

		<header class="masthead" style="background-color:white">
	    <div id="chartdiv" class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">

	        </div>
	      </div>

	  </header>
<div class="container">
<div class="row">

	<?php // La Query
	global $countrycodes;
	$args=array("post_type"=>"case-study");
$the_query = new WP_Query( $args );
$x=0;
// Il Loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post(); ?>
		<div class="col-sm-4 d-flex pb-3">
			<div class="card card-block element w-100">
	<?php	echo get_the_title();

	$country=wp_get_post_terms( $the_query->post->ID, "country", $args );
	if($country) {
		echo $country[0]->name;
		if($countrycodes[$country[0]->name]) {
			if($x>0) {
				$iso.=",";
			}
		// $iso.='{id:"'.$countrycodes[$country[0]->name].'", url:"../?country='.$country[0]->slug.'"}';
		$iso.='{"id":"'.$countrycodes[$country[0]->name].'","name": "'.$country[0]->name.'","value": 100,"fill": am4core.color("#F05C5C")}';
		$x++;
		}
	}

	?></div>
</div>
		<?php

endwhile; ?>

</div>
</div>
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
<script>
// Create map instance
var chart = am4core.create("chartdiv", am4maps.MapChart);

// Set map definition
chart.geodata = am4geodata_worldLow;

// Set projection
chart.projection = new am4maps.projections.Miller();

// Create map polygon series
var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

// Make map load polygon (like country names) data from GeoJSON
polygonSeries.useGeodata = true;

// Configure series
var polygonTemplate = polygonSeries.mapPolygons.template;
polygonTemplate.tooltipText = "{name}";
polygonTemplate.fill = am4core.color("#74B266");

// Create hover state and set alternative fill color
var hs = polygonTemplate.states.create("hover");
hs.properties.fill = am4core.color("#367B25");

// Remove Antarctica
polygonSeries.exclude = ["AQ"];

// Add some data
polygonSeries.data = [<?php echo $iso; ?>];

// Bind "fill" property to "fill" key in data
polygonTemplate.propertyFields.fill = "fill";
</script>
