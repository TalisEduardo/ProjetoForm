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

      $("#data").inputmask("dd/mm/yyyy");
      $("#data").datepicker();
      $("#data").val("");

      $('#formConta').css('display','none');

      $('#addConta').on('click', function() {
        $('#consultaContas').css('display','none');
        $('#formConta').css('display','block');
      });

      $('#retornaConta').on('click', function() {
        $('#consultaContas').css('display','block');
        $('#formConta').css('display','none');
      });

    });
  </script>
</head>

<body>

    <?php $conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p"); ?>

    <div class="container conteudo">
      <div class="conteudo">

        <?php
          $query = "select sequencia, tipo, vencimento, valor, status, pessoa_codigo from conta";

          $cont = pg_query($conexao, $query);

        ?>

        <div id='consultaContas'>

          <table>
            <thead>
              <tr>
                <th>Seq</th>
                <th>Tipo</th>
                <th>Data Vencimento</th>
                <th>Valor</th>
                <th>Status</th>
                <th>Codigo Pessoa</th>
              </tr>
            </thead>
            <tbody>
              <?php while($obj = pg_fetch_object($cont)) { ?>
                <tr>
                  <td><?php echo $obj->sequencia ?></td>
                  <td><?php echo $obj->tipo ?></td>
                  <td><?php echo $obj->vencimento ?></td>
                  <td><?php echo $obj->valor ?></td>
                  <td><?php echo $obj->status ?></td>
                  <td><?php echo $obj->pessoa_codigo ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="toolbar">
            <button type="button" id="addConta">
              Adicionar
            </button>

            <button type="button" id="delConta">
              Remover
            </button>
          </div>
        </div>

        <div id="formConta" style="background-color:#336ac4; height:400px; margin-top:5px;"><br>
          <form action="cadastraConta.php" style="margin-left:50px;" method="post">
            <h2>Cadastro Conta</h2><br>
            Tipo: <select name="tipo" style="width:150px;">
                <option value="R">Conta a Receber</option>
                <option value="P">Conta a Pagar</option>
                  </select><br><br>

            Data de Vencimento: <input type="text" id="data" name="vencimento" value="" placeholder="Digite a Data"><br><br>
            Valor: <input type="decimal" style="width:60px;" id="valor" name="valor" value=""><br><br>

            Status: <select name="status" style="width:150px;">
                <option value="A">Em Aberto</option>
                <option value="B">Baixado</option>
                  </select><br><br>

            <?php
              $query = "select codigo, nome, sexo, nascimento from pessoa";

              $resultado = pg_query($conexao, $query);
            ?>

            Pessoa: <select name="pessoa_codigo" id="pessoa_codigo" style="width:90px;">
              <?php while($obj = pg_fetch_object($resultado)) { ?>
                <option value="<?php echo $obj->codigo ?>"><?php echo $obj->nome ?></option>
              <?php } ?>
                    </select><br><br>

            <button type="submit" id="enviar">Enviar</button>
            <button type="button" id="retornaConta">Voltar</button>
          </form>
        </div>

      </div>
    </div>

  </body>

</html>
