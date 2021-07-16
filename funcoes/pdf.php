<?php 
 include("../mpdf60/mpdf.php");
 session_start();

 $html = "
 <fieldset>
 <h1>Comprovante de Recibo</h1>
 <p class='center sub-titulo'>
 Nº <strong>0001</strong> - 
 VALOR <strong>R$ 700,00</strong>
 </p>
 <p>Recebi(emos) de <strong>Ebrahim Paula Leite</strong></p>
 <p>a quantia de <strong>Setecentos Reais</strong></p>
 <p>Correspondente a <strong>Serviços prestados ..<strong></p>
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