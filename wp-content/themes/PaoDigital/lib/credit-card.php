<?php 

/**
 * Class to generate Payment
 */
class GetPayment
{
	private $auth = array();

	private $tokenizado = array();
	
	private $current_user = array();

	private $verificado = array();

	private $comprado = array();
	
	private $customer_id = 0;
	
	private $card_number = "";

	private $seller_id = "f32bfdfa-8dd5-4f45-b7d9-147050c2bd53";

	private $httpcode = 400;

	public $compra = false;

	private $status = '';

	public $venda = 0;

	public $error = "";
	
	public function __construct()
	{

		$this->card_number = str_replace( " ", "", $_POST['card_number'] );
		$this->venda = $_SESSION['paodigital']['venda'];

		$this->get_the_card();

		$_SESSION['paodigital']['errorsVenda'] = $this->error;

		//die();
		unset( $_SESSION['paodigital'] );
		unset( $_POST );

		return $this->venda;
	}


	public function get_the_card()
	{

		$this->current_user = wp_get_current_user();
		$this->customer_id = str_pad($this->current_user->ID, 12, '0', STR_PAD_LEFT);

		//get authentication
		$this->get_authentication();

		if( $this->httpcode == 200 && isset( $this->auth['access_token'] ) ):

			//get token of card
			$this->tokenization();

			if( $this->httpcode == 201 && isset( $this->tokenizado['number_token'] ) ):

				$this->verification();
		
				$st = $this->verificado['status'];
				// var_dump($this->verificado); die();

				if( $this->httpcode == 200 && isset( $st ) && $st == 'VERIFIED' ):

					$this->get_payment();
					$cp = $this->comprado['status'];
					//var_dump($this->comprado); die();
	
					if( $this->httpcode == 200 && isset( $cp ) && $cp == 'APPROVED' ):
						
						$this->compra = true;
						$this->close_itens();

					else:

						$this->compra = false;
					endif;

				else:

					$this->error = "A verificação dos dados do cartão Falhou!";
					$this->compra = false;
				endif;

			else:
				$this->error = "Erro com os dados do Cartão de Crédito!";
				$this->compra = false;
			endif;

		else:
			$this->error = "Authenticação com a Api de Pagamento Falhou!"; 
			$this->compra = false;
		endif;

		if( $this->compra == false ):
			$this->cancelPayment();
		endif;

	}

	public function cancelPayment()
	{
		$vcp = pods( 'venda', $this->venda );
		$vcp->save(
			array( 
				"pago_com"  => "cancelado",
				"pedido"	=> 0,
			)
		);

		return false;

	}


	/*
		AUTHENTICATION TO GET BEARER
		============================
	*/
	public function get_authentication()
	{
		$tk = base64_encode("7db37b37-91a3-444c-bf51-14b33f78b055:a7995759-f53d-474b-a03e-3d438a830706");
		$cr = curl_init();
		curl_setopt($cr, CURLOPT_URL, "https://api-homologacao.getnet.com.br/auth/oauth/v2/token"); 
		curl_setopt($cr,CURLOPT_HTTPHEADER, array(
			"authorization: Basic {$tk}",
			"content-type: application/x-www-form-urlencoded"
		));
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cr, CURLOPT_ENCODING, '');
		curl_setopt($cr, CURLOPT_HEADER, 0); 
		curl_setopt($cr, CURLOPT_POST, TRUE);
		curl_setopt($cr, CURLOPT_POSTFIELDS, 'scope=oob&grant_type=client_credentials');
		$this->auth = json_decode(curl_exec($cr), true);
		$this->httpcode = curl_getinfo($cr, CURLINFO_HTTP_CODE);
		curl_close($cr);

	}

	/*
		TOKENIZATION OF CREDIT CARDS
		============================
	*/
	public function tokenization()
	{
		$jsonArray = array(
			"card_number" 		=> $this->card_number,
			"customer_id"		=> $this->customer_id
		);

		$cr = curl_init();
		curl_setopt($cr, CURLOPT_URL, "https://api-homologacao.getnet.com.br/v1/tokens/card"); 
		curl_setopt($cr,CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Authorization: Bearer ".$this->auth['access_token'],
			"seller_id: {$this->seller_id}"
		));
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cr, CURLOPT_ENCODING, '');
		curl_setopt($cr, CURLOPT_HEADER, 0); 
		curl_setopt($cr, CURLOPT_POST, TRUE);
		curl_setopt($cr, CURLOPT_POSTFIELDS, json_encode( $jsonArray ) );
		$this->tokenizado = json_decode(curl_exec($cr), true);
		$this->httpcode = curl_getinfo($cr, CURLINFO_HTTP_CODE);
		curl_close($cr);

		//var_dump($this->tokenizado);

	}

	/*
		Verificação de cartão
		=====================
		https://developers.getnet.com.br/api#tag/Pagamento%2Fpaths%2F~1v1~1cards~1verification%2Fpost
	*/
	public function verification()
	{

		$jsonArray = array(
			"number_token" 		=> $this->tokenizado['number_token'],
			"brand"				=> $this->get_type_card($this->card_number),
			"cardholder_name"	=> $_POST['card_name'],
			"expiration_month"	=> $_POST['expire_month'],
			"expiration_year"	=> $_POST['expire_year'],
			"security_code"		=> $_POST['ccv']
		);

		$cr = curl_init();
		curl_setopt($cr, CURLOPT_URL, "https://api-homologacao.getnet.com.br/v1/cards/verification"); 
		curl_setopt($cr,CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Authorization: Bearer ".$this->auth['access_token'],
			"seller_id: {$this->seller_id}"
		));
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cr, CURLOPT_ENCODING, '');
		curl_setopt($cr, CURLOPT_HEADER, 0); 
		curl_setopt($cr, CURLOPT_POST, TRUE);
		curl_setopt($cr, CURLOPT_POSTFIELDS, json_encode( $jsonArray ) );
		$this->verificado = json_decode(curl_exec($cr), true);
		$this->httpcode = curl_getinfo($cr, CURLINFO_HTTP_CODE);
		curl_close($cr);

	}

	/*
		Pagamento com cartão de Credito
		===============================
	*/
	public function get_payment()
	{
		$order_id = $this->venda;
		$add = $this->get_address($this->current_user->id);
		$paymentClosed = $this->close_payment();

		$pag = (object)$paymentClosed->row();

		$cpf = get_user_meta( $this->current_user->id, 'user_cpf', true );
		$phone = get_user_meta( $this->current_user->id, 'user_telefone', true );

		$jsonArray = array (
			'seller_id' => $this->seller_id,
			'amount' => str_replace(".", "", $pag->preco_total ),
			'currency' => 'BRL',
			'order' => array (
				'order_id' => str_pad($order_id, 12, '0', STR_PAD_LEFT),
				'sales_tax' => 0,
				'product_type' => "",
			),
			'customer' => array (
				'customer_id' => $this->customer_id,
				'first_name' => $this->current_user->first_name,
				'last_name' => $this->current_user->last_name,
				'name' => $this->current_user->first_name . " " . $this->current_user->last_name,
				'email' => $this->current_user->user_email,
				'document_type' => 'CPF',
				'document_number' => $this->filter($cpf),
				'phone_number' => $this->filter($phone),
  				'billing_address' => $add,

			),
			'device' => array (
				'ip_address' => $this->get_client_ip(),
				'device_id' => session_id(),
			),
			'shippings' => array (
				0 => array (
					'first_name' => $this->current_user->first_name,
					'name' => $this->current_user->first_name . " " . $this->current_user->last_name,
					'email' => $this->current_user->user_email,
					'phone_number' => $this->filter($phone),
					'shipping_amount' => 3000,
					'address' => $add,
				)
			),
			'credit' => array (
				'delayed' => false,
				'authenticated' => false,
				'pre_authorization' => false,
				'save_card_data' => false,
				'transaction_type' => 'FULL',
				'number_installments' => 1,
				'soft_descriptor' => 'PAO-DIGITAL',
				'dynamic_mcc' => 5462,
				'card' => array (
					"number_token" 		=> $this->tokenizado['number_token'],
					"brand"				=> $this->get_type_card($this->card_number),
					"cardholder_name"	=> $_POST['card_name'],
					"expiration_month"	=> $_POST['expire_month'],
					"expiration_year"	=> $_POST['expire_year'],
					"security_code"		=> $_POST['ccv']
				),
			),
		);

		// var_dump($jsonArray);
		// var_dump($this->auth['access_token']);
		

		$cr = curl_init();
		curl_setopt($cr, CURLOPT_URL, "https://api-homologacao.getnet.com.br/v1/payments/credit"); 
		curl_setopt($cr,CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Authorization: Bearer ".$this->auth['access_token']
		));
		curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($cr, CURLOPT_ENCODING, '');
		curl_setopt($cr, CURLOPT_HEADER, 0); 
		curl_setopt($cr, CURLOPT_POST, TRUE);
		curl_setopt($cr, CURLOPT_POSTFIELDS, json_encode( $jsonArray ) );
		$this->comprado = json_decode(curl_exec($cr), true);
		$this->httpcode = curl_getinfo($cr, CURLINFO_HTTP_CODE);
		curl_close($cr);

		// var_dump($this->comprado);
		// var_dump($this->httpcode);

	}

	public function filter($iten)
	{
		return str_replace(
			array(" ", "-", "."), 
			array("","",""), 
			$iten
		);
	}


	public function close_payment()
	{
		return $this->close_itens($vd);

	}

	public function close_itens()
	{
		$grandTotal = 0.00;
		
		$itens = pods_query("
			SELECT *, (valor_no_ato * quantidade ) AS sub_total
			FROM pd_pods_item 
			WHERE venda_id = {$this->venda}");



		foreach( $itens as $key => $total ):
			$grandTotal = $grandTotal + $total->sub_total;
		endforeach;

		$vcp = pods( 'venda', $this->venda );
		$cupomId = $vcp->display('cupom');


		$cupomData = pods( 'cupom', $cupomId );
		//var_dump($cupomData->display('desconto'));
		$percent = str_replace( ",", ".", $cupomData->display('desconto') );
	
		$hasCp = ( $cupomData->display('desconto') > 0 ) ? true : false;

		$ventrega = VALOR_ENTREGA;
		$vvoucher = 0.00;

		if( $hasCp == true ):
			$vvoucher = ( $grandTotal * ( $percent / 100 ) );
		endif;
		$vtotal = ( $grandTotal + $ventrega - $vvoucher );

		$itens = [
			'subtotal' 	=> "R$ ".number_format($grandTotal, 2, ',', '.'),
			'voucher'	=> "R$ ".number_format($vvoucher, 2, ',', '.'),
			'hasvouch'  => $hasCp,
			'ventrega'	=> "R$ ".number_format($ventrega, 2, ',', '.'),
			'vtotal'	=> "R$ ".number_format($vtotal, 2, ',', '.'),
			'html'		=> $html
		];

		//var_dump($itens);

		$podVenda = pods('venda', $this->venda);
		$podVenda->save(array(
			'preco_total' 					=> $vtotal,
			'desconto'						=> $vvoucher,
			'taxas'							=> VALOR_ENTREGA,
			'pagamento_status'				=> 1,
			'pago_com'						=> 'credito',
			'retirado'						=> 0,
			'pedido'						=> 0,
		));


		//Pegar endereco de entrega caso for entrega
		$enderecoUser = pods('usuarioendereco', array(
			'where' => "user_id = {$this->current_user->ID} AND entrega = 1"
		));
		$endUser = $enderecoUser->data();
		$endUser = (object)$endUser[0];

		$endVenda = pods('vendaentrega');
		$endVenda->save(array(
			'rua' 			=> $endUser->endereco,
			'numero' 		=> $endUser->numero,
			'bairro' 		=> $endUser->bairro,
			'cep' 			=> $endUser->cep,
			'cidade' 		=> $endUser->cidade,
			'estado' 		=> $endUser->estado,
			'complemento' 	=> $endUser->complemento,
			'vendaid' 		=> $podVenda->id
		));
		//fim 
		

		return $podVenda;

	}

	public function get_address($userId)
	{
		$address = pods('usuarioendereco', array( 
						'where' => "user_id = {$userId} AND entrega = 1",
						'limit'	=> 1 
		));

		if( $address->total_found() > 0 ):

			$add = $address->data();
			$newAdd = $add[0];

			return array(
				'street' => $newAdd->endereco,
				'number' => $newAdd->numero,
				'complement' => '',
				'district' => $newAdd->bairro,
				'city' => $newAdd->cidade,
				'state' => $newAdd->estado,
				'country' => 'Brasil',
				'postal_code' => str_replace("-", "", $newAdd->cep),
			);

		else: 
			return array();
		endif;
	}

	
	/*
		function to get type of card
		============================
	*/
	public function get_type_card($card_number)
	{
		$cards = array(
			"Visa" => "(4\d{12}(?:\d{3})?)",
			"Amex" => "(3[47]\d{13})",
			"Jcb" => "(35[2-8][89]\d\d\d{10})",
			"Maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
			"Solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
			"Mastercard" => "(5[1-5]\d{14})",
			"switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
		);

		$card_type = 'unknown';

		foreach ($cards as $card => $pattern) {
			if (preg_match('/' . $pattern . '/', $card_number)) {
				$card_type = $card;
				break;
			}
		}

		return $card_type;
	}

	public function get_client_ip() 
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
}


$payment = new GetPayment();




