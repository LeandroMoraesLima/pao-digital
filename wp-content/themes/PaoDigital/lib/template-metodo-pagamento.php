<?php 
/*
template name: Modo de Pagamento
*/
if (have_posts()) :
    while (have_posts()) : the_post();

get_header('interna');

?>

<!--==========================
Metodo Pagamento
============================-->

<section id="pagamento">
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
						<div class="box_style_2">
							<h2 class="inner">Métodos de Pagamento</h2>
							<div class="payment_select">
								<label class="payment">
									<div class="iradio_square-grey checked" style="position: relative;">		<input type="radio" value="" checked="" name="payment_method" class="	 icheck" style="position: absolute; opacity: 0;">
										<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">										
										</ins>
									</div>							
										Cartão de crédito
								</label>
								<span class="dashicons dashicons-feedback"></span>
							</div>
							<div class="form-group">
								<label>Nome</label>
								<input type="text" class="form-control" id="name_card_order" name="name_card_order" placeholder="First and last name">
							</div>
							<div class="form-group">
								<label>Número do cartão</label>
								<input type="text" id="card_number" name="card_number" class="form-control" placeholder="Card number">
							</div>
							<div class="row">
								<div class="col-md-6 form-group">
									<label>Data</label>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="mm">
											</div>
										</div>
										<div class="col-md-6 col-sm-6">
											<div class="form-group">
												<input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="yyyy">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>Código de segurança</label>
										<div class="row">
											<div class="col-md-4 col-sm-6">
												<div class="form-group">
													<input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
												</div>
											</div>
											<div class="col-md-8 col-sm-6">
												<img src="<?php echo IMG; ?>/icon_ccv.gif" width="50" height="29" alt="ccv">										
												<small>Últimos 3 dígitos</small>
											</div>
										</div>
									</div>
								</div>
							</div><!--End row -->
							<div class="payment_select" id="paypal">
								<label class="payment">
									<div class="iradio_square-grey" style="position: relative;">
										<input type="radio" value="" name="payment_method" class="icheck" style="position: absolute; opacity: 0;">
										<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">	
										</ins>
									</div>
										Pague com UOL
								</label>
								<img src="<?php echo IMG; ?>/uol-logo.png" width="22" height="20" alt="ccv">
							</div>
							<div class="payment_select nomargin">
								<label class="payment">
									<div class="iradio_square-grey" style="position: relative;">
										<input type="radio" value="" name="payment_method" class="icheck" style="position: absolute; opacity: 0;">
										<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;">									
										</ins>
									</div>
										Pague com dinheiro
								</label>
								<i class="fa fa-wallet"></i>
							</div>
						</div><!-- End box_style_1 -->
					</div><!-- End col-md-6 -->

					<div class="sticky-sidebar col-md-5" id="sidebar">
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
									<a href="<?php echo get_bloginfo('url'); ?>/confirmacao" class="menu-order-confirm" >
										Confirmar Pedido
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