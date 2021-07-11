<?php

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


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    require "../vendor/autoload.php";

function sendEmail($user){
    

    $Mailer = new PHPMailer();

    // Definir SMTP para utilizar;
    $Mailer->isSMTP();

    // Definir codificação <UTF-8>
    $Mailer->CharSet = "UTF-8";
    // Traduzir para pt-BR;
    $Mailer->setLanguage("br");

    //Configurar SMTP
    $Mailer->SMTPAuth = true;

    // Seta para usar ssl - segurança
    //$Mailer->SMTPSecure = "ssl";
    // Seta para usar tls, exigido pelo gmail.
    $Mailer->SMTPSecure = 'tls';

    // Nome do servidor
    // Email de servidor hostgator ou outro.
    //$Mailer->Host = "br160.hostgator.com.br";
    // Email do Gmail
    $Mailer->Host = "smtp.gmail.com";

    // Username
    $Mailer->Username = "maycon.campos@gmail.com";
    // Senha
    $Mailer->Password = "J=m0I+o.x\$Z3(vx";
    // Porta gmail;
    $Mailer->Port = 587;
    // Porta de saída de e-mail de servidores;
    //$Mailer->Port = 465;

    // Email e nome de quem envia o email
    $Mailer->setFrom("maycon.campos@gmail.com", "Aplicativo de Controle Financeiro");

    // Email e nome de quem responde o email
    $Mailer->addReplyTo("maycon.campos@gmail.com", "Maycon");

    // Email destino
    $Mailer->addAddress("$user", "Aplicativo de Gerenciamento de Aluguéis");

    // Seta o envio em HTML
    $Mailer->isHTML(true);

    // Título da mensagem
    $Mailer->Subject = "Ativação de conta!";

    // Corpo da mensagem
    $Mailer->Body = "<h1>Ative já sua conta para obter acesso ao Gerenciador de Imóveis.</h1><a href='http://localhost/celkePHP/02%20-%20MySQLi%20e%20PHP/Controle%20de%20Financas/ativa.php?usuario=".$user."'>Clique aqui pra confirmar sua conta no Sistema de Cadastro de Clientes</a>";

    // Mensagem alternativa
    $Mailer->AltBody = "Tenha o controle total de suas contas.";

    // envia email
    $envia = $Mailer->send();

    if($envia){
        $_SESSION['email'] = "<br>Email enviado com sucesso<br>. Favor verificar sua caixa de email.";
        header("Location: ../index.php");
    }else{
        $_SESSION['email'] = "ERRO:".$Mailer->ErrorInfo."  <a href='http://localhost/celkePHP/02%20-%20MySQLi%20e%20PHP/18%20-%20CRUD/email.php?usuario=".$user."'>Clique aqui pra reenviar email.</a>";
        header("Location: ../index.php");

    }
}

/// Função de mandar email via GET
    $Mailer = new PHPMailer();

    // Definir SMTP para utilizar;
    $Mailer->isSMTP();

    // Definir codificação <UTF-8>
    $Mailer->CharSet = "UTF-8";
    // Traduzir para pt-BR;
    $Mailer->setLanguage("br");

    //Configurar SMTP
    $Mailer->SMTPAuth = true;

    // Seta para usar ssl - segurança
    //$Mailer->SMTPSecure = "ssl";
    // Seta para usar tls, exigido pelo gmail.
    $Mailer->SMTPSecure = 'tls';

    // Nome do servidor
    // Email de servidor hostgator ou outro.
    //$Mailer->Host = "br160.hostgator.com.br";
    // Email do Gmail
    $Mailer->Host = "smtp.gmail.com";

    // Username
    $Mailer->Username = "maycon.campos@gmail.com";
    // Senha
    $Mailer->Password = "J=m0I+o.x\$Z3(vx";
    // Porta gmail;
    $Mailer->Port = 587;
    // Porta de saída de e-mail de servidores;
    //$Mailer->Port = 465;

    // Email e nome de quem envia o email
    $Mailer->setFrom("maycon.campos@gmail.com", "Maycon R. Campos");

    // Email e nome de quem responde o email
    $Mailer->addReplyTo("maycon.campos@gmail.com", "Maycon");

    // Email destino
    $Mailer->addAddress($_GET['usuario'], "Sistema de Cadastro de Clientes");

    // Seta o envio em HTML
    $Mailer->isHTML(true);

    // Título da mensagem
    $Mailer->Subject = "Confirmação da conta";

    // Corpo da mensagem
    $Mailer->Body = "<h1>Ative já sua conta e tenha total controle sobre sua vida financeira</h1><a href='http://localhost/celkePHP/02%20-%20MySQLi%20e%20PHP/Controle%20de%20Financas/ativa.php?usuario=".$_GET['usuario']."'>Clique aqui pra confirmar sua conta no Sistema de Cadastro de Clientes</a>";

    // Mensagem alternativa
    $Mailer->AltBody = "Controlando todos seus clientes.";

    // envia email
    $envia = $Mailer->send();

    if($envia){
        $_SESSION['email'] = "<br>Mensagem enviada com sucesso<br>. Verificar sua caixa de email.";
        header("Location: ../index.php");
    }else{
        $_SESSION['email'] = "ERRO:".$Mailer->ErrorInfo."  <a href='http://localhost/celkePHP/02%20-%20MySQLi%20e%20PHP/Controle%20de%20Financas/ativa.php?usuario=".$_GET['usuario']."'>Clique aqui pra confirmar sua conta no Sistema de Cadastro de Clientes</a>";
        header("Location: ../index.php");

    }



