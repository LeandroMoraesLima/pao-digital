<?php 


	function prefix_send_email_to_admin() {
		/**
		 * At this point, $_GET/$_POST variable are available
		 *
		 * We can do our normal processing here
		 */ 

		try {

			$user_id = get_current_user_id();


			if( $_POST['name'] == "" || $_POST['lastname'] == "" || $_POST['tel'] = "" || $_POST['cpf'] == "" ):
				$_SESSION['paodigital']['msg'] = "Confirme se Nome, Sobrenome, Telefone ou CPF estão corretamente preenchidos!";
				wp_redirect( get_bloginfo('url') . "/detalhes-do-seu-pedido/" );
			endif;

			$user_id = wp_update_user( 
				array( 
					'ID' 			=> $user_id,
					'first_name'	=> $_POST['name'],
					'last_name'		=> $_POST['lastname'],
					'description'	=> $_POST['notes']
				) 
			);

			if ( get_user_meta($user_id, 'user_telefone' ) ):
				$a = update_user_meta( $user_id, 'user_telefone', $_POST['tel_order'] );
			else:
				$a = add_user_meta( $user_id, 'user_telefone', $_POST['tel_order'] );
			endif;

			if ( get_user_meta($user_id, 'user_cpf', true ) ):
				update_user_meta( $user_id, 'user_cpf', $_POST['cpf'] );
			else:
				add_user_meta( $user_id, 'user_cpf', $_POST['cpf'] );
			endif;


			$error = false;
			$entrega = false;
			if( isset($_POST['save-address']) ):
				
				if( count( $_POST['address'] ) > 0 ):
					foreach ( $_POST['address'] as $key => $add ):


//check address
if( empty($add['cep']) || empty($add['address']) || empty($add['bairro']) || empty($add['city']) || empty($add['state']) ):
	$error = true;
endif;


						//check entrega
						if( isset( $add['entrega'] ) ):
							$entrega = true;
						endif;

						$id = $add['house'];
						
						if( $add['house'] > 0 ):

							$params = array(
								'where'		=> "id = {$id} AND user_id = {$user_id}", 
								'limit'		=> 1
							); 
							$address = pods( 'usuarioendereco', $params );

							if( (integer)$address->total_found() > 0 ):
								$newAddress = pods('usuarioendereco', $address->display('id') );
								$array = [
									'name' => $add['desc'],
									'created' => date('Y-m-d H:i:s'),
									'modified' => date('Y-m-d H:i:s'),
									'cep' => $add['cep'],
									'endereco' => $add['address'],
									'user_id' => $user_id,
									'bairro' => $add['bairro'],
									'cidade' => $add['city'],
									'estado' => $add['state'],
									'entrega' => ( isset( $add['entrega'] ) )? 1 : 0 ,
									'numero' => $add['num'],
									'complemento' => $add['complemento']
								];
								$newAddress->save($array);
							endif;

						else:

							$newAddress = pods('usuarioendereco');
							$array = [
								'name' => $add['desc'],
								'created' => date('Y-m-d H:i:s'),
								'modified' => date('Y-m-d H:i:s'),
								'cep' => $add['cep'],
								'endereco' => $add['address'],
								'user_id' => $user_id,
								'bairro' => $add['bairro'],
								'cidade' => $add['city'],
								'estado' => $add['state'],
								'entrega' => ( isset( $add['entrega'] ) ) ? 1 : 0 ,
								'numero' => $add['num'],
								'complemento' => $add['complemento']
							];
							$newAddress->save($array);

						endif;

					endforeach;

				endif;

			endif;



			/*
				Verificacao quanto ao dados dos endereços
			*/
			if( $error == true ):

				$_SESSION['paodigital']['msgAddress'] = "Preencha corretamente todos os endereços criados";
				$_SESSION['paodigital']['msgAddressType'] = "danger";
				wp_redirect( get_bloginfo('url') . "/detalhes-do-seu-pedido/" );

			else:

				if( $entrega == false ):

					$_SESSION['paodigital']['msgAddress'] = "Escolha um endereço padrão.";
					$_SESSION['paodigital']['msgAddressType'] = "danger";
					wp_redirect( get_bloginfo('url') . "/detalhes-do-seu-pedido/" );

				else :

					$_SESSION['paodigital']['msgAddress'] = "Endereço salvo com sucesso!";
					$_SESSION['paodigital']['msgAddressType'] = "success";
					wp_redirect( get_bloginfo('url') . "/formas-de-pagamento" );

				endif;

			endif;
			
		} catch (Exception $e) {
			
			$_SESSION['paodigital']['msgAddress'] = "Não Foi Possivel salvar o endereço tente novamente.";
			$_SESSION['paodigital']['msgAddressType'] = "danger";
			wp_redirect( get_bloginfo('url') . "/detalhes-do-seu-pedido/" );

		}
		
		

	}
	
	add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
	add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );

	