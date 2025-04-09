<?php
if ( !empty($_GET['ipp']) )
{
	$items_page = $_GET['ipp'];
}else{
	$items_page  = $__ITEMS_PER_PAGE__;
	$_GET["ipp"] = $__ITEMS_PER_PAGE__;
}
?>

<div class="items-page">
	Mostrar
	<form>
		<select name="ipp" class="form-control input-sm" onchange="this.form.submit();">
			<option value="10"  	<?=($_GET["ipp"]=="10" ?'selected':''); ?> >10</option>
			<option value="25"  	<?=($_GET["ipp"]=="25" ?'selected':''); ?> >25</option>
			<option value="50"  	<?=($_GET["ipp"]=="50" ?'selected':''); ?> >50</option>
			<option value="100" 	<?=($_GET["ipp"]=="100"?'selected':''); ?> >100</option>
			<option value="Todos" 	<?=($_GET["ipp"]=="Todos"?'selected':''); ?> >Todos</option>
		</select>
	</form>
	Registros
</div>