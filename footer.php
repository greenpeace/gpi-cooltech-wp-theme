			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<section>
				<div class="container">
					<div class="row">
							<div class="col-md-7 offset-md-2">
								<h1> We welcome information on news technologies and products as they come to market</h1>
								<a href="" class="btn-300 btn btn-outline-light btn-arrow">Go to the form<i class="i-arrow-right-w"></i></a>
							</div>
					</div>
				</div>
				</section>
				<section>
					<div class="container">
					<div class="row">
						<div class="col-md-8"><h2> COOL TECHNOLOGIES </h2></div>
						<div class="col-md-4">
							<h4>	CONTACT US </h4>
							<h5>	info@cooltechnologies@org</h5>

											</div>
				</div>
				<div class="row">
					<div class="col-md-8 align-self-end">
						<img src="<?php echo get_template_directory_uri() ?>/img/eia-logo1.png">
						<img src="<?php echo get_template_directory_uri() ?>/img/greenpeace-logo2.png">
					</div>
					<div class="col-md-4">
						<span class="note-font">
						The Cool Technologies Database Editorial Committee comprises Greenpeace and EIA. The survey is not meant to be all-inclusive, nor is the inclusion of any enterprise an endorsement of any company and its products.
The website does not have a commercial purpose and we do not accept payments for any information featured.
</span>



				</div>
			</div>
				</div>
				</section>


			</footer>
			<!-- /footer -->

		</div>

		<div id="sidr">
			<div class="close_menu"> X </div>
			<ul class="">
  <!-- Your content -->
	<?php

 $menu=wp_get_nav_menu_items("Menu 1");
		foreach($menu as $m) {
			if($m->post_parent==0) {
		?>
		<li> <?php echo $m->title; ?></li>
		<?php
			}
		}

  ?>
	</ul>
</div>


		<!-- /wrapper -->
		<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
  integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
  crossorigin="anonymous"></script>
		<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>

		</style>

		<!-- Resources -->
		<script src="https://www.amcharts.com/lib/4/core.js"></script>
		<script src="https://www.amcharts.com/lib/4/maps.js"></script>
		<script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
		<script src="https://www.amcharts.com/lib/4/geodata/usaLow.js"></script>
		<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>
		<?php wp_footer(); ?>
	</body>
</html>
