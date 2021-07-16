<?php 
 
 include("../mpdf60/mpdf.php");

 //include_once("./db.php");

 //$id_mensalidade = $_GET['id'];

 // Fazendo query para puxar os seguintes dados: Por ordem:
 /**
  * id_mensalidade
  * valor
  * nome_locatário
  * valor_extenso
  * denominação
  * cidade_imovel
  * data de pagto da parcela
  * nome_locador
  * cpf_locador
  * logradouro
  * numero
  * bairro
  * cidade
  */

 $html = "
 <fieldset>
 <h1>Comprovante de Recibo</h1>
 <p class='center sub-titulo'>
 Nº <strong>id-mensalidade</strong> - 
 VALOR <strong>R$ 700,00</strong>
 </p>
 <p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
 <p>a quantia de <strong>Setecentos Reais</strong></p>
 <p>Correspondente a <strong>Aluguel do Imóvel denominado ..<strong></p>
 <p>e para clareza firmo(amos) o presente.</p>
 <p class='direita'>Itapeva, 11 de Julho de 2017</p>
 <p>Assinatura ......................................................................................................................................</p>
 <p>Nome <strong>Alberto Nascimento Junior</strong> CPF/CNPJ: <strong>222.222.222-02</strong></p>
 <p>Endereço <strong>Rua Doutor Pinheiro, 144 - Centro, Itapeva - São Paulo</strong></p>
 </fieldset>
 <div class='creditos'>
 
 </div>
 ";

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("../css/estilo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output();

 exit;