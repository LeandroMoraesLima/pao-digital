<?php 
/*
template name: Pedido Confirmado
*/

get_header('interna');

?>


<!--==========================
Confirmação de Pagamento
============================-->

<section id="pagamento">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Pedido Confirmado</h3>
			<span class="section-divider"></span>
		</div>
		<div class="col-md-offset-3 col-md-6">
			<div class="box_style_2">
				<h2 class="inner">Order confirmed!</h2>
				<div id="confirm">
					<i class="icon_check_alt2"></i>
					<h3>Thank you!</h3>
					<p>
						Lorem ipsum dolor sit amet, nostrud nominati vis ex, essent conceptam eam ad. Cu etiam comprehensam nec. Cibo delicata mei an, eum porro legere no.
					</p>
				</div>
				<h4>Summary</h4>
				<table class="table table-striped nomargin">
					<tbody>
						<tr>
							<td>
								<strong>1x</strong> Enchiladas
							</td>
							<td>
								<strong class="pull-right">$11</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Burrito
							</td>
							<td>
								<strong class="pull-right">$14</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>1x</strong> Chicken
							</td>
							<td>
								<strong class="pull-right">$20</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Corona Beer
							</td>
							<td>
								<strong class="pull-right">$9</strong>
							</td>
						</tr>
						<tr>
							<td>
								<strong>2x</strong> Cheese Cake
							</td>
							<td>
								<strong class="pull-right">$12</strong>
							</td>
						</tr>
						<tr>
							<td>
								Delivery schedule <a href="#" class="tooltip-1" data-placement="top" title="" data-original-title="Please consider 30 minutes of margin for the delivery!"><i class="icon_question_alt"></i></a>
							</td>
							<td>
								<strong class="pull-right">Today 07.30 pm</strong>
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
		</div>
	</div>
</section>


<?php get_footer(); ?>