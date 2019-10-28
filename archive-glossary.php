<?php get_header(); ?>
<?php
$letters = range('A', 'Z');
?>

	<main role="main">
		<!-- section -->
		<section>

		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h1 class="glossary"><?php _e( 'Glossary', 'cooltech' ); ?></h1>
				</div>
				<div class="col-sm-8">
					<?php  foreach ($letters as $l) {
						?>
						<span class="menu-item-letter" id="<?php echo $l; ?>" href="#<?php echo $l ?>"><?php echo $l ?></span>
					<?php
					} ?></div>
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
//	print_r($post);
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
		<?php if($initial!=$last_initial) { ?>
		<h2 id="list-<?php echo $initial; ?>" class="glossary_letter"> <?php echo $initial;  ?> </h2>
	<?php } ?>
		</div>
	<?php

	$x++;
	}
	?>

	<div class="col-sm-4"><h2 class="glossary_term" id="<?php echo $post->post_name; ?>"><?php	echo  get_the_title() ;?></h2>
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
<script>
  jQuery(document).ready(function() {
var alfabeto=new Array( 26 ).fill( 1 ).map( ( _, i ) => String.fromCharCode( 65 + i ) );
// console.log(alfabeto);
for(x=0;x<alfabeto.length;x++) {
	if (document.getElementById("list-"+alfabeto[x])) {
	//	console.log(alfabeto[x]);
		jQuery("#"+alfabeto[x]).addClass("selectable");
		jQuery(".selectable").click(function() {
				jQuery('html, body').stop().animate({
			scrollTop: jQuery("#list-"+this.id).offset().top}, 500, 'linear');
		//			console.log(">>>"+this.id);
		});
	}
}
});
</script>
<?php get_footer(); ?>
