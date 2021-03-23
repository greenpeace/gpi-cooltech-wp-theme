<?php
        get_header();
        $image_id=get_post_thumbnail_id($post->ID);
        $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');
        $classes=array("generic-page");
        $args=array("childless"=>true);
        $se=wp_get_post_terms($post->ID, "type", $args);
        $p=get_term($se[0]->parent);

?>
<main role="main" class="single-zero-page">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		      <?php include("single-product.php"); ?>
  
						<!-- /article -->
					<?php endwhile; ?>
					<?php else: ?>
						<!-- article -->
						<article>
							<h2><?php _e('Sorry, nothing to display.', 'cooltech'); ?></h2>
						</article>
						<!-- /article -->
					<?php endif; ?>
				</div>
			</section>
	</main>
  <?php get_footer(); ?>
