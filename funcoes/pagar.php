<?php
session_start();
include_once("./db.php");

$id = $_POST['idparcela'];
$data_pagto = $_POST['data_pagto'];
$valor = $_POST['valor'];
$comentario = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING));
$status = 1;
if(!empty($data_pagto) and !empty($valor)){
    // Testar se parcela já foi paga e ja pegar o id_contrato
    $testaParcela = mysqli_query($conn, "SELECT id_contrato, DATE_FORMAT(data_pagto, '%d/%m/%Y') AS data_pagto, status FROM mensalidades WHERE id='$id' AND status='$status'");
    $resultadoTeste = mysqli_fetch_assoc($testaParcela);

    if(empty($resultadoTeste)){ // Se parcela não foi paga
        //  Pegando o id do contrato
        $pegarID = mysqli_query($conn, "SELECT id_contrato FROM mensalidades WHERE id='$id'");
        $idContrato = mysqli_fetch_assoc($pegarID);

        // Pagar Parcela
        $pagaParcela = mysqli_query($conn, "UPDATE mensalidades SET data_pagto='$data_pagto', valor='$valor', status='$status',     comentario='$comentario' WHERE id='$id'");

        if(mysqli_affected_rows($conn)){
            $_SESSION['ide'] = $idContrato['id_contrato']; 
            $_SESSION['sucesso'] = "Parcela paga com sucesso.";
            header("Location: ../vencimentosParcelas.php");

        }else{
            $_SESSION['sucesso'] = "ERRO ao pagar parcela.";
            header("Location: ../listarContratos.php");
        }
    }else{
        $_SESSION['ide'] = $resultadoTeste['id_contrato']; 
        $_SESSION['sucesso'] = "Esta parcela já foi paga no dia ".$resultadoTeste['data_pagto']." . Favor conferir o recibo.";
        header("Location: ../vencimentosParcelas.php");
    }

    
    

}else{
    $_SESSION['sucesso'] = "ERRO! É preciso preencher os campos.";
    header("Location: ../pagarParcela.php");
}
