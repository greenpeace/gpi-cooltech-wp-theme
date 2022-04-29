<?php
/**
 * Template Name: Page Form
 *
 *
 */
get_header();



$classes=array("generic-page");

?>

	<main role="main">

		<section id="section-form">
<!--		<div class="container"> -->


		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h1 class="text-white"> <?php the_title(); ?> </h1>
							<div class="description text-white"><?php the_content(); ?></div>
						</div>
			</div>
				</div>

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

<!--	</div>  -->
</section>
<section>
<div class="container">

		<form id="form1" action="#" method="POST" class="">
			<?php wp_nonce_field( 'form-equipment', 'form-equipment-verif' ); ?>
			<div class="row">
			<div class="col-sm-6">
					<div class="form-group form-block">
					 <label for="exampleInputEmail1">Email address*</label>
					 <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="" required>
					 <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				 	</div>
					<div class="form-group form-block">

						<label for="equipment"><?php _e( 'Equipment Name' ); ?>*</label>
						<input id="equipment" class="form-control" type="text" name="equipment" value="" required />
						<small id="equipmentHelp" class="form-text text-muted">Name/number of equipment, Model name/number</small>
					</div>
					<div class="form-group form-block">
						<label for="description"><?php _e( 'Description' ); ?></label>
						<textarea class="form-control" id="description" name="description"/></textarea>
							<small id="descriptionHelp" class="form-text text-muted">Add information relevant to the piece of equipment that is not covered in the other boxes. E.g. temperature range, cooling capacity, awards won, price information, energy consumption, whether training is available. </small>
					</div>

					<div class="form-group form-block">
						<label for="equipment"><?php _e( 'Sector' ); ?>*</label>
						<select multiple class="form-control" name="type" id="type" required>
								<option value="0"> Commercial Air Conditioning </option>
								<option value="1"> Industrial Air Conditioning </option>
								<option value="2"> Domestic Air Conditioning </option>
								<option value="3" selected> Mobile Air Conditioning </option>
								<option value="4"> Domestic Heat pumps</option>
								<option value="5"> Commercial/Industrial Heat Pumps </option>
								<option value="6"> Commercial Refrigeration</option>
								<option value="7"> Industrial Refrigeration</option>
								<option value="8"> Domestic Refrigeration</option>
								<option value="9"> Mobile Refrigeration</option>
						</select>
						 <small id="sectorHelp" class="form-text text-muted">	To select more than one option press down CTRL and click on all relevant sectors </small>

					</div>

					<div class="form-group form-block">
						<label for="tt"><?php _e( 'Technology Type' ); ?></label>
						<div id="tt"> </div>
						 <small id="ttHelp" class="form-text text-muted">Select a Sector to see the options </small>
					</div>
					<div id="ttAdd" class="form-group d-none">
					 <input type="text" class="form-control" id="optionalTT" aria-describedby="addTTHelp" placeholder="Optional">
					 <small id="addTTHelp" class="form-text text-muted"> </small>
					</div>

			</div>
			<div class="col-sm-6">
				<div class="form-group form-block">
					<label for="ee"><?php _e( 'Energy Efficency' ); ?>*</label>
					<textarea id="ee" class="form-control" name="ee" required /></textarea>
					 <small id="eeHelp" class="form-text text-muted">COP/SCOP/EER/ISEER and/or any other energy efficiency information e.g. energy label (energy star, A+++, 5 star), reported energy savings, use of waste heat, controls and monitoring etc.</small>
				</div>
				<div class="form-group form-block">
				 <label for="manufacturer"><?php _e( 'Manufacturer' ); ?>*</label>
				 <input name="manufacturer" type="text" class="form-control" id="manufacturer" aria-describedby="manufacturerHelp" placeholder="Enter Manufacturer" value="" required>
				 <small id="manufacturerHelp" class="form-text text-muted"></small>
				</div>
				<div class="form-group form-block">
				 <label for="refrigerant"><?php _e( 'Refrigerant' ); ?>*</label>
				 <select class="form-control" id="refrigerant" name="refrigerant" required>
					<option value="0"> ---- </option>
					<option value="No refrigerant"> No refrigerant </option>
					<option value="Carbon Dioxide"> Carbon Dioxide (R-744) </option>
					<option value="Propane"> Propane (R-290) </option>
					<option value="Isobutane"> Isobutane (R-600°) </option>
					<option value="Propene"> Propene (R-1270) </option>
					<option value="Ammonia"> Ammonia (R-717) </option>
					<option value="Water"> Water (R-718) </option>
					<option value="Air"> Air (R-729) </option>
				 </select>
				 <small id="emailHelp" class="form-text text-muted">  </small>
				</div>
				<div id="" class="form-group form-block">
					<label for="application"><?php _e( 'Application' ); ?></label>
					<div id="application"> </div>
					<small id="applicationHelp" class="form-text text-muted">Select a Sector to see the options</small>
				</div>
				<div id="appAdd" class="form-group d-none">
				 <input type="text" class="form-control" id="optionalApp" aria-describedby="addOptionalHelp" placeholder="Optional">
				 <small id="addOptionalHelp" class="form-text text-muted"> </small>
				</div>
				<div class="form-group form-block">
				 <label for="website"><?php _e( 'Website' ); ?></label>
				 <input name="website" type="text" class="form-control" id="website" aria-describedby="websiteHelp" placeholder="Enter Website">
				 <small id="websiteHelp" class="form-text text-muted"></small>
				</div>
				<div class="form-group form-block">
				 <label for="country"><?php _e( 'Regional Availability' ); ?></label>
				<div class=''><input class='' id='africa' type='checkbox' name='country' value='Africa'><label class='' for='africa'>&nbsp; Africa</label></div>
				 <div class=''><input class='' id='asia' type='checkbox' name='country' value='Asia'><label class='' for='asia'>&nbsp; Asia</label></div>
		 	 		<div class=''><input class='' id='europe' type='checkbox' name='country' value='Europe'><label class='' for='europe'>&nbsp; Europe</label></div>
					<div class=''><input class='' id='north-america' type='checkbox' name='country' value='North America'><label class='' for='north-america'>&nbsp; North America </label></div>
					<div class=''><input class='' id='south-america' type='checkbox' name='country' value='South America'><label class='' for='south-america'> &nbsp; South America </label></div>
					<div class=''><input class='' id='oceania' type='checkbox' name='country' value='Oceania'><label class='' for='oceania'> &nbsp; Oceania </label></div>
					<div class=''><input class='' id='oceania' type='checkbox' name='country' value='Worldwide'><label class='' for='worldwide'>&nbsp; Worldwide </label></div>
					<div>
						<small id="countryHelp" class="form-text text-muted"> Additional countries </small>
						<input type="text" class="form-control" id="optionalCountry" aria-describedby="addCountryHelp" placeholder="Optional"> </div>

				</div>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-12"><div class=''><input class='' id='opt1' type='checkbox' name='opt1' value='ok' required><label class='d-inline' for='opt1'> &nbsp; By submitting this information you confirm that you have authority from the company you are representing to provide the information above. </label></div>
		</div> </div>
		<div class="row">
			<div class="col-sm-12"><div class=''><input class='' id='opt2' type='checkbox' name='opt2' value='ok' required><label class='d-inline' for='opt2'> &nbsp; Your details will be kept safe and secure and only used by us and will not be shared with anyone else. Please tick the box to confirm you are happy to be contacted by email by the Environmental Investigation Agency and Cool Technologies. </label></div>
		</div> </div>
		</form>
		<div class="row d-none" id="form_success">
			<div class="col-sm-12"><?php echo get_option("form_success"); ?> </div>
		</div>
			<div class="row mt-3">
				<div class="col-sm-12 text-center"> 	<a href="javascript:" class="btn btn btn-primary btn-arrow btn--300" id="send_element"><?php _e('Send'); ?> <i class="i-arrow-right-w"></i></a>
				</div> </div>
			</div>

</section>

	</main>

	<script>
jQuery("#form-elements").validate();
</script>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
