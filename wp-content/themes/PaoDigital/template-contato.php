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
		<?php echo do_shortcode('[contact-form-7 id="190" title="Formulario footer"]'); ?>
	</div>
</section><!-- #contact -->

</main>





<?php get_footer(); ?>