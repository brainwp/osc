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
	$(document).on('change',"#subs select",function(e){
		//Write stuffs		
		var data = {
				'action': 'pega_sub2',
				'mae':$(this).val(),
		};
		$.post(odin_main.ajaxurl, data, function(response) {
			// console.log(response);
			$('#subs2').html(response);
		});		
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
	// continua cadastro
	// continua cadastro
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
	// continua cadastro
	// continua cadastro
	// continua cadastro
	// continua cadastro


	// envia cadastro
	// envia cadastro
	// envia cadastro

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
			data.tax=data.tax+','+$(this).children('option:selected').val();
    	});
    	data.imagem_destacada=$('#imagem_destacada').attr('data-id');
		data.attachments=$('#attachments').val();
		data.anexos=$('#ids-anexos').val();
		data.galeria=$('#ids-anexos-gal').val();
		data.edicao = $("#edicao").val();
		data.postId = $("#postId").val();


		console.log(data);
		$.post(odin_main.ajaxurl, data, function(response) {
			console.log(response);
			if (response == "<h3>Obrigado, sua prática será ser analisada e publicada futuramente.</h3>"){
				$('#continua-cadastro').html(response);
			}
			else{
				$('#continua-cadastro #resultado').html(response);

			}
		});	
	});
	// envia cadastro
	// envia cadastro
	// envia cadastro


	// pesquisa
	// pesquisa
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

	window.location.href = "http://beta.brasa.art.br/osc/pratica/?s="+nome+"&tema="+tema+"&cidade="+cidade+"&uf="+uf;
	});






// Just to be sure that the input will be called
		$("#ibenic_file_upload").on("click", function(){
		  	$('#ibenic_file_input').click(function(event) {
				event.stopPropagation();
      			});
    		});

		$('#ibenic_file_input').on('change', prepareUpload);
		
function prepareUpload(event) { 
	var file = event.target.files;
  	var parent = $("#" + event.target.id).parent();
  	var data = new FormData();
  	data.append("action", "ibenic_file_upload");
  	$.each(file, function(key, value)
    	{
      		data.append("ibenic_file_upload", value);
    	});
		$('#ibenic_file_upload .ajax-loader').fadeIn();

    	$.ajax({
    		  url: odin_main.ajaxurl,
	          type: 'POST',
	          data: data,
	          cache: false,
	          dataType: 'json',
	          processData: false, // Don't process the files
	          contentType: false, // Set content type to false as jQuery will tell the server its a query string request
	          success: function(data, textStatus, jqXHR) {	
	  	 
	              if( data.response == "SUCCESS" ){
		                var preview = "";
		                if( data.type === "image/jpg" 
		                  || data.type === "image/png" 
		                  || data.type === "image/gif"
		                  || data.type === "image/jpeg"
		                ) {
		                  preview = "<img src='" + data.url + "' />";
		                } else {
		                  preview = data.filename;
		                }
		  
		                var previewID = parent.attr("id") + "_preview";
		                var previewParent = $("#"+previewID);
		                previewParent.show();
		                previewParent.children(".ibenic_file_preview").empty().append( preview );
		                previewParent.children( "button" ).attr("data-fileurl",data.url );
		                parent.children("input").val("");
		                parent.hide();
		                $('#imagem_destacada').attr('data-id', data.id);
						$('#ibenic_file_upload .ajax-loader').fadeOut();

	                
	                 } else {
		             alert( data.error );
	                 }

		}

	});

}
$(".ibenic_file_delete").on("click", function(e){
	e.preventDefault();

	var fileurl = $(this).attr("data-fileurl");
	var data = { fileurl: fileurl, action: 'ibenic_file_delete' };
	$.ajax({
	  url:  odin_main.ajaxurl,
	  type: 'POST',
	  data: data,
	  cache: false,
	  dataType: 'json',
	  success: function(data, textStatus, jqXHR) {	
		 
	  	if( data.response == "SUCCESS" ){
	  		$("#ibenic_file_upload_preview").hide();
	  		$("#ibenic_file_upload").show();
	  		console.log( "File successfully deleted", "success");
            $('#imagem_destacada').attr('data-id', '');
  	}

    	if( data.response == "ERROR" ){
    		add_message( data.error, "danger");
    	}
	  },
 	  error: function(jqXHR, textStatus, errorThrown)
    { 
      	add_message( textStatus, "danger" );
    }
  });

});



$("#anexos").click(function(e){
		e.preventDefault();
		$('.anexos .ajax-loader').fadeIn();

		var fd = new FormData();
        var files_data = $('#anexosUp'); // The <input type="file" /> field
        
        // Loop through each data and create an array file[] containing our files data.
        $.each($(files_data), function(i, obj) {
            $.each(obj.files,function(j,file){
                fd.append('files[' + j + ']', file);
            })
        });
        
        // our AJAX identifier
        fd.append('action', 'cvf_upload_files');  
        
        // Remove this code if you do not want to associate your uploads to the current page.

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	console.log(response);
            	response=jQuery.parseJSON(response);

                $('.upload-response').html(response.msg); // Append Server Response
                $('#ids-anexos').val(response.idsAnexos);
           		$('.anexos .ajax-loader').fadeOut();

            }
        });
	});
// $("#anexos-gal").click(function(e){
// 		e.preventDefault();
// 		var fd = new FormData();
//         var files_data = $('#anexosUpGal'); // The <input type="file" /> field
//        	$('.galeria .ajax-loader').fadeIn();

//         // Loop through each data and create an array file[] containing our files data.
//         $.each($(files_data), function(i, obj) {
//             $.each(obj.files,function(j,file){
//                 fd.append('files[' + j + ']', file);
//             })
//         });
        
//         // our AJAX identifier
//         fd.append('action', 'cvf_upload_files_gal');  
        
//         // Remove this code if you do not want to associate your uploads to the current page.

//         $.ajax({
//             type: 'POST',
//             url: ajaxurl,
//             data: fd,
//             contentType: false,
//             processData: false,
//             success: function(response){
//             	console.log(response);
//             	response=jQuery.parseJSON(response);

//                 $('.upload-response-gal').html(response.msg); // Append Server Response
//                 $('#ids-anexos-gal').val(response.idsAnexos);
// 				$('.galeria .ajax-loader').fadeOut();
//             }
//         });
// 	});


    
    
    $(window).scroll(function () {
    	var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();
    	console.log(scrollBottom);
        if ($(this).scrollTop() > 275 && scrollBottom > 500){
	        $('#sidebar').addClass("fixo");
        } 
        else if(scrollBottom < 500){
        	topo=$(this).scrollTop();
            $('#sidebar').removeClass("fixo");

        	$('#sidebar').addClass("fundo");

        }
        else {
            $('#sidebar').removeClass("fixo");
            $('#sidebar').removeClass("fundo");
        }
    });
 
	$(".praticaEdit").click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');
		var data = {
				'action': 'edita_pratica_pega',
				'id':id,
		};
		$.post(odin_main.ajaxurl, data, function(response) {
			console.log(response);
           	response=jQuery.parseJSON(response);

			$('.title.nome').val(response.nomeProjeto);
			$('.uf').val(response.estado);
			$('.cidade').val(response.cidade);
			$('#tema-continua-cadastro').val(response.tema);

			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name=""]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="telefone_da_entidade"]').val(response.telefone_da_entidade);
			$('input[name="endereco_da_entidade"]').val(response.endereco_da_entidade);
			$('input[name="site_da_entidade"]').val(response.site_da_entidade);
			$('input[name="e-mail_de_contato"]').val(response.email_de_contato);

			$('textarea[name="resumo_da_pratica"]').val(response.resumo_da_pratica);
			$('textarea[name="objetivo"]').val(response.objetivo);

			$('input[name="video"]').val(response.video);
			$('input[name="local_de_implementacao"]').val(response.local_de_implementacao);
			$('textarea[name="descricao_das_acoes"]').val(response.descricao_das_acoes);
			$('textarea[name="resultados"]').val(response.resultados);
			$('input[name="publico-alvo"]').val(response.publicoAlvo);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="nome_da_entidade"]').val(response.nome_da_entidade);
			$('input[name="postId"]').val(response.postId);

			var preview = "";
			var parent= $("#ibenic_file_upload");
		    preview = "<img src='" + response.imagem_destacada + "' />";
		    var previewID = parent.attr("id") + "_preview";
		    var previewParent = $("#"+previewID);
		    previewParent.show();
		    previewParent.children(".ibenic_file_preview").empty().append( preview );
		    previewParent.children( "button" ).attr("data-fileurl",data.url );
		    parent.children("input").val("");
		    parent.hide();
		    $('#imagem_destacada').attr('data-id', response.imagem_destacada_id);
		   	$('.ibenic_file_delete').attr('data-fileurl', response.imagem_destacada);
		   	$('.imagensAnexas').html(response.galeria);
		   	$('.arquivosAnexos').html(response.anexos);




			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('.nome').val(response.nomeProjeto);
			$('#continua-cadastro').fadeIn();
		});


	});
    
});
