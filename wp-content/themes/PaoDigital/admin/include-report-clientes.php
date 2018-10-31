
<style>
	#wpwrap {
		background-color: white !important;
	}
	.bd-example {
	    position: relative;
	    padding: 1rem;
	    margin: 1rem -15px 0;
	    border: solid #f7f7f9;
	    border-width: .2rem 0 0;
	}

	.nav {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -ms-flex-wrap: wrap;
	    flex-wrap: wrap;
	    padding-left: 0;
	    margin-bottom: 0;
	    list-style: none;
	}

	.nav-tabs .nav-item {
		margin-bottom: 0px;
	}

	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
	    color: #495057;
	    background-color: #fff;
	    border-color: #dee2e6 #dee2e6 #fff;
		border-bottom: 1px solid white;
		position: relative;
		bottom: -1px;
	}

	.nav-link {
	    display: block;
	    padding: .5rem 1rem;
	}
	.nav-tabs .nav-link {
	    border: 1px solid transparent;
	    border-top-left-radius: .25rem;
	    border-top-right-radius: .25rem;
	    border-bottom: 0px;
	}
	

	.nav-tabs {
	    border-bottom: 1px solid #dee2e6;
	}

</style>

<div class="bd-example">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="/wp-admin/admin.php?page=relatorios">Venda (em R$)</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="/wp-admin/admin.php?page=porclientes">Clientes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/wp-admin/admin.php?page=porprodutos">Produtos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/wp-admin/admin.php?page=porcupons">Vouchers Utilizados</a>
		</li>
	</ul>
</div>


<div style="padding: 20px 40px;">

	<div class="data" style="padding-bottom: 30px;">
		<strong>
			relatorio entre as datas:
		</strong>
		<input type="text" autocomplete="off" id="from" />
		<input type="text" autocomplete="off" id="to" />
	</div>
	
	<table id="example" class="display" style="width:100%; text-align: left;">
		<thead>
			<tr>
				<th>#ID</th>
				<th>Cliente</th>
				<th>Endereço</th>
				<th>Qtd Compras</th>
				<th>Valores Gastos</th>
				<th>Descontos Obtidos</th>
				<th>Qtd Produtos</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>#ID</th>
				<th>Cliente</th>
				<th>Endereço</th>
				<th>Qtd Compras</th>
				<th>Valores Gastos</th>
				<th>Descontos Obtidos</th>
				<th>Qtd Produtos</th>
			</tr>
		</tfoot>
	</table>
</div>





<script>


(function($) {

 	window.oTable = $('#example').DataTable({
 		"info": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": ajaxurl,
			"type": "POST",
			"data": function(d) {
				d.action = 'get_by_clientes',
				d.from = $("#from").val(),
				d.to = $("#to").val()
			}
		},
		"aLengthMenu": [[10, 20, 50, 75, 100], [10, 20, 50, 75, 100]],
		"language": {
			"lengthMenu": "_MENU_",
			"zeroRecords": "No results",
			"search": ""
		},
		"order": [[ 3, "desc" ]],
		"columns": [
			{ "data": "id", bSortable: false },
			{ "data": "cliente", bSortable: false },
			{ "data": "endereco", bSortable: false },
			{ "data": "qtcompras", bSortable: false },
			{ "data": "valores", bSortable: false },
			{ "data": "descontos", bSortable: false },
			{ "data": "qtprodutos", bSortable: false }
		]
	});



		//var dateFormat = "mm/dd/yy",
		$("#from").datepicker({
			dateFormat: "dd/mm/yy",
		  	"onSelect": function(date) {
		  		minDateFilter = new Date(date).getTime();
		  		oTable.draw();
		  	}
		})
		.keyup(function() {
			minDateFilter = new Date(this.value).getTime();
			oTable.draw();
		});

		$("#to").datepicker({
			dateFormat: "dd/mm/yy",
		  	"onSelect": function(date) {
		  		maxDateFilter = new Date(date).getTime();
		  		oTable.draw();
		  	}
		})
      	.keyup(function() {
      		maxDateFilter = new Date(this.value).getTime();
			oTable.draw();
		});

		// //
		// //Date range filter
		minDateFilter = "";
		maxDateFilter = "";

		$.fn.dataTableExt.afnFiltering.push(
		function(oSettings, aData, iDataIndex) {
			if (typeof aData._date == 'undefined') {
				aData._date = new Date(aData[0]).getTime();
			}

			if (minDateFilter && !isNaN(minDateFilter)) {
				if (aData._date < minDateFilter) {
					return false;
				}
			}

			if (maxDateFilter && !isNaN(maxDateFilter)) {
				if (aData._date > maxDateFilter) {
					return false;
				}
			}

			return true;
		});
})(jQuery);



</script>