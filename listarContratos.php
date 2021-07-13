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
              <a class="nav-link text-secondary bg-white border-dark" href="listarImoveis.php">Listar Imóveis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastraContratos.php">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-white bg-secondary border-dark" href="#">Listar Contratos</a>
            </li>
        </ul>

      <!--- Table ---->
      <fieldset>
        <legend>Listar Contratos</legend>
      
          <div class="container w-auto mt-2">
            <table class="table table-sm table-responsive table-hover table-bordered border border-dark p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Locador</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Locatário</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Imóvel</th>
                  <th scope="col">Status do Contrato</th>
                  <th scope="col">Valor/mês (R$)</th>
                  <th scope="col">Mensalidades</th>
                  <th scope="col">Ver/Editar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    // Fazendo query da tabela contratos com INNER JOIN com locador, locatario, imovel.
                    $queryContratos = mysqli_query($conn, "SELECT
                                            locador.nome,       
                                            locador.cpf, 
                                            locat.nome, 
                                            locat.cpf, 
                                            imoveis.designacao,
                                            imoveis.status, 
                                            contratos.valor,
                                            contratos.id
                                            FROM locats AS locador 
                                            INNER JOIN contratos
                                            ON contratos.id_locador = locador.id
                                            INNER JOIN locats AS locat
                                            ON contratos.id_locatario = locat.id
                                            INNER JOIN imoveis
                                            ON contratos.id_imovel = imoveis.id");

                    while($contrato = mysqli_fetch_array($queryContratos)){ ?>
                      <tr>
                        <th scope="row"><?php echo $contrato[0] ?></th>
                        <td><?php echo $contrato[1] ?></td>
                        <td><?php echo $contrato[2] ?></td>
                        <td><?php echo $contrato[3] ?></td>
                        <td><?php echo $contrato[4] ?></td>
                        <td><?php $status = ($contrato[5]) ? "Vigente":""; echo $status; ?></td>
                        <td><?php $num = number_format($contrato[6], 2, ",", "."); echo $num; ?></td>
                        <td><a href="#">Parcelas</a></td>
                        <td><a href="#"><img src="" alt=""></a></td>
                        <td><a href="#"><img src="" alt=""></a></td>
                      </tr>
            <?php   } ?>
              </tbody>
            </table>
          </div>
      </fieldset>
      <?php if($_SESSION['msg']){?>
          <p class="alert alert-primary text-center"><?php echo $_SESSION['msg'];?></p>
      <?php unset($_SESSION['msg']); ?>
    <?php   }?>

    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    </div>
    <footer class="fixed-bottom bg-secondary text-white text-center p-1">
      For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
    </footer>

    
  

    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>