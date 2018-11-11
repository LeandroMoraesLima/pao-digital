<?php 

class options_page {

	public function __construct() {
		
		add_action( 'wp_ajax_get_by_venda', array( $this, 'get_by_venda' ) );
		add_action( 'wp_ajax_nopriv_get_by_venda', array( $this, 'get_by_venda' ) );

		add_action( 'wp_ajax_get_by_cupons', array( $this, 'get_by_cupons' ) );
		add_action( 'wp_ajax_nopriv_get_by_cupons', array( $this, 'get_by_cupons' ) );

		add_action( 'wp_ajax_get_by_produtos', array( $this, 'get_by_produtos' ) );
		add_action( 'wp_ajax_nopriv_get_by_produtos', array( $this, 'get_by_produtos' ) );

		add_action( 'wp_ajax_get_by_clientes', array( $this, 'get_by_clientes' ) );
		add_action( 'wp_ajax_nopriv_get_by_clientes', array( $this, 'get_by_clientes' ) );

		add_action( 'wp_ajax_get_all_pedidos', array( $this, 'get_all_pedidos' ) );
		add_action( 'wp_ajax_nopriv_get_all_pedidos', array( $this, 'get_all_pedidos' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ), 10, 1 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Relatórios',
			'Relatórios',
			'manage_options',
			'relatorios',
			array(
				$this,
				'relatorios_page'
			)
		);

		add_submenu_page(
			'relatorios',
			'Por clientes',
			'por clientes',
			'manage_options',
			'porclientes',
			array(
				$this,
				'relatorios_clientes'
			)
		);

		add_submenu_page(
			'relatorios',
			'Por produtos',
			'por produtos',
			'manage_options',
			'porprodutos',
			array(
				$this,
				'relatorios_produtos'
			)
		);

		add_submenu_page(
			'relatorios',
			'Cupons utilizados',
			'Cupons utilizados',
			'manage_options',
			'porcupons',
			array(
				$this,
				'relatorios_cupons'
			)
		);


		add_menu_page(
			'Vendas',
			'Vendas',
			'manage_options',
			'pedidos',
			array($this,'pedidos_page'),
			'dashicons-star-filled'
		);
	}


	//functions
	public function  relatorios_page() {
		require_once (__DIR__."/include-report-vendas.php" );
	}

	public function relatorios_clientes()
	{
		require_once (__DIR__."/include-report-clientes.php" );
	}

	public function relatorios_produtos()
	{
		require_once (__DIR__."/include-report-produtos.php" );
	}

	public function relatorios_cupons()
	{
		require_once (__DIR__."/include-report-cupons.php" );
	}



	public function pedidos_page()
	{
		if( isset($_GET['pedido']) )
			echo "alex";
		else
			require_once (__DIR__."/include-vendas-pedidos.php" );
	}



	public function add_scripts($hook)
	{
		//var_dump($hook);
		if( $hook == 'toplevel_page_relatorios' || $hook == 'toplevel_page_pedidos' || $hook == 'relatorios_page_porclientes' || $hook == 'relatorios_page_porprodutos' || $hook == 'relatorios_page_porcupons' ):

			wp_enqueue_script( 'juis', JS . '/jquery-ui.js' );
			wp_enqueue_style( 'jucs', CSS . '/jquery-ui.css' );

			wp_enqueue_script( 'dtjs', JS . '/datatable.js', array('jquery') );
			wp_enqueue_script( 'dtjs1', JS . '/dataTables.buttons.min.js', array() );
			wp_enqueue_script( 'dtjs2', JS . '/buttons.flash.min.js', array() );
			wp_enqueue_script( 'dtjs3', JS . '/jszip.min.js', array() );
			wp_enqueue_script( 'dtjs4', JS . '/pdfmake.min.js', array() );
			wp_enqueue_script( 'dtjs5', JS . '/vfs_fonts.js', array() );
			wp_enqueue_script( 'dtjs6', JS . '/buttons.html5.min.js', array() );
			wp_enqueue_script( 'dtjs7', JS . '/buttons.print.min.js', array() );

			wp_enqueue_style( 'dtcs', CSS . '/jquery.dataTables.min.css' );
			wp_enqueue_style( 'dtcs2', CSS . '/buttons.dataTables.min.css' );
		endif;
	}

	//Get relatorios by vendas
	public function get_by_venda()
	{
		global $wpdb;
		$pf = $wpdb->prefix;

		//pagination
		$start = $_POST['start'];
		$offset = $_POST['length'];

		//from date
		if( isset($_POST['from']) && $_POST['from'] !== '' ): 
			$init = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['from']) ) );
		else:
			$init = "";
		endif;

		//to date
		if( isset($_POST['to']) && $_POST['to'] !== '' ): 
			$end = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['to']) ) );
		else:
			$end = "";
		endif;

		$init = ( isset($init) && $init !== '' )? "AND t.created >= '{$init} 00:00:00'" : "";
		$end = ( isset($end) && $end !== '' )? "AND t.created <= '{$end} 23:59:59'" : "";


		//
		if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''):
			$search = $_POST['search']['value'];
			$search = " AND ( um.meta_value LIKE '%{$search}%' OR umb.meta_value LIKE '%{$search}%' OR ve.numero LIKE '%{$search}%' OR ve.bairro LIKE '%{$search}%' OR ve.cidade LIKE '%{$search}%' OR ve.cep LIKE '%{$search}%' OR t.id LIKE '%{$search}%'  )";
		else:
			$search = "";
		endif;


		$parceiro = "";
		if( isset($_POST['parca']) && intval($_POST['parca']) > 0 ):
			$parceiro = "AND t.pd_parceiros_id = {$_POST['parca']}";
		endif;

		//datafile
		$data = array();


		//insert the joins
		$join = "
			INNER JOIN {$pf}users AS u ON u.ID = t.pd_users_id
			INNER JOIN {$pf}usermeta AS um ON um.user_id = t.pd_users_id
			INNER JOIN {$pf}usermeta AS umb ON umb.user_id = t.pd_users_id
			INNER JOIN {$pf}pods_vendaentrega AS ve ON ve.vendaid = t.id
		";

		//insert the where
		$where = "
			t.pedido = 0 
			AND t.pagamento_status = 1 
			AND um.meta_key = 'first_name'
			AND umb.meta_key = 'last_name'
			{$parceiro}
			{$search}
			{$init} 
			{$end}";

		//create the real query
		$query = array(
			'limit' 			=> $offset,
			'offset'			=> $start,
			'join'				=> $join,
			'where' 			=> $where,
			'select'			=> 't.*, ve.rua, ve.numero, ve.bairro, ve.cidade, ve.cep, um.meta_value AS firstname, umb.meta_value AS lastname'
		);

		//var_dump($query);

		//get all itens with filters
		$vendas = pods('venda', $query); 


		//create the query for all itens
		$queryTp = array(
			'join'				=> $join,
			'where' 			=> $where,
			'select'			=> 't.*, ve.rua, ve.numero, ve.bairro, ve.cidade, ve.cep, um.meta_value AS firstname, umb.meta_value AS lastname'
		);
		
		//get all itens without filters
		$toptal = pods( 'venda', $queryTp );



		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				$cl = "{$pt->firstname} {$pt->lastname}";
				$endereco = "{$pt->rua}, {$pt->numero} - <br>{$pt->bairro}, {$pt->cidade}, {$pt->cep}";

				//get valor total e quantidade de itens
				$vendasu = pods('item', array('where' => "t.venda_id = {$pt->id}"));

				$pcr = pods('parceiro', $pt->pd_parceiros_id);
				$pcr = (object)$pcr->row();

				$data[$key]['id'] = "<a href='#'>#".str_pad($pt->id, 10, '0', STR_PAD_LEFT) ."</a>"; 
				$data[$key]['cliente'] = $cl; 
				$data[$key]['parceiro'] = $pcr->nome; 
				$data[$key]['endereco'] = $endereco; 
				$data[$key]['pago'] = ( $pt->product_type == 'home' )? 'Não' : 'Sim';
				$data[$key]['datapedido'] = date( 'd-m-Y', strtotime($pt->created) ); 
				$data[$key]['valortotal'] = "R$ ".number_format($pt->preco_total, 2, ',', '.'); 
				$data[$key]['itens'] = $vendasu->total_found(); 

			endforeach;
		endif;



		$response = [
			"draw" =>  $_POST['draw'],
			"recordsFiltered" =>  $toptal->data->total,
			"recordsTotal" => $vendas->data->total,
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}

	public function get_by_clientes()
	{
		global $wpdb;
		$pf = $wpdb->prefix;

		//pagination
		$start = $_POST['start'];
		$offset = $_POST['length'];

		//from date
		if( isset($_POST['from']) && $_POST['from'] !== '' ): 
			$init = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['from']) ) );
		else:
			$init = "";
		endif;

		//to date
		if( isset($_POST['to']) && $_POST['to'] !== '' ): 
			$end = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['to']) ) );
		else:
			$end = "";
		endif;

		$init = ( isset($init) && $init !== '' )? "AND t.created >= '{$init} 00:00:00'" : "";
		$end = ( isset($end) && $end !== '' )? "AND t.created <= '{$end} 23:59:59'" : "";

		//
		if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''):
			$search = $_POST['search']['value'];
			$search = " AND ( um.meta_value LIKE '%{$search}%' OR umb.meta_value LIKE '%{$search}%' OR ve.numero LIKE '%{$search}%' OR ve.bairro LIKE '%{$search}%' OR ve.cidade LIKE '%{$search}%' OR ve.cep LIKE '%{$search}%' OR t.id LIKE '%{$search}%'  )";
		else:
			$search = "";
		endif;


		$parceiro = "";
		if( isset($_POST['parca']) && intval($_POST['parca']) > 0 ):
			$parceiro = "AND t.pd_parceiros_id = {$_POST['parca']}";
		endif;

		$data = array();


		//insert the joins
		$join = "
			INNER JOIN {$pf}users AS u ON u.ID = t.pd_users_id
			INNER JOIN {$pf}usermeta AS um ON um.user_id = t.pd_users_id
			INNER JOIN {$pf}usermeta AS umb ON umb.user_id = t.pd_users_id
			INNER JOIN {$pf}pods_vendaentrega AS ve ON ve.vendaid = t.id
		";

		//insert the where
		$where = "
			t.pedido = 0 
			AND t.pagamento_status = 1 
			AND um.meta_key = 'first_name'
			AND umb.meta_key = 'last_name'
			{$parceiro}
			{$search}
			{$init} 
			{$end}";


		$customSelect = "(SELECT SUM(quantidade) FROM pd_pods_item WHERE venda_id IN ( SELECT id from pd_pods_venda where pd_users_id = t.pd_users_id AND pedido = 0 AND pagamento_status = 1 ) ) AS qtitens";


		//create the real query
		$query = array(
			'limit' 			=> $offset,
			'offset'			=> $start,
			'join'				=> $join,
			'groupby' 			=> 't.pd_users_id',
			'where' 			=> $where,
			'select'			=> "t.pd_users_id, {$customSelect}, t.pd_parceiros_id, t.preco_total, t.desconto, t.pagamento_status, t.product_type, t.created, t.modified, ve.rua, ve.numero, ve.bairro, ve.cidade, ve.cep, um.meta_value AS firstname, umb.meta_value AS lastname, sum(t.pagamento_status) as qtd, sum(t.preco_total) as precototal, sum(t.desconto) as desco"
		);

		//var_dump($query);

		//get all itens with filters
		$vendas = pods('venda', $query); 

		//echo $vendas->sql;


		//create the query for all itens
		$queryTp = array(
			'join'				=> $join,
			'where' 			=> $where,
			'groupby' 			=> 't.pd_users_id',
			'select'			=> "t.pd_users_id, {$customSelect}, t.pd_parceiros_id, t.preco_total, t.desconto, t.pagamento_status, t.product_type, t.created, t.modified, ve.rua, ve.numero, ve.bairro, ve.cidade, ve.cep, um.meta_value AS firstname, umb.meta_value AS lastname, sum(t.pagamento_status) as qtd, sum(t.preco_total) as precototal, sum(t.desconto) as desco"
		);
		
		//get all itens without filters
		$toptal = pods( 'venda', $queryTp );



		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				//Get Clientes
				$cl = "{$pt->firstname} {$pt->lastname}";

				//Get Address
				$endereco = "{$pt->rua}, {$pt->numero} - <br>{$pt->bairro}, {$pt->cidade}";


				$data[$key]['id'] = $pt->pd_users_id;
				$data[$key]['cliente'] = $cl;
				$data[$key]['endereco'] = $endereco;
				$data[$key]['qtcompras'] = $pt->qtd;
				$data[$key]['valores'] = "R$ ".number_format($pt->precototal, 2, ',', '.');
				$data[$key]['descontos'] = "R$ ".number_format($pt->desco, 2, ',', '.');
				$data[$key]['qtprodutos'] = $pt->qtitens;

			endforeach;
		endif;


		$response = [
			"draw" =>  $_POST['draw'],
			"recordsFiltered" =>  $toptal->data->total,
			"recordsTotal" => $vendas->data->total,
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}

	public function get_by_produtos()
	{
		global $wpdb;
		$pf = $wpdb->prefix;

		//pagination
		$start = $_POST['start'];
		$offset = $_POST['length'];

		//from date
		if( isset($_POST['from']) && $_POST['from'] !== '' ): 
			$init = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['from']) ) );
		else:
			$init = "";
		endif;

		//to date
		if( isset($_POST['to']) && $_POST['to'] !== '' ): 
			$end = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['to']) ) );
		else:
			$end = "";
		endif;

		$init = ( isset($init) && $init !== '' )? "AND t.created >= '{$init} 00:00:00'" : "";
		$end = ( isset($end) && $end !== '' )? "AND t.created <= '{$end} 23:59:59'" : "";

		//
		if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''):
			$search = $_POST['search']['value'];
			$search = " AND ( t.id LIKE '%{$search}%' OR t.nome LIKE '%{$search}%' )";
		else:
			$search = "";
		endif;


		$parceiro = "";
		if( isset($_POST['parca']) && intval($_POST['parca']) > 0 ):
			$parceiro = "AND t.pd_parceiros_id = {$_POST['parca']}";
		endif;

		$data = array();

		$vendaOk = pods('venda', array(
			'limit'		=> -1,
			'where'		=> "t.pedido = 0 AND t.pagamento_status = 1 {$init} {$end} {$parceiro}",
			'select'	=> "t.id"
		));

		$ids = array();
		$whereIten = "";
		if( $vendaOk->total_found() > 0 ):
			while ( $vendaOk->fetch() ):
				$ids[] = $vendaOk->display('id');
			endwhile;

			$it = implode(",", $ids);
			$whereIten = "AND t.venda_id IN ({$it})";
		else:
			$whereIten = "AND t.id = 0 ";
		endif;

		$where = "1=1 {$search} {$whereIten}";

		//get all itens with filters
		$vendas = pods('item',
			array(
				'limit' 		=> $offset,
				'offset'		=> $start,
				'where' 		=> $where,
				'groupby' 		=> 'produto_id',
				'select' 		=> "*, sum(quantidade) AS pdt, sum(doma) AS venda"
			)
		);


		//get all itens without filters
		$toptal = pods('item',
			array(
				'limit' => -1,
				'where' => $where,
				'groupby' => 'produto_id',
				'select' => "*, sum(quantidade) as pdt, sum(doma) AS venda"
			)
		);

		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				//$vendas = pods('item', array('where' => "t.produto_id = {$pt->produto_id}"));

				$data[$key]['id'] = $pt->id; 
				$data[$key]['nome'] = $pt->nome; 
				$data[$key]['valorun'] = "R$ ".number_format($pt->valor_no_ato, 2, ',', '.'); 
				$data[$key]['valortotal'] = "R$ ".number_format( ( $pt->pdt * $pt->valor_no_ato ), 2, ',', '.');
				$data[$key]['totalitens'] = $pt->pdt;
				$data[$key]['vendas'] = $pt->venda;


			endforeach;
		endif;

		///var_dump($toptal);


		$response = [
			"draw" =>  $_POST['draw'],
			"recordsFiltered" =>  $toptal->data->total,
			"recordsTotal" => $vendas->data->total,
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}

	public function get_by_cupons()
	{
		global $wpdb;
		$pf = $wpdb->prefix;

		//pagination
		$start = $_POST['start'];
		$offset = $_POST['length'];

		//from date
		if( isset($_POST['from']) && $_POST['from'] !== '' ): 
			$init = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['from']) ) );
		else:
			$init = "";
		endif;

		//to date
		if( isset($_POST['to']) && $_POST['to'] !== '' ): 
			$end = date("Y-m-d", strtotime( str_replace("/", "-", $_POST['to']) ) );
		else:
			$end = "";
		endif;

		$init = ( isset($init) && $init !== '' )? "AND t.created >= '{$init} 00:00:00'" : "";
		$end = ( isset($end) && $end !== '' )? "AND t.created <= '{$end} 23:59:59'" : "";

		//
		if(isset($_POST['search']['value']) && $_POST['search']['value'] !== ''):
			$search = $_POST['search']['value'];
			$search = " AND ( cp.name LIKE '%{$search}%' OR cp.descricao LIKE '%{$search}%' OR cp.tag_do_cupom LIKE '%{$search}%' )";
		else:
			$search = "";
		endif;

		$parceiro = "";
		if( isset($_POST['parca']) && intval($_POST['parca']) > 0 ):
			$parceiro = "AND t.pd_parceiros_id = {$_POST['parca']}";
		endif;



		$data = array();


		//insert the joins
		$join = "
			INNER JOIN {$pf}pods_cupom AS cp ON cp.id = t.cupom
		";

		//insert the where
		$where = "
			t.pedido = 0 
			AND t.pagamento_status = 1 
			AND t.cupom IS NOT NULL
			{$parceiro}
			{$search}
			{$init} 
			{$end}";


		//create the real query
		$query = array(
			'limit' 			=> $offset,
			'offset'			=> $start,
			'join'				=> $join,
			'groupby' 			=> 'cupom',
			'where' 			=> $where,
			'select'			=> "t.*, sum(t.preco_total) as precototal, sum(t.cupom) as vezes, cp.id AS cid, cp.name, cp.descricao, cp.tag_do_cupom, cp.desconto, cp.ativo"
		);

		//get all itens with filters
		$vendas = pods('venda', $query); 


		//create the real query
		$tquery = array(
			'limit' 			=> -1,
			'join'				=> $join,
			'groupby' 			=> 'cupom',
			'where' 			=> $where,
			'select'			=> "t.*, sum(t.preco_total) as precototal, sum(t.cupom) as vezes, cp.id AS cid, cp.name, cp.descricao, cp.tag_do_cupom, cp.desconto, cp.ativo"
		);
		

		//get all itens without filters
		$toptal = pods('venda', $tquery );



		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				$data[$key]['id'] = $pt->cid; 
				$data[$key]['cupom'] = $pt->name; 
				$data[$key]['tag'] = $pt->tag_do_cupom; 
				$data[$key]['total'] = "R$ ".number_format($pt->precototal, 2, ',', '.'); 
				$data[$key]['desconto'] = $pt->desconto . " %"; 
				$data[$key]['ativo'] = ($pt->ativo == 1)? "Sim" : "Não"; 
				$data[$key]['usado'] = ($pt->vezes / $pt->cupom); 

			endforeach;
		endif;


		$response = [
			"draw" =>  $_POST['draw'],
			"recordsFiltered" =>  $toptal->data->total,
			"recordsTotal" => $vendas->data->total,
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}


	//get all pedidos
	public function get_all_pedidos()
	{
		$data = array();

		$where = "pedido = 0";

		$vendas = 	pods('venda', 
						array(
							'limit' => -1,
							'where' => $where
						)
					);




		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				//Get Clientes
				$cliente = get_user_by( 'id', $pt->pd_users_id );
				$cl = "<a href='/wp-admin/admin.php?page=pedidos&pedido={$pt->id}'>
							{$cliente->first_name} {$cliente->last_name}
						</a>";


				//Get Address
				$ventrega = pods('vendaentrega', array(
					'where' => "vendaid = {$pt->id}"
				));
				$ve = (object)$ventrega->fetch();
				$endereco = "{$ve->rua}, {$ve->numero} - <br>{$ve->bairro}, {$ve->cidade}";


				//Get total itens
				$items = pods('item', array(
					'where' 	=> "venda_id = {$pt->id}",
					'select'	=> "sum(quantidade) as qt"
				));
				$it = (object)$items->fetch();


				$check = "<input type='checkbox' id='' />";

				$data[$key]['cliente'] = $cl;
				$data[$key]['endereco'] = $endereco;
				$data[$key]['telefone'] = get_user_meta($pt->pd_users_id, 'user_telefone' );
				$data[$key]['qtdade'] = $it->qt;
				$data[$key]['valor'] = "R$ ".number_format($pt->preco_total, 2, ',', '.');
				$data[$key]['pago'] = ( $pt->pagamento_status == 1 ) ? "Sim" : "Não";
				$data[$key]['entrega'] = $check;

			endforeach;
		endif;


		$response = [
			"draw" =>  $_POST['draw'],
			"recordsFiltered" =>  $vendas->total(),
			"recordsTotal" => $vendas->total_found(),
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}























}

new options_page;