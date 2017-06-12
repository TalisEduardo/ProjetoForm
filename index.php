
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('#pessoa').css('display','none');

      $('#queryPessoa').on('click', function() {

        if ($('#pessoa').css('display') == 'none') {
          $('#pessoa').css('display','block');
          $('#endereco').css('display','none');
          $('#conta').css('display','none');
        }
        else {
          $('#pessoa').css('display','none');
        }

      });

      $('#endereco').css('display','none');

      $('#queryEndereco').on('click', function() {

        if ($('#endereco').css('display') == 'none')
        {
          $('#endereco').css('display','block');
          $('#pessoa').css('display','none');
          $('#conta').css('display','none');
        }
        else {
          $('#endereco').css('display','none');
        }

      });

      $('#conta').css('display','none');

      $('#queryContas').on('click', function() {

        if ($('#conta').css('display') == 'none')
        {
          $('#conta').css('display','block');
          $('#pessoa').css('display','none');
          $('#endereco').css('display','none');
        }
        else {
          $('#conta').css('display','none');
        }

      });

    });
  </script>

</head>

<body>

  <div class="cabecalho">
      <h1>Projeto Form</h1>
  </div>

  <div class="menu_topo">
    <ul>
      <li id="queryPessoa">Pessoa</li>
      <li id="queryEndereco">Endereço</li>
      <li id="queryContas">Contas</li>
    </ul>
  </div>

  <div id="endereco">
    <?php include("endereco.php"); ?>
  </div>

  <div id="conta">
    <?php include('conta.php'); ?>
  </div>

  <div id="pessoa">
    <?php include("pessoa.php"); ?>
  </div>


</body>

</html>
