<div id="custom-id" class="welcome-panel" style="display: none;">
	<div class="welcome-panel-content">

		<!-- Counters -->
		<div class="row">
			<div class="col-sm-6 col-xl-3">
				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-cart display-4 text-success"></div>
							<span class="dashicons dashicons-cart"></span>
							<div class="ml-3">
								<div class="text-muted small">Pedidos do Dia</div>
								<div class="text-large">2362</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">

				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-earth display-4 text-info"></div>
							<span class="dashicons dashicons-admin-site"></span>
							<div class="ml-3">
								<div class="text-muted small">Pedidos do Mês</div>
								<div class="text-large">687,123</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">

				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-gift display-4 text-danger"></div>
							<span class="dashicons dashicons-networking"></span>
							<div class="ml-3">
								<div class="text-muted small">Produtos</div>
								<div class="text-large">985</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-sm-6 col-xl-3">

				<div class="card mb-4">
					<div class="card-body">
						<div class="d-flex align-items-center">
							<div class="lnr lnr-users display-4 text-warning"></div>
							<span class="dashicons dashicons-groups"></span>
							<div class="ml-3">
								<div class="text-muted small">Clientes</div>
								<div class="text-large">105,652</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- / Counters -->

	</div>
</div>





<script>
	jQuery(document).ready(function($) {
		$('#welcome-panel').after($('#custom-id').show());
	});
</script>