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
			<?php 
				global $post;
				$tpl =  get_page_template_slug( $post->ID );

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
	</div>
</div>

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
				}, 'json');
			}
		}


		$(document).on("keyup input", "#searchProducts", function(){
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

		$(document).on('keyup input', ".cep", function(){

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