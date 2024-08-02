<?php
header('Content-Type: application/json');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Declaração de variáveis
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mensagem = isset($_POST['mensagem']) ? $_POST['mensagem'] : '';

// Instância da classe PHPMailer
$mail = new PHPMailer(true);
$response = array();
try
{
    // Configurações do servidor
    $mail->isSMTP();        //Define o uso de SMTP no envio
    $mail->SMTPAuth = true; //Habilita a autenticação SMTP
    $mail->Username   = 'augustomanoel527@gmail.com';
    $mail->Password   = 'bncafmijjlmjvpii';
    // Configuração da Criptografia
    $mail->SMTPSecure = 'tls';
    // Informações específicadas pelo Google
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    // Define o remetente
    $mail->setFrom('agmano22@gmail.com', 'Ford Cimavel');
    // Define o destinatário
    $mail->addAddress('augustomanoel527@gmail.com', 'Nome Destinatario');
    // Conteúdo da mensagem
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = 'Teste Envio de Email';
    //Conteúdo do e-mail
    $conteudo_email = "
    Você recebeu uma mensagem de $nome $sobrenome ($email)!
    <br><br>
    Mensagem:<br>
    $mensagem
    ";

    $mail->IsHTML(true);
    $mail->Body    = $conteudo_email;
    $mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';

    // Enviar
    $mail->send();
    $response['status'] = 'success';
    $response['message'] = 'A mensagem foi enviada!';
}catch (Exception $e){
    $response['status'] = 'error';
    $response['message'] = "A mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";
}

//Retorna a resposta em JSON
echo json_encode($response);

?>