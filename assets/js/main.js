jQuery(document).ready(function($) {
	// fitVids.
	$( '.entry-content' ).fitVids();

	// Responsive wp_video_shortcode().
	$( '.wp-video-shortcode' ).parent( 'div' ).css( 'width', 'auto' );

	/**
	 * Odin Core shortcodes
	 */

	// Tabs.
	$( '.odin-tabs a' ).click(function(e) {
		e.preventDefault();
		$(this).tab( 'show' );
	});

	// Tooltip.
	$( '.odin-tooltip' ).tooltip();



	$('.ajax-filtro-tema').change(function(e){	
		busca = $('#filtro-palavra').val();
		// materiaisFiltro(busca);
			
	});
	
	
	
	$("#continue").click(function(e){
		e.preventDefault();
		$('#resumo p:nth-child(5)').css('max-height','500px');
		$('#continue-p').fadeOut();
	});



	$('.uf').change(function(){
		if( $(this).val() ) {
			val=$(this).val();
			$(this).siblings('select.cidade').prop('disabled', 'disabled');
			// $(this).siblings('.cidade-carregando').css('opacity', '1');
			var data = {
				'action': 'altera_cidade',
				'cod_estado':$(this).val()
		};
		select_cidade=$(this).siblings('select.cidade');
		console.log(data);
			$.post(odin_main.ajaxurl, data, function(response) {
			// console.log(response);
			$(select_cidade).html(response);

			$(select_cidade).prop('disabled', false);
			// $('.cidade-carregando').css('opacity', '0');
		});


			// $.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val(), ajax: 'true'}, function(j){
			// 	var options = '<option value=""></option>';	
			// 	for (var i = 0; i < j.length; i++) {
			// 		options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
			// 	}	
			// 	$('#cod_cidades').html(options).show();
			// 	$('.carregando').hide();
			// });
		} else {
			$('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
		}
	});
	$('#tema-continua-cadastro').change(function(){
		tema_change($(this));
	});


		function tema_change(e){
		var data = {
				'action': 'pega_sub',
				'mae':$(e).val(),
		};
		$.post(odin_main.ajaxurl, data, function(response) {
			// console.log(response);
			$('#subs').html(response);
		});	
	};
	
	$("#enviar-cadastro").click(function(e){
		e.preventDefault();
		var data = {
				'action': 'cadastra_pratica',
				'tax':'',
				'title':$('.title').val()

		};
		var tax={}
		
		$(".acf").each(function (i) {
			var nome=$(this).attr('name');
			
			data[nome]=$(this).val();
    	});
    	$("#continua-cadastro .ajax-filtro-materiais").each(function (i) {
			var nome=$(this).attr('name');
			// console.log();
			data.tax=$(this).children('option:selected').val()+','+data.tax;
    	});

		console.log(data);
		$.post(odin_main.ajaxurl, data, function(response) {
			$('#continua-cadastro').html(response);
		});	
	});

	// continua cadastro
	$("#continua-cadastro-btn").click(function(e){
				e.preventDefault();
		nome=$('#cadastro .nome').val();
		uf=$('#cadastro .uf').val();
		cidade=$('#cidade-cadastro').val();
		tema=$('#cadastro #tema-cadastro').val();
		$("#continua-cadastro .uf").val(uf);
		$("#continua-cadastro .cidade").val(cidade);
		$("#tema-continua-cadastro").val(tema);
		$('#continua-cadastro .nome').val(nome);
		tema_change($("#tema-continua-cadastro"));
		$('#cadastro .nome').prop('disabled', 'disabled');
		$('#cadastro .uf').prop('disabled', 'disabled');
		$('#cadastro .cidade').prop('disabled', 'disabled');
		$('#cadastro #tema-cadastro').prop('disabled', 'disabled');

		$('#continua-cadastro').fadeIn();
		$('html, body').animate({
        scrollTop: $("#continua-cadastro").offset().top
    }, 2000);
	});
	$('#pesquisa a').click(function(e){
					e.preventDefault();
	uf=$("#pesquisa .uf").val();
	cidade=$("#pesquisa .cidade").val();
	tema=$("#tema-busca").val();
	nome=$("#filtro-palavra").val();
	console.log('uf'+uf);
	console.log('cidade'+cidade);
	console.log('tema'+tema);
	console.log('nome'+nome);

	window.location.href = "http://rede.com.br/osc/pratica/?s="+nome+"&tema="+tema+"&cidade="+cidade+"&uf="+uf;
	});
});

