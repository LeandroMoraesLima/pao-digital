<?php get_header(); 

	if (have_posts()) :
	    while (have_posts()) : the_post();
				
		$imagem = get_field('sl_sliders');
?>



<!--==========================
Intro Section
============================-->


<section id="intro" style="background-image: url('<?php echo $imagem; ?>')">

	<div class="intro-text">
		<h2><?php echo get_field('ti_titulo'); ?></h2>
		<p><?php echo get_field('st_sub_titulo'); ?></p>
		<a class="btn-get-started scrollto" href="<?php echo get_field('lb_link_do_botao'); ?>"><?php echo get_field('tb_titulo_do_botao'); ?></a>
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

	<?php

		// check if the repeater field has rows of data
		if( have_rows('te_texto') ): 
			$imagem = get_field('im_image');

	?>


<section id="features">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-4">
				<div class="section-header wow fadeIn" data-wow-duration="1s">
					<h3 class="section-title"><?php echo get_field('tt_titulo') ?></h3>
					<span class="section-divider"></span>
				</div>
			</div>

			<div class="col-lg-4 col-md-5 features-img">
				<img class="wow fadeInLeft" src="<?php echo $imagem; ?>')" >
			</div>

			<div class="col-lg-8 col-md-7 ">

				<div class="row">

					<?php	// loop through the rows of data
		 				while ( have_rows('te_texto') ) : the_row(); ?>
		 								
						<div class="col-lg-6 col-md-6 box wow fadeInRight" data-wow-delay="0.1s">
							<h4 class="title">
								<a href="#more-features"><?php echo get_sub_field('nu_number') ?></a>
							</h4>
							<p class="description">
								<?php echo get_sub_field('tx_text') ?>
							</p>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- #features -->

	<?php 

     	else:
			echo "nao existe Section!";

			endif;
	?>

<!--==========================
Pricing Section
============================-->

	<?php

		// check if the repeater field has rows of data
		if( have_rows('ca_category') ): 			
	?>


<section id="pricing" class="section-bg">
	<div class="container">

		<div class="section-header">
			<h3 class="section-title"><?php echo get_field('tl_titulo') ?></h3>
			<span class="section-divider"></span>
			<p class="section-description"><?php echo get_field('sb_sub_titulo') ?></p>
		</div>

		<div class="row">



			<?php	// loop through the rows of data
			$i=0;

		 		while ( have_rows('ca_category') ) : the_row(); ?>

				<?php $ativar = (get_sub_field('at_ativar_marcador') == true)? 'featured' : ''; ?>

				<div class="col-lg-3 col-md-6">
					<div class="box <?php echo $ativar; ?> wow <?php echo get_sub_field('se_section'); ?>">
					
						<h3><?php echo get_sub_field('pa_pacotes') ?></h3>
					
						<?php if (get_sub_field('vl_valor') >= true): ?>			    
						
							<h4>R$ <?php echo get_sub_field('vl_valor') ?><span>/mês</span></h4>

						<?php endif ?>

						<ul>
							<li><?php echo get_sub_field('tt_texto') ?></li>
						</ul>
						<form action="<?php echo get_bloginfo('url'); ?>/parceiros" method="post">
							<input type="hidden" name="plano" value="<?php echo $i++; ?>" />
							<input type="submit" class="get-started-btn" value="Fazer Pedido"/>
						</form>
					</div>
				</div>

			<?php endwhile; ?>

		</div>
	</div>
</section><!-- #pricing -->

	<?php 

     	else:
			echo "nao existe Section!";

			endif;
	?>

<!--==========================
About Us Section
============================-->

		
<section id="about">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="menu col-lg-6 wow fadeInLeft ">
						<h3 class="section-title"><?php echo get_field('tu_titulo'); ?></h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description">
							<?php echo get_field('tx_texto'); ?>
						</p>
						<a href="<?php echo get_field('li_link_do_botao'); ?>" class="pedir"><?php echo get_field('ti_titulo_do_botao'); ?></a>
					</div>			
					<div class="col-lg-6 about-img content wow fadeInRight">
						<?php $imagem = get_field('ig_image'); ?>
						<img src="<?php echo $imagem; ?>)">
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
						<?php $imagem = get_field('ia_image'); ?>
						<img src="<?php echo $imagem; ?>)">
					</div>	
					<div class="text col-lg-6 content wow fadeInRight">
						<h3 class="title"><?php echo get_field('to_titulo'); ?></h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description"><?php echo get_field('tt_texto'); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #team -->

<!--==========================
More Features Section
============================-->


	

<section id="more-features" class="homepage">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Parceiros</h3>
			<span class="section-divider"></span>
			<p class="section-description">Encontre alguns de nossos parceiros pela cidade</p>
		</div>

		<div class="row wow fadeInUp" id="parceirosHere">

		<?php 	
		
			$params = array(
				'limit'   => 15
			); 

			// Create and find in one shot 
			$parceiros = pods( 'parceiro', $params ); 

			if ( 0 < $parceiros->total() ):
				while ( $parceiros->fetch() ):
		?> 
			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
				<div style="background-image: url('<?php echo $parceiros->display('logomarca'); ?>');">
					
				</div>   
				<h4>
					<?php echo $parceiros->display('bairro'); ?>-
					<?php echo $parceiros->display('estado'); ?>
				</h4>									
			</div>

		<?php 
				endwhile; // end of books loop 
			endif;
		?>
				
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
		<div class="section-header">
			<h3 class="section-title">Contato</h3>
			<hr>
		</div>
		<?php echo do_shortcode('[contact-form-7 id="190" title="Formulario footer"]'); ?>
	</div>
</section><!-- #contact -->

</main>


<?php 
	endwhile;
endif; 

get_footer(); ?>