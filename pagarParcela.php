<?php
  session_start();

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
    <script src="./js/script.js"></script>
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
              <a class="nav-link text-secondary bg-white border-dark" href="cadastroImoveis.php">Cadastrar Imóvel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarImoveis.php">Listar Imóveis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastraContratos.php">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active text-white bg-secondary border-dark" href="#">Pagar Parcela</a>
            </li>
        </ul>

        <!---Formulário de Cadastro de Locador --->
        <fieldset>
        <legend>Pagar Parcela</legend>
        <div class="container w-auto mt-2">
            
              <!----Linha 1---->
              
                    <?php 
                        $idparcela = $_GET['id'];
                        $tipoPagto = $_GET['tipoPagto'];
                        $valor = $_GET['valor'];

                        if(!isset($tipoPagto)):?> 
                            <form class="form-group border border-dark p-4 rounded" action="./funcoes/pagar.php" method="post">
                            <div id="1" class='row mb-3'>
                            <label for="">Pagamento de Caução</label>
                                <div class="col-md-3">
                                    <label for="">Data Pagamento</label>
                                        <input class="form-control form-control-sm" id="exampleFormControlSelect1" type="date" name="data_pagto" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Valor</label>
                                        <input class="form-control form-control-sm" id="exampleFormControlSelect1" type="text" name="valor" required>
                                </div>
                                <div class="col-md-3">
                                        <label for="">Comentario</label>
                                            <input class="form-control form-control-sm" type="text" name="comentario">
                                </div>
                              
                            </div>
                            <input type="hidden" name="idparcela" value="<?php echo $idparcela ?>">
                            <input type="submit" class="btn btn-primary mt-3" value="Pagar Mensalidade">
                            </form>



                <?php   else:?>
                            <form class="form-group border border-dark p-4 rounded" action="./funcoes/pagar.php" method="post">
                    
                                <div id="2" class="row mb-3">
                                    <label for="">Pagamento de Aluguel</label>
                                    <div class="col-md-3">
                                        <label for="">Data Pagamento</label>
                                            <input class="form-control form-control-sm" type="date" name="data_pagto" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Valor</label>
                                            <input class="form-control form-control-sm" value="<?php echo number_format($valor, 2, ",", ".") ?>" name="valor" disabled>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Comentário</label>
                                            <input class="form-control form-control-sm" type="text" name="comentario">
                                    </div>
                                </div>
                                <input type="hidden" name="valor" value="<?php echo $valor ?>">
                                <input type="hidden" name="idparcela" value="<?php echo $idparcela ?>">
                                <input type="submit" class="btn btn-primary mt-3" value="Pagar Mensalidade">
                            </form>


                <?php   endif;?>

              
        </div>
        </fieldset>
    </div>
    <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
    <?php  } ?>
    <br><br><br>

    <footer class="fixed-bottom bg-secondary text-white text-center p-1">
      For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
    </footer>
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>