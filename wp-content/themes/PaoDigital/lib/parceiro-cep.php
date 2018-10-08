<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script>
	
	(function($){

		$("#pods-form-ui-pods-field-cep").mask("00000-000");


		$(document).on('keyup', "#pods-form-ui-pods-field-cep", function(){

			var val = $(this).val();

			if( val.length == 9 ){

				$.get("https://viacep.com.br/ws/"+val+"/json/",{}, function(data){
					console.log(data);
					$("#pods-form-ui-pods-field-bairro").val(data.bairro);
					$("#pods-form-ui-pods-field-cidade").val(data.localidade);
					$("#pods-form-ui-pods-field-estado").val(data.uf);
					$("#pods-form-ui-pods-field-rua").val(data.logradouro);
				}, 'json');

			}

		});

	})(jQuery);
</script>