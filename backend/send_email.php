<?php 


require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendVerificationEmail($email, $token){
    $mail = new PHPMailer(true);

    try {
        // SEND EMAIL to verify the account
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '46786211aa8a7b';
        $mail->Password = '24235fc0bd1788';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        //usamos isto para usar caracteres especiais
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->setFrom('geral@whisper.pt', 'whisper');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'You registered on loginSystem';
        $mail->Body = "<h1> Click the link to verify your email:</h1> <a href='http://mydev.loginsystem.com/verify.php?token=$token'> Verify Email </a>";

        $mail->send();

        return [
            'status' => 'success',
            'data' => [
                'message' => 'Email sent successfully',
            ],
        ];
    } catch (Exception $e) {
        return [
            'status' => 'FALSE',
            'message' => $e->getMessage()
        ];
    }
}

?>