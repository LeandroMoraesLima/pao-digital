<?php 

$html .= "
<li>
	<div class='col-12'>
		<div class='row'>
			<div class='col-8 text-left'>
				<i class='fa fa-minus-circle remove_product_to_kart' data-id='{$total->produto_id}'></i>
				<span>".$total->quantidade."</span>
				<i class='fa fa-plus-circle add_product_to_kart' data-id='{$total->produto_id}'></i>
				<span class='ttle'>".$total->nome."</span>
			</div>
			<div class='col-4 text-right'>
				<span>R$ ".number_format($total->valor_no_ato, 2, ',', '.')."</span>
			</div>
		</div>
	</div>
</li>";