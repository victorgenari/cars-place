<?php
    include "./services/database.php";

    // Se não existir sessão, joga pra tela de login
    if (!$_SESSION["logged_user"]) {
        header("Location: ./pages/SignIn/signin.php");
    }

    $consulta = "SELECT * FROM vehicles";
    $data = mysqli_query($connection, $consulta);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"
    >
    <!-- CSS Page -->
    <link rel="stylesheet" href="./globalStyles/global-style.css">
    <link rel="stylesheet" href="./pages/Home/index.css">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/e8ac874b2c.js" crossorigin="anonymous"></script>
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

            <div class="header-page">
                <div>
                    <a href="./pages/Creating/creating.php" class="btn btn-link">Novo veículo</a>
                </div>

                <div>
                    <button type="button" class="btn btn-primary" onclick="logout()">Sair</button>
                </div>
            </div>

            <table class="table">
                <thead>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>Placa</th>
                    <th>Cor</th>
                    <th>Ano</th>
                    <th>Combustível</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </thead>

                <tbody>
                    <?php
                        if ($data) {
                            while($carro = mysqli_fetch_assoc($data)) {
                                print "<tr>";
                                print "<td>".$carro['modelo']."</td>";
                                print "<td>".$carro['marca']."</td>";
                                print "<td>".$carro['placa']."</td>";
                                print "<td>".$carro['cor']."</td>";
                                print "<td>".$carro['ano']."</td>";
                                print "<td>".$carro['combustivel']."</td>";
                                print "<td>".$carro['descricao']."</td>";

                                print "<td>
                                            <a href='./pages/ListingById/listingById.php?id=".$carro['id']."' class='btn btn-light'>
                                                <i class='fa-solid fa-eye'></i>
                                            </a>
                                            <a href='pages/Editing/editing.php?id=".$carro['id']."' class='btn btn-warning'>
                                                <i class='fa-solid fa-pencil'></i>
                                            </a>
                                            <button class='btn btn-danger' onclick='apagar_carro(".$carro['id'].")'>
                                                <i class='fa-solid fa-trash'></i>
                                            </button>
                                        </td>";
                                print "</tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        function apagar_carro(id) {
            if (!id) {
            Swal.fire( 'Erro!', 'Id não informado', 'error' )
            return
            }

            $.ajax({
                url: "./services/database.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    id, deonde: 'APAGAR_CARROS'
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

        function logout() {
            $.ajax({
                url: "./services/database.php",
                type: "POST",
                dataType: "JSON",
                data: {
                    deonde: 'LOGOUT'
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
                        window.location.href = "http://localhost/projetos-php/cars-place/"
                        return
                    }
                }
            })
        }
    </script>
</body>
</html>