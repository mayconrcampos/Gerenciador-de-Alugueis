<?php


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
    $Mailer->Body = "<h1>Ative já sua conta para obter acesso ao Gerenciador de Imóveis.</h1><a href='http://localhost/Gerenciador%20de%20Alugueis/funcoes/ativa.php?usuario=".$user."'>Clique aqui pra confirmar sua conta no Sistema de Administração de Aluguéis</a>";

    // Mensagem alternativa
    $Mailer->AltBody = "Tenha o controle total de suas contas.";

    // envia email
    $envia = $Mailer->send();

    if($envia){
        $_SESSION['email'] = "<br>Email enviado com sucesso<br>. Favor verificar sua caixa de email.";
        header("Location: ../index.php");
    }else{
        $_SESSION['email'] = "ERRO:".$Mailer->ErrorInfo."  <a href='http://localhost/Gerenciador%20de%20Alugueis/funcoes/ativa.php?usuario=".$user."'>Clique aqui pra reenviar email.</a>";
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
    $Mailer->Body = "<h1>Ative já sua conta e tenha accesso ao Programa de Administração de Contratos de Aluguéis.</h1><a href='http://localhost/Gerenciador%20de%20Alugueis/funcoes/ativa.php?usuario=".$_GET['usuario']."'>Clique aqui pra confirmar sua conta no Sistema de Administração de Aluguéis</a>";

    // Mensagem alternativa
    $Mailer->AltBody = "Controlando todos seus clientes.";

    // envia email
    $envia = $Mailer->send();

    if($envia){
        $_SESSION['email'] = "<br>Mensagem enviada com sucesso para ".$_GET['usuario']."<br>. Verificar sua caixa de email.";
        header("Location: ../index.php");
    }else{
        $_SESSION['email'] = "ERRO:".$Mailer->ErrorInfo."  <a href='http://localhost/Gerenciador%20de%20Alugueis/funcoes/ativa.php?usuario=".$_GET['usuario']."'>Clique aqui pra confirmar sua conta no Sistema de Cadastro de Clientes</a>";
        header("Location: ../index.php");

    }



