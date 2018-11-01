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






	add_action( 'wp_ajax_add_cupom', 'add_cupom' );
	add_action( 'wp_ajax_nopriv_add_cupom', 'add_cupom' );

	function add_cupom() 
	{
		$tag = $_POST['tag'];
		$vendaId = $_SESSION['paodigital']['venda'];

		$cupom = pods('cupom', array('where' => "tag_do_cupom = '{$tag}'"));

		if( $cupom->data() == false ):

			echo json_encode( array( 'status' => 'danger', 'msg' => 'Cupom não encontrado!' ) );
			unset($_SESSION['paodigital']['cupom']);
			$vd = pods("venda", $vendaId );
			$vd->save( 'cupom', 0 );

		else:

			$myCp = $cupom->data();

			

			$vd = pods("venda", $vendaId);
			$vd->save( 'cupom', $myCp[0]->id );

			$_SESSION['paodigital']['cupom'] = $tag;
			echo json_encode( array( 'status' => 'info', 'msg' => 'Cupom Cadastrado!' ) );

		endif;

		wp_die();
	}








	add_action( 'wp_ajax_search_products', 'search_products' );
	add_action( 'wp_ajax_nopriv_search_products', 'search_products' );

	function search_products() 
	{
		//get data of grupos
		$grupos = get_terms( array(
		    'taxonomy' => 'grupo',
		    'hide_empty' => false,
		));

		$parceiro_prm = array('where'   => 't.id = ' . $_SESSION['paodigital']['venda']); 
		$parceiros = pods( 'parceiro', $parceiro_prm ); 

		if( is_array($grupos) && !empty($grupos) ):
			$index = 0;
			foreach ($grupos as $key => $grupo): 

				//get data of cardapio
				$cardapio_prm = array(
					'where'   => '( t.nome LIKE "%'.$_POST['s'].'%" OR t.descricao LIKE "%'.$_POST['s'].'%" OR t.ingredientes LIKE "%'.$_POST['s'].'%" ) AND t.parceiro_id = ' . $_POST['parca'] . ' AND grupos.name = "' . $grupo->name . '"'
				);
				$cardapios = pods( 'cardapio', $cardapio_prm );

				if( $cardapios->total() > 0 ): ?>

					
					<div class="card">
						<div class="card-header" id="heading<?php echo $index; ?>">
							<h5 class="mb-0">
								<button class="btn btn-link <?php echo ($index == 0)? '':'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapseOne" style="text-decoration: none;">
								<?php echo $parceiros->display('nome'); ?> | <?php echo $grupo->name; ?>
								</button>
							</h5>
						</div>
						<div id="collapse<?php echo $index; ?>" class="collapse-show <?php echo ($index == 0)? 'show' : 'collapse'; ?>" aria-labelledby="heading<?php echo $index; ?>" >
							<div class="card-body" id="allProducts">
								<ul>

									<?php

										if ( 0 < $cardapios->total() ):
											while ( $cardapios->fetch() ):
											
												include(locate_template('lib/template-products.php'));
											
											endwhile;
										endif;
									?>

								</ul>
							</div>
						</div>
					</div> 




		<?php
					$index++;
				endif;
				
			endforeach;
		endif;


		// Make your response and echo it.	
			// $params = array(
			// 	'where'		=> 't.nome LIKE "%'.$_POST['s'].'%" OR t.descricao LIKE "%'.$_POST['s'].'%" OR t.ingredientes LIKE "%'.$_POST['s'].'%" ', 
			// 	'limit'		=> 15
			// ); 

			// $html = ''; 

			// // Create and find in one shot 
			// $cardapios = pods( 'cardapio', $params ); 

			// if ( 0 < $cardapios->total() ):
			// 	while ( $cardapios->fetch() ):
	 
			// 		include(locate_template('lib/template-products.php'));

			// 	endwhile; // end of books loop 
			// endif;

			// echo $html;

		// Don't forget to stop execution afterward.
		wp_die();
	}




	add_action( 'wp_ajax_add_to_cart', 'add_to_cart' );
	add_action( 'wp_ajax_nopriv_add_to_cart', 'add_to_cart' );

	function add_to_cart() 
	{

		$id = $_POST['product'];
		$vid = $_SESSION['paodigital']['venda'];

		$pod = pods('cardapio', $id);

		$item = pods( 'item', array('where' => "produto_id = {$id} AND venda_id = {$vid}") ); 
		$itemData = $item->data();

		if( $item->total_found() > 0 ):
			
			$data = $itemData[0];
			$updateItem = pods('item', $data->id );
			$updateItem->save( "quantidade", ($data->quantidade + 1) );

		else:
			$item = $pod->row();

			$newIten = pods('item');
			$datP = array( 
				'nome'			=> $item['nome'],
				'quantidade'	=> 1,
				'valor_no_ato'	=> $item['valor_venda'],
				'produto_id'	=> $item['id'],
				'venda_id'		=> $vid
			);
			$newIten->add( $datP );

		endif;
		
		wp_die();
	}



	add_action( 'wp_ajax_remove_to_cart', 'remove_to_cart' );
	add_action( 'wp_ajax_nopriv_remove_to_cart', 'remove_to_cart' );

	function remove_to_cart() 
	{
		$id = $_POST['product'];
		$vid = $_SESSION['paodigital']['venda'];

		//$pod = pods( 'cardapio', $id );

		$item = pods( 'item', array('where' => "produto_id = {$id} AND venda_id = {$vid}") ); 
		$itemData = $item->data();

		if( $item->total_found() > 0 ):
			$data = $itemData[0];

			//var_dump($id);

			if( $data->quantidade == 1 ):

				//remove item of list
				$qtd = pods('item');
				$qtd->delete($data->id);
				
			else:
				$qt = ($data->quantidade - 1);
				$qtd = pods('item', $data->id);
				$qtd->save('quantidade', $qt);
			endif;

		endif;
			
		wp_die();
	}





	add_action( 'wp_ajax_get_the_cart', 'get_the_cart' );
	add_action( 'wp_ajax_nopriv_get_the_cart', 'get_the_cart' );

	function get_the_cart() 
	{
		$grandTotal = 0.00;
		$vid = $_SESSION['paodigital']['venda'];
		//$itens = pods('item', array('where' => "venda_id = {$vid}"));
		$itens = pods_query("
			SELECT *, (valor_no_ato * quantidade ) AS sub_total
			FROM pd_pods_item 
			WHERE venda_id = {$vid}");


		foreach( $itens as $key => $total ):
			$grandTotal = $grandTotal + $total->sub_total;
			include(locate_template('lib/template-itens.php'));
		endforeach;


		$vcp = pods( 'venda', $vid );
		$cupomId = $vcp->display('cupom');


		$cupomData = pods( 'cupom', $cupomId );
		$percent = str_replace( ",", ".", $cupomData->display('desconto') );
		$hasCp = ( $cupomData->display('desconto') > 0 ) ? true : false;

		$ventrega = "5,00";
		$vvoucher = ( $grandTotal * ( $percent / 100 ) );
		$vtotal = ( $grandTotal + $ventrega - $vvoucher );

		$itens = [
			'subtotal' 	=> "R$ ".number_format($grandTotal, 2, ',', '.'),
			'voucher'	=> "R$ ".number_format($vvoucher, 2, ',', '.'),
			'hasvouch'  => $hasCp,
			'ventrega'	=> "R$ ".number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> "R$ ".number_format($vtotal, 2, ',', '.'),
			'html'		=> $html
		];

		echo json_encode($itens);
		wp_die();
	}

	




	/*
		CART FUNCTIONS - FIRST CREATE ITEM INTO CART
		============================================
	*/

	function get_payment_closed( $id )
	{
		$grandTotal = 0.00;
		$vid = $id;

		$itens = pods_query("
			SELECT *, (valor_no_ato * quantidade ) AS sub_total
			FROM pd_pods_item 
			WHERE venda_id = {$vid}");

		foreach( $itens as $key => $total ):
			$grandTotal = $grandTotal + $total->sub_total;
		endforeach;

		$ventrega = "5,00";
		$vvoucher = 0.00;
		$vtotal = ( $grandTotal + $ventrega - $vvoucher );

		$itens = [
			'subtotal' 	=> "R$ ".number_format($grandTotal, 2, ',', '.'),
			'voucher'	=> $vvoucher,
			'ventrega'	=> "R$ ".number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> "R$ ".number_format($vtotal, 2, ',', '.')
		];

		return $itens;
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


	add_action( 'wp_ajax_save_polygon', 'save_polygon' );
	add_action( 'wp_ajax_nopriv_save_polygon', 'save_polygon' );
	function save_polygon()
	{
		$postedData = $_POST["polygon"];
		$tempData = str_replace("\\", "",$postedData);
		$cleanData = json_decode($tempData, true);

		//var_dump($cleanData);
	
		$array = array(
			'string'		=> base64_encode( $_POST["polygon"] ),
			'parceiro_id'	=> $_POST["parceiro"]
		);
		$maps = pods("maps");
		$mapid = $maps->save($array);


		if( is_array($cleanData) && count($cleanData) > 0 ):
			foreach ($cleanData as $key => $point):

				$pointarray = array(
					'latitude'		=> $point['lat'],
					'longitude'		=> $point['lng'],
					'map_id'		=> $mapid
				);
				$maps = pods("mappoint");
				$maps->save($pointarray);

			endforeach;
		endif;



		wp_die();

	}


	add_action( 'wp_ajax_delete_polygon', 'delete_polygon' );
	add_action( 'wp_ajax_nopriv_delete_polygon', 'delete_polygon' );
	function delete_polygon()
	{
		$where = array(
			'where'   => 'parceiro_id = ' . $_POST['parceiro'],
			'limit'   => -1
		);
		$map = pods('maps', $where );
		$maps = $map->data(); 


		if( !empty($maps) ):
			foreach( $maps as $key => $val ):

		

				$map->delete($val->id);

				$mapoint = pods( 'mappoint', array( 'where'   => "map_id = {$val->id}", 'limit' => -1 ) );
				$mapoints = $mapoint->data(); 
				if( !empty($mapoints) ):
					foreach( $mapoints as $key => $val ):

						$mapoint->delete($val->id);

					endforeach;
				endif;

			endforeach;
		endif;


		echo true;
		wp_die();

	}


	add_action( 'wp_ajax_remove_address', 'remove_address' );
	add_action( 'wp_ajax_nopriv_remove_address', 'remove_address' );

	function remove_address() 
	{
		$address = $_POST['address'];
		$user = wp_get_current_user();

		$add = pods('usuarioendereco', array("where" => "user_id = {$user->ID} AND id = {$address}"));
		$nadd = $add->data()[0];

		$add->delete($nadd->id);

		wp_die();
	}



	/*
		THIS PARTS IS FOR GET ALL PARCEIROS BY CEP AND ASSOCIATE WITH MAPS POLIGONS. 
		ITS VERY IMPORTANT TO LEARN ALL GOOGLE MAPS API TO CONCERN AND RESOLVE ALL PROBLEMS
		===================================================================================
	*/

	add_action( 'wp_ajax_get_all_parceiros_by_cep', 'get_all_parceiros_by_cep' );
	add_action( 'wp_ajax_nopriv_get_all_parceiros_by_cep', 'get_all_parceiros_by_cep' );

	function get_all_parceiros_by_cep() 
	{
		$parceiros = array();
		$myAddress = array();
		$cep = $_POST['cep'];

		$cstreet = wp_remote_get("https://viacep.com.br/ws/{$cep}/json/");
		$cstreet = $cstreet['body'];
		$cstreet = json_decode($cstreet);
		$clograd = $cstreet->logradouro;
		$clocali = $cstreet->localidade;
		$cuf 	 = $cstreet->uf;

		$cepass = wp_remote_get("https://maps.googleapis.com/maps/api/geocode/json?address={$cep}&key=AIzaSyBV2fGkkJbjzROwAewWvVZNuNRPFNNvVsk");

		$request = json_decode($cepass['body'], true);

		if( $request['status'] == "ZERO_RESULTS" ):

			$cepass = wp_remote_get("https://maps.googleapis.com/maps/api/geocode/json?address={$clograd},{$clocali},{$cuf}&key=AIzaSyBV2fGkkJbjzROwAewWvVZNuNRPFNNvVsk");

			$request = json_decode($cepass['body'], true);

		endif;

		$myAddress = $request['results'][0]['geometry']['location']['lat'] . ' ' . $request['results'][0]['geometry']['location']['lng'];


		//get all 
		$where = array( 
			'limit' => -1,
		);
		$maps = pods('maps', $where);


		if ( 0 < $maps->total() ):
			$o = 0;
			while ( $maps->fetch() ):

				$mapid = $maps->display('id');
				$parid = $maps->display('parceiro_id');
				
				$polygon = array();

				$mapoint = pods('mappoint', array( 'where' => "map_id = {$mapid}" ) );
				if ( 0 < $mapoint->total() ):
					$i = 0;
					while ( $mapoint->fetch() ):


						$polygon[$i] = $mapoint->display('latitude') . ' ' . $mapoint->display('longitude');

					$i++;
					endwhile;
				endif;

		
				
				//var_dump($polygon);
				//var_dump($myAddress);

				$pointLocation = new pointLocation();
				$inside = $pointLocation->pointInPolygon($myAddress, $polygon);

				if( $inside != "outside" ):
					$parceiros[$o] = $parid;
				endif;
				
				$o++;
			endwhile;

		else:
			echo "Não temos Parceiros na sua Região";
		endif;

		print_parceiros($parceiros);

		wp_die();
	}


	function print_parceiros($parceiros)
	{
		//var_dump($parceiros);

		if( is_array($parceiros) && count($parceiros) > 0 ):
			//var_dump($parceiros);
				$parinc = implode(",", $parceiros);
				$params = array(
					'where'		=> "`t`.`id` IN ({$parinc})"
				); 

				//var_dump($params);

				// Create and find in one shot 
				$parceiros = pods( 'parceiro', $params ); 
				//var_dump($parceiros);
				$i = 1;

				//var_dump($parceiros->total());

				if ( 0 < $parceiros->total() ):
					while ( $parceiros->fetch() ):

						//var_dump($parceiros);
			?> 
				
					<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15" id="parceiro-<?php echo $i; ?>" data-id="<?php echo $i; ?>">  
						<div style="background-image: url('<?php echo $parceiros->display('logomarca'); ?>');"></div>  
						<h4>
							<?php echo $parceiros->display('bairro'); ?>-
							<?php echo $parceiros->display('estado'); ?>
						</h4>	
						<form action="<?php echo get_bloginfo('url'); ?>/cardapio" method="post">
							<input type="hidden" name="parceiro" value="<?php echo $parceiros->display('id'); ?>" />
							<input type="submit" value="Selecionar"/>
						</form>
						
														
					</div>
			<?php 
						$i++;
					endwhile; // end of books loop 
				endif; 
		else:

			echo '<div class="alert alert-warning" role="alert" style="width:100%; text-align: center; ">';
  				echo '<strong>Desculpe!</strong> Não encontramos nenhum parceiro em sua região';
			echo '</div>';

		endif;
	}




class pointLocation {
    var $pointOnVertex = true; // Check if the point sits exactly on one of the vertices?
 
    function pointLocation() {
    }
 
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {

    	$point = $this->pointStringToCoordinates($point);
        $vertices = array(); 
        $vertices_x = array();
        $vertices_y = array();
        
        foreach ($polygon as $vertex) {
            $vertic = $this->pointStringToCoordinates($vertex);
            //$vertices[] = $vertic;
        	$vertices_x[] = $vertic['x'];
        	$vertices_y[] = $vertic['y'];
        }


		function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
		{
		  $i = $j = $c = 0;
		  for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
		    if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
		     ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
		       $c = !$c;
		  }
		  return $c;
		}


		$points_polygon = count($vertices_x) - 1;  // number vertices - zero-based array
		$longitude_x = $_GET["longitude"];  // x-coordinate of the point to test
		$latitude_y = $_GET["latitude"];    // y-coordinate of the point to test

		if (is_in_polygon($points_polygon, $vertices_x, $vertices_y, $point['x'], $point['y'] )){
			return "inside";
		}
		return "outside";

		
    }
 
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }
 
    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        $zero = substr(str_replace("-", "", $coordinates[0]), 0, 10);
        $unos = substr(str_replace("-", "", $coordinates[1]), 0, 10);

        return array("x" =>  $zero, "y" => $unos );
    }
 
}



	/*
		END OF GOOGLE MAPS BY CEP
		=========================
	*/




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





