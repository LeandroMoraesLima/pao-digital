<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

	if( !isset( $_SESSION['paodigital']['venda'] ) ):
		wp_redirect('/');
	endif;


/*
template name: Modo de Pagamento
*/
if (have_posts()) :
    while (have_posts()) : the_post();

get_header('interna');


$user = wp_get_current_user();



//send_payment();



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
							<form action="<?php echo get_bloginfo('url') . '/pagamento'; ?>" method="post">
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
									<label>Nome *</label>
									<input type="text" class="form-control" id="name_card_order" name="card_name" placeholder="Como esta escrito no cartão">
									<span>qualquer nome</span>
								</div>
								<div class="form-group">
									<label>Número do cartão *</label>
									<input type="text" id="card_number" name="card_number" class="form-control" placeholder="0000 0000 0000 0000">
									<span>use: 5155901222280001 p/ autorizado <br>
											use: 5155901222270002 p/ nao autorizado</span>
								</div>
								<div class="row">
									<div class="col-md-5 form-group">
										<label>Validade</label>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="MM" max="12">
													<span>acima de 10</span>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="AA" max="<?php echo ( date('y') + 7 ); ?>">
													<span>acima de 18</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-7 col-sm-12">
										<div class="form-group">
											<label>Código de segurança</label>
											<div class="row">
												<div class="col-md-4 col-sm-6">
													<div class="form-group">
														<input type="text" id="ccv" max="3" name="ccv" class="form-control" placeholder="CCV" maxlength="3">
														<span>quaisquer 3 digitos</span>
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
								<div class="menu-order">
									<input type="submit" name="save-address" value="Finalizar Pagamento" class="address-confirm" />
								</div>
							</form>
						</div><!-- End box_style_1 -->
					</div><!-- End col-md-6 -->

					<div class="sticky-sidebar col-md-5" id="sidebar">
						<!-- <div class="user-order-holder">
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
								<div style="margin-bottom:0px;" class="price-area dev-menu-price-con" data-vatsw="on" data-vat="13">
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
												<span class="dev-menu-subtotal">
													<?php echo get_field('tempo-estimado', 'options'); ?>
												</span>
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div> -->
						<?php include(locate_template('sidebar-valores.php')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	(function($){

		// $(document).ready(function(){
		// 	$.post(ajax, {
		// 		action: 'get_the_cart'
		// 	}, function(data){
		// 		$('#mitens').html(data.html);
		// 		$("#subtotal").html(data.subtotal);
		// 		$("#total").html(data.vtotal);
		// 	}, 'json');
		// });


		// $(document).on("click", ".add_product_to_kart", function(){
		// 	var id = $(this).data('id');
		// 	$.post(ajax, {
		// 		action: 'add_to_cart',
		// 		product: id
		// 	}, function(data){
		// 		$('#mitens').html(data.html);
		// 		$("#subtotal").html(data.subtotal);
		// 		$("#total").html(data.vtotal);
		// 	}, 'json');
		// });

		// $(document).on("click", ".remove_product_to_kart", function(){
		// 	var id = $(this).data('id');
		// 	$.post(ajax, {
		// 		action: 'remove_to_cart',
		// 		product: id
		// 	}, function(data){
		// 		$('#mitens').html(data.html);
		// 		$("#subtotal").html(data.subtotal);
		// 		$("#total").html(data.vtotal);
		// 	}, 'json');
		// });

		$("#card_number").mask("0000 0000 0000 0000");
		$("#expire_month").mask("00");
		$("#expire_year").mask("00");
		$("#ccv").mask("000");

	})(jQuery);
</script>

<?php 
	endwhile;
endif; 

?>

<?php get_footer(); ?>