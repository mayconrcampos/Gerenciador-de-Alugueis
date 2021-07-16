<?php
  session_start();
  include_once("./funcoes/db.php");
  include_once("./funcoes/funcs.php");

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
              <a class="nav-link active text-secondary bg-white border-dark" href="fechaContrato.php">Fechar Contratos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white bg-secondary border-dark" href="#">Parcelas</a>
            </li>
        </ul>

        <!----Formulário para fechar contrato---->
        <?php
            if($_SESSION['ide']){
                $idContrato = $_SESSION['ide'];
                unset($_SESSION['ide']);
            }else{
                $idContrato = $_GET['id'];
            }
            
            
            $queryContrato = mysqli_query($conn, "SELECT 
                                                locatario.nome, 
                                                imoveis.utilizacao, 
                                                imoveis.designacao,
                                                contratos.valor,
                                                contratos.dia_vencto,
                                                contratos.prazo
                                                FROM locats as locatario
                                                INNER JOIN contratos
                                                ON contratos.id_locatario = locatario.id 
                                                INNER JOIN imoveis
                                                ON contratos.id_imovel = imoveis.id
                                                WHERE contratos.id='$idContrato'");
            
            $contrato = mysqli_fetch_array($queryContrato);

            
        ?>
        <div class="container">
        
          <fieldset>
            <legend>Cadastrar parcelas e vencimentos</legend>
            
            
              <!------ Dados Contratuais - Linha 1 -------->
            <form class="form-group border border-dark p-4 rounded" action="./funcoes/mensalidadesDB.php" method="POST">
              <div class="row mb-2">
                <div class="col-md-3">
                    <label for="">Locatário</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $contrato[0] ?>" disabled> 

                </div>

                <div class="col-md-2">
                    <label for="">Utilização</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $contrato[1] ?> " disabled> 
                </div>

                <div class="col-md-2">
                    <label for="">Imóvel</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $contrato[2] ?>" disabled> 
                </div>
                <div class="col-md-2">
                    <label for="">Valor Aluguel(R$)</label>
                    <input class="form-control form-control-sm" type="text"  value="<?php echo number_format($contrato[3], 2, ",", ".") ?>" disabled>
                </div>
                <div class="col-md-1">
                    <label for="">Vencto</label>
                    <input class="form-control form-control-sm" type="text"  value="<?php echo $contrato[4] ?>" disabled> 
                </div>
                <div class="col-md-2">
                    <label for="">Prazo</label>
                    <input class="form-control form-control-sm" type="text" value="<?php echo $contrato[5].' meses'; ?>" disabled> 
                </div>
                
              </div>
                
                <input type="hidden" name="id_contrato" value="<?php echo $idContrato ?>">
                <input type="hidden" name="valor_aluguel" value="<?php echo $contrato[3] ?>">
                <input type="hidden" name="dia_vencto" value="<?php echo $contrato[4] ?>">
                <input type="hidden" name="prazo_contrato" value="<?php echo $contrato[5] ?>">
            <?php 
                    $verificaMensalidades = mysqli_query($conn, "SELECT 
                                                                m.id,
                                                                m.data_vencto,
                                                                m.valor,
                                                                m.status,
                                                                m.comentario,
                                                                m.id_contrato
                                                                FROM mensalidades AS m
                                                                INNER JOIN contratos as c
                                                                ON m.id_contrato = c.id
                                                                WHERE c.id='$idContrato'
                                                                        ");
                    $mensalidade = mysqli_fetch_array($verificaMensalidades);
                    if(empty($mensalidade)){?>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="">Mês da primeira Parcela</label>
                                <select class="form-control form-control-sm" id="exampleFormControlSelect1" width="10" name="mes_primeira_parcela">

                                <option selected>Selecione o Mês</option>

                        <?php   $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
                                for($i=1;$i<=12;$i++):?>
                                <option value="<?php echo $i ?>"><?php echo $i.' '.$meses[$i-1]?></option>
                        <?php   endfor; ?>
                                </select>
                            </div>
                        </div>
                            <input type="submit" class="btn btn-primary m-1" value="Gerar Parcelas">
                            </fieldset>
            </form>
          </fieldset>
        </div>
                        <a class="alert alert-danger text-center" href="./listarContratos.php">Retornar a lista de contratos</a>
                                            
            <?php   }else{?>
                        <!--- Table ---->
                        <fieldset>
                        <legend>Listar Mensalidades</legend>
      
                        <div class="container w-auto mt-2">
                            <table class="table  table-responsive table-hover table-bordered border border-dark p-4">
                                <thead class="thead-light">
                                    <tr>
                                      <th scope="col">Locatário</th>
                                      <th scope="col">Valor/mês (R$)</th>
                                      <th scope="col">Data Vencto</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Pagar</th>
                                      <th scope="col">Data Pagto</th>
                                      <th scope="col">Recibo</th>    
                                      <th scope="col">Comentário</th>                            
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    // Fazendo query da tabela contratos com INNER JOIN com locador, locatario, imovel.
                                    $listaMensalidades = mysqli_query($conn, "SELECT 
                                                                locat.nome,
                                                                mens.valor,
                                                                DATE_FORMAT(mens.data_vencto, '%d/%m/%Y'),
                                                                mens.data_vencto,
                                                                mens.status,
                                                                DATE_FORMAT(mens.data_pagto, '%d/%m/%Y'),
                                                                mens.comentario,
                                                                mens.id
                                                                FROM locats AS locat
                                                                INNER JOIN contratos AS c
                                                                ON c.id_locatario = locat.id
                                                                INNER JOIN mensalidades as mens
                                                                ON c.id = mens.id_contrato
                                                                WHERE c.id='$idContrato'
                                                                ");
                     
                                    while($mensalidade = mysqli_fetch_array($listaMensalidades)){ ?>
                                        <tr>

                                          <th scope="row"><?php echo $mensalidade[0] ?></th>

                                          <td class='text-center'><?php echo number_format($mensalidade[1], 2, ",", ".") ?></td>
                                        
                                    <?php   $data_hoje = date("Y-m-d");
                                            if(strtotime($mensalidade[3]) >= strtotime($data_hoje)):?>
                                                <td class='alert alert-primary text-center'><?php echo $mensalidade[2] ?></td>
                                    <?php   else:?>
                                                <td class='alert alert-danger text-center'><?php echo $mensalidade[2] ?></td>
                                    <?php   endif; ?>    
                                    
                                    <?php   if($mensalidade[4]): ?>
                                                <td class="text-center"><a href="#"><img data-toggle="tooltip" data-placement="top" title="Parcela Paga" src="css/pago.png" width="25px"></a></td>
                                    <?php   else:   ?>
                                                <td class="text-center"><a href="#"><img data-toggle="tooltip" data-placement="top" title="Parcela Não Paga" src="css/notrecibo.png" width="25px"></a></td>
                                    <?php   endif; ?>

                                          
                                          
                                          <td>
                                            <?php  ?>
                                            <a href="pagarParcela.php?id=<?php echo $mensalidade[7] ?>&tipoPagto='1'&valor=<?php echo $mensalidade[1] ?>">Aluguel</a><br>
                                            <a href="pagarParcela.php?id=<?php echo $mensalidade[7] ?>">Caução</a>
                                          </td>
                                          
                                          
                                          <!-- Data pagto--->
                                          <td><?php echo $mensalidade[5] ?></td>

                                    <?php if($mensalidade[4]): ?>
                                            <td class="text-center"><a href="./funcoes/pdf.php?id=<?php echo $mensalidade[7] ?>"><img data-toggle="tooltip" data-placement="top" title="Emitir Recibo" target="_blank" src="css/recibo.png" width="25px"></a></td>
                                    <?php else:?>
                                            <td class="text-center"><a href=""><img data-toggle="tooltip" data-placement="top" title="Não tem recibo" src="css/notrecibo.png" width="25px"></a></td>
                                    
                                    <?php endif;?>

                                          <td><?php echo $mensalidade[6] ?></td>
                                    
                                        </tr>
                            <?php   } ?>
                                </tbody>
                            </table>
                        </div>
                        </fieldset>

            <?php   }?>
            
        

        <?php if(!empty($_SESSION['sucesso'])){?>
                  <p class="alert alert-danger"><?php echo $_SESSION['sucesso'];  ?></p> 
            <?php unset($_SESSION['sucesso']); ?>
        <?php  } ?>
        <br><br>
        <a class="alert alert-primary text-center" href="./listarContratos.php">Retornar a lista de contratos</a>


    
  
        <footer class="fixed-bottom bg-secondary text-white text-center p-1">
                For Rent - Programa para Administração de Contratos de Aluguéis de Imóveis ® Maycon R Campos - 07/2021
        </footer>
    


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/    ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>