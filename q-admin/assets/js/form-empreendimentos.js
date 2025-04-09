(function($){
	$(document).ready(function()
	{

		// INPUT SLIDE
		
		var total = 0;
		var numItemsSlide = $('.range-value').length;


		function ranges() {
			$('.tab-pane .range').each(function() {
				$(this).slider({
					range: 'min',
					value: $(this).parent().prev().val().replace('%',''),
					min: 0,
					max: 100,
					slide: function( event, ui ) { $(this).parent().prev().val( ui.value + '%'); },
					change: function( event, ui ) { refreshTotal(); }
				});

				$(this).parent().val( $(this).slider('value') + '%' );

				total = Number(total) + Number( $(this).parent().prev().val().replace('%','') );
			});

			// TOTAL RANGE
			$('.tab-pane .total').slider({
				range: 'min',
				value: total / numItemsSlide,
				min: 0,
				max: 100,
				slide: function( event, ui ) { $('.tab-pane .range-total').val( ui.value + '%'); }
			});

			$('.tab-pane .range-total').val( $('.tab-pane .total').slider('value') + '%' );
		}

		// REFRESH
		function refreshTotal() {
			total = 0;

			$('.tab-pane .range').each(function() {

				var width = $(this).children('.ui-slider-range').width();
				var parentWidth = $(this).children('.ui-slider-range').offsetParent().width();
				var percent = 100*width/parentWidth;

				total = Number(total) + Number( $(this).parent().prev().val().replace('%','') );
			});

			$('.tab-pane .total').slider({ value: total / numItemsSlide });

			$('.tab-pane .range-total').val( $('.tab-pane .total').slider('value') + '%' );
		}

		// CHAMANDO FUNÇÃO
		ranges();


	});
})(window.jQuery);