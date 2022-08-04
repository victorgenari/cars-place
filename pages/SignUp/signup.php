<?php

include "../../services/database.php";

// Se existir sessão, joga pra tela inicial (index.php)
if ($_SESSION) {
  header("Location: ../../index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"
    >
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="theme-color" content="#7952b3">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="../../globalStyles/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form>
        <img class="mb-4" src="http://cdn.onlinewebfonts.com/svg/img_211019.png" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Criar Conta</h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="name" placeholder="name@example.com">
          <label for="name">Nome</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="email" placeholder="name@example.com">
          <label for="email">E-mail</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <label for="password">Senha</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Lembrar-me
          </label>
          <p>Já possui uma conta? <a href="../Login/login.php">Login</a></p>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="button" onclick=signup()>Criar Conta</button>
      </form>
    </main>

    <script>
      function signup() {
        let name = $("#name").val()
        let email = $("#email").val()
        let password = $("#password").val()

        if (!name) {
          Swal.fire( 'Erro!', 'Nome não informado', 'error' )
          return
        }

        if (!email) {
          Swal.fire( 'Erro!', 'Email não informado', 'error' )
          return
        }

        if (!password) {
          Swal.fire( 'Erro!', 'Senha não informada', 'error' )
          return
        }

        $.ajax({
          url: "../../services/database.php",
          type: "POST",
          dataType: "JSON",
          data: {
            name, email, password, deonde: 'SIGNUP'
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
              setTimeout(() => {
                window.location.href = "../Login/login.php"
              }, 2000)
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