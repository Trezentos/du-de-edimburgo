<?php
session_start();

require_once __DIR__ . "/../php/config.php";
require_once __DIR__ . "/../php/classes/Class.login.php";
require_once __DIR__ . "/php/functions.php";


$userClass = new Usuario();

$arMenu = [
    'Início' => [
        'show' => true,
        'icon' => 'home',
        'access' => 'FULL',
        'file' => 'index.php',
        'submenu' => NULL
    ],
    'Banners' => [
        'show' => true,
        'icon' => 'picture-o',
        'access' => 6,
        'file' => 'list/banners.php',
        'submenu' => NULL
    ],

    'Galeria de Imagens' => [
        'show' => true,
        'icon' => 'picture-o',
        'access' => 5,
        'file' => 'list/galeria.php',
        'submenu' => NULL
    ],
    'Usuários' => [
        'show' => true,
        'icon' => 'user-o',
        'access' => 3,
        'file' => 'list/usuarios.php',
        'submenu' => NULL
    ],

    'Páginas' => [
        'show' => true,
        'icon' => 'file-o',
        'access' => 1,
        'file' => 'list/paginas.php',
        'submenu' => NULL
    ],
    'Configurações' => [
        'show' => true,
        'icon' => 'cog',
        'access' => 2,
        'file' => 'form/configuracoes.php',
        'submenu' => NULL
    ],


];


/*
|--------------------------------------------------------------------------
| SET LIST ACCESS FILE
|--------------------------------------------------------------------------
|
| List of allowed files per module.
|
*/

$LIST_ACCESS_FILE = [
    'FULL' => [
        'index.php',
        'ajax/ajax-clear-string.php',
        'ajax/ajax-cities.php',
        'ajax/ajax-image-functions.php',
        'ajax/ajax-image-upload.php',
        'ajax/ajax-save-order.php',
        'ajax/ajax-delete-check.php',
        'sair.php'],

    1 => [
        'list/paginas.php',
        'form/paginas.php'
    ],

    2 => ['form/configuracoes.php'],

    3 => [
        'list/usuarios.php',
        'form/usuarios.php'
    ],

    5 => [
        'list/galeria.php',
        'form/galeria.php',
    ],

    6 => [
        'list/banners.php',
        'form/banners.php'
    ],

];


$javascript = ['bootstrap.js', 'jquery.tablesorter-pager.js', 'sweetalert2.min.js', 'script.admin.js'];
$style = ['css/bootstrap.min.css', 'css/style.css', 'css/sweetalert2.min.css', 'css/dark.css', 'css/font-awesome.min.css'];


if ($userClass->usuarioLogado(true) === false) {
    header("Location: " . HTTP_GESTOR . "login.php");
    exit;
} else {
    $RequestedPermission = $userClass->acessoPagina();

    if ($RequestedPermission !== true) {
        header("Location: " . HTTP_GESTOR . "?error=" . base64_encode($RequestedPermission));
        exit;
    }
}

$autor = $userClass->getId();
$username = $userClass->getUser();
$acessoAutor = $userClass->getAcesso();
$categoriaUser = $userClass->getCategoria();


define('SELF_PAG', pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_BASENAME));
define('PREFIX_NAME_IMG', 'bull-investimentos');

// SEPARADOR TITLE
$separador = '<i class="sep fa fa-angle-right"></i>';

// ITEMS PER PAGE DEFAULT
$__ITEMS_PER_PAGE__ = 50;