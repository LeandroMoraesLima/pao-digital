<?php 

	if( current_user_can('administrator') == true ):
 ?>

<div id="custom-id" class="welcome-panel" >
	<div class="welcome-panel-content"> 

		<!-- Counters -->
		<div class="row">
			<div class="col-sm-6 col-xl-3">
				<?php 
					$day = date('Y-m-d'). ' 00:00:00';
					$days = [
						'limit' => -1,
						'where' => "created >= '{$day}'"
					];
					$tvendas = pods( 'venda', $days );
				?>
				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-cart display-4 text-success"></div>
							<span class="dashicons dashicons-cart"></span>
							<div class="ml-3">
								<div class="text-muted small">Pedidos do Dia</div>
								<div class="text-large"><?php echo $tvendas->total_found(); ?></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">
				<?php 
					$month = date('Y-m-'). '01 00:00:00';
					$vendas = [
						'limit' => -1,
						'where' => "created >= '{$month}'"
					];
					$tvendas = pods( 'venda', $vendas );
				?>
				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-earth display-4 text-info"></div>
							<span class="dashicons dashicons-admin-site"></span>
							<div class="ml-3">
								<div class="text-muted small">Pedidos do Mês</div>
								<div class="text-large"><?php echo $tvendas->total_found(); ?></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">
				<?php 
					$limit = [
						'limit' => -1
					];
					$prod = pods( 'cardapio', $limit );
				?>
				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-gift display-4 text-danger"></div>
							<span class="dashicons dashicons-networking"></span>
							<div class="ml-3">
								<div class="text-muted small">Produtos</div>
								<div class="text-large"><?php echo $prod->total_found(); ?></div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">
				<?php 
					$users = get_users( 'role=cliente' );
				?>
				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-users display-4 text-warning"></div>
							<span class="dashicons dashicons-groups"></span>
							<div class="ml-3">
								<div class="text-muted small">Clientes</div>
								<div class="text-large"><?php echo count($users); ?></div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- / Counters -->

	</div>
</div>

<?php endif; ?>



<script>
	jQuery(document).ready(function($) {
		$('#welcome-panel').after($('#custom-id').show());
	});
</script>