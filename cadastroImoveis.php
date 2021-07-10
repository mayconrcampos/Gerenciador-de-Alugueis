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
              <a class="nav-link active text-white bg-secondary border-dark" href="#">Cadastrar Imóvel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarImoveis.php">Listar Imóveis</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="cadastraContratos.php">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-secondary bg-white border-dark" href="listarContratos.php">Listar Contratos</a>
            </li>
        </ul>

        <!---Formulário de Cadastro de Locador --->
        <fieldset>
        <legend>Cadastro de Imóveis</legend>
        <div class="container w-auto mt-2">
            <form class="form-group border border-dark p-4 rounded" action="" method="post">
              <!----Linha 1---->
              <div class="row mb-3">
                  <div class="col-md-4">
                        <label for="exampleFormControlSelect1">Descrição</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="descricao">
                            <option value="Apartamento" selected>Apartamento</option>
                            <option value="Casa">Casa</option>
                            <option value="Sobrado">Sobrado</option>
                            <option value="Sala Comercial">Sala Comercial</option>
                          </select>
                      
                  </div>
                  <div class="col-md-3">
                      <label for="">Utilização</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="utilizacao">
                            <option value="Comercial" selected>Comercial</option>
                            <option value="Residencial">Residencial</option>
                          </select>
                  </div>
                  <div class="col-md-1">
                    <label for="">W.C</label>
                    <input class="form-control form-control-sm" type="number" name="banheiros" size="20" maxlength="2">
                  </div>
                  
              </div>

              <!----Linha 2---->
              <div class="row mb-3">
                  <div class="col-md-1">
                      <label for="">Área m²</label>
                      <input class="form-control form-control-sm" type="text" name="area" maxlength="6">
                  </div>
                  
                  <div class="col-md-2">
                    <label for="">Garagem</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="garagem">
                            <option value="Comercial" selected>Privativa</option>
                            <option value="Residencial">Rotativa</option>
                          </select>
                  </div>
                  <div class="col-md-5">
                    <label for="">Designação</label>
                    <input class="form-control form-control-sm" type="text" name="designacao" placeholder="'apto 01', 'Sala 05' ...">
                  </div>
              </div>

              <!----Linha 3---->
              <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="">Logradouro</label>
                      <input class="form-control form-control-sm" type="text" name="logradouro" maxlength="127">
                  </div>
                  <div class="col-md-2">
                    <label for="">Número</label>
                    <input class="form-control form-control-sm" type="text" name="numero" maxlength="5">
                  </div>
                  <div class="col-md-4">
                    <label for="">Complemento</label>
                    <input class="form-control form-control-sm" type="text" name="complemento" id="">
                  </div>
              </div>

              <!----Linha 4---->
              <div class="row mb-3">
                  <div class="col-md-5">
                      <label for="">Bairro</label>
                      <input class="form-control form-control-sm" type="text" name="bairro" maxlength="127">
                  </div>
                  <div class="col-md-5">
                    <label for="">Cidade</label>
                    <input class="form-control form-control-sm" type="text" name="cidade" maxlength="127">
                  </div>
                  <div class="col-md-2">
                    <label for="">CEP</label>
                    <input class="form-control form-control-sm" type="text" name="cep" id="" maxlength="9">
                  </div>
              </div>
      
              <input type="submit" class="btn btn-primary mt-3" value="Cadastrar">
            </form>
        </div>
        </fieldset>
    </div>
    <br><br><br>

    <footer class="fixed-bottom bg-secondary text-white text-center p-1">
      For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
    </footer>
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>