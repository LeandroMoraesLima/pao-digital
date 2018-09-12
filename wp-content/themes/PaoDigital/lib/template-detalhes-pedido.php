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
            
			<div class="col-md-6">
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
				</div><!-- End box_style_1 -->
			</div><!-- End col-md-6 -->
            
			<div class="col-md-3" id="sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
            	<div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; top: -264px; left: 982px;">
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
							<label><div class="iradio_square-grey checked" style="position: relative;"><input type="radio" value="" checked="" name="option_2" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Delivery</label>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
							<label><div class="iradio_square-grey" style="position: relative;"><input type="radio" value="" name="option_2" class="icheck" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>Take Away</label>
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
					<a class="btn_full" href="cart_2.html">Go to checkout</a>
					<a class="btn_full_outline" href="detail_page.html"><i class="icon-right"></i> Add other items</a>
				</div><!-- End cart_box -->
                </div><!-- End theiaStickySidebar -->
			</div><!-- End col-md-3 -->            
		</div>
	</div>
</section>


<?php get_footer(); ?>