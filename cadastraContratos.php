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
    <!--- Tab Menu --->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 25px black;">
        <ul class="nav nav-tabs nav-fill w-auto">
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastroPF.php">Cadastrar Pessoa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listaLocadores.php">Listar Locadores/Locatários</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-secondary bg-white border-dark" href="cadastroImoveis.php">Cadastrar Imóvel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarImoveis.php">Listar Imóveis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-white bg-secondary border-dark" href="#">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarContratos.php">Listar Contratos</a>
            </li>
        </ul>

        <!----Tabela para escolher locador---->
        <div class="container">
          <fieldset>
            <legend>Cadastro de Contrato</legend>
            <form class="form-group border border-dark p-4 rounded" action="./fechaContrato.php" method="post">
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="exampleFormControlSelect1">Escolha o Locador</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="locador" autofocus>
                              <option selected>Lista de Locadores</option> 

                        <?php $listaLocadores = mysqli_query($conn, "SELECT id, nome FROM locats WHERE locat='Locador' ORDER BY nome ASC");
                              while($locador = mysqli_fetch_assoc($listaLocadores)){ ?>
                              <option value="<?php echo $locador['id'] ?>"><?php echo $locador['nome'] ?></option>
                      <?php   }?>
                        </select>
                </div>


                <div class="col-md-3">
                    <label for="exampleFormControlSelect1">Escolha o Locatário</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="locatario">
                              <option selected>Lista de Locatários</option> 

                        <?php $listaLocatarios = mysqli_query($conn, "SELECT id, nome FROM locats WHERE locat='Locatário' ORDER BY nome ASC");
                              while($locatario = mysqli_fetch_assoc($listaLocatarios)){ ?>
                              <option value="<?php echo $locatario['id'] ?>"><?php echo $locatario['nome'] ?></option>
                      <?php   }?>          
                        </select>
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlSelect1">Escolha o Imóvel</label>
                        <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="50" name="imovel">
                              <option selected>Lista de Imóveis</option> 
                        <?php $listaImoveis = mysqli_query($conn, "SELECT id, descricao, utilizacao, designacao, logradouro, numero FROM imoveis WHERE status='0' ORDER BY descricao ASC");
                              while($imovel = mysqli_fetch_assoc($listaImoveis)){ ?>
                              <option value="<?php echo $imovel['id'] ?>"><?php echo $imovel['descricao']." - ".$imovel['utilizacao']." - ".$imovel['designacao']." - ".$imovel['logradouro']." - ".$imovel['numero'] ?></option>
                      <?php   }?>    
                        </select>
                </div>
              </div>
              
              <input type="submit" class="btn btn-primary mt-3" value="Fechar Contrato">
            </form>
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