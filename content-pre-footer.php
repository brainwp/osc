
<div class="pre-footer">
	<div class="col-sm-4 newsletter box-footer">
		<img class="img-contato"src="<?php echo get_template_directory_uri();?>/assets/images/mail.png"  alt="">
		<h4><i>Assine e acompanhe o Observatório da Sociedade Civil</i></h4>
		<?php 
		// echo do_shortcode('[contact-form-7 id="651" title="Formulario home"]' ); ?>
		<?php echo do_shortcode('[contact-form-7 id="235" title="newsletter"]' ); ?>

		<!-- <input type="text">
		<input type="email"> -->
		<img id="enviar-newsletter" src="" alt="">
	</div>
	<div class="col-sm-4 meio box-footer">
		<h4><i>Encontre o observatório nas redes sociais</i></h4>
		<?php $odin_footer_opts = get_option( 'odin_general' );?>
		<div class='socials-pre' >
			<a target='_blank'  href="<?php echo $odin_footer_opts['facebook'];?>"><img  class="social-footer" class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/face-footer.png"></a>
			<a target='_blank'  href="<?php echo $odin_footer_opts['twitter'];?>"><img class="social-footer"  class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-footer.png"></a>
			<a target='_blank'  href="<?php echo $odin_footer_opts['youtube'];?>"><img class="social-footer"  class='inline-block' src="<?php echo get_template_directory_uri(); ?>/assets/images/youtube-footer.png"></a>			
		</div>
	</div>
	<div class="col-sm-4 link-banco box-footer">
		<img class="img-contato"src="<?php echo get_template_directory_uri();?>/assets/images/banco-arquivo.png"  alt="">
		<h4><i>Acesse o Banco de Práticas Alternativas </i></h4>
		<p>Conheça experiências reais que unem justiça social, radicalização da democracia e harmonia com o meio ambiente</p>
		<a href="home-banco"> <div  id="link-banco"></div></a>
	</div>
</div>