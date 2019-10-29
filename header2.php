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

<div id="menus">
	<a href="#sidr" class="btn-responsive-menu" id="responsive-menu-button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
	</a>
<?php if(get_option( 'top_menu_option' )) { ?>
		<!-- <img height="50" src="<?php echo get_template_directory_uri() ?>/img/logo.png">--><!--</a></div> -->
	<div class="">
		<nav class="navbar navbar-first navbar-expand-md navbar-light bg-light">	<?php wp_nav_menu(
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
	<div class="menu2">

		<nav class="navbar navbar-main navbar-expand-md navbar-light bg-light w-100">

			<div id="logo"><div id="logo-main"><a href="<?php echo site_url(); ?>"><span class="cool">COOL</span><span class="tech">TECHNOLOGIES</span></div>
				<div id="logo-subtitle"> <?php echo get_bloginfo("description"); ?> </div></div>

			<?php wp_nav_menu(
		array(
			'theme_location'  => 'header-menu',
			'container'       => 'div',
			'container_class' => 'collapse navbar-collapse',
			'container_id'    => 'navbarNavDropdown',
			'menu_class'      => 'navbar-nav',
			'fallback_cb'     => '',
			'menu_id'         => 'main-menu2',
			'depth'           => 2,
			'walker'          => new WP_Bootstrap_Navwalker(),
		)
	); ?>
	<div id="partners">
	<img class="logo_partner" src="<?php echo get_template_directory_uri() ?>/img/eia-logo1.png">
	<img class="logo_partner" src="<?php echo get_template_directory_uri() ?>/img/greenpeace-logo2.png">

	</div>
</nav>
</div>
<div class="submenu"> </div>
</div>
