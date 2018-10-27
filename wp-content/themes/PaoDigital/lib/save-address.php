<?php 


	function prefix_send_email_to_admin() {
		/**
		 * At this point, $_GET/$_POST variable are available
		 *
		 * We can do our normal processing here
		 */ 
		
		$user_id = get_current_user_id();

		$user_id = wp_update_user( 
			array( 
				'ID' 			=> $user_id, 
				'user_email' 	=> $_POST['email_order'],
				'first_name'	=> $_POST['name'],
				'last_name'		=> $_POST['lastname'],
				'description'	=> $_POST['notes']
			) 
		);

		if ( get_user_meta($user_id, 'user_telefone', true ) ):
			update_user_meta( $user_id, 'user_telefone', $_POST['tel'] );
		else:
			add_user_meta( $user_id, 'user_telefone', $_POST['tel'] );
		endif;


		if ( get_user_meta($user_id, 'user_cpf', true ) ):
			update_user_meta( $user_id, 'user_cpf', $_POST['cpf'] );
		else:
			add_user_meta( $user_id, 'user_cpf', $_POST['cpf'] );
		endif;


		if( isset($_POST['save-address']) ):
			
			if( count( $_POST['address'] ) > 0 ):
				foreach ( $_POST['address'] as $key => $add ):

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

		
		wp_redirect( get_bloginfo('url') . "/detalhes-do-seu-pedido/" );

	}
	
	add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
	add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );

	