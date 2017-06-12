<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Projeto Form</title>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="js/jquery-validation/js/jquery.validationEngine.js"></script>
  <script type="text/javascript" src="js/Inputmask-3.x/js/inputmask.js"></script>
  <script type="text/javascript" src="js/Inputmask-3.x/js/jquery.inputmask.js"></script>
  <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {

      $("#cpf").inputmask("999.999.999-99");
      $("#cpf").val();

      $("#nome").val("");

      $("#data").inputmask("dd/mm/yyyy");
      $("#data").datepicker();
      $("#data").val("");

      $('#formPessoa').css('display','none');

      $('#addPessoa').on('click', function() {
        $('#consultaPessoa').css('display','none');

        $('#formPessoa').css('display','block');
      });

      $('#retornaPessoa').on('click', function() {
        $('#formPessoa').css('display','none');
        $('#consultaPessoa').css('display','block');
      });

    });
  </script>
</head>

<body>

    <?php $conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p"); ?>

    <div class="container conteudo">
      <div class="conteudo">

        <?php
          $query = "select codigo, nome, sexo, nascimento from pessoa";

          $resultado = pg_query($conexao, $query);

        ?>

        <div id='consultaPessoa'>

          <table>
            <thead>
              <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Data Nascimento</th>
              </tr>
            </thead>
            <tbody>
              <?php while($obj = pg_fetch_object($resultado)) { ?>
                <tr>
                  <td><?php echo $obj->codigo ?></td>
                  <td><?php echo $obj->nome ?></td>
                  <td><?php echo $obj->sexo ?></td>
                  <td><?php echo $obj->nascimento ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="toolbar">
            <button type="button" id="addPessoa">
              Adicionar
            </button>

            <button type="button" id="delPessoa">
              Remover
            </button>
          </div>

        </div>

        <div id="formPessoa" style="background-color:#336ac4; height:400px; margin-top:5px;"><br>
          <form action="cadastraPessoa.php" style="margin-left:50px;" method="post">
            <h2>Cadastro Pessoa</h2><br>
            <input type="number" style="display:none;" name="sequencia" value="">
            CPF: <input type="text" id="cpf" name="codigo" value="" placeholder="Digite o CPF"><br><br>
            Nome: <input type="text" id="nome" name="nome" value="" placeholder="Digite o Nome" style="width:300px;"><br><br>
            Sexo: <select name="sexo" id="sexo" name="sexo" style="width:90px;">
                    <option selected="selected" value="M">Masculino</option>
                    <option value="F">Feminino</option>
                  </select><br><br>
            Data de Nascimento: <input type="text" id="data" name="nascimento" value="" placeholder="Digite a Data"><br><br>
            <button type="submit" id="enviar">Enviar</button>
            <button type="button" id="retornaPessoa">Voltar</button>
          </form>
        </div>
    </div>

  </body>

</html>
