$(document).ready(function(){	
	$('table tbody').sortable({
		axis: 'y',
		stop: function(event, ui) {

			// console.log( $(this).parent().attr('data-table') );

			let tabela = $(this).parent().attr('data-table');

			var scripts = new Array();
			order = $(this).find('.ui-state-default').map(function(index, obj) {
				let input = $(obj);
				input.val(index + 1);
				scripts.push(input.attr('id') + '=' + (index + 1));
			});
			
			$.post(HTTP_GESTOR + 'ajax/ajax-save-order.php', {data:scripts, tabela: tabela}, function(rtn){

				showNotify('Ordenação realizada com sucesso!');

			},'json');
		}
	});

	$('table tbody').disableSelection();
});