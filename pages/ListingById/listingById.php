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

            <table class="table">
                <thead>
                    <th>Modelo:</th>
                    <th>Marca:</th>
                    <th>Placa:</th>
                    <th>Cor:</th>
                    <th>Ano:</th>
                    <th>Combustível</th>
                    <th>Descrição:</th>
                </thead>
                <tbody>
                    <td><?php print $carro["modelo"]; ?></td>
                    <td><?php print $carro["marca"]; ?></td>
                    <td><?php print $carro["placa"]; ?></td>
                    <td><?php print $carro["cor"]; ?></td>
                    <td><?php print $carro["ano"]; ?></td>
                    <td><?php print $carro["combustivel"]; ?></td>
                    <td><?php print $carro["descricao"]; ?></td>
                </tbody>
            </table>

        </div>
    </div>

</body>
</html>