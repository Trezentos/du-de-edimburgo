<?php
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;
require PHP . 'classes/Class.paginacao-admin.php';


add_javascript(["script.order.js"]);

get_header_gestor();
get_barra_header();
?>

<div class="alert alert-success"></div>

<div id="buttons">
	<div class="text-right">
		<? include GESTOR_INCLUDES . 'items-per-page.php'; ?>
		<? count_results($count) ?>
		<? btn_add() ?>
	</div>
</div>


<?php
if ($count>0)
{
	# PAGINATION
	$navbar = new Paginator;
	$navbar->items_total = $count;
	$navbar->mid_range = 9;
	$navbar->items_per_page = $items_page;
	$navbar->paginate();

	$query = $db->get_results("SELECT * FROM ".$tables[$__TABLE__]." ORDER BY ordem ASC $navbar->limit");
?>


<div class="table-responsive">
	<table class="table table-striped table-hover" data-table="<?=$__TABLE__?>">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>ID</th>
				<th>Título</th>
				<th>Imagem</th>
				<th>Status</th>
				<th class="actions text-center" data-sorter="false">Ações</th>
				<th class="order text-center" data-sorter="false">Ordenar</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr id="<?php echo $rs->id; ?>" class="ui-state-default">
				<td></td>
				<td class="locked"><?php echo $rs->id; ?></td>
				<td class="locked"><?php echo $rs->titulo; ?></td>
				<td class="locked"><img src="<?php echo HTTP_UPLOADS_IMG.$rs->imagem_desktop; ?>" width="150"></td>
				<td class="locked"><?php echo get_status($rs->status); ?></a></td>
				<td class="locked text-center">
					<? btn_edit($rs->id) ?>
					<? btn_delete($rs->id) ?>
				</td>
				<? btn_sort() ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php
	echo ($query != '' && $navbar->num_pages>1 ) ? $navbar->display_pages() : '';
} else {
?>

	<div class="alert alert-warning show">
		<strong>Nenhum registro existente</strong>
	</div>

<?php 
	} 
get_footer_gestor();