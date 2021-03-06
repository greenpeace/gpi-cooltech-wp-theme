<?php
/**
 * Template Name: Homepage Full Width
 *
 *
 */
 get_header();

 // $image_id=get_post_thumbnail_id( $post->ID );
 // $post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );

 $page_layout="";

?>
<!--	<main role="main home">
		<header class="masthead" style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php // echo $post_thumbnail_img[0]; ?>')">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="h1-home text-white font-weight-bold"><?php // echo $post->post_excerpt; ?></h1>

	        </div>
	        <div class="col-lg-5 align-self-baseline" style="margin-top:1rem">
              <?php /* if ( shortcode_exists('wpdreams_ajaxsearchlite') ) {
                echo do_shortcode('[wpdreams_ajaxsearchlite]');
              } */
              ?>
            </div>
	      </div>
	    </div>
	  </header>
-->
<?php
 if (get_option("carousel_option")) { ?>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active">
  <?php echo do_shortcode("[net_to_zero class='height50']"); ?>
</div>
<div class="carousel-item">
    <?php echo do_shortcode("[search_panel]"); ?>
</div>

</div>
<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
  <?php
  }
  ?>

		<div class="div-home">


		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="<?php echo $page_layout; ?>">
				<?php the_content(); ?>
			</div>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'cooltech' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>
		</div>

		<!-- </section> -->
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>

<script>

<?php
    $attimages = get_attached_media('image', $post->ID);
?>
body=jQuery(".masthead");

var backgrounds = [<?php foreach ($attimages as $image) {
    echo "'".wp_get_attachment_url($image->ID)."',";
} ?>];
var current=0;
// Preload all images // Prevent (if possible) white gaps between image load
 for(var i=0; i<backgrounds.length; i++){
   var img = new Image();
   img.src= backgrounds[i];
 }

 function nextBackground() {
   body.css(
     "background-image", // Use background-image instead of `background`
      "linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url("+backgrounds[++current % backgrounds.length]+")" // no need to `current = `
   );
   setTimeout(nextBackground, <?php echo get_option("time_slide"); ?>);
 }
 setTimeout(nextBackground, <?php echo get_option("time_slide"); ?>);
 body.css("background-image", "url("+backgrounds[0]+")").fadeIn();

</script>

<style>
.masthead {
  transition: background-image 1s ease-in;
}
</style>
