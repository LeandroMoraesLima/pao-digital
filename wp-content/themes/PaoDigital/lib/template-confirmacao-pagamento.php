<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

	if( !isset( $_SESSION['paodigital']['venda'] ) ):
		wp_redirect('/');
	endif;


/*
template name: Pedido Confirmado
*/

// echo "
// 	<div id='cat' style='width:100%; height: 100%; position: fixed; top: 0; left: 0; background-color: #66ceff; display: flex; justify-content: center; align-items: center; flex-direction: column; font-family: \"Open Sans\", sans-serif; font-size: 40px; color: #FFF; text-align: center;
// '>
// 		<img src='".IMG."/cat.gif' alt=''>
// 		Aguarde! <br>Estamos processando seu pagamento!
// 	</div>
// ";



get_header('interna');

if( isset($_POST['pagode']) && ( $_POST['pagode'] == 'dinheiro' || $_POST['pagode'] == 'refeicao' ) ):
	include(locate_template('lib/dinheiro.php'));
else:
	include(locate_template('lib/credit-card.php'));
endif;

?>

<script>
	(function($){

		$("#cat").css('display', 'none');

	})(jQuery);
</script>

<!--==========================
Confirmação de Pagamento
============================-->

<section id="confirmacao">
	<div class="col offset-md-3 col-md-6">
		<?php if( $payment->compra == true ): ?>
			<div class="box_style_2">
				<h2 class="inner">Pedido confirmado!</h2>
				<div class="confirm" id="confirm">
					<i class="icon_check_alt2"></i>
					<h3>Obrigado!</h3>
					<p>
						Lorem ipsum dolor sit amet, nostrud nominati vis ex, essent conceptam eam ad. Cu etiam comprehensam nec. Cibo delicata mei an, eum porro legere no.
					</p>
				</div>
				<h4>Resumo</h4>
				<table class="table table-striped nomargin">
					<tbody>

						<?php 
							$venda = pods('venda', $payment->venda );
							$tVenda = $venda->row();
							$whereItem = array(
						        'where'   => "venda_id = {$tVenda['id']}", 
						        'limit'   => -1
							);

							$itens = pods('item', $whereItem );
							$itens = $itens->data();

							if( is_array($itens) && count($itens) > 0 ):

								foreach ($itens as $key => $item) :
						?>


									<tr>
										<td>
											<strong><?php echo $item->quantidade; ?>x</strong> 
											<?php echo $item->nome; ?>
										</td>
										<td>
											<strong class="pull-right">
												<?php 
													echo "R$ ".number_format($item->valor_no_ato, 2, ',', '.'); 
												?>
											</strong>
										</td>
									</tr>

									
						<?php
								endforeach;

							endif;


							$entrega = get_payment_closed( $payment->venda );
						?>

									<tr>
										<td>
											<strong></strong> 
											Entrega
										</td>
										<td>
											<strong class="pull-right">
												<?php 
													echo $entrega['ventrega']; 
												?>
											</strong>
										</td>
									</tr>
						

						<tr>
							<td>
								Tempo Estimado 
								<i class="icon_question_alt"></i>
							
							</td>
							<td>
								<strong class="pull-right">45 minutos</strong>
							</td>
						</tr>
						<tr>
							<td class="total_confirm">
								TOTAL
							</td>
							<td class="total_confirm">
								<span class="pull-right">
									<strong style="font-size: 30px;">
									<?php 
										echo $entrega['vtotal']; 
									?>
									</strong>
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<a href="/" class="btn btn-success btn-block">Voltar a Pagina Inicial</a>
			</div>
		<?php else: ?>

			<div class="box_style_2">
				<h2 class="inner">Pedido Negado!</h2>	
				<div class="confirm" id="confirm">
					<i class="icon_check_alt2"></i>
					<h3>Desculpe! pedido Negado.</h3>
					<p>
						Lorem ipsum dolor sit amet, nostrud nominati vis ex, essent conceptam eam ad. Cu etiam comprehensam nec. Cibo delicata mei an, eum porro legere no.
					</p>
				</div>

				<a href="/" class="btn btn-success btn-block">Voltar a Pagina Inicial</a>
			</div>
		<?php endif; ?>
	</div>
</section>


<?php get_footer(); ?>