<?php

	// funcao para buscar a listagem de Cardapios do ususario atual
	function filter_pods_data_pre_select_params( $params ) 
	{
		if( !current_user_can('administrator'))
		{
			if($_GET['page'] == 'pods-manage-cardapio')
			{
				$current_user = wp_get_current_user();
				$params->where = "parceiro_id = {$current_user->ID}";
			}
		}
		return $params; 
	}; 
	add_filter( 'pods_data_pre_select_params', 'filter_pods_data_pre_select_params', 10, 1 ); 


	//funcao para inserir o parceiro id antes de salvar o Cardapio
	function my_post_save_function($pieces, $is_new_item, $id )
	{ 
		$current_user = wp_get_current_user();
		$pieces[ 'fields' ][ 'parceiro_id' ][ 'value' ] = $current_user->ID; 
		//podsDebugger::log_debug_data(print_r($pieces['fields'][ 'parceiro_id' ], TRUE));
		return $pieces;
	}; 
	add_action('pods_api_pre_save_pod_item_cardapio', 'my_post_save_function', 10, 3);
	add_action('pods_api_pre_create_pod_item_cardapio', 'my_post_save_function', 10, 3);
	add_action('pods_api_pre_edit_pod_item_cardapio', 'my_post_save_function', 10, 3);
			 


	//check permissao para ver a pagina
	function filter_pods_data_select( $results, $params, $instance ) { 
	if( !current_user_can('administrator'))
		{
			if( $_GET['page'] == 'pods-manage-cardapio' )
			{
				if( $results[0]->parceiro_id != $current_user->ID )
				{
					$string = '<script type="text/javascript">';
					$string .= 'window.location = "/wp-admin/admin.php?page='.$_GET['page'].'"';
					$string .= '</script>';

					echo $string;
					die();
				}
			}
		}
		return $results;
	}; 
	// add the filter 
	add_filter( 'pods_data_select', 'filter_pods_data_select', 10, 3 ); 