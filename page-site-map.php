<?php

get_header();

$image_id=get_post_thumbnail_id( $post->ID );
$post_thumbnail_img = wp_get_attachment_image_src( $image_id, 'full' );

$classes=array("generic-page");

?>

	<main role="main">
		<section>
			<div class="container">
				<div class="sitemap">
					<nav class="utilityNav">
						<ul>
							<li><a href="/site-map">Site Map</a></li>
						</ul>
					</nav>
					<nav class="primaryNav">
						<ul>
							<li id="home"><a href="<?php site_url(); ?>">Home</a></li>
							<?php $menu = new NestedMenu('Menu 1');
								foreach ($menu->items as $item) {
								if($m->post_parent==0) {
								?>
									<li><a href="<?php echo $item->url; ?>"> <?php echo $item->title; ?> </a>
										<?php	$submenu = $menu->get_submenu($item); ?>
											<?php if($submenu) { ?>
												<ul>
													<?php
													foreach($submenu as $s) {
														?>
														<li>	<a href="<?php echo $s->url ?>"><?php echo $s->title; ?></a></li>
														<?php
															}
														?>
														<?php if($item->type_label=="Sector")  { ?>
																<li><ul><li><a href=""> Results </a></li></ul></li>
															<?php }?>
														</ul>
										<?php } ?>
							</li>
							<?php
							}
						}
						?>


				</ul>

			</nav>

		</div>

	</div>
</section>
		<!-- </section> -->
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
