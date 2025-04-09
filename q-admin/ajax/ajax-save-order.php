<?php

require_once __DIR__.'/../config.php';

$neworderarray = $_POST['data'];
$tabela = strtoupper($_POST['tabela']);

foreach($neworderarray as $order) {
	list($id, $posicao) = explode("=", $order);
	$update = $db->query("UPDATE ".$tables[$tabela]." SET ordem = '".str_pad($posicao, 3, "0", STR_PAD_LEFT)."' WHERE id={$id}");
}
echo json_encode(['status'=>'sucesso','mensagem'=>'Ordem atualizada com sucesso']);