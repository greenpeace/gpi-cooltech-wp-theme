	<!-- footer -->
	<footer id="footer" class="footer" role="contentinfo">
		<section id="footer-form">
					<div class="container">
						<div class="row">
								<div class="col-md-7 offset-md-2">
									<h1> <?php echo get_option('footer_textbig'); ?></h1>
									<p> <?php echo get_option('footer_subtitle'); ?></p>
									<a href="<?php echo site_url(); ?>/<?php echo get_option('footer_button_url'); ?>" class="btn--300 btn btn-outline-light btn-arrow"><?php echo get_option('footer_button_text'); ?><i class="i-arrow-right-w"></i></a>
								</div>
						</div>
						<div class="row">
							<div class="col-sm-12 footer__line"> </div>
						</div>
						<div class="row">
							<div class="col-md-8"><div class="footer__title"> COOLTECHNOLOGIES </div></div>
							<div class="col-md-4">
								<h4> <?php	_e("CONTACT US","cooltech"); ?> </h4>
								<h5>	<a class="text-white" href="mailto:info@cooltechnologies.org">info@cooltechnologies.org</a>
								</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8 align-self-end">
								<a href="https://eia-international.org/" target="_blank">	<img src="<?php echo get_template_directory_uri() ?>/img/eia-logo1.png" alt="Logo Eia International"></a>
								<a href="https://www.greenpeace.org/global/" target="_blank">	<img src="<?php echo get_template_directory_uri() ?>/img/greenpeace-logo2.png" alt="Logo Greenpeace"></a>
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

<?php $menu = new NestedMenu('Menu 1'); ?>
	<div id="sidr">
			<div class="close_menu"> <img src="<?php echo get_template_directory_uri(); ?>/img/_ionicons_svg_ios-close.svg" width="60"></div>
			<ul class="mobile-menu-first">
				<li><a href="<?php echo site_url(); ?>"> Home </a></li>
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
	<?php
	 if(get_option( 'top_menu_option' )) {
	 wp_nav_menu(
		array(
			'theme_location'  => 'top-menu',
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarNavDropdown',
			'menu_class'      => 'navbar-top ml-auto',
			'fallback_cb'     => '',
			'menu_id'         => 'main-menu',
			'depth'           => 1,
			'walker'          => new WP_Bootstrap_Navwalker(),
		)
	);
	}
	?>
</div>
		<!-- /wrapper -->
		<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"
  integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="
  crossorigin="anonymous"></script>


		<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-16156241-4"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-16156241-4');

</script>
		<?php wp_footer(); ?>

	</body>
</html>
