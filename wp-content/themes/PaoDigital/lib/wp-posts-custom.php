<?php

	// funcao para buscar a listagem de Cardapios do ususario atual
	function filter_pods_data_pre_select_params( $params ) 
	{

		if( !current_user_can('administrator') && isset($_GET['page']))
		{
			if($_GET['page'] == 'pods-manage-cardapio' && $_GET['action'] == 'manage' )
			{
				$current_user = wp_get_current_user();
				$params->where = "parceiro_id = ".PARTNER;
			}
		}
		return $params; 
	}; 
	add_filter( 'pods_data_pre_select_params', 'filter_pods_data_pre_select_params', 10, 1 ); 


	//funcao para inserir o parceiro id antes de salvar o Cardapio
	function my_post_save_function($pieces, $is_new_item, $id )
	{ 

		if( !current_user_can('administrator'))
		{
			$pieces[ 'fields' ][ 'parceiro_id' ][ 'value' ] = PARTNER;
		} 

		return $pieces;
	}; 
	add_action('pods_api_pre_save_pod_item_cardapio', 'my_post_save_function', 10, 3);



	//check permissao para ver a pagina
	function filter_pods_data_select( $apply_filters, $pod_pod, $pod ) 
	{ 
		if( !current_user_can('administrator'))
		{
			if( $_GET['page'] == 'pods-manage-cardapio' && $_GET['action'] == 'edit' )
			{
				//echo $pod->display('parceiro_id') .' == '. $current_user->ID;
				if( (int)$pod->display('parceiro_id') == PARTNER )
				{
					//continue	
				} else {

					$string .= '<a href="'.get_bloginfo('url').'/minha-padaria/admin.php?page='.$_GET['page'].'">Este painel não te pertence! Saia por favor!</a>';
					echo $string;
					die(); 
					
				}

			}
		}

		return $apply_filters;
		
	}
	add_filter( 'pods_admin_ui_cardapio', 'filter_pods_data_select', 10, 3 ); 



	function action_pods_act_editor_after_metabox( $pod, $obj ) { 
	    // make action magic happen here... 
		if( $_GET['action'] == 'edit' && $_GET['page'] == 'pods-manage-venda' ):
			include(locate_template('lib/template-tables.php'));
		endif;

		if( ( $_GET['action'] == 'edit' || $_GET['action'] == 'add' ) && ( $_GET['page'] == 'pods-manage-parceiro' || $_GET['page'] == 'pods-add-new-parceiro' ) ):
			include(locate_template('lib/parceiro-cep.php'));
		endif;

		if( $_GET['action'] == 'edit'  && ( $_GET['page'] == 'pods-manage-parceiro' || $_GET['page'] == 'pods-add-new-parceiro' ) ):
			include(locate_template('lib/template-maps.php'));
		endif;

		if( ( $_GET['action'] == 'edit' || $_GET['action'] == 'add' ) && $_GET['page'] == 'pods-manage-cardapio' ):
			include(locate_template('lib/cardapio-script.php'));
		endif;
	}; 
	         
	// add the action 
	add_action( 'pods_act_editor_after_metabox', 'action_pods_act_editor_after_metabox', 10, 2 ); 



	function filter_pods_field_pick_data( $data, $name, $value, $options, $pod, $id ) { 
	    // make filter magic happen here... 

	    if( $name == 'pods_field_parceiro_id' ):

	    	$pods = pods('parceiro', array('limit' => -1));
	    	$pods = $pods->data();

	    	if( is_array($pods) && count($pods) ):
	    		foreach($pods as $key => $val):

	    			$data[$val->id] = $val->nome;

	    		endforeach;
	    	endif;


	    endif;
	    //var_dump($data);
	    return $data; 
	}; 
	         
	// add the filter 
	add_filter( 'pods_field_pick_data', 'filter_pods_field_pick_data', 10, 6 ); 


