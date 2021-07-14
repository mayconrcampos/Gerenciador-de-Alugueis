<?php 
session_start();
include_once("./db.php");
include_once("./funcs.php");

$valor_aluguel = $_POST['valor_aluguel'];
$dia_vencto = $_POST['dia_vencto'];
$prazo_contrato = $_POST['prazo_contrato'];
$id_contrato = $_POST['id_contrato'];
$mes_primeira_parcela = $_POST['mes_primeira_parcela'];
$status = 0;

$data = date("$dia_vencto/$mes_primeira_parcela/Y");
$parcelas = calcularParcelas($prazo_contrato, $data);

$data_pagto = NULL;
$comentario = NULL;
// Precisa montar um esquema pra concatenar uma inserção multipla em apenas uma query. 
$sql = "INSERT INTO mensalidades (data_vencto, data_pagto, valor, status, comentario, id_contrato) VALUES ";
//$dados = array();
// concatena os dados linha por linha
if($valor_aluguel and $dia_vencto and $prazo_contrato and $id_contrato and $mes_primeira_parcela){
    for($i=0; $i < $prazo_contrato; $i++){
        $data_da_parcela = $parcelas[$i];
        if($i > 0 ) $sql .= ", ";
        $sql.= "("
                    ."{$data_da_parcela},"
                    ."{$data_pagto},"
                    ."{$valor_aluguel},"
                    ."{$status},"
                    ."{$comentario},"
                    ."{$id_contrato}"
                    .")";
    }
    // concatena a consulta com os valores
    //$sql .= implode(",", $dados);
    //$_SESSION['ide'] = $id_contrato;
    //$_SESSION['sucesso'] = $sql.";";
    //header("Location: ../vencimentosParcelas.php");
    $insertMensalidades = mysqli_query($conn, $sql.";");

    if(mysqli_affected_rows($conn)){
        $_SESSION['ide'] = $id_contrato;
        $_SESSION['sucesso'] = "Parcelas cadastradas com sucesso.";
        header("Location: ../vencimentosParcelas.php");
    }else{
        $_SESSION['sucesso'] = "ERRO ao cadastrar parcelas.";
        header("Location: ./vencimentosParcelas.php");
    }




    
}else{
    $_SESSION['sucesso'] = "Fudeu";
    header("Location: ../vencimentosParcelas.php");
}



  