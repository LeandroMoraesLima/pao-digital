<?php 
	$partner = PARTNER;
	if( !current_user_can('administrator') && ( $partner == '' || is_null($partner) )  ):
		return null;
	endif;
?>

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
				$query = '';
				$partner = PARTNER;
				if( !current_user_can('administrator') ):
					$query = "AND `pd_parceiros_id` = {$partner}";
				endif;
				$day = date('Y-m-d'). ' 00:00:00';
				$days = [
					'limit' => 10,
					'where' => "`created` >= '{$day}' AND `package_type` = 'menu' {$query}",
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
							<?php 
								$uid = get_user_by('id', $tvendas->display('pd_users_id') );
							?>
							<a href="javascript:void(0)" class="text-dark">
								<?php echo $uid->first_name . ' ' . $uid->last_name ?>
							</a>
						</td>
						<td class="text-right">
							R$ <?php echo $tvendas->display('preco_total') ?>
						</td>
						<td class="text-right">
							<?php 
								$id = $tvendas->display('id');
								$piten = pods( 'item', [ 'where' => "`venda_id` = {$id}" ] );
								echo $piten->total_found();
							?>
						</td>
						<td class="text-right">
							<?php 
								echo date( 'H:i', strtotime( $tvendas->display('created')  ) )
							?>
						</td>
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