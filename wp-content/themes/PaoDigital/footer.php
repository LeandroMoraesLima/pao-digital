<?php 

if (have_posts()) :
    while (have_posts()) : the_post();

?>

<!--==========================
Footer
============================-->
<footer id="footer">
	<div class="container">
		<div class="row">
			<div class="footer-logo">
				<?php $imagem = get_field('lg_logo','options'); ?>
				<img src="<?php echo $imagem; ?>)">
				<p><?php echo get_field('tf_texto','options') ?></p>
				<span><?php echo get_field('texto_desenvolvido','options') ?></span> <a href="<?php echo get_field('link_desenvolvido','options'); ?>" ><?php echo get_field('texto_do_email','options') ?></a>
			</div>
		</div>
	</div>
</footer><!-- #footer -->

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<?php wp_footer(); ?>
</body>
</html>


<?php 
	endwhile;
endif; 

?>