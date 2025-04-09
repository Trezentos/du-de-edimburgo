<?php
require '../config.php';

// TEMPLATE
foreach(glob(TEMPLATE.'*.php') as $file)
{
	// $info = pathinfo($file);
	// echo $info['basename'];
	$stat = stat($file);
	echo $stat['mtime'];
	echo $stat['size'];
}

// INCLUDES
foreach(glob(TEMPLATE.'includes/*.php') as $file)
{
	$stat = stat($file);
	echo $stat['mtime'];
	echo $stat['size'];
}

// SECTIONS
foreach(glob(TEMPLATE.'sections/*.php') as $file)
{
	$stat = stat($file);
	echo $stat['mtime'];
	echo $stat['size'];
}

// CSS
foreach(glob(ROOT_CSS.'*.css') as $file)
{
	$stat = stat($file);
	echo $stat['mtime'];
	echo $stat['size'];
}

// JS
foreach(glob(ROOT_JS.'*.js') as $file)
{
	$stat = stat($file);
	echo $stat['mtime'];
	echo $stat['size'];
}

// FUNCTIONS
$stat = stat(PHP.'functions.php');
echo $stat['mtime'];
echo $stat['size'];