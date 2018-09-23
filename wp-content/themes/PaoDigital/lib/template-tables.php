<style>
	table {
		width: 100%;
	    margin-bottom: 1rem;
	    background-color: transparent;
	    border-collapse: collapse;
	    display: table;
	    border-collapse: separate;
	    border-spacing: 2px;
	    border-color: grey;
	}
	table thead {
		display: table-header-group;
	    vertical-align: middle;
	    border-color: inherit;
	}
	tr {
		display: table-row;
		vertical-align: inherit;
		border-color: inherit;
	}
	.table thead th {
	    vertical-align: bottom;
	    padding: 10px 12px;
	    text-align: left;
	}
	.table td {
	    padding: .75rem;
	    vertical-align: top;
	    border-top: 1px solid #dee2e6;
	}
</style>

<?php 
	
	$i = 1;
	$params = [
		'venda_id' => $_GET['id'],
		'orderby'	=> 'id ASC'
	];

	$itens = pods( 'item', $params ); 
	if ( 0 < $itens->total() ):
			
?>


<div id="pods-meta-box-more-fields" class="postbox">
	<div class="handlediv" title="Click to toggle" aria-expanded="true"><br>
	</div>
	<h3 class="hndle ui-sortable-handle">
		<span>Itens da venda</span>
	</h3>
	<div class="inside">
		
		<table class="table table-dark">
			<thead>
				<tr>
					<th scope="col" width="10%">#ID</th>
					<th scope="col" width="60%">Nome do Produto</th>
					<th scope="col" width="10%" style="text-align: right;">Qtd</th>
					<th scope="col" width="10%" style="text-align: right;">Vl Un.</th>
					<th scope="col" width="10%" style="text-align: right;">Vl Total.</th>
				</tr>
			</thead>
			<tbody>
<?php 
	
		while ( $itens->fetch() ):

			$vtotal = str_replace( ',', '.', $itens->display('valor_no_ato') );
			$valor = ( $vtotal * ( $itens->display('quantidade') ) );
?>
				<tr>
					<td><?php echo $i; ?></th>
					<td><?php echo $itens->display('nome'); ?></td>
					<td style="text-align: right;"><?php echo $itens->display('quantidade'); ?></td>
					<td style="text-align: right;">R$ <?php echo $itens->display('valor_no_ato'); ?></td>
					<td style="text-align: right;">R$ <?php echo number_format($valor, 2, ',', '.'); ?></td>
				</tr>
			

<?php
		$i++;
		endwhile;
?>
				
			</tbody>
		</table>        


	</div>
</div>

<?php	endif; ?>
