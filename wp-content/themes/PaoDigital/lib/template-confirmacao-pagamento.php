<?php 
/*
template name: Pedido Confirmado
*/

get_header('interna');
include(locate_template('lib/credit-card.php'));

?>

<!--==========================
Confirmação de Pagamento
============================-->

<section id="confirmacao">
	<div class="col offset-md-3 col-md-6">
		<?php if( $compra == true ): ?>
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
						<tr>
							<td>
								<strong>1x</strong> Café
							</td>
							<td>
								<strong class="pull-right">$11</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Pão
							</td>
							<td>
								<strong class="pull-right">$14</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>1x</strong> Torta
							</td>
							<td>
								<strong class="pull-right">$20</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Achocolatado
							</td>
							<td>
								<strong class="pull-right">$9</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Cheeseburger
							</td>
							<td>
								<strong class="pull-right">$12</strong>
							</td>
						</tr>
						<tr>
							<td>
								Agenda de entrega <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Please consider 30 minutes of margin for the delivery!"><i class="icon_question_alt"></i></a>
							</td>
							<td>
								<strong class="pull-right">Hoje às 07:30</strong>
							</td>
						</tr>
						<tr>
							<td class="total_confirm">
								TOTAL
							</td>
							<td class="total_confirm">
								<span class="pull-right">$66</span>
							</td>
						</tr>
					</tbody>
				</table>
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
			</div>
		<?php endif; ?>
	</div>
</section>


<?php get_footer(); ?>