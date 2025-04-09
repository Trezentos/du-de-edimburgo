<?php
include '../config.php';
require PHP . "classes/Class.validacao.php";


foreach($_POST as $key => $value)
{
	if( !is_array($value) ) $_POST[$key] = antiSQL($value);
}


$msg_ok    = "Mensagem enviada com sucesso!";
$msg_erro  = "Ops! Ocorreu um erro. Por favor tente novamente!";
$msg_todos = "Preencha todos os campos!";


if ( $_POST )
{
	if ( $_POST["nome"] != "" && 
		 $_POST["email"] != "" &&
		 $_POST["telefone"] != "" && 
		 $_POST["mensagem"] != "" )
	{
        $telefone = limpaEspaco(limpaString($_POST["telefone"]));

        if (strlen($telefone) < 8) {
            echo json_encode(['status'=>'0', 'message'=> 'Numero de telefone inválido']);
            return;
        }


        if (!validarEmail($_POST["email"])) {
            echo json_encode(['status'=>'0', 'message'=> 'Email inválido']);
            return;
        }

		$array_data = [
			'nome' 	 	=> $_POST['nome'],
			'email' 		=> $_POST['email'],
			'telefone' 	 	=> $_POST['telefone'],
			'mensagem' 		=> $_POST['mensagem'],
		];


		// E-MAIL PARA O ADMINISTRADOR

		$assunto  = EMPRESA." - Contato";
		$mensagem = '<h3>'.EMPRESA.' - Contato</h3>
					<br>
					<strong>Nome</strong>: '.$_POST["nome"].'<br><br>
					<strong>E-mail</strong>: '.$_POST["email"].'<br><br>
					<strong>Telefone</strong>: '.$_POST["telefone"].'<br><br>					
					<strong>Mensagem</strong>: '.$_POST["mensagem"].'<br><br>					
					';




		$enviado = SendMailAdm($assunto, $mensagem, $_POST["email"]);

		/* ==================================================================== */

		if ($enviado) {
			echo json_encode(['status'=>'1', 'message'=>$msg_ok]);
		} else {
			echo json_encode(['status'=>'0', 'message'=>$msg_erro]);
		}
	} else {
		echo json_encode(['status'=>'0', 'message'=>$msg_todos]);
	}
}