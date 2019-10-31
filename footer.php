			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<section id="footer-form">

				<div class="container">
					<div class="row">
							<div class="col-md-7 offset-md-2">
								<h1> <?php echo get_option('footer_textbig'); ?></h1>
								<p> <?php echo get_option('footer_subtitle'); ?></p>
								<a href="<?php echo get_option('footer_button_url'); ?>" class="btn-300 btn btn-outline-light btn-arrow"><?php echo get_option('footer_button_text'); ?><i class="i-arrow-right-w"></i></a>
							</div>
					</div>




						<div class="row">
							<div class="col-sm-12 line"> </div>
						</div>
					<div class="row">
						<div class="col-md-8"><h2> COOL TECHNOLOGIES </h2></div>
						<div class="col-md-4">
							<h4>	CONTACT US </h4>
							<h5>	info@cooltechnologies@org</h5>

											</div>
				</div>
				<div class="row">
					<div class="col-md-8 align-self-end">
					<a href="https://eia-international.org/" target="_blank">	<img src="<?php echo get_template_directory_uri() ?>/img/eia-logo1.png"></a>
					<a href="https://www.greenpeace.org/global/" target="_blank">	<img src="<?php echo get_template_directory_uri() ?>/img/greenpeace-logo2.png"></a>
					</div>
					<div class="col-md-4">
						<span class="note-font">
					<?php echo get_option('footer_small_text'); ?>
</span>



				</div>
			</div>
				</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="col-sm-12">
				<nav class="navbar navbar-last navbar-dark navbar-expand-md">	<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer-menu',
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav navbar-top m-auto',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 1,
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					); ?></nav>
				</div>
				</div>
				</div>

			</footer>
			<!-- /footer -->

		</div>
<?php
$menu = new NestedMenu('Menu 1');

//	print_r($menu);
//	echo "-------------------------------";
//	print_r($res);

 ?>
		<div id="sidr">
			<div class="close_menu"> <img src="<?php echo get_template_directory_uri() ?>/img/x-close-icon-white.png" width="30"/> </div>
			<ul class="mobile-menu-first">
  <!-- Your content -->
	<?php

	foreach ($menu->items as $item) {
			if($m->post_parent==0) {
				$submenu = $menu->get_submenu($item); ?>
				<li><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
					<?php if ($submenu) { ?>
				<button class="navbar-toggler"  type="button" data-toggle="collapse" data-target="#submenu-<?php echo $item->ID ?>" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation"><i class="i-arrow-down-w"></i></button>
				<?php } ?>
				</li>

				<?php if($submenu) { ?>
					<ul id="submenu-<?php echo $item->ID ?>" class="submenu collapse">
					<?php
					foreach($submenu as $s) {
					?>
				<li><a href="<?php echo $s->url ?>"><?php echo $s->title; ?></a> <li>
					<?php
				} ?> </ul>
				<?php
				} ?>
				</li>
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
