<?php 
	global $post;
	$tpl =  get_page_template_slug( $post->ID );
	$st = ( $tpl == "lib/template-metodo-pagamento.php" )? "style='margin-bottom:0px;'" : '';
?>
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
		<div class="price-area dev-menu-price-con" data-vatsw="on" data-vat="13" <?php echo $st; ?> >
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
				<li class="restaurant-fee-con descupom" style="display: none;">
					<span class="fee-title">Desconto (cupons)</span>
					<span class="price">
						<span class="dev-menu-subtotal" id="cdesconto">R$ 0,00</span>
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
<?php 
	if( $tpl !== "lib/template-metodo-pagamento.php" ):
?>

		<?php $mycp = (isset($_SESSION['paodigital']['cupom']))? $_SESSION['paodigital']['cupom'] : ''; ?>
		<div class="input-group mb-3">
			<input type="text" class="form-control" style="text-transform: uppercase;" placeholder="Insira o voucher aqui" id='insertCupom' value="<?php echo $mycp; ?>" />
			<div class="input-group-append" style="cursor: pointer;">
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
			<div id="msgcup"></div>
			<?php

				if( $tpl == "template-cardapio.php" ):
					$url = get_bloginfo('url') . "/detalhes-do-seu-pedido";
				elseif( $tpl == "lib/template-detalhes-pedido.php"):
					$url = get_bloginfo('url') . "/formas-de-pagamento";
				endif;


			?>
			<a href="<?php echo $url; ?>" class="menu-order-confirm" >
				Dados para entrega
			</a>
		</div>

<?php endif; ?>

	</div>
</div>

<?php 

	$pag = pods('venda', $_SESSION['paodigital']['venda'] );
	$pag = (object) $pag->row();
	$theparca = $pag->pd_parceiros_id;

?>

<script type="text/javascript">
	(function($){

		window.cart = {

			get_the_cart: function()
			{
				$.post(ajax, {
					action: 'get_the_cart'
				}, function(data){
					$('#mitens').html(data.html);
					$("#subtotal").html(data.subtotal);
					$("#total").html(data.vtotal);
					$("#entrega").html(data.ventrega);
					if( data.hasvouch == true ){
						$(".descupom").css('display', 'block');
						$("#cdesconto").html(data.voucher);
					}
				}, 'json');
			}
		}


		$(document).on("keyup input", "#searchProducts", function(){
			var val = this.value;
			if( val.length > 1 || val.length == 0 ){

				$.post(ajax, {
					action: 'search_products',
					s: val,
					parca: <?php echo $theparca; ?>
				}, function(data){
					$("#accordionExample").html(data);
				}, 'html');

			}
		});

		$(document).ready(function(){
			cart.get_the_cart();
		});


		$(document).on("click", ".add_product_to_kart", function(){
			var id = $(this).data('id');
			$.post(ajax, {
				action: 'add_to_cart',
				product: id
			}, function(){

				console.log('added to cart');
				cart.get_the_cart();

			}, 'html');
		});

		$(document).on("click", ".remove_product_to_kart", function(){
			var id = $(this).data('id');
			$.post(ajax, {
				action: 'remove_to_cart',
				product: id
			}, function(data){

				console.log('added to cart');
				cart.get_the_cart();

			}, 'html');
		});

		$(document).on('click', "#basic-addon2", function(){
			var tag = $("#insertCupom").val();
			$.post(ajax, {
				action: 'add_cupom',
				tag: tag
			}, function(data){

				$("#msgcup").html('<div class="alert alert-'+data.status+'" role="alert">'+data.msg+'</div>');
				if( data.status == 'info' ){
					cart.get_the_cart();

				}

			}, 'json');
		});

		

	})(jQuery);
</script>