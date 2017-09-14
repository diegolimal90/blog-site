<?php
//abre conexao com o banco de dados
include_once('conexao/seguranca_adm.php');

//comando sql
$cPlano		= "select id_tpfrq, tipo, vl_mens from NWDB_TP_FRQ";

//executa variavel
$qPlano		= mysql_query($cPlano) or die();