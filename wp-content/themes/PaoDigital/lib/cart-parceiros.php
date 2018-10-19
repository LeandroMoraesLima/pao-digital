<?php

/*
	Iniciando a compra atraves da homepage
	======================================
*/

function get_old_cart() 
{
	$user = wp_get_current_user();

	$pagamento = pods('venda', array( 
		'where' 	=> "`pd_users_id` = {$user->ID} AND `pedido` = 1",
		'limit'		=> 1,
		'orderby'	=> "id DESC"
	));

	$total = $pagamento->total_found();

	if ( $total > 0 ):

		//return the last data
		$pag = $pagamento->data()[0];
		$_SESSION['paodigital']['venda'] = $pag->id;
		return $pag;

	else:
		
		$itens = array(
			'product_type' 			=> (isset($_POST['type']))? $_POST['type'] : 0,
			'package_type'			=> (isset($_POST['plano']))? $_POST['plano'] : 0,
			'parceiro_id'			=> (isset($_POST['parceiro']))? $_POST['parceiro'] : 0,
			'pacote_por_x_dias'		=> 0,
			'week_time'				=> null,
			'pd_users_id'			=> $user->ID
		);

	
		$pod 		= pods('venda');
		$vendaId 	= $pod->save($itens);


		//return created data
		$pag = (object)$pod->row();
		$_SESSION['paodigital']['venda'] = $pag->id;
		return $pag;

	endif;
}

function get_cart_all_itens($cartId)
{

	if( isset($_POST['plano']) ):


		$pl = ( isset($_POST['plano']) ) ? $_POST['plano'] : 0;

		$plano = array( 'junior' => 1, 'pleno' => 2, 'master' => 3, 'corporativo' => 4 );

		$pnl = $plano[$pl];


		$cardapio = pods('cardapio', $pnl );
		$cardapio = $cardapio->row();


		$itens = pods( 'item', array(
			'where' => "venda_id = {$cartId} AND produto_id = {$pnl}"  
		));

		$vitens = $itens->data();

		if( is_array($vitens) && count($vitens) > 0 ):

			$viten = $vitens[0];

			$pod = pods( 'item', $viten->id );
			$podItem = $pod->row();

			$a = $pod->save( 'quantidade', ($podItem['quantidade'] + 1) );

		else:

			$pod = pods( 'item' ); 
			$datP = array( 
				'nome'			=> $cardapio['nome'],
				'quantidade'	=> 1,
				'valor_no_ato'	=> (Float)$cardapio['valor_venda'],
				'produto_id'	=> $cardapio['id'],
				'venda_id'		=> $cartId
			);
			$pod->add( $datP );
		

		endif;

	endif;
}

//exist session venda yes | no
// unset($_SESSION['paodigital']);
// unset($_POST);

if( isset($_POST['plano']) ):
	$data = (object) get_old_cart();
	
	if( isset($data->id) && !is_null($data->id) && $data->id !== '' ):
		if( $_POST['type'] !== 'drive' || ( $_POST['type'] !== 'home' && $_POST['plano'] !== 'menu' ) ):
			get_cart_all_itens($data->id);
		endif;
	endif;
	unset($_POST['plano']);
endif;


