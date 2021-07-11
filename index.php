<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Aluguéis - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
 
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark align-items-center">
        <a class="navbar-brand mx-auto text-center" href="#"><img class="rounded img-fluid" src="./css/Banner - For Rent.png" width="850px"></a>
      </nav>
    </header>
  
    <form class="form-group p-5 border border-dark rounded" action="./funcoes/usuarioLogin.php" method="POST">

             <div class="form-group p-1">
               <label for="exampleInputEmail1">Email</label>
               <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Digite seu email" name="usuario">
               <small id="emailHelp" class="form-text text-muted">Insira seu email.</small>
             </div>

             <div class="form-group p-1">
               <label for="exampleInputPassword1">Senha</label>
               <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Digite uma senha forte" name="senha">
             </div>
             
             
             <button type="submit" class="btn btn-primary btn-lg">Fazer Login</button>
             <br>
              <p class="alert alert-danger">Não é cadastrado? <a href="index1.php"> Clique aqui para criar uma conta</a></p>  

            <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
            <?php  } ?>

            <?php if(!empty($_SESSION['login'])){?>
            <p class="alert alert-danger"><?php echo $_SESSION['login'];  ?></p> 
            <?php unset($_SESSION['login']); ?>

            <?php  } ?>
            <?php if(!empty($_SESSION['existe'])){?>
              <p class="alert alert-danger"><?php echo $_SESSION['existe'];  ?></p> 
            <?php unset($_SESSION['existe']); ?>

            <?php  } ?>
            <?php if(!empty($_SESSION['logado'])){?>
              <p class="alert alert-danger"><?php echo $_SESSION['logado'];  ?></p> 
            <?php unset($_SESSION['logado']); ?>

            <?php  } ?>
            <?php if(!empty($_SESSION['ativado'])){?>
              <p class="alert alert-danger"><?php echo $_SESSION['ativado'];  ?></p> 
            <?php unset($_SESSION['ativado']); ?>

            <?php  } ?>
    </form>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>