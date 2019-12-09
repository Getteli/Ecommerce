<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');
	// conexao com o bd
	include_once('conection.php');
	// variaveis
	// include_once('var.php');
	// email
	// include_once('email.php');
	// encriptar / desencriptar
	include_once('encriptar.php');

	// inicia a sessao para pegar o id do usuario
	session_start();

	// impede erros de NOTICE a aparecer na page, pois caso as variaveis estejam vazias dera erro(notice)
	error_reporting(0);

	// nome da pagina
	$page_name = basename($_SERVER['PHP_SELF']);
	// obs: esta encriptada
	$id_usu = base64_decode( $_SESSION['id_usu'] );
	$id_usu = Desencriptar( $id_usu );

	$id_sl = base64_decode( $_SESSION['id_sl'] );
	$id_sl = Desencriptar( $id_sl );
	// var
	$no_active = '';
	$no_active_class = '';
	$adm_master_cont = '';

	// admin master, se existir e for true
	if (isset($_SESSION['admin_master']) && $_SESSION['admin_master'] == true ) {
		$adm_master_cont = true;
	}else{
		$adm_master_cont = false;
	}
	

	$dia_d = date('d');
	$mes_d = strtoupper ( strftime( '%B', strtotime('today') ) );
	$ano_d = date('Y');

	// verificar a conexao, se tudo estiver certo, vai executar a linha, se nao vai informar qual o erro
	try{
		if ($conn) {
			// query a ser pesquisada
			$query = mysqli_query($conn, " SELECT 
				nome_usu,email_usu,foto_usu,cpf_usu,rg_usu,oe_rg_usu,ufrg_usu,tde_usu,cnpj_mei_usu,pass_nc_usu,nasc_usu,irpf_usu,docs_usu,not_usu,contact_usu,cep_usu,end_usu,bairro_usu,cid_usu,uf_usu,active_usu 
				FROM usuario WHERE id_usu = '$id_usu' ");
			// pega a linha
			$linha = mysqli_fetch_assoc($query);

			// pega o alvara do usuario e outras coisas necessarias
			$query_juri = mysqli_query($conn, " SELECT 
				nome_fant_sl,email_sl,cnpj_sl,cont_sl,alvara_sl
				FROM juridico_salon WHERE id_usu_fk = '$id_usu' AND verify = 0 ");
			$linha_juri = mysqli_fetch_assoc($query_juri);

			// query do salon
			if (!empty($id_sl)) {
				$query_salon = mysqli_query($conn, " SELECT 
					nome_fant_sl,email_sl,cnpj_sl,cont_sl,alvara_sl
					FROM juridico_salon WHERE id_sl = '$id_sl' AND verify = 1 ");
				// pega a linha
				$linha_salon = mysqli_fetch_assoc($query_salon);
			}
			// var
			$nome_db = $linha['nome_usu'];
			$email_db = $linha['email_usu'];
			$foto_db = $linha['foto_usu'];
			if ( empty( $foto_db ) || !file_exists($foto_db) ) {
				$foto_db = "_assets/_img/default.png";
			}
			$cpf_db = $linha['cpf_usu'];
			$rg_db = $linha['rg_usu'];
			$oe_rg_db = $linha['oe_rg_usu'];
			$ufrg_db = $linha['ufrg_usu'];
			$tde_db = $linha['tde_usu'];
			$cnpj_mei_db = $linha['cnpj_mei_usu'];
			$pass_nc_db = $linha['pass_nc_usu'];
			$nasc_db = $linha['nasc_usu'];
				$parts = explode('-', $nasc_db);
				$nasc_db  = "$parts[2]/$parts[1]/$parts[0]";
			$irpf_db = $linha['irpf_usu'];
			$docs_db = $linha['docs_usu'];
			$not_db = $linha['not_usu'];
			$contact_db = $linha['contact_usu'];
			$cep_db = $linha['cep_usu'];
			$end_db = $linha['end_usu'];
			$bairro_db = $linha['bairro_usu'];
			$cid_db = $linha['cid_usu'];
			$uf_db = $linha['uf_usu'];
			$active_db = $linha['active_usu'];
			// informacoes juridicas do usuario
			$nome_fant_db = $linha_juri['nome_fant_sl'];
			$alvara_db = $linha_juri['alvara_sl'];

			$data = strtoupper ( strftime( '%B / %Y', strtotime('today') ) );
			// salon em focus
			if (!empty($id_sl)) {
				$nome_fant_sl_db = $linha_salon['nome_fant_sl'];
				$email_sl_db = $linha_salon['email_sl'];
				$cnpj_sl_db = $linha_salon['cnpj_sl'];
				$cont_sl_db = $linha_salon['cont_sl'];
			}

			if ( !isset( $_GET['info'] ) ) {
				// se nao estiver apto a ser ativo / nao possuir alvara / nao possuir salao, entao ficara desabilitado
				if ($active_db == 3 || $active_db == 4 || $no_active == 5) {
					echo '
					<script>setTimeout(function(){ alert_personalizado("ATENÇÃO","Conta não ativada, verifique sua caixa de entrada ou spam e ative sua conta. Vá até configurações para reenviar o email se necessário.","OK") }, 1900);</script>
					';
					$no_active = 'disabled="disabled"';
					$no_active_class = 'disabled';
				}
			}

			if ($active_db == 1 || $active_db == 2) { // se já estiver ativado
				if ($page_name == 'inicio' || $page_name == 'inicio.php') { // se estiver na pagina inicial, exec
					if ( empty($id_sl) ) { // se o id do salao estiver vazio, exec
						echo '
						<script>setTimeout(function(){ alert_personalizado("ATENÇÃO","É necessário <b>CRIAR</b> ou <b>SELECIONAR</b> um salão para usufruir de nossa aplicação.","OK") }, 2000);</script>
						';
						$no_active = 'disabled="disabled"';
						$no_active_class = 'disabled';
					}
				}
			}
			// if (empty($alvara_db)) {
			// 	echo '
			// 	<script>setTimeout(function(){ alert_personalizado("ATENÇÃO","É necessário possuir um alvará para usufruir de nossa aplicação.","OK") }, 1600);</script>
			// 	';
			// 	$no_active = 'disabled="disabled"';
			// 	$no_active_class = 'disabled';
			// }

			// total
			$query_total_cx = mysqli_query($conn, " SELECT SUM( entrada_cx ) AS entrada, SUM( saida_cx ) AS saida FROM caixa WHERE id_sl_fk = '$id_sl' ");
			$linha_total_cx = mysqli_fetch_assoc($query_total_cx);
			// total de despesa
			$saida_total = $linha_total_cx['saida'];
			if ($saida_total == null) {
				$saida_total = 0.00;
			}else{
				$saida_total = "-" . $saida_total;
			}
			$saida_total =  number_format($saida_total, 2, ',', '.');
			// total de receita
			$entrada_total = $linha_total_cx['entrada'];
			if ($entrada_total == null) {
				$entrada_total = 0.00;
			}
			$entrada_total =  number_format($entrada_total, 2, ',', '.');
		}else{
			throw new Exception('Erro na tentativa de se conectar com o banco de dados.');
		}
	}catch(Exception $Error0) {
		// pega o erro
		$erro0 = $Error0->getMessage();
		// informa
		// $enviar_erro = send_email_erro($email_sender, $email_smtp, $pass_smtp, "Erro de script", $erro0, "tentativa de conexao com DB", "details");
		// if ( $enviar_erro ) {
		// 	header('location:../../sign_cad?erro=banco');
		// }else{
		// 	header('location:../../sign_cad?erro=banco');
		// }
	}

	// functions
	// converte data
	function convert_date($date){
		$newDate = date("d/m/Y", strtotime($date));
		return $newDate;
	}

	// extrair numero do endereco
	function get_number($var){
		preg_match_all('/([\d]+)/', $var, $match);
		$var = implode ('|', $match[0]);
		return strstr($var, '|', true);
	}

	function remove_carac_esp($str){
		$str = preg_replace('/[áàãâä]/ui', 'a', $str);
		$str = preg_replace('/[éèêë]/ui', 'e', $str);
		$str = preg_replace('/[íìîï]/ui', 'i', $str);
		$str = preg_replace('/[óòõôö]/ui', 'o', $str);
		$str = preg_replace('/[úùûü]/ui', 'u', $str);
		$str = preg_replace('/[ç]/ui', 'c', $str);
		// $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
		$str = preg_replace('/[^a-z0-9]/i', '_', $str);
		$str = preg_replace('/_+/', '', $str); // ideia do Bacco :)
		return $str;
	}