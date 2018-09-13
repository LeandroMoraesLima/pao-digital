<?php 
/*
template name: Cardápio
*/

get_header('interna');


if( !isset( $_SESSION['paodigital']['parceiro'] ) || $_SESSION['paodigital']['parceiro'] == '' || $_SESSION['paodigital']['parceiro'] != $_POST['parceiro'] ):
	$_SESSION['paodigital']['parceiro'] = $_POST['parceiro'];
endif;


$parceiro_prm = array(
	'where'   => 't.id = ' . $_POST['parceiro']
); 

$cardapio_prm = array(
	'where'   => 't.parceiro_id = ' . $_POST['parceiro']
); 
// Create and find in one shot 
$parceiros = pods( 'parceiro', $parceiro_prm ); 

$cardapios = pods( 'cardapio', $cardapio_prm );



?>

<!--==========================
menu Section
============================-->
<section id="menu">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Cardápio</h3>
			<span class="section-divider"></span>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="Prato">
									<input type="text" class="botao form-control mb-2" id="searchProducts" placeholder="Prato,ingrediente, etc...">
									<i class="fa fa-search"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="accordion" id="accordionExample">
									<div class="card">
										<div class="card-header" id="headingOne">
											<h5 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												<?php echo $parceiros->display('nome'); ?>
												</button>
											</h5>
										</div>
										<div id="collapseOne" class="collapse-show" aria-labelledby="headingOne" data-parent="#accordionExample">
											<div class="card-body" id="allProducts">
												<ul>



<?php
	if ( 0 < $cardapios->total() ):
		while ( $cardapios->fetch() ):
		
			include(locate_template('lib/template-products.php'));
		
		endwhile;
	endif;
?>



												</ul>
											</div>
										</div>
									</div>  
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="sticky-sidebar col-md-4 col-sm-12 col-xs-12">
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
									<span>Atenção:</span> 
									Vouchers são válidos apenas para pagamento online
								</p>
							</div>
						</div>
						<div class="menu-order">
							<a href="/dados-para-entrega" class="menu-order-confirm" >
								Dados para entrega
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>
</section>


<script type="text/javascript">
	(function($){

		$(document).on("keyup", "#searchProducts", function(){
			var val = this.value;
			if( val.length > 3 || val.length == 0 ){

				$.post(ajax, {
					action: 'search_products',
					s: val
				}, function(data){
					$("#allProducts ul").html(data);
				}, 'html');

			}
		});

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

	})(jQuery);
</script>



<?php get_footer(); ?>