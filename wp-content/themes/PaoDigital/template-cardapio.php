<?php 

	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

	if( !isset( $_SESSION['paodigital']['venda'] ) ):
		wp_redirect('/');
	endif;

	if( isset($_POST['direct']) ):
		//if is direct selected parceiro
		include(locate_template('lib/cart-parceiros.php'));
	endif;

	include(locate_template('lib/cart-cardapio.php'));
	
/*
template name: Cardápio
*/

if (have_posts()) :
    while (have_posts()) : the_post();

get_header('interna');


?>

<!--==========================
menu Section
============================-->
<section id="menu">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Cardápio</h3>
			<span class="section-divider"></span>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="Prato">
									<input type="text" class="botao form-control mb-2" id="searchProducts" placeholder="Prato,ingrediente, etc...">
									<i class="fa fa-search"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="accordion" id="accordionExample">

<?php 
	if( is_array($grupos) && !empty($grupos) ):
		$index = 0;
		foreach ($grupos as $key => $grupo): 

			//get data of cardapio
			$cardapio_prm = array(
				'where'   => 't.parceiro_id = ' . $theparca . ' AND grupos.name = "' . $grupo->name . '"'
			);
			$cardapios = pods( 'cardapio', $cardapio_prm );

			if( $cardapios->total() > 0 ):

?>

									<div class="card">
										<div class="card-header" id="heading<?php echo $index; ?>">
											<h5 class="mb-0">
												<button class="btn btn-link <?php echo ($index == 0)? '':'collapsed'; ?>" type="button" data-toggle="collapse" data-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapseOne" style="text-decoration: none;">
												<?php echo $parceiros->display('nome'); ?> | <?php echo $grupo->name; ?>
												</button>
											</h5>
										</div>
										<div id="collapse<?php echo $index; ?>" class="collapse-show <?php echo ($index == 0)? '' : 'collapse'; ?>" aria-labelledby="heading<?php echo $index; ?>" >
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
			endif;
			$index++;
		endforeach;
	endif;
?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="sticky-sidebar col-md-4 col-sm-12 col-xs-12">
				<?php include(locate_template('sidebar-valores.php')); ?>
			</div>
		</div>		
	</div>
</section>

<?php 
	endwhile;
endif; 

?>

<?php get_footer(); ?>