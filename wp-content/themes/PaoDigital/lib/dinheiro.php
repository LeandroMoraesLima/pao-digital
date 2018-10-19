<?php 


		$venda = $_SESSION['paodigital']['venda'];


		$grandTotal = 0.00;
		
		$itens = pods_query("
			SELECT *, (valor_no_ato * quantidade ) AS sub_total
			FROM pd_pods_item 
			WHERE venda_id = {$venda}");



		foreach( $itens as $key => $total ):
			$grandTotal = $grandTotal + $total->sub_total;
		endforeach;

		$vcp = pods( 'venda', $venda );
		$cupomId = $vcp->display('cupom');


		$cupomData = pods( 'cupom', $cupomId );
		$percent = str_replace( ",", ".", $cupomData->display('desconto') );
	
		$hasCp = ( $cupomData->display('desconto') > 0 ) ? true : false;

		$ventrega = VALOR_ENTREGA;
		$vvoucher = 0.00;

		if( $hasCp == true ):
			$vvoucher = ( $grandTotal * ( $percent / 100 ) );
		endif;


		$vtotal = ( $grandTotal + $ventrega - $vvoucher );


		$itens = [
			'subtotal' 	=> "R$ ".number_format($grandTotal, 2, ',', '.'),
			'voucher'	=> "R$ ".number_format($vvoucher, 2, ',', '.'),
			'hasvouch'  => $hasCp,
			'ventrega'	=> "R$ ".number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> "R$ ".number_format($vtotal, 2, ',', '.')
		];


		$podVenda = pods('venda', $venda);
		$podVenda->save(array(
			'preco_total' 					=> number_format($vtotal, 2, ',', '.'),
			'desconto'						=> number_format($vvoucher, 2, ',', '.'),
			'taxas'							=> str_replace(".", ",", VALOR_ENTREGA_G ),
			'pagamento_status'				=> 0,
			'pago_com'						=> ($_POST['pagode'] == 'dinheiro')? 'dinheiro' : 'refeicao',
			'retirado'						=> 0,
			'pedido'						=> 0,
		));



		$payment = new stdClass();
		$payment->compra = true;
		$payment->venda = $venda;

		unset($_SESSION['paodigital']);
		unset($_POST);


