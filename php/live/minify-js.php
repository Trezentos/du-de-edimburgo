<?php
require '../config.php';

htmlLog();

$start_time = microtime(true);

$files = ['main'];

$CONT = 0;

foreach ($files as $key => $value)
{
	$newFile = file_get_contents(ROOT_JS.$value.'.js');

	$newFile = preg_replace('#^\s*//.+$#m','',$newFile);	// retira comentarios com //
	$newFile = preg_replace('/([\r\n\t])/','',$newFile); 	// retira quebra de linha e tabs
	$newFile = str_replace(" = ","=",$newFile);
	$newFile = preg_replace('/\s+/', ' ', $newFile);  		// retira varios espacos em branco

	$f = fopen(ROOT_JS.$value.'.min.js', 'w');
	fwrite($f, $newFile);
	fclose($f);

	$CONT++;
}

$end_time = microtime(true);
$execution_time = ($end_time - $start_time);

echo '<br>'.$CONT.' ARQUIVOS MINIFICADOS<br>';
echo '<br><br>TEMPO DE IMPORTACAO: '.$execution_time.' SEGUNDOS.';


// function stripPhpComments($code)
// {
//     $tokens = token_get_all($code);
//     $strippedCode = '';

//     while($token = array_shift($tokens)) {        
//         if((is_array($token) && token_name($token[0]) !== 'T_COMMENT') || !is_array($token)) 
//         {
//             $strippedCode .= is_array($token) ? $token[1] : $token;
//         }
//     }
//     return $strippedCode;        
// }

// $newFile = stripPhpComments($newFile);



// $newFile = file_get_contents(ROOT_JS.'main.js');

// $newFile = preg_replace('#^\s*//.+$#m','',$newFile);	// retira comentarios com //
// $newFile = preg_replace('/([\r\n\t])/','',$newFile); 	// retira quebra de linha e tabs
// $newFile = str_replace(" = ","=",$newFile);
// $newFile = preg_replace('/\s+/', ' ', $newFile);  		// retira varios espacos em branco

// $f = fopen(ROOT_JS."main.min.js", "w");
// fwrite($f, $newFile);
// fclose($f);