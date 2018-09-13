<?php

	// funcao para buscar a listagem de Cardapios do ususario atual
	function filter_pods_data_pre_select_params( $params ) 
	{
		if( !current_user_can('administrator'))
		{
			if($_GET['page'] == 'pods-manage-cardapio' && $_GET['action'] == 'manage' )
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
		if( !current_user_can('administrator'))
		{
			$pieces[ 'fields' ][ 'parceiro_id' ][ 'value' ] = $current_user->ID;
		}
		return $pieces;
	}; 
	add_action('pods_api_pre_save_pod_item_cardapio', 'my_post_save_function', 10, 3);
			 


	//check permissao para ver a pagina
	function filter_pods_data_select( $apply_filters, $pod_pod, $pod ) 
	{ 
		$current_user = wp_get_current_user();
		if( !current_user_can('administrator'))
		{
			if( $_GET['page'] == 'pods-manage-cardapio' && $_GET['action'] == 'edit' )
			{
				//echo $pod->display('parceiro_id') .' == '. $current_user->ID;
				if( (int)$pod->display('parceiro_id') == (int)$current_user->ID )
				{
					//continue	
				} else {

					//echo "e diferente";
					$string = '<script type="text/javascript">';
					//$string .= 'window.location = "/wp-admin/admin.php?page='.$_GET['page'].'"';
					$string .= '</script>';
					$string .= '<a href="/wp-admin/admin.php?page='.$_GET['page'].'">Este painel não te pertence! Saia por favor!</a>';
					echo $string;
					die(); 
					
				}

			}
		}

		return $apply_filters;
		
	}; 
	// add the filter 
	add_filter( 'pods_admin_ui_cardapio', 'filter_pods_data_select', 10, 3 ); 