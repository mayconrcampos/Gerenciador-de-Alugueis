<?php 
session_start();
include_once("./db.php");
include_once("./funcs.php");

// Variáveis via POST
$valor_aluguel = $_POST['valor_aluguel'];
$dia_vencto = $_POST['dia_vencto'];
$prazo_contrato = $_POST['prazo_contrato'];
$id_contrato = $_POST['id_contrato'];
$mes_primeira_parcela = $_POST['mes_primeira_parcela'];
$status = 0;

// Gerando um array de datas com intervalos de 30 em 30 dias.
$data = date("$dia_vencto/$mes_primeira_parcela/Y");
$parcelas = calcularParcelas($prazo_contrato, $data);

$data_pagto = NULL;
$comentario = NULL;

// String que contém o início da query.
$sql = "INSERT INTO mensalidades (data_vencto, valor, status, id_contrato) VALUES ";

// Se todas as variáveis tiverem conteúdo.
if($valor_aluguel and $dia_vencto and $prazo_contrato and $id_contrato and $mes_primeira_parcela){

    // Laço que concatena queries formando um INSERT de múltiplas linhas.
    for($i = 0; $i < $prazo_contrato; $i++){    
        $data_da_parcela = $parcelas[$i];
        if($i > 0 ) $sql .= ", ";
        $sql.= "("
                    ."'$data_da_parcela', "
                    ."'$valor_aluguel', "
                    ."'$status', "
                    ."'$id_contrato' "
                    .")";
    }

    $insertMensalidades = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn)){
        $_SESSION['ide'] = $id_contrato;
        $_SESSION['sucesso'] = "Parcelas cadastradas com sucesso.";
        header("Location: ../vencimentosParcelas.php");
    }else{
        $_SESSION['sucesso'] = "ERRO ao cadastrar parcelas.";
        header("Location: ./vencimentosParcelas.php");
    }




    
}else{
    $_SESSION['sucesso'] = "ERRO ao gerar parcelas.";
    header("Location: ../vencimentosParcelas.php");
}



  