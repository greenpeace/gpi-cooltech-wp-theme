<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<?php global $post ?>

	<?php if (!$ex) { ?>
		<div style="padding-bottom:15px">
			<?php if (has_post_thumbnail($post->ID)) { ?>
								<?php the_post_thumbnail("full");
						} ?>
		</div>
	<?php } ?>

	<?php $ap=wp_get_post_terms($post->ID, "application", $args);
	if($ap) {
	 ?>
		<div class="sidebar-application sidebar-term">
			<div>
			<?php
			foreach ($ap as $a) {
					echo $a->name;
				if(next($ap)) { echo " / "; }
			}
			 ?>
		</div>
		<div class="single-small-legend"> Application </div>
	</div>
<?php } ?>
<?php
	$ma=wp_get_post_terms($post->ID, "refrigerant", $args);
	if($ma) {
?>
		<div class="sidebar-refrigerant sidebar-term">
			<div>
				<?php
					foreach ($ma as $m) {
						echo $m->name;
						if(next($ma)) { echo " / "; }
					}
				?>
	</div>
		<div class="single-small-legend"> Refrigerant </div>
	</div>
<?php } ?>


	<?php	$co=wp_get_post_terms($post->ID, "country", $args); ?>
	<?php if($co) { ?>
	<div class="sidebar-country sidebar-term">
		<div> <b>  </b>

			<?php	foreach ($co as $c) {
					echo $c->name;
					if(next($co)) { echo " / "; }
				}
				?>
		</div>

		<div class="single-small-legend">
		<?php echo getCountryLabel($post->post_type); ?>
		</div>
	</div>
		<?php } ?>

	<?php $ma=wp_get_post_terms($post->ID, "manufacturer", $args);
	if($ma) {
	?>
		<div class="sidebar-manufacturer sidebar-term">
			<div>
				<?php
					echo $ma[0]->name;
				?>
			</div>
			<div class="single-small-legend"> Manufacturer </div>
			</div>
	<?php } ?>

	<?php // get_template_part('searchform'); ?>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>

</aside>
<!-- /sidebar -->
