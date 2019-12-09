<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');

	// pagina dedicada a conter VARIAVEIS
	$version_app = "1.0.3"; // versao do app
	// $email_sender = "nomedoapp@outlook.com"; // email responsavel
	$email_sender = "contato@beautymei.com.br";

	$subject_email_cadastro = "BeautyMEI - Cadastro com sucesso !"; // var com o assunto padrao de cadastro
	$title_email_cadastro = "Bem vindo ao BeautyMEI"; // var com o titulo padrao de cadastro

	$subject_email_del = "BeautyMEI - Conta excluida com sucesso !"; // var com o assunto padrao de conta excluida
	$title_email_del = "BeautyMEI diz Adeus"; // var com o titulo padrao de conta excluida

	$subject_email_remember = "BeautyMEI - Recuperar de conta"; // var com o assunto padrao de esqueceu senha
	$title_email_remember = "Lembre-se de sua conta"; // var com o titulo padrao de esqueceu senha

	$subject_email_config = "BeautyMEI - Alterar de senha"; // var com o assunto padrao de esqueceu senha
	$title_email_config = "Senha alterada com sucesso"; // var com o titulo padrao de esqueceu senha

	$subject_email_not = "BeautyMEI informa"; // var com o assunto padrao de notificacao DAS
	$title_email_not = "BeautyMEI informa"; // var com o titulo padrao de notificacao DAS

	$pass_admin_mast_cont = "BeautyMei01,"; // senha master da contadora

	$valor_das = 52.70; // valor do DAS

	// variaveis para a conta gmail generica para usar o smtp
	$email_smtp = 'contatobeautymei@gmail.com';
	$pass_smtp = 'contatobeautymeigeneric01';