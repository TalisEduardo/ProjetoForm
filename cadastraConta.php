<?php

   $conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p");

   $query = "select coalesce(max(conta.sequencia), 0) as sequencia from conta where conta.pessoa_codigo = ".$_POST['pessoa_codigo']." limit 1";

   $conta = pg_query($conexao, $query);

   while($maxSeq = pg_fetch_object($conta))
   {
     $_POST['sequencia'] = ($maxSeq->sequencia +1);
   }

   $res = pg_insert($conexao, "conta", $_POST);
   if ($res) {
       echo "Dados POST arquivados com sucesso\n";
   }
   else {
       echo "O usuário deve ter inserido entradas inválidas\n";
   }
 ?>
