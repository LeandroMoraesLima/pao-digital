<?php 


$user = wp_get_current_user();
$pagamento = pods('venda', $_SESSION['paodigital']['venda']);

$pagamento->save('pd_parceiros_id', $_POST['parceiro'] );


//get data of parceiros
$parceiro_prm = array(
	'where'   => 't.id = ' . $_POST['parceiro']
); 

//get data of grupos
$grupos = get_terms( array(
    'taxonomy' => 'grupo',
    'hide_empty' => false,
) );

// Create and find in one shot 
$parceiros = pods( 'parceiro', $parceiro_prm ); 

