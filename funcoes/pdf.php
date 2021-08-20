<?php 
 
 include("../mpdf60/mpdf.php");
 include_once("./db.php");
include_once("./funcs.php");

 $id_mensalidade = $_GET['id'];

 // Query em três tabelas.

 $queryRecibo = mysqli_query($conn,"SELECT 
                                    mens.id,
                                    mens.valor,
                                    locatario.nome,
                                    locador.nome,
                                    locador.cpf,
                                    imoveis.designacao,
                                    imoveis.cidade,
                                    mens.data_pagto,
                                    locador.logradouro,
                                    locador.numero,
                                    locador.complemento,
                                    locador.bairro,
                                    locador.cidade,
                                    locador.cep,
                                    mens.comentario
                                    FROM mensalidades AS mens
                                    INNER JOIN contratos
                                    ON mens.id_contrato = contratos.id
                                    INNER JOIN locats AS locatario
                                    ON contratos.id_locatario = locatario.id
                                    INNER JOIN locats AS locador
                                    ON contratos.id_locador = locador.id
                                    INNER JOIN imoveis
                                    ON contratos.id_imovel = imoveis.id                                 
                                    WHERE mens.id='$id_mensalidade'");
$resultado = mysqli_fetch_array($queryRecibo);

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$html = "
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Recibo</title>
    <link rel='preload' href='../css/Assinatura.ttf' as='font' type='font/ttf' crossorigin>
</head>
<body>
<fieldset>
 <h1>Recibo de Pagamento de Aluguel</h1>
 <p class='center sub-titulo'>
 Nº <strong>".$resultado[0]."</strong> - 
 VALOR (R$) <strong>".number_format($resultado[1], 2, ",", ".")."</strong>
 </p>
 <p>Recebi(emos) de <strong>".$resultado[2]."</strong></p>
 <p>a quantia de <strong>".extenso($resultado[1])."</strong></p>
 <p>Correspondente ao <strong>Aluguel do Imóvel denominado <strong>".$resultado[5]."</strong></p>
 <p style='text-align:center;'><strong>".$resultado[14]."</strong></p>
 <p class='direita'>".$resultado[6].", ".utf8_encode(strftime('%d de %B de %Y', strtotime($resultado[7])))."</p>
 <div id='ass'><br><br><br>
    Assinatura
 </div>
 
 <p>Nome <strong>".$resultado[3]."</strong> CPF/CNPJ: <strong>".formatCnpjCpf($resultado[4])."</strong></p>
 <p>Endereço <strong>".$resultado[8].", ".$resultado[9]." - ".$resultado[10].", ".$resultado[11]." - ".$resultado[13]." - SC</strong></p>
 </fieldset>
 

</body>
</html>
";
 
 $mpdf = new mPDF(); 
 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("../css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 //$mpdf->file_put_contents("../css/assinatura.png");
 $mpdf->Output();


 exit;