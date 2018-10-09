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
	
	private $card_number = "5155901222280001";

	private $seller_id = "f32bfdfa-8dd5-4f45-b7d9-147050c2bd53";

	private $httpcode = 400;

	private $compra = false;

	private $status = '';

	private $venda = 0;
	
	public function __construct()
	{
		$this->venda = $_SESSION['paodigital']['venda'];
		unset( $_SESSION['paodigital']['venda'] );

		$this->current_user = wp_get_current_user();
		$this->customer_id = str_pad($current_user->ID, 12, '0', STR_PAD_LEFT);

		//get authentication
		$this->get_authentication();

		if( $this->httpcode == 200 && isset( $this->auth['access_token'] ) ):

			//get token of card
			$this->tokenization();

			if( $this->httpcode == 201 && isset( $this->tokenizado['number_token'] ) ):
				
				$this->verification();
				$st = $this->verificado['status'];

				if( $this->httpcode == 200 && isset( $st ) && $st == 'VERIFIED' ):

					$this->get_payment();
					$cp = $this->comprado['status'];

					if( $this->httpcode == 200 && isset( $cp ) && $cp == 'APPROVED' ):
						$this->compra = true;
					else:
						$this->compra = false;
					endif;

				else:
					$this->compra = false;
				endif;

			else:
				$this->compra = false;
			endif;

		else:
			$this->compra = false;
		endif;

		return $this->venda;
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
			"cardholder_name"	=> "Alex S. Morais",
			"expiration_month"	=> "12",
			"expiration_year"	=> "18",
			"security_code"		=> "123"
		);


		$cr = curl_init();
		curl_setopt($cr, CURLOPT_URL, "https://api-homologacao.getnet.com.br/v1/cards/verification"); 
		curl_setopt($cr,CURLOPT_HTTPHEADER, array(
			"Content-type: application/json",
			"Authorization: Bearer ".$this->auth['access_token']
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

		$order_id = 0;

		$jsonArray = array (
			'seller_id' => $this->seller_id,
			'amount' => 100,
			'currency' => 'BRL',
			'order' => array (
				'order_id' => str_pad($order_id, 12, '0', STR_PAD_LEFT),
				'sales_tax' => 0,
				'product_type' => "",
			),
			'customer' => array (
				'customer_id' => 'customer_21081826',
				'first_name' => 'João',
				'last_name' => 'da Silva',
				'name' => 'João da Silva',
				'email' => 'customer@email.com.br',
				'document_type' => 'CPF',
				'document_number' => '12345678912',
				'phone_number' => '5551999887766',
  				'billing_address' => array (
					'street' => 'Av. Brasil',
					'number' => '1000',
					'complement' => 'Sala 1',
					'district' => 'São Geraldo',
					'city' => 'Porto Alegre',
					'state' => 'RS',
					'country' => 'Brasil',
					'postal_code' => '90230060',
				),

			),
			'device' => array (
				'ip_address' => $this->get_client_ip(),
				'device_id' => session_id(),
			),
			'shippings' => array (
				0 => array (
					'first_name' => 'João',
					'name' => 'João da Silva',
					'email' => 'customer@email.com.br',
					'phone_number' => '5551999887766',
					'shipping_amount' => 3000,
					'address' => array (
						'street' => 'Av. Brasil',
						'number' => '1000',
						'complement' => 'Sala 1',
						'district' => 'São Geraldo',
						'city' => 'Porto Alegre',
						'state' => 'RS',
						'country' => 'Brasil',
						'postal_code' => '90230060',
					),
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
					"cardholder_name"	=> "Alex S. Morais",
					"expiration_month"	=> "12",
					"expiration_year"	=> "18",
					"security_code"		=> "123"
				),
			),
		);


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

	}


	public function close_payment()
	{
		$pagamento = new stdClass();
		//card values
		$pagamento->card_name 		= $_POST['card_name'];
		$pagamento->card_number 	= $_POST['card_number'];
		$pagamento->expire_month 	= $_POST['expire_month'];
		$pagamento->expire_year 	= $_POST['expire_year'];
		$pagamento->ccv 			= $_POST['ccv'];

		//user Id
		$pagamento->user 			= $this->current_user;
		$pagamento->user_id 		= $user->ID;

		//compra
		$this->close_itens();
		$compra 			= pods("venda", $this->venda );

		//endereco de entrega
	}

	public function close_itens()
	{

	}

	
	/*
		function to get type of card
		============================
	*/
	public function get_type_card($card_number)
	{
		$cards = array(
			"visa" => "(4\d{12}(?:\d{3})?)",
			"amex" => "(3[47]\d{13})",
			"jcb" => "(35[2-8][89]\d\d\d{10})",
			"maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
			"solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
			"mastercard" => "(5[1-5]\d{14})",
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




