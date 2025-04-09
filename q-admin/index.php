<?php
require "config.php";


# GET DATABASE --------------------------------------------------------------------------------------------------- 

$contBanners     	= $db->get_var("SELECT COUNT(id) FROM ".$tables['BANNERS']);
// $contBlog 			= $db->get_var("SELECT COUNT(id) FROM ".$tables['BLOG']);
$contUser 			= $db->get_var("SELECT COUNT(id) FROM ".$tables['USUARIOS']);


# -----------------------------------------------------------------------------------------------------------------


if ( $_GET['error'] ) {
	$alertFail 	  = true;
	$alertMessage = 'Atenção, você tentou acessar uma página sem permissão!';
}

$_header['titulo'] = 'Dashboard - Administrativo';
$_header['icon']   = 'television';

get_header_gestor();
get_barra_header();


echo '<div class="row">';


# colors available => [ green, red, blue, yellow, purple ]
# icons => https://fontawesome.com/v4/ions/


get_card_dashboard($contBanners, 'Banners', 'picture-o', 'green');
// get_card_dashboard($contBlog, 'Blog', 'rss', 'blue');
get_card_dashboard($contUser, 'Usuários', 'user-o', 'purple');


echo '</div>';


get_footer_gestor();