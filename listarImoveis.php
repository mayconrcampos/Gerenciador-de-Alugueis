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
    <!---Tab Menu--->
    <div class="container w-auto text-dark bg-white border border-dark p-1 rounded" style="box-shadow: 2px 2px 5px black;">
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
            <table class="table table-sm table-responsive table-hover border border-dark p-4">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Descricao</th>
                  <th scope="col">Utilização</th>
                  <th scope="col">W.C</th>
                  <th scope="col">Área(m²)</th>
                  <th scope="col">Garagem</th>
                  <th scope="col">Designação</th>
                  <th scope="col">Ver/Editar</th>
                  <th scope="col">Excluir</th>
                </tr>
              </thead>
              <tbody>
                <!-- Aqui vai código php --->
                <tr>
                  <th scope="row">Apartamento</th>
                  <td>Residencial</td>
                  <td>2</td>
                  <td>150</td>
                  <td>Privativa</td>
                  <td>Apto-05</td>
                  <td>ed</td>
                  <td>ex</td>
                </tr>
                <tr>
                  <th scope="row">Pinóquio de Oliveira</th>
                  <td>Carcereiro</td>
                  <td>26/05/1950</td>
                  <td>Locador</td>
                </tr>
                <tr>
                  <th >Pimbolin Alves</th>
                  <td >Enxugador de Gelo</td>
                  <td>12/04/1979</td>
                  <td>Locatário</td>
                </tr>
              </tbody>
            </table>
          </div>
      </fieldset>
    </div>
    <footer class="fixed-bottom bg-secondary text-white text-center p-1">
      For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
    </footer>

    
  

    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>