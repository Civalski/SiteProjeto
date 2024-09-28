<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Campos do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Verifica o reCAPTCHA
    $secretKey = '6LdM9VEqAAAAAGjszvoGCfwKUPm8c--9wwepgGd5';
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];
    $reCaptchaURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

    $response = file_get_contents($reCaptchaURL);
    $responseKeys = json_decode($response, true);

    if(intval($responseKeys["success"]) !== 1) {
        // Falha no reCAPTCHA
        echo "Por favor, confirme que você não é um robô.";
    } else {
        // Configurações do email
        $to = 'civalskialisson@gmail.com';
        $subject = 'Nova mensagem do site';
        $body = "Nome: $nome\nEmail: $email\nMensagem:\n$mensagem";
        $headers = "From: $email";

        // Envia o email
        if(mail($to, $subject, $body, $headers)) {
            echo "Mensagem enviada com sucesso!";
        } else {
            echo "Falha ao enviar a mensagem.";
        }
    }
} else {
    echo "Método inválido.";
}
?>
