function PixelToNumber(numberPx){

	return Number(String(numberPx).replace('px', ''));

}

jQuery(document).ready(function($)
{


	let menuOpen = false;

	var largura = window.screen.width;
    var altura = window.screen.height;

	// alert(`${largura}  ${altura}`);


	// PASSIVE LISTENERS HACK
	$.event.special.scroll = {
	    setup: function( _, ns, handle ) {
	        this.addEventListener("scroll", handle, { passive: !ns.includes("noPreventDefault") });
	    }
	};



	// ANIMATION LETTER BY LETTER

	if( $('.fade-in-letter').length !== 0 )
	{
        $('.fade-in-letter').each(function (i, element)
        {
           $(element).on('animated', function ()
           {
                var texto = $(this).data('text'),
                contador = 0,
                time = 40;

                function addText(element)
                {
                    var span = document.createElement('span');
                    span.innerText = texto[contador];

                    if( $(element).hasClass('banner') ){
                    	time = 130;
                    }

                    setTimeout(function () {
                        span.classList.add('animated');
                    }, 0 + (contador * time));

                    if(contador < texto.length)
                    {
                        $(element).append(span);
                        contador++;
                        addText(element);
                    }
                }

                addText(this);
           });
        });
    }



    
    $('.txt-banner .fade-in-letter').addClass('animated');
    $('.txt-banner .fade-in-letter').trigger('animated');




	//////////////////////////
	// ENTRANCE ANIMATION
	//////////////////////////


	$('.waypoint').each( function(i)
	{
	    let bot_obj = $(this).offset().top + ( $(this).outerHeight() * 0.3 );
	    let bot_win = $(window).scrollTop() + $(window).height();
	    if( bot_win > bot_obj )
	    {
	    	var element = $(this);

            if(!element.hasClass('animated')) {
                element.addClass('animated');
                element.trigger('animated');
            }
	    }
	});

	//////////////
	// PARALLAX 
	/////////////

	
	
	
	
	


	if(!IS_MOBILE)
	{
		var updateAnimation = debounce(function (e) {
		    $('.waypoint').each( function(i)
		    {
		        let bot_obj = $(this).offset().top + ( $(this).outerHeight() * 0.35 );
		        let bot_win = $(window).scrollTop() + $(window).height();
		        if( bot_win > bot_obj )
		        {
		            let element = $(this);
		            if(!element.hasClass('animated')) {
		                element.addClass('animated');
		                element.trigger('animated');
		            }
		        }
		    });
		}, 100);
	}else{
		var updateAnimation = function (e) {
		    $('.waypoint').each( function(i)
		    {
		        let bot_obj = $(this).offset().top + ( $(this).outerHeight() * 0.35 );
		        let bot_win = $(window).scrollTop() + $(window).height();
		        if( bot_win > bot_obj )
		        {
		            let element = $(this);
		            if(!element.hasClass('animated')) {
		                element.addClass('animated');
		                element.trigger('animated');
		            }
		        }
		    });
		};
	}






    window.addEventListener('scroll', updateAnimation, false);



    ///////////////////////////////
	// SHOW/HIDE MENU FIXED SCROLL
	///////////////////////////////

	$(window).scroll(function()
	{
    	if( $(window).scrollTop() > 50 )
		{
			$('header').addClass('is-compact');
		}else{
			$('header').removeClass('is-compact');
		}

		const widthDevice = window.innerWidth < 579 ? 570 : 800;

		if ( $(window).scrollTop() > widthDevice) {
			

			$('.navbar-burger span').addClass('black-burger');
		} else {
			$('.navbar-burger span').removeClass('black-burger');
		}
	});


	$(window).resize(function(){
		if( screen.width > 768 ) updateAnimation;
	});



	$(window).scroll();






	// MENU

	$('.menu ul').fadeOut(0);

	$('.navbar-burger').click(function(e)
	{
		e.preventDefault();

		if( $(this).hasClass("is-active") )
		{
			$('.menu').removeClass("is-active");

			$('.menu ul').fadeOut(300);

			$('header').removeClass('is-active');
			menuOpen = false;
		}
		else
		{
			$('.menu').addClass('is-active');
			
			$('.menu ul').fadeIn(300);

			$('header').addClass('is-active');
			menuOpen = true;
		}

		$(this).toggleClass('is-active');
	});



	$('.bt-close-menu').click(function(e)
	{
		$('.menu').removeClass("is-active");

		$('.menu ul').fadeOut(300);

		$('header').removeClass('is-active');
		menuOpen = false;

		$('.navbar-burger').toggleClass('is-active');
	});



	$('.menu .menu-item').click(function(e)
	{
		$('.bt-close-menu').click();
	});

	





	$('.slide-galeria').owlCarousel({
		autoplayTimeout: 0,
		margin: 0,
		dots: false,
		nav: true,
		items: 1,
		smartSpeed: 800,
	});

	
	$('.slide-plantas').owlCarousel({
		autoplayTimeout: 0,
		margin: 0,
		dots: false,
		nav: true,
		items: 1,
		smartSpeed: 800,
	});

	$('.owl-next span').html('<img src="'+HTTP+'/assets/img/icons/arrow-right.svg" alt="">');
	$('.owl-prev span').html('<img src="'+HTTP+'/assets/img/icons/arrow-left.svg" alt="">');






	// COOKIES

	$('#bt-cookies').click(function(e)
	{
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: HTTP+'php/ajax/aceitar-cookies.php',
			success: function(output)
			{
				if(output == 1) $('.cookies').fadeOut(200);
			}
		});
	});



	



	// MASK
	$('.telefone').mask('(99) 99999-9999');



	// SEND FORM
	$('#form-contato').submit(function()
	{
		const __this = $(this);
		var DATA 	 = $(this).serialize();

		$(this).find('button').addClass('is-loading');


		$.ajax({
			type: 'POST',
			url: HTTP+'/php/envios/Envio-contato.php',
			data: DATA,
			dataType: 'json',
			success: function(json)
			{

				__this.find('button').removeClass('is-loading');

				if(json.status=="1")
				{
					__this.find('input').val('');
					__this.find('textarea').val('');

					Swal.fire({
						title: 'SUCESSO!',
						html: json.message,
						icon: 'success',
						confirmButtonText: 'Ok'
					});
				}
				else
				{
					console.log(json);
					__this.find('button').removeClass('is-loading');
					msgAlert(json.message);
				}
			},
			error: function(response){
				console.log(response);
			},
		});
			
		return false;
	});



	//////////////
	// PARALLAX 
	/////////////

	// $(window).scroll(function()
	// {
  	// 	var ct1 = (( $('.parallax-container').offset().top + $(this).outerHeight() ) - $(window).scrollTop() ) / 4.2;
  	// 	ct1 = ct1 - ( $(this).outerHeight() / 2 ) + 30;
  	// 	$('.parallax').css('top', ct1+'px');
	// 	//console.log( ct1 );

	// 	var ct2 = (( $('.parallax-container2').offset().top + $('.parallax-container2').outerHeight() ) - $(window).scrollTop() ) / 6.8;
  	// 	ct2 = ct2 - ( $('.parallax-container2').outerHeight() / 2 ) + 125;
  	// 	$('.parallax2').css('top', ct2+'px');
  	// });




});


function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}



function msgAlert(message){
	Swal.fire({ title: 'Ops!', html: message, icon: 'warning', confirmButtonText: 'Ok'});
}


// function hasTouch() {
//   return 'ontouchstart' in document.documentElement
//          || navigator.maxTouchPoints > 0
//          || navigator.msMaxTouchPoints > 0;
// }

/*
if (hasTouch()) { // remove all the :hover stylesheets
  try { // prevent exception on browsers not supporting DOM styleSheets properly
    for (var si in document.styleSheets) {
      var styleSheet = document.styleSheets[si];
      if (!styleSheet.rules) continue;

      for (var ri = styleSheet.rules.length - 1; ri >= 0; ri--) {
        if (!styleSheet.rules[ri].selectorText) continue;

        if (styleSheet.rules[ri].selectorText.match(':hover')) {
          styleSheet.deleteRule(ri);
        }
      }
    }
  } catch (ex) {}
}
*/

$(document).ready(function() {
	$("[data-fancybox]")
	.fancybox({
	// Opções do Fancybox
		loop: true,
		buttons: [
		"zoom",
		"fullScreen",
		"thumbs",
		"close",
		"slideShow",
		"infobar",
		],
		infobar: true,
		slideShow  : true,
		thumbs     : true,

	});
});

document.addEventListener('DOMContentLoaded', function() {
    const containers = document.querySelectorAll('.plantas-nav');

	containers.forEach(container=>{
		const items = container.getElementsByTagName('a');

		if (items.length <= 3) {
			container.style.justifyContent = 'space-around';
		} else {
			container.style.justifyContent = 'space-between';
		}
	});

    
});