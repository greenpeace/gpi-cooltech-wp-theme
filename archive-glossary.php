<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1><?php _e( 'Glossary', 'cooltech' ); ?></h1>
				</div>
			</div>
			<div class="row">
<?php
	$args=array( 'orderby' => 'title','order' => 'ASC','post_type' =>'glossary','posts_per_page' =>-1);
	$the_query = new WP_Query( $args );
	$x=0;
	$last_initial="";
	while ( $the_query->have_posts() ) :
	$the_query->the_post();
	$titolo=get_the_title();
	$initial=$titolo[0];
	?>
	<?php if($last_initial!=$initial && $x%3>0) {
	//	for($i=0;$i<=$x%3;$i++) {
			?>
			<div class="col-sm-4"><?php // echo $last_initial."/".$initial;?></div>
			<?php
			$x++;
			if($x%3==1) {
				?>	<div class="col-sm-4"><?php //echo $last_initial."/".$initial;?></div>
			<?php
				$x++;
			}?>
		<?php
	//	}
	} ?>
<?php
	if($x%3==0) {
	?>	<div class="col-sm-4"><?php // echo $x."/"; ?><?php // echo $x%3 ?>
		<h2 style="color:red"><?php if($initial!=$last_initial) { echo $initial; } ?> </h2></div>
	<?php

	$x++;
	}
	?>

	<div class="col-sm-4"><?php // echo $x."/"; ?><?php //echo $x%3 ?><h2><?php	echo  get_the_title() ;?></h2>
		<?php the_content(); ?>
	</div>
	<?php
	$last_initial=$initial;
	$x++;
	endwhile; ?>
</div>

			<?php get_template_part('pagination'); ?>

		</div>

		</section>
		<!-- /section -->
	</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
