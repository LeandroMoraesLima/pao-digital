	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php 
			if(is_front_page() || is_home()):
				echo get_bloginfo('name');
			else:
				echo wp_title('');
			endif;
		?>
	</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Favicons -->
	<link href="img/favicon.png" rel="icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700|Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

	<script>
		//window.ajax = "<?php echo get_bloginfo('url'); ?>/getajax";
		window.ajax = "<?php echo get_bloginfo('url'); ?>/wp-admin/admin-ajax.php";
	</script>

	<?php wp_head(); ?>

<!-- =======================================================
Theme Name: Avilon
Theme URL: https://bootstrapmade.com/avilon-bootstrap-landing-page-template/
Author: BootstrapMade.com
License: https://bootstrapmade.com/license/
======================================================= -->
</head>

<body>

<?php 

	if (have_posts()) :
   		while (have_posts()) : the_post();

?>

<!--==========================
Header
============================-->
<header id="header">
	<div class="container">
		<div id="logo" class="pull-left">		
			<a href="<?php echo get_bloginfo('url'); ?>" class="scrollto">
				<?php $imagem = get_field('lo_logo','options'); ?>
				<img src="<?php echo $imagem; ?>)">
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
				<li class="menu-active"><a href="#intro">Home</a></li>
				<li><a href="<?php echo get_bloginfo('url'); ?>/sobre-nos/">Sobre Nós</a></li>
				<li><a href="#about">Cardápio</a></li>
				<li><a href="#pricing">Planos</a></li>
				<li><a href="#more-features">Parceiros</a></li>
				<li><a href="#contact">Contato</a></li>
				<?php if( !is_user_logged_in() ): ?>
					<li><a href="#login" class="lrm-login lrm-hide-if-logged-in">Login</a></li>
				<?php else: ?>
					<?php 
						if( isset($_SESSION['paodigital']['venda']) ):
							$vi = $_SESSION['paodigital']['venda'];
							$pods = pods('item', array(
								'where' 	=> "venda_id = {$vi}",
								'select'	=> "sum(quantidade) as qt"
							));
							$num = $pods->data()[0];
							
						else: 
							$num = 0;
						endif;
					?>
					<li>
						<a href="/cardapio" style="padding: 0px;">
							<span class="dashicons dashicons-cart">
								<div><?php echo $num->qt; ?></div>
							</span>
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</nav><!-- #nav-menu-container -->
	</div>
</header><!-- #header -->


<?php 
		endwhile;
	endif; 
?>