<?php
	get_header();
	$image_id=get_post_thumbnail_id( $post->ID );
	$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );
	$classes=array("generic-page");
	$ex=get_post_meta($post->ID, "expand", true);
	$args=array("childless"=>true);
	$se=wp_get_post_terms( $post->ID, "type", $args );
//print_r($se);
	$p=get_term($se[0]->parent);
?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<main role="main" class="case-study-page">
		<?php if($ex) { ?>
			<header class="masthead"  style="background-image:linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url('<?php echo $post_thumbnail_img[0]; ?>')">
	    <div class="container h-100">
	      <div class="row h-100 align-items-center justify-content-center text-center">
	        <div class="col-lg-10 align-self-center">
	          <h1 class="text-white font-weight-bold"><?php the_title(); ?></h1>
	        </div>
	      </div>
	    </div>
	 </header>
<?php }  ?>

<section class="category-list <?php echo $p->slug; ?>">
		<div class="container bg-white">
			<div class="row">
				<div class="single-case-study-title single-title colour-title col-sm-12">
					<div class="d-flex justify-content-between">
					<h1><?php the_title(); ?> </h1>
					<div class="print-icon">	<a href="javascript:window.print()"><svg class="print-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.95 160h-287.9C76.824 160 48 188.803 48 224v138.667h79.899V448H384.1v-85.333H464V224c0-35.197-28.825-64-64.05-64zM352 416H160V288h192v128zm32.101-352H127.899v80H384.1V64z"/></svg></a></div>
					</div>
				<div>
				Case Study - <a href="../../sector/<?php echo $p->slug;  ?>"><?php echo $p->name; ?></a> / <a href="../../sector/<?php echo $se[0]->slug; ?>"><?php echo $se[0]->name; ?></a>
				</div>

				 </div>
			 </div>
			<div class="row">
				<div class="col-sm-4">
						<?php  get_sidebar("product"); ?>
				</div>
			<div class="col-sm-8">
			<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
				<?php the_content();
				$ee=get_post_meta($post->ID,"energy_efficency",true);
				$source=get_post_meta($post->ID,"source",true);
				$web=get_post_meta($post->ID,"website",true);
				if($ee) {
					?>
					<h2 class="single-title-energy-efficency colour-title"><?php _e("Energy Efficency","cooltech"); ?></h2>
					<?php
					echo $ee;
				}
				?>
				<?php if($web) { ?>
				 <div class="result_meta_title colour-title"><?php _e( 'Website', 'cooltech' ); ?></div>
				<div class="result_meta_content result_web"><a href="<?php  echo $web; ?>" target="_blank"><?php  echo $web; ?></a></div>
				<?php } ?>
				<?php if($source) { ?>
				  <div class="result_meta_title colour-title"><?php _e( 'Source', 'cooltech' ); ?></div>
				<div class="result_meta_content result_source"><?php echo createLink($source); ?> </div>
			<?php } ?>
				<br class="clear">
				<?php // edit_post_link(); ?>
				</article>
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
</main>
<?php get_footer(); ?>
