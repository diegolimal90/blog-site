<?php
include_once('conexao/seguranca_adm.php');

$consulta = "SELECT `id_frq`,`nm_frq`,`doc`,`tel`,`email`, skype FROM `NWDB_FRQ`";

$query = mysql_query($consulta);