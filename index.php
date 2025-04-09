<?php
function sanitize_output($buffer) {
    $search = [
        '/\>[^\S ]+/s',      // strip whitespaces after tags, except space
        '/[^\S ]+\</s',      // strip whitespaces before tags, except space
        '/(\s)+/s',          // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/', // Remove HTML comments
		'/\>\s+\</',         // Remove Extra space between Tags
    ];

    $replace = [
        '>',
        '<',
        '\\1',
        '',
		'><',
    ];

    $buffer = preg_replace($search, $replace, $buffer);
    return $buffer;
}

// ob_start("sanitize_output"); // minify the output




/*
|--------------------------------------------------------------------------
| SET MODE LIGHTHOUSE
|--------------------------------------------------------------------------
|
| Identifies when the site is being accessed by Google Page Speed
|
*/

$agent = $_SERVER['HTTP_USER_AGENT'] ;

if( strpos($agent, 'Chrome-Lighthouse') !== FALSE ){
	$lighthouse = true;
} else {
	$lighthouse = false;
}
define('IS_LIGHTHOUSE', $lighthouse);











require 'php/config.php';

$modrewrite = returnFriendyURL();



if($language)
{
	$lang_nav 	  = limpaString(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
	$lang_cliente = limpaString(end($modrewrite));
	$lang_cookie  = (!empty($_COOKIE['lang_website'])?limpaString($_COOKIE['lang_website']):false);

	if(in_array($lang_cliente,$array_lang)) $lang = $lang_cliente;
	elseif(strlen($lang_cookie)>0 && in_array($lang_cookie,$array_lang)) $lang = $lang_cookie;
	elseif(in_array($lang_nav,$array_lang)) $lang = $lang_nav;
	else $lang = reset($array_lang);

	if($lang_cookie||$lang_cookie!=$lang) setcookie ('lang_website', $lang, time() + (60*60*24));
	if(in_array(end($modrewrite),$array_lang)) array_pop($modrewrite);
} else $lang = 'pt';



$page_first = clean_string(urldecode(reset($modrewrite)));
$page 		= end($modrewrite);
$pageSearch = (empty($page)?'index':(in_array($page, ['',' ','index','home'] )?'index':clean_string(urldecode($page))));

$page_first = antiSQL($page_first);


if( !empty($page_first) ) $page = $db->get_row("SELECT * FROM ".$tables['PAGINAS']." WHERE permalink='{$page_first}'");

if($page && $db->num_rows) $returnURL = ['codigo'=>200,'pagina'=>$page];
else {
	$page = $db->get_row("SELECT * FROM ".$tables['PAGINAS']." WHERE permalink='{$pageSearch}'");
	if($page && $db->num_rows) $returnURL = ['codigo'=>200,'pagina'=>$page];
	else $returnURL = ['codigo'=>404,'pagina'=>$pageSearch];
}

if($pageSearch=='index' && $returnURL['codigo']!=404) define('ISHOME',true);
else define('ISHOME',false);







/*
|--------------------------------------------------------------------------
| SET MOBILE DEVICE
|--------------------------------------------------------------------------
|
*/

require_once PHP.'classes/Class.mobiledetect.php';
$detect = new Mobile_Detect;

if ( $detect->isMobile() && !$detect->isTablet() ) {
	$MOBILE = true;
}else{
	$MOBILE = false;
}


if ( $detect->isMobile() && $detect->isTablet() ) {
	$TABLET = true;
}else{
	$TABLET = false;
}


if( is_array($returnURL) && count($returnURL) > 0 )
{
	switch($returnURL['codigo'])
	{
		case '200':
			$pagina 	 			= $returnURL['pagina'];
			$_SEO["title"] 			= (!ISHOME?$pagina->titulo.' - '.EMPRESA:EMPRESA);
			$_SEO["permalink"] 		= $pagina->permalink;
			$_SEO["description"] 	= $pagina->description;
			$conteudo 	 			= $pagina->conteudo;
						
			if(strlen($pagina->arquivo)>0) include_once TEMPLATE.$pagina->arquivo;
			else {
				get_header();
				echo $conteudo;
				get_footer();
			}
		break;
	
		case '404':
			header("HTTP/1.1 404 Not Found");
			header("Status: 404 Not Found");
			$pagina = $returnURL['pagina'];
			require TEMPLATE.'404.php';
		break;
	}
} else trigger_error("Check your system settings", E_USER_ERROR);