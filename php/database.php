<?php

/*
|--------------------------------------------------------------------------
| Set Tables Database
|--------------------------------------------------------------------------
|
| Here you can set the application tables
|
*/

$tables = [];

$tables['ACESSOS'] 		 	  	= PREFIX.'acessos';
$tables['PAGINAS'] 			  	= PREFIX.'paginas';
$tables['USUARIOS'] 		  	= PREFIX.'usuarios';
$tables['BANNERS']			  	= PREFIX.'banners';
$tables['BANNERS_DESCRITIVOS']	= PREFIX.'banners_descritivos';
$tables['BANNERS_MEIO']	        = PREFIX.'banners_meio';
$tables['BANNERS_GALERIA']	    = PREFIX.'banners_galeria';
$tables['CADASTRO']				= PREFIX.'cadastro';
$tables['CONFIG']			  	= PREFIX.'config';
$tables['ANDAMENTO_OBRA']		= PREFIX.'andamento_obra';

$tables['GALERIA']				= PREFIX.'galeria';
$tables['GALERIA_IMG']			= PREFIX.'galeria_imagens';
$tables['EMPREENDIMENTOS'] 				    = PREFIX.'empreendimentos';
$tables['EMPREENDIMENTOS_PLANTAS']		    = PREFIX.'empreendimentos_plantas';
$tables['EMPREENDIMENTOS_BANNERS']		    = PREFIX.'empreendimentos_banners';



/*
|--------------------------------------------------------------------------
| Database Connection
|--------------------------------------------------------------------------
|
| Here the connection to the database is initialized
|
*/

require PHP."ezsql/ez_sql_core.php";
require PHP."ezsql/ez_sql_mysqli.php";

$db = new ezSQL_mysqli(DB_USER,DB_PASS,DB_NAME,DB_HOST);
$db->query("SET NAMES 'utf8'");
$db->query('SET character_set_connection=utf8');
$db->query('SET character_set_client=utf8');
$db->query('SET character_set_results=utf8');