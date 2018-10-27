<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

	if( !isset( $_SESSION['paodigital']['venda'] ) ):
		wp_redirect('/');
	endif;

	$pag = pods('venda', $_SESSION['paodigital']['venda'] );
	$pag = (object) $pag->row();

	if( $pag->pd_parceiros_id == 0 || is_null($pag->pd_parceiros_id) ):
		$_SESSION['message'] = "Começe escolhendo um Parceiro, digite seu CEP abaixo!";
		wp_redirect('/parceiros');
	endif;
/*
template name: Detalhes do seu pedido
*/
get_header('interna');
 
if (have_posts()) :
    while (have_posts()) : the_post();


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
										<?php 
											$user_cpf = get_user_meta( $user->id, 'user_cpf', true );
										?>
										<label for="tel_order">CPF</label>
										<input type="text" id="cpf_order" name="cpf" class="form-control" placeholder="999.999.999-99" value="<?php echo $user_cpf; ?>" required>
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="email" readonly="readonly" class="form-control" placeholder="Ex.: joao@silva.com" required value="<?php echo $user->user_email; ?>" />
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
														id="cep"
														data-id="1" 
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
													<input type="text" id="cidade1" name="address[1][city]" class="form-control" placeholder="Ex.: São Paulo" value="" required />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-10 col-sm-10">
												<div class="form-group">
													<label for="endereco1">Seu endereço completo</label>
													<input type="text" id="endereco1" name="address[1][address]" class="form-control" placeholder=" Ex.: Av. Paulista" required value="" />
												</div>
											</div>
											<div class="col-md-2 col-sm-2">
												<div class="form-group">
													<label for="num1">Nº</label>
													<input type="text" id="num1" name="address[1][num]" class="form-control" placeholder="" required value="" />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label for="complemento1">Complemento</label>
													<input type="text" id="complemento1" name="address[1][complemento]" class="form-control" placeholder=" Ex.: Apt 110" value="" required />
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="bairro1">Bairro</label>
													<input type="text" id="bairro1" name="address[1][bairro]" class="form-control" placeholder=" Ex.: 01311-000" required value="" />
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="form-group">
													<label for="uf1">Estado</label>
													<input type="text" id="uf1" name="address[1][state]" class="form-control" required placeholder="Ex.: São Paulo" value="" />
												</div>
											</div>
										</div>
											
										<div class="form-check">
											<label class="form-check-label">
											<input class="form-check-input" name="address[1][entrega]" checked="true" type="checkbox" value="1">
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
									<button type="button" id="addNewAddress" data-active="true" class="btn btn-primary">Adicionar Novo Endereço</button>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12">				
										<label>Notas para a padaria</label>
										<textarea class="form-control" style="height:150px" placeholder="Ex. reclamações, sugestões e elogios..." name="notes" id="notes"><?php echo $user->description; ?></textarea>		
									</div>
								</div>
								<div class="menu-order">
									<input type="hidden" name="saveme" value="tasalvo" />
									<input type="submit" name="save-address" value="Salvar Endereços" class="address-confirm" id="saveAddress"/>
								</div>
							</div>
						</form>
					</div>
		            
					<div class="sticky-sidebar col-md-5" id="sidebar" style="">
		            	<?php include(locate_template('sidebar-valores.php')); ?>
					</div>
            	</div>
			</div>
		</div>
	</div>
</section>


<?php 
	endwhile;
endif; 

?>

<script>
	(function($){

		$(document).on('change', ".form-check-input", function(){
			$(".form-check-input").attr("checked", false);
			$(this).attr("checked", true);
		});

		$(document).on('click', ".btremove", function(){
			console.log("#fieldset" + $(this).data('item'));
			$.post(ajax, {
				action: 'remove_address',
				address: $(this).data('id')
			}, function(){ }, 'html');
			var i = $(this).data('item');
			$("#fieldset" + i ).remove();
		});

		$(document).on('keyup input', ".cep", function(){
 			var val = $(this).val();
			var i = $(this).data('id');
 			if( val.length == 9 ){
 				$.get("https://viacep.com.br/ws/"+val+"/json/",{}, function(data){
					console.log("#bairro"+i);
					$("#bairro"+i).val(data.bairro);
					$("#cidade"+i).val(data.localidade);
					$("#uf"+i).val(data.uf);
					$("#endereco"+i).val(data.logradouro);

				}, 'json');
 			}
 		});
 		$(document).on('click', "#addNewAddress", function(){
 				console.log($(this).data('active'));
 			if( $(this).data('active') )
 			{
 				$(this).data('active', false); 
				$.post(ajax, {
					action: 'get_block_address',
					blocks: $("fieldset.addresses").length
				}, function(data){
					$("#addresses").append(data);
					$("#addNewAddress").data('active', true); 
				}, 'html');
 			}
		});
 		//all masks
		$(".cep").mask("00000-000");
		$("#tel_order").mask("00 00000-0000");
		$("#cpf_order").mask("000.000.000-00");



	})(jQuery);
</script>

<?php get_footer(); ?>
