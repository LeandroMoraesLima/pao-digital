<div class="inside">
	<table class="table card-table">
		<thead>
			<tr>
				<th>#ID</th>
				<th style="width:40%">Cliente</th>
				<th class="text-right">Valor</th>
				<th class="text-right">Qtd Itens:</th>
				<th class="text-right">Pedido as:</th>
			</tr>
		</thead>
		<tbody>


			<?php 

				$day = date('Y-m-d'). ' 00:00:00';
				$days = [
					'limit' => 10,
					'where' => "`created` >= '{$day}' AND `package_type` = 'menu'",
					'orderby' => 'id DESC'
				];
				$tvendas = pods( 'venda', $days );


					if ( 0 < $tvendas->total() ):
						while ( $tvendas->fetch() ):

			?>

					<tr>
						<td class="align-middle">
							#<?php echo sprintf( "%05d", $tvendas->display('id') ); ?>
						</td>
						<td class="align-middle">
							<a href="javascript:void(0)" class="text-dark">Bolota</a>
						</td>
						<td class="text-right">$480.00</td>
						<td class="text-right">123</td>
						<td class="text-right">7:00</td>
					</tr>
					
				<?php
						endwhile;
					else:

						echo "<tr><td colspan='5' style='text-align:center;'>Não existem vendas hoje!</td></tr>";

					endif;
				?>


		</tbody>
	</table>
	<a href="javascript:void(0)" class="card-footer d-block text-center text-dark small font-weight-semibold">SHOW MORE</a>
</div>