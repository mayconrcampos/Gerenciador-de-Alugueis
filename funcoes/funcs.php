<?php
session_start();

// Função para escrever valores por extenso, não fui eu que fiz, encontrei-a neste link.
// https://pt.stackoverflow.com/questions/99460/como-converter-n%c3%bamero-em-float-para-n%c3%bamero-por-extenso-no-php#99477
// O único ajuste foi substituir as funções ereg_replace, que se encontra obsoleta por preg_replace. 
// Dentro de preg replace, precisei botar as contra barras no primeiro parâmetro da função, "/ E /" , por se tratar de função que usa regex.

function extenso($valor = 0, $maiusculas = false) {
    if(!$maiusculas){
        $singular = ["centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão"];
        $plural = ["centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões"];
        $u = ["", "um", "dois", "três", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
    }else{
        $singular = ["CENTAVO", "REAL", "MIL", "MILHÃO", "BILHÃO", "TRILHÃO", "QUADRILHÃO"];
        $plural = ["CENTAVOS", "REAIS", "MIL", "MILHÕES", "BILHÕES", "TRILHÕES", "QUADRILHÕES"];
        $u = ["", "um", "dois", "TRÊS", "quatro", "cinco", "seis",  "sete", "oito", "nove"];
    }

    $c = ["", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"];
    $d = ["", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"];
    $d10 = ["dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove"];

    $z = 0;
    $rt = "";

    $valor = number_format($valor, 2, ".", ".");
    $inteiro = explode(".", $valor);

    for($i=0;$i<count($inteiro);$i++)
    for($ii=strlen($inteiro[$i]);$ii<3;$ii++)

    $inteiro[$i] = "0".$inteiro[$i];

    $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
    for ($i=0;$i<count($inteiro);$i++) {
        $valor = $inteiro[$i];
        $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
        $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
        $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

        $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
        $ru) ? " e " : "").$ru;
        $t = count($inteiro)-1-$i;
        $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
        if ($valor == "000")$z++; elseif ($z > 0) $z--;
        if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
        if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
    }

    if(!$maiusculas){
        $return = $rt ? $rt : "zero";
    } else {
        if ($rt) $rt = preg_replace("/ E /"," e ",ucwords($rt));
            $return = ($rt) ? ($rt) : "Zero" ;
    }

    if(!$maiusculas){
        return preg_replace("/ E /"," e ",ucwords($return));
    }else{
        return strtoupper($return);
    }
}

// Função para validar valores monetários float antes de ser inserido no banco de dados.
// Essa foi eu que escrevi, ta funcionando bem.

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


/**
 * Função que gera N parcelas mensais com a opção de poder escolher o vencimento da primeira parcela.
 * Se caso você não escolher a data do vencimento da primeira parcela, ele conta o dia de hoje
 * como sendo a primeira, gerando as demais.
 * 
 * Site onde encontrei esta função: https://www.linhadecomando.com/php/php-funcao-para-gerar-parcelas-com-dia-de-vencimento-fixo-melhorado
 * 
 * As mudanças que fiz no código para se adaptar ao meu problema foram:
 * 
 *  - Criei o array $datas para que, ao invés do laço imprimir uma data, ele pudesse
 * povoar este array com as datas geradas. 
 *  - Modifiquei o formato da data de "d/m/Y" para "Y-m-d" para que elas pudessem
 * serem inseridas no banco de dados.
 */
function calcularParcelas($nParcelas, $dataPrimeiraParcela = null){
    if($dataPrimeiraParcela != null){
      $dataPrimeiraParcela = explode( "/",$dataPrimeiraParcela);
      $dia = $dataPrimeiraParcela[0];
      $mes = $dataPrimeiraParcela[1];
      $ano = $dataPrimeiraParcela[2];
    } else {
      $dia = date("d");
      $mes = date("m");
      $ano = date("Y");
    }
    $datas = [];
    for($x = 0; $x < $nParcelas; $x++){
      array_push($datas, date("Y/m/d",strtotime("+".$x." month",mktime(0, 0, 0,$mes,$dia,$ano))));
    }
    return $datas;
  }


  // Função que formata CPF - Escrita por David Alves.
  // https://gist.github.com/davidalves1/3c98ef866bad4aba3987e7671e404c1e

  function formatCnpjCpf($value)
{
  $CPF_LENGTH = 11;
  $cnpj_cpf = preg_replace("/\D/", '', $value);
  
  if (strlen($cnpj_cpf) === $CPF_LENGTH) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  } 
  
  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}



