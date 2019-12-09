<?php
	// charset
	header('Content-Type: text/html; charset=utf-8');
	// conexao
	include_once('conection.php');
	// details
	include_once('details.php');

	// parametro
	$month = filter_input(INPUT_POST , 'month');
	$year = filter_input(INPUT_POST , 'year');
	$last_id = filter_input(INPUT_POST , 'last_id');
	$last_id_get = $last_id;

	// sl
	$id_sl_get_enc = $_POST['idsl']; // id do salao selecionado

	if ( !empty( $id_sl_get_enc ) ) {
		$id_sl_get = Desencriptar( $id_sl_get_enc ); // id do salao descriptografado
	}

	// verifica se tem o ultimo id
	if ( !empty($last_id) ) {
		$last_id = "id_cx < " . $last_id;
	}else{
		$last_id = '';
	}

	// type
	$limit = 'LIMIT 15';


	$query_salon_usu_2 = mysqli_query($conn, " SELECT id_sl, nome_fant_sl FROM juridico_salon WHERE id_sl = $id_sl ");
	$linha_sl_usu_2 = mysqli_fetch_assoc($query_salon_usu_2);
	// var
	$id_sl_enc = Encriptar( $linha_sl_usu_2['id_sl'] );
	$id_sl = $linha_sl_usu_2['id_sl'];
	$nome_sl = $linha_sl_usu_2['nome_fant_sl'];

	// verifica qual o tipo de pesquisa a ser feita
	switch ( TRUE ) {
		case $month && $year:
			if ( !empty($last_id) ) {
				$last_id = $last_id . " AND"; // concatena um AND
			}

			// total por 1 caixa
			$query_total = mysqli_query($conn, " SELECT SUM( entrada_cx ) - SUM( saida_cx ) AS total_sumesub
				FROM caixa
				WHERE
				id_sl_fk = '$id_sl' AND ( YEAR( dt_cx ) = '$year' AND MONTH( dt_cx ) = '$month' ) ");

			// query para pegar os valores do caixa, pelo salao selecionado
			$query_lc = mysqli_query($conn, " SELECT id_cx, entrada_cx, saida_cx, desc_cx, desc_detl, dt_cx
				FROM caixa
				WHERE $last_id id_sl_fk = '$id_sl'
				AND YEAR( dt_cx ) = $year AND MONTH( dt_cx ) = $month
				ORDER BY time_cx DESC $limit ");
			// echo "caiu no mes e ano";
			break;
		case $month:
			if ( !empty($last_id) ) {
				$last_id = $last_id . " AND"; // concatena um AND
			}

			// total por 1 caixa
			$query_total = mysqli_query($conn, " SELECT SUM( entrada_cx ) - SUM( saida_cx ) AS total_sumesub
				FROM caixa
				WHERE
				id_sl_fk = '$id_sl' AND ( MONTH( dt_cx ) = '$month' ) ");

			// query para pegar os valores do caixa, pelo salao selecionado
			$query_lc = mysqli_query($conn, " SELECT id_cx, entrada_cx, saida_cx, desc_cx, desc_detl, dt_cx
				FROM caixa
				WHERE $last_id id_sl_fk = '$id_sl'
				AND MONTH( dt_cx ) = $month
				ORDER BY time_cx DESC $limit ");
			break;
		case $year:
			if ( !empty($last_id) ) {
				$last_id = $last_id . " AND"; // concatena um AND
			}

			// total por 1 caixa
			$query_total = mysqli_query($conn, " SELECT SUM( entrada_cx ) - SUM( saida_cx ) AS total_sumesub
				FROM caixa
				WHERE
				id_sl_fk = '$id_sl' AND ( YEAR( dt_cx ) = '$year' ) ");

			// query para pegar os valores do caixa, pelo salao selecionado
			$query_lc = mysqli_query($conn, " SELECT id_cx, entrada_cx, saida_cx, desc_cx, desc_detl, dt_cx
				FROM caixa
				WHERE $last_id id_sl_fk = '$id_sl'
				AND YEAR( dt_cx ) = $year
				ORDER BY time_cx DESC $limit ");
			// echo "caiu no ano";
			break;
		default:
			if ( !empty($last_id) ) {
				$last_id = $last_id . " AND";
			}

			// total por 1 caixa
			$query_total = mysqli_query($conn, " SELECT SUM( entrada_cx ) - SUM( saida_cx ) AS total_sumesub
				FROM caixa
				WHERE
				id_sl_fk = '$id_sl' ");

			// query para pegar os valores do caixa, pelo salao selecionado
			$query_lc = mysqli_query($conn, " SELECT id_cx, entrada_cx, saida_cx, desc_cx, desc_detl, dt_cx
				FROM caixa
				WHERE $last_id id_sl_fk = '$id_sl'
				ORDER BY time_cx DESC $limit ");
			// query default
			break;
	}

	$linha_total = mysqli_fetch_assoc($query_total);
	// total de todos os caixas
	$total_soma = $linha_total['total_sumesub'];
	$total =  number_format($total_soma, 2, ',', '.');
	if ($total < 0.00) {
		$total = "-" + $total;
	}