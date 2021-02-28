<?php

 ?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon-32x32.png" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php wp_head(); ?>
</head>

<body id="page-top">
	<?php if(get_option( 'top_menu_option' )) { ?>
	<div class="">
		<nav class="navbar navbar-first navbar-expand-md navbar-light bg-light d-none d-sm-block">	<?php wp_nav_menu(
			array(
				'theme_location'  => 'top-menu',
				'container'       => 'div',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav navbar-top ml-auto',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 1,
				'walker'          => new WP_Bootstrap_Navwalker(),
			)
		); ?></nav></div>
	<?php } ?>
<div id="menus">
	<div id="logo">
			<a class="print-url" href="<?php echo site_url(); ?>">
				<img alt="Logo cooltechnologies" src="<?php echo get_template_directory_uri() ?>/img/cooltech-logo.svg" height="50">
		</a>
	</div>
	<div class="menu-finale">
		<?php $menu = new NestedMenu('Menu 1');
			foreach ($menu->items as $item) {
					if($m->post_parent==0) {
				?>
				<div class="ddown" style="float:left">
					<a class="dropbtn" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
					<?php	$submenu = $menu->get_submenu($item); ?>
					<?php if($submenu) { ?>
					    <div class="ddown-content">
							<?php foreach($submenu as $s) { ?>
							<a href="<?php echo $s->url ?>"><?php echo $s->title; ?></a>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				<?php
					}
				}
		  ?>
	</div>
	<div id="partners">
		<a href="https://eia-international.org/" target="_blank"><img class="logo_partner" src="<?php echo get_template_directory_uri() ?>/img/eia-logo1.png" alt="Logo Eia International"></a>
		<a href="https://www.greenpeace.org/global/" target="_blank">	<img class="logo_partner" src="<?php echo get_template_directory_uri() ?>/img/greenpeace-logo2.png" alt="Logo Greenpeace"></a>
		<a href="#sidr" class="btn-responsive-menu" id="responsive-menu-button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
		</a>
	</div>
</div>
