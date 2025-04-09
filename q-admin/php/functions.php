<?php
// MENU
function geraMenu() {
	global $arMenu, $acessoAutor, $LIST_ACCESS_FILE;

	$_html = [];
	foreach($arMenu as $title => $var)
	{
		if($var['show'] && in_array($var['access'], $acessoAutor) || $var['access']=='FULL')
		{
			$current_file = returnFilePath('admin');
			$current_menu = false;

			if (!is_null($var['file']) && ($current_file == $var['file'] || str_replace('list/', 'form/', $var['file']) == $current_file)) {
				$current_menu = true;
			}

			if (is_array($var['submenu']) && count($var['submenu']) > 0)
			{
				$submenus = array_values($var['submenu']);
				if (in_array($current_file, $submenus) || in_array(str_replace('form/', 'list/', $current_file), $submenus)) {
					$current_menu = true;
				}
			}


			if ( in_array($current_file, $LIST_ACCESS_FILE[ $var['access'] ])) {
				$current_menu = true;
			}


			$_html[] = '<li '.($current_menu ? 'class="active"' : "").'>';

			$_html[] = '<a href="'.(!is_null($var['file']) ? HTTP_GESTOR.$var['file'] : 'javascript:void(0)').'" '.(!is_null($var['file']) ? '' : 'class="dropdown"').'>';

			$_html[] =		'<span class="waypoint animation_scale animated fa fa-'.$var['icon'].'"></span>
			<span class="titulo-menu">'.$title.(!is_null($var['file']) ? '' : ' <i class="fa fa-angle-down pull-right"></i>')."</span>"; 
			
			$_html[] = '</a>';




			if ($var['submenu']) {
				$_html[] = '<ul>';
				foreach ($var['submenu'] as $submenu => $arquivo_submenu) {
					if ($current_file == $arquivo_submenu || str_replace('form/', 'list/', $current_file) == $arquivo_submenu) {
						$classSubmenu = 'class="active"';
					} else {
						$classSubmenu = '';
					}
					$_html[] = '<li '.$classSubmenu.'><a href="'.HTTP_GESTOR.$arquivo_submenu.'"><i class="fa fa-angle-right"></i> '.$submenu.'</a></li>';
				}
				$_html[] = '</ul>';
			}

			
			$_html[] = '</li>';
		}
	}
	
	return implode("\n", $_html);
}

// HEADER
function get_header_gestor() {
	global $userClass;

	$_html[] = '<!DOCTYPE>';
	$_html[] = '<html lang="pt-br">';
	$_html[] = '	<head>';
	$_html[] = '		<meta charset="utf-8" />';
	$_html[] = '		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">';
	$_html[] = '		<meta name="robots" content="noindex,nofollow" />';
	$_html[] = '		<title>Dashboard - Administrativo</title>';
	$_html[] = '		<link rel="icon" href="'.ASSETS_GESTOR.'img/favicon.ico" type="image/x-icon">';
	$_html[] = '		<link rel="shortcut icon" type="image/x-icon" href="'.ASSETS_GESTOR.'img/favicon.ico">';
	$_html[] = '		<script type="text/javascript"> var HTTP_GESTOR = \''.HTTP_GESTOR.'\'</script>';
	$_html[] = '		<script type="text/javascript"> var HTTP = \''.HTTP.'\'</script>';

	$_html[] = '	
						<link rel="preconnect" href="https://fonts.googleapis.com">
						<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
						<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">
						';
	
	//$_html[] = '		<link rel="stylesheet" href="'.HTTP_GESTOR.'css/jquery-ui.css">';
	
	$_html[] = 			style_enqueue('gestor','return');
	
	$_html[] = '		<script src="'.ASSETS_GESTOR.'js/jquery-3.5.1.min.js"></script>';
	$_html[] = '		<script src="'.ASSETS_GESTOR.'js/jquery-ui.min.js"></script>';
	$_html[] = '	</head>';
	$_html[] = '	<body class="">';
	$_html[] = '		<nav class="navbar navbar-inverse navbar-fixed-top noPrint " role="navigation">';
	$_html[] = '			<div class="container-fluid">';
	$_html[] = '				<div class="navbar-header waypoint animation_left_d1 animated">';
	$_html[] = '					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
	$_html[] = '						<span class="sr-only">Toggle navigation</span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '						<span class="icon-bar"></span>';
	$_html[] = '					</button>';
	$_html[] = '					<a class="showMenu"><span class="glyphicon glyphicon-menu-hamburger"></span></a>';
	$_html[] = '					<a class="navbar-brand" href="'.HTTP_GESTOR.'">Dashboard - Administrativo</a>';
	$_html[] = '				</div>';
	$_html[] = '				<div class="navbar-collapse collapse">';
	$_html[] = '					<ul class="nav navbar-nav navbar-right waypoint animation_right_d1 animated">';
	$_html[] = '						<li><a class="toggle-theme" title="Trocar tema"><i class="fa fa-moon-o"></i></a></li>';
	$_html[] = '						<li><a><i class="fa fa-user-o"></i> '.$userClass->getAutor().'</a></li>';
	$_html[] = '						<li><a href="'.HTTP.'" target="_blank"><i class="fa fa-file-text-o"></i> Visualizar Site</a></li>';
	$_html[] = '						<li><a href="'.HTTP_GESTOR.'sair.php"><i class="fa fa-sign-out"></i> Sair</a></li>';
	$_html[] = '					</ul>';
	$_html[] = '				</div>';
	$_html[] = '			</div>';
	$_html[] = '		</nav>';
	$_html[] = '		<div class="container-fluid">';
	$_html[] = '			<div class="row">';
	$_html[] = '				<aside id="sidebar" class="col-sm-3 col-md-2 noPrint waypoint animation_left animated" role="sidebar">';
	$_html[] = '					<nav class="waypoint animation_left_d1 animated">';
	$_html[] = '						<ul class="nav nav-sidebar">';
	$_html[] = 								geraMenu();
	$_html[] = '						</ul>';
	$_html[] = '					</nav>';
	$_html[] = '					';
	
	$_html[] = '				</aside>';
	$_html[] = '				<div id="main" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 waypoint animation_bottom animated">';
	
	
	echo implode("\n",$_html);
}

// FOOTER
function get_footer_gestor() {

	$_html[] = '					<footer class="titulo-menu">';
	$_html[] = '						<a title="QUAX" target="_blank" href="https://quax.com.br">
											<b>QUAX</b>
										</a> &copy; '.date("Y").' . V.3<br>
										Todos os Direitos Reservados.';
	$_html[] = '					</footer>';

	$_html[] = '				</div>'; // MAIN
	$_html[] = '			</div>'; // ROW
	$_html[] = '		</div>'; // CONTAINER
	
	$_html[] = 			javascript_enqueue('gestor','return');
	$_html[] = '	</body>';
	$_html[] = '</html>';
	
	echo implode("\n",$_html);
}

// TITULO
function get_barra_header() {
	global $count, $_header, $_controles;

	$_html[] = '<h1 class="page-header"><span class="waypoint animation_scale animated fa fa-'.$_header['icon'].'"></span>'.$_header['titulo'].'</h1>';

	$_html[] = NotifyMessage();
	$_html[] = NotiyMessageForm();
	
	echo implode("\n",$_html);
}

// MENSAGENS DE NOTIFICAÇÃO
function NotifyMessage() {
	global $alertSuccess, $alertFail, $alertMessage;

	if($alertSuccess==true) return '<div class="alert alert-success show waypoint animation_right_d1 animated"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-ok"></span> '.$alertMessage.'</div>';
	elseif($alertFail==true) return '<div class="alert alert-danger show waypoint animation_right_d1 animated"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="glyphicon glyphicon-remove"></span> '.$alertMessage.'</div>';
}

function NotiyMessageForm() {
	global $errors;
	
	if(!empty($errors)) {
		$_html[] = '<div class="alert alert-danger show waypoint animation_right_d1 animated"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Campos Obrigatórios</strong><ul>';
		foreach ($errors as $error) $_html[] = "<li>$error</li>\n";
		$_html[] = '</ul></div>';
		
		return implode("\n",$_html);	
	}
}

// ÚLTIMO ACESSO
function get_last_acess($id, $data=true, $contador=true) {
	global $db, $tables;
	

	if($data && $id) {
		$query = $db->get_row("SELECT data_acesso FROM ".$tables['ACESSOS']." WHERE id_usuario='{$id}' LIMIT 1");
		if($query) {
			$data = explode(" ", $query->data_acesso);
		
			$_html[] = implode("/",array_reverse(explode("-",$data[0]))).' '.substr($data[1], 0, -3);
		}
	}
	
	if($contador && $id) {
		$query = $db->get_var("SELECT COUNT(id) FROM ".$tables['ACESSOS']." WHERE id_usuario='{$id}'");
		if($query>0) {
			if($data) $_html[] = '('.$query.')';
			else $_html[] = $query;
		}
	}
	
	if(count($_html)>0) return implode(" ", $_html);
	else return '-';
}

// THUMBS PADRÕES
function get_thumbs($id_galeria, $tabela, $local, $categoria=null) {
	global $db, $tables;

	$query = $db->get_results("SELECT * FROM ".$tables[strtoupper($tabela)]." WHERE id_galeria='{$id_galeria}'".($categoria != null ? " AND categoria='{$categoria}'" : false)." ORDER BY ordem ASC");
	
	if($query) {
		foreach($query as $rs) $_html[] = '<div id="thumb" class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
												<div class="thumbnail" data-thumb-id="'.$rs->id.'"'.($categoria != null ? ' data-thumb-categoria="'.$categoria.'"' : false).' data-thumb-id-galeria="'.$rs->id_galeria.'">
													<a href="'.$local.'lg-'.$rs->arquivo.'" '.($rs->legenda ? 'data-title="'.$rs->legenda.'"' : false).' data-lightbox="'.($categoria != null ? $categoria : 'galeria').'">
														<img src="'.$local.'tb-'.$rs->arquivo.'" />
													</a>
													<div class="caption">
														<div class="pull-left">
															<a class="ativar'.($rs->ativo ? ' ativo' : ' desativo').'" title="Ativar/Desativar"><span class="fa fa-check"></span></a>
															<a class="legenda'.($rs->legenda ? ' ativo' : ' desativo').'" data-toggle="modal" data-target="#modal-legenda" title="Legenda"><span class="fa fa-comment-o"></span></a>
															<a class="capa'.($rs->capa ? ' ativo' : ' desativo').'" title="Destaque"><span class="fa fa-star"></span></a>
															<a class="del" title="Excluir"><span class="fa fa-trash"></span></a>
															<a class="rotate" title="Rotacionar"><span class="glyphicon glyphicon-refresh"></span></a>
														</div>
														<div class="pull-right">
															<label><input class="checkbox" type="checkbox" name="imagens[]" value="'.$rs->id.'" ></label>
														</div>
													</div>
												</div>
											</div>';

		return implode("\n",$_html);
	}
}




function returnFilePath($location = 'home') {
	if ($location == 'home') {
		$shift_num = SHIFT_NUM;
	} elseif ($location == 'admin') {
		$shift_num = (SHIFT_NUM + 1);
	}

	$this_path  = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME);
	$this_file  = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_BASENAME);
	$full_path  = $this_path . '/' . $this_file;
	$path_array = explode("/", $full_path);
	$path_array = removeBlankElement($path_array);

	for ($i = 0; $i < $shift_num; $i++) {
	    array_shift($path_array);
	}

    return implode("/", $path_array);
}


function del_file_webp($file){
	$arquivo_webp = altera_ext_webp($file);
	@unlink($arquivo_webp);
}

function btn_edit($id){
	echo '<a class="btn unlocked" href="'.HTTP_GESTOR.'form/'.SELF_PAG.'?id='.$id.'"><img src="'.ASSETS_GESTOR.'img/edit.svg"></a>';
}

function btn_delete($id){
	echo '<a class="btn unlocked deletar" href="'.HTTP_GESTOR.'list/'.SELF_PAG.'?id='.$id.'&delete=1"><img src="'.ASSETS_GESTOR.'img/trash.svg"></a>';
}

function btn_add(){
	echo '<a class="btn btn-sm btn-primary" href="'.HTTP_GESTOR.'form/'.SELF_PAG.'"><span class="fa fa-plus"></span> Adicionar Novo</a>';
}

function btn_back(){
	echo '<a class="btn btn-sm btn-default" href="'.HTTP_GESTOR.'list/'.SELF_PAG.'"><span class="fa fa-chevron-left"></span> Voltar</a>';
}

function btn_save(){
	echo '<button class="btn btn-sm btn-success" type="submit" name="submit"><span class="fa fa-check"></span> Salvar</button>';
}

function btn_delete_form($id){
	echo '<a class="btn btn-sm btn-danger deletar" href="'.HTTP_GESTOR.'list/'.SELF_PAG.'?id='.$id.'&delete=1"><span class="fa fa-trash"></span> Deletar</a>';
}

function btn_delete_check(){
	echo '<a class="btn btn-danger deletar-check" href=""><img src="'.ASSETS_GESTOR.'img/trash.svg"></a>';
}

function btn_view_site($link){
	echo '<a class="btn btn-sm btn-default hidden-xs" href="'.$link.'"><span class="fa fa-file-text-o"></span> Ver no site</a>';
}

function btn_sort(){
	echo '<td class="unlocked drag-order text-center"><img class="btn unlocked" src="'.ASSETS_GESTOR.'img/sort.svg" title="Arraste para ordenar"></td>';
}

function btn_add_item($id_pai, $page, $id_avo=null){

	if($id_avo) $param = '&id_avo='.$id_avo;

	echo '<a class="btn btn-sm btn-primary" href="'.HTTP_GESTOR.'form/'.$page.'?id_pai='.$id_pai.$param.'"><span class="fa fa-plus"></span> Adicionar Novo</a>';
}

function btn_edit_item($id_pai, $id_item, $page, $id_avo=null){

	if($id_avo) $param = '&id_avo='.$id_avo;

	echo '<a class="btn unlocked" href="'.HTTP_GESTOR.'form/'.$page.'?id='.$id_item.'&id_pai='.$id_pai.$param.'">
			<img src="'.ASSETS_GESTOR.'img/edit.svg"></a>';
}

function btn_back_item($id_pai, $page, $tab=null, $id_avo=null){

	$param = [];

	if($tab) 	$param[] = 'tab='.$tab;
	if($id_avo) $param[] = 'id_pai='.$id_avo;

	$url = implode('&', $param); 

	echo '<a class="btn btn-sm btn-default" href="'.HTTP_GESTOR.'form/'.$page.'?id='.$id_pai.'&'.$url.'"><span class="fa fa-chevron-left"></span> Voltar</a>';
}

function btn_delete_item($id_pai, $id_item, $param, $tab=null, $id_avo=null){

	if($id_avo) $url = '&id_pai='.$id_avo;

	echo '<a class="btn unlocked deletar" href="'.HTTP_GESTOR.'form/'.SELF_PAG.'?id='.$id_pai.'&'.$param.'='.$id_item.'&tab='.$tab.$url.'">
			<img src="'.ASSETS_GESTOR.'img/trash.svg"></a>';
}

function btn_delete_form_item($id_pai, $id_item, $tab=null, $id_avo=null){

	if($id_avo) $param = '&id_avo='.$id_avo;

	echo '<a class="btn btn-sm btn-danger deletar" href="'.HTTP_GESTOR.'form/'.SELF_PAG.'?id='.$id_item.'&id_pai='.$id_pai.'&tab='.$tab.$param.'&delete=1"><span class="fa fa-trash"></span> Deletar</a>';
}

function count_results($count){
	echo '<div class="cont">Total de Registro(s): '.$count.'</div>';
}

function table_th_check(){
	echo '<th class="text-center" data-sorter="false"><input type="checkbox" value="all" id="select-all"></th>';
}

function table_td_check($id){
	echo '<td class="text-center"><input type="checkbox" value="'.$id.'"></td>';
}


function deleteImg($id, $TABLE, $field, $ROOT=ROOT_UPLOADS_IMG){
	global $db, $tables;

	$IMG = $db->get_var("SELECT {$field} FROM ".$tables[$TABLE]." WHERE id = '{$id}'");

	if( $IMG )
	{
		// DELETE FILE MAIN
		@unlink($ROOT.$IMG);

		$IMG_JPG = str_replace('webp', 'jpg', $IMG);
		$IMG_PNG = str_replace('webp', 'png', $IMG);

		// DELETE FILE JPG EXTRA
		@unlink($ROOT.$IMG_JPG);

		// DELETE FILE PNG EXTRA
		@unlink($ROOT.$IMG_PNG);

		// DELETE TB WEBP ROTATED IMG
		@unlink($ROOT.'tb-'.$IMG);

		// DELETE PNG ROTATED IMG
		@unlink($ROOT.'vertical-tb-'.$IMG_PNG);
		
		// DELETE WEBP ROTATED IMG
		@unlink($ROOT.'vertical-tb-'.$IMG);
	}
}

function deleteFile($id, $TABLE, $field, $ROOT){
	global $db, $tables;

	$FILE = $db->get_var("SELECT {$field} FROM ".$tables[$TABLE]." WHERE id = '{$id}'");

	// DELETE FILE MAIN
	if( $FILE )	@unlink($ROOT.$FILE);
}


function get_card_dashboard($NUMBER, $TEXT, $ICON, $COLOR){

	echo '<div class="col-xs-12 col-md-4 waypoint animation_bottom_d1 animated">
			<div id="box-home" class="light-'.$COLOR.'">
				<div class="avatar waypoint animation_scale_d1 animated">
					<div class="circle">
						<span class="fa fa-'.$ICON.'"></span>
					</div>
				</div>

				<div class="info waypoint animation_right_d1 animated">
					<h2>'.$NUMBER.'</h2>
					<p>'.$TEXT.'</p>
				</div>
			</div>
		</div>';

}

function get_tab_item($NUM, $TEXT, $Q=null){

	if( $NUM == '1' )
	{
		echo '<li '.($_GET['tab']=='' ? 'class="active"':'').'><a href="#tab1" data-toggle="tab">'.$TEXT.'</a></li>';
	}else{
		echo '<li '.($_GET['tab']==$NUM ? 'class="active"' : '').' '.($Q?'':'class="disable"').'><a href="'.($Q?'#tab'.$NUM:'').'" data-toggle="tab">'.$TEXT.'</a></li>';
	}

}


function get_input_date($NAME, $LABEL, $VALUE=null){

	echo '<label for="'.$NAME.'">'.$LABEL.'</label>
		  <input type="text" 
		  	class="form-control input-sm datepicker" 
		  	id="'.$NAME.'" 
		  	name="'.$NAME.'" 
		  	value="'.( $VALUE && $VALUE!='0000-00-00' ? date("d/m/Y",strtotime($VALUE)) : ($_POST[$NAME] ? date("d/m/Y",strtotime($_POST[$NAME])) : '') ).'" 
		  />';
}


function get_input_text($NAME, $LABEL, $VALUE=null, $REQUIRED=null, $CLASS=null, $PLACEHOLDER=null, $IS_ONLY_READ=null){

	if($LABEL) echo '<label for="'.$NAME.'">'.$LABEL . ($REQUIRED ? ' *' : '').'</label>';

	echo '<input type="text" 
		  	class="form-control input-sm '.($CLASS ? $CLASS : '').'" 
		  	id="'.$NAME.'" 
		  	name="'.$NAME.'" 
		  	value="'.($VALUE ? $VALUE : $_POST[$NAME]).'" 
		  	'.($REQUIRED ? 'required' : '').' 
		  	'.($IS_ONLY_READ ? 'readonly' : '').' 
		  	placeholder="'.($PLACEHOLDER ? $PLACEHOLDER : '').'"
		  />';
}


function get_input_range($NAME, $LABEL, $VALUE=null, $CLASS='range-value', $IS_TOTAL=false){

	if($LABEL) echo '<label for="'.$NAME.'">'.$LABEL.'</label>';

	echo '<input type="text" 
		  	class="'.($CLASS ? $CLASS : '').'" 
		  	id="'.$NAME.'" 
		  	name="'.$NAME.'" 
		  	value="'.($VALUE ? $VALUE : $_POST[$NAME]).'" 
		  	readonly
		  />

		  <div class="well">
			<div class="'.($IS_TOTAL ? 'total' : 'range').'" id="'.$NAME.'-range"></div>
		  </div>
		  ';
}


function get_checkbox_switch($NAME, $LABEL, $VALUE=null){

    echo '<div class="switch-wrap">
			<label for="'.$NAME.'">'.$LABEL.'</label>
			<div class="check-radio status">
			 	<input type="checkbox"  id="'.$NAME.'"  name="'.$NAME.'"  value="1"  '.($VALUE==1 ? 'checked' : '').'/>
			</div>
		</div>';
}




# LINHAS DE PRODUTO
function get_emp_cat($selected=NULL, $retorno='value')
{
	global $aLinhaProdutos;

	$array = $aLinhaProdutos;

	if ($retorno == 'value')
	{
		foreach($array as $id => $text)
		{
			if($selected == $id) $_html[] = $text;
		} 
	}
	else if($retorno == 'id')
	{
		foreach($array as $id => $text) if($selected == clean_string($text)) $_html[] = $id;
	} else {
		foreach($array as $id => $text) $_html[] = '<option value="'.$id.'" '.($id==$selected&&$selected!=NULL?'selected="selected"':'').'>'.$text.'</option>';
	}
	return implode("\n",$_html);
}


# LINHDAS DE PRODUTO
function get_tipo_carac_produto($selected=NULL, $retorno='value')
{
	global $aTipoCaracProduto;

	$array = $aTipoCaracProduto;

	if ($retorno == 'value')
	{
		foreach($array as $id => $text)
		{
			if($selected == $id) $_html[] = $text;
		} 
	}
	else if($retorno == 'id')
	{
		foreach($array as $id => $text) if($selected == clean_string($text)) $_html[] = $id;
	} else {
		foreach($array as $id => $text) $_html[] = '<option value="'.$id.'" '.($id==$selected&&$selected!=NULL?'selected="selected"':'').'>'.$text.'</option>';
	}
	return implode("\n",$_html);
}