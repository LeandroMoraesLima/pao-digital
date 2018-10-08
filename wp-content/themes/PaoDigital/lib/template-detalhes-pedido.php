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

<?php get_footer(); ?>
