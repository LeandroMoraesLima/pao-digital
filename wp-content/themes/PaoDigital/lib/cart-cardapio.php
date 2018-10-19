<?php 


$user = wp_get_current_user(); 
$pagamento = pods('venda', $_SESSION['paodigital']['venda']);

if( isset( $_POST['parceiro'] ) ):
	$pagamento->save('pd_parceiros_id', $_POST['parceiro'] );
endif;

$pag = (object)$pagamento->row();

//if not exists parceiros yet


if( (integer)$pag->pd_parceiros_id == 0 || is_null($pag->pd_parceiros_id) ):
	$_SESSION['message'] = "Começe escolhendo um Parceiro, digite seu CEP abaixo!";
	wp_redirect('/parceiros');
endif;

$theparca = $pag->pd_parceiros_id;

//get data of parceiros
$parceiro_prm = array(
	'where'   => 't.id = ' . $pag->id
); 

//get data of grupos
$grupos = get_terms( array(
    'taxonomy' => 'grupo',
    'hide_empty' => false,
) );

// Create and find in one shot 
$parceiros = pods( 'parceiro', $parceiro_prm ); 

