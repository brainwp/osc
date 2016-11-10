<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main div element.
 *
 * @package Odin
 * @since 2.2.0
 */
?>
<?php $odin_footer_opts = get_option( 'odin_general' );
?>
	</div><!-- #wrapper -->

	<footer id="footer" role="contentinfo">
		<div id='rodape-topo'class="row">
			<div id='nav-footer' class="col-sm-2">
				<h4>Navegação</h4>
				<?php wp_nav_menu( array('theme_location'  => 'footer-menu', 'container' => '', 'container_class' => '', 'items_wrap' => '<ul>%3$s</ul>' ) ); ?>           
				<img id="logo-abong" src="<?php echo wp_get_attachment_image_src($odin_footer_opts['logo_abong'], 'full')[0];?>">
			</div>
			<div id='form-footer' class="col-sm-6">
				<h4>Contato</h4>
				<?php
					echo do_shortcode('[contact-form-7 id="32" title="Footer"]' );
				?>
			</div>
			<div id='info-footer' class="col-sm-4">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/observatorio-footer.png">
				<p>Rua General Jardim, 660 - 7º andar</p>
				<p>Vila Buarque - CEP 01223-010 - São Paulo/SP</p>
				<p>Horário de funcionamento do escritório:</p>
				<p>Segunda a sexta, das 9h às 19h</p>
				<a target='_blank'  href="<?php echo $odin_footer_opts['facebook'];?>"><img  class="social-footer" class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/face-footer.png"></a>
				<a target='_blank'  href="<?php echo $odin_footer_opts['twitter'];?>"><img class="social-footer"  class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-footer.png"></a>
				<a target='_blank'  href="<?php echo $odin_footer_opts['youtube'];?>"><img class="social-footer"  class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-footer.png"></a>
			</div>
		</div>
		
	</footer><!-- #footer -->
	<div id='rodape-baixo' class="row">
			<div class='esquerda' id='cc'>
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/cc.png">
				Esse portal utiliza licença Creative Commons  3.0 Brasil Atribuição não comercial, sem derivados
			</div>	
			<div class='direita feito-por' id='logos'>
				<a target="_blank" href="http://www.wordpress.org"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/wordpress.png"></a>
				<a target="_blank" href="http://www.brasa.art.br"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/brasa.png"></a>
			</div>
		</div><!-- .row -->

	<?php wp_footer(); ?>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-83933719-1', 'auto');
  ga('send', 'pageview');
 
</script>
</body>
</html>
