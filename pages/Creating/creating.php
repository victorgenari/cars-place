<?php
  include "../../services/database.php";

  // Se não existir sessão, joga pra tela de login
  if (!$_SESSION["logged_user"]) {
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
    <link rel="stylesheet" href="./creating.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Alerts -->
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
                <a href="../../index.php" class="btn btn-link">Todos cadastros</a>
            </div>

            <form class="form-control">
                <label for="modelo">Modelo:</label>
                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo">

                <label for="marca">Marca:</label>
                <input type="text" class="form-control" name="marca" id="marca" placeholder="Marca">

                <label for="placa">Placa:</label>
                <input type="text" class="form-control" name="placa" id="placa" placeholder="Placa">

                <label for="cor">Cor:</label>
                <input type="text" class="form-control" name="cor" id="cor" placeholder="Cor">

                <label for="ano">Ano:</label>
                <input type="text" class="form-control" name="ano" id="ano" placeholder="Ano">

                <label for="combustivel">Combustível:</label>
                <input type="text" class="form-control" name="combustivel" id="combustivel" placeholder="Combustível">

                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao" placeholder="Descrição"></textarea>

                <button type="button" class="btn btn-primary" onclick=inserir()>Cadastrar</button>
            </form>

        </div>
    </div>


    <script>
        function inserir() {
        
            let modelo = $("#modelo").val()
            let marca = $("#marca").val()
            let placa = $("#placa").val()
            let cor = $("#cor").val()
            let ano = $("#ano").val()
            let combustivel = $("#combustivel").val()
            let descricao = $("#descricao").val()

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
                modelo,
                marca,
                placa,
                cor,
                ano,
                combustivel,
                descricao,
                deonde: 'INSERIR_CARRO'
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
                $("#maca").val("")
                $("#placa").val("")
                $("#cor").val("")
                $("#ano").val("")
                $("#combustivel").val("")
                $("#descricao").val("")

                setTimeout(() => {
                    window.location.href = "http://localhost/projetos-php/cars-place/"
                }, 1000);
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