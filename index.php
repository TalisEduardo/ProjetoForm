
<?php

  session_start();

  if(!isset($_SESSION['usuario']))
  {
    header("Location:login.html");
  }

 ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Projeto Form</title>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<!--  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>-->
  <script type="text/javascript">
    $(document).ready(function() {

      $('#tabs-1').css('display','none');

      $('#queryPessoa').on('click', function() {

        if ($('#tabs-1').css('display') == 'none') {
          $('#tabs-1').css('display','block');
          $('#tabs-2').css('display','none');
          $('#tabs-3').css('display','none');
        }
        else {
          $('#tabs-1').css('display','none');
        }

      });

      $('#tabs-2').css('display','none');

      $('#queryEndereco').on('click', function() {

        if ($('#tabs-2').css('display') == 'none')
        {
          $('#tabs-2').css('display','block');
          $('#tabs-1').css('display','none');
          $('#tabs-3').css('display','none');
        }
        else {
          $('#tabs-2').css('display','none');
        }

      });

      $('#tabs-3').css('display','none');

      $('#queryContas').on('click', function() {

        if ($('#tabs-3').css('display') == 'none')
        {
          $('#tabs-3').css('display','block');
          $('#tabs-1').css('display','none');
          $('#tabs-2').css('display','none');
        }
        else {
          $('#tabs-3').css('display','none');
        }

      });

    });

    $( function() {
      $( "#tabs" ).tabs();
    } );

  </script>

</head>

<body>

  <div class="cabecalho">
      <h1>Projeto Form</h1>
      <aside class="">
        usuario logado: <?php echo $_SESSION['usuario'] ?>
        <a href="logoff.php">fazer logoff</a>
      </aside>
  </div>

  <div id="tabs">
      <div class="menu_topo">
        <ul>
          <li><a id="queryPessoa" href="#tabs-1">Pessoa</a></li>
          <li><a id="queryEndereco" href="#tabs-2">Endereço</a></li>
          <li><a id="queryContas" href="#tabs-3">Contas</a></li>
        </ul>
      </div>

      <div id="tabs-2">
        <?php include("endereco.php"); ?>
      </div>

      <div id="tabs-3">
        <?php include('conta.php'); ?>
      </div>

      <div id="tabs-1">
        <?php include("pessoa.php"); ?>
      </div>
  </div>


</body>

</html>
