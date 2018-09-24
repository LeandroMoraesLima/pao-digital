<?php get_header(); 

	if (have_posts()) :
	    while (have_posts()) : the_post();
				
		$imagem = get_field('sl_sliders');

		$mylogin = ( !is_user_logged_in() )? 'lrm-login': '';
?>



<!--==========================
Intro Section
============================-->


<section id="intro" style="background-image: url('<?php echo $imagem; ?>')">

	<div class="intro-text">
		<h2><?php echo get_field('ti_titulo'); ?></h2>
		<p><?php echo get_field('st_sub_titulo'); ?></p>
		<a class="btn-get-started scrollto" href="/#features">
			<?php echo get_field('tb_titulo_do_botao'); ?>
		</a>
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
								<a href="#more-features">
									<?php echo get_sub_field('nu_number') ?>
								</a>
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
							<?php if( !is_user_logged_in() ): ?>
								<input type="button" class="lrm-login get-started-btn" value="Fazer Pedido"/>
							<?php else: ?>
									<input type="hidden" name="plano" value="<?php echo $i++; ?>" />
									<input type="submit" class="get-started-btn" value="Fazer Pedido"/>
							<?php endif; ?>
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
<style>
	input.yellow {
		background: linear-gradient(45deg, #ffb600, #ffb600);
		display: inline-block;
		padding: 6px 30px;
		border-radius: 20px;
		color: #fff;
		transition: none;
		font-size: 14px;
		font-weight: 400;
		font-family: "Montserrat", sans-serif;
		cursor: pointer;
	}
	input.yellow:hover {
		background: #515e61;
	}
</style>
		
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
						<?php if( !is_user_logged_in() ): ?>
							<a href="#" class="lrm-login pedir">
								<?php echo get_field('ti_titulo_do_botao'); ?>
							</a>
						<?php else: ?>
							<form action="<?php echo get_bloginfo('url'); ?>/parceiros" method="post">
								<input type="hidden" name="type" value="home" />
								<input type="submit" class="get-started-btn yellow" value="Pedir Agora"/>
							</form>
						<?php endif; ?>
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
						<?php if( !is_user_logged_in() ): ?>
							<form action="<?php echo get_bloginfo('url'); ?>/parceiros" method="post">
								<input type="hidden" name="type" value="drive" />
								<input type="button" class="lrm-login get-started-btn yellow" value="Pedir Agora"/>
							</form>
						<?php else: ?>
							<form action="<?php echo get_bloginfo('url'); ?>/parceiros" method="post">
								<input type="hidden" name="type" value="drive" />
								<input type="submit" class="get-started-btn yellow" value="Pedir Agora"/>
							</form>
						<?php endif; ?>
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
	
		<?php if( current_user_can('administrator')): ?>
			<form action="<?php echo get_bloginfo('url'); ?>" id="formParceiros" method="post">
		<?php endif; ?>

			<div class="row wow fadeInUp" id="parceirosHere">


		<?php 	
			if( current_user_can('administrator')):
				$params = array(
					'orderby'	=> 'home_order ASC'
				); 
			else:
				$params = array(
					'orderby'	=> 'home_order ASC',
					'where'		=> 'presente_na_homepage = 1'
				); 
			endif;
			

			// Create and find in one shot 
			$parceiros = pods( 'parceiro', $params ); 
			$i = 1;

			if ( 0 < $parceiros->total() ):
				while ( $parceiros->fetch() ):
		?> 
			


			<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15" id="parceiro-<?php echo $i; ?>" data-id="<?php echo $i; ?>">  
				<div style="background-image: url('<?php echo $parceiros->display('logomarca'); ?>');">
					
				</div>   
				<h4>
					<?php echo $parceiros->display('bairro'); ?>-
					<?php echo $parceiros->display('estado'); ?>
				</h4>
				<?php if( current_user_can('administrator')): ?>
					<div class="text-center">
						<input type="number" class="nposition" min="1" max="<?php echo $parceiros->total(); ?>" name="ordem[<?php echo $parceiros->display('id'); ?>][position]" style="max-width:50px;" value="<?php echo $i; ?>" />
						<button class="nbutton" data-i="<?php echo $i; ?>" style="opacity:0; cursor: pointer; border: none; background-color:#ffb600; color: #FFF;">Salvar</button>
						<div class="col-md-12">
							<label for="">Mostrar</label>
							<input type="checkbox" <?php echo ($parceiros->display('presente_na_homepage') == 'Yes') ? 'checked="checked"' : ''; ?> name="ordem[<?php echo $parceiros->display('id'); ?>][home]"  />
						</div>
					</div>
				<?php endif; ?>									
			</div>

			

			
		<?php 
					$i++;
				endwhile; // end of books loop 
			endif;
		?>







		</div>	
	<?php if( current_user_can('administrator')): ?>
		
		</form>
		<div class="col-md-12 text-center">
			<button id="salvaOrdem" style="display:none; cursor: pointer; border: none; background-color:#ffb600; color: #FFF; padding: 20px 40px;">Salvar Organização</button>
		</div>

	<?php else: ?>

		<div class="col-md-12">
			<div class="botao">
				<?php if( !is_user_logged_in() ): ?>
					<a href="/" class="lrm-login ver">Ver todos parceiros</a>
				<?php else: ?>
					<a href="<?php echo get_bloginfo('url'); ?>/parceiros" class="ver">Ver todos parceiros</a>
				<?php endif; ?>
			</div>	
		</div>

	<?php endif; ?>
</section><!-- #more-features -->


<?php if( current_user_can('administrator')): ?>
	<script>
		(function($){

			$(document).on("keyup change click",".nposition", function(){
				var parent = $(this).parent('div');
				$('button', parent).css('opacity', '1');
			});

			$(document).on("click", ".nbutton", function(){
				var i = $(this).data('i');
				var dvTotal = $("#parceiro-"+i);
				var position = $("div .nposition",dvTotal).val();
				var clone = $(dvTotal).clone();
				$(dvTotal).remove();
				if( position == 1 ){
					$("#parceirosHere > div:nth-child("+ ( 1 ) +")").before(clone);
				} else {
					
					$("#parceirosHere > div:nth-child("+ ( position - 1 ) +")").after(clone);
				}

				$.each( $("#parceirosHere > div"), function(e,l){
					$( ".nposition" ,l).val(e + 1);
				});

				$("#salvaOrdem").css('display', "inline-block");
			});

			$(document).on('change', 'input[type=checkbox]', function(){
				$("#salvaOrdem").css('display', "inline-block");
			});

			$(document).on("click", "#salvaOrdem", function(){

				var it = $("#formParceiros").serialize();
				$.post(ajax, {
					action: 'save_order_of_partners',
					itens: it,
					type: 'home'
				}, function(data){
					
				}, 'json');
			});

		})(jQuery);
	</script>
<?php endif; ?>
	

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