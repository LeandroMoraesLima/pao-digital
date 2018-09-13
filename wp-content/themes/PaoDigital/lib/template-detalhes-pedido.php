<?php 
/*
template name: Detalhes do seu pedido
*/

get_header('interna');

?>

<!--==========================
Detalhes do seu pedido
============================-->

<section id="pedido">
	<div class="container">
		<div class="row" style="transform: none;">
			<div class="col-md-3">
				<div class="box_style_2 hidden-xs info">
					<h4 class="nomargin_top">Drive Thru<span class="dashicons dashicons-clock"></span></h4>
					<p>
						Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
					</p>
					<hr>
					<h4 class="nomargin_top">Pagamento Seguro<span class="dashicons dashicons-feedback"></span></h4>
					<p>
						Lorem ipsum dolor sit amet, in pri partem essent. Qui debitis meliore ex, tollit debitis conclusionemque te eos.
					</p>
				</div><!-- End box_style_2 -->

				<div class="box_style_2 hidden-xs" id="help">
					<span class="dashicons dashicons-editor-help"></span>
					<h4>Posso <span>ajudar?</span></h4>
					<a href="tel://004542344599" class="phone">+55 999 999 999</a>
					<small>Segunda a sexta: das 09:00h às 19:30h</small>
				</div>
			</div><!-- End col-md-3 -->
            <div class="col-md-9">
            	<div class="row">
					<div class="col-md-7">
						<div class="box_style_2" id="order_process">
							<h2 class="inner">Detalhes do seu pedido</h2>
							<div class="form-group">
								<label>Primeiro nome</label>
								<input type="text" class="form-control" id="firstname_order" name="firstname_order" placeholder="Ex.: João">
							</div>
							<div class="form-group">
								<label>Último nome</label>
								<input type="text" class="form-control" id="lastname_order" name="lastname_order" placeholder="Ex.: da Silva">
							</div>
							<div class="form-group">
								<label>Telefone / celular</label>
								<input type="text" id="tel_order" name="tel_order" class="form-control" placeholder="Ex.: +55 00 9000-0000">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email_booking_2" name="email_order" class="form-control" placeholder="Ex.: joao@silva.com">
							</div>
							<div class="form-group">
								<label>Seu endereço completo</label>
								<input type="text" id="address_order" name="address_order" class="form-control" placeholder=" Ex.: Av. Paulista">
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Cidade</label>
										<input type="text" id="city_order" name="city_order" class="form-control" placeholder="Ex.: São Paulo">
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>CEP</label>
										<input type="text" id="pcode_oder" name="pcode_oder" class="form-control" placeholder=" Ex.: 01311-000">
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Dia de entrega</label>
										<select class="form-control" name="delivery_schedule_day" id="delivery_schedule_day">
											<option value="" selected="">Selecione o dia</option>
											<option value="Today">Hoje</option>
											<option value="Tomorrow">Amanhã</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div class="form-group">
										<label>Tempo de entrega</label>
										<select class="form-control" name="delivery_schedule_time" id="delivery_schedule_time">
											<option value="" selected="">Selecione o horário</option>
											<option value="11.30am">11.30am</option>
											<option value="11.45am">11.45am</option>
											<option value="12.15am">12.15am</option>
											<option value="12.30am">12.30am</option>
											<option value="12.45am">12.45am</option>
											<option value="01.00pm">01.00pm</option>
											<option value="01.15pm">01.15pm</option>
											<option value="01.30pm">01.30pm</option>
											<option value="01.45pm">01.45pm</option>
											<option value="02.00pm">02.00pm</option>
											<option value="07.00pm">07.00pm</option>
											<option value="07.15pm">07.15pm</option>
											<option value="07.30pm">07.30pm</option>
											<option value="07.45pm">07.45pm</option>
											<option value="08.00pm">08.00pm</option>
											<option value="08.15pm">08.15pm</option>
											<option value="08.30pm">08.30pm</option>
											<option value="08.45pm">08.45pm</option>
										</select>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-12">				
									<label>Notas para a padaria</label>
									<textarea class="form-control" style="height:150px" placeholder="Ex. reclamações, sugestões e elogios..." name="notes" id="notes"></textarea>		
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
											<span>Ateção:</span> 
											Vouchers são válidos apenas para pagamento online
										</p>
									</div>
								</div>
								<div class="menu-order">
									<a href="/formas-de-pagamento" class="menu-order-confirm" >
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


		

	})(jQuery);
</script>


<?php get_footer(); ?>