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

      $("#cep").inputmask("99.999-999");
      $("#cep").val("");

      $("#cep").on("blur", function() {

        var cep = $("#cep").val();

        cep = cep.replace('-', '');
        cep = cep.replace('.', '');

        if (cep == "") {
          $('#cep').after('<span id="msg-cep" class="alert">Digita o CEP.</span>');
        } else {

          $('#msg-cep').remove();

          $.ajax({
            url: 'http://viacep.com.br/ws/' + cep + '/json/',
            type: 'get',
            dataType: 'json',
            crossDomain: true,
            data: {
              cep: cep,
              formato: 'json',
              chave: ''
            },
            success: function(data) {
              $('#logradouro').val(data.logradouro);
              $('#bairro').val(data.bairro);
              $('#cidade').val(data.localidade);
              $('#uf').val(data.uf);
            }

          });

        }

      }).on("blur");

      $('#formEndereco').css('display','none');

      $('#addEndereco').on('click', function() {
        $('#consultaEndereco').css('display','none');
        $('#formEndereco').css('display','block');
      });

      $('#retorna').on('click', function() {
        $('#consultaEndereco').css('display','block');
        $('#formEndereco').css('display','none');
      });

    });
  </script>
</head>

<body>

    <?php $conexao = pg_connect("host=localhost port=5432 dbname=projetoForm user=postgres password=p"); ?>

    <div class="container conteudo">
      <div class="conteudo">

        <?php
          $query = "select sequencia, logradouro, numero, bairro, cidade, uf, pessoa_codigo from endereco";

          $end = pg_query($conexao, $query);

        ?>

        <div id='consultaEndereco'>

          <table>
            <thead>
              <tr>
                <th>Seq</th>
                <th>Logradouro</th>
                <th>Número</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Codigo Pessoa</th>
              </tr>
            </thead>
            <tbody>
              <?php while($obj = pg_fetch_object($end)) { ?>
                <tr>
                  <td><?php echo $obj->sequencia ?></td>
                  <td><?php echo $obj->logradouro ?></td>
                  <td><?php echo $obj->numero ?></td>
                  <td><?php echo $obj->bairro ?></td>
                  <td><?php echo $obj->cidade ?></td>
                  <td><?php echo $obj->uf ?></td>
                  <td><?php echo $obj->pessoa_codigo ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

          <div class="toolbar">
            <button type="button" id="addEndereco">
              Adicionar
            </button>

            <button type="button" id="delEndereco">
              Remover
            </button>
          </div>
        </div>

        <div id="formEndereco" style="background-color:#336ac4; height:400px; margin-top:5px;"><br>
          <form action="cadastraEndereco.php" style="margin-left:50px;" method="post">
            <h2>Cadastro Endereço</h2><br>
            CEP: <input type="numeric" id="cep" value="" placeholder="Digite o CEP"><br><br>
            Logradouro: <input type="text" style="width:150px;" id="logradouro" name="logradouro" value=""><br><br>
            Número: <input type="numeric" name="numero" value="" placeholder="Digite o Número"><br><br>
            Bairro: <input type="text" style="width:100px;" id="bairro" name="bairro" value=""><br><br>
            Cidade: <input type="text" style="width:100px;" id="cidade" name="cidade" value=""><br><br>
            UF: <input type="text" style="width:20px;" id="uf" name="uf" value=""><br><br>

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
            <button type="button" id="retorna">Voltar</button>
          </form>
        </div>

      </div>
    </div>

  </body>

</html>
