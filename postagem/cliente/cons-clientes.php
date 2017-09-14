<?php

include_once('../includes/php/seguranca_adm.php');

$cTodos 	= "SELECT cliente.nm_cliente, franquiado.nm_franq, validade.ativacao, validade.validade, plano.valor, pagamento.situacao, validade.dt_criacao 
			   FROM cliente, franquiado, validade, plano, pagamento 
			   WHERE franquiado.id_franq = cliente.id_franq AND validade.id_validade = cliente.id_validade AND plano.id_plano = cliente.id_plano AND pagamento.id_pagamento = cliente.id_pagamento";

$cAtivos 	= "SELECT cliente.nm_cliente, franquiado.nm_franq, validade.ativacao, validade.validade, plano.valor, pagamento.situacao, validade.dt_criacao 
			   FROM cliente, franquiado, validade, plano, pagamento 
			   WHERE franquiado.id_franq = cliente.id_franq AND validade.id_validade = cliente.id_validade AND plano.id_plano = cliente.id_plano AND pagamento.id_pagamento = cliente.id_pagamento AND pagamento.id_pagamento = 4";

$cInativos 	= "SELECT cliente.id_cliente, cliente.nm_cliente, franquiado.nm_franq, validade.id_validade, validade.ativacao, validade.validade, plano.valor, pagamento.situacao, validade.dt_criacao 
			   FROM cliente, franquiado, validade, plano, pagamento 
			   WHERE franquiado.id_franq = cliente.id_franq AND validade.id_validade = cliente.id_validade AND plano.id_plano = cliente.id_plano AND pagamento.id_pagamento = cliente.id_pagamento AND pagamento.id_pagamento = 5";
			   
$qTodos		= mysql_query($cTodos);
$qAtivos	= mysql_query($cAtivos);
$qInativos	= mysql_query($cInativos);
			   
?>