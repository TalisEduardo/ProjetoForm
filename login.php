<?php

$conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p");

$login = $_POST['login'];
$senha = $_POST['senha'];

$query = "select * from usuario where login = '".$login."' and senha = '".$senha."'";

$res = pg_query($conexao, $query);

while($user = pg_fetch_object($res))
{
  session_start();
  $_SESSION['usuario'] = $user->login;

  header("Location:index.php");
}

?>
