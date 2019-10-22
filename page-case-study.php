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
        <article class="element" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php
          $se=wp_get_post_terms( $the_query->post->ID, "type", $args );
          $ap=wp_get_post_terms( $the_query->post->ID, "application", $args );
          $tt=wp_get_post_terms( $the_query->post->ID, "technology-type", $args );
          $ma=wp_get_post_terms( $the_query->post->ID, "manufacturer", $args );
          $re=wp_get_post_terms( $the_query->post->ID, "refrigerant", $args );
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
		$iso.='{"id":"'.$countrycodes[$country[0]->name].'","name": "'.$country[0]->name.'", "fill": am4core.color("#F05C5C")}';
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
// polygonTemplate.tooltipText = "{name}";
polygonTemplate.fill = am4core.color("#2EBCD0");
 polygonTemplate.tooltipText = "{name}: {value}";

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
