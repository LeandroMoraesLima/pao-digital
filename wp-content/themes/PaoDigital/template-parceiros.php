<?php 
/*
	template name: Parceiros
*/

get_header('interna');

global $wp_session;
if( !isset( $wp_session['paodigital']['plano'] ) || $wp_session['paodigital']['plano'] == '' || $wp_session['paodigital']['plano'] != $_POST['plano'] ):
	$wp_session['paodigital']['plano'] = $_POST['plano'];
endif;




?>


<!--==========================
More Features Section
============================-->
<section id="more-features">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">Parceiros</h3>
			<span class="section-divider"></span>
		</div>
		<div class="lupa">
			<input type="text" class="botao form-control mb-2" id="inlineFormInput" placeholder="Pesquise Bairro">
			<i class="fa fa-search"></i>
		</div>
		<div class="row wow fadeInUp" id="parceirosHere">
			
		<?php 	
			
			$params = array(
				'limit'   => 15
			); 

			// Create and find in one shot 
			$parceiros = pods( 'parceiro', $params ); 

			if ( 0 < $parceiros->total() ):
				while ( $parceiros->fetch() ):
		?> 

				<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15">  
					<div style="background-image: url('<?php echo $parceiros->display('logomarca'); ?>');"></div>  
					<h4>
						<?php echo $parceiros->display('bairro'); ?>-
						<?php echo $parceiros->display('estado'); ?>
					</h4>	
					
					<form action="/cardapio" method="post">
						<input type="hidden" name="parceiro" value="<?php echo $parceiros->display('id'); ?>" />
						<input type="submit" value="Selecionar"/>
					</form>
													
				</div>
		<?php 
				endwhile; // end of books loop 
			endif;
		?>

		</div>
	</div>	
</section><!-- #more-features -->

<script type="text/javascript">
	(function($){

		$(document).on("keyup", "#inlineFormInput", function(){
			var val = this.value;
			if( val.length > 3 ){

				$.post(ajax, {
					action: 'get_parceiros',
					s: val
				}, function(data){
					$("#parceirosHere").html(data);
				}, 'html');

			}
		});

	})(jQuery);
</script>

<?php get_footer(); ?>
