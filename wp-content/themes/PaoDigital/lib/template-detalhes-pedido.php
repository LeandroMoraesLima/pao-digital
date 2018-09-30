<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;
/*
template name: Detalhes do seu pedido
*/
get_header('interna');

if(isset($_POST['cep1'])):
var_dump($_POST); die();
endif;
 
if (have_posts()) :
    while (have_posts()) : the_post();




$user = wp_get_current_user();


	$headers = array(
	    'Content-Type:application/x-www-form-urlencoded',
	    'Authorization: Basic '. base64_encode("ff8cf021-20df-458d-97c8-f733bacbe646:3c8a6d30-1604-4170-905a-3e8b5905ec23")
	);

	$url = "https://api-sandbox.getnet.com.br/auth/oauth/v2/token";

	$tk = base64_encode("ff8cf021-20df-458d-97c8-f733bacbe646:3c8a6d30-1604-4170-905a-3e8b5905ec23");
	$e = shell_exec("curl -X POST \
	https://api-sandbox.getnet.com.br/auth/oauth/v2/token \
	-H 'authorization: Basic {$tk}' \
	-H 'content-type: application/x-www-form-urlencoded' \
	-d 'scope=oob&grant_type=client_credentials'");

	$e = json_decode($e, true);


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
						<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" >
							<div class="box_style_2" id="order_process">
								<input type="hidden" name="action" value="contact_form">
								<h2 class="inner">Dados para Entrega</h2>
								<fieldset class="form-group">
	    							<legend>Dados pessoais</legend>
									<div class="form-group">
										<label>Primeiro nome</label>
										<input type="text" class="form-control" id="firstname_order" name="name" placeholder="Ex.: João" value="<?php echo $user->first_name; ?>" required />
										<?php $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://'; ?>
										<input type="hidden" name="url" value="<?php echo $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
									</div>
									<div class="form-group">
										<label>Último nome</label>
										<input type="text" class="form-control" id="lastname_order" name="lastname" placeholder="Ex.: da Silva" value="<?php echo $user->last_name; ?>" required />
									</div>
									<div class="form-group">
										<?php 
											$user_telefone = get_user_meta( $user->id, 'user_telefone', true );
										?>
										<label for="tel_order">Telefone / celular</label>
										<input type="text" id="tel_order" name="tel" class="form-control" placeholder="Ex.: 11 99999-9999" value="<?php echo $user_telefone; ?>" required>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" id="email_booking_2" name="email_order" class="form-control" placeholder="Ex.: joao@silva.com" required value="<?php echo $user->user_email; ?>" />
									</div>
								</fieldset>
								<hr>
								<div id="addresses">

									<?php 

										$id = get_current_user_id();

										$params = array(
											'where'		=> "user_id = {$id}", 
											'limit'		=> -1
										); 

										// Create and find in one shot 
										$add = pods( 'usuarioendereco', $params ); 
										$blocks = 1;
										if ( 0 < $add->total() ):
											while ( $add->fetch() ):

												include(locate_template('lib/template-address.php'));

												$blocks++;
											endwhile;
										else:
									?>



									<fieldset class="form-group addresses" id="fieldset1" >
		    							<legend>Endereço 1</legend>

										<div class="form-group">
											<label for="desc1">Descrição</label>
											<input type="text" id="desc1" name="address[1][desc]" class="form-control" placeholder="Casa, Escritório, Club..." value="" />
											<input type="hidden" name="address[1][house]" value="0" />
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="cep1">CEP</label>
													<input 
														type="text" 
														id="cep1" 
														name="address[1][cep]" 
														class="form-control cep"
														placeholder=" Ex.: 01311-000" 
														value="<?php echo $user->user_cep; ?>"
														required
													/>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="cidade1">Cidade</label>
													<input type="text" id="cidade1" name="address[1][city]" class="form-control" placeholder="Ex.: São Paulo" value="" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-10 col-sm-10">
												<div class="form-group">
													<label for="endereco1">Seu endereço completo</label>
													<input type="text" id="endereco1" name="address[1][address]" class="form-control" placeholder=" Ex.: Av. Paulista" value="" />
												</div>
											</div>
											<div class="col-md-2 col-sm-2">
												<div class="form-group">
													<label for="num1">Nº</label>
													<input type="text" id="num1" name="address[1][num]" class="form-control" placeholder="" value="" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="bairro1">Bairro</label>
													<input type="text" id="bairro1" name="address[1][bairro]" class="form-control" placeholder=" Ex.: 01311-000" value="" />
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="uf1">Estado</label>
													<input type="text" id="uf1" name="address[1][state]" class="form-control" placeholder="Ex.: São Paulo" value="" />
												</div>
											</div>
										</div>
											
										<div class="form-check">
											<label class="form-check-label">
											<input class="form-check-input" name="entrega" checked="true" type="radio" value="1">
												Escolher este como endereço de entrega
											</label>
										</div>
									</fieldset>




									<?php
										endif;

									?>
									

								</div>
								<hr>
								<div class="text-right">
									<button type="button" id="addNewAddress" class="btn btn-primary">Adicionar Novo Endereço</button>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">				
										<label>Notas para a padaria</label>
										<textarea class="form-control" style="height:150px" placeholder="Ex. reclamações, sugestões e elogios..." name="notes" id="notes"><?php echo $user->description; ?></textarea>		
									</div>
								</div>
								<div class="menu-order">
									<input type="submit" name="save-address" value="Salvar Endereços" class="address-confirm" />
								</div>
							</div>
						</form>
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
								<script async src="https://checkout-homologacao.getnet.com.br/loader.js"
									data-getnet-sellerid="38da9229-8bb5-4cf4-a728-bf702e565144"
									data-getnet-token="<?php echo $e['access_token']; ?>"
									data-getnet-amount="25.00"
									data-getnet-customerid="12345"
									data-getnet-orderid="12345"
									data-getnet-button-class="pay-button-getnet"
									data-getnet-installments="4"
									data-getnet-customer-first-name="João"
									data-getnet-customer-last-name="da Silva"
									data-getnet-customer-document-type="CPF"
									data-getnet-customer-document-number="22233366638"
									data-getnet-customer-email="teste@getnet.com.br"
									data-getnet-customer-phone-number="1134562356"
									data-getnet-customer-address-street="Rua Alexandre Dumas"
									data-getnet-customer-address-street-number="1711"
									data-getnet-customer-address-complementary=""
									data-getnet-customer-address-neighborhood="Chacara Santo Antonio"
									data-getnet-customer-address-city="São Paulo"
									data-getnet-customer-address-state="SP"
									data-getnet-customer-address-zipcode="04717004"
									data-getnet-customer-country="Brasil"
									data-getnet-shipping-address='[{ "first_name": "João", "name": "João Borgas", "email": "joaoborgas@gmail.com", "phone_number": "", "shipping_amount": 10, "address": { "street": "Rua dos Pagamentos", "complement": "", "number": "171", "district": "Centro", "city": "São Paulo", "state": "SP", "country": "Brasil", "postal_code": "12345678"}}]'
									data-getnet-items='[{"name": "","description": "", "value": 0, "quantity": 0,"sku": ""}]'
									data-getnet-url-callback="http://paodigital.lo/sucesso"
									data-getnet-pre-authorization-credit="">
								</script>	
								<div class="menu-order">
									<a href="#" class="menu-order-confirm pay-button-getnet"  >
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

		$(document).on('keyup', ".cep", function(){

			var val = $(this).val();
			var i = $(this).data('id');

			if( val.length == 9 ){

				$.get("https://viacep.com.br/ws/"+val+"/json/",{}, function(data){
					console.log(data);
					$("#bairro"+i).val(data.bairro);
					$("#cidade"+i).val(data.localidade);
					$("#uf"+i).val(data.uf);
					$("#endereco"+i).val(data.logradouro);
				}, 'json');

			}

		});

		$(document).on('click', "#addNewAddress", function(){
			$.post(ajax, {
				action: 'get_block_address',
				blocks: $("fieldset.addresses").length
			}, function(data){
				$("#addresses").append(data);
			}, 'html');
		});


		//all masks
		$(".cep").mask("00000-000");
		$("#tel_order").mask("00 00000-0000");
		


	})(jQuery);
</script>


<?php 
	endwhile;
endif; 

?>

<?php get_footer(); ?>
