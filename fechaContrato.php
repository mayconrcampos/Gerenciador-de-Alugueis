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

        <!----Formulário para fechar contrato---->
        <?php 
            $idLocador = $_POST['locador'];
            $idLocatario = $_POST['locatario'];
            $idImovel = $_POST['imovel'];

            if(is_numeric($idLocador) and is_numeric($idLocatario) and is_numeric($idImovel)){
                // Query na tabela locador
                $queryLocador = mysqli_query($conn, "SELECT id, nome, est_civil, profissao, cpf FROM locats WHERE   id='$idLocador'");

                $locador = mysqli_fetch_assoc($queryLocador);

                // Query na tabela locatário
                $queryLocatario = mysqli_query($conn, "SELECT id, nome, est_civil, profissao, cpf FROM locats WHERE id='$idLocatario'");

                $locatario = mysqli_fetch_assoc($queryLocatario);

                // Query na tabela imóvel
                $status = 0; // Status 0 - Não alugado
                $queryImovel = mysqli_query($conn, "SELECT id, descricao, utilizacao, wc, area, garagem, designacao, logradouro, numero, complemento, bairro, cidade, cep FROM imoveis WHERE   id='$idImovel' AND status='$status'");

                $imovel = mysqli_fetch_assoc($queryImovel);
            }else{
                $_SESSION['sucesso'] = "ERRO! É preciso selecionar um Locador, Locatário e um Imóvel para fechar o contrato.";
                header("Location: ./cadastraContratos.php");
            }

            
        ?>
        <div class="container">
          <fieldset>
            <legend>Fechamento de Contrato de Aluguel</legend>
            <div class="form-group border border-dark p-4 rounded">

                <!---- Dados do Locador ------>
                <label for=""><strong>Dados do Locador</strong></label>
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="">Nome</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locador['nome'] ?>" name="nome_locador" disabled>
                </div>
                <div class="col-md-3">
                    <label for="">Estado Civil</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locador['est_civil'] ?>" name="est_civil_locador" disabled> 
                </div>
                <div class="col-md-3">
                    <label for="">Profissão</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locador['profissao'] ?>" name="profissao_locador" disabled> 
                </div>
                <div class="col-md-3">
                    <label for="">CPF</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locador['cpf'] ?>" name="cpf_locador" disabled> 
                </div>
              </div>
              <hr>
              <!---- Dados do Locatário ------>
              <label for=""><strong>Dados do Locatário</strong></label>
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="">Nome</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locatario['nome'] ?>" name="nome_locatario" disabled>
                </div>
                <div class="col-md-3">
                    <label for="">Estado Civil</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locatario['est_civil'] ?>" name="est_civil_locatario" disabled> 
                </div>
                <div class="col-md-3">
                    <label for="">Profissão</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locatario['profissao'] ?>" name="profissao_locatario" disabled> 
                </div>
                <div class="col-md-3">
                    <label for="">CPF</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $locatario['cpf'] ?>" name="cpf_locatario" disabled> 
                </div>
              </div>
              <hr>

              <!---- Dados do Imóvel ----->
              <label for=""><strong>Dados do Imóvel</strong></label>
              <div class="row mb-3">
                  <div class="col-md-4">
                        <label for="exampleFormControlSelect1">Descrição</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1"  name="descricao" disabled>
                            <option selected value="<?php echo $imovel['descricao'] ?>"><?php echo $imovel['descricao'] ?></option>
                          </select>
                      
                  </div>
                  <div class="col-md-3">
                      <label for="">Utilização</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="utilizacao" disabled>
                            <option value="<?php echo $imovel['utilizacao'] ?>" selected><?php echo $imovel['utilizacao'] ?></option>
                          </select>
                  </div>
                  <div class="col-md-1">
                    <label for="">W.C</label>
                    <input class="form-control form-control-sm" type="number" name="wc" size="20" value="<?php echo $imovel['wc'] ?>" disabled>
                  </div>
                  
              </div>

              <!----Linha 2---->
              <div class="row mb-3">
                  <div class="col-md-1">
                      <label for="">Área m²</label>
                      <input class="form-control form-control-sm" type="text" name="area" value="<?php echo $imovel['area'] ?>" disabled>
                  </div>
                  
                  <div class="col-md-2">
                    <label for="">Garagem</label>
                          <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="garagem" disabled>
                            <option value="<?php echo $imovel['garagem'] ?>" selected><?php echo $imovel['garagem'] ?></option>
                          </select>
                  </div>
                  <div class="col-md-5">
                    <label for="">Designação</label>
                    <input class="form-control form-control-sm" type="text" name="designacao" value="<?php echo $imovel['designacao'] ?>" disabled>
                  </div>
              </div>
           

              <!----Linha 3---->
              <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="">Logradouro</label>
                      <input class="form-control form-control-sm" type="text" name="logradouro" value="<?php echo $imovel['logradouro'] ?>" disabled>
                  </div>
                  <div class="col-md-2">
                    <label for="">Número</label>
                    <input class="form-control form-control-sm" type="number" name="numero" value="<?php echo $imovel['numero'] ?>" disabled>
                  </div>
                  <div class="col-md-4">
                    <label for="">Complemento</label>
                    <input class="form-control form-control-sm" type="text" name="complemento" value="<?php echo $imovel['complemento'] ?>" disabled>
                  </div>
              </div>

              <!----Linha 4---->
              <div class="row mb-3">
                  <div class="col-md-5">
                      <label for="">Bairro</label>
                      <input class="form-control form-control-sm" type="text" name="bairro" value="<?php echo $imovel['bairro'] ?>" disabled>
                  </div>
                  <div class="col-md-5">
                    <label for="">Cidade</label>
                    <input class="form-control form-control-sm" type="text" name="cidade" value="<?php echo $imovel['cidade'] ?>" disabled>
                  </div>
                  <div class="col-md-2">
                    <label for="">CEP</label>
                    <input class="form-control form-control-sm" type="text" name="cep" value="<?php echo $imovel['cep'] ?>" disabled>
                  </div>
              </div>
            </div>

              <!------ Dados Contratuais - Linha 1 -------->
            <form class="form-group border border-dark p-4 rounded" action="./funcoes/fechaContratoDB.php" method="POST">
              <label for=""><strong>Dados Contratuais</strong></label>
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="">Prazo do Contrato</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="prazo" required>
                            <option value="6" selected>Curto - 6 meses</option>
                            <option value="12">Normal - 12 meses</option>
                            <option value="36">Longo - 3 anos</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="">Valor do Aluguel (R$)</label>
                    <input class="form-control form-control-sm" type="text" name="valor" required> 
                </div>

                <div class="col-md-3">
                    <label for="">Data da Assinatura do Contrato</label>
                    <input class="form-control form-control-sm" type="date" name="data_ass" required> 
                </div>

                <div class="col-md-3">
                    <label for="">Data da Entrega das Chaves</label>
                    <input class="form-control form-control-sm" type="date" name="data_chave"> 
                </div>
              </div>

                <!---- Dados Contratuais - Linha 2 ---->
              <div class="row mb-3">
                <div class="col-md-3">
                    <label for="">Valor do Caução (R$)</label>
                    <input class="form-control form-control-sm" type="text" name="valor_caucao" >
                </div>

                <div class="col-md-3">
                    <label for="">Data de Pagamento do Caução</label>
                    <input class="form-control form-control-sm" type="date" name="data_caucao"> 
                </div>

                <div class="col-md-3">
                    <label for="">Dia de Vencimento do Aluguel</label>
                    <select class="form-control form-control-sm" id="exampleFormControlSelect1" name="dia_vencto" required>
                            <option value="5" selected>05</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                            <option value="30">30</option>
                    </select> 
                </div>
              </div>
              <!---- Dados Cadastrais - Linha 3 ---->
                <div class="row mb-3">
                    <div class="col-md-9">
                        <label for="">Observação</label>
                        <input class="form-control form-control-sm" type="textarea" name="observacao"> 
                    </div>
                </div>



              <input type="hidden" value="<?php echo $locador['id'] ?>" name="id_locador">
              <input type="hidden" value="<?php echo $locatario['id'] ?>" name="id_locatario">
              <input type="hidden" value="<?php echo $imovel['id'] ?>" name="id_imovel">

              <input type="submit" class="btn btn-primary mt-3" value="Fechar Contrato">
            
            
            </form>
          </fieldset>
        </div>

        <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
        <?php  } ?>
        <br><br><br><br>

    
  
        <footer class="fixed-bottom bg-secondary text-white text-center p-1">
                For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
        </footer>
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>