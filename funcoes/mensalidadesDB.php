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

// Precisa montar um esquema pra concatenar uma inserção multipla em apenas uma query. 
if($valor_aluguel and $dia_vencto and $prazo_contrato and $id_contrato){
    for($i=0;$i < sizeof($parcelas); $i++){
        $insertMensalidades = mysqli_query($conn, "INSERT INTO mensalidades (data_vencto, valor, status, id_contrato) VALUES ('$parcelas[$i]', '$valor_aluguel', '$status', '$id_contrato')");
    }

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



  