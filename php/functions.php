<?php
function full_url()
{
    $s  = ( empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on"? "s" : ""));
    $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
    $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function PageCanomical() {
	$parsed_url = parse_url( full_url() );
	$base_url   = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];
	return $base_url;
}

function validElement($element) {
    return strlen($element) > 0;
}

function removeBlankElement($array) {
	return array_values(array_filter($array, "validElement"));
}

function returnFriendyURL() {
	$modrewrite = explode("/", str_replace(strrchr($_SERVER["REQUEST_URI"], "?"), "", $_SERVER["REQUEST_URI"]));
	$modrewrite = removeBlankElement($modrewrite);

	for ($i = 0; $i < SHIFT_NUM; $i++) {
		array_shift($modrewrite);
	}
	return $modrewrite;
}

function limpaString($string) {
	$valid_chars_regex = 'a-zA-Z0-9';
	return preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', " ", $string);
}

function limpaEspaco($string){
    return str_replace(" ", "", $string);
}

function validarEmail($email) {
    // Verifica se o email é válido usando filter_var com o filtro de validação de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // Expressão regular para garantir que o email siga o formato: parte_local@dominio.extensao
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Verifica se o email tem uma extensão válida após o domínio
    if (!preg_match($pattern, $email)) {
        return false;
    }

    return true;
}

//function validarEmail($email) {
//    // Verifica se o email é válido usando filter_var com o filtro de validação de email
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        return false;
//    }
//
//    // Expressão regular para garantir que o email siga o formato: parte_local@dominio.extensao
//    $pattern = "/^[a-z0-9]+([_+\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
//
//    // Verifica se o email tem uma extensão válida após o domínio
//    if (!preg_match($pattern, $email)) {
//        return false;
//    }
//
//    return true;
//}
function CurrentPageURL() {
	$pageURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	return $pageURL;
}

function script_name() {
	$script_name = explode('/',$_SERVER['REQUEST_URI']);
	if(count($script_name)>0) return end($script_name);
	else return $script_name;
}

function javascript_enqueue($location='home',$return='echo') {
	global $javascript;
	
	foreach($javascript as $js)
	{
		if( LOCALHOST ){
			$_html[] = '<script src="'.($location=='home'?ASSETS:ASSETS_GESTOR).'js/'.$js.'?v='.rand(0,9999).'"></script>';
		}else{
			$_html[] = '<script src="'.($location=='home'?ASSETS:ASSETS_GESTOR).'js/'.$js.'"></script>';
		}
	}
	
	if($return=='return') return implode("\n",$_html);
	else echo "\n".implode("\n",$_html);
}

function add_javascript($array) {
	global $javascript;
	foreach($array as $file) if(!in_array($file,$javascript)) array_push($javascript, $file);
}

function style_enqueue($location='home',$return='echo') {
	global $style;

	foreach($style as $css)
	{
		if( LOCALHOST ){
			$_html[] = '<link rel="stylesheet" href="'.($location=='home'?ASSETS:ASSETS_GESTOR).$css.'?v='.rand(0,9999).'" type="text/css" />';
		}else{
			$_html[] = '<link rel="stylesheet" href="'.($location=='home'?ASSETS:ASSETS_GESTOR).$css.'" type="text/css" />';
		}
	} 

	if($return=='return') return implode("\n",$_html);
	else echo implode("\n",$_html);
}

function add_style($array) {
	global $style;
	foreach($array as $file) if(!in_array($file,$style)) array_push($style, $file);
}

// function clean_string($str, $replace=array(), $delimiter='-') {
// 	if(!empty($replace)) $str = str_replace((array)$replace, ' ', $str);
// 	$clean = preg_replace("/[^a-zA-Z0-9\ \-\.]/", '', $str);
// 	$clean = strtolower(trim($clean, '-'));
// 	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
// 	return $clean;
// }

function clean_string($str, $replace=array(), $delimiter='-') {
	if(!empty($replace)) $str = str_replace((array)$replace, ' ', $str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\ \-\.]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}



function get_templates($select=NULL) {
	$array_ignore_file = array();
	foreach(glob(TEMPLATE.'*.php') as $file) {
		$info = pathinfo($file);
		if(!in_array($info['filename'],$array_ignore_file)) $option_list[] = '<option value="'.$info['basename'].'" '.($info['basename']==$select?'selected':false).'>'.$info['filename']."</option>";
	}
	echo implode("\n",$option_list);
}

function get_pages($select=array()) {
	global $db,$tables;
	$query = $db->get_results("SELECT * FROM ".$tables['PAGINAS']);
	foreach($query as $page) $option_list[] = '<option value="'.$page->id.'" '.(in_array($page->id,$select)?'selected':false).'>'.$page->titulo."</option>";
	echo implode("\n",$option_list);
}

function printr($string) {
	echo '<pre>';
	print_r($string);
	echo '</pre>';
}

function get_size_in_byte($size) {
	$unit = strtoupper(substr($size, -2));
	$multiplier = ($unit == 'MB' ? 1048576 : ($unit == 'KB' ? 1024 : ($unit == 'GB' ? 1073741824 : 1)));
	$only_size = str_replace($unit, '', strtoupper($size));
	return $only_size*$multiplier;
}

function upload($upload_name, $save_path, $max_file_size, $whitelist = false, $blacklist = false, $overwrite = false, $rename = 'md5') {
    // Check post_max_size
    $POST_MAX_SIZE = ini_get('post_max_size');
    $unit = strtoupper(substr($POST_MAX_SIZE, -1));
    $multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));
    if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier * (int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
        return array(false, 'POST exceeded maximum allowed size.');
    }

    $max_file_size_in_bytes = get_size_in_byte($max_file_size);

    // Other variables
    $MAX_FILENAME_LENGTH = 260;
    $uploadErrors = array(
        UPLOAD_ERR_OK => 'There is no error, the file uploaded with success',
        UPLOAD_ERR_INI_SIZE => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION => 'A PHP extension stopped the file upload.'
    );

    // Validate the upload
    if (!isset($_FILES[$upload_name])) {
        return array(false, 'No upload found in $_FILES for ' . $upload_name);
    } else if ($_FILES[$upload_name]['error'] != UPLOAD_ERR_OK) {
        return array(false, $uploadErrors[$_FILES[$upload_name]['error']]);
    } else if (!@is_uploaded_file($_FILES[$upload_name]['tmp_name'])) {
        return array(false, 'Upload inválido');
    }

    // Validate the file size
    $file_size = @filesize($_FILES[$upload_name]['tmp_name']);
    if (!$file_size || $file_size > $max_file_size_in_bytes) {
        return array(false, 'Tamanho ultrapassado (' . strtoupper($max_file_size) . ')');
    }
    if ($file_size <= 0) {
        return array(false, 'Arquivo inválido (0 byte)');
    }

    // Validate file name
    $file_name = strtolower(basename($_FILES[$upload_name]['name']));
    $info = pathinfo($file_name);

    // Rename the file to be saved
    if ($rename) {
        switch ($rename) {
            case 'md5':
                $file_name = strtolower(md5($file_name . time()) . '.' . $info['extension']);
                break;
            default:
                $file_name = strtolower($rename . '.' . $info['extension']);
        }
    }

    // Validate file name length
    if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
        return array(false, 'Nome inválido');
    }

    // Check if the directory exists and is writable
    if (!is_dir($save_path) || !is_writable($save_path)) {
        return array(false, 'Diretório de destino inválido');
    }

    // Validate that we won't over-write an existing file
    if (!$overwrite && file_exists($save_path . $file_name)) {
        return array(false, 'Este nome já está sendo usado');
    }

    // Validate file extension
    if ($whitelist && !in_array($info['extension'], $whitelist)) {
        return array(false, 'Extensão inválida');
    }
    if ($blacklist && in_array($info['extension'], $blacklist)) {
        return array(false, 'Extensão inválida');
    }

    // Upload the file
    if (!move_uploaded_file($_FILES[$upload_name]['tmp_name'], $save_path . $file_name)) {
        return array(false, 'Não foi possível fazer o upload.');
    }

    return array(true, $file_name, $file_size);
}


function br2nl($string,$ql='\n'){
	return preg_replace('/\<br(\s*)?\/?\>/i', $ql, $string);
}

function get_youtube_code($urlx) {
	$url = $urlx.'&';
	$pattern = '/v=(.+?)&+/';
	preg_match($pattern, $url, $matches);
	if($matches[1]) return ($matches[1]);
	else return $urlx;
}

function get_info_vimeo($url_video) {
	preg_match('/vimeo.com\/(\d+)$/', $url_video, $matches);
	if (count($matches) != 0) {
		$vimeo_id = $matches[1];
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeo_id.php"));
		return array('id_video'=>$vimeo_id, 'thumb'=>$hash[0]['thumbnail_medium']);
	} else return false;
}

function video_image($url){
	$image_url = parse_url($url);
	if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
		$array = explode("&", $image_url['query']);
		return array('servidor'=>'youtube','codigo'=>substr($array[0], 2), 'imagem'=>"https://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg");
	} else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
		$hash = unserialize(file_get_contents("https://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
		return array('servidor'=>'vimeo','codigo'=>substr($image_url['path'], 1),'imagem'=>$hash[0]["thumbnail_large"]);
	}
}

function array_keys_exists($array,$keys) {
    foreach($keys as $k) {
        if(!isset($array[$k])) {
        return false;
        }
    }
    return true;
}

function escape($string) {
	return mysqli_real_escape_string(stripslashes($string));
}

function valid_url($url) {
	if (preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)) return $url;
	else return 'http://'.$url;
}


function SendMailAdm($assunto, $mensagem, $reply=NULL, $debug=false, $emailAlternativo=NULL, $arquivo_anexo=NULL, $emailAdicional=NULL) {

	require_once PHP."phpmailer/class.phpmailer.php";
	require_once PHP."phpmailer/class.smtp.php";

	$mail = new PHPMailer();
	
	$mail->IsSMTP();
	$mail->SMTPAuth 	= true;
	
	$mail->Port 		= PORT_EMAIL;
	$mail->Host 		= HOST_EMAIL;
	$mail->Username 	= USER_EMAIL;
	$mail->Password 	= PASS_EMAIL;
	$mail->SetFrom(USER_EMAIL,EMPRESA);
	

	if( !is_null($reply) ){
		$mail->addReplyTo($reply);
	}

	if( is_null($emailAlternativo) )
	{
		$emails = explode(',', EMAIL_CONTATO);

		foreach ($emails as $key => $email)
		{
			$mail->AddAddress($email);
		}
	}else{
		$mail->AddAddress($emailAlternativo);
	}

	// EMAIL ADICIONAL
	if( !is_null($emailAdicional) ){
		$mail->AddAddress($emailAdicional);
	}

	// COPIA TEMP
	//$mail->AddBCC("quax@quax.com.br");

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = '<div style="width: 100%; background: #eeeeee; padding: 40px 0; text-align:center;">
				<br><br>
				<img src="'.IMG.'main-logo.png"><br><br>
				<div style="color:#333; width:650px; text-align:left; background:#FFF; padding:30px; margin: 0 auto; font-size:14px; font-family:\'arial\'; border-top:4px solid #cf9b2d;">
					'.$mensagem.'
					<br>
					<hr>
					<br>
					<strong>Equipe - Administrativa</strong>
				</div>
			</div>';

	$mail->Body = $body;


	// Anexo
	if( $arquivo_anexo ) $mail->AddAttachment($arquivo_anexo);


	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	return $enviado;
}

function SendMailCliente($email, $assunto, $mensagem, $debug=false, $reply=NULL) {

	require_once PHP."phpmailer/class.phpmailer.php";
	require_once PHP."phpmailer/class.smtp.php";

	$mail = new PHPMailer();
	
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	
	$mail->Port 	= PORT_EMAIL;
	$mail->Host 	= HOST_EMAIL;
	$mail->Username = USER_EMAIL;
	$mail->Password = PASS_EMAIL;
	$mail->SetFrom(USER_EMAIL, EMPRESA);
	$mail->AddReplyTo(REPLY_EMAIL, EMPRESA);

	$mail->AddAddress($email);

	$mail->IsHTML(true);
	$mail->CharSet = 'utf-8';

	$mail->Subject = $assunto;

	$body = '<div style="width: 100%; background: #eeeeee; padding: 40px 0; text-align:center;">
				<div align="center" style="color: #999; font-size: 11px;">Este é um e-mail automático, você não precisa respondê-lo.</div>
				<br><br>
				<img src="'.IMG.'main-logo.png"><br><br>
				<div style="color:#333; width:650px; text-align:left; background:#FFF; padding:30px; margin: 0 auto; font-size:14px; font-family:\'arial\'; border-top:4px solid #cf9b2d;">
					'.$mensagem.'
					<br><br>
					<hr>
					<br>
					<strong>Equipe - Administrativa</strong>
				</div>
			</div>';

	$mail->Body = $body;

	$enviado = $mail->Send();

	$mail->ClearAllRecipients();
	$mail->ClearAttachments();

	return $enviado;
}


function countdown($pstr_day) {
	return round((strtotime( $pstr_day )-strtotime(date( "Y-m-d" )))/86400);
}

function abrevia($texto, $tam){
	if( strlen($texto) > $tam)
	{
		$texto = substr($texto, 0, $tam) . "...";
	}
	return $texto;
}

function dia_da_semana($data){

	$dd = date("w", strtotime($data) );

	switch($dd) {
		case"0": $dia_semana = "Domingo"; break;
		case"1": $dia_semana = "Segunda"; break;
		case"2": $dia_semana = "Terça"; break;
		case"3": $dia_semana = "Quarta"; break;
		case"4": $dia_semana = "Quinta"; break;
		case"5": $dia_semana = "Sexta"; break;
		case"6": $dia_semana = "Sábado"; break;
	}

	return $dia_semana;
}

// FORMATA NUM
function only_number($string) { return preg_replace("/[^0-9]/","", $string); }

function floatBrToMysql($valor) { return str_replace(",",".", str_replace(".","",$valor) ); }

// FOMATA DATA
function formatDate($date,$format='reverse',$extra=false) {
	if($date != '0000-00-00') return ($format=='reverse'?implode('-',array_reverse(explode('/',$date))):implode('/',array_reverse(explode('-',$date))));
	elseif($extra) return $extra;
}

function data($date, $format='d/m/Y'){
	return date($format, strtotime($date));
}

// FORMATA CPF/CNPJ
function formata_cpf_cnpj($campo, $formatado = true){
	$codigoLimpo = preg_replace("[' '-./ t]",'',$campo);
	$tamanho = (strlen($codigoLimpo) -2);
	if ($tamanho != 9 && $tamanho != 12){
		return false;
	}

	if ($formatado){
		$mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

		$indice = -1;
		for ($i=0; $i < strlen($mascara); $i++) {
			if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
		}
		$retorno = $mascara;

	} else {
		$retorno = $codigoLimpo;
	}
	return $retorno;
}

// TODOS MESES
function get_mes($selected=NULL, $retorno='value') {
	$array = array(
		'01' => 'Janeiro',
		'02' => 'Fevereiro',
		'03' => 'Março',
		'04' => 'Abril',
		'05' => 'Maio',
		'06' => 'Junho',
		'07' => 'Julho',
		'08' => 'Agosto',
		'09' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro'
	);

	if ($retorno == 'value') {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = ($vlr_mes==$selected?$nome_mes:false);
	} else {
		foreach($array as $vlr_mes => $nome_mes) $_html[] = '<option value="'.$vlr_mes.'" '.($vlr_mes==$selected&&$selected!=NULL?'selected="selected"':false).'>'.$nome_mes.'</option>';
	}
	return implode("\n",$_html);
}

// SELECT NOMES ESTADOS
function get_estado($selected=NULL, $echo=true) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'rs' => 'Rio Grande do Sul',
		'ro' => 'Rondônia',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	foreach($array_state as $sigla => $estado) $_html[] = '<option value="'.$sigla.'" '.($sigla==$selected?'selected':false).'>'.$estado.'</option>';
	if($echo) echo implode("\n",$_html);
	else return implode("\n",$_html);
}

// NOMES ESTADOS
function get_estado_nome($st) {
	$array_state = array(
		'ac' => 'Acre',
		'al' => 'Alagoas',
		'am' => 'Amazonas',
		'ap' => 'Amapá',
		'ba' => 'Bahia',
		'ce' => 'Ceará',
		'df' => 'Distrito Federal',
		'es' => 'Espírito Santo',
		'go' => 'Goiás',
		'ma' => 'Maranhão',
		'mt' => 'Mato Grosso',
		'ms' => 'Mato Grosso do Sul',
		'mg' => 'Minas Gerais',
		'pa' => 'Pará',
		'pb' => 'Paraíba',
		'pr' => 'Paraná',
		'pe' => 'Pernambuco',
		'pi' => 'Piauí',
		'rj' => 'Rio de Janeiro',
		'rn' => 'Rio Grande do Norte',
		'rs' => 'Rio Grande do Sul',
		'ro' => 'Rondônia',
		'rr' => 'Roraima',
		'sc' => 'Santa Catarina',
		'se' => 'Sergipe',
		'sp' => 'São Paulo',
		'to' => 'Tocantins'
	);

	return $array_state[$st];
}



// GET CIDADE
function get_cidades($estado=NULL, $cidade=NULL, $echo = true) {
	global $db,$tables;

	if($estado){
		$estado = strtoupper($estado);
		$query = $db->get_results("SELECT id, nome FROM ".$tables['CIDADES']." WHERE uf='{$estado}'");
		foreach($query as $result) $_html[] = '<option value="'.$result->id.'" '.($result->id==$cidade?'selected="selected"':"").'>'.$result->nome.'</option>';
		if($echo)echo implode("\n",$_html);
		else return implode("\n",$_html);
	}
}

// GET NOME CIDADE
function get_cidade_nome($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome FROM ".$tables['CIDADES']." WHERE id='{$id}'");
	if($query) return $query->nome;
}

// GET ID CIDADE
function get_id_cidade($estado=NULL, $cidade=NULL) {
	global $db,$tables;

	if($estado)
	{
		$estado = strtoupper($estado);
		$query = $db->get_row("SELECT id FROM ".$tables['CIDADES']." WHERE uf='{$estado}' AND nome='{$cidade}'");
		return $query->id;
	}
}

// GET PERMALINK CIDADE
function get_permalink_cidade($id) {
	global $db, $tables;
	$query = $db->get_row("SELECT permalink FROM ".$tables['CIDADES']." WHERE id='{$id}'");
	if($query) return $query->permalink;
}

// GET NOME CIDADE BY PERMALINK
function get_nome_cidade_permalink($permalink) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome FROM ".$tables['CIDADES']." WHERE permalink='{$permalink}'");
	if($query) return $query->nome;
}

// GET ID CIDADE BY PERMALINK
function get_id_cidade_permalink($permalink) {
	global $db, $tables;
	$query = $db->get_row("SELECT id FROM ".$tables['CIDADES']." WHERE permalink='{$permalink}'");
	if($query) return $query->id;
}




// DESTINO LINK
function get_link_destino($valor=NULL, $retorno='value') {
	$array = ['_self' => 'Mesma janela', '_blank' => 'Nova janela'];

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}


// SIM OU NAO
function get_sn($valor=NULL, $retorno='value') {
	$array = ['0'=>'Não', '1'=>'Sim'];

	if ($retorno == 'value') {
		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:false);
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}

// STATUS
function get_status($valor=NULL, $retorno='value') {
	$array = array('1'=>' ', '0'=>' ');

	$class = "";

	if ($retorno == 'value')
	{
		if( $valor == "1" ){
			$class = "is-active green-dot";
		} else {
			$class = "disabled-dot";
		}

		foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor? '<span class="'.$class.'">'.$nome.'</span>':'');
	} else {
		foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	}
	return implode("\n",$_html);
}

function isSafari() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    return strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false && strpos($userAgent, 'Chromium') === false;
}

function verifySafariImgType($file, $type='png') {


	if (isSafari() && $type == 'png') {
		return altera_ext_png($file);
	}
	
	if (isSafari() && $type == 'jpg') {
		return altera_ext_jpg($file);
	}


	return $file;

}

function altera_ext_webp($file) {
	if ($file) {
		return str_replace(['jpg', 'png', 'gif'], 'webp', $file);
	}else{
		return "invalid file";
	}
}


function altera_ext_jpg($file) {
	if ($file) {
		return str_replace(['webp', 'png', 'gif'], 'jpg', $file);
	}else{
		return "invalid file";
	}
}
function altera_ext_png($file) {
	if ($file) {
		return str_replace(['webp', 'jpg', 'gif'], 'png', $file);
	}else{
		return "invalid file";
	}
}



// PAGINAS PERMALINK
function get_paginas_permalink($selected=NULL, $retorno='value') {
	global $db, $tables;
	$array = $db->get_results("SELECT titulo, permalink FROM ".$tables['PAGINAS']." ORDER BY titulo");

	if ($retorno == 'value') {
		foreach($array as $rs) $_html[] = ($selected == $rs->permalink ? $rs->titulo : "");
	} else {
		foreach($array as $rs) $_html[] = '<option value="'.$rs->permalink.'" '.($rs->permalink==$selected&&$selected!=NULL?'selected="selected"':"").'>'.$rs->titulo.'</option>';
	}
	return implode("\n",$_html);
}

// STATUS DAS NOTÍCIAS
function get_not_status($valor=NULL) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = '<option value="'.$vlr.'" '.($vlr==$valor&&$valor!=NULL?'selected="selected"':"").'>'.$nome.'</option>';
	return implode("\n",$_html);
}

function get_not_status_value($valor) {
	$array = array('2' => 'Rascunho', '1' => 'Publicado', '0' => 'Desativado');
	foreach($array as $vlr => $nome) $_html[] = ($vlr==$valor?$nome:"");
	return implode("\n",$_html);
}

// GET NOME AUTOR
function get_nome_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT nome_completo FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->nome_completo;
}

// GET FOTO AUTOR
function get_foto_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT foto FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->foto;
}

// GET EMAIL AUTOR
function get_email_autor($id=NULL) {
	global $db, $tables;
	$query = $db->get_row("SELECT email FROM ".$tables['USUARIOS']." WHERE id = '{$id}'");
	return $query->email;
}






function geraSenha($tamanho=8, $maiusculas=true, $numeros=true, $simbolos=false)
{
	$lmin = 'abcdefghjkmnopqrstuvwxyz';
	$lmai = 'ABCDEFGHJKMNOPQRSTUVWXYZ';
	$num  = '1234567890';
	$simb = '!@#$%*-';
	$retorno = '';
	$caracteres = '';
	$caracteres .= $lmin;
	if ($maiusculas) $caracteres .= $lmai;
	if ($numeros) $caracteres .= $num;
	if ($simbolos) $caracteres .= $simb;
	$len = strlen($caracteres);
	for ($n = 1; $n <= $tamanho; $n++) {
	$rand = mt_rand(1, $len);
	$retorno .= $caracteres[$rand-1];
	}
	return $retorno;
}

function antiSQL($campo) {
	// remove palavras que contenham sintaxe sql
	$campo = preg_replace("/(table_name|alter table|column_name|select|like|database|union|chr\(|exp\(|elt\(|difference|convert|cvar|session_user|concat|benchmark|null|schema|insert|delete|update|where|were|drop table|show tables|utf8|ASCII|xtype|script|document|%|<>|\"|\'|&|\*|--|\\\\)/i","",$campo);

	$campo = trim($campo); //limpa espaços vazio
	$campo = strip_tags($campo); //tira tags html e php
	$campo = addslashes($campo);
	return $campo;
}


function moeda($valor){
	return number_format($valor,2,",",".");
}



// HEADER
function get_header() {
	global $_SEO, $db, $tables, $MOBILE, $TABLET, $lang, $_lang, $qConfig, $ativarTag, $imgDestaque, $title_share, $desc_share, $_param; 
	return include_once ROOT.'/template/includes/header.php';
}

// FOOTER
function get_footer() {
	global $titulo, $permalink, $db, $tables, $_SEO, $returnURL, $_lang, $lang, $MOBILE, $TABLET, $qConfig, $_param;
	return include_once ROOT.'/template/includes/footer.php';
}

function clear_phone($fone){
	$fone = str_replace([' ', '(', ')', '-', '.'], '', $fone);
	return $fone;
}

function roundedLog(){
    echo '<svg width="224" class="spin" height="223" viewBox="0 0 224 223" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <rect x="0.396973" width="223.417" height="222.987" fill="url(#pattern0_117_434)"/>
        <defs>
        <pattern id="pattern0_117_434" patternContentUnits="objectBoundingBox" width="1" height="1">
        <use xlink:href="#image0_117_434" transform="scale(0.00192308 0.00192678)"/>
        </pattern>
        <image id="image0_117_434" width="520" height="519" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
        </defs>
        </svg>
        ';
}

function processURL($url)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
	CURLOPT_URL => $url,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


function createImageJPG($sTempFileName, $iWidth, $iHeight, $sFileName, $iX, $iY, $iW, $iH, $folder=NULL, $quality=80)
{
	include_once PHP.'classes/Class.imagem.php';

	$sFileNameExt = $sFileName.'.jpg';

	$aSize = getimagesize($sTempFileName);
	if (!$aSize) {
	  @unlink($sTempFileName);
	  return;
	}

	if( $folder==NULL) $folder = ROOT_UPLOADS_IMG;

	switch($aSize['mime']) {
	  case 'image/jpeg': $vImg = @imagecreatefromjpeg($sTempFileName); break;
	  case 'image/png':  $vImg = @imagecreatefrompng($sTempFileName); break;
	  default: @unlink($sTempFileName); return;
	}

	$vDstImg = @imagecreatetruecolor( $iWidth, $iHeight );
	imagecopyresampled($vDstImg, $vImg, 0, 0, (int)$iX, (int)$iY, $iWidth, $iHeight, (int)$iW, (int)$iH);
	imagejpeg($vDstImg, $sTempFileName, $quality);

	$image = new Image(TEMP.$sFileNameExt);
	$image->setPathToTempFiles(TEMP);
	$image->save($folder.$sFileName);

	imagedestroy($vDstImg);
	imagedestroy($vImg);
	@unlink(TEMP.$sFileNameExt);
}


function convertJPGtoPNG($fileWithoutExt)
{
	$image = imagecreatefrompng($fileWithoutExt.'.png');
	imagejpeg($image, $fileWithoutExt.'.jpg', 80);
	// LIBERA A IMAGEM DA MEMÓRIA
	imagedestroy($image);
	// DELETA O ARQUIVO PNG
	@unlink($fileWithoutExt.'.png');
}


function find_char($valor_procurado, $string){
	if( $valor_procurado && $string )
	{
		$string_array = str_split($string); 
		foreach ($string_array as $k => $value) {
			if( $value == $valor_procurado ) return true;
		}
	}
	return false;
}


function find_string($needle, $haystack)
{
    return strpos($haystack, $needle) !== false;
}


function first_name($name){
	if( $name )
	{
		$first = explode(' ', $name); 
		return $first[0];
	}
}


function get_svg_seta_dir() {
	$rtn = '<svg width="35px" height="35px">
			<path fill-rule="evenodd" fill="#FFF"
			 d="M34.009,17.992 C34.110,17.747 34.110,17.473 34.009,17.228 C33.958,17.106 33.885,16.995 33.792,16.903 L17.750,0.860 C17.359,0.469 16.726,0.469 16.336,0.860 C15.945,1.251 15.945,1.883 16.336,2.274 L30.672,16.610 L1.000,16.610 C0.447,16.610 -0.000,17.058 -0.000,17.610 C-0.000,18.163 0.447,18.610 1.000,18.610 L30.672,18.610 L16.336,32.946 C15.945,33.336 15.945,33.970 16.336,34.361 C16.531,34.555 16.787,34.653 17.043,34.653 C17.299,34.653 17.555,34.555 17.750,34.361 L33.792,18.318 C33.885,18.226 33.958,18.114 34.009,17.992 Z"/>
			</svg>';
	echo $rtn;
}

function get_svg_seta_esq() {
	$rtn = '<svg width="35px" height="35px">
			<path fill-rule="evenodd" fill="#FFF"
			 d="M34.000,16.610 L4.328,16.610 L18.664,2.274 C19.055,1.883 19.055,1.251 18.664,0.860 C18.273,0.469 17.641,0.469 17.250,0.860 L1.207,16.903 C1.115,16.995 1.042,17.105 0.991,17.228 C0.890,17.473 0.890,17.747 0.991,17.993 C1.042,18.114 1.115,18.225 1.207,18.318 L17.250,34.361 C17.445,34.555 17.701,34.653 17.957,34.653 C18.213,34.653 18.469,34.555 18.664,34.361 C19.055,33.970 19.055,33.336 18.664,32.946 L4.328,18.610 L34.000,18.610 C34.552,18.610 35.000,18.163 35.000,17.610 C35.000,17.058 34.552,16.610 34.000,16.610 Z"/>
			</svg>';
	echo $rtn;
}




function htmlLog(){
	$_html = '<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        body{
            background: #222;
            font-family: "Courier";
            color: #CCC;
            padding: 30px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    '.strtoupper(EMPRESA).' - SISTEMA - LOG<br>
    ---------------------------
    <br><br>';

    echo $_html;
}


function residenceSlider($permalink = '', $comodos, $qBanners, $titulo) {
	return include ROOT.'/template/sections/residence-slider-section.php';
}

function residencePlants($qPlantas, $permalinkApartamento) {
	global $MOBILE;
	return include ROOT.'/template/sections/residence-plant-slider-section.php';
}