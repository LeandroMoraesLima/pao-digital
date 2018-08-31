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

	<?php wp_head(); ?>

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
<header id="header">
	<div class="container">
		<div id="logo" class="pull-left">		
			<a href="#intro" class="scrollto">
				<img src="<?php echo IMG; ?>/logo-pao-digital.png" >
			</a>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <a href="#intro"><img src="img/logo.png" alt="" title=""></a> -->
		</div>

		<nav id="nav-menu-container">
			<ul class="nav-menu">
				<li class="menu-active"><a href="#intro">Home</a></li>
				<li><a href="#about">Sobre Nós</a></li>
				<li><a href="#features">Cardápio</a></li>
				<li><a href="#pricing">Planos</a></li>
				<li><a href="#team">Parceiros</a></li>
				<li><a href="#contact">Contato</a></li>
				<li><a href="#login">Login</a></li>
			</ul>
		</nav><!-- #nav-menu-container -->
	</div>
</header><!-- #header -->

<!--==========================
Intro Section
============================-->
<section id="intro" style="background-image: url('<?php echo IMG; ?>/home-slider.jpg')">

	<div class="intro-text">
		<h2>Bem Vindo ao Pão Digital</h2>
		<p>Sua padaria preferida em um clique!</p>
		<a href="#about" class="btn-get-started scrollto">Vamos começar!</a>
	</div>

	<div class="product-screens">

		<div class="product-screen-1 wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.6s">
			<img src="img/product-screen-1.png" alt="">
		</div>

		<div class="product-screen-2 wow fadeInUp" data-wow-delay="0.2s" data-wow-duration="0.6s">
			<img src="img/product-screen-2.png" alt="">
		</div>

		<div class="product-screen-3 wow fadeInUp" data-wow-duration="0.6s">
			<img src="img/product-screen-3.png" alt="">
		</div>

	</div>

</section><!-- #intro -->

<main id="main">

<!--==========================
Product Featuress Section
============================-->
<section id="features">
	<div class="container">

		<div class="row">

			<div class="col-lg-8 offset-lg-4">
				<div class="section-header wow fadeIn" data-wow-duration="1s">
					<h3 class="section-title">Como Funciona</h3>
					<span class="section-divider"></span>
				</div>
			</div>

			<div class="col-lg-4 col-md-5 features-img">
				<img class="wow fadeInLeft" src="<?php echo IMG; ?>/product-features.png" >
			</div>

			<div class="col-lg-8 col-md-7 ">

				<div class="row">
					<div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.1s">
						<h4 class="title"><a href="">1</a></h4>
						<p class="description">Escolha a padaria mais proxima</p>
					</div><div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.1s">
						<h4 class="title"><a href="">2</a></h4>
						<p class="description">Adquira um plano ou outras opções de cardápio</p>
					</div>
					<div class="col-lg-6 col-md-6 box wow fadeInRight data-wow-delay="0.2s">
						<h4 class="title"><a href="">3</a></h4>
						<p class="description">Agende seu pedido ou e espere chegar quentinho em sua casa ou trabalho</p>
					</div>
					<div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.3s">
						<h4 class="title"><a href="">4</a></h4>
						<p class="description">Delicie-se e compartilhe com os amigos</p>
					</div>
				</div>

			</div>

		</div>

	</div>

</section><!-- #features -->

<!--==========================
Pricing Section
============================-->
<section id="pricing" class="section-bg">
	<div class="container">

		<div class="section-header">
			<h3 class="section-title">Planos</h3>
			<span class="section-divider"></span>
			<p class="section-description">Escolha qual plano que vai matar sua fome!</p>
		</div>

		<div class="row">

			<div class="col-lg-3 col-md-6">
				<div class="box wow fadeInLeft">
					<h3>Junior</h3>
					<h4>R$ 39<span>/mês</span></h4>
					<ul>
						<li>Café/com leite/Chocolate<br>Suco de laranja/melancia<br>Pão quente ou frio Bisnaga quente ou fria Pão de queijo<br>Salada de frutas Gd<br>Manteiga/requeijão<br>
						Geleia<br>Frios<br>Torrada/Bolacha/biscoito</li>
					</ul>
					<a href="#" class="get-started-btn">Fazer Pedido</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="box featured wow fadeInUp">
					<h3>Master</h3>
					<h4>R$ 99<span>/mês</span></h4>
					<ul>
						<li>Café/com leite/Chocolate<br>Suco de laranja/melancia<br>Pão quente ou frio Bisnaga quente ou fria Pão de queijo<br>Salada de frutas Gd<br>Manteiga/requeijão<br>
						Geleia<br>Frios<br>Torrada/Bolacha/biscoito</li>
					</ul>
					<a href="#" class="get-started-btn">Fazer Pedido</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="box wow fadeInRight">
					<h3>Pleno</h3>
					<h4>R$ 59<span>/mês</span></h4>
					<ul>
						<li>Café/com leite/Chocolate<br>Suco de laranja/melancia<br>Pão quente ou frio Pão de queijo<br>Salada de frutas Pq<br>Manteiga/requeijão</li>
					</ul>
					<a href="#" class="get-started-btn">Fazer Pedido</a>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">
				<div class="box wow fadeInLeft">
					<h3>Corporativo</h3>
					<ul>
						<li>Consulte nossas opções Reunião / Coffee Bleak</li>
					</ul>
					<a href="#" class="get-started-btn">Get Started</a>
				</div>
			</div>

		</div>
	</div>
</section><!-- #pricing -->

<!--==========================
About Us Section
============================-->
<section id="about">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="menu col-lg-6 wow fadeInLeft ">
						<h3 class="section-title">Cardápio</h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description">
							Não é todo o dia que vai tomar aquele café da manhã responsa?<br>
							Não tem problema, escolha o que quiser da sua padaria<br> favorita através do nosso cardápio.
						</p>
						<a href="#" class="pedir">Pedir Agora</a>
					</div>			
					<div class="col-lg-6 about-img content wow fadeInRight">
						<img src="<?php echo IMG; ?>/cardapio-pao-digital.jpg">
					</div>	
				</div>
			</div>		
		</div>
	</div>
</section><!-- #about -->

<!--==========================
Our Team Section
============================-->
<section id="team">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 wow fadeInLeft">
						<img src="<?php echo IMG; ?>/drive-thru-pao-digital.jpg">
					</div>	
					<div class="text col-lg-6 content wow fadeInRight">
						<h3 class="title">Drive Thru</h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description">Esta sem tempo de parar e comer na padaria que mais ama?<br>Ou então quer levar para casa aquela comidinha especial?<br>Peça agora e retire na padaria da sua preferênciq!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #team -->

<!--==========================
More Features Section
============================-->
<section id="more-features">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Parceiros</h3>
			<span class="section-divider"></span>
			<p class="section-description">Encontre alguns de nossos parceiros pela cidade</p>
		</div>
		<div class="row wow fadeInUp">
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo IMG . '/logo-primicia.png'; ?>');"></div>  
				<h4>Aclimação-SP</h4>									
			</div>
		</div>
		<div class="botao">
			<a href="#" class="ver">Ver todos parceiros</a>
		</div>	
	</div>	
</section><!-- #more-features -->

<!--==========================
Contact Section
============================-->
<section id="contact">
	<div class="container">
		<div class="row wow fadeInUp">

			<div class="col-lg-4 col-md-4">
				<div class="contact-about">
					<h3>Avilon</h3>
					<p>Cras fermentum odio eu feugiat. Justo eget magna fermentum iaculis eu non diam phasellus. Scelerisque felis imperdiet proin fermentum leo. Amet volutpat consequat mauris nunc congue.</p>
					<div class="social-links">
						<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
						<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
						<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
						<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-4">
				<div class="info">
					<div>
						<i class="ion-ios-location-outline"></i>
						<p>A108 Adam Street<br>New York, NY 535022</p>
					</div>

					<div>
						<i class="ion-ios-email-outline"></i>
						<p>info@example.com</p>
					</div>

					<div>
						<i class="ion-ios-telephone-outline"></i>
						<p>+1 5589 55488 55s</p>
					</div>

				</div>
			</div>

			<div class="col-lg-5 col-md-8">
				<div class="form">
					<div id="sendmessage">Your message has been sent. Thank you!</div>
					<div id="errormessage"></div>
					<form action="" method="post" role="form" class="contactForm">
						<div class="form-row">
							<div class="form-group col-lg-6">
								<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
								<div class="validation"></div>
							</div>
							<div class="form-group col-lg-6">
								<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
								<div class="validation"></div>
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
							<div class="validation"></div>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
							<div class="validation"></div>
						</div>
						<div class="text-center"><button type="submit" title="Send Message">Send Message</button></div>
					</form>
				</div>
			</div>

		</div>

	</div>
</section><!-- #contact -->

</main>

<!--==========================
Footer
============================-->
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 text-lg-left text-center">
				<div class="copyright">
					&copy; Copyright <strong>Avilon</strong>. All Rights Reserved
				</div>
				<div class="credits">
<!--
All the links in the footer should remain intact.
You can delete the links only if you purchased the pro version.
Licensing information: https://bootstrapmade.com/license/
Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Avilon
-->
Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
</div>
</div>
<div class="col-lg-6">
	<nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
		<a href="#intro" class="scrollto">Home</a>
		<a href="#about" class="scrollto">About</a>
		<a href="#">Privacy Policy</a>
		<a href="#">Terms of Use</a>
	</nav>
</div>
</div>
</div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>
