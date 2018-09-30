<?php 

	add_action( 'wp_ajax_get_parceiros', 'get_parceiros' );
	add_action( 'wp_ajax_nopriv_get_parceiros', 'get_parceiros' );

	function get_parceiros() 
	{
		// Make your response and echo it.	
			$params = array(
				'where'		=> 't.bairro LIKE "%'.$_POST['s'].'%"', 
				'limit'		=> 15
			); 

			$html = '';

			// Create and find in one shot 
			$parceiros = pods( 'parceiro', $params ); 

			if ( 0 < $parceiros->total() ):
				while ( $parceiros->fetch() ):
	 
			$html .= "
				<div class='col-xs-6 col-sm-3 col-md-15 col-lg-15'>  
					<div style='background-image: url(".$parceiros->display('logomarca').");'></div>  
					<h4>
						".$parceiros->display('bairro')."-".$parceiros->display('estado')."
					</h4>	
					
					<form action='/cardapio' method='post'>
						<input type='hidden' name='parceiro' value='".$parceiros->display('id')."' />
						<input type='submit' value='Selecionar'/>
					</form>
													
				</div>";

				endwhile; // end of books loop 
			endif;

			echo $html;

		// Don't forget to stop execution afterward.
		wp_die();
	}


	add_action( 'wp_ajax_search_products', 'search_products' );
	add_action( 'wp_ajax_nopriv_search_products', 'search_products' );

	function search_products() 
	{
		// Make your response and echo it.	
			$params = array(
				'where'		=> 't.nome LIKE "%'.$_POST['s'].'%" OR t.descricao LIKE "%'.$_POST['s'].'%" OR t.ingredientes LIKE "%'.$_POST['s'].'%" ', 
				'limit'		=> 15
			); 

			$html = '';

			// Create and find in one shot 
			$cardapios = pods( 'cardapio', $params ); 

			if ( 0 < $cardapios->total() ):
				while ( $cardapios->fetch() ):
	 
					include(locate_template('lib/template-products.php'));

				endwhile; // end of books loop 
			endif;

			echo $html;

		// Don't forget to stop execution afterward.
		wp_die();
	}




	add_action( 'wp_ajax_add_to_cart', 'add_to_cart' );
	add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart' );

	function add_to_cart() 
	{
		$id = $_POST['product'];

		if( !is_array($_SESSION['paodigital']['cart']['itens']) )
		{
			$_SESSION['paodigital']['cart']['itens'] = [];
		}

		//$_SESSION['paodigital']['cart']['itens'] = [];
		// var_dump($_SESSION['paodigital']['cart']);
		// die();

		$html = '';
		$vtotal = 0;

		$cardapio = pods( 'cardapio', $id ); 

		$prod = $_SESSION['paodigital']['cart']['itens'][$id];

		$vvenda = str_replace( 'R$ ', '', $cardapio->display('valor_venda') );
		$vvenda = str_replace( ',', '.', $vvenda );

		$valor = ( $vvenda * ($prod['quantidade'] + 1) );

		if( isset($prod['quantidade']) && count($prod['quantidade']) > 0 ):
			$_SESSION['paodigital']['cart']['itens'][$id]['quantidade'] = $prod['quantidade'] + 1;
			$_SESSION['paodigital']['cart']['itens'][$id]['valor'] = $valor;
			$_SESSION['paodigital']['cart']['itens'][$id]['nome'] = $cardapio->display('nome');
			$_SESSION['paodigital']['cart']['itens'][$id]['reais'] = number_format($valor, 2, ',', '.');
		else:
			$_SESSION['paodigital']['cart']['itens'][$id]['quantidade'] = 1;
			$_SESSION['paodigital']['cart']['itens'][$id]['nome'] = $cardapio->display('nome');
			$_SESSION['paodigital']['cart']['itens'][$id]['valor'] = $vvenda;
			$_SESSION['paodigital']['cart']['itens'][$id]['reais'] = $cardapio->display('valor_venda');
		endif;
		
		foreach( $_SESSION['paodigital']['cart']['itens'] as $key => $total ):
			$vtotal = $vtotal + $total['valor'];
			include(locate_template('lib/template-itens.php'));
		endforeach;

		$vvoucher = 0;
		$ventrega = 10;
		$vltotal = ($vtotal - $vvoucher + $ventrega);

		$_SESSION['paodigital']['cart']['subtotal'] = $vtotal;
		$_SESSION['paodigital']['cart']['voucher'] = $vvoucher;
		$_SESSION['paodigital']['cart']['ventrega'] = $ventrega;
		$_SESSION['paodigital']['cart']['vtotal'] = $vltotal;

		$itens = [
			'subtotal' 	=> number_format($vtotal, 2, ',', '.'),
			'voucher'	=> $vvoucher,
			'ventrega'	=> number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> number_format($vltotal, 2, ',', '.'),
			'html'		=> $html
		];

		// Don't forget to stop execution afterward.
		echo json_encode($itens);
		wp_die();
	}



	add_action( 'wp_ajax_remove_to_cart', 'remove_to_cart' );
	add_action( 'wp_ajax_nopriv_remove_to_cart', 'remove_to_cart' );

	function remove_to_cart() 
	{
		$id = $_POST['product'];

		if( !is_array($_SESSION['paodigital']['cart']['itens']) )
		{
			$_SESSION['paodigital']['cart']['itens'] = [];
		}

		//$_SESSION['paodigital']['cart']['itens'] = [];
		// var_dump($_SESSION['paodigital']['cart']);
		// die();

		$html = '';
		$vtotal = 0;

		$cardapio = pods( 'cardapio', $id ); 

		$prod = $_SESSION['paodigital']['cart']['itens'][$id];

		$vvenda = str_replace( 'R$ ', '', $cardapio->display('valor_venda') );
		$vvenda = str_replace( ',', '.', $vvenda );

		$valor = ( $vvenda * ($prod['quantidade'] - 1) );

		if( isset($prod['quantidade']) && $prod['quantidade'] > 1 ):
			$_SESSION['paodigital']['cart']['itens'][$id]['quantidade'] = $prod['quantidade'] - 1;
			$_SESSION['paodigital']['cart']['itens'][$id]['valor'] = $valor;
			$_SESSION['paodigital']['cart']['itens'][$id]['nome'] = $cardapio->display('nome');
			$_SESSION['paodigital']['cart']['itens'][$id]['reais'] = number_format($valor, 2, ',', '.');
		else:
			unset($_SESSION['paodigital']['cart']['itens'][$id]);
		endif;
		
		foreach( $_SESSION['paodigital']['cart']['itens'] as $key => $total ):
			$vtotal = $vtotal + $total['valor'];
			include(locate_template('lib/template-itens.php'));
		endforeach;

		$vvoucher = 0;
		$ventrega = 10;
		$vltotal = ($vtotal - $vvoucher + $ventrega);

		$_SESSION['paodigital']['cart']['subtotal'] = $vtotal;
		$_SESSION['paodigital']['cart']['voucher'] = $vvoucher;
		$_SESSION['paodigital']['cart']['ventrega'] = $ventrega;
		$_SESSION['paodigital']['cart']['vtotal'] = $vltotal;

		$itens = [
			'subtotal' 	=> number_format($vtotal, 2, ',', '.'),
			'voucher'	=> $vvoucher,
			'ventrega'	=> number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> number_format($vltotal, 2, ',', '.'),
			'html'		=> $html
		];

		// Don't forget to stop execution afterward.
		echo json_encode($itens);
		wp_die();
	}





	add_action( 'wp_ajax_get_the_cart', 'get_the_cart' );
	add_action( 'wp_ajax_nopriv_get_the_cart', 'get_the_cart' );

	function get_the_cart() 
	{
		global $_SESSION;
		//var_dump($_SESSION['paodigital']['cart']['itens'] = '') ;
		if( !is_array($_SESSION['paodigital']['cart']['itens']) )
		{
			echo 0; die();
		}

		$html = '';

		$vtotal 	= $_SESSION['paodigital']['cart']['subtotal'];
		$vltotal 	= $_SESSION['paodigital']['cart']['vtotal'];
		$vvoucher 	= $_SESSION['paodigital']['cart']['voucher'];
		$ventrega 	= $_SESSION['paodigital']['cart']['ventrega'];
		
		foreach( $_SESSION['paodigital']['cart']['itens'] as $key => $total ):
			include(locate_template('lib/template-itens.php'));
		endforeach;

		$itens = [
			'subtotal' 	=> number_format($vtotal, 2, ',', '.'),
			'voucher'	=> $vvoucher,
			'ventrega'	=> number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> number_format($vltotal, 2, ',', '.'),
			'html'		=> $html
		];

		// Don't forget to stop execution afterward.
		echo json_encode($itens);
		wp_die();
	}

	add_action( 'wp_ajax_get_block_address', 'get_block_address' );
	add_action( 'wp_ajax_nopriv_get_block_address', 'get_block_address' );

	function get_block_address()
	{
		$blocks = ( $_POST['blocks'] + 1 );
		include(locate_template('lib/template-address.php'));
		wp_die();
	}

	add_action( 'wp_ajax_save_order_of_partners', 'save_order_of_partners' );
	add_action( 'wp_ajax_nopriv_save_order_of_partners', 'save_order_of_partners' );
	function save_order_of_partners()
	{
		parse_str($_POST['itens'], $allFormData);

		foreach ( $allFormData['ordem'] as $key => $order ):
			
			if( $_POST['type'] == 'home' ):

				$home = ( isset($order['home']) ) ? 1 : 0;
				$data = array( 
				    'home_order'  => $order['position'],
				    'presente_na_homepage' => $home
				);

			else:
				$data = array(
					'parceiros_order' => $order['position']
				);
			endif; 
			//get pods object for item of ID $id 
			$pod = pods( 'parceiro', $key ); 
			//update the item and return item id in $item 
			$item = $pod->save( $data);
				
		endforeach;

		wp_die();
	}










	add_action('admin_enqueue_scripts', 'cstm_css_and_js');

	function cstm_css_and_js($hook) {

		if ( 'index.php' != $hook ) {
			return;
		}

		wp_enqueue_style('boot_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style('admin_css', get_template_directory_uri() . '/assets/css/admin.css' );
		wp_enqueue_script('boot_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js' );
	}




	add_action( 'admin_footer', 'rv_custom_dashboard_widget' );
	function rv_custom_dashboard_widget() {
		// Bail if not viewing the main dashboard page
		if ( get_current_screen()->base !== 'dashboard' ) {
			return;
		}
		get_template_part('lib/template', 'widgets');
	}



	// Function that outputs the contents of the dashboard widget
	function dashboard_widget_function( $post, $callback_args ) {
		get_template_part('lib/template', 'vendas');
	}
	function dashboard_widget_pacotes( $post, $callback_args ) {
		get_template_part('lib/template', 'pacotes');
	}

	// Function used in the action hook
	function add_dashboard_widgets() {
		wp_add_dashboard_widget('dashboard_widget', 'Entregas do dia', 'dashboard_widget_function');
		wp_add_dashboard_widget('dashboard_widget_2', 'Pacotes', 'dashboard_widget_pacotes');
	}

	// Register the new dashboard widget with the 'wp_dashboard_setup' action
	add_action('wp_dashboard_setup', 'add_dashboard_widgets' );



