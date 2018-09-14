<?php 
/*
	template name: Contato
*/

get_header('interna');

?>


<!--==========================
Our Team Section
============================-->
<section id="team" class="interna">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 wow fadeInLeft">
						<img src="<?php echo IMG; ?>/drive-thru-pao-digital.jpg">
					</div>	
					<div class="text col-lg-6 content wow fadeInRight">
						<h3 class="title"><?php echo get_field('sc_titulo','options') ?></h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description">
							<?php echo get_field('sc_texto','options') ?> 
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #team -->


<!--==========================
Contact Section
============================-->
<section id="contact">
	<div class="container">
		<div class="section-header">
			<h3 class="section-title">contato</h3>
			<hr>
		</div>
		<div class="row wow fadeInUp">
			<div class="col-md-8 offset-md-2">
				<div class="contact left">
					<input type="text" name="nome" autocomplete="name" placeholder="Nome" required>
					<input type="text" name="empresa" autocomplete="organization" placeholder="Empresa">
					<input type="text" name="telefone" autocomplete="tel-national" placeholder="Telefone" required>
				</div>
				<div class="contact right">
					<textarea name="mensagem" placeholder="Mensagem" required></textarea>   
				</div>
			</div>
		</div>
		<div class="botao">
			<a href="#" class="ver">Ver todos parceiros</a>
		</div>
	</div>
</section><!-- #contact -->

</main>





<?php get_footer(); ?>