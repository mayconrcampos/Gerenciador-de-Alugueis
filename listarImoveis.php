<?php
  session_start();
  include_once("./funcoes/db.php");

  if($_SESSION['logado']){
    $iduser = $_SESSION['iduser'];
    $user = $_SESSION['user'];
  }else{
    $_SESSION["logado"] = "Você não está logado no sistema.";
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Aluguéis - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary align-items-center">
        <a class="navbar-brand mx-auto text-center" href="#"><img class="rounded img-fluid" src="./css/Banner - For Rent.png" width="850px"></a>
      </nav>
    </header>
    <h6 class="text text-primary" style="text-align: left;">Usuário: <?php echo $user; ?> <a href="./funcoes/sair.php">Sair</a></h6>
    <!---Tab Menu--->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">
        <ul class="nav nav-tabs nav-fill w-auto">
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastroPF.php">Cadastrar Pessoa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listaLocadores.php">Listar Locadores/Locatários</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastroImoveis.php">Cadastrar Imóvel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-white bg-secondary border-dark" href="#">Listar Imóveis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastraContratos.php">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarContratos.php">Listar Contratos</a>
            </li>
        </ul>

      <!--- Table ---->
      <fieldset>
        <legend>Listar Imóveis</legend>
      
          <div class="container w-auto mt-2">
            <table class="table table-responsive table-hover table-bordered border rounded border-dark p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Descricao</th>
                  <th scope="col">Utilização</th>
                  <th scope="col">W.C</th>
                  <th scope="col">Área(m²)</th>
                  <th scope="col">Garagem</th>
                  <th scope="col">Designação</th>
                  <th scope="col">Alugado</th>
                  <th scope="col">Ver/Editar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php $listaImoveis = mysqli_query($conn, "SELECT id, descricao, utilizacao, wc, area, garagem, designacao, status FROM imoveis ORDER BY descricao ASC"); 
                    while($listar = mysqli_fetch_assoc($listaImoveis)){ ?>
                      <tr>
                        <th scope="row"><?php echo $listar['descricao'] ?></th>
                        <td><?php echo $listar['utilizacao'] ?></td>
                        <td><?php echo $listar['wc'] ?></td>
                        <td><?php echo $listar['area'] ?></td>
                        <td><?php echo $listar['garagem'] ?></td>
                        <td><?php echo $listar['designacao'] ?></td>

                        <!---- Dois operadores ternários dentro da td, o primeiro pra tornar vermelho ou azul o campo, o outro pra escolher entre Sim ou Não para o status do imóvel. ---->
                        <td class="text-center <?php $status = ($listar['status']) ? "alert alert-primary" : "alert alert-danger"; echo $status; ?>"><?php $status = ($listar['status']) ? "Sim" : "Não"; echo $status; ?></td>

                        <td class="text-center"><a href="editaImovel.php?id=<?php echo $listar['id'] ?>"><img src="./css/pencil-fill.svg" width="20px"></a></td>
                        <td class="text-center"><a href="./funcoes/deletaImovel.php?id=<?php echo $listar['id'] ?>"><img src="./css/trash-fill.svg" width="20" onclick="return confirm('Você confirma a exclusão deste registro?')"></a></td>
                      </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
      </fieldset>
    </div>
    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    <footer class="fixed-bottom bg-secondary text-white text-center p-1">
      For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
    </footer>

 

    
  

    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>