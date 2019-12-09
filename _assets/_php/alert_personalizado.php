<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	// recebe as variaveis do erro
	$erro = filter_input(INPUT_GET , 'erro');
	$info = filter_input(INPUT_GET , 'info');
	$title_a = '';
	$txt_a = '';
	$btn_a = '';
	// verifica se ha erro
	if ( !empty( $erro ) || !empty( $info ) ) {
		// verifica o motivo (a cada novo erro, apenas add o seu proprio case)
		if ( !empty( $erro ) ) {
			switch ( $erro ) {
				case 'desconectado':
					$title_a = 'login';
					$txt_a = 'Faça login para entrar.';
					$btn_a = 'ok';
					break;

				case 'dados_errados':
					$title_a = 'login';
					$txt_a = 'Email ou senha estão incorretos. Caso o erro persista entre em contato com o suporte por favor.';
					$btn_a = 'ok';
					break;

				case 'cadastro':
					$title_a = 'cadastro';
					$txt_a = 'Erro ao se cadastrar, verifique seus dados e tente novamente. Caso o erro persista entre em contato com o suporte por favor.';
					$btn_a = 'ok';
					break;

				case 'alter_dados':
					$title_a = 'alterar dados';
					$txt_a = 'Erro na alteração dos dados, tente novamente por favor.';
					$btn_a = 'continuar';
					break;

				case 'email_remember':
					$title_a = 'Lembrar conta';
					$txt_a = 'Erro, o email digitado não condiz com nenhum email em nosso banco de dados, redigite o email e tente novamente.';
					$btn_a = 'continuar';
					break;

				case 'select_salon':
					$title_a = 'Selecionar salão';
					$txt_a = 'Erro ao selecionar um salão, tente novamente.';
					$btn_a = 'ok';
					break;

				case 'create_sl_erro':
					$title_a = 'erro';
					$txt_a = 'Erro ao criar salão, tente novamente.';
					$btn_a = 'ok';
					break;

				case 'del_sl':
					$title_a = 'erro';
					$txt_a = 'Erro ao excluir salão, tente novamente';
					$btn_a = 'ok';
					break;

				case 'banco':
					$title_a = 'erro';
					$txt_a = 'Erro ao se conectar com o banco de dados, tente novamente.';
					$btn_a = 'ok';
					break;

				case 'logout_erro':
					$title_a = 'erro';
					$txt_a = 'Erro ao sair, por favor tente novamente.';
					$btn_a = 'ok';
					break;

				case 'pass_erro':
					$title_a = 'erro';
					$txt_a = 'Erro ao mudar a senha. verifique por favor e tente novamente.';
					$btn_a = 'ok';
					break;

				case 'pass_neg':
					$title_a = 'erro';
					$txt_a = 'Erro ao digitar a senha, não permitida. verifique por favor e tente novamente.';
					$btn_a = 'ok';
					break;

				case 'del_file':
					$title_a = 'erro';
					$txt_a = 'Erro ao excluir arquivo, tente novamente.';
					$btn_a = 'ok';
					break;

				case 'caixa':
					$title_a = 'erro';
					$txt_a = 'Erro ao adicionar ao caixar, por favor tente novamente.';
					$btn_a = 'ok';
					break;

				case 'gerar_rps':
					$title_a = 'erro';
					$txt_a = 'Erro ao adicionar a nota, por favor tente novamente.';
					$btn_a = 'ok';
					break;

				case 'gerar_das':
					$title_a = 'erro';
					$txt_a = 'Erro ao adicionar o DAS ao seu caixa, por favor tente novamente ou entre em contato com o suporte.';
					$btn_a = 'ok';
					break;

				case 'erro_del_usu':
					$title_a = 'erro';
					$txt_a = 'Erro ao Excluir a conta, por favor tente novamente.';
					$btn_a = 'ok';
					break;

				default:
					$title_a = 'erro';
					$txt_a = 'Desconhecido';
					$btn_a = 'continuar';
					break;
			}
		}
		// verifica o motivo (a cada novo info, apenas add o seu proprio case)
		if ( !empty( $info ) ) {
			switch ( $info ) {
				case 'new_count':
					$title_a = 'bem-vindo';
					$txt_a = 'Sua nova conta foi criada! confirme o seu email para poder utilizar toda a nossa aplicação.';
					$btn_a = 'continuar';
					break;

				case 'alter_dados':
					$title_a = 'Sucesso';
					$txt_a = 'Seus dados foram alterados!';
					$btn_a = 'continuar';
					break;

				case 'count_remember':
					$title_a = 'Sucesso';
					$txt_a = 'Enviamos um email com seus dados! por favor verique nos próximos 10 minutos em sua caixa de entrada (ou spam) e faça o seu login.';
					$btn_a = 'Ok';
					break;

				case 'salon_ok':
					$title_a = 'feito';
					$txt_a = 'Salão selecionado';
					$btn_a = 'ok';
					break;

				case 'salon_create':
					$title_a = 'feito';
					$txt_a = 'Salão criado com sucesso!';
					$btn_a = 'continuar';
					break;

				case 'salon_del':
					$title_a = 'feito';
					$txt_a = 'Salão excluido com sucesso!';
					$btn_a = 'continuar';
					break;

				case 'alter_config_pass':
					$title_a = 'feito';
					$txt_a = 'Senha alterada com sucesso. verifique em sua caixa de entrada (ou spam).';
					$btn_a = 'continuar';
					break;

				case 'alter_config':
					$title_a = 'feito';
					$txt_a = 'Configuração alterada com sucesso!';
					$btn_a = 'continuar';
					break;

				case 'file_del':
					$title_a = 'feito';
					$txt_a = 'Arquivo excluido com sucesso!';
					$btn_a = 'continuar';
					break;

				case 'add_caixa':
					$title_a = 'feito';
					$txt_a = 'efetuado com sucesso!';
					$btn_a = 'continuar';
					break;

				case 'info_accountant':
					$title_a = 'Olá';
					$txt_a = 'Você entrou nesta conta de usuário com uma senha de especial. Agora poderá enviar arquivos para esta conta de usuário. Caso não seja a(o) contador(a), por favor saia.';
					$btn_a = 'continuar';
					break;

				default:
					$title_a = 'informação';
					$txt_a = 'Desconhecido';
					$btn_a = 'continuar';
					break;
			}
		}
?>
<!-- alerta -->
<div id="bg_alert_person">
	<div id="alert_person">
		<span id="close_alert">&#10006;</span>
		<div id="body_alert">
			<h3><?php echo $title_a ?></h3>
			<p><?php echo $txt_a ?></p>
		</div>
		<button id="confirm_alert"><?php echo $btn_a ?></button>
	</div>
</div>
<!-- script -->
<script type="text/javascript">
	var alert_div = document.getElementById('alert_person');
	var bg_div = document.getElementById('bg_alert_person');
	var btn_alert = document.getElementById('confirm_alert');
	var x_alert = document.getElementById('close_alert');

	// ------------------------------------------------------------ BUTOES ENTRAR ----------------------------------------------------------------

	btn_alert.addEventListener('click', function btn_alert(){
		alert_div.parentNode.removeChild(alert_div);
		bg_div.parentNode.removeChild(bg_div);
		window.location = window.location.href.split("?")[0];
	})
	x_alert.addEventListener('click', function x_alert(){
		alert_div.parentNode.removeChild(alert_div);
		bg_div.parentNode.removeChild(bg_div);
		window.location = window.location.href.split("?")[0];
	})
	btn_alert.focus(); // ao aparecer, dar foco no btn
</script>
<?php
	} // fecha o if
?>