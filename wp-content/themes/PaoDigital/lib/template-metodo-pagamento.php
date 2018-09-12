<?php 
/*
template name: Modo de Pagamento
*/

get_header('interna');

?>


<!--==========================
Metodo Pagamento
============================-->

<section id="pagamento">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Método de Pagamento</h3>
			<span class="section-divider"></span>
		</div>

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

			<div class="col-md-6">
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

			<div class="col-md-3" id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
				<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: 29px; left: 982px;">
					<div id="cart_box">
						<h3>Your order <i class="icon_cart_alt pull-right"></i></h3>
						<table class="table table_summary">
							<tbody>
								<tr>
									<td>
										<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Enchiladas
									</td>
									<td>
										<strong class="pull-right">$11</strong>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Burrito
									</td>
									<td>
										<strong class="pull-right">$14</strong>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>1x</strong> Chicken
									</td>
									<td>
										<strong class="pull-right">$20</strong>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Corona Beer
									</td>
									<td>
										<strong class="pull-right">$9</strong>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#0" class="remove_item"><i class="icon_minus_alt"></i></a> <strong>2x</strong> Cheese Cake
									</td>
									<td>
										<strong class="pull-right">$12</strong>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<div class="row" id="options_2">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
								<label class=""><div class="iradio_square-grey checked" style="position: relative;"><input type="radio" value="" checked="" name="option_2" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Delivery</label>
							</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
								<label class=""><div class="iradio_square-grey" style="position: relative;"><input type="radio" value="" name="option_2" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Take Away</label>
							</div>
						</div><!-- Edn options 2 -->
						<hr>
						<table class="table table_summary">
							<tbody>
								<tr>
									<td>
										Subtotal <span class="pull-right">$56</span>
									</td>
								</tr>
								<tr>
									<td>
										Delivery fee <span class="pull-right">$10</span>
									</td>
								</tr>
								<tr>
									<td class="total">
										TOTAL <span class="pull-right">$66</span>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<a class="btn_full" href="cart_3.html">Confirm your order</a>
					</div><!-- End cart_box -->
				</div><!-- End theiaStickySidebar -->
			</div><!-- End col-md-3 -->

		</div>
	</div>
</section>


<?php get_footer(); ?>