<?php 
	$partner = PARTNER;
	if( !current_user_can('administrator') && ( $partner == '' || is_null($partner) )  ):
		return null;
	endif;
?>
<div class="nav-tabs-top mb-4">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#sale-junior">Junior</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#latest-master">Master</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#latest-pleno">Pleno</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#latest-corporativo">Corporativo</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="sale-junior">
			<table class="table card-table">
				<thead>
					<tr>
						<th>#ID</th>
						<th style="width:40%">Cliente</th>
						<th>Valor</th>
						<th>Item</th>
						<th>Entrega</th>
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
							'limit' => -1,
							'where' => "`created` >= '{$day}' AND `package_type` = 'junior' {$query}",
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
		<div class="tab-pane fade" id="latest-master">
			<table class="table card-table">
				<thead>
					<tr>
						<th>#ID</th>
						<th style="width:40%">Cliente</th>
						<th>Valor</th>
						<th>Item</th>
						<th>Entrega</th>
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
							'limit' => -1,
							'where' => "`created` >= '{$day}' AND `package_type` = 'master' {$query}",
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
		<div class="tab-pane fade" id="latest-pleno">
			<table class="table card-table">
				<thead>
					<tr>
						<th>#ID</th>
						<th style="width:40%">Cliente</th>
						<th>Valor</th>
						<th>Item</th>
						<th>Entrega</th>
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
							'limit' => -1,
							'where' => "`created` >= '{$day}' AND `package_type` = 'pleno' {$query}",
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
		<div class="tab-pane fade" id="latest-corporativo">
			<table class="table card-table">
				<thead>
					<tr>
						<th>#ID</th>
						<th style="width:40%">Cliente</th>
						<th>Valor</th>
						<th>Item</th>
						<th>Entrega</th>
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
							'limit' => -1,
							'where' => "`created` >= '{$day}' AND `package_type` = 'corporativo' {$query}",
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
	</div>
</div>