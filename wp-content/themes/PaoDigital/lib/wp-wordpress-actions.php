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




	add_action('admin_enqueue_scripts', 'cstm_css_and_js');

	function cstm_css_and_js($hook) {

		if ( 'index.php' != $hook ) {
			return;
		}

		wp_enqueue_style('boot_css', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
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



