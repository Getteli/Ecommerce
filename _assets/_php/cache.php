<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	// conexao com o bd
	include_once('conection.php');
	// inicia a sessao
	session_start();
	// impede erros de NOTICE a aparecer na page, pois caso as variaveis estejam vazias dera erro(notice)
	error_reporting(0);

	// var
	// obs: estao encriptadas
	$id_usu = $_SESSION['id_usu'];
	$email_usu = $_SESSION['email_usu'];
	$pass_usu = $_SESSION['pass_usu'];

	// verifica se o usuario esta logado, se nao apaga o cache e volta ao inicio
	try{
		if(
			(!isset ($id_usu) == true) and
			(!isset ($email_usu) == true) and
			(!isset ($pass_usu) == true)
		){
			session_destroy(); // destroi a sessao
			// apaga os dados que estiverem em cache
			setcookie('id_usu',"", time()-3600);
			setcookie('email_usu',"", time()-3600);
			setcookie('pass_usu',"", time()-3600);
			unset($_COOKIE['id_usu']);
			unset($_COOKIE['email_usu']);
			unset($_COOKIE['pass_usu']);
			// erro, e vai para o catch
			throw new Exception('Session foi destruida/cache apagado ou var vazias');
		}else{
			// echo "tudo show (y'";
			// continua
		}
	}catch(Exception $Error) {
			// pega o erro
			$erro = $Error->getMessage();
			// envia o erro p/ o email
			// send_email_C($erro,"try catch cache");
			// redireciona
			header('location:sign_cad?erro=desconectado');
	}