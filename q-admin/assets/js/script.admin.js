
const time_out_alert = 4000;

function showNotify(text, icon='success') {

	Swal.fire({
		toast: true,
		position: 'top-end',
		icon: icon,
		title: text,
		showConfirmButton: false,
		showCloseButton: true,
		timer: time_out_alert,
		hideClass: {
			popup: 'animation_out_right animated'
		}
	});

}


(function($){
	$(document).ready(function() {

		// DELETAR
		$('button[name="delete"], a.deletar').click(function(e)
		{	
			e.preventDefault();

	        var target = $(this);
	        var href = null;
	        var form = null;

	        if (target.is("a")) href = target.attr("href");
	        else if (target.is("button:submit")) form = target.closest("form");
	        else if (target.is("button")) href = target.attr("href") || target.attr("value");


	        Swal.fire({
	            title: 'Atenção?',
				text: "Você realmente deseja excluir?",
	            icon: 'warning',
	            showCancelButton: true,
				confirmButtonColor: '#37ba6b',
				confirmButtonText: 'Sim',
				cancelButtonText: 'Não',
				cancelButtonColor: '#d9534f',
				focusconfirm: true,
			}).then((result) => {
				if (result.value)
				{
					if (href){
						window.location.href = href;
					}
	            	else if (form){
	            		form.submit();
	            	}
	            }else{
	            	return false;
	            }
			});
		});


		// MENU CURRENT CONTROL
		$('#sidebar nav ul li').hover(
			function() {
				$(this).addClass('current');
			}, function() {
				$(this).removeClass('current');
			}
		);

		var url			= $(location).attr('href');
		var pageID		= url.split('/').slice(-1)[0];
		var fullPage	= pageID.split('?').slice(0)[0];
		var page		= fullPage.split('-').slice(0)[1];
		if (page) var father = page.split('.').slice(0)[0];

		// $('#sidebar nav ul li a').each(function()
		// {
		// 	var href = $(this).attr('href');
		// 	if ( ('list-'+father+'.php') == href) {
		// 		$(this).parent().addClass('active');
		// 		$(this).parent().parent().parent().addClass('active');
		// 	} else if ( ('list-'+father+'s.php') == href) {
		// 		$(this).parent().parent().parent().addClass('active');
		// 		if (father == 'categoria') {
		// 			$(this).parent().addClass('active');
		// 		}
		// 	} else if ( href == fullPage ) {
		// 		$(this).parent().addClass('active');
		// 	}
		// });

		// SUB MENU CONTROL
		$('#sidebar nav ul li a').each(function()
		{
			if ( $(this).hasClass('dropdown') )
			{
				$(this).click(function() {
					$(this).next().slideToggle('fast');
					$(this).parent().toggleClass('active');
				});

				$(this).next().children().each(function(index, el) {
					if ( $(this).hasClass('active') ) {
						$(this).parent().css('display', 'block');
					}
				});
			}
		});
		

		$( ".showMenu" ).click( function(e) {
			e.preventDefault();

			if( $(this).hasClass('closed') )
			{
				$(this).removeClass('closed');
				$("#sidebar").removeClass('closed');
				$("#main").removeClass('expand');

				$("#sidebar .titulo-menu").delay(400).fadeIn(300);
			}else{
				$(this).addClass('closed');
				$("#sidebar").addClass('closed');
				$("#main").addClass('expand');

				$("#sidebar .titulo-menu").hide(300);
				$("#sidebar ul ul").hide(300);
			}
		});

		// ALERT OUTS
		$('.alert').hide();

		// TABLE SORT
		$('table').tablesorter({
			sortReset: true,
			sortRestart: true
		}); 

		// DISABLE TABS ALERTS
		$( ".nav-tabs .disable" ).click( () => {
			showNotify('Salve primeiro para depois editar esta aba.', 'warning');
		});

		// CLOSE BUTTON
		$('.alert button.close').click( (e) => {
			e.preventDefault();
			$(this).parent().fadeOut();
		});

		// DELETAR
		$("a.delete").click( () => {
			if(confirm('Você realmente deseja excluir?')) return true;
			else return false;	
		});

		// DATEPICKER
		$(".datepicker").datepicker({
			defaultDate: +7,
			dateFormat: 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});

		
		// GERAR PERMALINK
		$("#titulo").change(function(){
			thisValue = $(this).val();

			if (thisValue) {
				$.getJSON(HTTP_GESTOR + 'ajax/ajax-clear-string.php',{string: thisValue, tabela: $('input[id="tabela"]').val()} ,function(value) {
					if(value.error == 'false') $("#permalink").val(value.string);
				});
			}
		});



		// SELECT ESTADO/CIDADE
		$('form #estado').change(function(){
			var valueState = $(this).val();
			$.ajax({
				type: "POST",
				url: HTTP_GESTOR +"ajax/ajax-cities.php",
				data: "estado="+valueState,
				beforeSend: function() {
					$("form #cidade").empty();
					$("form #cidade").html('<option>Carregando, aguarde...</option>');
				},
				success: function(txt) {
					$("form #cidade").empty();
					$("form #cidade").html(txt);
				},
				error: function(txt) {
					$("form #cidade").html('<option value="">Selecione</option>');
					alert('Desculpe, houve um erro interno.');
				}
			});
		});






		// ACTIVE THEME DARK
		if (localStorage.theme == "dark")
		{
			$('body').addClass("theme-dark");
			$('.toggle-theme').addClass('is-dark-active');
			$('.toggle-theme').find('.fa').addClass('fa-sun-o');
			$('.toggle-theme').find('.fa').removeClass('fa-moon-o');
		}
		
		$('.toggle-theme').click( () => {
			
			if( $('.toggle-theme').hasClass('is-dark-active') )
			{
				$('.toggle-theme').find('.fa').removeClass('fa-sun-o');
				$('.toggle-theme').find('.fa').addClass('fa-moon-o');

				localStorage.setItem("theme", "light");

			}else{
				$('.toggle-theme').find('.fa').addClass('fa-sun-o');
				$('.toggle-theme').find('.fa').removeClass('fa-moon-o');

				localStorage.setItem("theme", "dark");
			}

			$('body').toggleClass("theme-dark");
			$('.toggle-theme').toggleClass('is-dark-active');
			// console.log(localStorage.theme);
		});



		// FIXED BAR BUTTONS
		$(window).scroll(function()
		{
			if( $('form #buttons').length > 0 )
			{
				if( $(window).scrollTop() > 105 ){
		   			$('#buttons').addClass('is-fixed');
		   			$('.page-header').addClass('is-mb');
				}else{
					$('#buttons').removeClass('is-fixed');
					$('.page-header').removeClass('is-mb');
				}
			}
		});



		// SELECIONAR TODAS IMAGENS
		$('input#select-all').change(function() {
			var checkboxes = $('.table').find(':checkbox');

			if ( $(this).prop('checked') )
			{
				$('.table').find('tr').addClass('checked');
				checkboxes.prop('checked', true);
			} else {
				$('.table').find('tr').removeClass('checked');
				checkboxes.prop('checked', false);
			}
		});


		// DELETAR SELECIONADOS
		$('.deletar-check').on('click', function(e)
		{
			e.preventDefault();

			let checkeds = $('.table input[type=checkbox]:checked').length;
			let tabela	 = $('.table').attr('data-table');

			if (checkeds > 0)
			{
				Swal.fire({
		            title: 'Atenção?',
					text: "Você realmente deseja excluir?",
		            icon: 'warning',
		            showCancelButton: true,
					confirmButtonColor: '#37ba6b',
					cancelButtonColor: '#d9534f',
					confirmButtonText: 'Sim',
					focusCancel: true,
				}).then((result) => {
					if (result.value)
					{
						$('.table input[type=checkbox]:checked').each(function() {
							var thisElement = $(this);
							var thisID 		= thisElement.val();
							thisElement.parents('tr').animate({opacity: 0}, 'fast', function()
							{
								$.getJSON(HTTP_GESTOR + "ajax/ajax-delete-check.php", { id: thisID, tabela: tabela });
								thisElement.parents('tr').remove();

								showNotify('Registro(s) excluído(s) com sucesso!');

								$('input#select-all').attr('checked', false);
							});
						});

		            }else{
		            	return false;
		            }
				});
			}
		});


	});

})(window.jQuery);