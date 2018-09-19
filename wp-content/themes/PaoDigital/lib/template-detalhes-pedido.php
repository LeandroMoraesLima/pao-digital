<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;
/*
template name: Detalhes do seu pedido
*/
 
if (have_posts()) :
    while (have_posts()) : the_post();


get_header('interna');


$user = wp_get_current_user();


?>

<!--==========================
Detalhes do seu pedido
============================-->

<section id="pedido">
	<div class="container">
		<div class="row" style="transform: none;">
			<div class="col-md-3">
				<div class="box_style_2 hidden-xs info">
					<h4 class="nomargin_top"><?php echo get_field('ti_titulo1','options') ?><span class="dashicons dashicons-clock"></span></h4>
					<p>
						<?php echo get_field('te_texto1','options') ?>
					</p>
					<hr>
					<h4 class="nomargin_top"><?php echo get_field('ti_titulo2','options') ?><span class="dashicons dashicons-feedback"></span></h4>
					<p>
						<?php echo get_field('te_texto2','options') ?>
					</p>
				</div><!-- End box_style_2 -->
			</div><!-- End col-md-3 -->
            <div class="col-md-9">
            	<div class="row">
					<div class="col-md-7">
						<div class="box_style_2" id="order_process">
							<h2 class="inner">Dados para Entrega</h2>
							<div class="form-group">
								<label>Primeiro nome</label>
								<input type="text" class="form-control" id="firstname_order" name="firstname_order" placeholder="Ex.: João" value="<?php echo $user->first_name; ?>" />
							</div>
							<div class="form-group">
								<label>Último nome</label>
								<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Ex.: da Silva" value="<?php echo $user->last_name; ?>" />
							</div>
							<div class="form-group">
								<label>Telefone / celular</label>
								<input type="text" id="tel_order" name="tel_order" class="form-control" placeholder="Ex.: +55 00 9000-0000">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email_booking_2" name="email_order" class="form-control" placeholder="Ex.: joao@silva.com" value="<?php echo $user->user_email; ?>" />
							</div>
							<div class="form-group">
								<label>Seu endereço completo</label>
								<input type="text" id="address_order" name="address_order" class="form-control" placeholder=" Ex.: Av. Paulista" value="<?php echo $user->user_address; ?>" />
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Cidade</label>
										<input type="text" id="city_order" name="city_order" class="form-control" placeholder="Ex.: São Paulo" value="<?php echo $user->user_cidade; ?>" />
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>CEP</label>
										<input type="text" id="pcode_oder" name="pcode_oder" class="form-control" placeholder=" Ex.: 01311-000" value="<?php echo $user->user_cep; ?>" />
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">				
									<label>Notas para a padaria</label>
									<textarea class="form-control" style="height:150px" placeholder="Ex. reclamações, sugestões e elogios..." name="notes" id="notes" value="<?php echo $user->user_notes; ?>" /></textarea>		
								</div>
							</div>
						</div>
					</div>
		            
					<div class="sticky-sidebar col-md-5" id="sidebar" style="">
		            	<div class="user-order-holder">
							<div class="user-order">
								<ul id="myItens">
									<h4 class="text-center">
										Seu pedido
										<span class="dashicons dashicons-cart"></span>
									</h4>
									<div class="text-center" id="mitens">
										Seu carrinho esta vazio
									</div>
								</ul>		            
								<div class="price-area dev-menu-price-con" data-vatsw="on" data-vat="13">
									<ul>
										
										<li> Sub Total Do Produto
											<span class="price">
												<span class="dev-menu-subtotal" id="subtotal">R$ 0,00</span>
											</span>
										</li>
										<li class="restaurant-fee-con">
											<span class="fee-title">Taxa De Entrega</span>
											<span class="price">
												<span class="dev-menu-subtotal" id="entrega">R$ 0,00</span>
											</span>
										</li>
										<li>Total
											<span class="price">
												<span class="dev-menu-subtotal" id="total">R$ 0,00</span>
											</span>
										</li>
										<li class="tempo">Tempo De Entrega Estimado:
											<span class="price">
												<span class="dev-menu-subtotal">40-60 min</span>
											</span>
										</li>
									</ul>
								</div>
								<div class="input-group mb-3">
									<input type="text" class="form-control" placeholder="Insira o voucher aqui" aria-label="Recipient's username" aria-describedby="basic-addon2">
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2">OK</span>
									</div>
									<div class="atecao">
										<p>
											<span><?php echo get_field('tt_titulo','options') ?></span> 
											<?php echo get_field('te_texto','options') ?>
										</p>
									</div>
								</div>
								<div class="menu-order">
									<a href="<?php echo get_bloginfo('url'); ?>/formas-de-pagamento" class="menu-order-confirm" >
										Forma de Pagamento
									</a>
								</div>
							</div>
						</div>
					</div>
            	</div>
			</div>
		</div>
	</div>
</section>


<?php 

	//funcao que resguarda pagamento atraves da $_SESSION
	send_payment();

?>


<script type="text/javascript">
	(function($){

		$(document).ready(function(){
			$.post(ajax, {
				action: 'get_the_cart'
			}, function(data){
				$('#mitens').html(data.html);
				$("#subtotal").html(data.subtotal);
				$("#total").html(data.vtotal);
			}, 'json');
		});


		$(document).on("click", ".add_product_to_kart", function(){
			var id = $(this).data('id');
			$.post(ajax, {
				action: 'add_to_cart',
				product: id
			}, function(data){
				$('#mitens').html(data.html);
				$("#subtotal").html(data.subtotal);
				$("#total").html(data.vtotal);
			}, 'json');
		});


		$(document).on("click", ".remove_product_to_kart", function(){
			var id = $(this).data('id');
			$.post(ajax, {
				action: 'remove_to_cart',
				product: id
			}, function(data){
				$('#mitens').html(data.html);
				$("#subtotal").html(data.subtotal);
				$("#total").html(data.vtotal);
			}, 'json');
		});

	})(jQuery);
</script>


<?php 
	endwhile;
endif; 

?>

<?php get_footer(); ?>
