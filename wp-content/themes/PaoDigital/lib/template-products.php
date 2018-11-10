<li>
	<div class="image-holder" style="background-image: url('<?php echo $cardapios->display('imagem'); ?>');">
		<a href="#" rel="prettyPhoto">
			<img src="<?php echo $cardapios->display('imagem'); ?>" />
		</a>
	</div>
	<div class="text-holder">
		<h6><?php echo $cardapios->display('nome'); ?></h6>			 			
    </div>
	<div class="price-holder">
		<span class="price">
		    <?php echo $cardapios->display('valor_venda'); ?>
		</span>
		<a href="javascript:void(0)" class="add_product_to_kart" data-id="<?php echo $cardapios->display('id'); ?>" >
			<img src="<?php echo IMG; ?>/cinal-mais.png" >
		</a>
    	<span id="add-menu-loader-0"></span>
	</div>
</li>