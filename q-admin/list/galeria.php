<?php 
require __DIR__ . '/../config.php';
require GESTOR_MODELS . SELF_PAG;
require PHP . 'classes/Class.paginacao-admin.php';


get_header_gestor();
get_barra_header();
?>

<div id="buttons">
	<div class="text-right">
		<?php include GESTOR_INCLUDES . 'items-per-page.php'; ?>
		<?php count_results($count) ?>
<!--		--><?php //btn_add() ?>
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

	$query = $db->get_results("SELECT * FROM ".$tables[$__TABLE__]." ORDER BY criado ASC $navbar->limit");
?>

<div class="table-responsive">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th data-sorter="false"></th>
				<th>Título</th>
				<th class="text-center" data-sorter="false">Ações</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($query as $rs) { ?>
			<tr>
				<td></td>
				<td><?php echo $rs->titulo; ?></td>
				<td class="text-center">
					<?php btn_edit($rs->id) ?>
                    <?php // btn_delete($rs->id) ?>
				</td>
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