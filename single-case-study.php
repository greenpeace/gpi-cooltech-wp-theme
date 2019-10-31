<?php
get_header();
$image_id=get_post_thumbnail_id( $post->ID );
$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
$classes=array("generic-page");
$ex=get_post_meta($post->ID, "expand", true);

?>
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<main role="main">
	<?php if($ex) { ?>
	<header class="masthead"  style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php echo $post_thumbnail_img[0]; ?>')">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-end">
	          <h1 class="text-white font-weight-bold"><?php the_title(); ?></h1>
	        </div>
	        <div class="col-lg-8 align-self-baseline">

	        </div>
	      </div>
	    </div>
	 </header>
<?php } else { ?>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12"><h1><?php the_title(); ?> </h1></div>

			</div>

		</div>
	</section>

<?php } ?>


		<section>
	<div class="container">

			<div class="row">
				<div class="col-sm-8">
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>

				<?php the_content();

				$ee=get_post_meta($post->ID,"energy_efficency",true);
				$source=get_post_meta($post->ID,"source",true);
				$web=get_post_meta($post->ID,"website",true);

				if($ee) {
					?>
					<h2> Energy Efficency </h2>
					<?php
					echo $ee;
				}

				?>

				<div class="result_meta_title"><?php _e( 'Website', 'cooltech' ); ?></div>
				<div class="result_meta_content"><a href="<?php  echo $web; ?>" target="_blank"><?php  echo $web; ?></a></div>
				<div class="result_meta_title"><?php _e( 'Source', 'cooltech' ); ?></div>
				<div class="result_meta_content"><a href="<?php  echo $source; ?>" target="_blank">Link</a></div>

				<br class="clear">

				<?php edit_post_link(); ?>

			</article>
			</div>
			<div class="col-sm-4">
					<?php if(!$ex) { ?>
				<div style="padding-bottom:15px"><?php if(has_post_thumbnail( $post->ID )) {
					?> <?php ?>
					<?php
					the_post_thumbnail("full");
				} ?> </div>
			<?php } ?>
				<div class="sidebar-application sidebar-term">
			<?php	$ap=wp_get_post_terms( $post->ID, "application", $args );
			echo $ap[0]->name;
			?>
		</div>
					<div class="country-application sidebar-term">
				<?php	$co=wp_get_post_terms( $post->ID, "country", $args );
				echo $co[0]->name;
				?>
					<div>

				<?php  get_sidebar(); ?>
			</div>

			</div>
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

</section>
		<!-- </section> -->
		<!-- /section -->
	</main>

<?php get_footer(); ?>
