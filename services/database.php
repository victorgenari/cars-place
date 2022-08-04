<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "crud_ajax_php";

$connection = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) {
  echo "Falha ao conectar com o Banco de dados: " . mysqli_connect_error();
  exit();
}

// -------------------------------------------------------------------------------------------------------------------- //

// CREATE
if ($_POST && $_POST["deonde"] === "INSERIR_CARRO") {
  $sql = "INSERT INTO vehicles (modelo, marca, placa, cor, ano, combustivel, descricao) VALUES
  (
    '".$_POST['modelo']."',
    '".$_POST['marca']."',
    '".$_POST['placa']."',
    '".$_POST['cor']."',
    '".$_POST['ano']."',
    '".$_POST['combustivel']."',
    '".$_POST['descricao']."'
  )";

  if (mysqli_query($connection, $sql)) {
    $response["error"] = false;
    $response["msg"] = "Dados inseridos";
  } else {
    $response["error"] = true;
    $response["msg"] = "Erro ao inserir";
  }

  return print utf8_encode(json_encode($response));
}


// UPDATE
if ($_POST && $_POST["deonde"] === "EDITAR_CARRO") {
  $id          = $_POST["id"];
  $modelo      = $_POST["modelo"];
  $marca       = $_POST["marca"];
  $placa       = $_POST["placa"];
  $cor         = $_POST["cor"];
  $ano         = $_POST["ano"];
  $combustivel = $_POST["combustivel"];
  $descricao   = $_POST["descricao"];

  $sql = "UPDATE vehicles SET
    `modelo`      = '$modelo',
    `marca`       = '$marca',
    `placa`       = '$placa',
    `cor`         = '$cor',
    `ano`         = '$ano',
    `combustivel` = '$combustivel',
    `descricao`   = '$descricao'
    WHERE id = $id";

  if (mysqli_query($connection, $sql)) {
    $response["error"] = false;
    $response["msg"] = "Veículo editado";
  } else {
    $response["error"] = true;
    $response["msg"] = "Erro ao editar";
  }

  return print utf8_encode(json_encode($response));
}


// DELETE
if ($_POST && $_POST["deonde"] === "APAGAR_CARROS") {
  $sql = "DELETE FROM vehicles WHERE id = '".$_POST["id"]."' ";
  
  if (mysqli_query($connection, $sql)) {
    $response["error"] = false;
    $response["msg"] = "Veículo deletado!";
  } else {
    $response["error"] = true;
    $response["msg"] = "Erro ao deletar!";
  }

  return print utf8_encode(json_encode($response));
}

// SIGNUP
if ($_POST && $_POST["deonde"] === "SIGNUP") {
  $name     = $_POST["name"];
  $email    = $_POST["email"];
  $password = md5($_POST["password"]);

  // Início da verificação se o usuário existe
  $sqlUserExists = "SELECT * FROM users WHERE email = '".$email."' ";
  $userExists = mysqli_query($connection, $sqlUserExists);

  if ($userExists->num_rows > 0) {
    $response["error"] = true;
    $response["msg"] = "O email informado já existe";
    return print utf8_encode(json_encode($response));
  }
  // Fim da verificação se o usuário existe

  $sql = "INSERT INTO users (name, email, password) VALUES
  (
    '".$name."',
    '".$email."',
    '".$password."'
  )";
  
  if (mysqli_query($connection, $sql)) {
    $response["error"] = false;
    $response["msg"] = "Cadastro realizado";
  } else {
    $response["error"] = true;
    $response["msg"] = "Erro ao cadastrar";
  }

  return print utf8_encode(json_encode($response));
}

// LOGIN
if ($_POST && $_POST["deonde"] === "LOGIN") {
  $email    = $_POST["email"];
  $password = md5($_POST["password"]);

  $sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."' ";

  // Pegando objeto de informações da consulta
  $data = mysqli_query($connection, $sql);

  // Verificando se existe um usuário (Aqui retorna apenas o objeto do MySQL, não retorna os dados do usuário)
  if ($data->num_rows <= 0) {
    // Unset na sessão só por garantia
    unset($_SESSION["logged_user"]);
    $response["error"] = true;
    $response["msg"] = "Email ou senha inválidos";
    return print utf8_encode(json_encode($response));
  }

  // Pegando dados do usuário
  $userData = mysqli_fetch_assoc($data);

  // Removendo password do array pra não incluir na sessão
  unset($userData["password"]);

  // Montando sessão
  $_SESSION["logged_user"] = $userData;

  $response["error"] = false;
  $response["msg"] = "Login realizado";

  return print utf8_encode(json_encode($response));
}

// LOGOUT
if ($_POST && $_POST["deonde"] === "LOGOUT") {
  unset($_SESSION["logged_user"]);
  $response["error"] = false;

  return print utf8_encode(json_encode($response));
}

?>