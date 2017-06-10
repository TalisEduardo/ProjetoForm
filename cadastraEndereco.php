<?php

   $conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p");

   $query = "select max(sequencia) from endereco where pessoa_codigo = ".$_POST['pessoa_codigo'];

   $maxSeq = pg_query($conexao, $query);

   $_POST['sequencia'] = $maxSeq+1;

   $res = pg_insert($conexao, "endereco", $_POST);
   if ($res) {
       echo "Dados POST arquivados com sucesso\n";
   }
   else {
       echo "O usuário deve ter inserido entradas inválidas\n";
   }
 ?>
