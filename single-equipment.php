<?php
        get_header();
        $image_id=get_post_thumbnail_id($post->ID);
        $post_thumbnail_img = wp_get_attachment_image_src($image_id, 'full');
        $classes=array("generic-page");
        $args=array("childless"=>true);
        $se=wp_get_post_terms($post->ID, "type", $args);
        $p=get_term($se[0]->parent);
?>
<main role="main">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
			<section class="category-list <?php echo $p->slug; ?>">
					<div class="container bg-white">
						<div class="row">
							<div class="single-case-study-title col-sm-12">
								<h1><?php the_title(); ?> </h1>
								<a href="../../sector/<?php echo $p->slug;  ?>"><?php echo $p->name; ?></a> / <a href="../../sector/<?php echo $se[0]->slug; ?>"><?php echo $se[0]->name; ?></a>
							<div class="print-icon">
					 			<a href="javascript:window.print()"><svg class="print-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M399.95 160h-287.9C76.824 160 48 188.803 48 224v138.667h79.899V448H384.1v-85.333H464V224c0-35.197-28.825-64-64.05-64zM352 416H160V288h192v128zm32.101-352H127.899v80H384.1V64z"/></svg></a></div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
								<!-- article -->
								<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
									<?php the_content();
                        $ee=get_post_meta($post->ID, "energy_efficency", true);
                        $source=get_post_meta($post->ID, "source", true);
                        $web=get_post_meta($post->ID, "website", true);
                        if ($ee) { ?>
													<h2> <?php _e("Energy Efficiency","cooltech"); ?> </h2>
													<?php echo nl2br($ee); ?>
												<?php  } ?>
										<?php if($web) { ?>
											<div class="result_meta_title"><a class="result_meta_title" href="<?php  echo $web; ?>" target="_blank"><?php _e('Website', 'cooltech'); ?></a></div>
											<div class="result_meta_content"><a href="<?php  echo $web; ?>" target="_blank"><?php  echo $web; ?></a></div>
										<?php } ?>
										<?php if($source) { ?>
											<div class="result_meta_title"><a class="result_meta_title" title="<?php echo $source; ?>" href="<?php  echo $source; ?>" target="_blank"><?php _e('Source', 'cooltech'); ?></a></div>
										<br class="clear">
										<?php } ?>
										<?php edit_post_link(); ?>
									</article>
								</div>
								<div class="col-sm-4">
								<?php if (!$ex) { ?>
									<div style="padding-bottom:15px">
										<?php if (has_post_thumbnail($post->ID)) { ?>
															<?php the_post_thumbnail("full");
                    			} ?>
									</div>
								<?php } ?>
									<div class="sidebar-application sidebar-term">
										<?php	$ap=wp_get_post_terms($post->ID, "application", $args);
		                        echo $ap[0]->name;
		                        ?>
									</div>
									<div class="sidebar-country sidebar-term">
										<?php	$co=wp_get_post_terms($post->ID, "country", $args);
              				echo $co[0]->name;
              				?>
									</div>
									<div class="sidebar-manufacturer sidebar-term">
											<?php	$ma=wp_get_post_terms($post->ID, "manufacturer", $args);
                        echo $ma[0]->name;
                      ?>
								</div>
								<?php  get_sidebar(); ?>
						</div>
					</div>
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
