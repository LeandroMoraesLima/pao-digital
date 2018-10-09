
<script>
		

	(function($){
		$("#pods-form-ui-pods-field-parceiro-id").attr("readonly", "readonly");

		$(document).on('change', ".pods-form-ui-field-name-pods-field-parceiros", function(){

			$("#pods-form-ui-pods-field-parceiro-id").val( $(this).val() );

			
		});

	})(jQuery);

</script>