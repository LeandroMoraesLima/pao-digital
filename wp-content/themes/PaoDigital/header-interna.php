<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<title>Avilon Bootstrap Template</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Favicons -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

	<script>
		window.ajax = "<?php echo get_bloginfo('url'); ?>/wp-admin/admin-ajax.php";
	</script>
	
	<?php wp_head(); ?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


<!-- =======================================================
Theme Name: Avilon
Theme URL: https://bootstrapmade.com/avilon-bootstrap-landing-page-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
======================================================= -->
</head>

<body>

<!--==========================
Header
============================-->
<header id="header" class="interna">
	<div class="container">
		<div id="logo" class="pull-left">		
			<a href="<?php echo get_bloginfo('url'); ?>" class="scrollto">
				<img src="<?php echo IMG; ?>/logo-pao-digital.png" >
			</a>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
				<li class="menu-active"><a href="#intro">Home</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/sobre-nos/">Sobre Nós</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/#about">Cardápio</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/#pricing">Planos</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/#more-features">Parceiros</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/#contact">Contato</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/#login">Login</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
	</div>
</header><!-- #header -->