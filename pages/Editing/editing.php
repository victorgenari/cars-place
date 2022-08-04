<?php
  include "../../services/database.php";

  // Se não existir sessão, joga pra tela de login
  if (!$_SESSION["logged_user"]) {
    header("Location: ../../index.php");
  }

  if ($_GET && $_GET["id"]) {
    $sql = "SELECT * FROM vehicles WHERE id = '".$_GET["id"]."' ";
    $data = mysqli_query($connection, $sql);
    $carro = mysqli_fetch_assoc($data);
  } else {
    header("Location: ../../index.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- CSS Page -->
    <link rel="stylesheet" href="../../globalStyles/global-style.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Title -->
    <title>cArsPlace</title>
</head>
<body>
  <div class="container">
    <div class="content">
      
      <div>
        <a href="../../index.php" class="btn btn-link">Início</a>
      </div>
    
      <form class="form-control">
        <label for="modelo" class="form-label">Modelo:</label>
        <input type="text" name="modelo" id="modelo" class="form-control" value="<?php print $carro["modelo"] ?>">

        <label for="marca" class="form-label">Marca:</label>
        <input type="text" name="marca" id="marca" class="form-control" value="<?php print $carro["marca"] ?>">

        <label for="placa" class="form-label">Placa:</label>
        <input type="text" name="placa" id="placa" class="form-control" value="<?php print $carro["placa"] ?>">

        <label for="cor" class="form-label">Cor:</label>
        <input type="text" name="cor" id="cor" class="form-control" value="<?php print $carro["cor"] ?>">

        <label for="ano" class="form-label">Ano:</label>
        <input type="text" name="ano" id="ano" class="form-control" value="<?php print $carro["ano"] ?>">

        <label for="combustivel" class="form-label">Combustível:</label>
        <input type="text" name="combustivel" id="combustivel" class="form-control" value="<?php print $carro["combustivel"] ?>">

        <label for="descricao" class="form-label">Descrição:</label>
        <input type="text" name="descricao" id="descricao" class="form-control" value="<?php print $carro["descricao"] ?>">

        <button type="button" class="btn btn-primary" onclick="editar_carro(<?php print $carro['id']; ?>)">Salvar</button>
      </form>

    </div>
  </div>

  <script>
    function editar_carro(id) {
      let modelo = $("#modelo").val();
      let marca = $("#marca").val();
      let placa = $("#placa").val();
      let cor = $("#cor").val();
      let ano = $("#ano").val();
      let combustivel = $("#combustivel").val();
      let descricao = $("#descricao").val();

      if (!modelo) {
        Swal.fire( 'Erro!', 'O campo modelo é obrigatório!', 'error' )
        return
      }

      if (!marca) {
        Swal.fire( 'Erro!', 'O campo marca é obrigatório!', 'error' )
        return
      }

      if (!placa) {
        Swal.fire( 'Erro!', 'O campo placa é obrigatório!', 'error' )
        return
      }

      if (!cor) {
        Swal.fire( 'Erro!', 'O campo cor é obrigatório!', 'error' )
        return
      }

      if (!ano) {
        Swal.fire( 'Erro!', 'O campo ano é obrigatório!', 'error' )
        return
      }

      if (!combustivel) {
        Swal.fire( 'Erro!', 'O campo combustível é obrigatório!', 'error' )
        return
      }

      if (!descricao) {
        Swal.fire( 'Erro!', 'O campo descrição é obrigatório!', 'error' )
        return
      }

      $.ajax({
        url: "../../services/database.php",
        type: "POST",
        dataType: "JSON",
        data: {
          id,
          modelo,
          marca,
          placa,
          cor,
          ano,
          combustivel,
          descricao,
          deonde: 'EDITAR_CARRO'
        },
        async: true,
        timeout: 20000,
        beforeSend: function() {
        },
        error: function(response){
          return
        },
        success: function(response){
          return
        },
        complete: function(response) {
          if (response["responseJSON"]["error"] === false) {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: response["responseJSON"]["msg"],
              showConfirmButton: false,
              timer: 2000
              })
            $("#modelo").val("")
            $("#marca").val("")
            $("#placa").val("")
            $("#cor").val("")
            $("#ano").val("")
            $("#combustivel").val("")
            $("#descricao").val("")
            return
          } else {
            Swal.fire({
              position: 'center',
              icon: 'error',
              title: response["responseJSON"]["msg"],
              showConfirmButton: false,
              timer: 2000
              })
            return
          }
        }
      })
    }
  </script>
</body>
</html>