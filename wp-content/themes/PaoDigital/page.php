<?php 


get_header('interna');

if (have_posts()) :
    while (have_posts()) : the_post();

?>


<!--==========================
Our Team Section
============================-->
<section id="team" class="interna">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="row">
					
					<div class="text col-lg-12 content wow fadeInRight">
						<h3 class="title"><?php the_title(); ?></h3>
						<hr class="line">
						<span class="section-divider"></span>
						<p class="section-description">
							<?php the_content(); ?> 
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section><!-- #team -->



<?php 
	endwhile;
endif;
?>

<?php get_footer(); ?>