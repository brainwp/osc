jQuery(document).ready(function($) {
// front-page
// front-page
// front-page
// front-page
if ($('body').hasClass("home")){
	$('#slider-1').owlCarousel({
 
	    // Most important owl features
	    items : 1,
   	    autoPlay:6000, 

	    itemsDesktop : [1200,1], //5 items between 1000px and 901px
	    itemsDesktopSmall : [900,1], // betweem 900px and 601px
	    itemsMobile : [800,1], //5 items between 1000px and 901px

	    navigation : false,
	    pagination:true

    
 
	});
$('#slider-2').owlCarousel({
 
	    // Most important owl features
	    items : 1,
	     itemsDesktop : [1200,1], //5 items between 1000px and 901px
	    itemsDesktopSmall : [900,1], // betweem 900px and 601px

   	    autoPlay:6000, 
	    navigation : false,
	    pagination:true

    
 
	});
	$('#categorias-nav').owlCarousel({
 
	    // Most important owl features
	    items : 5,
   	    autoPlay:false, 
	    navigationText : ["<div class='prev-slider-cat nav-slider'></div>","<div class='prox-slider-cat nav-slider'></div>"],
	    itemsMobile : [992,3], //5 items between 1000px and 901px

	    itemsDesktop : [1100,4], //5 items between 1000px and 901px
	    navigation : true,
	    pagination:false

    
 
	});
	// if ($('.current-cat').lenght){
		var rect = $('.current-cat').offset();
		html= $('html').width();
		console.log('largurahtml'+html)

		rect=rect.left-html/2
		console.log('offset'+rect)

		$('#categorias-nav .owl-wrapper').css('transform','translate(-'+rect+'px)')
		console.log(rect);
	// }
	


	$(".cat-item").click(function(e){
		$("#categorias-nav .cat-item.current-cat").removeClass('current-cat');
		e.preventDefault();
		classe=$(this);
		$('.home .loader').fadeIn();
		$('#categorias-conteudo').css('opacity', '0')
		console.log(classe)
		var str = $(this).attr('class');
		var res = str.split("-");
		var cat = res[res.length-1];
		var data = {
				'action': 'categorias_home',
				'cat':cat
		};
		           	console.log(data);
		current=$(this);           	
		$.post(odin_main.ajaxurl, data, function(response) {
           	response=jQuery.parseJSON(response)
           	console.log(response);
   			$('.home .loader').fadeOut();

			$('#categorias-conteudo').html(response['html']);
			$('#categorias-conteudo').css('opacity', '1')
			$(current).addClass('current-cat');
			console.log (response['slug']);
			$('.cat-btn').attr('href', response['slug']);

		});
	});

}
	

// front-page
// front-page
// front-page
// front-page
// front-page

	// fitVids.
	$( '.entry-content' ).fitVids();
		$( '.cada-noticia-archive iframe' ).fitVids();


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
		// console.log(data);
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


		// console.log(data);
			$('.enviarCadastro').fadeIn();
			$('#enviar-cadastro').fadeOut();		
			$.post(odin_main.ajaxurl, data, function(response) {
			// console.log(response);
           	response=jQuery.parseJSON(response);

			if (response.erro == ""){
				$('#continua-cadastro #resultado').html(response.mensagem);
				$('html, body').animate({
       				 scrollTop: $("#busca-cadastro").offset().top
       				}, 2000);
				$('#continua-cadastro').fadeOut(2010);
				$('#resultado').html(response.mensagem);

				$('input[type="text"], input[type="email"], input[type="password"]').val("");
				$('textarea').val("");
				$('select').val('0');
				// $('select #uf').val("");
				$('#cadastro .nome').prop('disabled', false);
				$('#cadastro .uf').prop('disabled', false);
				$('#cadastro .cidade').prop('disabled', false);
				$('#cadastro #tema-cadastro').prop('disabled', false);
				$('.enviarCadastro').fadeOut();
				$('#enviar-cadastro').fadeIn();


			}
			else{
				$('#continua-cadastro #erro').html(response.erro);
				$('.enviarCadastro').fadeOut();
				$('#enviar-cadastro').fadeIn();

			}
			if (response.edicao==1) {
				$('.listaPraticasEdit a[data-id="'+response.praticasEdits+'"]').fadeOut();
			};
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
	// console.log('uf'+uf);
	// console.log('cidade'+cidade);
	// console.log('tema'+tema);
	// console.log('nome'+nome);

	window.location.href = "/pratica/?s="+nome+"&tema="+tema+"&cidade="+cidade+"&uf="+uf;
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
	  		// console.log( "File successfully deleted", "success");
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
            	// console.log(response);
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
    	// console.log(scrollBottom);
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
		// console.log(data)
		$.post(odin_main.ajaxurl, data, function(response) {
			// console.log(response);
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
			// console.log(response.imagem_destacada);
			if (response.imagem_destacada!=undefined) {
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
			};
			
		   	$('.imagensAnexas').html(response.galeria);
		   	$('.arquivosAnexos').html(response.anexos);

			$('#continua-cadastro').fadeIn();
		});


	});
	$("input.transfere").click(function(e){
		e.preventDefault();
		var id = $(this).attr('data-id');

		var userId = $('.'+id).val();
		var data = {
				'action': 'transfere_pratica',
				'id':id,
				'userId':userId
		};

		$.post(odin_main.ajaxurl, data, function(response) {
			console.log(response);
           	response=jQuery.parseJSON(response);
           	           		window.location.reload(false); 

        });

    });     	
	$("input.criaUser").click(function(e){
		e.preventDefault();
		var nome = $('input[name="nome"]').val();
		var senha = $('input[name="senha"]').val();
		var email = $('input[name="email"]').val();
		var data = {
				'action': 'transfere_pratica_cria',
				'nome':nome,
				'senha':senha,
				'email':email,
		};
		console.log(data);

		$.post(odin_main.ajaxurl, data, function(response) {
			console.log(response);
           	response=jQuery.parseJSON(response);
           	if (response.html!=1){
           		$('.erro').html(response.html);

           	}
           	else{
           		window.location.reload(false); 

           	}


        });

    });     	

	$(document).on('click',".deletaGaleria",function(e){
		e.preventDefault(); 
		id=$(this).attr('data-id');
		var data = {
				'action': 'deleta_galeria',
				'id':id,
		};
		console.log(data);
		$.post(odin_main.ajaxurl, data, function(response) {
			console.log(response);
		});


	});

});
