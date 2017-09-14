<?php
	include_once('conexao/seguranca_adm.php');

	//comando sql
	$cTodosFrq			= "select * from NWDB_FRQ";
	$cClientesAtivos	= "select * from NWDB_CLIENTE where id_pg = 1";
	$cClientesInativos	= "select * from NWDB_CLIENTE where id_block != 4";
	$cFilaAprovação		= "select * from NWDB_CLIENTE where id_pg = 2";
	$cSrvativo			= "select * from NWDB_SRV where situacao = 1";
	$cSrvFila			= "select * from NWDB_SRV where situacao = 2";

	//efetua as consultas
	$query1 = mysql_query($cTodosFrq);
	$query2 = mysql_query($cClientesAtivos);
	$query3 = mysql_query($cClientesInativos);
	$query4 = mysql_query($cFilaAprovação);
	$query5 = mysql_query($cSrvativo);
	$query6 = mysql_query($cSrvFila);

	//numero de linhas em consulta
	$num_linha1 = mysql_num_rows($query1);
	$num_linha2 = mysql_num_rows($query2);
	$num_linha3 = mysql_num_rows($query3);
	$num_linha4 = mysql_num_rows($query4);
	$num_linha5 = mysql_num_rows($query5);
	$num_linha6 = mysql_num_rows($query6);
