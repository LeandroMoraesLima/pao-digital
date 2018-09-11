<?php 
/*
template name: Cardápio
*/

get_header('interna');


if( !isset( $_SESSION['paodigital']['parceiro'] ) || $_SESSION['paodigital']['parceiro'] == '' || $_SESSION['paodigital']['parceiro'] != $_POST['parceiro'] ):
	$_SESSION['paodigital']['parceiro'] = $_POST['parceiro'];
endif;

$parceiro_prm = array(
	'where'   => 't.id = ' . $_POST['parceiro']
); 

$cardapio_prm = array(
	'where'   => 't.parceiro_id = ' . $_POST['parceiro']
); 
// Create and find in one shot 
$parceiros = pods( 'parceiro', $parceiro_prm ); 

$cardapios = pods( 'cardapio', $cardapio_prm );



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
									<input type="text" class="botao form-control mb-2" id="inlineFormInput" placeholder="Prato,ingrediente, etc...">
									<i class="fa fa-search"></i>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="accordion" id="accordionExample">
									<div class="card">
									    <div class="card-header" id="headingOne">
									    	<h5 class="mb-0">
								       			<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								        		<?php echo $parceiros->display('nome'); ?>
								        		</button>
								      		</h5>
								    	</div>
								   		<div id="collapseOne" class="collapse-show" aria-labelledby="headingOne" data-parent="#accordionExample">
								   			<div class="card-body">
												<ul>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>
													<li>
			  		  									<div class="image-holder" style="background-image: url('<?php echo IMG; ?>/coffee.png');">
												    		<a href="#" rel="prettyPhoto">
												    			<img src="<?php echo IMG; ?>/coffee.png" />
												    		</a>
												    	</div>
														<div class="text-holder">
															<h6>Café</h6>			 			
													    </div>
												    	<div class="price-holder">
															<span class="price">
															    R$4.50
															</span>
															<a href="javascript:void(0)" class="restaurant-add-menu-btn restaurant-add-menu-btn-0" data-rid="1519" data-id="0" data-cid="0">
																<img class="john1" src="<?php echo IMG; ?>/cinal-mais.png" >
															</a>
													    	<span id="add-menu-loader-0"></span>
												 	    </div>
													</li>		 
												</ul>
										    </div>
										</div>
									</div>  
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
			<div class="sticky-sidebar col-md-3 col-sm-12 col-xs-12">
                <div class="user-order-holder">
                    <div class="user-order">
            	        <h6>
            	        	<i class="icon-shopping-basket"></i>Dídio Churros<span class="category-price">&#36;21,90</span>
            	        </h6>			            
                        <div class="price-area dev-menu-price-con" data-vatsw="on" data-vat="13">
                            <ul>
                                <input type="hidden" id="order_subtotal_price" name="order_subtotal_price" value="21,90">
                                <li>Sub Total Do Produto
                                	<span class="price">&#36;<em class="dev-menu-subtotal">21,90</em>
                                	</span>
                                </li>
			    				<li class="restaurant-fee-con">
			    					<span class="fee-title">Taxa De Entrega</span>
			    					<span class="price">&#36;<em class="dev-menu-charges" data-confee="15.00" data-fee="15.00">8.00</em>
			    					</span>
			    				</li>		        							
			    				<input type="hidden" id="order_vat_percent" name="order_vat_percent" value="13">
								<input type="hidden" id="order_vat_cal_price" name="order_vat_cal_price" value="3.12">
								<li>Total
									<span class="price">&#36;<em class="dev-menu-vtax">29,90</em></span>
								</li>
				           		<p class="tempo">Tempo De Entrega Estimado:
				           			<span class="price"><em class="min">45-60 min</em></span>
				            	</p>
				            </ul>
                        </div>
                        <div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Insira o voucher aqui" aria-label="Recipient's username" aria-describedby="basic-addon2">
							<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2">OK</span>
							</div>
							<div class="atecao">
								<p><span>Ateção:</span>Vouchers são válidos apenas para pagamento online</p>
							</div>
						</div>
						<div class="menu-order">
					   		<a href="javascript:void(0)" class="menu-order-confirm" data-rid="1519">Escolher forma de pagamento</a>
					    </div>
                    </div>
                </div>
            </div>
        </div>		
	</div>
</section>






<?php get_footer(); ?>