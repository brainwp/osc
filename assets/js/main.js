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
			$('select.cidade').prop('disabled', false);
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
});
