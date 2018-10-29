<?php 

class options_page {

	public function __construct() {
		
		add_action( 'wp_ajax_get_by_venda', array( $this, 'get_by_venda' ) );
		add_action( 'wp_ajax_nopriv_get_by_venda', array( $this, 'get_by_venda' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ), 10, 1 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Relatório',
			'Relatório',
			'manage_options',
			'relatorio',
			array(
				$this,
				'relatorios_page'
			)
		);
	}

	public function  relatorios_page() {
		require_once (__DIR__."/include-report-vendas.php" );
	}


	public function add_scripts($hook)
	{
		if( $hook == 'toplevel_page_relatorio' ):
			wp_enqueue_script( 'juis', JS . '/jquery-ui.js' );
			wp_enqueue_style( 'jucs', CSS . '/jquery-ui.css' );

			wp_enqueue_script( 'dtjs', JS . '/datatable.js', array('jquery') );
			wp_enqueue_style( 'dtcs', CSS . '/jquery.dataTables.min.css' );

		endif;
	}

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

				$data[$key]['id'] = "<a href='#'>#".str_pad($pt->id, 10, '0', STR_PAD_LEFT) ."</a>"; 
				$data[$key]['cliente'] = $pt->pd_users_id; 
				$data[$key]['endereco'] = $pt->id; 
				$data[$key]['pago'] = $pt->id; 
				$data[$key]['datapedido'] = $pt->id; 
				$data[$key]['valortotal'] = "R$ ".number_format($pt->preco_total, 2, ',', '.'); 
				$data[$key]['itens'] = $pt->id; 

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