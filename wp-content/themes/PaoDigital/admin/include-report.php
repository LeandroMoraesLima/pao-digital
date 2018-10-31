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
			wp_enqueue_style( 'dtcs', CSS . '/jquery.dataTables.min.css' );
		endif;
	}

	//Get relatorios by vendas
	public function get_by_venda()
	{
		$data = array();

		$where = "pedido = 0 AND pagamento_status = 1";

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
				$cl = "{$cliente->first_name} {$cliente->last_name}";


				//Get Address
				$ventrega = pods('vendaentrega', array(
					'where' => "vendaid = {$pt->id}"
				));
				$ve = (object)$ventrega->fetch();
				$endereco = "{$ve->rua}, {$ve->numero} - <br>{$ve->bairro}, {$ve->cidade}";


				$vendas = pods('item', array('where' => "t.venda_id = {$pt->id}"));


				$data[$key]['id'] = "<a href='#'>#".str_pad($pt->id, 10, '0', STR_PAD_LEFT) ."</a>"; 
				$data[$key]['cliente'] = $cl; 
				$data[$key]['endereco'] = $endereco; 
				$data[$key]['pago'] = ( $pt->product_type == 'home' )? 'Não' : 'Sim';
				$data[$key]['datapedido'] = date( 'd-m-Y', strtotime($pt->created) ); 
				$data[$key]['valortotal'] = "R$ ".number_format($pt->preco_total, 2, ',', '.'); 
				$data[$key]['itens'] = $vendas->total_found(); 

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

	public function get_by_clientes()
	{
		$data = array();

		$where = "pedido = 0 AND pagamento_status = 1";

		$vendas = 	pods('venda', 
						array(
							'limit' => -1,
							'where' => $where,
							'groupby' => 'pd_users_id',
							'join'	=> 'INNER JOIN `pd_pods_item` ON `pd_pods_item`.`venda_id` = t.id',
							'select' => 't.*, sum(t.pagamento_status) as qtd, sum(t.preco_total) as precototal, sum(t.desconto) as desco, count(pd_pods_item.id) as qtitens' 
						)
					);

		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				//Get Clientes
				$cliente = get_user_by( 'id', $pt->pd_users_id );
				$cl = "{$cliente->first_name} {$cliente->last_name}";


				//Get Address
				$ventrega = pods('vendaentrega', array(
					'where' => "vendaid = {$pt->id}"
				));
				$ve = (object)$ventrega->fetch();
				$endereco = "{$ve->rua}, {$ve->numero} - <br>{$ve->bairro}, {$ve->cidade}";


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
			"recordsFiltered" =>  $vendas->total(),
			"recordsTotal" => $vendas->total_found(),
			"data" => $data,
		];

		echo json_encode($response);

		die();
	}

	public function get_by_produtos()
	{
		$data = array();

		//$where = "pedido = 0 AND pagamento_status = 1";

		$vendas = 	pods('item',
						array(
							'limit' => -1,
							//'where' => $where,
							'groupby' => 'produto_id',
							'select' => '*, sum(quantidade) as pdt'
						)
					);

		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				$vendas = pods('item', array('where' => "t.produto_id = {$pt->produto_id}"));

				$data[$key]['id'] = $pt->id; 
				$data[$key]['nome'] = $pt->nome; 
				$data[$key]['valorun'] = "R$ ".number_format($pt->valor_no_ato, 2, ',', '.'); 
				$data[$key]['valortotal'] = "R$ ".number_format( ( $pt->pdt * $pt->valor_no_ato ), 2, ',', '.');
				$data[$key]['totalitens'] = $pt->pdt;
				$data[$key]['vendas'] = $vendas->total_found();


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

	public function get_by_cupons()
	{
		$data = array();

		$where = "pedido = 0 AND pagamento_status = 1 AND cupom IS NOT NULL";

		$vendas = 	pods('venda', 
						array(
							'limit' => -1,
							'where' => $where,
							'groupby' => 'cupom',
							'select' => '*, sum(preco_total) as precototal, sum(cupom) as vezes'
						)
					);

		//var_dump($vendas->data());

		if( $vendas->total_found() > 0 ):
			foreach( $vendas->data() as $key => $pt ):

				$cupoms = pods('cupom', $pt->cupom);
				$cupom = (object)$cupoms->row();

				$data[$key]['id'] = $cupom->id; 
				$data[$key]['cupom'] = $cupom->name; 
				$data[$key]['tag'] = $cupom->tag_do_cupom; 
				$data[$key]['total'] = "R$ ".number_format($pt->precototal, 2, ',', '.'); 
				$data[$key]['desconto'] = $cupom->desconto . " %"; 
				$data[$key]['ativo'] = ($cupom->ativo == 1)? "Sim" : "Não"; 
				$data[$key]['usado'] = ($pt->vezes / $pt->cupom); 

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