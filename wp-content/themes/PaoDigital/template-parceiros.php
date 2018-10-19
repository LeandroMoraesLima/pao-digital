<?php 
	
	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

	include(locate_template('lib/cart-parceiros.php'));
/*
	template name: Parceiros
*/

get_header('interna');


?>


<!--==========================
More Features Section
============================-->
<section id="more-features">
	<div class="container" style="min-height: 47vh">
		<div class="section-header">
			<h3 class="section-title">Parceiros</h3>
			<span class="section-divider"></span>
		</div>
		<div class="lupa">
			<input type="text" class="botao form-control mb-2 cep" style="text-align: center;" id="inlineFormInput" placeholder="Digite seu Cep">
			<i class="fa fa-search"></i>
		</div>

		<?php if(isset($_SESSION['message'])): ?>
			<div class="alert alert-info text-center" role="alert">
			  	<?php echo $_SESSION['message']; ?>
			  	<?php unset($_SESSION['message']); ?>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		<?php endif; ?>
		<div class="row wow fadeInUp" id="parceirosHere"></div>


	</div>	
</section><!-- #more-features -->

	<script>
		(function($){

			$(".cep").mask("00000-000");
			$(document).on('keyup input', ".cep", function(){
				var val = $(this).val();
				if( val.length == 9 ){

					$.post(ajax,{
						action: 'get_all_parceiros_by_cep',
						cep: val
					}, function(data){
						$("#parceirosHere").html(data);
					}, 'html');
				}
			});

		})(jQuery);
	</script>

<?php get_footer(); ?>
