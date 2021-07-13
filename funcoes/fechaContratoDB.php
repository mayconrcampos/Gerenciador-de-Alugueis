<?php
session_start();
include_once("db.php");

function valida_float($num){        // função valida float que recebe uma string
    $conta = 0;                     // Variável de controle.
    $num1 = str_split($num);        // Transforma string em um array
    foreach($num1 as $n) {          // Itera elemento por elemento desse array
        if($n == ","){              // Procura pelo elemento "," <- vírgula
            $conta++;               // Se encontrar o elemento vírgula, incrementa variável $conta.
        }
    }
    if($conta == 0){                // Se conta for igual a zero, não tiver vírgula ...
        if(is_numeric($num)){       // Se for inteiro
            $num = (double) $num;   // Transforma essa string em um double
            return $num;            // Retorna este double.
        }elseif(is_float($num)){    // Se for float puro, com ponto.
            $num = (double) $num;   // Transforma essa string em um double
            return $num;            // Retorna este double.
        }else{                      // Se não for porra nenhuma, nem número é.
            return false;           // Retorna false
        }
    }elseif($conta == 1){                       // Se tiver uma vírgula como separador.
        $num = str_replace(",", ".", $num);     // Troca essa vírgula por um ponto.
        return (double) $num;                   // Transforma essa string em double e retorna.
    }else{                                      // Se não for nada disso acima, então ele tem mais vírgulas, logo é um número inválido.
        return false;
        
    }
}


// ID's para preencher as chaves estrangeiras da tabela Contratos
$id_locador = $_POST['id_locador'];      
$id_locatario = $_POST['id_locatario'];
$id_imovel = $_POST['id_imovel'];

// Valores das inputs de fechaContrato.php, referente aos dados contratuais.
$prazo = $_POST['prazo'];
$valor = valida_float($_POST['valor']);
$data_ass = $_POST["data_ass"];
$data_chave = $_POST["data_chave"];
$valor_caucao = valida_float($_POST['valor_caucao']);
$data_caucao = $_POST["data_caucao"];
$dia_vencto = $_POST['dia_vencto'];
$observacao = mysqli_real_escape_string($conn, filter_input(INPUT_POST, "observacao", FILTER_SANITIZE_STRING));
$status_imovel = 1;

//echo "<a>ID Locador: $id_locador</a><br>";
//echo "<a>ID Locatario: $id_locatario</a><br>";
//echo "<a>ID Imóvel: $id_imovel</a><br>";
//echo "<a>Prazo: $prazo</a><br>";
//echo "<a>Valor: $valor</a><br>";
//echo "<a>Data Ass: $data_ass</a><br>";
//echo "<a>Data chave: $data_chave</a><br>";
//echo "<a>valor caucao: $valor_caucao</a><br>";
//echo "<a>data caucao: $data_caucao</a><br>";
//echo "<a>dia vencto: $dia_vencto</a><br>";
//echo "<a>observacao: $observacao</a><br>";
//echo "<a>status imovel: $status_imovel</a><br>";


if(!empty($prazo) and !empty($valor) and !empty($data_ass) and !empty($valor_caucao) and !empty($data_caucao) and !empty($dia_vencto)){

    // Todos os imóveis listados na tela fechaContrato.php constam como status = 0, ou seja, não estão alugados. Logo não é preciso testar aqui se o mesmo já se encontra alugado ou não.

    // Faz-se um update na tabela imoveis, atualizando coluna status de 0 para 1.
    $updateImovel = mysqli_query($conn, "UPDATE imoveis SET status='$status_imovel' WHERE id='$id_imovel'");

    if(mysqli_affected_rows($conn)){
        // Imóvel com status alugado, agora vamos dar um INSERT na tabela Contratos;
        $insertContrato = mysqli_query($conn, "INSERT INTO contratos (
                                            prazo,
                                            valor,
                                            data_ass,
                                            data_chave,
                                            valor_caucao,
                                            data_caucao,
                                            dia_vencto,
                                            observacao,
                                            id_locador,
                                            id_locatario,
                                            id_imovel) VALUES 
                                               ('$prazo',
                                                '$valor',
                                                '$data_ass',
                                                '$data_chave',
                                                '$valor_caucao',
                                                '$data_caucao',
                                                '$dia_vencto',
                                                '$observacao',
                                                '$id_locador',
                                                '$id_locatario',
                                                '$id_imovel')");
        if(mysqli_affected_rows($conn)){
            // Inserido com sucesso.
            $_SESSION['sucesso'] = "Contrato Cadastrado com sucesso!";
            header("Location: ../listarContratos.php");
        }else{
            // Erro ao inserir.
            $_SESSION['sucesso'] = "ERRO ao cadastrar contrato.";
            header("Location: ../fechaContrato.php");
        }

    }else{
        $_SESSION['sucesso'] = "ERRO ao atualizar status do imóvel.";
        header("Location: ../fechaContrato.php");
    }

}else{
    $_SESSION['sucesso'] = "ERRO! É necessário preencher todos os campos, exceto data de entrega das chaves e  observação.";
    header("Location: ../fechaContrato.php");
}


    
