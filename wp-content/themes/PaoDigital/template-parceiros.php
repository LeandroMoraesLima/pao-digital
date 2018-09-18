<?php 
	
	if( !is_user_logged_in() ):
		wp_redirect('/');
	endif;

/*
	template name: Parceiros
*/

get_header('interna');


if( isset($_POST['plano']) ):
// this is the sessioin if is a plano
	if( 
		!isset( $_SESSION['paodigital']['plano'] )
		|| $_SESSION['paodigital']['plano'] == ''
		|| $_SESSION['paodigital']['plano'] != $_POST['plano'] 
	):
		echo "plano aqui!";
		$_SESSION['paodigital']['plano'] = $_POST['plano'];
		$_SESSION['paodigital']['type'] = 'home';

	endif;

endif;


if( isset($_POST['type']) ):
// this is the session if is a type
	if( 
		!isset( $_SESSION['paodigital']['type'] ) 
		|| $_SESSION['paodigital']['type'] == ''
		|| $_SESSION['paodigital']['type'] != $_POST['type'] 
	):
		echo "type aqui!";
		$_SESSION['paodigital']['type'] = $_POST['type'];
		$_SESSION['paodigital']['plano'] = 'noplan';

	endif;

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

		<?php if( current_user_can('administrator')): ?>
			<form action="/" id="formParceiros" method="post">
		<?php endif; ?>

		<div class="row wow fadeInUp" id="parceirosHere">

		<?php 	
			$params = array(
				'orderby'	=> 'parceiros_order ASC'
			); 
			// Create and find in one shot 
			$parceiros = pods( 'parceiro', $params ); 
			$i = 1;

			if ( 0 < $parceiros->total() ):
				while ( $parceiros->fetch() ):
		?> 
			
		

				<div class="col-xs-6 col-sm-3 col-md-15 col-lg-15" id="parceiro-<?php echo $i; ?>" data-id="<?php echo $i; ?>">  
					<div style="background-image: url('<?php echo $parceiros->display('logomarca'); ?>');"></div>  
					<h4>
						<?php echo $parceiros->display('bairro'); ?>-
						<?php echo $parceiros->display('estado'); ?>
					</h4>	

					<?php if( current_user_can('administrator')): ?>
						<div class="text-center">
							<input type="number" class="nposition" min="1" max="<?php echo $parceiros->total(); ?>" name="ordem[<?php echo $parceiros->display('id'); ?>][position]" style="max-width:50px;" value="<?php echo $i; ?>" />
							<button class="nbutton" data-i="<?php echo $i; ?>" style="opacity:0; cursor: pointer; border: none; background-color:#ffb600; color: #FFF;">Salvar</button>
							<div class="col-md-12">
								<label for="">Mostrar</label>
								<input type="checkbox" <?php echo ($parceiros->display('presente_na_homepage') == 'Yes') ? 'checked="checked"' : ''; ?> name="ordem[<?php echo $parceiros->display('id'); ?>][home]"  />
							</div>
						</div>
					<?php else: ?>
						<form action="/cardapio" method="post">
							<input type="hidden" name="parceiro" value="<?php echo $parceiros->display('id'); ?>" />
							<input type="submit" value="Selecionar"/>
						</form>
					<?php endif; ?>	
					
													
				</div>
		<?php 
					$i++;
				endwhile; // end of books loop 
			endif;
		?>

		</div>
	
		<?php if( current_user_can('administrator')): ?>
			</form>
			<div class="col-md-12 text-center">
				<button id="salvaOrdem" style="display:none; cursor: pointer; border: none; background-color:#ffb600; color: #FFF; padding: 20px 40px;">Salvar Organização</button>
			</div>
		<?php endif; ?>


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

<?php if( current_user_can('administrator')): ?>
	<script>
		(function($){

			$(document).on("keyup change click",".nposition", function(){
				var parent = $(this).parent('div');
				$('button', parent).css('opacity', '1');
			});

			$(document).on("click", ".nbutton", function(){
				var i = $(this).data('i');
				var dvTotal = $("#parceiro-"+i);
				var position = $("div .nposition",dvTotal).val();
				var clone = $(dvTotal).clone();
				$(dvTotal).remove();
				if( position == 1 ){
					$("#parceirosHere > div:nth-child("+ ( 1 ) +")").before(clone);
				} else {
					
					$("#parceirosHere > div:nth-child("+ ( position - 1 ) +")").after(clone);
				}

				$.each( $("#parceirosHere > div"), function(e,l){
					$( ".nposition" ,l).val(e + 1);
				});

				$("#salvaOrdem").css('display', "inline-block");
			});

			$(document).on('change', 'input[type=checkbox]', function(){
				$("#salvaOrdem").css('display', "inline-block");
			});

			$(document).on("click", "#salvaOrdem", function(){

				var it = $("#formParceiros").serialize();
				$.post(ajax, {
					action: 'save_order_of_partners',
					itens: it,
					type: 'parceiros'
				}, function(data){
					
				}, 'json');
			});

		})(jQuery);
	</script>
<?php endif; ?>

<?php get_footer(); ?>
