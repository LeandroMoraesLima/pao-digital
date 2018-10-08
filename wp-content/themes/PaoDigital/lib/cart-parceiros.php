<?php

/*
	Iniciando a compra atraves da homepage
	======================================
*/
$user = wp_get_current_user();
$pagamento = pods('venda', array( 
	'where' 	=> "`pd_users_id` = {$user->ID} AND `pagamento_status` = false",
	'limit'		=> 1,
	'orderby'	=> "id DESC"
));

$total = $pagamento->total_found();
$pagamento = $pagamento->data();

$vendaId = 0;

if( $total == 0 ):

	$itens = array(
		'product_type' 			=> $_POST['type'],
		'package_type'			=> $_POST['plano'],
		'pacote_por_x_dias'		=> 0,
		'week_time'				=> null,
		'pd_users_id'			=> $user->ID
	);

	$pod = pods('venda');
	$vendaId = $pod->add($itens);
	$_SESSION['paodigital']['venda'] = $vendaId;


else:

	$itens = array(
		'product_type' 			=> $_POST['type'],
		'package_type'			=> $_POST['plano'],
		'pacote_por_x_dias'		=> 0,
		'week_time'				=> null,
		'pd_users_id'			=> $user->ID
	);
	$act = $pagamento[0];
	$pod = pods( 'venda', $act->id );
	$vendaId = $pod->save($itens);
	$_SESSION['paodigital']['venda'] = $vendaId;

endif;

if( $_POST['plano'] !== 'menu' ):

	$plano = array('junior' => 1, 'pleno' => 2, 'master' => 3);
	$cardapio = pods('cardapio', $plano[$_POST['plano']] );
	$cardapio = $cardapio->row();

	$pod = pods( 'item' ); 
	$datP = array( 
		'nome'			=> $cardapio['nome'],
		'quantidade'	=> 1,
		'valor_no_ato'	=> (Float)$cardapio['valor_venda'],
		'produto_id'	=> $cardapio['id'],
		'venda_id'		=> $vendaId
	);
	$pod->add( $datP );

endif;